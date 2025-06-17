<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_logged_in') && !session()->has('staff_logged_in')) {
            return redirect('/login')->withErrors(['access' => 'Vui lòng đăng nhập.']);
        }
        return $next($request);
    }
}