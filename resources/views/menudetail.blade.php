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
                },
            },
        };
    </script>
    </head>
    <body>
    @include('layouts.user.header')
<body>
<div class="relative w-full">
  <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
  <img src="img/banner1.jpg" alt="Menu Detail" class="w-full h-[260px] md:h-[360px] object-cover">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
  <!-- Content -->
  <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
    <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Menu Detail</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">BBQ Menu Detail</span>
    </div>
  </div>
</div>
<!-- PHẦN 1: BBQ Menu Detail -->
<div class="bg-gray-light from-red-100 via-red to-white min-h-[160px] py-8 px-4">
  <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-8 -mt-4 relative z-10">
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Ảnh lớn và thumbnail -->
      <div class="md:w-1/3 flex flex-col">
        <img id="main-img" src="img/banner1.jpg" class="rounded-lg w-full h-[220px] object-cover mb-4 border-2 border-orange-400" />
        <div class="flex gap-2">
          <img onclick="document.getElementById('main-img').src=this.src" src="img/danhmuc1/suonxe.jpg" class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
          <img onclick="document.getElementById('main-img').src=this.src" src="img/danhmuc1/suon.jpg" class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
          <img onclick="document.getElementById('main-img').src=this.src" src="img/danhmuc1/suontang.jpg" class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
          <img onclick="document.getElementById('main-img').src=this.src" src="img/danhmuc1/suon6mon.jpg" class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
        </div>
      </div>
      <!-- Chi tiết món ăn -->
      <div class="md:w-2/3">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">BBQ Sườn Nướng Đặc Biệt</h2>
        <div class="flex items-center gap-3 mb-2">
          <span class="text-xl font-bold text-orange-600">$250.000</span>
          <span class="text-xs bg-orange-100 text-orange-500 rounded px-2 py-0.5 font-semibold">Best Seller</span>
        </div>
        <p class="text-gray-600 mb-4">Sườn nướng BBQ mềm ngọt, ướp sốt đặc biệt theo công thức độc quyền, nướng trên than hồng cho lớp ngoài cháy xém hấp dẫn, bên trong đậm đà, thơm lừng. Ăn kèm salad tươi và khoai tây chiên giòn.</p>
        
        <!-- Lựa chọn size -->
        <div class="mb-3">
          <label class="block font-semibold mb-1 text-gray-700">Chọn Phần:</label>
          <div class="flex gap-4">
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500" checked> Nhỏ
            </label>
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500"> Vừa
            </label>
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500"> Lớn
            </label>
          </div>
        </div>
        <!-- Lựa chọn thêm -->
        <div class="mb-3">
          <label class="block font-semibold mb-1 text-gray-700">Chọn Thêm:</label>
          <div class="flex gap-4 flex-wrap">
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Phô Mai Nướng
            </label>
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Xúc Xích Nướng
            </label>
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Thêm Rau Củ
            </label>
          </div>
        </div>
        <!-- Quantity & Button -->
        <div class="flex items-center gap-3 mb-3">
          <label class="font-semibold text-gray-700">Số Lượng:</label>
          <input type="number" min="1" value="1" class="w-16 border rounded px-2 py-1 text-center">
          <span class="text-lg font-bold text-orange-700">$250.000</span>
        </div>
        <div class="flex gap-3 mt-4">
          <button class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg font-bold shadow">Thêm Vào Giỏ</button>
          <button class="bg-orange-100 text-orange-700 px-5 py-2 rounded-lg font-bold border border-orange-400">Yêu Thích</button>
        </div>
      </div>
    </div>
    <!-- Tab mô tả / review -->
    <div class="mt-10">
      <div class="flex gap-2 border-b mb-5">
        <button class="px-4 py-2 border-b-2 border-orange-500 text-orange-600 font-bold">Mô Tả</button>
        <button class="px-4 py-2 text-gray-600">Đánh Giá</button>
      </div>
      <div>
        <p class="text-gray-700 mb-3">
          Thưởng thức sườn nướng BBQ theo phong cách Mỹ - vị ngọt tự nhiên, thấm đẫm sốt BBQ đậm đà, chín mềm, kết hợp hoàn hảo với salad tươi và khoai tây chiên.
        </p>
        <ul class="grid md:grid-cols-2 gap-3 text-gray-600 text-sm mb-3">
          <li class="flex items-center gap-2"><span class="text-orange-500">✔</span> Sườn tươi, nhập mới mỗi ngày</li>
          <li class="flex items-center gap-2"><span class="text-orange-500">✔</span> Sốt BBQ nhà làm độc quyền</li>
          <li class="flex items-center gap-2"><span class="text-orange-500">✔</span> Nướng than hồng, không dầu mỡ</li>
          <li class="flex items-center gap-2"><span class="text-orange-500">✔</span> Phục vụ kèm salad và khoai tây chiên</li>
        </ul>
        <p class="text-gray-700 text-sm">
          Món ăn phù hợp cho mọi buổi tiệc, họp mặt bạn bè, gia đình. Đặt ngay để trải nghiệm vị ngon khó cưỡng từ nhà hàng BBQ chúng tôi!
        </p>
      </div>
    </div>
  </div>
</div>

<!-- PHẦN 2: Related BBQ Items -->
<div class="bg-dark-light max-w-6xl mx-auto py-8 px-4 ">
  <h3 class="text-xl font-bold mb-4 text-gray-800">Món Nướng Gợi Ý</h3>
  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
    <!-- Card 1 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/3.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Gà Xiên Que Nướng</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">-10%</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐☆</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$90.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/1.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Ba Chỉ Bò Mỹ Nướng</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Best Seller</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$220.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/4.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Combo Nướng Đặc Biệt</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Combo</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$450.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
  </div>
  </div>
</body>

@include('layouts.user.footer')
</html>
