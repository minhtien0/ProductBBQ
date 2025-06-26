<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>LUA BE HOY</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
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
                        'back-g': '#1a1a1a',
                    },
                },
            },
        };
    </script>
    <style>
        /* Sale */
        .offer-section {
            background: #f4faef;
            padding: 24px 0;

        }

        .offer-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 16px;

        }

        .swiper-slide {
            background: #fff;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
            width: 300px;
            height: 270px;
        }

        .product-img-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff8000;
            color: #fff;
            border-radius: 50%;
            padding: 7px 12px 8px 12px;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
        }

        .swiper-buttons {
            display: none;
            gap: 8px;

        }

        .swiper-button-prev,
        .swiper-button-next {
            background: #ff8000;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            color: #fff;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .swiper-button-next {
            background: #262465;
        }

        @media (max-width: 1024px) {
            .offer-wrapper {
                max-width: 700px;
            }

            .swiper-slide {
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            .offer-wrapper {
                max-width: 98vw;
                padding: 0 4vw;
            }

            .swiper-buttons {
                display: none;
            }

            .swiper-slide {
                padding: 8px;

            }

            .product-img-badge {
                font-size: 12px;
                padding: 6px 10px 6px 10px;
            }
        }

        @media (max-width: 480px) {
            .offer-section {
                padding: 10px 0;
            }

            .offer-wrapper {
                padding: 0 2vw;
            }

            .swiper-slide {
                padding: 5px;
            }

            h2 {
                font-size: 1.05rem !important;
            }
        }

        /* Booking */
        .booking-section {
            display: flex;
            max-height: auto;
            max-width: 1365px;
            margin: 40px auto;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 18px rgba(0, 0, 0, .09);
        }

        .booking-form-row>div {
            display: flex;
            flex-direction: column;
        }

        .booking-form-row label {
            margin-bottom: 5px;
            font-size: 1rem;
            font-weight: 500;
            color: #fff;
        }


        .booking-img {

            flex: 1.1;
            min-width: 240px;
            background: #ddd;
            object-fit: cover;
            height: auto;
        }

        .booking-form-bg {
            flex: 1.5;
            background: linear-gradient(120deg, #1a1a1a 70%, #e60012 100%);
            padding: 36px 36px 28px 36px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .booking-form {
            width: 100%;
            color: #fff;
        }

        .booking-form h2 {
            margin-bottom: 18px;
            font-size: 2rem;
            font-weight: 600;
            border-bottom: 2px solid #fff3;
            padding-bottom: 7px;
        }

        .booking-form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 14px;
        }

        .booking-form-row input,
        .booking-form-row select {
            flex: 1;
            padding: 11px 14px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
            background: #fff;
            color: #222;
            outline: none;
        }

        .booking-form-row input[type='date'] {
            color: #222;
        }

        .booking-form-row input:focus,
        .booking-form-row select:focus {
            box-shadow: 0 2px 0 #f08200;
        }

        .booking-form button {
            margin-top: 18px;
            width: 100%;
            background: #262465;
            color: #fff;
            border: none;
            padding: 13px;
            font-size: 1.1rem;
            border-radius: 7px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: background 0.2s;
        }

        .booking-form button:hover {
            background: #1a1a3a;
        }

        @media (max-width: 1024px) {
            .booking-section {
                max-width: 97vw;
            }

            .booking-form-bg {
                padding: 28px 12px 16px 12px;
            }
        }

        @media (max-width: 900px) {
            .booking-img {
                height: 340px;
            }

            .booking-form h2 {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 650px) {
            .booking-section {
                flex-direction: column;
            }

            .booking-img {
                width: 100%;
                height: 160px;
            }

            .booking-form-bg {
                padding: 18px 7vw 12px 7vw;
            }

            .booking-form-row {
                flex-direction: column;
                gap: 5px;
            }

            .booking-form button {
                font-size: 1rem;
            }
        }

        /* Directory */
        :root {
            --primary: #e60012;
            --deep: #262465;
        }

        body {
            background: #fafcf6;
            font-family: 'Montserrat', Arial, sans-serif;
        }

        .menu-section {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 10px;
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .menu-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 14px;
            color: #fff;
        }

        .menu-filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .menu-filters button {
            border: 2px solid #e60012;
            background: #fff;
            color: #e60012;
            font-weight: 700;
            border-radius: 6px;
            padding: 7px 22px;
            font-size: 1rem;
            cursor: pointer;
            transition: background .18s, color .18s;
        }

        .menu-filters button.active,
        .menu-filters button:hover {
            background: #e60012;
            color: #fff;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
            margin-top: 32px;
        }

        .menu-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 3px 16px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .menu-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .menu-badge {
            position: absolute;
            top: 12px;
            left: 0;
            background: var(--primary);
            color: #fff;
            font-size: 0.9rem;
            padding: 5px 16px 5px 16px;
            border-radius: 0 6px 6px 0;
            font-weight: bold;
            letter-spacing: .5px;
        }

        .menu-card-content {
            padding: 18px 16px 12px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu-card-title {
            font-size: 1.13rem;
            font-weight: 700;
            margin-bottom: 2px;
            color: var(--deep);
        }

        .menu-card-rating {
            color: #fc9501;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .menu-card-rating span {
            color: #888;
            font-weight: 600;
            margin-left: 5px;
            font-size: .98em;
        }

        .menu-card-price {
            font-size: 1.13rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2px;
        }

        .menu-card-price .old {
            font-size: .95em;
            color: #999;
            text-decoration: line-through;
            margin-left: 10px;
            font-weight: 500;
        }

        .menu-card-footer {
            margin-top: auto;
            display: flex;
            justify-content: center;
            /* Căn giữa các nút */
            align-items: center;
            gap: 14px;
            /* Tăng khoảng cách cho thoáng */
        }

        .menu-card-footer button:not(.icon-btn),
        .menu-card-footer a:not(.icon-btn) {
            background: linear-gradient(to right, #e60012, #e60012);
            color: white;
            font-weight: bold;
            padding: 8px 18px;
            font-size: 0.95rem;
            border: none;
            border-radius: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(255, 124, 9, 0.25);
            transition: 0.3s ease;
        }

        .menu-card-footer button:not(.icon-btn):hover,
        .menu-card-footer a:not(.icon-btn):hover {
            background: white;
            color: #e60012;
            border: 2px solid #e60012;
            box-shadow: 0 6px 15px rgba(255, 124, 9, 0.4);
            transform: translateY(-2px);
        }

        .menu-card-footer .icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #e60012;
            border: 2px solid #e60012;
            border-radius: 50%;
            font-size: 1.1rem;
            width: 42px;
            height: 42px;
            transition: 0.25s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-card-footer .icon-btn:hover {
            background: #e60012;
            color: white;
            transform: scale(1.1);
        }

        .menu-card-footer button:hover {
            background: #fff;
            color: var(--primary);
        }

        @media (max-width: 1000px) {
            .menu-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
            }
        }

        @media (max-width: 770px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }

            .menu-section {
                padding: 20px 4vw;
            }
        }

        @media (max-width: 540px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .menu-section {
                padding: 16px 2vw;
            }

            .menu-header {
                flex-direction: column;
                gap: 13px;
                align-items: flex-start;
            }

            .menu-title {
                font-size: 1.3rem;
            }
        }

        /* chefs */
        :root {
            --primary: #ff8000;
            --deep: #262465;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: #fff;
        }

        .section {
            padding: 38px 0;
        }

        .text-center {
            text-align: center;
        }

        .testi-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 5px;
        }

        .testi-subtitle {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.18em;
        }

        .testi-slider-wrap {
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 50px;
            position: relative;
        }

        .swiper {
            padding: 32px 0 16px 0;
        }

        .testi-card {
            background: #231f42;
            border-radius: 18px;
            padding: 38px 34px 20px 34px;
            color: #fff;
            margin-top: 1px;
            position: relative;
            box-shadow: 0 6px 32px rgba(37, 34, 70, .10);
            border: 5px solid var(--primary);

        }

        .testi-avatar-wrap {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translate(-50%, -50%);
            background: #fff;
            border-radius: 50%;
            padding: 4px;
            box-shadow: 0 2px 10px #ff800022;
            z-index: 2;
        }

        .testi-avatar {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px #8882;
        }

        .testi-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-top: 26px;
            color: #fff;
        }

        .testi-pos {
            font-size: 1rem;
            color: #fff9;
            margin-bottom: 12px;
        }

        .testi-quote {
            color: var(--primary);
            font-size: 1.6rem;
            margin-bottom: 8px;
            margin-right: 8px;
            font-weight: 700;
        }

        .testi-content {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 16px;
        }

        .testi-stars {
            color: #fc9501;
            font-size: 1.2em;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }

        .testi-nav {
            display: none;
            gap: 16px;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 8px;
        }

        .testi-nav-btn {
            background: var(--primary);
            border: none;
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s;
        }

        .testi-nav-btn:last-child {
            background: var(--deep);
        }

        .testi-nav-btn:hover {
            filter: brightness(1.08);
        }

        @media (max-width: 900px) {
            .testi-card {
                padding: 28px 16px 18px 16px;
            }

            .swiper {
                padding: 32px 0 4px 0;
            }
        }

        @media (max-width: 600px) {
            .section {
                padding: 20px 0;
            }

            .testi-title {
                font-size: 1.12rem;
            }

            .testi-card {
                padding: 18px 7vw 10px 7vw;
            }

            .testi-avatar {
                width: 55px;
                height: 55px;
            }
        }

        .counter-section {
            /*   background: linear-gradient(rgba(30, 20, 10, 0.73), rgba(30, 20, 10, 0.73)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=facearea&w=1200&q=80') center/cover no-repeat; */
            padding: 56px 20px 44px 0;
        }

        .counter-wrap {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            gap: 30px;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .counter-item {
            flex: 1 1 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
            margin-bottom: 20px;
        }

        .counter-circle {
            border: 2px dashed black;
            border-radius: 50%;
            width: 130px;
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            position: relative;
        }

        .counter-icon {
            position: absolute;
            bottom: -18px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: #fff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            font-size: 1.25em;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        .counter-num {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .counter-label {
            font-size: 1.07rem;
            font-weight: 600;
            color: #ff8000;
            margin-top: 18px;
            letter-spacing: 0.2px;
        }

        @media (max-width: 900px) {
            .counter-wrap {
                gap: 15px;
            }

            .counter-circle {
                width: 90px;
                height: 90px;
            }
        }

        @media (max-width: 650px) {
            .counter-wrap {
                flex-direction: column;
                gap: 30px;
            }
        }

        /*  banner */
        .bg-main-hero {
            background: url('img/banner1.jpg');
            background-size: cover;
            background-position: center;
        }

        .overlay-bg {
            background: rgba(32, 39, 53, 0.67);
            backdrop-filter: blur(2px);
        }

        /* Hide scrollbar for slider */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
@include('layouts.user.header')

<body class="bg-gray-light text-white" @if(session('success')) data-success="{{ session('success') }}"
@elseif(session('error')) data-error="{{ session('error') }}" @endif>
    <!-- Delivery Section -->
    <div class="relative min-h-[430px] md:min-h-[510px] bg-main-hero flex items-center justify-center">
        <!-- Overlay -->
        <div class="absolute inset-0 overlay-bg z-0"></div>
        <!-- Content -->
        <div
            class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between w-full max-w-5xl px-6 py-8">
            <!-- Left Text -->
            <div class="md:max-w-[60%] text-white">
                <div class="text-white-700 font-semibold text-base mb-1">Khơi Dậy Đam Mê BBQ</div>
                <h1 class="text-2xl md:text-4xl font-bold leading-tight mb-2">Thưởng Thức BBQ Tuyệt Hảo<br>Cùng Bạn Bè &
                    Gia Đình</h1>
                <p class="text-sm md:text-base mb-6 text-gray-100">Khám phá thực đơn BBQ thơm ngon với các món nướng đậm
                    vị, không gian ấm cúng, phục vụ tận tâm và ưu đãi hấp dẫn mỗi ngày.</p>
                <!-- Search box -->
                <!-- Search form (giữ UI gốc) -->
                <form id="hero-search-form"
                    class="flex items-center gap-2 bg-white/80 rounded-full px-2 py-1 max-w-2xl w-full shadow-lg mx-auto mt-8">
                    <input id="hero-search-input" type="text" placeholder="Tìm..." autocomplete="off"
                        class="flex-1 bg-transparent text-gray-900 px-5 py-3 rounded-l-full outline-none border-none placeholder-gray-400 text-lg">
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full font-medium text-lg">Tìm
                        Kiếm</button>
                </form>

                <!-- Popup kết quả -->
                <div id="search-dropdown"
                    class="hidden absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-2xl shadow-lg max-h-80 overflow-y-auto z-50 text-base sm:text-base">
                    <!-- Kết quả AJAX sẽ hiện ở đây -->
                </div>
            </div>
            <!-- Right image circle + sale -->
            <div class="relative mt-10 md:mt-0 md:ml-8 flex-shrink-0 flex items-center justify-center">
                <!-- Circle image -->
                <div
                    class="relative w-36 h-36 md:w-48 md:h-48 rounded-full overflow-hidden border-4 border-white shadow-lg">
                    <img src="img/logo2.jpg" alt="Pasta" class="w-full h-full object-cover">
                </div>
                <!-- Sale badge -->
                <span
                    class="absolute -top-4 -left-4 bg-red-600 text-white font-bold text-xs px-4 py-2 rounded-full z-10 shadow-md">
                    35%<br>off
                </span>
            </div>
        </div>
    </div>
    <!-- Directory -->
    <section>
        <div class="menu-section">
            <div class="menu-header">
                <div>
                    <span style="color:#e60012;font-weight:700;font-size:1.13em;">Thực Đơn Món Ăn <i
                            class="fa-solid fa-seedling"></i></span>
                    <div class="menu-title text-back-g">Món ăn ngon phổ biến</div>
                </div>
                <div class="menu-filters">
                    <button class="filter-btn active" data-type="all">Tất Cả</button>
                    <button class="filter-btn" data-type="Món nướng BBQ">Món nướng BBQ</button>
                    <button class="filter-btn" data-type="Món khai vị">Món khai vị</button>
                    <button class="filter-btn" data-type="Đồ uống">Đồ uống</button>
                    <button class="filter-btn" data-type="Tráng miệng">Tráng miệng</button>
                </div>
            </div>

            <div id="menu-grid" class="menu-grid">
                @foreach ($allFoods as $allFood)
                    <div class="menu-card" data-type="{{ $allFood->menus->name }}">
                        <img src="{{ asset('img/' . $allFood->image) }}" alt="">
                        <span class="menu-badge">{{ $allFood->menus->name }}</span>
                        <div class="menu-card-content">
                            <div class="menu-card-title">{{ $allFood->name }}</div>
                            <div class="menu-card-rating">
                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                    class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                                <span>24</span>
                            </div>
                            <div class="menu-card-price">{{ $allFood->price }} VNĐ<span class="old">$90.00</span></div>
                            <div class="menu-card-footer">
                                <button type="button"
                                    class="add-to-cart flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-full font-semibold text-sm transition focus:outline-none shadow"
                                    data-food-id="{{ $allFood->id }}" aria-label="Thêm vào giỏ hàng">
                                    <i class="fa fa-cart-plus"></i>
                                    Thêm vào giỏ
                                </button>
                                <button type="button" class="favorite-btn flex items-center justify-center w-10 h-10 rounded-full border-2 border-[#e60012] transition
                        {{ in_array($allFood->id, $favIds) ? 'bg-[#e60012] text-white' : 'bg-white text-[#e60012]' }}"
                                    data-food-id="{{ $allFood->id }}" aria-label="Yêu thích">
                                    <i
                                        class="{{ in_array($allFood->id, $favIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }} text-lg"></i>
                                </button>
                                <button class="icon-btn"><a
                                        href="{{ route('views.menudetail', [$allFood->id, $allFood->slug]) }}"><i
                                            class="fa-regular fa-eye"></i></a></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- PHÂN TRANG -->
            <div id="pagination" class="flex justify-center items-center gap-2 mt-6"></div>

            <!-- FILTER + PAGINATION SCRIPT -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const filterButtons = document.querySelectorAll('.filter-btn');
                    const cards = document.querySelectorAll('.menu-card');
                    const paginationContainer = document.getElementById('pagination');
                    const itemsPerPage = 8;
                    let currentPage = 1;

                    function paginate(cardsArray, page) {
                        const start = (page - 1) * itemsPerPage;
                        const end = start + itemsPerPage;

                        cards.forEach(card => card.style.display = "none");
                        cardsArray.forEach((card, index) => {
                            if (index >= start && index < end) {
                                card.style.display = "block";
                            }
                        });
                    }

                    function renderPagination(cardsArray) {
                        paginationContainer.innerHTML = "";
                        const totalPages = Math.ceil(cardsArray.length / itemsPerPage);
                        if (totalPages <= 0) return;

                        for (let i = 1; i <= totalPages; i++) {
                            const btn = document.createElement("button");
                            btn.textContent = i;
                            btn.className = `w-8 h-8 border rounded ${i === currentPage ? 'bg-[#e60012] text-white font-bold' : 'text-gray-700 border-gray-300'} hover:bg-[#e60012] hover:text-white transition`;
                            btn.addEventListener("click", () => {
                                currentPage = i;
                                paginate(cardsArray, currentPage);
                                renderPagination(cardsArray);
                            });
                            paginationContainer.appendChild(btn);
                        }
                    }

                    function applyFilter(selectedType) {
                        const filteredCards = [...cards].filter(card =>
                            selectedType === 'all' || card.dataset.type.trim().toLowerCase() === selectedType.trim().toLowerCase()
                        );

                        currentPage = 1;
                        paginate(filteredCards, currentPage);
                        renderPagination(filteredCards);
                    }

                    // Gắn sự kiện click cho filter
                    filterButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            filterButtons.forEach(btn => btn.classList.remove('active'));
                            button.classList.add('active');
                            const selectedType = button.dataset.type;
                            applyFilter(selectedType);
                        });
                    });

                    // Khởi động mặc định với "Tất cả"
                    applyFilter('all');
                });
            </script>

        </div>
    </section>


    <!-- Menu Sale -->
    <div class="offer-section bg-gray-200 py-8">
        <div class="container mx-auto px-3">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <span class="text-red-600 font-bold text-lg">Khuyến Mãi Hằng Ngày</span>
                    <h2 class="text-gray-900 font-extrabold text-xl mt-2">Giảm giá lên đến 75% cho ngày này</h2>
                </div>
                <div class="swiper-buttons hidden md:flex gap-2">
                    <button class="swiper-button-prev text-2xl px-2">&#8592;</button>
                    <button class="swiper-button-next text-2xl px-2">&#8594;</button>
                </div>
            </div>
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($combos as $combo)
                        <div class="swiper-slide">
                            <a href="{{ route('views.combodetail', $combo->id) }}">
                                <div
                                    class="bg-white rounded-xl shadow p-3 w-80 mx-auto hover:scale-105 transition-transform duration-200">
                                    <div class="relative">
                                        <img src="{{ Str::startsWith($combo->image, 'http') ? $combo->image : asset('img/combo/' . $combo->image) }}"
                                            class="w-full h-36 object-cover rounded-lg" alt="{{ $combo->name }}">
                                        <span
                                            class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-md font-bold shadow">-{{ rand(20, 60) }}%
                                            Off</span>
                                    </div>
                                    <h3 id="booking" class="text-blue-900 font-extrabold mt-3 mb-1 text-base truncate">
                                        {{ $combo->name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2 truncate">{{ $combo->note }}</p>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-red-600 font-bold text-lg">{{ number_format($combo->price, 0, ',', '.') }}₫</span>
                                        <span class="flex gap-1">
                                            <span
                                                class="bg-orange-500 text-white rounded-full w-7 h-7 flex items-center justify-center"><i
                                                    class="fa fa-shopping-basket"></i></span>
                                            <span
                                                class="bg-orange-500 text-white rounded-full w-7 h-7 flex items-center justify-center"><i
                                                    class="fa fa-heart"></i></span>
                                            <span
                                                class="bg-orange-500 text-white rounded-full w-7 h-7 flex items-center justify-center"><i
                                                    class="fa fa-eye"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!--Booking -->
    <section>
        <div class="booking-section">
            <img class="booking-img" src="img/logo2.jpg" alt="Restaurant" />
            <div class="booking-form-bg">
                <form class="booking-form" method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <h2>Đặt Bàn</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Tên</label>
                            <input type="text" name="nameuser" placeholder="Tên" required value="{{ old('nameuser') }}">
                        </div>
                        <div style="flex:1">
                            <label>E-mail</label>
                            <input type="email" name="email" placeholder="E-mail" required value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Số Điện Thoại</label>
                            <input type="text" name="sdt" placeholder="Số Điện Thoại" required value="{{ old('sdt') }}">
                        </div>
                        <div style="flex:1">
                            <label>Ngày Đặt Bàn</label>
                            <input type="date" name="date" required value="{{ old('date') }}">
                        </div>
                    </div>
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Thời Gian</label>
                            <select name="time" required>
                                <option value="">Chọn Thời Gian</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:00">12:00 PM</option>
                                <option value="13:00">1:00 PM</option>
                                <option value="14:00">2:00 PM</option>
                                <option value="17:00">5:00 PM</option>
                                <option value="18:00">6:00 PM</option>
                                <option value="19:00">7:00 PM</option>
                                <option value="20:00">8:00 PM</option>
                            </select>
                        </div>
                        <div style="flex:1">
                            <label>Số Lượng Người</label>
                            <select name="quantitypeople" required>
                                <option value="">Chọn Số Lượng</option>
                                <option value="1">1 Người</option>
                                <option value="2">2 Người</option>
                                <option value="3">3 Người</option>
                                <option value="4">4 Người</option>
                                <option value="5">5+ Người</option>
                            </select>
                        </div>
                    </div>
                    <div id="form-message" style="margin:10px 0"></div>
                    <button type="submit">Confirm</button>
                </form>

            </div>
        </div>
    </section>

    <!--chefs -->
    <section>
        <div class="section text-center">
            <div class="testi-subtitle">Lời Góp Ý <i class="fa-solid fa-seedling"></i></div>
            <div class="testi-title text-back-g">Phản Hồi Khách Hàng</div>
            <div class="testi-slider-wrap">
                <div class="testi-nav">
                    <button class="testi-nav-btn swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="testi-nav-btn swiper-button-next"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
                <div class="swiper testiSwiper">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <div class="testi-card">
                                <div class="testi-avatar-wrap">
                                    <img src="img/mtien2.jpg" class="testi-avatar" alt="">
                                </div>
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <span class="testi-quote"><i class="fa-solid fa-quote-left"></i></span>
                                    <span class="testi-name">NGUYỄN MINH TIẾN</span>
                                </div>
                                <div class="testi-pos">NYC MLB</div>
                                <div class="testi-content">
                                    Khó tính, dễ dỗi, phân biệt vùng miền, chiều cao 1m75, cần nặng 67kg.
                                </div>
                                <div class="testi-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-regular fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <div class="testi-card">
                                <div class="testi-avatar-wrap">
                                    <img src="img/hdong2.jpg" class="testi-avatar" alt="">
                                </div>
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <span class="testi-quote"><i class="fa-solid fa-quote-left"></i></span>
                                    <span class="testi-name">Nguyễn Huy Đông</span>
                                </div>
                                <div class="testi-pos">NYC USA</div>
                                <div class="testi-content">
                                    Đẹp trai, vui tính, ăn nói lưu loát, chiều cao 1m69.5, cân nặng 66kg.
                                </div>
                                <div class="testi-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-regular fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 (sample) -->

                    </div>
                </div>
            </div>
        </div>

        <!-- Counter Section -->
        <section class="py-10 bg-cover bg-center relative" style="background-image:url('img/logo2.jpg');">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            <div class="relative max-w-5xl mx-auto flex flex-wrap justify-between items-center gap-3 z-10 px-2">
                <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
                    <div
                        class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
                        <span class="counter font-bold text-white text-2xl md:text-3xl"
                            data-to="{{ $countUser }}">0</span><span
                            class="font-bold text-white text-2xl md:text-3xl">+</span>
                    </div>
                    <div class="text-white text-xs mt-2">Khách Hàng</div>
                </div>
                <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
                    <div
                        class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
                        <span class="counter font-bold text-white text-2xl md:text-3xl"
                            data-to="{{ $countStaff }}">0</span><span
                            class="font-bold text-white text-2xl md:text-3xl">+</span>
                    </div>
                    <div class="text-white text-xs mt-2">Nhân Viên</div>
                </div>
                <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
                    <div
                        class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
                        <span class="counter font-bold text-white text-2xl md:text-3xl"
                            data-to="{{ $countRate }}">0</span><span
                            class="font-bold text-white text-2xl md:text-3xl">+</span>
                    </div>
                    <div class="text-white text-xs mt-2">Đánh Giá</div>
                </div>
                <div class="flex-1 min-w-[160px] flex flex-col items-center py-6">
                    <div
                        class="counter-circle w-28 h-28 flex items-center justify-center rounded-full bg-white bg-opacity-10 mb-2 border-4 border-orange-400">
                        <span class="counter font-bold text-white text-2xl md:text-3xl" data-to="5">2</span><span
                            class="font-bold text-white text-2xl md:text-3xl ml-2"> Yoe</span>
                    </div>
                    <div class="text-white text-xs mt-2">Kinh Nghiệm</div>
                </div>
            </div>
        </section>
    </section>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        // COUNTER EFFECT
        function animateCounter(el) {
            const to = +el.dataset.to;
            let current = 0, inc = Math.ceil(to / 50);
            function update() {
                current += inc;
                if (current >= to) {
                    el.textContent = to.toLocaleString();
                } else {
                    el.textContent = current.toLocaleString();
                    requestAnimationFrame(update);
                }
            }
            update();
        }
        document.querySelectorAll('.counter').forEach(el => animateCounter(el));
    </script>
    <script>
        // Sale slider
        var swiperSale = new Swiper('.mySwiper', {
            slidesPerView: 2,
            spaceBetween: 18,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.1,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 18,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
            },
        });
        //chefs
        var swiperTesti = new Swiper('.testiSwiper', {
            slidesPerView: 2,
            spaceBetween: 32,
            loop: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: '.testi-nav-btn.swiper-button-next',
                prevEl: '.testi-nav-btn.swiper-button-prev',
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                900: { slidesPerView: 2 }
            }
        });
    </script>
    <!--BookingTable-->
    <script>
        $('.booking-form').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type=submit]');
            var $msg = $('#form-message');
            $btn.prop('disabled', true);
            $msg.html('');
            $.ajax({
                url: "{{ route('booking.store') }}",
                method: 'POST',
                data: $form.serialize(),
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (res) {
                    if (res.status === 'success') {
                        $msg.html('<div style="color:green">' + res.message + '</div>');
                        $form[0].reset();
                    } else {
                        $msg.html('<div style="color:red">' + (res.errors ? res.errors.join('<br>') : 'Có lỗi xảy ra') + '</div>');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        $msg.html('<div style="color:red">' + xhr.responseJSON.errors.join('<br>') + '</div>');
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $msg.html('<div style="color:red">' + xhr.responseJSON.errors.join('<br>') + '</div>');
                    } else {
                        $msg.html('<div style="color:red">Lỗi không xác định!</div>');
                    }
                },
                complete: function () {
                    $btn.prop('disabled', false);
                }
            });
        });
        // tìm kiếm
        $(document).ready(function () {
            function renderResults(data) {
                if (data.results && data.results.length) {
                    let html = data.results.map(food => `
                <div class="flex items-center gap-4 px-4 py-3 hover:bg-gray-100 cursor-pointer border-b last:border-b-0" onclick="window.location='/menudetail/${food.id}/${food.slug ?? ''}'">
                    <img src="${food.image}" class="w-14 h-14 rounded-lg object-cover border" alt="">
                    <div>
                        <div class="font-bold text-[#e60012] text-base mb-1">${food.text}</div>
                        <div class="text-gray-800 text-sm mb-1">Giá: <b>${food.price} VNĐ</b></div>
                        <div class="text-gray-600 text-xs">${food.desc ?? ''}</div>
                    </div>
                </div>
            `).join('');
                    $('#search-dropdown').html(html).removeClass('hidden');
                } else {
                    $('#search-dropdown').html(`<div class="px-6 py-4 text-gray-500 text-center">Không tìm thấy món ăn nào.</div>`).removeClass('hidden');
                }
            }

            // Khi gõ search (keyup)
            $('#hero-search-input').on('input', function () {
                let keyword = $(this).val().trim();
                if (!keyword) {
                    $('#search-dropdown').addClass('hidden').html('');
                    return;
                }
                $.ajax({
                    url: "{{ route('food.search') }}",
                    data: { term: keyword },
                    dataType: 'json',
                    success: renderResults,
                    error: function () {
                        $('#search-dropdown').html(`<div class="px-6 py-4 text-red-600 text-center">Có lỗi xảy ra, thử lại!</div>`).removeClass('hidden');
                    }
                });
            });

            // Submit form cũng trigger search (giữ lại)
            $('#hero-search-form').on('submit', function (e) {
                e.preventDefault();
                $('#hero-search-input').trigger('input');
            });

            // Ẩn dropdown khi click ra ngoài hoặc xóa input
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#hero-search-input, #search-dropdown').length) {
                    $('#search-dropdown').addClass('hidden');
                }
            });
            // Ẩn dropdown khi clear input
            $('#hero-search-input').on('blur', function () {
                setTimeout(() => $('#search-dropdown').addClass('hidden'), 200);
            });
        });

        //thêm giỏ hàng
        $(document).ready(function () {
            // Lắng nghe click vào nút Thêm Vào Giỏ Hàng
            $('.menu-section').on('click', '.add-to-cart', function () {
                var foodId = $(this).data('food-id');
                var btn = $(this);
                btn.prop('disabled', true);
                $.ajax({
                    url: "{{ route('cart.add') }}", // Đường dẫn route Laravel thêm vào giỏ hàng
                    method: "POST",
                    data: {
                        food_id: foodId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            // Có thể hiện thông báo popup hoặc toast
                            alert("Đã thêm vào giỏ hàng!");
                        } else {
                            alert(response.message || "Có lỗi khi thêm vào giỏ hàng!");
                        }
                    },
                    error: function () {
                        alert("Có lỗi xảy ra, thử lại sau!");
                    },
                    complete: function () {
                        btn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
@include('layouts.user.footer')


</html>