<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/banner1.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }
    </style>
</head>

<body
    class="bg-gradient-to-r from-[#1C1C1C] via-[#4A4A4A] to-[#000000] font-sans flex items-center justify-center min-h-screen rounded-lg">
    <div class="flex w-3/4 max-w-5xl h-[70vh] mx-auto bg-[#1C1C1C] rounded-lg overflow-hidden shadow-lg">
        <!-- Left Side (Logo) -->
        <div class="w-1/2 flex items-center justify-center bg-black">
            <img class="w-full h-full object-cover" src="img/logo2.jpg" alt="">
        </div>

        <!-- Right Side (Login Form) -->
        <div class="w-1/2 flex items-center justify-center p-6">
            <div id="loginForm" class=" w-full max-w-md">
                <h2 class="text-xl font-semibold text-center mb-4 text-[#FF3D3D]">Login</h2>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Hiển thị lỗi tổng --}}


                    {{-- Username --}}
                    <div>
                        <input type="text" name="username" placeholder="Mã nhân viên (code_nv)"
                            value="{{ old('username') }}"
                            class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]">

                    </div>

                    {{-- Password --}}
                    <div class="relative">
                        <input type="password" name="password" placeholder="CCCD"
                            class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]">
                        <svg class="h-5 w-5 text-[#4A4A4A] absolute right-2 top-1/2 transform -translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                    </div>
                    @error('username')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('failed'))
                        <div class="text-red-500 text-sm text-center">{{ $errors->first('failed') }}</div>
                    @endif

                    {{-- Checkbox + Forgot --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-1 text-[#FF3D3D]">
                            <span class="text-[#4A4A4A]">Ghi nhớ đăng nhập</span>
                        </label>
                        <a href="#" class="text-[#C71585] hover:underline">Quên mật khẩu?</a>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-[#FF3D3D] text-white rounded p-2 hover:bg-[#FF6F61] transition duration-150">
                        Đăng nhập
                    </button>
                </form>
                <p class="text-center mt-4 text-sm text-[#4A4A4A]">Chưa có tài khoản? <a href="javascript:void(0)"
                        onclick="toggleForms()" class="text-[#C71585] hover:underline">Đăng ký</a></p>
            </div>

             <div id="registerForm" class="w-full max-w-md hidden">
            <h2 class="text-xl font-semibold text-center mb-4 text-[#FF3D3D]">Đăng ký</h2>
            <form method="POST" action="" class="space-y-4">
                @csrf
                <input type="text" name="fullname" placeholder="Họ và tên"
                    class="w-full border p-2 bg-black text-white placeholder-gray-400 rounded">
                <input type="text" name="code_nv" placeholder="Mã nhân viên"
                    class="w-full border p-2 bg-black text-white placeholder-gray-400 rounded">
                <input type="text" name="CCCD" placeholder="CCCD (sử dụng làm mật khẩu)"
                    class="w-full border p-2 bg-black text-white placeholder-gray-400 rounded">
                <input type="text" name="role" placeholder="Vai trò (Quản lí, Nhân viên, Người dùng)"
                    class="w-full border p-2 bg-black text-white placeholder-gray-400 rounded">

                <button type="submit"
                    class="w-full bg-[#FF3D3D] text-white rounded p-2 hover:bg-[#FF6F61] transition duration-150">
                    Đăng ký
                </button>
                <p class="text-center mt-4 text-sm text-[#4A4A4A]">
                    Đã có tài khoản?
                    <a href="javascript:void(0)" onclick="toggleForms()" class="text-[#C71585] hover:underline">Đăng
                        nhập</a>
                </p>
            </form>
        </div>
        </div>

       
    </div>
</body>
<script>
    function toggleForms() {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        loginForm.classList.toggle('hidden');
        registerForm.classList.toggle('hidden');
    }
</script>

</html>