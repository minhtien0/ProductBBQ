<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Đăng Nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#EE4D2D] font-sans">
    <!-- Header -->
    <header class="bg-white py-2">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-[#EE4D2D] mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span class="text-[#EE4D2D] font-semibold text-lg">Shopee</span>
                <span class="ml-2 text-gray-700 font-medium">Đăng nhập</span>
            </div>
            <a href="#" class="text-gray-500 hover:text-gray-700">Bạn cần giúp đỡ?</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto flex items-center justify-center h-[calc(100vh-60px)]">
        <!-- Left Section -->
        <div class="flex-1 text-white p-10">
            <div class="flex justify-center mb-6">
                <div class="flex items-center">
                    <svg class="h-24 w-24 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-6xl font-bold ml-2">Shopee</span>
                </div>
            </div>
            <p class="text-center text-lg">
                Nền tảng thương mại điện tử<br> yêu thích ở Đông Nam Á & Đài Loan
            </p>
        </div>

        <!-- Right Section (Login Form) -->
        <div id="login-form" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Đăng nhập</h2>
                <div class="flex items-center space-x-2">
                    <button class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm">Đăng nhập với mã QR</button>
                    <svg class="h-6 w-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
                    </svg>
                </div>
            </div>

            <!-- Form Inputs -->
            <div class="space-y-4">
                <input type="text" placeholder="Email/Số điện thoại/Tên đăng nhập"
                    class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-[#EE4D2D]">

                <div class="relative">
                    <input type="password" placeholder="Mật khẩu"
                        class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-[#EE4D2D]">
                    <svg class="h-5 w-5 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>

                <button class="w-full bg-[#FF6347] text-white rounded p-3 hover:bg-[#FF7F50] transition duration-150">
                    ĐĂNG NHẬP
                </button>

                <a href="#" class="text-blue-500 text-sm text-center block">Quên mật khẩu</a>
            </div>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-4 text-gray-500 text-sm">HOẶC</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Social Login Buttons -->
            <div class="flex justify-between space-x-4">
                <button
                    class="flex-1 border border-gray-300 rounded p-2 flex items-center justify-center hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    Facebook
                </button>
                <button
                    class="flex-1 border border-gray-300 rounded p-2 flex items-center justify-center hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.486 2 2 6.486 2 12c0 5.514 4.486 10 10 10s10-4.486 10-10c0-5.514-4.486-10-10-10zm0 1.542c4.698 0 8.458 3.76 8.458 8.458 0 4.698-3.76 8.458-8.458 8.458-4.698 0-8.458-3.76-8.458-8.458 0-4.698 3.76-8.458 8.458-8.458zm0 0v3.542l3.542 3.542-3.542 3.542V10.084zm-5.542 5.542h3.542v1.542H6.458V9.084z" />
                    </svg>
                    Google
                </button>
            </div>

            <!-- Register Link -->
            <p class="text-center mt-4 text-sm">
                Bạn mới biết đến Shopee? <a href="#" id="toggleToRegister" class="text-[#EE4D2D] hover:underline">Đăng
                    ký</a>
            </p>
        </div>

        <!-- Right Section (Register Form) -->
        <div id="register-form" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" hidden>
            <h2 class="text-xl font-semibold mb-6">Đăng ký</h2>
            <div class="space-y-4">
                <input type="text" placeholder="Số điện thoại"
                    class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-[#EE4D2D]">

                <button class="w-full bg-[#FF6347] text-white rounded p-3 hover:bg-[#FF7F50] transition duration-150">
                    TIẾP THEO
                </button>
            </div>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-4 text-gray-500 text-sm">HOẶC</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Social Register Buttons -->
            <div class="flex justify-between space-x-4">
                <button
                    class="flex-1 border border-gray-300 rounded p-2 flex items-center justify-center hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    Facebook
                </button>
                <button
                    class="flex-1 border border-gray-300 rounded p-2 flex items-center justify-center hover:bg-gray-100 transition duration-150">
                    <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.486 2 2 6.486 2 12c0 5.514 4.486 10 10 10s10-4.486 10-10c0-5.514-4.486-10-10-10zm0 1.542c4.698 0 8.458 3.76 8.458 8.458 0 4.698-3.76 8.458-8.458 8.458-4.698 0-8.458-3.76-8.458-8.458 0-4.698 3.76-8.458 8.458-8.458zm0 0v3.542l3.542 3.542-3.542 3.542V10.084zm-5.542 5.542h3.542v1.542H6.458V9.084z" />
                    </svg>
                    Google
                </button>
            </div>

            <!-- Policy Text -->
            <p class="text-center text-xs text-gray-500 mt-4">
                Bằng việc đăng kí, bạn đồng ý với Shopee về<br>
                <a href="#" class="text-blue-500 hover:underline">Điều khoản dịch vụ</a> &
                <a href="#" class="text-blue-500 hover:underline">Chính sách bảo mật</a>
            </p>

            <!-- Toggle to Login -->
            <p class="text-center mt-4 text-sm">
                Bạn đã có tài khoản? <button id="toggleToLogin" class="text-[#EE4D2D] hover:underline">Đăng
                    nhập</button>
            </p>
        </div>
    </main>
    <script>
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const toggleToRegister = document.getElementById('toggleToRegister');
        const toggleToLogin = document.getElementById('toggleToLogin');

        toggleToRegister?.addEventListener('click', (e) => {
            e.preventDefault();
            loginForm.hidden = true;
            registerForm.hidden = false;
        });

        toggleToLogin?.addEventListener('click', (e) => {
            e.preventDefault();
            registerForm.hidden = true;
            loginForm.hidden = false;
        });
    </script>

</body>

</html>