<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LỬA BÉ HOY</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
            'main-red': '#ff7c09',
            'main-red': '#e60012',
          },
          fontFamily: {
            mont: ['Montserrat', 'sans-serif'],
          }
        },
      },
    };
  </script>
</head>
<style>
  /* about */
  @media (max-width: 1024px) {
    .absolute.left-0.bottom-\[\-40px\] {
      position: static !important;
      width: 100% !important;
      margin-top: 18px !important;
      margin-bottom: 10px !important;
    }

    .absolute.top-4.right-\[\-54px\] {
      position: static !important;
      margin: 18px auto 14px auto !important;
      display: flex !important;
      justify-content: center !important;
      width: 140px !important;
      height: 140px !important;
    }
  }

  @media (max-width: 640px) {

    .w-\[190px\],
    .h-\[190px\] {
      width: 110px !important;
      height: 110px !important;
    }

    .w-16,
    .h-16 {
      width: 46px !important;
      height: 46px !important;
    }

    .rounded-\[45px\] {
      border-radius: 20px !important;
    }

    .rounded-\[40px\] {
      border-radius: 18px !important;
    }
  }
</style>

<body class="font-mont bg-gray-light">
  <!-- Header (giả định giữ nguyên từ layout) -->
  @include('layouts.user.header')
  <!-- banner -->
  <section>
    <div class="relative w-full">
      <!-- Background image (thay src thành ảnh BBQ nếu cần) -->
      <img src="img/banner1.jpg" alt="About Us" class="w-full h-[260px] md:h-[360px] object-cover">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
      <!-- Content -->
      <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
        <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Thông Tin</h1>
        <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
          <i class="fa fa-home text-white"></i>
          <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
          <span class="text-white">–</span>
          <span class="text-[#ff8000]">Thông Tin</span>
        </div>
      </div>
    </div>
  </section>
  <!-- about -->
  <section>
    <div class="flex flex-col lg:flex-row gap-14 items-center max-w-7xl mx-auto px-4 py-12 bg-gray-light">
      <!-- Left: Hình ảnh và Info -->
      <div class="relative flex-shrink-0 w-full lg:w-[420px]">
        <div class="rounded-[45px] overflow-hidden shadow-2xl border-8 border-white">
          <img src="img/mtien.jpg" alt="BBQ Chef" class="object-cover w-full h-[400px] lg:h-[520px]">
        </div>
        <!-- Vòng tròn năm kinh nghiệm -->
        <div class="absolute top-4 right-[-54px] bg-[#ff8000] text-white rounded-full w-[190px] h-[190px] flex flex-col items-center justify-center border-8 border-white shadow-lg
          text-center text-3xl font-extrabold" style="font-family:Montserrat,sans-serif;">
          <div>10+</div>
          <div class="text-base font-normal mt-1" style="font-family:Poppins,sans-serif;">Years<br>BBQ Mastery</div>
        </div>
        <!-- Quote Box -->
        <div class="absolute left-3 bottom-[-40px] bg-[#262248] text-white rounded-[40px] px-8 py-7 w-[95%] shadow-xl border-4 border-white
          " style="font-family:Poppins,sans-serif;">
          <div class="text-lg leading-relaxed">Hương vị BBQ là ngọn lửa của đam mê và tình yêu với ẩm thực!</div>
          <div class="text-[#ff8000] font-bold text-xl text-right mt-2 italic"
            style="font-family:Montserrat,sans-serif;">Đầu Bếp Tiến</div>
        </div>
      </div>
      <!-- Right: Nội dung -->
      <div class="flex-1 pt-24 lg:pt-0">
        <div class="flex items-center gap-2 mb-3">
          <span class="text-[#fff] text-2xl font-extrabold italic" style="font-family:Montserrat,sans-serif;">THÔNG TIN
            VỀ LỬA BÉ HOY</span>
          <img src="https://cdn-icons-png.flaticon.com/128/3792/3792085.png" class="w-10 h-7" alt="" />
        </div>
        <h2 class="text-[#C20000] font-extrabold text-3xl md:text-5xl mb-3" style="font-family:Montserrat,sans-serif;">
          Trải nghiệm BBQ đích thực</h2>
        <p class="text-[#fff] text-lg mb-8" style="font-family:Poppins,sans-serif;">
          LỬA BÉ HOY là nơi hội tụ tinh hoa BBQ, mang đến những món nướng đậm đà hương vị từ thịt bò thượng hạng, sườn
          heo mật ong, và hải sản tươi sống. Với hơn 10 năm kinh nghiệm, chúng tôi cam kết phục vụ thực khách bằng ngọn
          lửa đam mê và nguyên liệu chất lượng cao.
        </p>
        <!-- Features List -->
        <div class="flex flex-col gap-8">
          <div class="flex items-start gap-5">
            <img src="img/bbq2.png" class="w-16 h-16" alt="">
            <div>
              <div class="text-[#C20000] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">
                Thành phần cao cấp</div>
              <div class="text-[#fff] text-base" style="font-family:Poppins,sans-serif;">
                Chúng tôi chỉ sử dụng thịt bò Wagyu, gà hữu cơ, và rau củ theo mùa để đảm bảo chất lượng vượt trội cho
                từng món nướng.
              </div>
            </div>
          </div>
          <div class="flex items-start gap-5">
            <img src="img/bbq1.jpg" class="w-16 h-16" alt="">
            <div>
              <div class="text-[#C20000] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">Trải nghiệm
                nướng trực tiếp</div>
              <div class="text-[#fff] text-base" style="font-family:Poppins,sans-serif;">
                Thưởng thức BBQ ngay tại bàn với đầu bếp nướng trực tiếp, mang đến sự tươi mới và ấm cúng.
              </div>
            </div>
          </div>
          <div class="flex items-start gap-5">
            <img src="img/bbq3.png" class="w-16 h-16" alt="">
            <div>
              <div class="text-[#C20000] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">
                Nước sốt BBQ tùy chỉnh</div>
              <div class="text-[#fff] text-base" style="font-family:Poppins,sans-serif;">
                Tận hưởng các loại sốt BBQ độc quyền như sốt cay ớt, sốt ngọt dứa, và sốt tỏi rang tự pha chế.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- vision -->
  <section>
    <div class="flex flex-col lg:flex-row bg-gray-light min-h-screen w-full">
      <!-- Trái: Vision, Mission, Goals -->
      <div class="flex-1 flex flex-col justify-center gap-8 px-4 py-12 md:pl-16 md:py-16 z-10">
        <!-- Item -->
        <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-2xl">
          <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
            <!-- Target SVG icon -->
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2" />
              <path stroke="currentColor" stroke-width="2"
                d="M12 2v2M12 20v2M22 12h-2M4 12H2M16.24 7.76l1.42-1.42M7.76 16.24l-1.42 1.42M16.24 16.24l1.42 1.42M7.76 7.76l-1.42-1.42" />
              <circle cx="12" cy="12" r="2" fill="currentColor" />
            </svg>
          </div>
          <div>
            <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Tầm nhìn
            </div>
            <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
              Trở thành thương hiệu BBQ hàng đầu, lan tỏa hương vị nướng truyền thống đến mọi gia đình Việt Nam.
            </div>
          </div>
        </div>
        <!-- Item -->
        <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-3xl">
          <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
            <!-- Bulb SVG icon -->
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M9 18h6M10 22h4M12 2v2M4.22 4.22l1.42 1.42M1 12h2M20.78 4.22l-1.42 1.42M23 12h-2M12 22a7 7 0 1 0-7-7c0 3.87 3.13 7 7 7Z"
                stroke="currentColor" stroke-width="2" />
              <circle cx="12" cy="15" r="1" fill="currentColor" />
            </svg>
          </div>
          <div>
            <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Nhiệm vụ
            </div>
            <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
              Mang đến trải nghiệm BBQ đậm đà, an toàn, và thân thiện với môi trường bằng cách sử dụng nguyên liệu địa
              phương.
            </div>
          </div>
        </div>
        <!-- Item -->
        <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-2xl">
          <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
            <!-- Diamond SVG icon -->
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polygon points="12 2 2 7 12 22 22 7 12 2" stroke="currentColor" stroke-width="2" fill="none" />
              <polyline points="2 7 12 13 22 7" stroke="currentColor" stroke-width="2" />
            </svg>
          </div>
          <div>
            <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Thành tựu
            </div>
            <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
              Đạt 100.000 khách hàng hài lòng và mở rộng 5 chi nhánh mới vào năm 2027.
            </div>
          </div>
        </div>
      </div>
      <!-- Slide quảng cáo -->
      <div class="relative w-full max-w-3xl mx-auto my-8 pt-[65px] pr-10">
        <div class="swiper mySwiper h-[500px] lg:h-[545px] w-full rounded-lg shadow-lg overflow-hidden flex-1">
          <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative aspect-[16/7] sm:aspect-[16/6] md:aspect-[16/5]">
              <img src="img/banner1.jpg" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide relative aspect-[16/7] sm:aspect-[16/6] md:aspect-[16/5]">
              <img src="img/banner2.jpg" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide relative aspect-[16/7] sm:aspect-[16/6] md:aspect-[16/5]">
              <img src="img/logo2.jpg" class="w-full h-full object-cover" alt="Slide 3">
            </div>
          </div>
          <!-- Nút điều hướng -->
          <div class="swiper-button-next text-white hidden"></div>
          <div class="swiper-button-prev text-white hidden"></div>
          <!-- Pagination -->
          <div class="swiper-pagination !bottom-2 hidden    "></div>
        </div>
      </div>


    </div>
  </section>
  <section class="max-w-7xl mx-auto px-4 py-16 flex flex-col lg:flex-row gap-10 items-start">
    <!-- LEFT: Text + Service Cards -->
    <div class="flex-1">
      <div class="mb-2 text-lg font-bold text-[#ff8200] flex items-center gap-2">
        <span>Why Choose Us</span>
        <span class="text-xl">🌱</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-[#292953] mb-3">
        Tại sao LỬA BÉ HOY lại nổi bật</h2>
      <p class="mb-7 text-gray-600 max-w-xl">
        LỬA BÉ HOY cam kết mang đến hương vị BBQ đích thực với sự tận tâm trong từng món nướng. Từ nguyên liệu tươi ngon
        đến kỹ thuật nướng độc đáo, chúng tôi tạo nên trải nghiệm ẩm thực khó quên.
      </p>
      <!-- Service Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Card 1 -->
        <div class="flex items-start gap-4 bg-[#f3f2fa] rounded-xl p-4">
          <div
            class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ff8200] flex items-center justify-center text-white text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M4 6h16M4 10h16M4 14h16M4 18h16" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg text-[#292953]">Thực Phẩm Tươi Sống</h3>
            <p class="text-gray-500 text-[15px] mt-1">Chỉ sử dụng thịt tươi sống nướng ngay tại chỗ để đảm bảo hương vị
              tự nhiên.</p>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="flex items-start gap-4 bg-[#f3f2fa] rounded-xl p-4">
          <div
            class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ff8200] flex items-center justify-center text-white text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 7v4m4-4v4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg text-[#292953]">Trải Nghiệm Trực Tiếp</h3>
            <p class="text-gray-500 text-[15px] mt-1">Thưởng thức quá trình nướng trực tiếp với đầu bếp chuyên nghiệp.
            </p>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="flex items-start gap-4 bg-[#f3f2fa] rounded-xl p-4">
          <div
            class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ff8200] flex items-center justify-center text-white text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M13 16h-1v-4h-1m2 4v2m-2-2v2M6 6h.01M18 6h.01M12 6h.01" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg text-[#292953]">Hương Vị Đích Thực</h3>
            <p class="text-gray-500 text-[15px] mt-1">Giữ nguyên hương vị truyền thống với các loại sốt BBQ thủ công.
            </p>
          </div>
        </div>
        <!-- Card 4 -->
        <div class="flex items-start gap-4 bg-[#f3f2fa] rounded-xl p-4">
          <div
            class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ff8200] flex items-center justify-center text-white text-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M17 20h5v-2a2 2 0 00-2-2h-3v-2a2 2 0 00-2-2h-2a2 2 0 00-2 2v2h-3a2 2 0 00-2 2v2h5"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg text-[#292953]">Open Daily</h3>
            <p class="text-gray-500 text-[15px] mt-1">Phục vụ BBQ từ 10:00 đến 22:00 mỗi ngày, kể cả lễ Tết.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- RIGHT: Images Grid -->
    <div class="w-full lg:w-[350px] pt-16  flex flex-col gap-3">
      <div class="grid grid-cols-2 gap-3">
        <img src="img/blog/blog.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Meats">
        <img src="img/blog/blog2.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Grilling">
      </div>
      <div class="grid grid-cols-2 gap-3">
        <img src="img/blog/blog1.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Chef">
        <img src="img/blog/blog3.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Event">
      </div>
      <div class="grid grid-cols-2 gap-3">
        <img src="img/blog/blog5.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Chef">
        <img src="img/blog/blog4.jpg" class="rounded-xl h-28 w-full object-cover" alt="BBQ Event">
      </div>
    </div>
  </section>

  <!-- COUNTER -->
  <section class="py-10 bg-cover bg-center relative" style="background-image:url('img/logo2.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative max-w-5xl mx-auto flex flex-wrap justify-between items-center gap-3 z-10 px-2">
      <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
        <div
          class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
          <span class="counter font-bold text-white text-2xl md:text-3xl" data-to="{{ $countUser }}">0</span><span
            class="font-bold text-white text-2xl md:text-3xl">+</span>
        </div>
        <div class="text-white text-xs mt-2">Khách Hàng</div>
      </div>
      <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
        <div
          class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
          <span class="counter font-bold text-white text-2xl md:text-3xl" data-to="{{ $countStaff }}">0</span><span
            class="font-bold text-white text-2xl md:text-3xl">+</span>
        </div>
        <div class="text-white text-xs mt-2">Nhân Viên</div>
      </div>
      <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
        <div
          class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
          <span class="counter font-bold text-white text-2xl md:text-3xl" data-to="{{ $countRate }}">0</span><span
            class="font-bold text-white text-2xl md:text-3xl">+</span>
        </div>
        <div class="text-white text-xs mt-2">Đánh Giá</div>
      </div>
      <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
        <div
          class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
          <span class="counter font-bold text-white text-2xl md:text-3xl" data-to="5">2</span><span
            class="font-bold text-white text-2xl md:text-3xl ml-2"> Yoe</span>
        </div>
        <div class="text-white text-xs mt-2">Kinh Nghiệm</div>
      </div>
    </div>
  </section>

  <!-- BLOG -->
  <section class="py-8 md:py-12 bg-gray-light">
    <div class="max-w-5xl mx-auto px-2">
      <div class="flex items-center justify-between mb-2">
        <div>
          <div class="text-orange-500 font-bold text-sm">Tin Tức & Thông Tin <i class="fa-solid fa-seedling"></i></div>
          <div class="text-xl md:text-2xl font-bold mb-2">Tin Tức Mới Nhất</div>
        </div>
        <div class="flex gap-2">
          <button
            class="swiper-button-prev-blog w-8 h-8 rounded-full bg-orange-100 hover:bg-orange-200 flex items-center justify-center text-orange-600"><i
              class="fa-solid fa-arrow-left"></i></button>
          <button
            class="swiper-button-next-blog w-8 h-8 rounded-full bg-orange-100 hover:bg-orange-200 flex items-center justify-center text-orange-600"><i
              class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>
      <div class="swiper blogSwiper">
        <div class="swiper-wrapper">
          <!-- Blog  -->
          @foreach ($newBlogs as $newBlog)
        <div class="swiper-slide">
        <div class="bg-white rounded-2xl shadow p-3 h-[370px] relative flex flex-col">
          <a href="{{ route('views.blogdetail', [$newBlog->id_blog, $newBlog->slug]) }}">
          <img src="{{ asset('img/blog/' . $newBlog->image) }}" class="w-full h-40 object-cover rounded-lg mb-2"
            alt="">
          </a>
          <div class="flex items-center gap-2 mb-2">
          <img src="{{ asset('img/' . $newBlog->avata) }}" class="w-7 h-7 rounded-full border-2 border-white"
            alt="">
          <span class="text-xs text-gray-600 font-semibold">{{ $newBlog->fullname }}</span>
          </div>
          <div class="text-base font-bold mb-1">{{ $newBlog->title }}</div>
          <div class="flex-1"></div>
          <!-- Badge absolute góc phải -->
          <span
          class="absolute right-3 bottom-3 bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs font-bold z-10">
          {{ $newBlog->type_blog }}
          </span>
          <!-- Đọc Thêm là chữ nhỏ góc trái -->
          <a href="{{ route('views.blogdetail', [$newBlog->id_blog, $newBlog->slug]) }}"
          class="absolute left-3 bottom-3 text-orange-500 text-xs font-bold hover:underline flex items-center gap-1">
          Đọc Thêm <i class="fa-solid fa-arrow-right text-[10px] pt-1"></i>
          </a>
        </div>
        </div>

      @endforeach

          <!-- Thêm slide mới tùy ý -->
        </div>
        <div class="swiper-pagination-blog mt-3 hidden"></div>
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    //slide quảng cáo
    document.addEventListener("DOMContentLoaded", function () {
      new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    });
    // Testimonial slider
    new Swiper('.testiSwiper', {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next-testi',
        prevEl: '.swiper-button-prev-testi',
      },
      pagination: {
        el: '.swiper-pagination-testi',
        clickable: true,
      },
      breakpoints: {
        768: { slidesPerView: 2, spaceBetween: 24 }
      }
    });

    // Blog slider
    new Swiper('.blogSwiper', {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next-blog',
        prevEl: '.swiper-button-prev-blog',
      },
      pagination: {
        el: '.swiper-pagination-blog',
        clickable: true,
      },
      breakpoints: {
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
      }
    });

    // COUNTER EFFECT
    function animateCounter(el) {
      const to = +el.dataset.to;
      let current = 0, inc = Math.ceil(to / 50);
      function update() {
        current += inc;
        if (current >= to) {
          el.textContent = to.toLocaleString();
        } else {
          el.textContent = current.toLocaleString();
          requestAnimationFrame(update);
        }
      }
      update();
    }
    document.querySelectorAll('.counter').forEach(el => animateCounter(el));
  </script>
</body>
@include('layouts.user.footer')

</html>