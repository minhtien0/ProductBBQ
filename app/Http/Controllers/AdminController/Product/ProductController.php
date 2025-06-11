<?php

namespace App\Http\Controllers\AdminController\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Image;
use App\Models\Food;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy toàn bộ danh sách Menu để đưa vào dropdown “Loại (Menu)” trong filter
        $menus = Menu::all(); // giả sử model Menu tồn tại

        // 2. Bắt đầu tạo query builder cho Food
        $query = Food::query();

        // 3. Áp dụng các điều kiện filter nếu request có chứa giá trị tương ứng

        // 3.1. Lọc theo tên món (like)
        if ($request->filled('name')) {
            $qName = trim($request->input('name'));
            $query->where('name', 'like', "%{$qName}%");
        }

        // 3.2. Lọc theo giá tiền (khoảng giá)
        if ($request->filled('price_min')) {
            $min = floatval($request->input('price_min'));
            $query->where('price', '>=', $min);
        }
        if ($request->filled('price_max')) {
            $max = floatval($request->input('price_max'));
            $query->where('price', '<=', $max);
        }

        // 3.3. Lọc theo loại (menu_id)
        if ($request->filled('type')) {
            $type = $request->input('type');
            $query->where('type', $type);
        }

        // 3.4. Lọc theo trạng thái
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        // 4. Cuối cùng phân trang (vd: 10 bản ghi/trang) và giữ nguyên tham số GET (appends)
        $foodsQuery = $query->orderBy('name', 'asc');
        $foods = $foodsQuery->count() > 10
            ? $foodsQuery->paginate(10)->withQueryString()
            : $foodsQuery->get();

        // 5. Trả về view, truyền các biến cần thiết
        return view('admin.product.index', compact('foods', 'menus'));
    }
    public function create()
    {
        // Lấy danh sách menus để hiển thị select dropdown
        $menus = Menu::all();
        return view('admin.product.create', compact('menus'));
    }

    /**
     * Xử lý lưu Food mới
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:foods,name',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'price' => 'required|numeric|min:0|max:10000000',
            'type' => 'required|exists:menus,id',
        ], [
            // Thông báo tiếng Việt
            'name.required' => 'Vui lòng nhập tên món ăn.',
            'name.string' => 'Tên món ăn phải là chuỗi ký tự.',
            'name.max' => 'Tên món ăn không vượt quá 255 ký tự.',
            'name.unique' => 'Tên món ăn đã tồn tại.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'note.string' => 'Ghi chú phải là chuỗi ký tự.',

            'image.image' => 'Ảnh phải là file hình ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ (chỉ jpeg,png,jpg,gif).',
            'image.max' => 'Ảnh không vượt quá 10MB.',

            'price.required' => 'Vui lòng nhập giá tiền.',
            'price.numeric' => 'Giá tiền phải là số.',
            'price.min' => 'Giá tiền phải lớn hơn hoặc bằng 0.',
            'price.max' => 'Giá tiền phải nhỏ hơn 10.000.000.',

            'type.required' => 'Vui lòng chọn Menu.',
            'type.exists' => 'Menu đã chọn không tồn tại.',
        ]);

        // Nếu có lỗi validate → quay lại form, giữ input, show popup lỗi
        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            // 2. Tạo mới đối tượng Food
            $food = new Food();
            $food->name = $request->name;
            $food->type = $request->type;
            $food->description = $request->description;
            $food->note = $request->note;
            $food->price = $request->price;
            $food->slug = Str::slug($request->name);

            // Xử lý upload ảnh (nếu có)
            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                // Lưu vào public/uploads/foods
                $request->file('image')->move(public_path('img'), $fileName);
                $food->image = $fileName;
            }
            $food->status = 'Còn';
            $food->save();

            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $file) {
                    $fileName = time() . '_' . Str::random(5) . '_' . $file->getClientOriginalName();
                    $file->move(public_path('img/details/food'), $fileName);
                    \App\Models\Image::create([
                        'id_food' => $food->id,
                        'img' => $fileName,
                        // nếu có cột id_rate, id_food thì để null hoặc gán tương ứng
                    ]);
                }
            }

            // 3. Thành công → redirect về danh sách (hoặc create) kèm popup success
            return redirect()->route('admin.product.create')
                ->with('success', 'Thêm món ăn thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm Food: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi thêm món ăn. Vui lòng thử lại!');
        }
    }

    public function edit($id)
    {
        // Tìm món ăn theo ID, nếu không tìm thấy sẽ 404
        $food = Food::findOrFail($id);
        // Lấy danh sách Menu để build dropdown
        $menus = Menu::all();

        $images = Image::where('id_food', '=', $id)
            ->get();

        return view('admin.product.edit', compact('food', 'menus', 'images'));
    }

    /**
     * Xử lý cập nhật Food
     */
    public function update(Request $request, $id)
    {
        // Tìm món ăn
        $food = Food::findOrFail($id);

        // 1. Validate dữ liệu đầu vào (unique name ngoại trừ record hiện tại)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:foods,name,' . $food->id,
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'price' => 'required|numeric|min:0',
            'type' => 'required|exists:menus,id',
            'status' => 'required|in:Còn Hàng,Hết Hàng',
        ], [
            // Thông báo tiếng Việt
            'name.required' => 'Vui lòng nhập tên món ăn.',
            'name.string' => 'Tên món ăn phải là chuỗi ký tự.',
            'name.max' => 'Tên món ăn không vượt quá 255 ký tự.',
            'name.unique' => 'Tên món ăn đã tồn tại.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'note.string' => 'Ghi chú phải là chuỗi ký tự.',

            'image.image' => 'Ảnh phải là file hình ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ (chỉ jpeg,png,jpg,gif).',
            'image.max' => 'Ảnh không vượt quá 10MB.',

            'price.required' => 'Vui lòng nhập giá tiền.',
            'price.numeric' => 'Giá tiền phải là số.',
            'price.min' => 'Giá tiền phải lớn hơn hoặc bằng 0.',

            'type.required' => 'Vui lòng chọn Menu.',
            'type.exists' => 'Menu đã chọn không tồn tại.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        // Nếu validate lỗi → quay lại form, giữ input, show popup lỗi
        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            // 2. Cập nhật các thuộc tính của Food
            $food->name = $request->name;
            $food->type = $request->type; // menu_id
            $food->description = $request->description;
            $food->note = $request->note;
            $food->price = $request->price;
            $food->slug = Str::slug($request->name);
            $food->status = $request->status;

            // 3. Xử lý upload ảnh mới (nếu có), xóa ảnh cũ nếu có
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ (nếu đã lưu)
                if (!empty($food->image) && file_exists(public_path('img/' . $food->image))) {
                    @unlink(public_path('img/' . $food->image));
                }
                // Lưu file mới
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('img'), $fileName);
                $food->image = $fileName;
            }

            $food->save();

            // — 1. Xóa ảnh detail được đánh dấu —
            if ($request->filled('delete_images')) {
                foreach ($request->input('delete_images') as $imgId) {
                    $img = Image::find($imgId);
                    if ($img) {
                        // xóa file vật lý
                        File::delete(public_path('img/details/food/' . $img->img));
                        // xoá record
                        $img->delete();
                    }
                }
            }

            if ($request->hasFile('replace_images')) {
                foreach ($request->file('replace_images') as $imgId => $file) {
                    $img = Image::find($imgId);
                    if ($img) {
                        // xóa file cũ
                        File::delete(public_path('img/details/food/' . $img->img));
                        // lưu file mới
                        $fileName = time()
                            . '_' . Str::random(5)
                            . '_' . $file->getClientOriginalName();
                        $file->move(public_path('img/details/food'), $fileName);
                        // cập nhật record
                        $img->update([
                            'img' => $fileName
                        ]);
                    }
                }
            }

            // — 3. Thêm mới các ảnh detail —
            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $file) {
                    $fileName = time() . '_' . Str::random(5) . '_' . $file->getClientOriginalName();
                    $file->move(public_path('img/details/food'), $fileName);
                    \App\Models\Image::create([
                        'id_food' => $food->id,
                        'img' => $fileName,
                        // nếu có cột id_rate, id_food thì để null hoặc gán tương ứng
                    ]);
                }
            }

            // 4. Thành công → redirect về trang edit (hoặc list) kèm popup success
            return redirect()->route('admin.product.edit', $food->id)
                ->with('success', 'Cập nhật món ăn thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật Food [ID=' . $food->id . ']: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật món ăn. Vui lòng thử lại!');
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một món ăn để xóa.');
        }

        $count = Food::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} món ăn.");
    }
}