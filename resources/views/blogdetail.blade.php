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
    <img src="{{ asset('img/banner1.jpg') }}" alt="Blog Detail" class="w-full h-[260px] md:h-[360px] object-cover">
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
        <img src="{{ asset('img/blog/' . $blog->image) }}" class="rounded-xl w-full h-56 object-cover mb-4" />
        <div class="flex items-center text-xs text-gray-500 gap-4 mb-3">
          <span><i class="fa fa-user mr-1"></i> {{ $blog->fullname }}</span>
          <span><i class="fa fa-comment mr-1"></i> 5 Bình luận</span>
          <span><i class="fa fa-calendar mr-1"></i>
            {{ \Carbon\Carbon::parse($blog->time_blog)->format(format: 'd/m/Y') }}</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $blog->title }}</h1>
        <p>{!! $blog->content !!}</p>
      </div>
      <!-- COMMENTS BLOCK -->
      <div class="bg-white rounded-xl shadow-md p-6 mb-7">
        <div>
          <div class="font-bold mb-5 text-gray-800 text-base">03 Bình luận</div>
          <!-- Bình luận -->
          @foreach ($commentBlogs as $commentBlog)
        <div class="flex items-start gap-3 mb-6">
        <img src="{{ asset('img/' . $commentBlog->avatar_comment) }}" class="w-12 h-12 rounded-full object-cover" />
        <div class="flex-1">
          <div class="font-semibold text-gray-700">{{ $commentBlog->name_comment }}</div>
          <div class="text-xs text-gray-400 mb-1">
          {{ \Carbon\Carbon::parse($blog->time_comment)->format(format: 'd/m/Y') }}</div>
          <div class="text-gray-600 text-sm mb-1">{{ $commentBlog->content_comment }}</div>
          <button class="text-orange-500 text-xs font-bold hover:underline">Trả lời</button>
        </div>
        </div>
      @endforeach
          <!-- Phân trang ảo -->
          <div class="flex gap-1 justify-center mt-5">
            <button
              class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&lt;</button>
            <button
              class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">1</button>
            <button
              class="w-8 h-8 flex items-center justify-center rounded-full border border-orange-500 text-orange-500 bg-orange-50 font-bold">2</button>
            <button
              class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">3</button>
            <button
              class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&gt;</button>
          </div>
        </div>
        <!-- Form bình luận -->
        <form class="mt-10 bg-orange-50 rounded-xl p-5">
          <div class="font-bold mb-2 text-gray-800">Để lại bình luận</div>
          <textarea placeholder="Nội dung bình luận"
            class="border border-gray-300 rounded px-3 py-2 w-full text-sm min-h-[70px] outline-orange-400"
            required></textarea>
          @if(session('user_logged_in'))
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-bold">
            Gửi bình luận
            </button>
          @else
          <p class="text-red-500 text-s">P/S: Vui lòng đăng nhập để được bình luận.</p>
            <button class="bg-gray-400 text-white px-6 py-2 rounded font-bold cursor-not-allowed" disabled>
            Gửi bình luận
            </button>
          @endif
        </form>
      </div>
    </div>
    <!-- SIDEBAR -->
    <div class="w-full md:w-80 flex-shrink-0 space-y-7 mt-7 md:mt-0">
      <div class="sticky top-6 space-y-7">
        <!-- Search -->
        <div class="bg-white rounded-xl shadow p-4">
          <form class="flex">
            <input type="text" placeholder="Tìm kiếm món BBQ..."
              class="flex-1 border border-gray-200 rounded-l-lg px-3 py-2 outline-none text-sm">
            <button class="bg-orange-500 text-white px-4 py-2 rounded-r-lg font-semibold text-sm">Tìm</button>
          </form>
        </div>
        <!-- Latest Post -->
        <div class="bg-white rounded-xl shadow p-4">
          <div class="font-bold mb-3 text-gray-800">Bài Viết Mới</div>
          <ul class="space-y-3">
            @foreach ($newBlogs as $newBlog)
        <li>
          <a href="{{ route('views.blogdetail', [$newBlog->id, $newBlog->slug]) }}" class="flex items-start gap-3">
          <img src="{{ asset('img/blog/' . $newBlog->image) }}" class="w-12 h-12 object-cover rounded" />
          <div>
            <div class="text-sm font-semibold">{{$newBlog->title }}</div>
            <div class="text-xs text-gray-400">
            {{ \Carbon\Carbon::parse($blog->created_at)->format(format: 'd/m/Y') }}</div>
          </div>
          </a>
        </li>
      @endforeach
          </ul>
        </div>
        <!-- Tags -->
        <div class="bg-white rounded-xl shadow p-4">
          <div class="font-bold mb-3 text-gray-800">Tags BBQ</div>
          <div class="flex flex-wrap gap-2">
            @foreach ($allTags as $allTag)
        <span class="bg-gray-100 px-2 py-0.5 rounded text-sm">{{ $allTag->type }}</span>
      @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('layouts.user.footer')
  <script src="https://kit.fontawesome.com/3f46e86e1a.js" crossorigin="anonymous"></script>
</body>

</html>