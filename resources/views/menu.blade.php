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
                    <!-- Sample categories - replace with your data -->
                    <button data-cat="all" class="category-tab active bg-gradient-to-r from-main-red to-red-500 text-white px-6 py-3 rounded-full font-semibold shadow-lg transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-utensils mr-2"></i>Tất Cả
                    </button>
                    <button data-cat="buffet" class="category-tab bg-white text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                        <i class="fas fa-star mr-2"></i>Buffet
                    </button>
                    <button data-cat="appetizer" class="category-tab bg-white text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                        <i class="fas fa-leaf mr-2"></i>Khai Vị
                    </button>
                    <button data-cat="main" class="category-tab bg-white text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                        <i class="fas fa-drumstick-bite mr-2"></i>Món Chính
                    </button>
                    <button data-cat="dessert" class="category-tab bg-white text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                        <i class="fas fa-ice-cream mr-2"></i>Tráng Miệng
                    </button>
                    <button data-cat="drink" class="category-tab bg-white text-gray-700 border-2 border-gray-200 px-6 py-3 rounded-full font-semibold hover:border-main-red hover:text-main-red transition-all duration-300">
                        <i class="fas fa-glass-cheers mr-2"></i>Đồ Uống
                    </button>
                </div>
            </div>
        </div>

        <!-- Advanced Filter/Search Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1 relative">
                        <input type="text" id="search-input" placeholder="Tìm kiếm món ăn yêu thích..."
                            class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700 placeholder-gray-400">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="lg:w-64">
                        <select id="price-filter" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700">
                            <option value="">Tất cả mức giá</option>
                            <option value="low">Dưới 100.000đ</option>
                            <option value="medium">100.000đ - 300.000đ</option>
                            <option value="high">Trên 300.000đ</option>
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div class="lg:w-64">
                        <select id="sort-filter" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-main-red focus:outline-none transition-colors text-gray-700">
                            <option value="default">Sắp xếp mặc định</option>
                            <option value="price-asc">Giá: Thấp → Cao</option>
                            <option value="price-desc">Giá: Cao → Thấp</option>
                            <option value="name-asc">Tên: A → Z</option>
                            <option value="rating">Đánh giá cao nhất</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <button id="search-btn" class="px-8 py-4 bg-gradient-to-r from-main-red to-red-500 text-white font-semibold rounded-xl hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-search mr-2"></i>Tìm Kiếm
                    </button>
                </div>

                <!-- Quick Filters -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm text-gray-600 mr-4 font-medium">Lọc nhanh:</span>
                        <button class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors" data-filter="popular">
                            <i class="fas fa-fire mr-1"></i>Phổ biến
                        </button>
                        <button class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors" data-filter="new">
                            <i class="fas fa-star mr-1"></i>Mới nhất
                        </button>
                        <button class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors" data-filter="discount">
                            <i class="fas fa-percent mr-1"></i>Giảm giá
                        </button>
                        <button class="quick-filter px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-main-red hover:text-white transition-colors" data-filter="vegetarian">
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
                    <button id="list-view" class="p-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div id="products-container" class="mb-8">
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Sample Product Cards -->
                <div class="food-item bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden" data-category="buffet" data-price="150000" data-name="Buffet Hải Sản">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?w=300&h=200&fit=crop" alt="Buffet Hải Sản" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="absolute top-3 left-3">
                            <span class="bg-main-red text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Buffet</span>
                        </div>
                        <div class="absolute top-3 right-3">
                            <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-3 left-3 right-3">
                                <button class="w-full bg-white text-gray-800 py-2 rounded-lg font-semibold opacity-0 transform translate-y-4 hover:opacity-100 hover:translate-y-0 transition-all duration-300">
                                    <i class="fas fa-eye mr-2"></i>Xem Chi Tiết
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-1">Buffet Hải Sản Cao Cấp</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">Buffet hải sản tươi ngon với hơn 100 món ăn đa dạng từ khắp nơi trên thế giới</p>
                        
                        <!-- Rating -->
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-500 text-sm">(4.5)</span>
                            <span class="ml-2 text-gray-400 text-sm">• 124 đánh giá</span>
                        </div>

                        <!-- Price and Action -->
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-main-red">150.000đ</span>
                                <span class="text-gray-400 text-sm line-through ml-2">200.000đ</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                            </button>
                            <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- More sample items -->
                <div class="food-item bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden" data-category="main" data-price="85000" data-name="Bò Nướng Lá Chuối">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=300&h=200&fit=crop" alt="Bò Nướng" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="absolute top-3 left-3">
                            <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Món Chính</span>
                        </div>
                        <div class="absolute top-3 right-3">
                            <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Bò Nướng Lá Chuối</h3>
                        <p class="text-gray-600 text-sm mb-3">Thịt bò tươi nướng trong lá chuối thơm phức, ăn kèm bánh tráng</p>
                        
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-500 text-sm">(4.2)</span>
                            <span class="ml-2 text-gray-400 text-sm">• 87 đánh giá</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-main-red">85.000đ</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                            </button>
                            <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="food-item bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden" data-category="drink" data-price="35000" data-name="Trà Đá Chanh">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=300&h=200&fit=crop" alt="Trà Đá Chanh" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Đồ Uống</span>
                        </div>
                        <div class="absolute top-3 right-3">
                            <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Trà Đá Chanh Tươi</h3>
                        <p class="text-gray-600 text-sm mb-3">Trà đá chanh tươi mát, thanh nhiệt giải khát trong ngày hè</p>
                        
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-gray-500 text-sm">(5.0)</span>
                            <span class="ml-2 text-gray-400 text-sm">• 45 đánh giá</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-main-red">35.000đ</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                            </button>
                            <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="food-item bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden" data-category="dessert" data-price="45000" data-name="Bánh Flan">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=200&fit=crop" alt="Bánh Flan" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="absolute top-3 left-3">
                            <span class="bg-purple-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Tráng Miệng</span>
                        </div>
                        <div class="absolute top-3 right-3">
                            <button class="w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition-colors">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">Bánh Flan Caramel</h3>
                        <p class="text-gray-600 text-sm mb-3">Bánh flan mềm mịn với lớp caramel đắng ngọt hấp dẫn</p>
                        
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-500 text-sm">(4.6)</span>
                            <span class="ml-2 text-gray-400 text-sm">• 78 đánh giá</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-main-red">45.000đ</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 bg-gradient-to-r from-main-red to-red-500 text-white py-2 px-4 rounded-xl font-semibold hover:from-red-500 hover:to-red-600 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-cart-plus mr-2"></i>Thêm Giỏ
                            </button>
                            <button class="w-12 h-10 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
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
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="text-gray-600">
                Trang 1 trong tổng số 1 trang
            </div>
            <nav class="flex items-center gap-2">
                <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 rounded-lg bg-main-red text-white font-semibold">1</button>
                <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </div>
    
<script>
    // Enhanced JavaScript functionality
    document.addEventListener('DOMContentLoaded', function() {
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
            tab.addEventListener('click', function() {
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
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filterItems(currentCategory, searchTerm);
        });

        // **Xử lý lọc theo giá**
        priceFilter.addEventListener('change', function() {
            filterItems(currentCategory);
        });

        // **Xử lý sắp xếp**
        sortFilter.addEventListener('change', function() {
            sortItems(this.value);
        });

        // **Xử lý bộ lọc nhanh**
        quickFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Chuyển đổi trạng thái active
                this.classList.toggle('bg-main-red');
                this.classList.toggle('text-white');
                this.classList.toggle('bg-gray-100');
                this.classList.toggle('text-gray-700');
                filterItems(currentCategory);
            });
        });

        // **Chuyển đổi chế độ xem: Grid**
        gridView.addEventListener('click', function() {
            productsGrid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
            this.classList.add('bg-main-red', 'text-white');
            this.classList.remove('bg-gray-200', 'text-gray-600');
            listView.classList.remove('bg-main-red', 'text-white');
            listView.classList.add('bg-gray-200', 'text-gray-600');
        });

        // **Chuyển đổi chế độ xem: List**
        listView.addEventListener('click', function() {
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