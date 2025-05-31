{{-- resources/views/auth-verify-result.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả xác nhận Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#1C1C1C] via-[#4A4A4A] to-[#000000] flex items-center justify-center min-h-screen text-white">
    <div class="bg-[#1C1C1C] p-8 rounded-lg shadow-lg max-w-md text-center">
        @if ($status === 'success')
            <h2 class="text-2xl font-bold text-green-400 mb-4">Xác nhận thành công!</h2>
            <p>{{ $message }}</p>
            <div class="mt-6">
                <a href="{{ route('auth.form') }}" class="inline-block bg-[#FF3D3D] text-white py-2 px-4 rounded hover:bg-[#FF6F61]">
                    Về trang đăng nhập
                </a>
            </div>
        @elseif ($status === 'expired')
            <h2 class="text-2xl font-bold text-yellow-400 mb-4">Link đã hết hạn!</h2>
            <p>{{ $message }}</p>
            <div class="mt-6">
                <a href="{{ route('auth.form') }}" class="inline-block bg-[#FF3D3D] text-white py-2 px-4 rounded hover:bg-[#FF6F61]">
                    Về trang đăng ký
                </a>
            </div>
        @elseif ($status === 'invalid')
            <h2 class="text-2xl font-bold text-red-400 mb-4">Link không hợp lệ!</h2>
            <p>{{ $message }}</p>
            <div class="mt-6">
                <a href="{{ route('auth.form') }}" class="inline-block bg-[#FF3D3D] text-white py-2 px-4 rounded hover:bg-[#FF6F61]">
                    Về trang đăng ký
                </a>
            </div>
        @endif
    </div>
</body>
</html>
