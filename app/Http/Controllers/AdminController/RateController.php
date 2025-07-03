<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Rate;
use App\Models\Blog;
use App\Models\Food;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //Sản phẩm
  public function index(Request $request)
{
    // Lấy danh sách sản phẩm để filter
    $foods = Food::select('id', 'name')->get(); // Table của bạn có thể là 'products' hoặc 'foods'

    $query = Rate::with(['food', 'user'])
        ->whereNotNull('food_id');

    // Lọc theo sản phẩm
    if ($request->filled('food_id')) {
        $query->where('food_id', $request->food_id);
    }

    // Lọc theo số sao
    if ($request->filled('star')) {
        $query->where('rate', $request->star);
    }

    // Lọc theo ngày bắt đầu
    if ($request->filled('from_date')) {
        $query->whereDate('time', '>=', $request->from_date);
    }

    // Lọc theo ngày kết thúc
    if ($request->filled('to_date')) {
        $query->whereDate('time', '<=', $request->to_date);
    }

    // Đếm tổng kết quả sau khi filter
    $countRates = $query->count();

    // Phân trang
    $listRates = $query->orderByDesc('time')->paginate(10)->appends($request->all());

    return view('admin.rate', compact('countRates', 'listRates', 'foods'));
}

public function delete($id)
{
    $rate = Rate::find($id);
    if (!$rate) {
        return response()->json(['success' => false, 'message' => 'Không tìm thấy đánh giá!']);
    }
    $rate->delete();
    return response()->json(['success' => true]);
}

    //Tin tức
    public function blog(Request $request)
    {
        // Lấy danh sách bài viết để lọc
        $blogs = Blog::select('id', 'title')->get();

        // Query đánh giá (review) bài viết
        $query = Rate::with(['user', 'blog'])
            ->whereNotNull('blog_id');

        // Lọc theo bài viết
        if ($request->filled('blog_id')) {
            $query->where('blog_id', $request->blog_id);
        }

        // Lọc theo số sao
        if ($request->filled('star')) {
            $query->where('star', $request->star);
        }

        // Lọc theo ngày bắt đầu
        if ($request->filled('from_date')) {
            $query->whereDate('time', '>=', $request->from_date);
        }

        // Lọc theo ngày kết thúc
        if ($request->filled('to_date')) {
            $query->whereDate('time', '<=', $request->to_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Đếm tổng kết quả sau khi filter
        $countRates = $query->count();
        // Lấy danh sách đánh giá (phân trang)
        $listRates = $query->orderByDesc('time')->paginate(5)->appends($request->all());


        // Trả về view kèm biến filter
        return view('admin.rateblog', compact('countRates', 'listRates', 'blogs'));
    }

    public function approveBlog($id)
    {
        $rate = Rate::find($id);
        if (!$rate) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy đánh giá'], 404);
        }
        $rate->status = 1;
        $rate->save();

        return response()->json(['success' => true, 'message' => 'Đã xác nhận đánh giá thành công']);
    }

    public function deleteBlog($id)
    {
        $rate = Rate::find($id);
        if (!$rate) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy đánh giá'], 404);
        }
        $rate->delete();

        return response()->json(['success' => true, 'message' => 'Đã xóa đánh giá thành công']);
    }



}
