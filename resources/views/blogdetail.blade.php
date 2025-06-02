<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUA BE HOY</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#1a1a1a',
                        'red-primary': '#e60012',
                        'red-hover': '#cc0010',
                        'gray-dark': '#333',
                        'gray-darker': '#444',
                        'gray-light': '#ccc',
                    },
                    fontFamily: {
                        mont: ['Montserrat', 'sans-serif'],
                    }
                },
            },
        };
    </script>
    </head>
    <body class="bg-gray-light font-mont">
@include('layouts.user.header')

<!-- HERO -->
<div class="relative w-full">
  <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
  <img src="img/banner1.jpg" alt="Blog Detail" class="w-full h-[260px] md:h-[360px] object-cover">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
  <!-- Content -->
  <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
    <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Blog Detail</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">BBQ Blog Detail</span>
    </div>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="max-w-6xl mx-auto py-8 px-4 flex flex-col md:flex-row gap-7">
  <!-- LEFT COLUMN: Blog + Bình luận -->
  <div class="flex-1 flex flex-col">
    <!-- BLOG CARD -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-7">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-xl w-full h-56 object-cover mb-4" />
      <div class="flex items-center text-xs text-gray-500 gap-4 mb-3">
        <span><i class="fa fa-user mr-1"></i> BBQ Master</span>
        <span><i class="fa fa-comment mr-1"></i> 5 Bình luận</span>
        <span><i class="fa fa-calendar mr-1"></i> 10/07/2024</span>
      </div>
      <h1 class="text-2xl font-bold text-gray-800 mb-2">5 Tuyệt Chiêu Tẩm Ướp Sườn Nướng BBQ Đậm Đà</h1>
      <p class="text-gray-700 mb-4">
        Để có một buổi tiệc nướng BBQ hoàn hảo, bí quyết nằm ở khâu tẩm ướp thịt. Cùng khám phá cách ướp sườn kiểu Mỹ chuẩn vị nhà hàng với sốt đặc biệt, kết hợp cùng nhiều loại gia vị hấp dẫn, giúp từng miếng thịt thấm đều và mềm ngon khó cưỡng.
      </p>
      <h2 class="text-lg font-bold text-gray-800 mb-2">1. Chọn nguyên liệu tươi, thịt nhiều vân mỡ</h2>
      <p class="text-gray-700 mb-3">
        Sườn heo, bò phải còn tươi, dày, nhiều vân mỡ sẽ giúp giữ ẩm khi nướng, miếng thịt không bị khô. Ướp kèm chút muối hồng và tiêu để giữ vị ngọt tự nhiên.
      </p>
      <ul class="mb-4 grid md:grid-cols-2 gap-2 text-gray-700">
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Sườn non tươi nhập mỗi ngày</li>
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Gia vị ướp chuẩn Mỹ</li>
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Sốt BBQ nhà làm</li>
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Đảm bảo vị mềm, mọng nước</li>
      </ul>
      <div class="grid md:grid-cols-2 gap-5 items-center mb-4">
        <img src="img/danhmuc1/suon.jpg"" class="rounded-lg w-full h-32 object-cover" />
        <div>
          <h3 class="text-base font-bold text-gray-800 mb-2">2. Kỹ thuật nướng than hồng</h3>
          <p class="text-gray-700 text-sm mb-1">Để sườn không bị cháy mà vẫn chín đều, hãy nướng ở nhiệt vừa, trở mặt thường xuyên và phết sốt BBQ liên tục để lớp ngoài bóng đẹp, thơm lừng.</p>
          <ul class="text-gray-700 text-sm">
            <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Không nướng lửa quá lớn</li>
            <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Luôn giữ ẩm thịt bằng sốt và bơ lạt</li>
          </ul>
        </div>
      </div>
      <h2 class="text-lg font-bold text-gray-800 mb-2">3. Salad và món ăn kèm tăng vị</h2>
      <p class="text-gray-700 mb-3">
        Đừng quên chuẩn bị salad, dưa leo muối hoặc khoai tây chiên để cân bằng vị ngấy và giúp bữa BBQ thêm trọn vẹn. Thêm một chút sốt chua cay sẽ làm nổi bật vị thịt nướng.
      </p>
      <ul class="mb-3 text-gray-700">
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Salad trộn rau củ tươi</li>
        <li class="flex items-center"><span class="text-orange-500 mr-2">✔</span> Khoai tây chiên giòn</li>
      </ul>
      <div class="text-gray-500 text-sm mt-6 flex flex-wrap gap-2 items-center">
        <span class="font-semibold">Tags:</span>
        <span class="bg-gray-100 px-2 py-0.5 rounded">BBQ</span>
        <span class="bg-gray-100 px-2 py-0.5 rounded">Grill</span>
        <span class="bg-gray-100 px-2 py-0.5 rounded">Sườn Nướng</span>
        <span class="bg-gray-100 px-2 py-0.5 rounded">Tiệc Ngoài Trời</span>
      </div>
      <div class="flex items-center gap-2 mt-3">
        <span class="font-semibold">Chia sẻ:</span>
        <a href="#" class="text-orange-500 hover:text-orange-700 text-xl"><i class="fab fa-facebook"></i></a>
        <a href="#" class="text-orange-500 hover:text-orange-700 text-xl"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-orange-500 hover:text-orange-700 text-xl"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <!-- COMMENTS BLOCK -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-7">
      <div>
        <div class="font-bold mb-5 text-gray-800 text-base">03 Bình luận</div>
        <!-- Bình luận 1 -->
        <div class="flex items-start gap-3 mb-6">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-12 h-12 rounded-full object-cover" />
          <div class="flex-1">
            <div class="font-semibold text-gray-700">Michel Holder</div>
            <div class="text-xs text-gray-400 mb-1">20/07/2024</div>
            <div class="text-gray-600 text-sm mb-1">Sườn nướng BBQ ngon xuất sắc, gia vị đậm đà, phục vụ nhanh. Rất hài lòng!</div>
            <button class="text-orange-500 text-xs font-bold hover:underline">Trả lời</button>
          </div>
        </div>
        <!-- Bình luận 2 -->
        <div class="flex items-start gap-3 mb-6">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-12 h-12 rounded-full object-cover" />
          <div class="flex-1">
            <div class="font-semibold text-gray-700">Selina Khan</div>
            <div class="text-xs text-gray-400 mb-1">19/07/2024</div>
            <div class="text-gray-600 text-sm mb-1">Không gian quán nướng rộng rãi, nhân viên dễ thương, nhất định sẽ quay lại!</div>
            <button class="text-orange-500 text-xs font-bold hover:underline">Trả lời</button>
          </div>
        </div>
        <!-- Bình luận 3 -->
        <div class="flex items-start gap-3 mb-6">
          <img src="https://randomuser.me/api/portraits/men/81.jpg" class="w-12 h-12 rounded-full object-cover" />
          <div class="flex-1">
            <div class="font-semibold text-gray-700">Moune Shtesia</div>
            <div class="text-xs text-gray-400 mb-1">18/07/2024</div>
            <div class="text-gray-600 text-sm mb-1">Đồ nướng đa dạng, món nào cũng ngon, đặc biệt là salad ăn kèm rất hợp!</div>
            <button class="text-orange-500 text-xs font-bold hover:underline">Trả lời</button>
          </div>
        </div>
        <!-- Phân trang ảo -->
        <div class="flex gap-1 justify-center mt-5">
          <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&lt;</button>
          <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">1</button>
          <button class="w-8 h-8 flex items-center justify-center rounded-full border border-orange-500 text-orange-500 bg-orange-50 font-bold">2</button>
          <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">3</button>
          <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&gt;</button>
        </div>
      </div>
      <!-- Form bình luận -->
      <form class="mt-10 bg-orange-50 rounded-xl p-5">
        <div class="font-bold mb-2 text-gray-800">Để lại bình luận</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
          <input type="text" placeholder="Tên của bạn" class="border border-gray-300 rounded px-3 py-2 text-sm outline-orange-400" required>
          <input type="email" placeholder="Email" class="border border-gray-300 rounded px-3 py-2 text-sm outline-orange-400" required>
        </div>
        <textarea placeholder="Nội dung bình luận" class="border border-gray-300 rounded px-3 py-2 w-full text-sm min-h-[70px] outline-orange-400 mb-4" required></textarea>
        <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-bold">Gửi bình luận</button>
      </form>
    </div>
  </div>
  <!-- SIDEBAR -->
  <div class="w-full md:w-80 flex-shrink-0 space-y-7 mt-7 md:mt-0">
    <div class="sticky top-6 space-y-7">
      <!-- Search -->
      <div class="bg-white rounded-xl shadow p-4">
        <form class="flex">
          <input type="text" placeholder="Tìm kiếm món BBQ..." class="flex-1 border border-gray-200 rounded-l-lg px-3 py-2 outline-none text-sm">
          <button class="bg-orange-500 text-white px-4 py-2 rounded-r-lg font-semibold text-sm">Tìm</button>
        </form>
      </div>
      <!-- Latest Post -->
      <div class="bg-white rounded-xl shadow p-4">
        <div class="font-bold mb-3 text-gray-800">Bài Viết Mới</div>
        <ul class="space-y-3">
          <li>
            <a href="#" class="flex items-start gap-3">
              <img src="img/combo/1.jpg" class="w-12 h-12 object-cover rounded" />
              <div>
                <div class="text-sm font-semibold">Sườn Nướng BBQ Đậm Đà Cho Ngày Hè</div>
                <div class="text-xs text-gray-400">20/07/2024</div>
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-start gap-3">
              <img src="img/combo/3.jpg" class="w-12 h-12 object-cover rounded" />
              <div>
                <div class="text-sm font-semibold">Bí Quyết Pha Sốt BBQ Cay Ngọt</div>
                <div class="text-xs text-gray-400">12/07/2024</div>
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-start gap-3">
              <img src="img/combo/4.jpg" class="w-12 h-12 object-cover rounded" />
              <div>
                <div class="text-sm font-semibold">Cách Ướp Thịt Bò BBQ Mềm Ngon</div>
                <div class="text-xs text-gray-400">05/07/2024</div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <!-- Categories -->
      <div class="bg-white rounded-xl shadow p-4">
        <div class="font-bold mb-3 text-gray-800">Chuyên Mục BBQ</div>
        <ul class="space-y-2">
          <li class="flex items-center justify-between">
            <span>Công Thức BBQ</span>
            <span class="bg-orange-100 text-orange-500 rounded px-2 py-0.5 text-xs">24</span>
          </li>
          <li class="flex items-center justify-between">
            <span>Món Nướng Ngoài Trời</span>
            <span class="bg-orange-100 text-orange-500 rounded px-2 py-0.5 text-xs">14</span>
          </li>
          <li class="flex items-center justify-between">
            <span>Gia Vị & Sốt</span>
            <span class="bg-orange-100 text-orange-500 rounded px-2 py-0.5 text-xs">11</span>
          </li>
          <li class="flex items-center justify-between">
            <span>Mẹo Vặt Nhà Bếp</span>
            <span class="bg-orange-100 text-orange-500 rounded px-2 py-0.5 text-xs">8</span>
          </li>
        </ul>
      </div>
      <!-- Tags -->
      <div class="bg-white rounded-xl shadow p-4">
        <div class="font-bold mb-3 text-gray-800">Tags BBQ</div>
        <div class="flex flex-wrap gap-2">
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">BBQ</span>
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">Grill</span>
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">Sườn Nướng</span>
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">Sốt BBQ</span>
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">Thịt Bò</span>
          <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">Món Ăn Kèm</span>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.user.footer')
<script src="https://kit.fontawesome.com/3f46e86e1a.js" crossorigin="anonymous"></script>
</body>
</html>
