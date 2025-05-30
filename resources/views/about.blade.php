<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUA BE HOY</title>
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
                    },
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
  .w-\[190px\], .h-\[190px\] { width: 110px !important; height: 110px !important;}
  .w-16, .h-16 { width: 46px !important; height: 46px !important;}
  .rounded-\[45px\] { border-radius: 20px !important;}
  .rounded-\[40px\] { border-radius: 18px !important;}
}
</style>
@include('layouts.user.header')
<body>
    <!-- banner -->
     <section>
     <div class="relative w-full">
  <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
  <img src="img/banner1.jpg" alt="About Us" class="w-full h-[260px] md:h-[360px] object-cover">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
  <!-- Content -->
  <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
    <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">About Us</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">About Us</span>
    </div>
  </div>
</div>
     </section>
     <!-- about -->
      <section><div class="flex flex-col lg:flex-row gap-14 items-center max-w-7xl mx-auto px-4 py-12 bg-white">
  <!-- Left: Hình ảnh và Info -->
  <div class="relative flex-shrink-0 w-full lg:w-[420px]">
    <div class="rounded-[45px] overflow-hidden shadow-2xl border-8 border-white">
      <img src="img/mtien.jpg" alt="Chef" class="object-cover w-full h-[400px] lg:h-[520px]">
    </div>
    <!-- Vòng tròn năm kinh nghiệm -->
    <div class="absolute top-4 right-[-54px] bg-[#ff8000] text-white rounded-full w-[190px] h-[190px] flex flex-col items-center justify-center border-8 border-white shadow-lg
      text-center text-3xl font-extrabold" style="font-family:Montserrat,sans-serif;">
      <div>12+</div>
      <div class="text-base font-normal mt-1" style="font-family:Poppins,sans-serif;">Years<br>Experience</div>
    </div>
    <!-- Quote Box -->
    <div class="absolute left-3 bottom-[-40px] bg-[#262248] text-white rounded-[40px] px-8 py-7  w-[95%] shadow-xl border-4 border-white
      " style="font-family:Poppins,sans-serif;">
      <div class="text-lg leading-relaxed">Tình Yêu Không Cần TIền Bạc Nhưng Chứng Minh Tình Yêu Thì Cần...</div>
      <div class="text-[#ff8000] font-bold text-xl text-right mt-2 italic" style="font-family:Montserrat,sans-serif;">MR.Tiến</div>
    </div>
  </div>
  <!-- Right: Nội dung -->
  <div class="flex-1 pt-24 lg:pt-0">
    <div class="flex items-center gap-2 mb-3">
      <span class="text-[#ff8000] text-2xl font-extrabold italic" style="font-family:Montserrat,sans-serif;">About Company</span>
      <img src="https://cdn-icons-png.flaticon.com/128/3792/3792085.png" class="w-10 h-7" alt="" />
    </div>
    <h2 class="text-[#262248] font-extrabold text-3xl md:text-5xl mb-3" style="font-family:Montserrat,sans-serif;">Helathy Foods Provider</h2>
    <p class="text-[#565656] text-lg mb-8" style="font-family:Poppins,sans-serif;">
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate aspernatur molestiae minima pariatur consequatur voluptate sapiente deleniti soluta,.
    </p>
    <!-- Features List -->
    <div class="flex flex-col gap-8">
      <div class="flex items-start gap-5">
        <img src="https://cdn-icons-png.flaticon.com/128/4772/4772411.png" class="w-16 h-16" alt="">
        <div>
          <div class="text-[#262248] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">Trusted Partner</div>
          <div class="text-[#565656] text-base" style="font-family:Poppins,sans-serif;">
            Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Minus, Officiis Placeat Iusto Quasi Adipisci Impedit Delectus Beatae Ab Maxime.
          </div>
        </div>
      </div>
      <div class="flex items-start gap-5">
        <img src="https://cdn-icons-png.flaticon.com/128/4772/4772411.png" class="w-16 h-16" alt="">
        <div>
          <div class="text-[#262248] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">First Delivery</div>
          <div class="text-[#565656] text-base" style="font-family:Poppins,sans-serif;">
            Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Minus, Officiis Placeat Iusto Quasi Adipisci Impedit Delectus Beatae Ab Maxime.
          </div>
        </div>
      </div>
      <div class="flex items-start gap-5">
        <img src="https://cdn-icons-png.flaticon.com/128/4772/4772411.png" class="w-16 h-16" alt="">
        <div>
          <div class="text-[#262248] font-extrabold text-2xl" style="font-family:Montserrat,sans-serif;">Secure Payment</div>
          <div class="text-[#565656] text-base" style="font-family:Poppins,sans-serif;">
            Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Minus, Officiis Placeat Iusto Quasi Adipisci Impedit Delectus Beatae Ab Maxime.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- vision -->
 <section>
 <div class="flex flex-col lg:flex-row bg-[#f4faf3] min-h-screen w-full">
  <!-- Trái: Vision, Mission, Goals -->
  <div class="flex-1 flex flex-col justify-center gap-8 px-4 py-12 md:pl-16 md:py-16 z-10">
    <!-- Item -->
    <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-2xl">
      <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
        <!-- Target SVG icon -->
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="2"/><path stroke="currentColor" stroke-width="2" d="M12 2v2M12 20v2M22 12h-2M4 12H2M16.24 7.76l1.42-1.42M7.76 16.24l-1.42 1.42M16.24 16.24l1.42 1.42M7.76 7.76l-1.42-1.42"/><circle cx="12" cy="12" r="2" fill="currentColor"/></svg>
      </div>
      <div>
        <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Vision</div>
        <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab corporis perspiciatis voluptatum odit.
        </div>
      </div>
    </div>
    <!-- Item -->
    <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-3xl">
      <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
        <!-- Bulb SVG icon -->
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18h6M10 22h4M12 2v2M4.22 4.22l1.42 1.42M1 12h2M20.78 4.22l-1.42 1.42M23 12h-2M12 22a7 7 0 1 0-7-7c0 3.87 3.13 7 7 7Z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="15" r="1" fill="currentColor"/></svg>
      </div>
      <div>
        <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Mission</div>
        <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab corporis perspiciatis voluptatum odit.
        </div>
      </div>
    </div>
    <!-- Item -->
    <div class="flex items-center gap-6 bg-[#262248] rounded-xl px-6 py-8 shadow-lg max-w-2xl">
      <div class="bg-[#ff8000] rounded-xl flex items-center justify-center w-20 h-20 min-w-[80px] min-h-[80px]">
        <!-- Diamond SVG icon -->
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 2 7 12 22 22 7 12 2" stroke="currentColor" stroke-width="2" fill="none"/><polyline points="2 7 12 13 22 7" stroke="currentColor" stroke-width="2"/></svg>
      </div>
      <div>
        <div class="text-white text-3xl font-extrabold mb-1" style="font-family:Montserrat,sans-serif;">Goals</div>
        <div class="text-white text-lg" style="font-family:Poppins,sans-serif;">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab corporis perspiciatis voluptatum odit.
        </div>
      </div>
    </div>
  </div>
  <!-- Phải: Hình ảnh & overlay X -->
  <div class="relative flex-1 flex items-center justify-center min-h-[480px]">
    <div class="relative w-full h-[400px] md:w-[600px] md:h-[600px] lg:h-[680px]">
      <img src="img/banner2.jpg" 
           class="w-full h-full object-cover rounded-[4px] shadow-xl" alt="restaurant" />
      <!-- X overlay effect -->
      <div class="absolute inset-0 pointer-events-none">
        <svg width="100%" height="100%" viewBox="0 0 600 600" class="w-full h-full">
          <rect x="0" y="0" width="600" height="600" fill="none"/>
          <rect x="-80" y="240" width="760" height="32" rx="12" fill="#e9f9f2" transform="rotate(45 300 300)" />
          <rect x="-80" y="328" width="760" height="32" rx="12" fill="#e9f9f2" transform="rotate(-45 300 300)" />
        </svg>
        <!-- Các hình vuông cam để trang trí góc -->
        <div class="absolute left-[-48px] top-[-48px] w-32 h-32 bg-[#ff8000] rotate-45 z-10"></div>
        <div class="absolute right-[-48px] bottom-[-48px] w-32 h-32 bg-[#ff8000] rotate-45 z-10"></div>
      </div>
    </div>
  </div>
</div>
 </section>
</body>
@include('layouts.user.footer')
</html>