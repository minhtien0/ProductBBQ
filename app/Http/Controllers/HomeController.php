<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Company;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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
    public function menudetail()
    {
        return view('menudetail');
    }
    public function blogdetail()
    {
        return view('blogdetail');
    }
    //Trang chi tiết người dùng
    public function userdetail()
    {
        $address = Address::where('user_id', session('id'))
            ->where('default', 1)
            ->first();

        $addressAll = Address::where('user_id', session('id'))
            ->get();
        return view('userdetail', compact('address', 'addressAll'));
    }

    public function deskmanage()
    {
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
                $staff = User::where('user', $user)
                    ->where('password', $password)
                    ->first();

                if ($staff) {
                    session(['staff_logged_in' => true]);
                    session(['id' => $staff->id]);
                    session(['fullname' => $staff->fullname]);
                    session(['role' => $staff->role]);
                    session(['sdt' => $staff->sdt]);
                    session(['email' => $staff->email]);
                    session(['birthday' => $staff->birthday]);
                    session(['gender' => $staff->gender]);
                    session(['avatar' => $staff->avatar]);

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
        $request->session()->forget(['staff_logged_in', 'id', 'fullname', 'gender', 'avatar', 'birthday', 'email', 'sdt', 'role']);


        return redirect('/login')->with('success', 'Đăng xuất thành công');
    }

    /**
     * Xử lý ĐĂNG KÝ (Register)
     */
    public function register(Request $request)
    {
        // đánh dấu form đang submit register để JS bật đúng block
        $request->session()->flash('form', 'register');

        // Validation 5 trường: fullname, sdt, user, password_plain, password_plain_confirmation, email
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'sdt' => 'required|string|max:20',
            'user' => 'required|string|max:50|unique:users,user',
            'password_plain' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
            'email' => 'required|email|unique:users,email',
        ], [
            'fullname.required' => 'Bạn cần nhập Họ và tên.',
            'sdt.required' => 'Bạn cần nhập Số điện thoại.',
            'user.required' => 'Bạn cần nhập Username.',
            'user.unique' => 'Username đã tồn tại.',
            'password_plain.required' => 'Bạn cần nhập Password.',
            'password_plain.min' => 'Password phải ít nhất 6 ký tự.',
            'password_plain.confirmed' => 'Xác nhận Password không khớp.',
            'password_plain.regex' => 'Password phải chứa ít nhất một ký tự đặc biệt (ví dụ: !@#$%^&*).',
            'email.required' => 'Bạn cần nhập Email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo token xác nhận
        $token = Str::random(40);
        $now = Carbon::now();

        // Lưu user mới
        $user = new User();
        $user->fullname = $request->fullname;
        $user->sdt = $request->sdt;
        $user->user = $request->user;
        $user->password = Hash::make($request->password_plain);
        $user->email = $request->email;
        $user->email_verify_token = $token;
        $user->token_created_at = $now;
        $user->role=0;
        $user->save();

        // Gửi email xác nhận
        $this->sendVerificationEmail($user);

        return redirect()->back()
            ->with('success_register', 'Đăng ký thành công! Vui lòng kiểm tra email để xác nhận.')
            ->with('form', 'register');
    }



    /**
     * Gửi Email xác nhận
     */
    protected function sendVerificationEmail(User $user)
    {
        $verifyUrl = route('verify.email', ['token' => $user->email_verify_token]);
        $minutes = 60; // token hiệu lực 60 giây (mặc định)

        $data = [
            'name' => $user->fullname,
            'verifyUrl' => $verifyUrl,
            'minutes' => $minutes,
        ];

        Mail::send('emails.verify-email', $data, function ($message) use ($user) {
            $message->to($user->email, $user->fullname)
                ->subject('Xác nhận Email Đăng ký');
        });
    }

    /**
     * Xử lý Verify Email khi user click link
     */
    public function verifyEmail($token)
    {
        $user = User::where('email_verify_token', $token)->first();

        if (!$user) {
            // Link sai
            return view('auth-verify-result', [
                'status' => 'invalid',
                'message' => 'Link xác nhận không hợp lệ.'
            ]);
        }

        // Kiểm tra thời gian token (tối đa 60 giây)
        $tokenAge = Carbon::now()->diffInSeconds($user->token_created_at);
        if ($tokenAge > 60) {
            // Token hết hạn
            return view('auth-verify-result', [
                'status' => 'expired',
                'message' => 'Link xác nhận đã hết hạn (hơn 60 giây).'
            ]);
        }

        // Nếu chưa xác thực
        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            $user->email_verify_token = null;
            $user->token_created_at = null;
            $user->save();
        }

        return view('auth-verify-result', [
            'status' => 'success',
            'message' => 'Email đã được xác nhận thành công! Bạn có thể đăng nhập ngay.'
        ]);
    }


}
