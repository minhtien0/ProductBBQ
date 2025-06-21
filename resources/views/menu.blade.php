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
                    <button data-cat="all"
                        onclick="window.location.href='{{ route('views.menu', array_merge(request()->except(['category', 'page']), ['category' => 'all', 'page' => 1])) }}'"
                        class="category-tab
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
                            onclick="window.location.href='{{ route('views.menu', array_merge(request()->except(['category', 'page']), ['category' => $menuCat, 'page' => 1])) }}'"
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
                    <form method="GET" action="{{ route('views.menu') }}" class="flex-1 relative flex">
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

                <!-- Quick Filters -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm text-gray-600 mr-4 font-medium">Lọc nhanh:</span>
                        <button
                            class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors"
                            data-filter="popular">
                            <i class="fas fa-fire mr-1"></i>Phổ biến
                        </button>
                        <button
                            class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors"
                            data-filter="new">
                            <i class="fas fa-star mr-1"></i>Mới nhất
                        </button>
                        <button
                            class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors"
                            data-filter="discount">
                            <i class="fas fa-percent mr-1"></i>Giảm giá
                        </button>
                        <button
                            class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors"
                            data-filter="vegetarian">
                            <i class="fas fa-leaf mr-1"></i>Chay
                        </button>
                    </div>
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
                    <div class="flex flex-col h-full max-w-[450px] min-w-[260px] w-full bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden"
                        style="height:550px;" data-category="menu-{{ $food->type }}" data-price="{{ $food->price }}"
                        data-name="{{ $food->name }}">
                        <div class="relative overflow-hidden" style="height:200px;">
                            <img src="{{ asset('img/' . $food->image) }}" alt="{{ $food->name }}"
                                class="w-full h-44 object-cover border-b border-gray-100" />
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
                        <div class="p-4 flex flex-col flex-1 mt-[-1.5rem]">
                            <h3 class="font-bold text-lg text-gray-800 mb-2"
                                style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $food->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mt-4"
                                style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                                {!! $food->description !!}
                            </p>
                            <div class="flex items-center mb-3 min-h-[28px]">
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 0; $i < 4; $i++) <i class="fas fa-star"></i> @endfor
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                                <span class="ml-2 text-gray-400 text-sm">• 124 đánh giá</span>
                            </div>
                            <div class="flex items-center justify-between mb-2 min-h-[30px]">
                                <span class="text-2xl font-bold text-main-red">
                                    {{ number_format($food->price, 0, ',', '.') }}đ
                                </span>
                            </div>
                            <div class="mt-auto flex gap-2">
                                <button
                                    class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 min-w-[100px]">
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

        <nav class="flex items-center gap-2 justify-center">
            <a href="{{ $foods->previousPageUrl() ?: '#' }}" ...>
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="px-4 py-2 rounded-lg bg-main-red text-white font-semibold">
                {{ $foods->currentPage() }}
            </span>
            <a href="{{ $foods->nextPageUrl() ?: '#' }}" ...>
                <i class="fas fa-chevron-right"></i>
            </a>
        </nav>
    </div>


    </div>

    <script>
        // Enhanced JavaScript functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy các phần tử DOM cần thiết
            const categoryTabs = document.querySelectorAll('.category-tab');
            const foodItems = document.querySelectorAll('.food-item');
            const searchInput = document.getElementById('search-input');
            const priceFilter = document.getElementById('price-filter');
            const sortFilter = document.getElementById('sort-filter');
            const quickFilters = document.querySelectorAll('.quick-filter');
            const gridView = document.getElementById('grid-view');
            const listView = document.getElementById('list-view');
            const productsGrid = document.getElementById('products-grid');
            const resultsCount = document.getElementById('results-count');
            const noResults = document.getElementById('no-results');
            const loading = document.getElementById('loading');

            let currentCategory = 'all';

            // **Xử lý lọc theo danh mục**
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    // Xóa lớp active từ tất cả các tab
                    categoryTabs.forEach(t => {
                        t.classList.remove('bg-gradient-to-r', 'from-main-red', 'to-red-500', 'text-white');
                        t.classList.add('bg-white', 'text-gray-700', 'border-2', 'border-gray-200');
                    });

                    // Thêm lớp active cho tab được nhấp
                    this.classList.remove('bg-white', 'text-gray-700', 'border-2', 'border-gray-200');
                    this.classList.add('bg-gradient-to-r', 'from-main-red', 'to-red-500', 'text-white');

                    currentCategory = this.dataset.cat;
                    filterItems(currentCategory);
                });
            });


            // **Xử lý tìm kiếm**
            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();
                filterItems(currentCategory, searchTerm);
            });

            // **Xử lý lọc theo giá**
            priceFilter.addEventListener('change', function () {
                filterItems(currentCategory);
            });

            // **Xử lý sắp xếp**
            sortFilter.addEventListener('change', function () {
                sortItems(this.value);
            });

            // **Xử lý bộ lọc nhanh**
            quickFilters.forEach(filter => {
                filter.addEventListener('click', function () {
                    // Chuyển đổi trạng thái active
                    this.classList.toggle('bg-main-red');
                    this.classList.toggle('text-white');
                    this.classList.toggle('bg-gray-100');
                    this.classList.toggle('text-gray-700');
                    filterItems(currentCategory);
                });
            });

            // **Chuyển đổi chế độ xem: Grid**
            gridView.addEventListener('click', function () {
                productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
                this.classList.add('bg-main-red', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-600');
                listView.classList.remove('bg-main-red', 'text-white');
                listView.classList.add('bg-gray-200', 'text-gray-600');
            });

            // **Chuyển đổi chế độ xem: List**
            listView.addEventListener('click', function () {
                productsGrid.className = 'grid grid-cols-1 gap-6';
                this.classList.add('bg-main-red', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-600');
                gridView.classList.remove('bg-main-red', 'text-white');
                gridView.classList.add('bg-gray-200', 'text-gray-600');
            });



            // **Hàm lọc các món ăn**
            function filterItems(category = 'all', searchTerm = '') {
                const priceRange = priceFilter.value;
                const activeQuickFilters = Array.from(quickFilters)
                    .filter(filter => filter.classList.contains('bg-main-red'))
                    .map(filter => filter.dataset.filter);
                let visibleCount = 0;

                foodItems.forEach(item => {
                    const itemCategory = item.dataset.category;
                    const itemName = item.dataset.name.toLowerCase();
                    const itemPrice = parseInt(item.dataset.price);

                    // Kiểm tra danh mục
                    let categoryMatch = category === 'all' || itemCategory === category;

                    // Kiểm tra tìm kiếm
                    let searchMatch = itemName.includes(searchTerm);

                    // Kiểm tra giá
                    let priceMatch = true;
                    if (priceRange === 'low') {
                        priceMatch = itemPrice < 100000;
                    } else if (priceRange === 'medium') {
                        priceMatch = itemPrice >= 100000 && itemPrice <= 300000;
                    } else if (priceRange === 'high') {
                        priceMatch = itemPrice > 300000;
                    }

                    // Kiểm tra bộ lọc nhanh (giả sử có các thuộc tính tương ứng)
                    let quickFilterMatch = activeQuickFilters.length === 0 || activeQuickFilters.some(filter => {
                        return item.dataset[filter] === 'true';
                    });

                    // Hiển thị hoặc ẩn món ăn
                    if (categoryMatch && searchMatch && priceMatch && quickFilterMatch) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Cập nhật số lượng kết quả
                resultsCount.textContent = `Hiển thị ${visibleCount} trong tổng số ${foodItems.length} món ăn`;
                noResults.classList.toggle('hidden', visibleCount > 0);
            }

            // **Hàm sắp xếp các món ăn**
            function sortItems(sortOption) {
                const itemsArray = Array.from(foodItems);
                let sortedArray;

                switch (sortOption) {
                    case 'price-asc':
                        sortedArray = itemsArray.sort((a, b) => parseInt(a.dataset.price) - parseInt(b.dataset.price));
                        break;
                    case 'price-desc':
                        sortedArray = itemsArray.sort((a, b) => parseInt(b.dataset.price) - parseInt(a.dataset.price));
                        break;
                    case 'name-asc':
                        sortedArray = itemsArray.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
                        break;
                    case 'rating':
                        sortedArray = itemsArray.sort((a, b) => {
                            const ratingA = parseFloat(a.querySelector('.text-gray-500').textContent.match(/\d\.\d/)[0]);
                            const ratingB = parseFloat(b.querySelector('.text-gray-500').textContent.match(/\d\.\d/)[0]);
                            return ratingB - ratingA;
                        });
                        break;
                    default:
                        sortedArray = itemsArray; // Giữ nguyên thứ tự mặc định
                        break;
                }

                // Xóa và thêm lại các món ăn đã sắp xếp
                productsGrid.innerHTML = '';
                sortedArray.forEach(item => productsGrid.appendChild(item));
            }

            // Khởi tạo với tất cả món ăn
            filterItems();
        });
    </script>

    <!-- Footer -->
    @include('layouts.user.footer')
</body>

</html>