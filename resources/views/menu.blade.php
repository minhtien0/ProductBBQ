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
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Giới hạn 3 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.5rem;
            max-height: 4.5rem;
            /* 1.5rem x 3 dòng */
        }
    </style>
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
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Thực Đơn Đặc Biệt</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">Thực Đơn</span>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold text-center mb-2">Thực Đơn Hôm Nay</h1>
            <p class="text-center text-orange-100">Khám phá những món ăn ngon nhất của chúng tôi</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Menu Categories with Enhanced Design -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Danh Mục Món Ăn</h2>
                <div id="menu-categories" class="flex flex-wrap justify-center gap-3">
                    <!-- Nút "Tất Cả" luôn có -->
                    <button data-cat="all" class="category-tab
            {{ (request('category', 'all') == 'all') ? 'bg-gradient-to-r from-main-red to-red-500 text-white' : 'bg-white text-gray-700 border-2 border-gray-200' }}
            px-6 py-3 rounded-full font-semibold shadow-lg transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-utensils mr-2"></i> Tất Cả
                    </button>
                    @foreach ($menus as $menu)
                        @php
                            $menuCat = 'menu-' . $menu->id;
                            $isActive = request('category', 'all') == $menuCat;
                        @endphp
                        <button data-cat="{{ $menuCat }}"
                            class="category-tab
                                                                            {{ $isActive ? 'bg-gradient-to-r from-main-red to-red-500 text-white' : 'bg-white text-gray-700 border-2 border-gray-200' }}
                                                                            px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                            {{-- icon --}}
                            @if(stripos($menu->name, 'BBQ') !== false)
                                <i class="fas fa-star mr-2"></i>
                            @elseif(stripos($menu->name, 'khai vị') !== false)
                                <i class="fas fa-leaf mr-2"></i>
                            @elseif(stripos($menu->name, 'đồ uống') !== false)
                                <i class="fas fa-glass-cheers mr-2"></i>
                            @elseif(stripos($menu->name, 'tráng miệng') !== false)
                                <i class="fas fa-ice-cream mr-2"></i>
                            @else
                                <i class="fas fa-utensils mr-2"></i>
                            @endif
                            {{ $menu->name }}
                        </button>
                    @endforeach
                </div>


            </div>
        </div>

        <!-- Advanced Filter/Search Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <form id="ajax-search-form" class="flex-1 relative flex" onsubmit="return false;">
                        <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                            placeholder="Tìm kiếm món ăn yêu thích..."
                            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700 placeholder-gray-400">
                        <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </form>


                    <!-- Price Range Filter -->
                    <div class="lg:w-64">
                        <select id="price-filter"
                            class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700">
                            <option value="">Tất cả mức giá</option>
                            <option value="low">Dưới 100.000đ</option>
                            <option value="medium">100.000đ - 300.000đ</option>
                            <option value="high">Trên 300.000đ</option>
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div class="lg:w-64">
                        <select id="sort-filter"
                            class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700">
                            <option value="default">Sắp xếp mặc định</option>
                            <option value="price-asc">Giá: Thấp → Cao</option>
                            <option value="price-desc">Giá: Cao → Thấp</option>
                            <option value="name-asc">Tên: A → Z</option>
                            <option value="rating">Đánh giá cao nhất</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <button id="search-btn"
                        class="px-8 py-4 bg-gradient-to-r from-main-red to-red-500 text-white font-semibold rounded-xl hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-search mr-2"></i>Tìm Kiếm
                    </button>
                </div>
            </div>
        </div>

        <!-- Results Info -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Kết quả tìm kiếm</h3>
                <p class="text-gray-600" id="results-count">Hiển thị 4 trong tổng số 4 món ăn</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <button id="grid-view" class="p-2 bg-main-red text-white rounded-lg">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button id="list-view"
                        class="p-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div id="products-container" class="mb-8">
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($foods as $food)
                    <div class="food-item flex flex-col h-full max-w-[500px] min-w-[300px] w-full bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden"
                        style="height:620px;" data-category="menu-{{ $food->type }}" data-price="{{ $food->price }}"
                        data-name="{{ strtolower($food->name) }}" @if(isset($food->popular) && $food->popular)
                        data-popular="true" @endif @if(isset($food->new) && $food->new) data-new="true" @endif
                        @if(isset($food->discount) && $food->discount) data-discount="true" @endif
                        @if(isset($food->vegetarian) && $food->vegetarian) data-vegetarian="true" @endif>
                        <div class="relative overflow-hidden" style="height:240px;">
                            <a href="{{ route('views.menudetail', [$food->id, $food->slug]) }}"> <img
                                    src="{{ asset('img/' . $food->image) }}" alt="{{ $food->name }}"
                                    class="w-full h-56 object-cover border-b border-gray-100" />
                                <div class="absolute top-3 left-3 z-10">
                                    <span
                                        class="bg-main-red text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">
                                        {{ optional($menus->firstWhere('id', $food->type))->name ?? '' }}
                                    </span>
                                </div>
                            </a>
                            <div class="absolute top-3 right-3 z-10">
                                <button data-food-id="{{ $food->id }}"
                                    class=" favorite-btn icon-btn {{ in_array($food->id, $favIds) ? 'text-red-500' : 'text-gray-500' }} w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center  hover:text-red-500 transition-colors">
                                    <i
                                        class="{{ in_array($food->id, $favIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }} text-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- PHẦN CHỈNH SỬA: -->
                        <div class="flex flex-col flex-1 p-6">
                            <a href="{{ route('views.menudetail', [$food->id, $food->slug]) }}">
                                <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $food->name }}
                                </h3>
                            </a>
                            <p class="text-gray-600 text-sm mt-4 line-clamp-2"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {!! $food->description !!}
                            </p>
                            <!-- spacer tự động đẩy đánh giá + nút xuống đáy -->
                            <div class="flex-1"></div>
                            <div class="flex flex-col">
                                @php
                                    $rateInfo = $foodRatings[$food->id] ?? null;
                                    $avgRate = $rateInfo ? round($rateInfo->avg_rate, 1) : 0;
                                    $countRate = $rateInfo ? $rateInfo->count_rate : 0;
                                @endphp

                                <div class="flex items-center min-h-[28px] mb-2">
                                    <div class="flex text-yellow-400 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($avgRate >= $i)
                                                <i class="fas fa-star"></i>
                                            @elseif ($avgRate >= ($i - 0.5))
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-gray-500 text-sm">({{ $avgRate }})</span>
                                    <span class="ml-2 text-gray-400 text-sm">• {{ $countRate }} đánh giá</span>
                                </div>
                                <span class="text-2xl font-bold text-main-red mb-2">
                                    {{ number_format($food->price, 0, ',', '.') }}đ
                                </span>
                                <div class="flex gap-2">
                                    <button type="button"
                                        class="add-to-cart flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]"
                                        data-food-id="{{ $food->id }}" data-quantity="1">
                                        <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ Hàng
                                    </button>
                                    <button
                                        class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                        <a href="{{ route('views.menudetail', [$food->id, $food->slug]) }}"><i
                                                class="fa-regular fa-eye"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- HẾT PHẦN CHỈNH SỬA -->
                    </div>
                @endforeach
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-main-red"></div>
                <p class="text-gray-600 mt-2">Đang tải...</p>
            </div>

            <!-- No Results -->
            <div id="no-results" class="hidden text-center py-16">
                <div class="text-6xl text-gray-300 mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Không tìm thấy món ăn phù hợp</h3>
                <p class="text-gray-500">Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc</p>
            </div>
        </div>


        <!-- Enhanced Pagination -->

        <div id="products-pagination" class="flex items-center gap-2 justify-center mt-4"></div>

    </div>


    </div>
    <!-- Popup overlay -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DOM Elements
            const priceFilter = document.getElementById('price-filter');
            const sortFilter = document.getElementById('sort-filter');
            const productsGrid = document.getElementById('products-grid');
            const resultsCount = document.getElementById('results-count');
            const quickFilters = document.querySelectorAll('.quick-filter');
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');
            const searchInput = document.getElementById('search-input');
            const categoryTabs = document.querySelectorAll('.category-tab');
            let currentCategory = document.querySelector('input[name="category"]')?.value || 'all';


            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    // Xử lý active tab...
                    categoryTabs.forEach(t => {
                        t.classList.remove('bg-gradient-to-r', 'from-main-red', 'to-red-500', 'text-white');
                        t.classList.add('bg-white', 'text-gray-700', 'border-2', 'border-gray-200');
                    });
                    this.classList.remove('bg-white', 'text-gray-700', 'border-2', 'border-gray-200');
                    this.classList.add('bg-gradient-to-r', 'from-main-red', 'to-red-500', 'text-white');
                    currentCategory = this.getAttribute('data-cat') || 'all';

                    // Gọi AJAX lấy sản phẩm
                    fetchFoodsByAjax(() => {
                        // Sau khi load xong, chạy filter + sort ngay
                        sortItems();
                        filterItems();
                        bindAddToCartEvents();
                        bindFavoriteEvents();
                    });
                });
            });
            function bindAddToCartEvents() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                document.querySelectorAll('.add-to-cart').forEach(btn => {
                    btn.onclick = async function () {
                        const foodId = this.dataset.foodId;
                        try {
                            const res = await fetch("{{ route('cart.add') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: JSON.stringify({ food_id: foodId, quantity: 1 })
                            });
                            const data = await res.json();
                            if (res.ok && data.success) {
                                showPopup(data.message);
                            } else {
                                showPopup(data.message || data.error || 'Có lỗi xảy ra');
                            }
                        } catch (err) {
                            showPopup('Lỗi kết nối');
                        }
                    };
                });
                // Popup script
                const overlay = document.getElementById('custom-popup-overlay');
                document.getElementById('popup-ok-btn').onclick = () => overlay.classList.add('hidden');
                document.getElementById('popup-close-btn').onclick = () => overlay.classList.add('hidden');
                overlay.onclick = function (e) {
                    if (e.target === overlay) overlay.classList.add('hidden');
                };
                function showPopup(message) {
                    document.getElementById('custom-popup-message').textContent = message;
                    document.getElementById('custom-popup-overlay').classList.remove('hidden');
                }
            }

            function bindFavoriteEvents() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                document.querySelectorAll('.favorite-btn').forEach(btn => {
                    btn.onclick = async function () {
                        const foodId = this.dataset.foodId;
                        try {
                            const res = await fetch("{{ route('favorite.toggle') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                body: JSON.stringify({ food_id: foodId })
                            });
                            const data = await res.json();
                            if (res.ok && data.success) {
                                if (data.favorited) {
                                    this.innerHTML = '<i class="fa-solid fa-heart"></i>';
                                    this.classList.add('text-red-500');
                                    this.classList.remove('text-gray-500');
                                } else {
                                    this.innerHTML = '<i class="fa-regular fa-heart"></i>';
                                    this.classList.remove('text-red-500');
                                    this.classList.add('text-gray-500');
                                }
                                showPopup(data.message);
                            } else {
                                showPopup(data.message || 'Có lỗi xảy ra');
                            }
                        } catch (err) {
                            showPopup('Lỗi kết nối');
                        }
                    };
                });
                // Popup script
                const overlay = document.getElementById('custom-popup-overlay');
                document.getElementById('popup-ok-btn').onclick = () => overlay.classList.add('hidden');
                document.getElementById('popup-close-btn').onclick = () => overlay.classList.add('hidden');
                overlay.onclick = function (e) {
                    if (e.target === overlay) overlay.classList.add('hidden');
                };
                function showPopup(message) {
                    document.getElementById('custom-popup-message').textContent = message;
                    document.getElementById('custom-popup-overlay').classList.remove('hidden');
                }
            }

            function fetchFoodsByAjax(callback) {
                const searchTerm = searchInput.value.trim();
                const priceValue = priceFilter.value;
                const sortValue = sortFilter.value;
                let quickFilterValues = [];
                quickFilters.forEach(qf => {
                    if (qf.classList.contains('bg-main-red')) quickFilterValues.push(qf.dataset.filter);
                });

                // Build query string
                let url = `{{ route('food.menu.search') }}?category=${encodeURIComponent(currentCategory)}`;
                if (searchTerm) url += `&term=${encodeURIComponent(searchTerm)}`;
                if (priceValue) url += `&price=${encodeURIComponent(priceValue)}`;
                if (sortValue) url += `&sort=${encodeURIComponent(sortValue)}`;
                if (quickFilterValues.length > 0) url += `&quick=${quickFilterValues.join(',')}`;

                productsGrid.innerHTML = `<div class="col-span-full text-center text-gray-400 py-12 text-lg">Đang tải...</div>`;

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (data.results && data.results.length > 0) {
                            console.log(data.results);
                            const html = data.results.map(food => `
                    <div class="food-item flex flex-col h-full max-w-[450px] min-w-[260px] w-full bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden"
                        style="height:550px;"
                        data-category="menu-${food.type}"
                        data-price="${food.price}"
                        data-name="${food.name.toLowerCase()}"
                    >
                        <div class="relative overflow-hidden" style="height:200px;">
                            <img src="${food.image}" alt="${food.name}"
                                class="w-full h-44 object-cover border-b border-gray-100" />
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-main-red text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">
                                    ${food.menu_name ?? ''}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <button data-food-id="${food.id}"
                                 class="favorite-btn icon-btn ${food.favorited ? 'text-red-500' : 'text-gray-500'}  w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center  hover:text-red-500 transition-colors">
                                <i class="${food.favorited ? 'fa-solid fa-heart' : 'fa-regular fa-heart'} text-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4 flex flex-col flex-1 mt-[-1.5rem]">
                            <h3 class="font-bold text-lg text-gray-800 mb-2"
                                style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                ${food.name}
                            </h3>
                            <p class="text-gray-600 text-sm mt-4"
                                style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                ${food.description}
                            </p>
                            <div class="flex items-center mb-3 min-h-[28px]">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                                <span class="ml-2 text-gray-400 text-sm">• 124 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between mb-2 min-h-[30px]">
                                <span class="text-2xl font-bold text-main-red">
                                    ${new Intl.NumberFormat('vi-VN').format(food.price)}đ
                                </span>
                            </div>
                            <div class="mt-auto flex gap-2">
                                <button type="button"
                                        class="add-to-cart flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]"
                                        data-food-id=" ${food.id}" data-quantity="1">
                                        
                                        <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ Hàng
                                    </button>
                                <button
                                        class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                        <a href="/menudetail/${food.id}/${food.slug}"><i
                                                class="fa-regular fa-eye"></i></a>
                                    </button>
                            </div>
                        </div>
                    </div>
                `).join('');
                            console.log({{ $food->id }});
                            productsGrid.innerHTML = html;
                            reapplyFilterSortAndEvents();
                            resultsCount.textContent = `Hiển thị ${data.results.length} món ăn`;
                        } else {
                            productsGrid.innerHTML = `<div class="col-span-full text-center text-gray-500 py-12 text-lg">Không tìm thấy món ăn nào phù hợp.</div>`;
                            resultsCount.textContent = `Hiển thị 0 món ăn`;
                        }
                    })
                    .catch(() => {
                        productsGrid.innerHTML = `<div class="col-span-full text-center text-red-500 py-12 text-lg">Có lỗi xảy ra, vui lòng thử lại.</div>`;
                    });
            }

            // ------ MAIN FUNCTIONS ------

            // Lọc món ăn theo giá, bộ lọc nhanh
            function filterItems() {
                const foodItems = productsGrid.querySelectorAll('.food-item');
                const priceRange = priceFilter.value;
                const activeQuickFilters = Array.from(quickFilters)
                    .filter(f => f.classList.contains('bg-main-red'))
                    .map(f => f.dataset.filter);
                let visibleCount = 0;
                foodItems.forEach(item => {
                    const itemPrice = parseInt(item.dataset.price || 0);
                    let priceMatch = true;
                    if (priceRange === 'low') priceMatch = itemPrice < 100000;
                    else if (priceRange === 'medium') priceMatch = (itemPrice >= 100000 && itemPrice <= 300000);
                    else if (priceRange === 'high') priceMatch = itemPrice > 300000;

                    // Quick filter (các data-[filter] được render đúng phía blade)
                    let quickFilterMatch = activeQuickFilters.length === 0 ||
                        activeQuickFilters.some(filter => item.dataset[filter] === 'true');

                    if (priceMatch && quickFilterMatch) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                resultsCount.textContent = `Hiển thị ${visibleCount} trong tổng số ${foodItems.length} món ăn`;
            }

            // Sắp xếp món ăn
            function sortItems() {
                const sortOption = sortFilter.value;
                const foodItems = Array.from(productsGrid.querySelectorAll('.food-item'));
                let sortedArray = foodItems;
                if (sortOption === 'price-asc') {
                    sortedArray = foodItems.sort((a, b) => parseInt(a.dataset.price) - parseInt(b.dataset.price));
                } else if (sortOption === 'price-desc') {
                    sortedArray = foodItems.sort((a, b) => parseInt(b.dataset.price) - parseInt(a.dataset.price));
                } else if (sortOption === 'name-asc') {
                    sortedArray = foodItems.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
                } else if (sortOption === 'rating') {
                    // Bạn phải bổ sung data-rating khi render món ăn nếu muốn sắp theo rating
                    sortedArray = foodItems.sort((a, b) => {
                        const ra = parseFloat(a.dataset.rating || 0);
                        const rb = parseFloat(b.dataset.rating || 0);
                        return rb - ra;
                    });
                }
                productsGrid.innerHTML = '';
                sortedArray.forEach(item => productsGrid.appendChild(item));
            }

            // Sau khi render lại món ăn (AJAX), cần gán lại các event cho quick filter, v.v.
            function rebindEventsForNewItems() {
                // Gán lại sự kiện cho quick filter
                document.querySelectorAll('.quick-filter').forEach(filter => {
                    filter.onclick = function () {
                        this.classList.toggle('bg-main-red');
                        this.classList.toggle('text-white');
                        this.classList.toggle('bg-gray-100');
                        this.classList.toggle('text-gray-700');
                        filterItems();
                    };
                });
                // Nếu có thể đổi grid/list thì cũng giữ nguyên
            }

            // Kết hợp lại
            function reapplyFilterSortAndEvents() {
                sortItems();
                filterItems();

                bindAddToCartEvents();    // <--- Thêm dòng này
                bindFavoriteEvents();     // <--- Thêm dòng này
                rebindEventsForNewItems();
            }

            // ------ EVENT LISTENERS ------

            priceFilter.addEventListener('change', function () {
                filterItems();
            });

            sortFilter.addEventListener('change', function () {
                sortItems();
                filterItems();
            });

            quickFilters.forEach(filter => {
                filter.addEventListener('click', function () {
                    this.classList.toggle('bg-main-red');
                    this.classList.toggle('text-white');
                    this.classList.toggle('bg-gray-100');
                    this.classList.toggle('text-gray-700');
                    filterItems();
                });
            });

            gridView.addEventListener('click', function () {
                productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
                this.classList.add('bg-main-red', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-600');
                listView.classList.remove('bg-main-red', 'text-white');
                listView.classList.add('bg-gray-200', 'text-gray-600');
            });

            listView.addEventListener('click', function () {
                productsGrid.className = 'grid grid-cols-1 gap-6';
                this.classList.add('bg-main-red', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-600');
                gridView.classList.remove('bg-main-red', 'text-white');
                gridView.classList.add('bg-gray-200', 'text-gray-600');
            });

            // ------ SEARCH AJAX ------

            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim();
                const category = document.querySelector('input[name="category"]')?.value || 'all';
                if (!keyword) {
                    // Có thể reload lại sản phẩm mặc định nếu muốn
                    // Hoặc gọi lại filter/sort cho danh sách hiện tại
                    reapplyFilterSortAndEvents();
                    return;
                }

                fetch(`{{ route('food.menu.search') }}?term=${encodeURIComponent(keyword)}&category=${encodeURIComponent(category)}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        if (data.results && data.results.length > 0) {
                            console.log(data.results);
                            html = data.results.map(food => `
                            
                            <div class="food-item flex flex-col h-full max-w-[450px] min-w-[260px] w-full bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden"
                                style="height:550px;"
                                data-category="menu-${food.type}"
                                data-price="${food.price}"
                                data-name="${food.name.toLowerCase()}"
                                ${food.popular ? 'data-popular="true"' : ''}
                                ${food.new ? 'data-new="true"' : ''}
                                ${food.discount ? 'data-discount="true"' : ''}
                                ${food.vegetarian ? 'data-vegetarian="true"' : ''}
                            >
                                <div class="relative overflow-hidden" style="height:200px;">
                                    <img src="${food.image}" alt="${food.name}"
                                        class="w-full h-44 object-cover border-b border-gray-100" />
                                    <div class="absolute top-3 left-3 z-10">
                                        <span class="bg-main-red text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">
                                            ${food.menu_name ?? ''}
                                        </span>
                                    </div>
                                    <div class="absolute top-3 right-3 z-10">
                                       <button data-food-id="{{ $food->id }}"
                                    class=" favorite-btn icon-btn {{ in_array($food->id, $favIds) ? 'text-red-500' : 'text-gray-500' }} w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center  hover:text-red-500 transition-colors">
                                    <i
                                        class="{{ in_array($food->id, $favIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }} text-lg"></i>
                                </button>
                                    </div>
                                </div>
                                <div class="p-4 flex flex-col flex-1 mt-[-1.5rem]">
                                    <h3 class="font-bold text-lg text-gray-800 mb-2"
                                        style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                        ${food.name}
                                    </h3>
                                    <p class="text-gray-600 text-sm mt-4"
                                        style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                        ${food.description}
                                    </p>
                                    <div class="flex items-center mb-3 min-h-[28px]">
                                        <div class="flex text-yellow-400 text-sm">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                                        <span class="ml-2 text-gray-400 text-sm">• 124 đánh giá</span>
                                    </div>
                                    <div class="flex items-center justify-between mb-2 min-h-[30px]">
                                        <span class="text-2xl font-bold text-main-red">
                                            ${new Intl.NumberFormat('vi-VN').format(food.price)}đ
                                        </span>
                                    </div>
                                    <div class="mt-auto flex gap-2">
                                        <button type="button"
                                        class="add-to-cart flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]"
                                        data-food-id="{{ $food->id }}" data-quantity="1">
                                        <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ Hàng
                                    </button>
                                        <button
                                        class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                        <a href="{{ route('views.menudetail', [$food->id, $food->slug]) }}"><i
                                                class="fa-regular fa-eye"></i></a>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                            productsGrid.innerHTML = html;
                            resultsCount.textContent = `Hiển thị ${data.results.length} món ăn`;
                        } else {
                            productsGrid.innerHTML = `<div class="col-span-full text-center text-gray-500 py-12 text-lg">Không tìm thấy món ăn nào phù hợp.</div>`;
                            resultsCount.textContent = `Hiển thị 0 món ăn`;
                        }
                        reapplyFilterSortAndEvents();
                    })
                    .catch(() => {
                        productsGrid.innerHTML = `<div class="col-span-full text-center text-red-500 py-12 text-lg">Có lỗi xảy ra, vui lòng thử lại.</div>`;
                    });
            });

            // ------- INIT: filter/sort cho lần đầu -------
            reapplyFilterSortAndEvents();
        });
        $(document).ready(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $(document).on('click', '.btn-add-cart', function (e) {
                e.preventDefault();
                let food_id = $(this).data('id');
                let quantity = $(this).data('quantity') || 1;
                var btn = $(this);
                btn.prop('disabled', true);
                $.ajax({
                    url: '/cart',
                    type: 'POST',
                    data: {
                        food_id: food_id,
                        quantity: quantity,
                    },
                    success: function (res) {
                        if (res.success) {
                            alert(res.message || 'Đã thêm vào giỏ hàng!');
                        } else {
                            alert(res.message || 'Có lỗi xảy ra!');
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            alert('Bạn cần đăng nhập!');
                            window.location.href = "/login";
                        } else {
                            let res = xhr.responseJSON;
                            alert((res && res.message) ? res.message : "Lỗi không xác định!");
                        }
                    },
                    complete: function () {
                        btn.prop('disabled', false);
                    }
                });
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const grid = document.getElementById("products-grid");
            const items = grid.querySelectorAll(".food-item");
            const pagination = document.getElementById("products-pagination");
            const perPage = 8; // Số sản phẩm mỗi trang (bạn chỉnh số này nếu muốn)
            let page = 1;
            const totalPages = Math.ceil(items.length / perPage);

            function showPage(p) {
                page = p;
                items.forEach((item, idx) => {
                    item.style.display = (idx >= (page - 1) * perPage && idx < page * perPage) ? "" : "none";
                });
                renderPagination();
            }

            function renderPagination() {
                pagination.innerHTML = "";
                if (totalPages <= 1) return; // Không cần hiện nếu chỉ có 1 trang
                // Nút Prev
                const prev = document.createElement("button");
                prev.textContent = "<";
                prev.disabled = page === 1;
                prev.className = "px-3 py-1 rounded bg-gray-200 mx-1";
                prev.onclick = () => showPage(page - 1);
                pagination.appendChild(prev);
                // Các số trang
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement("button");
                    btn.textContent = i;
                    btn.className = "px-3 py-1 rounded mx-1 " + (i === page ? "bg-main-red text-white" : "bg-gray-100");
                    btn.onclick = () => showPage(i);
                    pagination.appendChild(btn);
                }
                // Nút Next
                const next = document.createElement("button");
                next.textContent = ">";
                next.disabled = page === totalPages;
                next.className = "px-3 py-1 rounded bg-gray-200 mx-1";
                next.onclick = () => showPage(page + 1);
                pagination.appendChild(next);
            }

            // Chỉ chạy khi có sản phẩm
            if (items.length) {
                showPage(1);
            }
        });
    </script>


    <!-- Footer -->
    @include('layouts.user.footer')
</body>

</html>