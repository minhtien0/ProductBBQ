<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUA BE HOY</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
                        'back-g':'#1a1a1a',
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
            height: 490px;
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
            gap: 9px;
            align-items: center;
        }

        .menu-card-footer button,
        .menu-card-footer a {
            border: 2px solid var(--primary);
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            border-radius: 5px;
            padding: 6px 15px;
            font-size: .98em;
            cursor: pointer;
            transition: background .18s, color .18s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .menu-card-footer .icon-btn {
            padding: 6px 10px;
            background: #fff;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 5px;
            font-size: 1em;
        }

        .menu-card-footer .icon-btn:hover {
            background: var(--primary);
            color: #fff;
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
            color:#ff8000;
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
<body class="bg-gray-light text-white">
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
                <form class="flex items-center gap-2 bg-white/80 rounded-full px-2 py-1 max-w-lg w-full shadow-lg">
                    <input type="text" placeholder="Search…"
                        class="flex-1 bg-transparent text-gray-900 px-3 py-2 rounded-l-full outline-none border-none placeholder-gray-400 text-sm">
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full font-medium text-sm">Search</button>
                </form>
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
                    <span style="color:#e60012;font-weight:700;font-size:1.13em;">Food Menu <i
                            class="fa-solid fa-seedling"></i></span>
                    <div class="menu-title text-back-g">Popular Delicious Foods</div>
                </div>
                <div class="menu-filters">
                    <button class="active">All Menu</button>
                    <button>Sườn</button>
                    <button>Ba chỉ</button>
                    <button>Món ăn kèm</button>
                    <button>Nước uống</button>
                </div>
            </div>
            <div class="menu-grid">
                <!-- Card 1 -->
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-card">
                    <img src="img/danhmuc1/suon.jpg" alt="">
                    <span class="menu-badge">Biryani</span>
                    <div class="menu-card-content">
                        <div class="menu-card-title">Hyderabadi Biryani</div>
                        <div class="menu-card-rating">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                            <span>24</span>
                        </div>
                        <div class="menu-card-price">$65.00 <span class="old">$90.00</span></div>
                        <div class="menu-card-footer">
                            <button>Add To Cart</button>
                            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
                            <button class="icon-btn"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </div>
                </div>
    </section>

    <!-- Menu Sale -->
    <div class="offer-section bg-gray-light">
        <div class="offer-wrapper">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div>
                    <span style="color:rgb(230 0 18); font-weight:bold; font-size:18px;">Daily Offer</span>
                    <h2 class="text-back-g" style="font-size:1.4rem; font-weight:900; margin:10px 0 0 0; ">Up To 75%
                        Off For This Day</h2>
                </div>
                <div class="swiper-buttons">
                    <button class="swiper-button-prev">&#8592;</button>
                    <button class="swiper-button-next">&#8594;</button>
                </div>
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Card 1 -->
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/danhmuc1/combogiadinh.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">40%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Beef
                            Masala</h3>
                        <p style="color:#888;font-size:0.93rem;">Combo Dành cho gia đình</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/danhmuc1/suon.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Sườn.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/danhmuc1/suon6mon.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Sườn 6 món</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/danhmuc1/suontang.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/danhmuc1/suonxe.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/combo/1.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/combo/3.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/combo/4.jpg"
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div style="position:relative;">
                            <img src="img/combo/3.jpg" 
                                style="width:100%;height:120px;object-fit:cover;border-radius:8px;">
                            <span class="product-img-badge">55%<br>Off</span>
                        </div>
                        <h3 id="booking" style="color:#262465;font-weight:900;margin:12px 0 6px 0;font-size:1.1rem;">Dal
                            Makhani</h3>
                        <p style="color:#888;font-size:0.93rem;">Enim ipsam volutpat in quia voluptas sit
                            aspernatur aut odit aut.</p>
                        <div  style="display:flex;gap:8px;margin-top:10px;">
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-shopping-basket"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-heart"></i></span>
                            <span
                                style="background:#ff8000;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:14px;"><i
                                    class="fa fa-eye"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div >


    <!--     Booking -->
    <section>
        <div class="booking-section">
            <img class="booking-img" src="img/logo2.jpg" alt="Restaurant" />
            <div class="booking-form-bg">
                <form class="booking-form">
                    <h2>Book A Table</h2>
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Name</label>
                            <input type="text" placeholder="Name" required>
                        </div>
                        <div style="flex:1">
                            <label>Email</label>
                            <input type="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Phone</label>
                            <input type="text" placeholder="Phone" required>
                        </div>
                        <div style="flex:1">
                            <label>Select Date</label>
                            <input type="date" placeholder="DD/MM/YYYY" required>
                        </div>
                    </div>
                    <div class="booking-form-row">
                        <div style="flex:1">
                            <label>Select Time</label>
                            <select required>
                                <option value="">Select</option>
                                <option>11:00 AM</option>
                                <option>12:00 PM</option>
                                <option>1:00 PM</option>
                                <option>2:00 PM</option>
                                <option>5:00 PM</option>
                                <option>6:00 PM</option>
                                <option>7:00 PM</option>
                                <option>8:00 PM</option>
                            </select>
                        </div>
                        <div style="flex:1">
                            <label>Select Person</label>
                            <select required>
                                <option value="">Select</option>
                                <option>1 Person</option>
                                <option>2 People</option>
                                <option>3 People</option>
                                <option>4 People</option>
                                <option>5+ People</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </section>
  
    <!--chefs -->
    <section>
        <div class="section text-center">
            <div class="testi-subtitle">Testimonial <i class="fa-solid fa-seedling"></i></div>
            <div class="testi-title text-back-g" >Our Customar Feedbacks</div>
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
        <div class="counter-section">
            <div class="counter-wrap">
                <div class="counter-item">
                    <div class="counter-circle">
                        <div class="counter-num">85,000 +</div>
                        <div class="counter-icon"><i class="fa fa-users"></i></div>
                    </div>
                    <div class="counter-label">Customer Serve</div>
                </div>
                <div class="counter-item">
                    <div class="counter-circle">
                        <div class="counter-num">120 +</div>
                        <div class="counter-icon"><i class="fa fa-hat-chef"></i></div>
                    </div>
                    <div class="counter-label">Experience Chef</div>
                </div>
                <div class="counter-item">
                    <div class="counter-circle">
                        <div class="counter-num">72,000 +</div>
                        <div class="counter-icon"><i class="fa fa-face-smile"></i></div>
                    </div>
                    <div class="counter-label">Happy Customer</div>
                </div>
                <div class="counter-item">
                    <div class="counter-circle">
                        <div class="counter-num">30 +</div>
                        <div class="counter-icon"><i class="fa fa-trophy"></i></div>
                    </div>
                    <div class="counter-label">Winning Award</div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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
</body>
@include('layouts.user.footer')


</html>