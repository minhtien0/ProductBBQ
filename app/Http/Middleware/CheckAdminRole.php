<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra đã đăng nhập chưa
        if (!session()->has('staff_logged_in')) {
            return redirect('/login')->withErrors(['access' => 'Vui lòng đăng nhập.']);
        }

        // Kiểm tra quyền
        $role = session('staff_role'); // Giả sử bạn đã lưu 'role' trong session khi đăng nhập
        if ($role !== 'Quản Lí' && $role !== 'Nhân Viên' && $role !== 'Thu Ngân' && $role !== 'Đầu Bếp') {
            abort(403, 'Bạn không có quyền truy cập trang quản trị.');
        }

        /* if ($role == 'Thu Ngân') {
           return redirect('/admin/cashier')->withErrors(['success' => 'Đăng nhập thành công.']);
        } */

        return $next($request);
    }
}
