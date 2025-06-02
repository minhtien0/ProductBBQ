<!DOCTYPE html>
<html lang="vi">
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
            'main-red': '#ff7c09',
            'main-red':'#e60012',
          },
          fontFamily: {
            mont: ['Montserrat', 'sans-serif'],
          }
        },
      },
    };
  </script>
</head>
<body class="bg-gray-light min-h-screen font-mont">
    @include('layouts.user.header')
    <!-- Banner -->
    <div class="relative w-full">
        <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
        <img src="img/banner1.jpg" alt="Blog" class="w-full h-[260px] md:h-[360px] object-cover">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Blog</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">Blog</span>
            </div>
        </div>
    </div>

    <!-- Blog Cards Grid -->
    <div class="max-w-6xl mx-auto px-3 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Blog Card -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog1.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Food</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/mtien.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">Moni Islam</p>
                        <p class="text-gray-400 text-xs">1 May, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Operates Approximately 400 Restaurants</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Voluptate sapiente deserunt accusantium...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
            <!-- Repeat Card -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span
                        class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Restaurant</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/hdong.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">John Deo</p>
                        <p class="text-gray-400 text-xs">6 June, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Introducing Our New Summer Menu!</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit. Vivamus commodo...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
            <!-- Repeat Card -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog2.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Event</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/mtien.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">Jakia Talma</p>
                        <p class="text-gray-400 text-xs">28 Apr, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Summer Water Rose + Bubbly Rose is Here!</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Laboriosam, nobis...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
            <!-- Card Row 2 -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog3.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Party</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/mtien.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">Isret Sultana</p>
                        <p class="text-gray-400 text-xs">3 May, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Tender Fried Baby Squid With A Salt, Pepper</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Voluptate sapiente deserunt accusantium...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog2.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Event</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/mtien.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">Jakia Talma</p>
                        <p class="text-gray-400 text-xs">28 Apr, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Summer Water Rose + Bubbly Rose is Here!</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Laboriosam, nobis...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col">
                <div class="relative">
                    <img src="img/blog/blog3.jpg" alt="" class="rounded-lg w-full h-36 md:h-44 object-cover" />
                    <span class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">Party</span>
                </div>
                <div class="flex items-center mt-3 mb-2 gap-2">
                    <img src="img/mtien.jpg" alt=""
                        class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                    <div>
                        <p class="font-semibold text-xs text-[#22223b] leading-tight">Isret Sultana</p>
                        <p class="text-gray-400 text-xs">3 May, 2023</p>
                    </div>
                </div>
                <h3 class="font-semibold text-base mb-1 line-clamp-2">Tender Fried Baby Squid With A Salt, Pepper</h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Voluptate sapiente deserunt accusantium...</p>
                <div class="flex justify-between items-center mt-auto text-xs">
                    <a href="#" class="text-[#22223b] hover:text-[#e60012] font-medium">Read More <i
                            class="fa fa-arrow-right text-[10px]"></i></a>
                    <div class="flex items-center gap-1 text-gray-400">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span class="ml-1 text-[#e60012]">120</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center mt-10">
            <nav class="flex gap-2">
                <button
                    class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition"><i
                        class="fa fa-angle-left"></i></button>
                <button
                    class="w-8 h-8 rounded-full border text-[#e60012] border-[#e60012] font-semibold hover:bg-[#e60012] hover:text-white transition">1</button>
                <button
                    class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition">2</button>
                <button
                    class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition">3</button>
                <button
                    class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition"><i
                        class="fa fa-angle-right"></i></button>
            </nav>
        </div>
    </div>
</body>
@include('layouts.user.footer')

</html>