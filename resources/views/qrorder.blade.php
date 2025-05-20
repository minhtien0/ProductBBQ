<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japanese BBQ Gyu-Kaku</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo2.jpg" alt="Gyu-Kaku Logo">
            <span>BE BE <br>LUA HOY</span>
        </div>
        <nav class="nav-links">
            <a href="#about">Về chúng tôi</a><span>-</span>
            <a href="#menu">Menu</a>
            <a href="#restaurants">Nhà hàng</a>
            <a href="#promotions">Khuyến mãi</a><span>-</span>
            <a href="#blog">Blog</a><span>-</span>
            <a href="#careers">Tuyển dụng</a><span>-</span>
            <a href="#japanese">For Japanese</a>
            <a href="#book-table" class="book-table-btn">Đặt Bàn</a>
        </nav>
    </header>

    <div class="container">
        <!-- Section 1: Promotion -->
        <section class="promotion-section">
            <div class="carousel-container">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="background-image: url('img/banner1.jpg');">
                            <h1>ƯU ĐÃI CÓ HẠN<br><span>Buffet RỒNG LÂU -15%</span></h1>
                            <p>Đặc biệt áp dụng từ 1/6 cho đến hết ngày 30/6</p>
                            <div class="price-box">
                                <div>
                                    <p>Ưu đãi nổi bật</p>
                                    <h3>489.000</h3>
                                </div>
                                <div>
                                    <p>Buffet chỉ từ</p>
                                    <h3>299.000</h3>
                                </div>
                                <div>
                                    <p>Ưu đãi lớn</p>
                                    <h3>TẶNG BỘT</h3>
                                </div>
                            </div>
                            <p>*áp dụng tại tất cả cửa hàng</p>
                            <button style="background-color: #e60012; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">XEM NGAY</button>
                        </div>
                        <div class="swiper-slide"style="background-image: url('img/banner1.jpg');">
                            <h1>ƯU ĐÃI ĐẶC BIỆT<br><span>Buffet HÈ NÀY -10%</span></h1>
                            <p>Áp dụng từ 15/5 đến 15/7</p>
                            <div class="price-box">
                                <div>
                                    <p>Giá mới</p>
                                    <h3>349.000</h3>
                                </div>
                                <div>
                                    <p>Ưu đãi thêm</p>
                                    <h3>TẶNG NƯỚC</h3>
                                </div>
                            </div>
                            <p>*Chỉ áp dụng tại một số chi nhánh</p>
                            <button style="background-color: #e60012; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">XEM NGAY</button>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
          
        </section>

        <!-- Section 2: Delivery -->
        <section class="delivery-section">
            <div class="delivery-promo">
                <img src="img/combo/3.jpg" alt="Delivery">
                <h2>COMBO NGON SHIP TẬN TAY</h2>
            </div>
            <div class="delivery-info">
                <h3>Gói Gyu Ngay - Ship Tận Tay</h3>
                <ul>
                    <li>Thời gian giao hàng dự kiến: 30 - 45 phút</li>
                    <li>Phí giao hàng: Miễn phí cho đơn hàng từ 300.000 VNĐ</li>
                    <li>Đơn hàng dưới 300.000 VNĐ phí ship 20.000 VNĐ</li>
                    <li>Giao hàng trong giờ hành chính từ 10:00 - 20:00</li>
                    <li>Hỗ trợ giao hàng qua các ứng dụng: Grab, Be, Baemin</li>
                </ul>
                <button style="background-color: #e60012; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; margin-top: 10px;">ĐẶT NGAY</button>
            </div>
        </section>

        <!-- Section 3: Menu (Nhúng 3 cột) -->

        <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Nhà Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800">
    <section class="py-8 px-6 max-w-7xl mx-auto">
        <div class="flex gap-8">
            <!-- Cột 1: Danh mục -->
            <div class="w-1/3 p-6 bg-gray-900 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-red-500">Danh Mục</h2>
                <button class="category-btn block w-full py-3 mb-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-red-600 hover:text-white transition duration-300" data-category="special">Món ăn đặc biệt</button>
                <button class="category-btn block w-full py-3 mb-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-red-600 hover:text-white transition duration-300" data-category="vegetable">Món rau</button>
                <button class="category-btn block w-full py-3 mb-3 bg-gray-700 text-gray-100 rounded-lg hover:bg-red-600 hover:text-white transition duration-300" data-category="drink">Đồ uống</button>
            </div>

            <!-- Cột 2: Sản phẩm chi tiết -->
            <div class="w-1/3 p-6 bg-gray-900 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-red-500">Sản Phẩm</h2>
                <div class="max-h-[270px] overflow-y-auto space-y-3">
                    <!-- Món ăn đặc biệt -->
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/combo/1.jpg" alt="Thịt Sâu Cổ" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Thịt Sâu Cổ</h3>
                            <p class="text-gray-400 text-sm">180,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Thịt Sâu Cổ', 180000, 'img/combo/1.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/combo/1.jpg" alt="Thịt Bò Cáp" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Thịt Bò Cáp</h3>
                            <p class="text-gray-400 text-sm">180,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Thịt Bò Cáp', 180000, 'img/combo/1.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/combo/2.jpg" alt="Thịt Bò Nhất" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Thịt Bò Nhất</h3>
                            <p class="text-gray-400 text-sm">220,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Thịt Bò Nhất', 220000, 'img/combo/2.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/bo_bo.jpg" alt="Thịt Bò Bò" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Thịt Bò Bò</h3>
                            <p class="text-gray-400 text-sm">160,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Thịt Bò Bò', 160000, 'img/bo_bo.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/bo_nam.jpg" alt="Thịt Bò Nạm Tuyệt Uc" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Thịt Bò Nạm Tuyệt Uc</h3>
                            <p class="text-gray-400 text-sm">220,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Thịt Bò Nạm Tuyệt Uc', 220000, 'img/bo_nam.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="special">
                        <img src="img/luoi_bo.jpg" alt="Lưỡi Bò" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Lưỡi Bò</h3>
                            <p class="text-gray-400 text-sm">140,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Lưỡi Bò', 140000, 'img/luoi_bo.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <!-- Món rau -->
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="vegetable">
                        <img src="img/rau_muong_xao.jpg" alt="Rau Muống Xào Tỏi" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Rau Muống Xào Tỏi</h3>
                            <p class="text-gray-400 text-sm">50,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Rau Muống Xào Tỏi', 50000, 'img/rau_muong_xao.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="vegetable">
                        <img src="img/salad_tron.jpg" alt="Salad Trộn" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Salad Trộn</h3>
                            <p class="text-gray-400 text-sm">60,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Salad Trộn', 60000, 'img/salad_tron.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="vegetable">
                        <img src="img/cai_ngot_luoc.jpg" alt="Cải Ngọt Luộc" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Cải Ngọt Luộc</h3>
                            <p class="text-gray-400 text-sm">45,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Cải Ngọt Luộc', 45000, 'img/cai_ngot_luoc.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <!-- Đồ uống -->
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="drink">
                        <img src="img/tra_da.jpg" alt="Trà Đá" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Trà Đá</h3>
                            <p class="text-gray-400 text-sm">10,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Trà Đá', 10000, 'img/tra_da.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="drink">
                        <img src="img/nuoc_cam.jpg" alt="Nước Cam" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Nước Cam</h3>
                            <p class="text-gray-400 text-sm">30,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Nước Cam', 30000, 'img/nuoc_cam.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                    <div class="product-item flex items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition duration-300" data-category="drink">
                        <img src="img/sinh_to_xoai.jpg" alt="Sinh Tố Xoài" class="w-14 h-14 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-100">Sinh Tố Xoài</h3>
                            <p class="text-gray-400 text-sm">35,000 VNĐ</p>
                        </div>
                        <button onclick="addToCart('Sinh Tố Xoài', 35000, 'img/sinh_to_xoai.jpg')" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Thêm</button>
                    </div>
                </div>
            </div>

            <!-- Cột 3: Giỏ hàng -->
            <div class="w-1/3 p-6 bg-gray-900 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-red-500">Giỏ Hàng</h2>
                <div class="max-h-[270px] overflow-y-auto space-y-3" id="cart-items">
                    <!-- Cart items will be added dynamically -->
                </div>
                <p id="cart-total" class="font-bold text-lg my-6 text-gray-100">Tổng: 0 VNĐ</p>
                <button onclick="clearCart()" class="block w-full bg-gray-700 text-gray-100 py-3 rounded-lg hover:bg-red-600 hover:text-white transition duration-300 mb-3">Xóa Giỏ Hàng</button>
                <button onclick="checkout()" class="block w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-700 transition duration-300">Thanh Toán</button>
            </div>
        </div>
    </section>

    <script>
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
                cartItem.className = 'flex items-center p-4 bg-gray-800 rounded-lg';
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="w-14 h-14 object-cover rounded-md mr-4">
                    <span class="flex-1 text-gray-100 text-sm">${item.name} - ${item.price.toLocaleString()} VNĐ</span>
                    <button onclick="removeFromCart(${index})" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300 text-sm">Xóa</button>
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
            }
        }

        // Category filter
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.getAttribute('data-category');
                document.querySelectorAll('.product-item').forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
<body>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <h4>CÁC THƯƠNG HIỆU CỦA CÔNG TY CỔ PHẦN VIỆT NAM</h4>
                    <p>Hotline: 1900 9196</p>
                    <p>Email: luabehoy@info.vn</p>
                </div>
                <div>
                    <h4>THÔNG TIN CÔNG TY</h4>
                    <p><a href="#">Về chúng tôi</a></p>
                    <p><a href="#">Tin tức</a></p>
                    <p><a href="#">Tuyển dụng</a></p>
                </div>
                <div>
                    <h4>CHÍNH SÁCH HỖ TRỢ</h4>
                    <p><a href="#">Chính sách bảo mật</a></p>
                    <p><a href="#">Điều khoản sử dụng</a></p>
                    <p><a href="#">Chính sách giao hàng</a></p>
                </div>
                <div>
                    <h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
                    <p><a href="#">Facebook</a></p>
                    <p><a href="#">Instagram</a></p>
                    <p><a href="#">YouTube</a></p>
                </div>
            </div>
            <p style="text-align: center; margin-top: 20px;"> Dịch Vụ Ăn Uống Việt Nam<br>Địa chỉ: 123 Đường Ẩm Thực, Quận 19, TP. HCM</p>
        </div>
    </footer>

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
    </script>
</body>
</html>