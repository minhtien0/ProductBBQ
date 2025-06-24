<?php

namespace App\Http\Controllers\AdminController\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories=Menu::all();
        return view('admin.product.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.product.category.create');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'notes' => 'required|string',
        ], [
            'name.required' => 'Vui lòng nhập tên menu.',
            'notes.required' => 'Vui lòng nhập ghi chú.',
            'name.string' => 'Tên có giá trị phải là chuỗi.',
            'notes.string' => 'Ghi chú có giá trị phải là chuỗi.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            $data = $request->all();
            $data['created_at'] = now();
            Menu::create($data);

            return redirect()->route('admin.menu.create')->with('success', 'Thêm menu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Thêm không thành công! ' . $e->getMessage());
        }
    }

        public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một menu để xóa.');
        }

        $count = Menu::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} menu.");
    }

}
