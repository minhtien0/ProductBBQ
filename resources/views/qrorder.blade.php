<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japanese BBQ Gyu-Kaku</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
                    },
                },
            },
        };
    </script>
    <style>
        /* Ensure Tailwind hidden toggles correctly */
        .cart-popup:not(.hidden) {
            display: flex;
        }
        /* Image hover effect */
        img {
            transition: transform 0.2s;
        }
        img:hover {
            transform: scale(1.05);
        }
        /* Touch-friendly buttons */
        button {
            min-height: 44px;
        }
        /* Swiper pagination for mobile */
        .swiper-pagination-bullet {
            background-color: #fff;
            opacity: 0.5;
        }
        .swiper-pagination-bullet-active {
            background-color: #e60012;
            opacity: 1;
        }
        /* Responsive for iPhone 12 Pro (390px) */
        @media (max-width: 390px) {
            .product-item img {
                width: 48px;
                height: 48px;
            }
            .cart-item img {
                width: 40px;
                height: 40px;
            }
            .cart-popup-content {
                width: 95%;
            }
            .swiper-pagination {
                bottom: 8px;
                padding-right: 8px;
            }
            .swiper-pagination-bullet {
                width: 6px;
                height: 6px;
            }
        }
    </style>
</head>
<body class="bg-dark-bg text-white">
    <div class="container max-w-5xl mx-auto p-4 md:p-2">
        <!-- Section 1: Promotion -->
        <section class="promotion-section mb-4">
            <div class="carousel-container w-full p-4 bg-gray-dark rounded-lg">
                <div class="swiper h-64 md:h-48">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide flex flex-col justify-center p-4 bg-[url('img/banner1.jpg')] bg-cover bg-center rounded-lg">
                            <h1 class="text-4xl md:text-2xl font-bold text-red-primary mb-2">ƯU ĐÃI CÓ HẠN<br><span class="text-white">Buffet RỒNG LÂU -15%</span></h1>
                            <p class="text-sm md:text-xs mb-2">Đặc biệt áp dụng từ 1/6 cho đến hết ngày 30/6</p>
                            <div class="price-box flex gap-2 mb-4">
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-xs text-white">Ưu đãi nổi bật</p>
                                    <h3 class="text-lg md:text-base font-bold text-white">489.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-xs text-white">Buffet chỉ từ</p>
                                    <h3 class="text-lg md:text-base font-bold text-white">299.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-xs text-white">Ưu đãi lớn</p>
                                    <h3 class="text-lg md:text-base font-bold text-white">TẶNG BỘT</h3>
                                </div>
                            </div>
                            <p class="text-xs md:text-[10px] mb-2">*áp dụng tại tất cả cửa hàng</p>
                            <button class="bg-red-primary text-white p-2 rounded text-sm md:text-xs hover:bg-red-hover transition-colors w-32 md:w-28">XEM NGAY</button>
                        </div>
                        <div class="swiper-slide flex flex-col justify-center p-4 bg-[url('img/banner1.jpg')] bg-cover bg-center rounded-lg">
                            <h1 class="text-4xl md:text-2xl font-bold text-red-primary mb-2">ƯU ĐÃI ĐẶC BIỆT<br><span class="text-white">Buffet HÈ NÀY -10%</span></h1>
                            <p class="text-sm md:text-xs mb-2">Áp dụng từ 15/5 đến 15/7</p>
                            <div class="price-box flex gap-2 mb-4">
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-xs text-white">Giá mới</p>
                                    <h3 class="text-lg md:text-base font-bold text-white">349.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-xs text-white">Ưu đãi thêm</p>
                                    <h3 class="text-lg md:text-base font-bold text-white">TẶNG NƯỚC</h3>
                                </div>
                            </div>
                            <p class="text-xs md:text-[10px] mb-2">*Chỉ áp dụng tại một số chi nhánh</p>
                            <button class="bg-red-primary text-white p-2 rounded text-sm md:text-xs hover:bg-red-hover transition-colors w-32 md:w-28">XEM NGAY</button>
                        </div>
                    </div>
                    <div class="swiper-pagination text-right pr-4 md:pr-2"></div>
                </div>
            </div>
        </section>

        <!-- Section 2: Delivery -->
        <section class="delivery-section flex gap-4 md:flex-col md:gap-2 mb-4">
            <div class="delivery-promo w-1/3 md:w-full bg-white text-black p-4 md:p-2 rounded-lg text-center">
                <img src="img/combo/3.jpg" alt="Delivery" class="w-full h-auto max-h-48 md:max-h-40 rounded-lg mb-2 object-cover">
                <h2 class="text-2xl md:text-lg font-bold">COMBO NGON SHIP TẬN TAY</h2>
            </div>
            <div class="delivery-info w-2/3 md:w-full bg-gray-dark p-4 md:p-2 rounded-lg">
                <h3 class="text-2xl md:text-lg text-red-primary mb-2">Gói Gyu Ngay - Ship Tận Tay</h3>
                <ul class="list-none mb-2">
                    <li class="text-sm md:text-xs text-gray-light mb-1">Thời gian giao hàng dự kiến: 30 - 45 phút</li>
                    <li class="text-sm md:text-xs text-gray-light mb-1">Phí giao hàng: Miễn phí cho đơn hàng từ 300.000 VNĐ</li>
                    <li class="text-sm md:text-xs text-gray-light mb-1">Đơn hàng dưới 300.000 VNĐ phí ship 20.000 VNĐ</li>
                    <li class="text-sm md:text-xs text-gray-light mb-1">Giao hàng trong giờ hành chính từ 10:00 - 20:00</li>
                    <li class="text-sm md:text-xs text-gray-light mb-1">Hỗ trợ giao hàng qua các ứng dụng: Grab, Be, Baemin</li>
                </ul>
                <button class="bg-red-primary text-white p-2 rounded text-sm md:text-xs hover:bg-red-hover transition-colors w-full md:w-32">ĐẶT NGAY</button>
            </div>
        </section>

        <!-- Section 3: Menu -->
        <section class="menu-section mb-4">
            <div class="menu-container flex gap-4 md:flex-col md:gap-2">
                <!-- Category Column -->
                <div class="category-column w-1/4 md:w-full p-4 md:p-2 bg-gray-dark rounded-lg">
                    <h2 class="text-2xl md:text-lg mb-2 text-red-primary">Danh Mục</h2>
                    <button class="category-btn block w-full p-2 mb-1 bg-gray-darker rounded text-left text-sm md:text-xs text-white hover:bg-red-primary transition-colors" data-category="special">Món ăn đặc biệt</button>
                    <button class="category-btn block w-full p-2 mb-1 bg-gray-darker rounded text-left text-sm md:text-xs text-white hover:bg-red-primary transition-colors" data-category="vegetable">Món rau</button>
                    <button class="category-btn block w-full p-2 mb-1 bg-gray-darker rounded text-left text-sm md:text-xs text-white hover:bg-red-primary transition-colors" data-category="drink">Đồ uống</button>
                </div>
                <!-- Product Column -->
                <div class="product-column w-3/4 md:w-full p-4 md:p-2 bg-gray-dark rounded-lg">
    <h2 class="text-2xl md:text-lg mb-2 text-red-primary">Sản Phẩm</h2>
    <div class="product-list flex flex-wrap gap-2 md:flex-col md:gap-2">
        <!-- Món ăn đặc biệt -->
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="special">
            <img src="img/combo/1.jpg" alt="Thịt Cá Sấu" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Thịt Cá Sấu</h3>
            <p class="text-xs md:text-[10px] text-gray-light">180,000 VNĐ</p>
            <button onclick="addToCart('Thịt Cá Sấu', 180000, 'img/combo/1.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="special">
            <img src="img/combo/1.jpg" alt="Thịt Cá Sấu" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Thịt Cá Sấu</h3>
            <p class="text-xs md:text-[10px] text-gray-light">180,000 VNĐ</p>
            <button onclick="addToCart('Thịt Cá Sấu', 180000, 'img/combo/1.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="special">
            <img src="img/combo/1.jpg" alt="Thịt Cá Sấu" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Thịt Cá Sấu</h3>
            <p class="text-xs md:text-[10px] text-gray-light">180,000 VNĐ</p>
            <button onclick="addToCart('Thịt Cá Sấu', 180000, 'img/combo/1.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="special">
            <img src="img/combo/1.jpg" alt="Thịt Cá Sấu" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Thịt Cá Sấu</h3>
            <p class="text-xs md:text-[10px] text-gray-light">180,000 VNĐ</p>
            <button onclick="addToCart('Thịt Cá Sấu', 180000, 'img/combo/1.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="special">
            <img src="img/combo/1.jpg" alt="Thịt Cá Sấu" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Thịt Cá Sấu</h3>
            <p class="text-xs md:text-[10px] text-gray-light">180,000 VNĐ</p>
            <button onclick="addToCart('Thịt Cá Sấu', 180000, 'img/combo/1.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
        
        <!-- Đồ uống -->
        <div class="product-item w-[48%] md:w-full p-2 md:p-1.5 bg-gray-darker rounded shadow text-center" data-category="drink">
            <img src="img/nuoc_cam.jpg" alt="Nước Cam" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
            <h3 class="text-sm md:text-xs my-1 mx-2 text-white">Nước Cam</h3>
            <p class="text-xs md:text-[10px] text-gray-light">30,000 VNĐ</p>
            <button onclick="addToCart('Nước Cam', 30000, 'img/nuoc_cam.jpg')" class="bg-red-primary text-white p-2 rounded w-full text-xs md:text-[10px] hover:bg-red-hover transition-colors">Thêm</button>
        </div>
    </div>
    <button class="cart-toggle bg-red-primary text-white p-2 rounded w-full text-sm md:text-xs mt-2 hover:bg-red-hover transition-colors z-10" onclick="toggleCart()">Xem Giỏ Hàng</button>
</div>
            </div>
            <!-- Cart Popup -->
            <div class="cart-popup hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50" id="cart-popup">
                <div class="cart-popup-content bg-gray-dark max-w-[95%] w-[350px] max-h-[80vh] overflow-y-auto p-3 md:p-2 rounded-lg relative">
                    <button class="close-btn absolute top-2 right-2 bg-red-primary text-white rounded-full w-6 h-6 text-xs flex items-center justify-center hover:bg-red-hover transition-colors" onclick="toggleCart()">×</button>
                    <h2 class="text-xl md:text-base mb-2 text-red-primary">Giỏ Hàng</h2>
                    <div class="cart-items max-h-[300px] overflow-y-auto mb-2" id="cart-items"></div>
                    <p class="text-sm md:text-xs mb-2 text-white" id="cart-total">Tổng: 0 VNĐ</p>
                    <button onclick="clearCart()" class="bg-red-primary text-white p-2 rounded w-full text-sm md:text-xs mb-1 hover:bg-red-hover transition-colors">Xóa Giỏ Hàng</button>
                    <button onclick="checkout()" class="bg-red-primary text-white p-2 rounded w-full text-sm md:text-xs hover:bg-red-hover transition-colors">Thanh Toán</button>
                </div>
            </div>
        </section>

        <!-- Section 4: Food Images -->
        <section class="food-images flex gap-4 md:flex-col md:gap-2 mb-4">
            <img src="img/combo/1.jpg" alt="Food 1" class="w-1/3 md:w-full h-auto rounded-lg object-cover shadow">
            <img src="img/combo/3.jpg" alt="Food 2" class="w-1/3 md:w-full h-auto rounded-lg object-cover shadow">
            <img src="img/combo/3.jpg" alt="Food 3" class="w-1/3 md:w-full h-auto rounded-lg object-cover shadow">
        </section>

        <!-- Footer -->
        <footer class="bg-gray-dark p-4 md:p-2">
            <div class="container max-w-5xl mx-auto">
                <div class="footer-content flex gap-4 md:flex-col md:gap-2">
                    <div class="w-1/3 md:w-full">
                        <h4 class="text-lg md:text-base text-white mb-2">Về chúng tôi</h4>
                        <p class="text-sm md:text-xs text-gray-light mb-1">Gyu-Kaku, chuỗi nhà hàng BBQ Nhật Bản nổi tiếng với các món nướng chuẩn vị.</p>
                        <p class="text-sm md:text-xs text-gray-light">Đặt bàn ngay hôm nay!</p>
                    </div>
                    <div class="w-1/3 md:w-full">
                        <h4 class="text-lg md:text-base text-white mb-2">Liên hệ</h4>
                        <p class="text-sm md:text-xs text-gray-light mb-1">Hotline: 1900 1234</p>
                        <p class="text-sm md:text-xs text-gray-light mb-1">Email: contact@gyukaku.vn</p>
                        <p class="text-sm md:text-xs text-gray-light">Địa chỉ: 123 Đường Láng, Hà Nội</p>
                    </div>
                    <div class="w-1/3 md:w-full">
                        <h4 class="text-lg md:text-base text-white mb-2">Liên kết nhanh</h4>
                        <p class="text-sm md:text-xs mb-1"><a href="#" class="text-gray-light hover:text-white">Thực đơn</a></p>
                        <p class="text-sm md:text-xs mb-1"><a href="#" class="text-gray-light hover:text-white">Khuyến mãi</a></p>
                        <p class="text-sm md:text-xs"><a href="#" class="text-gray-light hover:text-white">Đặt bàn</a></p>
                    </div>
                </div>
                <p class="text-sm md:text-xs text-gray-light text-center mt-4">© 2023 Gyu-Kaku. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        let cart = [];

        function addToCart(name, price, image) {
            cart.push({ name, price, image });
            updateCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        function clearCart() {
            cart = [];
            updateCart();
        }

        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                total += item.price;
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item flex items-center m-1.5 md:m-1 bg-gray-darker p-1.5 rounded';
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="w-12 h-12 md:w-10 md:h-10 object-cover rounded shadow mr-2 aspect-square">
                    <span class="flex-1 text-xs md:text-[10px] text-white">${item.name} - ${item.price.toLocaleString()} VNĐ</span>
                    <button onclick="removeFromCart(${index})" class="bg-red-primary text-white px-2 py-1 rounded text-xs md:text-[10px] hover:bg-red-hover transition-colors">Xóa</button>
                `;
                cartItems.appendChild(cartItem);
            });

            document.getElementById('cart-total').textContent = `Tổng: ${total.toLocaleString()} VNĐ`;
        }

        function checkout() {
            if (cart.length === 0) {
                alert('Giỏ hàng trống!');
            } else {
                alert('Thanh toán thành công! Tổng: ' + cart.reduce((sum, item) => sum + item.price, 0).toLocaleString() + ' VNĐ');
                clearCart();
                toggleCart();
            }
        }

        function toggleCart() {
            console.log('toggleCart called'); // Debug log
            const cartPopup = document.getElementById('cart-popup');
            if (cartPopup) {
                cartPopup.classList.toggle('hidden');
            } else {
                console.error('Cart popup not found');
            }
        }

        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.getAttribute('data-category');
                document.querySelectorAll('.product-item').forEach(item => {
                    if (item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>