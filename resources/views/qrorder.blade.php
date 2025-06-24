<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUA BE HOY</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    fontFamily: {
                        mont: ['Montserrat', 'sans-serif'],
                    }
                },
            },
        };
    </script>
    <style>
        /* Touch-friendly buttons */
        button {
            min-height: 44px;
        }

        /* Image hover effect */
        img {
            transition: transform 0.2s;
        }

        img:hover {
            transform: scale(1.05);
        }

        /* Cart popup show flex */
        .cart-popup:not(.hidden) {
            display: flex;
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

        @media (max-width: 480px) {
            .cart-popup-content {
                width: 98vw !important;
            }

            .swiper {
                height: 220px !important;
            }
        }
    </style>
    <!-- FontAwesome cho icon danh mục -->
    <script src="https://kit.fontawesome.com/75fc7caa04.js" crossorigin="anonymous"></script>
</head>


<body class="bg-dark-bg text-white font-mont">
    <div class="w-full max-w-5xl mx-auto px-2 sm:px-4 py-2 sm:py-4">
        <!-- Promotion Section -->
        <section class="mb-4">
            <div class="carousel-container w-full p-2 sm:p-4 bg-gray-dark rounded-lg">
                <div class="swiper h-48 sm:h-64 md:h-72">
                    <div class="swiper-wrapper">
                        <div
                            class="swiper-slide flex flex-col justify-center p-2 sm:p-4 bg-[url('{{ asset('img/banner1.jpg') }}')] bg-cover bg-center rounded-lg">
                            <h1 class="text-2xl sm:text-4xl font-bold text-red-primary mb-1 sm:mb-2 leading-tight">
                                ƯU ĐÃI CÓ HẠN<br><span class="text-white">Buffet RỒNG LÂU -15%</span>
                            </h1>
                            <p class="text-xs sm:text-sm mb-1 sm:mb-2">Đặc biệt áp dụng từ 1/6 cho đến hết ngày 30/6</p>
                            <div class="flex gap-1 sm:gap-2 mb-2 sm:mb-4">
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-[10px] sm:text-xs text-white">Ưu đãi nổi bật</p>
                                    <h3 class="text-base sm:text-lg font-bold text-white">489.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-[10px] sm:text-xs text-white">Buffet chỉ từ</p>
                                    <h3 class="text-base sm:text-lg font-bold text-white">299.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-[10px] sm:text-xs text-white">Ưu đãi lớn</p>
                                    <h3 class="text-base sm:text-lg font-bold text-white">TẶNG BỘT</h3>
                                </div>
                            </div>
                            <p class="text-[10px] sm:text-xs mb-1 sm:mb-2">*áp dụng tại tất cả cửa hàng</p>
                            <button
                                class="bg-red-primary text-white p-2 rounded text-xs sm:text-sm hover:bg-red-hover transition-colors w-24 sm:w-32">XEM
                                NGAY</button>
                        </div>
                        <div
                            class="swiper-slide flex flex-col justify-center p-2 sm:p-4 bg-[url('{{ asset('img/banner1.jpg') }}')] bg-cover bg-center rounded-lg">
                            <h1 class="text-2xl sm:text-4xl font-bold text-red-primary mb-1 sm:mb-2 leading-tight">
                                ƯU ĐÃI ĐẶC BIỆT<br><span class="text-white">Buffet HÈ NÀY -10%</span>
                            </h1>
                            <p class="text-xs sm:text-sm mb-1 sm:mb-2">Áp dụng từ 15/5 đến 15/7</p>
                            <div class="flex gap-1 sm:gap-2 mb-2 sm:mb-4">
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-[10px] sm:text-xs text-white">Giá mới</p>
                                    <h3 class="text-base sm:text-lg font-bold text-white">349.000</h3>
                                </div>
                                <div class="bg-red-primary p-2 rounded text-center">
                                    <p class="text-[10px] sm:text-xs text-white">Ưu đãi thêm</p>
                                    <h3 class="text-base sm:text-lg font-bold text-white">TẶNG NƯỚC</h3>
                                </div>
                            </div>
                            <p class="text-[10px] sm:text-xs mb-1 sm:mb-2">*Chỉ áp dụng tại một số chi nhánh</p>
                            <button
                                class="bg-red-primary text-white p-2 rounded text-xs sm:text-sm hover:bg-red-hover transition-colors w-24 sm:w-32">XEM
                                NGAY</button>
                        </div>
                    </div>
                    <div class="swiper-pagination text-right pr-1 sm:pr-4"></div>
                </div>
            </div>
        </section>

        <!-- Delivery Section -->
        <section class="flex flex-col sm:flex-row gap-2 sm:gap-4 mb-4">
            <div class="w-full sm:w-1/3 bg-white text-black p-2 sm:p-4 rounded-lg text-center">
                <img src="{{ asset('img/combo/3.jpg') }}" alt="Delivery"
                    class="w-full h-auto max-h-32 sm:max-h-48 rounded-lg mb-2 object-cover">
                <h2 class="text-lg sm:text-2xl font-bold">COMBO NGON SHIP TẬN TAY</h2>
            </div>
            <div class="w-full sm:w-2/3 bg-gray-dark p-2 sm:p-4 rounded-lg">
                <h3 class="text-lg sm:text-2xl text-red-primary mb-1 sm:mb-2">Gói Gyu Ngay - Ship Tận Tay</h3>
                <ul class="list-none mb-2">
                    <li class="text-xs sm:text-sm text-gray-light mb-1">Thời gian giao hàng dự kiến: 30 - 45 phút</li>
                    <li class="text-xs sm:text-sm text-gray-light mb-1">Phí giao hàng: Miễn phí cho đơn hàng từ 300.000
                        VNĐ</li>
                    <li class="text-xs sm:text-sm text-gray-light mb-1">Đơn hàng dưới 300.000 VNĐ phí ship 20.000 VNĐ
                    </li>
                    <li class="text-xs sm:text-sm text-gray-light mb-1">Giao hàng trong giờ hành chính từ 10:00 - 20:00
                    </li>
                    <li class="text-xs sm:text-sm text-gray-light mb-1">Hỗ trợ giao hàng qua các ứng dụng: Grab, Be,
                        Baemin</li>
                </ul>
                <button
                    class="bg-red-primary text-white p-2 rounded text-xs sm:text-sm hover:bg-red-hover transition-colors w-full sm:w-32">ĐẶT
                    NGAY</button>
            </div>
        </section>

        <!-- Menu Section -->
        <section class=" relative sm:static z-30 mb-4">
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 ">
                <!-- Category -->
                <!-- Category -->
                <div class="sticky top-0 left-0 w-full sm:w-1/3 p-2 sm:p-4 bg-gray-dark rounded-lg mb-2 sm:mb-0">
                    <h2 class="text-lg sm:text-2xl mb-1 sm:mb-2 text-red-primary">Danh Mục</h2>
                    <div
                        class="flex sm:block gap-2 overflow-x-auto sm:overflow-x-visible hide-scrollbar -mx-2 sm:mx-0 pb-2 sm:pb-0">
                        @foreach ($menus as $menu)
                            <button
                                class="category-btn min-w-[130px] block p-2 mb-1 bg-gray-darker rounded text-center text-xs sm:text-sm text-white hover:bg-red-primary transition-colors"
                                data-category="{{ $menu->id }}">
                                <i class="fa-solid fa-utensils"></i> <br>{{ $menu->name }}
                            </button>
                        @endforeach
                        <button
                            class="combo-view-btn min-w-[160px] block p-2 mb-1 bg-amber-500 rounded text-center text-xs sm:text-sm text-white hover:bg-amber-600 transition-colors"
                            style="margin-left:8px" data-combo="1">
                            <i class="fa-solid fa-layer-group"></i><br>Xem các Combo đã gọi
                        </button>
                    </div>
                </div>

                <!-- Product -->
                <div class="w-full sm:w-2/3 p-2 sm:p-4 bg-gray-dark rounded-lg max-h-[600px] overflow-y-auto pr-2">
                    <h2 class="text-lg sm:text-2xl mb-1 sm:mb-2 text-red-primary">Sản Phẩm</h2>
                    <div class="flex flex-wrap sm:flex-wrap gap-1 sm:gap-2">
                        <!-- Dữ liệu sẽ được AJAX điền vào -->
                    </div>
                    <button
                        class="cart-toggle fixed bottom-2 left-1/2 -translate-x-1/2 z-50 bg-red-primary text-white p-3 rounded-full w-[90vw] max-w-xs text-base sm:hidden shadow-lg hover:bg-red-hover transition-colors"
                        onclick="toggleCart()">
                        Xem Giỏ Hàng
                    </button>
                </div>
            </div>
            <!-- Cart Popup -->
            <div class="cart-popup hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                id="cart-popup">
                <div
                    class="cart-popup-content bg-gray-dark max-w-[95%] w-[95vw] sm:w-[350px] max-h-[80vh] overflow-y-auto p-3 rounded-lg relative">
                    <button
                        class="close-btn absolute top-2 right-4 text-white rounded-full text-xs flex items-center justify-center hover:bg-red-hover transition-colors"
                        onclick="toggleCart()">X</button>
                    <h2 class="text-base sm:text-xl mb-2 text-red-primary">Giỏ Hàng</h2>
                    <div class="cart-items max-h-[300px] overflow-y-auto mb-2" id="cart-items"></div>
                    <p class="text-xs sm:text-sm mb-2 text-white" id="cart-total">Tổng: 0 VNĐ</p>
                    <button onclick="clearCart()"
                        class="bg-red-primary text-white p-2 rounded w-full text-xs sm:text-sm mb-1 hover:bg-red-hover transition-colors">Gọi
                        Món
                    </button>
                    <button onclick="checkout()"
                        class="bg-red-primary text-white p-2 rounded w-full text-xs sm:text-sm hover:bg-red-hover transition-colors">Thanh
                        Toán</button>
                </div>
            </div>
        </section>

    </div>
    <script>
    window.comboData = @json($comboData ?? []);
</script>

    <script>
        $(document).ready(function () {
            // Dữ liệu combo ban đầu từ PHP
            var initialComboData = <?php echo json_encode($comboData); ?> || [];

            $('.category-btn').on('click', function () {
                var categoryId = $(this).data('category');

                $.ajax({
                    url: '/get-products-by-category/' + categoryId,
                    type: 'GET',
                    success: function (data) {
                        var html = '';

                        // Hiển thị các món ăn (Food) từ AJAX
                        data.foods.forEach(function (food) {
                            html += `
                        <div class="product-item w-[48%] sm:w-[48%] md:w-[32%] mb-2 p-2 bg-gray-darker rounded shadow text-center" data-category="${categoryId}">
                            <img src="{{ asset('img/${food.image }') }}" alt="${food.name}" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
                            <h3 class="text-xs sm:text-sm my-1 mx-2 text-white">${food.name}</h3>
                            <p class="text-[10px] sm:text-xs text-gray-light">${food.price} VNĐ</p>
                            <div class="flex items-center justify-center gap-2 mt-2 mb-2">
                                <button onclick="changeQty(this, -1)" class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" type="button">-</button>
                                <input type="number" value="1" min="1" class="w-10 h-8 text-center rounded-full border border-gray-200 bg-white text-gray-800 qty-input font-semibold" readonly>
                                <button onclick="changeQty(this, 1)" class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" type="button">+</button>
                            </div>
                            <button onclick="addToCartWithQty(this, '${food.name}', ${food.price}, '${food.image || 'img/default-food.jpg'}')" class="bg-red-primary text-white px-3 py-1 rounded w-full text-xs sm:text-sm hover:bg-red-hover transition-colors">Thêm</button>
                        </div>
                    `;
                        });

                       
                        // Cập nhật phần sản phẩm
                        $('.flex.flex-wrap.sm\\:flex-wrap.gap-1.sm\\:gap-2').html(html);
                    },
                    error: function (xhr) {
                        console.log('Lỗi: ', xhr);
                    }
                });
            });

            // Hiển thị dữ liệu ban đầu khi tải trang
            $(document).ready(function () {
                if (initialComboData.length > 0) {
                    var initialCategory = $('.category-btn').first().data('category');
                    $('.category-btn').first().trigger('click');
                }
            });

            $('.combo-view-btn').on('click', function () {
    let html = '';
    (window.comboData || []).forEach(function(combo) {
        // Duyệt từng món của combo
        combo.foods.forEach(function(food) {
            html += `
                <div class="product-item w-[48%] sm:w-[48%] md:w-[32%] mb-2 p-2 bg-gray-darker rounded shadow text-center" data-category="combo-${combo.id}">
                    <img src="{{ asset('img/${food.image}') }}" alt="${food.name}" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
                    <h3 class="text-xs sm:text-sm my-1 mx-2 text-white">${food.name} <span class="text-amber-400">(Combo: ${combo.name})</span></h3>
                    <p class="text-[10px] sm:text-xs text-gray-light">${food.price} VNĐ</p>
                    <div class="flex items-center justify-center gap-2 mt-2 mb-2">
                        <button onclick="changeQty(this, -1)" class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" type="button">-</button>
                        <input type="number" value="1" min="1" class="w-10 h-8 text-center rounded-full border border-gray-200 bg-white text-gray-800 qty-input font-semibold" readonly>
                        <button onclick="changeQty(this, 1)" class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" type="button">+</button>
                    </div>
                    <button onclick="addToCartWithQty(this, '${food.name}', ${food.price}, '${food.image || 'img/default-food.jpg'}')" class="bg-red-primary text-white px-3 py-1 rounded w-full text-xs sm:text-sm hover:bg-red-hover transition-colors">Thêm</button>
                </div>
            `;
        });
    });
    $('.flex.flex-wrap.sm\\:flex-wrap.gap-1.sm\\:gap-2').html(html);
});

        });
    </script>

    <!-- Swiper JS -->
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

        // Thêm sản phẩm với số lượng (mặc định 1 nếu không truyền vào)
        function addToCart(name, price, image, qty = 1) {
            // Nếu đã có thì chỉ tăng số lượng
            const found = cart.find(item => item.name === name);
            if (found) {
                found.qty += qty;
            } else {
                cart.push({ name, price, image, qty });
            }
            updateCart();
        }

        // Chỉnh số lượng (tăng/giảm)
        function updateQty(index, delta) {
            cart[index].qty += delta;
            if (cart[index].qty < 1) cart[index].qty = 1;
            updateCart();
        }

        // Xóa 1 dòng món khỏi giỏ hàng
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        // Xóa tất cả
        function clearCart() {
            cart = [];
            updateCart();
        }

        // Cập nhật giao diện giỏ hàng
        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                total += item.price * item.qty;
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item flex items-center justify-between m-1.5 md:m-1 bg-gray-darker p-1.5 rounded';
                cartItem.innerHTML = `
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/${item.image}') }}" alt="${item.name}" class="w-10 h-10 object-cover rounded shadow mr-2 aspect-square">
                    <div>
                        <span class="block text-xs text-white font-semibold">${item.name}</span>
                        <span class="block text-xs text-gray-400">${item.price.toLocaleString()} VNĐ</span>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                <button onclick="updateQty(${index}, -1)" class="w-3 h-3 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600">-</button>
                <span class="mx-1 font-semibold text-white ">${item.qty}</span>
                <button onclick="updateQty(${index}, 1)" class="w-3 h-3 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600">+</button>

                    <button onclick="removeFromCart(${index})" class="ml-2 px-2 py-1 rounded bg-red-primary text-white hover:bg-red-hover text-xs"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            `;
                cartItems.appendChild(cartItem);
            });

            document.getElementById('cart-total').textContent = `Tổng: ${total.toLocaleString()} VNĐ`;
        }

        function checkout() {
            if (cart.length === 0) {
                alert('Giỏ hàng trống!');
            } else {
                const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
                alert('Thanh toán thành công! Tổng: ' + total.toLocaleString() + ' VNĐ');
                clearCart();
                toggleCart();
            }
        }

        function toggleCart() {
            const cartPopup = document.getElementById('cart-popup');
            if (cartPopup) {
                cartPopup.classList.toggle('hidden');
            }
        }

        //thêm số lượng món ăn cần thêm
        function changeQty(btn, delta) {
            const input = btn.parentElement.querySelector('.qty-input');
            let value = parseInt(input.value) || 1;
            value = value + delta;
            if (value < 1) value = 1;
            input.value = value;
        }

        function addToCartWithQty(btn, name, price, image) {
            const qty = parseInt(btn.parentElement.querySelector('.qty-input').value) || 1;
            for (let i = 0; i < qty; i++) {
                addToCart(name, price, image); // Hàm addToCart bạn đã có sẵn
            }
            btn.parentElement.querySelector('.qty-input').value = 1;
        }

        // Filter sản phẩm theo danh mục
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.getAttribute('data-category');
                document.querySelectorAll('.product-item').forEach(item => {
                    if (item.getAttribute('data-category') === category) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>