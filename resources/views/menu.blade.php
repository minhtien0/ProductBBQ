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
                    },
                    fontFamily: {
                        mont: ['Montserrat', 'sans-serif'],
                    }
                },
            },
        };
    </script>
    <!-- <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style> -->
</head>

<body class="bg-dark-bg text-[#22223b] font-mont">
    @include('layouts.user.header')

    <!-- Banner -->
    <div class="relative w-full">
        <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
        <img src="img/banner1.jpg" alt="Menu" class="w-full h-[260px] md:h-[360px] object-cover">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Popular Foods Menu</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">Menu</span>
            </div>
        </div>
    </div>

     <!-- Product List Grid -->
    <!-- Danh mục menu -->
    <div class="w-full max-w-6xl mx-auto mt-2 flex flex-wrap justify-between items-center gap-2 px-2 sm:px-4">
        <div id="menu-categories"
            class="w-full flex flex-wrap gap-2 sm:gap-8 border-b-4 border-main-red pb-1 justify-center">
            <button data-cat="buffet"
                class="category-tab py-2 px-6 text-main-red font-semibold border-b-4 border-main-red bg-white rounded-t transition active">Buffet</button>
            <button data-cat="monle"
                class="category-tab py-2 px-6 text-main-red font-semibold hover:border-b-4 border-transparent hover:border-main-red bg-white rounded-t transition">Món
                lẻ</button>
            <button data-cat="combo"
                class="category-tab py-2 px-6 text-main-red font-semibold hover:border-b-4 border-transparent hover:border-main-red bg-white rounded-t transition">Combo</button>
            <button data-cat="banchay"
                class="category-tab py-2 px-6 text-main-red font-semibold hover:border-b-4 border-transparent hover:border-main-red bg-white rounded-t transition">Bàn
                chay</button>
            <button data-cat="thucuong"
                class="category-tab py-2 px-6 text-main-red font-semibold hover:border-b-4 border-transparent hover:border-main-red bg-white rounded-t transition">Thức
                uống</button>
        </div>
    </div>

    <!-- Filter/Search -->
    <div class="w-full max-w-6xl mx-auto px-2 sm:px-4 mt-5 mb-6">
        <div
            class="bg-white rounded-xl shadow flex flex-col gap-2 sm:gap-4 sm:flex-row items-stretch sm:items-center px-3 py-3 sm:px-4 sm:py-4">
            <input type="text" placeholder="Search food..."
                class="flex-1 w-full border border-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-main-red transition text-sm" />
            <select
                class="w-full sm:w-auto border border-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-main-red text-sm">
                <option>Default Sorting</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
            </select>
            <button
                class="w-full sm:w-auto bg-main-red text-white font-semibold rounded px-6 py-2 hover:bg-[#f26506] transition text-sm">
                Search
            </button>
        </div>
    </div>

   
    <!-- Danh sách sản phẩm theo danh mục (tab) -->
    <div id="tab-contents" class="w-full max-w-6xl mx-auto mt-3">
        <div data-content="buffet" class="tab-pane block">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 px-2 sm:px-4 mb-8">
                <!-- Buffet 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/suonxe.jpg" alt="Buffet 1"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Buffet</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">BBQ Buffet 299K</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">10</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">299.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
                <!-- Buffet 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/suon.jpg" alt="Buffet 2"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Buffet</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Buffet Gia Đình 399K</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">24</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">399.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div data-content="combo" class="tab-pane hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 px-2 sm:px-4 mb-8">
                <!-- Combo 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/combo1.jpg" alt="Combo 1"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Combo</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Combo 99K Sinh viên</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">12</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">99.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
                <!-- Combo 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/combo2.jpg" alt="Combo 2"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Combo</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Combo Gia đình 249K</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">27</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">249.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div data-content="combo" class="tab-pane hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 px-2 sm:px-4 mb-8">
                <!-- Combo 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/combo1.jpg" alt="Combo 1"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Combo</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Combo 99K Sinh viên</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">12</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">99.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
                <!-- Combo 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/combo2.jpg" alt="Combo 2"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Combo</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Combo Gia đình 249K</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">27</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">249.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div data-content="banchay" class="tab-pane hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 px-2 sm:px-4 mb-8">
                <!-- Bàn chay 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/chay1.jpg" alt="Bàn chay 1"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Bàn
                            chay</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Lẩu nấm chay</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">19</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">120.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
                <!-- Bàn chay 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/chay2.jpg" alt="Bàn chay 2"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Bàn
                            chay</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Bún riêu chay</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">21</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">75.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div data-content="thucuong" class="tab-pane hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 px-2 sm:px-4 mb-8">
                <!-- Thức uống 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/nuoc1.jpg" alt="Nước 1"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Thức
                            uống</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Trà chanh sả</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">13</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">25.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
                <!-- Thức uống 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-3 flex flex-col">
                    <div class="relative">
                        <img src="img/danhmuc1/nuoc2.jpg" alt="Nước 2"
                            class="rounded-t-lg w-full h-32 sm:h-36 object-cover" />
                        <span class="absolute top-2 left-2 bg-main-red text-white text-xs px-2 py-1 rounded">Thức
                            uống</span>
                    </div>
                    <div class="pt-3 pb-2">
                        <h3 class="font-semibold text-base truncate">Soda Việt quất</h3>
                        <div class="flex items-center text-yellow-400 text-xs my-1">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="ml-2 text-gray-400">11</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-main-red">32.000đ</span>
                        </div>
                    </div>
                    <div class="flex justify-between mt-auto gap-2">
                        <button
                            class="bg-main-red text-white px-3 py-1 rounded font-semibold text-xs hover:bg-[#f26506] transition">Add
                            To Cart</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Pagination -->
    <div class="flex justify-center items-center mb-8">
        <nav class="flex gap-2">
            <button
                class="w-8 h-8 rounded-full border text-main-red border-main-red font-semibold hover:bg-main-red hover:text-white transition">1</button>
            <button
                class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-main-red hover:text-white transition">2</button>
            <button
                class="w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-main-red hover:text-white transition">3</button>
        </nav>
    </div>
    <script>
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', function () {
                // 1. Bỏ active ở tất cả tab
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active', 'border-main-red'));
                // 2. Ẩn tất cả content
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
                // 3. Hiện tab được chọn
                this.classList.add('active', 'border-main-red');
                document.querySelector(`[data-content="${this.dataset.cat}"]`).classList.remove('hidden');
            });
        });
    </script>

    <!-- Footer -->
    @include('layouts.user.footer')
</body>

</html>