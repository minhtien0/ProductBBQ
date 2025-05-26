<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('index');
    }
    public function order(){
        return view('qrorder');
    }
    public function about(){
        return view('about');
    }
    

    public function login(Request $request) {
        // Kiểm tra xem form đã được submit chưa
        if ($request->isMethod('post')) {
            $user1 = 'ABC';
            $pass1 = '123';
        
            $user = $request->input('user');
            $password = $request->input('password');
        
            $validationErrors = [];
        
            // Kiểm tra lỗi
            if (empty($user)) {
                $validationErrors['user'] = 'Vui lòng nhập tên đăng nhập';
            }
        
            if (empty($password)) {
                $validationErrors['password'] = 'Vui lòng nhập mật khẩu';
            }
        
            // Nếu cả hai trường đều được điền, kiểm tra thông tin đăng nhập
            if (!empty($user) && !empty($password)) {
                if ($user != $user1 || $password != $pass1) {
                    $validationErrors['failed'] = 'Tên đăng nhập hoặc mật khẩu không chính xác';
                }
            }
        
            // Nếu không có lỗi, đăng nhập thành công
            if (empty($validationErrors)) {
                return redirect('/admin')->with('success', 'Đăng nhập thành công');
            } else {
                // Sử dụng withErrors để đưa lỗi vào session
                return redirect()->back()
                    ->withErrors($validationErrors)
                    ->withInput($request->except('password'));
            }
        }
        
        // Hiển thị form ban đầu
        return view('login');
    }


}
