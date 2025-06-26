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
                        data-name="{{ strtolower($food->name) }}" {{-- Nếu có các filter đặc biệt --}}
                        @if(isset($food->popular) && $food->popular) data-popular="true" @endif @if(isset($food->new) && $food->new) data-new="true" @endif @if(isset($food->discount) && $food->discount)
                        data-discount="true" @endif @if(isset($food->vegetarian) && $food->vegetarian)
                        data-vegetarian="true" @endif>
                        <!-- Các nội dung bên trong giữ nguyên -->
                        <div class="relative overflow-hidden" style="height:240px;">
                            <img src="{{ asset('img/' . $food->image) }}" alt="{{ $food->name }}"
                                class="w-full h-56 object-cover border-b border-gray-100" />
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-main-red text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">
                                    {{ optional($menus->firstWhere('id', $food->type))->name ?? '' }}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3 z-10">
                                <button
                                    class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 mt-[-1.5rem]">
                            <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $food->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mt-4 line-clamp-2"
                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {!! $food->description !!}
                            </p>
                            <div class="flex flex-col justify-end min-h-[70px] mb-2">
                                <div class="flex items-center min-h-[28px]">
                                    <div class="flex text-yellow-400 text-sm">
                                        @for($i = 0; $i < 4; $i++) <i class="fas fa-star"></i> @endfor
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                                    <span class="ml-2 text-gray-400 text-sm">• 124 đánh giá</span>
                                </div>
                                <span class="text-2xl font-bold text-main-red mt-1">
                                    {{ number_format($food->price, 0, ',', '.') }}đ
                                    </span>
                                </div>
                                <div class="mt-auto flex gap-2">
                                    <button type="button"
                                        class="btn-add-cart flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]"
                                        data-id="{{ $food->id }}" data-quantity="1">
                                        <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                                    </button>

                                    <button
                                        class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
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

        <nav class="flex items-center gap-2 justify-center mt-4">
            {{-- Nút Previous --}}
            <a href="{{ $foods->previousPageUrl() ?: '#' }}"
                class="px-3 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 {{ $foods->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                <i class="fas fa-chevron-left"></i>
            </a>

            {{-- Các số trang --}}
            @for ($i = 1; $i <= $foods->lastPage(); $i++)
                <a href="{{ $foods->url($i) }}"
                    class="px-3 py-2 rounded-lg 
                                                                                                          {{ $i == $foods->currentPage() ? 'bg-main-red text-white font-semibold' : 'bg-gray-100 hover:bg-gray-200' }}">
                    {{ $i }}
                </a>
            @endfor

            {{-- Nút Next --}}
            <a href="{{ $foods->nextPageUrl() ?: '#' }}"
                class="px-3 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 {{ $foods->currentPage() == $foods->lastPage() ? 'opacity-50 pointer-events-none' : '' }}">
                <i class="fas fa-chevron-right"></i>
            </a>
        </nav>

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
                    });
                });
            });


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
                                <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                    <i class="fas fa-heart"></i>
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
                                <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]">
                                    <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                                </button>
                                <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');
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
                                        <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                            <i class="fas fa-heart"></i>
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
                                        <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]">
                                            <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                                        </button>
                                        <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-share-alt"></i>
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
    </script>

    <!-- Footer -->
    @include('layouts.user.footer')
</body>

</html>