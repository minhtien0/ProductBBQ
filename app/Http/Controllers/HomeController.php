<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Staff;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function order()
    {
        return view('qrorder');
    }
    public function about()
    {
        return view('about');
    }
    public function menu()
    {
        return view('menu');
    }
    public function blog()
    {
        return view('blog');
    }
    public function contact()
    {
        return view('contact');
    }
    public function deskmanage(){
        return view('deskmanage');
    }


    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $user = $request->input('username'); // tên input là "username"
            $password = $request->input('password');

            $validationErrors = [];

            if (empty($user)) {
                $validationErrors['username'] = 'Vui lòng nhập mã nhân viên (code_nv)';
            }

            if (empty($password)) {
                $validationErrors['password'] = 'Vui lòng nhập CCCD';
            }

            if (empty($validationErrors)) {
                $staff = Staff::where('code_nv', $user)
                    ->where('CCCD', $password)
                    ->first();

                if ($staff) {
                    session(['staff_logged_in' => true]);
                    session(['staff_id' => $staff->id]);
                    session(['staff_name' => $staff->fullname]);
                    session(['role' => $staff->role]);
                    return redirect('/')->with('success', 'Đăng nhập thành công');
                } else {
                    $validationErrors['failed'] = 'Mã nhân viên hoặc CCCD không chính xác';
                }
            }

            return redirect()->back()
                ->withErrors($validationErrors)
                ->withInput($request->except('password'));
        }

        return view('login');
    }

    public function logout(Request $request)
    {
        // Xóa tất cả session liên quan đến đăng nhập
        $request->session()->forget(['staff_logged_in', 'staff_id', 'staff_name']);
       

        return redirect('/login')->with('success', 'Đăng xuất thành công');
    }


}
