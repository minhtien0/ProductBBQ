{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: url('img/banner1.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            z-index: -1;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#1C1C1C] via-[#4A4A4A] to-[#000000] font-sans flex items-center justify-center min-h-screen rounded-lg">
    <div class="flex w-3/4 max-w-5xl h-[70vh] mx-auto bg-[#1C1C1C] rounded-lg overflow-hidden shadow-lg">
        <!-- Left Side (Logo) -->
        <div class="w-1/2 flex items-center justify-center bg-black">
            <img class="w-full h-full object-cover" src="img/logo2.jpg" alt="Logo">
        </div>

        <!-- Right Side (Login + Register) -->
        <div class="w-1/2 flex items-center justify-center p-6">

            {{-- ===== LOGIN FORM ===== --}}
            <div id="loginForm" class="w-full max-w-md">
                <h2 class="text-xl font-semibold text-center mb-4 text-[#FF3D3D]">Đăng nhập</h2>           

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <input 
                            type="text" 
                            name="username" 
                            placeholder="Username" 
                            value="{{ old('username') }}"
                            class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                        >
                    </div>
                    @error('username')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    {{-- Password --}}
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Password" 
                            class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                        >
                        <svg class="h-5 w-5 text-[#4A4A4A] absolute right-2 top-1/2 transform -translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    @if ($errors->has('failed'))
                        <div class="text-red-500 text-sm text-center">{{ $errors->first('failed') }}</div>
                    @endif

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-[#FF3D3D] text-white rounded p-2 hover:bg-[#FF6F61] transition duration-150"
                    >
                        Đăng nhập
                    </button>
                </form>

                {{-- Link chuyển sang register --}}
                <p class="text-center mt-4 text-sm text-[#4A4A4A]">
                    Chưa có tài khoản? 
                    <a href="javascript:void(0)" onclick="toggleForms()" class="text-[#C71585] hover:underline">
                        Đăng ký
                    </a>
                </p>
            </div>
            {{-- ===== REGISTER FORM (ẩn mặc định) ===== --}}
            <div id="registerForm" class="w-full max-w-md hidden">
                <h2 class="text-xl font-semibold text-center mb-4 text-[#FF3D3D]">Đăng ký</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Fullname --}}
                    <input 
                        type="text" 
                        name="fullname" 
                        placeholder="Họ và tên" 
                        value="{{ old('fullname') }}"
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >

                    {{-- Số điện thoại (sdt) --}}
                    <input 
                        type="text" 
                        name="sdt" 
                        placeholder="Số điện thoại" 
                        value="{{ old('sdt') }}"
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >

                    {{-- Username --}}
                    <input 
                        type="text" 
                        name="user" 
                        placeholder="Username" 
                        value="{{ old('user') }}"
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >

                    {{-- Password --}}
                    <input 
                        type="password" 
                        name="password_plain" 
                        placeholder="Password" 
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >

                    {{-- Xác nhận Password --}}
                    <input 
                        type="password" 
                        name="password_plain_confirmation" 
                        placeholder="Xác nhận Password" 
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >

                    {{-- Email --}}
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        class="w-full border border-[#4A4A4A] rounded p-2 bg-black text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#FF6F61]"
                    >
                     {{-- Thông báo đăng ký thành công (nếu có) --}}
                @if (session('success_register'))
                    <div class="text-green-400 text-center text-sm mb-2">{{ session('success_register') }}</div>
                    {{-- Countdown 60s --}}
                    <div id="waitingNotice" class="text-yellow-300 text-center text-sm mb-4">
                        Bạn có thể xác nhận email trong <span id="counter">60</span> giây.
                    </div>
                @endif

                {{-- Hiển thị lỗi validation khi register --}}
                @if ($errors->any() && session('form') === 'register')
                    <div class="text-red-500 text-sm mb-2">
                        @foreach ($errors->all() as $err)
                            <div>{{ $err }}</div>
                        @endforeach
                    </div>
                @endif

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-[#FF3D3D] text-white rounded p-2 hover:bg-[#FF6F61] transition duration-150"
                    >
                        Đăng ký
                    </button>

                    {{-- Link chuyển về login --}}
                    <div class="text-center text-sm text-[#4A4A4A] mt-4">
                        Đã có tài khoản? 
                        <a href="javascript:void(0)" onclick="toggleForms()" class="text-[#C71585] hover:underline">
                            Đăng nhập
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm    = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');
        }

        // Nếu server redirect kèm session('form') = 'register', JS tự động show form đăng ký
        @if (session('form') === 'register')
            toggleForms();
        @endif

        // Nếu vừa đăng ký thành công, đếm ngược 60s
        @if (session('success_register'))
            let sec = 60;
            const counterElem = document.getElementById('counter');
            const interval = setInterval(() => {
                sec--;
                counterElem.innerText = sec;
                if (sec <= 0) {
                    clearInterval(interval);
                    document.getElementById('waitingNotice').innerHTML =
                        '<span class="text-red-400 text-sm">Thời gian xác nhận đã hết hạn.</span>';
                }
            }, 1000);
        @endif
    </script>
</body>
</html>
