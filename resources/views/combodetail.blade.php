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
                            'main-red': '#e60012',
                            'main-red-dark': '#E55A2B'
                        },
                        fontFamily: {
                            mont: ['Montserrat', 'sans-serif'],
                        }
                    },
                },
            };
        </script>
    </head>

    <body class="bg-gray-light text-[#22223b] font-mont">
        @include('layouts.user.header')

        <!-- Banner -->
        <div class="relative w-full">
            <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
            <img src="img/banner1.jpg" alt="Menu" class="w-full h-[260px] md:h-[360px] object-cover">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
            <!-- Content -->
            <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
                <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Thực Đơn Combo</h1>
                <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                    <i class="fa fa-home text-white"></i>
                    <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
                    <span class="text-white">–</span>
                    <span class="text-[#ff8000]">Thực Đơn Combo</span>
                </div>
            </div>
        </div>

    <div class="py-6 min-h-screen">
    <div class="container mx-auto px-2 flex flex-col lg:flex-row gap-6">
        <!-- Sidebar (bạn có thể thay dữ liệu tĩnh hoặc sau này truyền từ controller) -->
        <aside class="w-full lg:w-1/4 flex-shrink-0">
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <h3 class="font-bold text-red-600 mb-3 text-lg">SẢN PHẨM</h3>
            <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:text-red-600">THỊT BÒ MỸ NHẬP KHẨU</a></li>
            <li><a href="#" class="hover:text-red-600">SET NƯỚNG - LẨU</a></li>
            </ul>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <h3 class="font-bold text-red-600 mb-3 text-lg">DANH BÁN CHẠY</h3>
            <ul class="space-y-3">
            <li class="flex gap-2">
                <img src="img/combo/1.jpg" class="w-16 h-16 object-cover rounded-lg border">
                <div>
                <a href="#" class="font-semibold hover:text-red-600 block text-sm">Combo Gỗ Sồi Mỹ</a>
                <div class="text-red-500 text-xs font-bold">148,000₫</div>
                </div>
            </li>
            </ul>
        </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1">
        <!-- Combo Info -->
        <div class="bg-white rounded-xl shadow p-4 flex flex-col md:flex-row gap-6">
            <div class="flex-1">
            <img id="main-image" src="{{ asset('img/'.$combo->image) }}" alt="{{ $combo->name }}" class="w-full h-60 md:h-80 object-cover rounded-xl mb-4 shadow-lg transition-all duration-300">
            <!-- Nếu có nhiều hình combo thì thêm ảnh nhỏ phía dưới ở đây -->
            </div>
            <div class="flex-1 flex flex-col justify-between">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-red-700 mb-2">{{ $combo->name }}</h1>
                <div class="text-lg font-semibold mb-1">Giá bán: <span class="text-red-600 text-xl">{{ number_format($combo->price,0,',','.') }}₫</span></div>
                <div class="mb-2">
                <span class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Còn hàng</span>
                </div>
                <div class="mb-4">
                <button id="add-to-cart" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-xl shadow inline-block">Thêm vào giỏ hàng</button>
                </div>
                <ul class="text-gray-700 text-sm mb-4">
                <li><b>Mã sản phẩm:</b> {{ $combo->codecombo }}</li>
                <li><b>Ghi chú:</b> {{ $combo->note }}</li>
                </ul>
            </div>
            </div>
        </div>

        <!-- Thông tin sản phẩm và danh sách món trong combo -->
        <div class="bg-white rounded-xl shadow p-4 mt-6">
            <h2 class="text-lg font-bold text-red-600 mb-2">THÔNG TIN SẢN PHẨM</h2>
            <div class="mb-3 text-gray-800">
            {{ $combo->note }}
            </div>
            <h3 class="text-base font-semibold mb-2">Danh sách món trong combo:</h3>
            <ul class="list-disc pl-6">
            @foreach($foods as $food)
                <li>
                <span class="font-bold">{{ $food->name }}</span>
                @if(isset($food->price)) - <span class="text-sm text-gray-600">{{ number_format($food->price, 0, ',', '.') }}₫</span> @endif
                </li>
            @endforeach
            </ul>
        </div>
        <!-- Bình luận Facebook -->
        <div class="bg-white rounded-xl shadow p-4 mt-6">
            <h2 class="text-lg font-bold text-red-600 mb-2">Ý KIẾN KHÁCH HÀNG</h2>
            <div>
            <div id="fb-comments">
                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5"></div>
            </div>
            </div>
        </div>
        </main>
    </div>
    </div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"></script>
    <script>
    // Toast thông báo thêm vào giỏ hàng
    const addToCartBtn = document.getElementById('add-to-cart');
    if(addToCartBtn){
        addToCartBtn.addEventListener('click', function(){
        alert('Đã thêm vào giỏ hàng!');
        });
    }
    </script>
    </body>
    @include('layouts.user.footer')
    </html>
