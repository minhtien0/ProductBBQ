<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //
    public function index(Request $request)
{
    // 1. Nếu có bảng loại blog thì lấy về cho select filter, còn không thì bỏ
    // $types = BlogType::all(); // Nếu có
    // Hoặc lấy distinct type
    $types = Blog::select('type')->distinct()->pluck('type');

    // 2. Query blog
    $query = Blog::query()
    ->join('users', 'blog.id_staff', '=', 'users.id')
    ->select('blog.*', 'users.*', 'blog.id as id_blog','blog.created_at as time_blog');

    // 3.1. Lọc theo title (tách từ khóa, tìm từng từ LIKE)
    if ($request->filled('title')) {
        $title = trim($request->input('title'));
        // Tách các từ ra (vd: "một con vịt" => ['một', 'con', 'vịt'])
        $keywords = preg_split('/\s+/', $title, -1, PREG_SPLIT_NO_EMPTY);
        $query->where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->where('title', 'like', "%{$word}%");
            }
        });
    }

    // 3.2. Lọc theo type
    if ($request->filled('type')) {
        $query->where('type', $request->input('type'));
    }

    // 3.3. Lọc theo id_staff (ví dụ: nhập số ID hoặc select nhân viên)
    if ($request->filled('id_staff')) {
        $query->where('id_staff', $request->input('id_staff'));
    }

    // 3.4. Lọc theo created_at trong khoảng (date A -> date B)
    if ($request->filled('created_from')) {
        $query->whereDate('time_blog', '>=', $request->input('created_from'));
    }
    if ($request->filled('created_to')) {
        $query->whereDate('time_blog', '<=', $request->input('created_to'));
    }

    // 4. Phân trang
    $blogs = $query->orderBy('time_blog', 'desc')->paginate(10)->withQueryString();

    // 5. Trả về view
    return view('admin.blog.index', compact('blogs', 'types'));
}


    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        // 1. Validate
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:blog,title',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.unique' => 'Tiêu đề này đã tồn tại.',
            'type.required' => 'Vui lòng chọn loại blog.',
            'content.required' => 'Vui lòng nhập nội dung bài viết.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ.',
            'image.max' => 'Kích thước ảnh tối đa 10MB.',
        ]);
        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->type = $request->type; // hoặc $request->loai_blog nếu form gửi
            $blog->content = $request->content;
            $blog->slug = Str::slug($request->title);
            $blog->id_staff = session('id'); // lấy từ session đăng nhập
            $blog->created_at = now();
            // Xử lý ảnh
            if ($request->hasFile('image')) {
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('img/blog'), $fileName);
                $blog->image = $fileName;
            }
            $blog->save();

            return redirect()->route('admin.blog.create')->with('success', 'Thêm bài viết thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi thêm blog: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi thêm bài viết. Vui lòng thử lại!');
        }
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một tin tức để xóa.');
        }

        $count = Blog::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', "Đã xóa thành công {$count} tin tức.");
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        // Tìm blog
        $blog = Blog::findOrFail($id);

        // Validate
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:blog,title,' . $blog->id,
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'type.required' => 'Vui lòng nhập loại blog.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ.',
            'image.max' => 'Kích thước ảnh tối đa 10MB.',
        ]);

        if ($validator->fails()) {
            $errorMsg = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMsg);
        }

        try {
            $blog->title = $request->title;
            $blog->type = $request->type;
            $blog->content = $request->content;
            $blog->slug = \Str::slug($request->title);
            // id_staff giữ nguyên không cho chỉnh sửa

            // Xử lý ảnh mới (nếu có)
            if ($request->hasFile('image')) {
                // Xoá ảnh cũ nếu có
                if (!empty($blog->image) && file_exists(public_path('img/blog/' . $blog->image))) {
                    @unlink(public_path('img/blog/' . $blog->image));
                }
                // Lưu file mới
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('img/blog'), $fileName);
                $blog->image = $fileName;
            }

            $blog->save();

            return redirect()->route('admin.blog.edit', $blog->id)
                ->with('success', 'Cập nhật bài viết thành công!');
        } catch (\Exception $e) {
            \Log::error('Lỗi khi cập nhật Blog [ID=' . $blog->id . ']: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật blog. Vui lòng thử lại!');
        }
    }



}
