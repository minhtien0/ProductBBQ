    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        @foreach ($foods as $food)
                        <li><a href="#" class="flex items-center p-2 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors">
                            <i class="fas fa-meat mr-2"></i>
                           {{ $food->name }}
                        </a></li>
                        @endforeach
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
                                <div class="text-red-500 font-bold text-sm">{{ number_format($hotCombo->price, 0, ',', '.') }} VNĐ</div>
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
                                <div class="text-red-500 font-bold text-sm">{{ number_format($hotCombo->price, 0, ',', '.') }} VNĐ</div>
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
                                        <span class="text-2xl font-bold text-red-600">{{ number_format($combo->price, 0, ',', '.') }} VNĐ</span>
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">
                                        <i class="fas fa-tag mr-1"></i>
                                        Tiết kiệm {{ number_format($combo->total_price - $combo->price, 0, ',', '.') }} VNĐ so với mua lẻ
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
                                <button
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition-colors duration-300 flex items-center justify-center add-combo-to-cart"
                                    data-combo-id="{{ $combo->id }}"
                                >
                                    <i class="fas fa-cart-plus mr-2"></i>
                                    THÊM VÀO GIỎ HÀNG
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
                                       {{ number_format($food->price, 0, ',', '.') }} VNĐ
                                        
                                    </div>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>

                        <div id="custom-popup-overlay"
        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden p-4">
        <!-- Container chính -->
        <div id="custom-popup"
            class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-info-circle text-white"></i>
                        <span class="text-white font-semibold text-lg">Thông báo</span>
                    </div>
                    <button id="popup-close-btn"
                        class="text-white/80 hover:text-white hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Nội dung -->
            <div class="px-6 py-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-info text-blue-600 text-2xl"></i>
                </div>
                <div id="custom-popup-message" class="text-gray-800 text-base font-semibold mb-6">
                    <!-- Nội dung message sẽ được show ở đây -->
                </div>
                <button id="popup-ok-btn"
                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Đóng
                </button>
            </div>
        </div>
    </div>
                    <!-- Tổng giá trị -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Tổng giá trị nếu mua lẻ:</span>
                            <span class="font-semibold text-gray-800 line-through">{{ number_format($combo->total_price, 0, ',', '.') }} VNĐ</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-red-600 font-semibold">
                                Giá combo (tiết kiệm {{ number_format($combo->total_price - $combo->price, 0, ',', '.') }} VNĐ):
                            </span>
                            <span class="text-2xl font-bold text-red-600">{{ number_format($combo->price, 0, ',', '.') }} VNĐ</span>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Gắn sự kiện cho nút Thêm vào giỏ hàng
    document.querySelectorAll('.add-combo-to-cart').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const comboId = this.getAttribute('data-combo-id');
            // Gửi AJAX POST tới route thêm giỏ hàng (ví dụ: /cart/combo)
            fetch("{{ route('cart.storeComboCart') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    combo_id: comboId
                    // Các trường khác để backend tự xử (user_id qua session, food_id: null, type: null)
                })
            })
            .then(res => res.json())
            .then(data => {
                // Hiển thị popup thông báo
                showCustomPopup(data.message || (data.success ? "Đã thêm vào giỏ hàng!" : "Đã có lỗi!"));
            })
            .catch(error => {
                showCustomPopup("Lỗi kết nối hoặc lỗi hệ thống!");
                console.error(error);
            });
        });
    });

    // Xử lý popup show/hide
    function showCustomPopup(message) {
        document.getElementById('custom-popup-message').textContent = message;
        document.getElementById('custom-popup-overlay').classList.remove('hidden');
    }
    document.getElementById('popup-ok-btn').onclick =
    document.getElementById('popup-close-btn').onclick = function () {
        document.getElementById('custom-popup-overlay').classList.add('hidden');
    }
});

</script>
    </body>
    @include('layouts.user.footer')
    </html>
