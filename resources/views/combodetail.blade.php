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
            <img src="{{ asset('img/banner1.jpg') }}" alt="Menu" class="w-full h-[260px] md:h-[360px] object-cover">
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
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Danh mục sản phẩm -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="font-bold text-red-600 mb-4 text-lg flex items-center">
                        <i class="fas fa-list-ul mr-2"></i>
                        DANH MỤC SẢN PHẨM
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="flex items-center p-2 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                            <i class="fas fa-meat mr-2"></i>
                            THỊT BÒ MỸ NHẬP KHẨU
                        </a></li>
                        <li><a href="#" class="flex items-center p-2 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                            <i class="fas fa-fire mr-2"></i>
                            SET NƯỚNG - LẨU
                        </a></li>
                    </ul>
                </div>

                <!-- Sản phẩm bán chạy -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="font-bold text-red-600 mb-4 text-lg flex items-center">
                        <i class="fas fa-star mr-2"></i>
                        BÁN CHẠY NHẤT
                    </h3>
                    <div class="space-y-4">
                        @foreach ($hotCombos as $hotCombo)
                        
                       
                        <div class="flex gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors bg-gray-400">
                            <img src="{{ asset('img/combo/'. $hotCombo->image) }}" class="w-12 h-12 object-cover rounded-lg border">
                            <div class="flex-1">
                                <a href="#" class="font-semibold hover:text-red-600 block text-sm mb-1">{{  $hotCombo->name }}</a>
                                <div class="text-red-500 font-bold text-sm">{{  $hotCombo->price}}₫</div>
                            </div>
                        </div>
                         @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="font-bold text-red-600 mb-4 text-lg flex items-center">
                        <i class="fas fa-star mr-2"></i>
                        Combo Tương Tự
                    </h3>
                    <div class="space-y-4">
                        @foreach ($hotCombos as $hotCombo)
                        
                       
                        <div class="flex gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors bg-gray-400">
                            <img src="{{ asset('img/combo/'. $hotCombo->image) }}" class="w-12 h-12 object-cover rounded-lg border">
                            <div class="flex-1">
                                <a href="{{ route('views.combodetail',$hotCombo->id) }}" class="font-semibold hover:text-red-600 block text-sm mb-1">{{  $hotCombo->name }}</a>
                                <div class="text-red-500 font-bold text-sm">{{  $hotCombo->price}}₫</div>
                            </div>
                        </div>
                         @endforeach
                    </div>
                </div>
            </aside>

            <!-- Main content -->
            <main class="lg:col-span-3">
                <!-- Hero Section - Thông tin chính của combo -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <!-- Hình ảnh sản phẩm -->
                        <div class="relative">
                            <div class="absolute top-4 left-4 z-10">
                                <span class="product-badge text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-fire mr-1"></i>
                                    {{  $combo->codecombo}}
                                </span>
                            </div>
                            <img id="main-image" src="{{ asset('img/combo/'. $combo->image) }}" alt="Combo Name" 
                                 class="w-full h-80 object-cover rounded-xl shadow-lg">
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="flex flex-col justify-between">
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">{{  $combo->name }}</h1>
                                
                                <!-- Giá và thông tin cơ bản -->
                                <div class="price-highlight rounded-xl  mb-4">
                                    <div class="flex items-center ">
                                        <span class="text-gray-700 font-semibold mr-3">Giá combo:</span>
                                        <span class="text-2xl font-bold text-red-600">{{  $combo->price}}₫</span>
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-tag mr-1"></i>
                                        Tiết kiệm {{ number_format($combo->total_price - $combo->price, 0, ',', '.') }}₫ so với mua lẻ
                                    </div>
                                </div>

                                <!-- Thông tin chi tiết -->
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-barcode text-gray-500 w-5 mr-3"></i>
                                        <span class="text-gray-600">Mã sản phẩm:</span>
                                        <span class="font-semibold ml-2">{{  $combo->codecombo}}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-users text-gray-500 w-5 mr-3"></i>
                                        <span class="text-gray-600">Phù hợp cho:</span>
                                        <span class="font-semibold ml-2">4-6 người</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-gray-500 w-5 mr-3"></i>
                                        <span class="text-gray-600">Thời gian chuẩn bị:</span>
                                        <span class="font-semibold ml-2">15-20 phút</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Call to action -->
                            <div class="space-y-3">
                                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition-colors duration-300 flex items-center justify-center">
                                    <i class="fas fa-cart-plus mr-2"></i>
                                    THÊM VÀO GIỎ HÀNG
                                </button>
                                <button class="w-full border-2 border-red-600 text-red-600 hover:bg-red-50 font-semibold py-3 px-6 rounded-xl transition-colors duration-300 flex items-center justify-center">
                                    <i class="fas fa-phone mr-2"></i>
                                    GỌI ĐẶT HÀNG: 0123.456.789
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mô tả combo -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-bold text-red-600 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        MÔ TẢ COMBO
                    </h2>
                    <div class="text-gray-700 leading-relaxed">
                        {!! $combo->note !!}
                    </div>
                </div>

                <!-- Danh sách món ăn trong combo -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-red-600 mb-6 flex items-center">
                        <i class="fas fa-utensils mr-2"></i>
                        DANH SÁCH MÓN ĂN TRONG COMBO
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($foods as $food)
                        
                        
                        <div class="combo-card border border-gray-200 rounded-xl p-4 hover:border-red-300">
                            <div class="flex items-center gap-4">
                                
                                <img src="{{ asset('img/'.$food->image) }}" alt="Thịt bò nướng" class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <a href="{{ route('views.menudetail',[$food->id,$food->slug]) }}">
                                    <h3 class="font-bold text-gray-800 mb-1">{{ $food->name }}</h3>
                                    <div class="flex justify-between items-center">
                                        <span class="text-red-600 font-semibold">{{ $food->price }}₫</span>
                                        
                                    </div>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tổng giá trị -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Tổng giá trị nếu mua lẻ:</span>
                            <span class="font-semibold text-gray-800 line-through">{{ $combo->total_price }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-red-600 font-semibold">
                                Giá combo (tiết kiệm {{ number_format($combo->total_price - $combo->price, 0, ',', '.') }}₫):
                            </span>
                            <span class="text-2xl font-bold text-red-600">{{ $combo->price }}₫</span>
                        </div>
                        <div class="text-center mt-3">
                            @php
                                $percent = 0;
                                if ($combo->total_price > 0) {
                                    $percent = (($combo->total_price - $combo->price) / $combo->total_price) * 100;
                                }
                            @endphp

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-percentage mr-1"></i>
                                Tiết kiệm {{ number_format($percent, 1) }}%
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    </body>
    @include('layouts.user.footer')
    </html>
