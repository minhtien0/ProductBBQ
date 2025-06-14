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
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Tin Tức</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">Tin Tức</span>
            </div>
        </div>
    </div>

    <!-- Blog Cards Grid -->
    <div class="max-w-6xl mx-auto px-3 py-8">
        <div id="blog-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($blogs as $index => $blog)
                <div class="blog-card bg-white rounded-xl shadow hover:shadow-lg transition p-3 flex flex-col"
                    data-index="{{ $index }}">
                    <div class="relative">
                        <img src="{{ asset('img/blog/' . $blog->image) }}" alt=""
                            class="rounded-lg w-full h-36 md:h-44 object-cover" />
                        <span
                            class="absolute top-2 left-2 bg-[#e60012] text-white text-xs px-2 py-1 rounded">{{ $blog->type }}</span>
                    </div>
                    <div class="flex items-center mt-3 mb-2 gap-2">
                        <img src="img/mtien.jpg" alt=""
                            class="w-7 h-7 rounded-full object-cover border-2 border-white shadow">
                        <div>
                            <p class="font-semibold text-xs text-[#22223b] leading-tight">{{ $blog->fullname }}</p>
                            <p class="text-gray-400 text-xs">{{ \Carbon\Carbon::parse($blog->time_blog)->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                    <h3 class="font-semibold text-base mb-1 line-clamp-2">{{ $blog->title }}</h3>
                    <div class="flex justify-between items-center mt-auto text-xs">
                        <a href="{{ route('views.blogdetail', [$blog->id_blog, $blog->slug]) }}"
                            class="text-[#22223b] hover:text-[#e60012] font-medium">Đọc thêm <i
                                class="fa fa-arrow-right text-[10px]"></i></a>
                        <div class="flex items-center gap-1 text-gray-400">
                            <i class="fa-regular fa-comment-dots"></i>
                            <span class="ml-1 text-[#e60012]">120</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const blogCards = document.querySelectorAll(".blog-card");
        const cardsPerPage = 6;
        let currentPage = 1;
        const totalPages = Math.ceil(blogCards.length / cardsPerPage);
        const paginationContainer = document.querySelector("nav.flex.gap-2");

        function showPage(page) {
            blogCards.forEach((card, index) => {
                card.style.display = (index >= (page - 1) * cardsPerPage && index < page * cardsPerPage) ? "block" : "none";
            });
        }

        function renderPagination() {
            paginationContainer.innerHTML = "";

            const prev = document.createElement("button");
            prev.className = "w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition";
            prev.innerHTML = `<i class="fa fa-angle-left"></i>`;
            prev.disabled = currentPage === 1;
            prev.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                    renderPagination();
                }
            };
            paginationContainer.appendChild(prev);

            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement("button");
                btn.className = `w-8 h-8 rounded-full border ${i === currentPage ? 'text-[#e60012] border-[#e60012] font-semibold' : 'border-gray-300 text-gray-700'} hover:bg-[#e60012] hover:text-white transition`;
                btn.textContent = i;
                btn.onclick = () => {
                    currentPage = i;
                    showPage(currentPage);
                    renderPagination();
                };
                paginationContainer.appendChild(btn);
            }

            const next = document.createElement("button");
            next.className = "w-8 h-8 rounded-full border border-gray-300 text-gray-700 hover:bg-[#e60012] hover:text-white transition";
            next.innerHTML = `<i class="fa fa-angle-right"></i>`;
            next.disabled = currentPage === totalPages;
            next.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                    renderPagination();
                }
            };
            paginationContainer.appendChild(next);
        }

        showPage(currentPage);
        renderPagination();
    });
</script>

@include('layouts.user.footer')

</html>