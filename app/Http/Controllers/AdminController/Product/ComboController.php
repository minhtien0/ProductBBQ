<?php

namespace App\Http\Controllers\AdminController\Product;
use App\Http\Controllers\Controller;
use App\Models\FoodCombo;
use App\Models\DetailCombo;
use App\Models\Food;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    //
    public function index()
    {
        $combos = FoodCombo::all();
        return view('admin.product.combo.index', compact('combos'));
    }

    public function showAddForm()
    {
        $foods = Food::all();
        return view('admin.product.combo.create', compact('foods'));
    }

    // Trong FoodController
// Trong FoodController:
    public function ajaxSearch(Request $request)
    {
        $q = $request->input('q');
        $page = $request->input('page', 1);
        $pageSize = 10;

        $query = \App\Models\Food::query();
        if ($q) {
            $query->where('name', 'like', "%$q%");
        }
        $total = $query->count();
        $foods = $query->orderBy('name')
            ->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get(['id', 'name', 'price']);

        return response()->json([
            'items' => $foods,
            'more' => ($page * $pageSize) < $total
        ]);
    }


    public function add(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'codecombo' => 'required|string|max:255|unique:food_combos,codecombo',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'foods' => 'required|string', // sẽ là chuỗi id cách nhau dấu phẩy
                'note' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'codecombo.required' => 'Vui lòng nhập mã combo!',
                'codecombo.unique' => 'Mã combo đã tồn tại!',
                'name.required' => 'Vui lòng nhập tên combo!',
                'price.required' => 'Vui lòng nhập giá combo!',
                'price.numeric' => 'Giá combo phải là số!',
                'foods.required' => 'Hãy chọn ít nhất một món ăn!',
                'foods.*.exists' => 'Món ăn không hợp lệ!',
                'image.image' => 'File phải là hình ảnh!',
                'image.max' => 'Ảnh tối đa 2MB!',
            ]);

            $foods = array_filter(explode(',', $request->foods));
            if (empty($foods)) {
                return back()->withInput()->withErrors(['foods' => 'Vui lòng chọn ít nhất một món ăn!']);
            }

            // --- Tính tổng giá các món ăn trong combo ---
            $totalFoodsPrice = \App\Models\Food::whereIn('id', $foods)->sum('price');
            //dd($totalFoodsPrice);

            // Nếu giá combo lớn hơn tổng giá món ăn thì báo lỗi
            if ($request->price > $totalFoodsPrice) {
                return back()->withInput()->with('error', 'Giá combo không được lớn hơn tổng giá các món ăn trong combo (' . number_format($totalFoodsPrice) . ' VNĐ)!');
            }

            // Lưu combo
            $combo = new \App\Models\FoodCombo();
            $combo->codecombo = $request->codecombo;
            $combo->name = $request->name;
            $combo->price = $request->price;
            $combo->note = $request->note;
            // Xử lý ảnh
            $imageName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img/combo'), $imageName);
                $combo->image = $imageName;
            }
            $combo->save();

            // Lưu chi tiết combo
            foreach ($foods as $food_id) {
                DetailCombo::create([
                    'combo_id' => $combo->id,
                    'food_id' => $food_id,
                ]);
            }

            return redirect()->route('admin.product.food_combo.addForm')->with('success', 'Thêm combo thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $combo = \App\Models\FoodCombo::with('foods')->findOrFail($id);
        //dd($combo);
        return view('admin.product.combo.edit', compact('combo'));
    }
    public function update(Request $request, $id)
    {
        try {
            $combo = FoodCombo::findOrFail($id);
            $request->validate([
                'codecombo' => 'required|string|max:255|unique:food_combos,codecombo,' . $combo->id,
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'foods' => 'required|string',
                'note' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'codecombo.required' => 'Vui lòng nhập mã combo!',
                'codecombo.unique' => 'Mã combo đã tồn tại!',
                'name.required' => 'Vui lòng nhập tên combo!',
                'price.required' => 'Vui lòng nhập giá combo!',
                'price.numeric' => 'Giá combo phải là số!',
                'foods.required' => 'Hãy chọn ít nhất một món ăn!',
                'foods.*.exists' => 'Món ăn không hợp lệ!',
                'image.image' => 'File phải là hình ảnh!',
                'image.max' => 'Ảnh tối đa 2MB!',
            ]);

            $foods = array_filter(explode(',', $request->foods));
            if (empty($foods)) {
                return back()->withInput()->withErrors(['foods' => 'Vui lòng chọn ít nhất một món ăn!']);
            }

            // Cập nhật thông tin
            $combo->codecombo = $request->codecombo;
            $combo->name = $request->name;
            $combo->price = $request->price;
            $combo->note = $request->note;

            // Đổi ảnh nếu có
            if ($request->hasFile('image')) {
                // Xoá ảnh cũ nếu cần
                if ($combo->image && file_exists(public_path('img/combo/' . $combo->image))) {
                    unlink(public_path('img/combo/' . $combo->image));
                }
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img/combo'), $imageName);
                $combo->image = $imageName;
            }

            $combo->save();

            // Update chi tiết combo
            DetailCombo::where('combo_id', $combo->id)->delete();
            foreach ($foods as $food_id) {
                DetailCombo::create([
                    'combo_id' => $combo->id,
                    'food_id' => $food_id,
                ]);
            }

            return redirect()->route('admin.food_combo.edit', ['id' => $combo->id])
                ->with('success', 'Cập nhật combo thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một combo để xóa.');
        }

        $count = FoodCombo::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} Combo.");
    }


}
