{{-- resources/views/emails/verify-email.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận Email</title>
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color: #333;">
    <h2>Chào bạn, {{ $name }}!</h2>
    <p>Bạn vừa đăng ký tài khoản trên hệ thống của chúng tôi.</p>
    <p>Vui lòng nhấn vào nút bên dưới để xác nhận Email (link chỉ có hiệu lực trong {{ $minutes }} giây):</p>
    <p style="margin: 20px 0;">
        <a href="{{ $verifyUrl }}" 
           style="display: inline-block; padding: 10px 20px; background-color: #FF3D3D; 
                  color: white; text-decoration: none; border-radius: 4px;">
            Xác nhận Email
        </a>
    </p>
    <p>Nếu bạn không gửi yêu cầu này, vui lòng bỏ qua email.</p>
    <br>
    <p>Trân trọng,<br>Đội ngũ phát triển</p>
</body>
</html>
