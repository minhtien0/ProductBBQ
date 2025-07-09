<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUA BE HOY</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
        button {
            min-height: 44px;
        }

        img {
            transition: transform 0.2s;
        }

        img:hover {
            transform: scale(1.05);
        }

        .cart-popup:not(.hidden) {
            display: flex;
        }

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
        <section class="relative sm:static z-30 mb-4">
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 ">
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
                    </div>
                </div>
                <!-- Product -->
                <div class="w-full sm:w-2/3 p-2 sm:p-4 bg-gray-dark rounded-lg max-h-[600px] overflow-y-auto pr-2">
                    <h2 class="text-lg sm:text-2xl mb-1 sm:mb-2 text-red-primary">Sản Phẩm</h2>
                    <div class="flex flex-wrap sm:flex-wrap gap-1 sm:gap-2">
                        <!-- Dữ liệu sẽ được AJAX điền vào -->
                    </div>
                    <button
                        class="cart-toggle fixed bottom-2 left-1/2 -translate-x-1/2 z-50 bg-red-primary text-white p-3 rounded-full w-[90vw] max-w-xs text-base sm:hidden shadow-lg hover:bg-red-hover transition-colors">
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
                        class="close-btn absolute top-2 right-4 text-white rounded-full text-xs flex items-center justify-center hover:bg-red-hover transition-colors">X</button>
                    <h2 class="text-base sm:text-xl mb-2 text-red-primary">Giỏ Hàng</h2>
                    <div class="cart-items max-h-[300px] overflow-y-auto mb-2" id="cart-items">
                        <!-- Sẽ được JS render từ orderDetails -->
                    </div>
                    <p class="text-xs sm:text-sm mb-2 text-white" id="cart-total">Tổng: 0 VNĐ</p>
                    <button onclick="callDishes()"
                        class="bg-red-primary text-white p-2 rounded w-full text-xs sm:text-sm mb-1 hover:bg-red-hover transition-colors">Gọi
                        Món</button>
                </div>
            </div>
        </section>
        <script>
            // CSRF cho AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            // Dữ liệu giỏ hàng lấy từ PHP (orderDetails của user hiện tại)
            let orderDetails = @json($orderDetails);

            // Render lại popup cart mỗi lần thay đổi
            function renderPopupCart() {
                let html = '';
                let total = 0;
                orderDetails.forEach((item, index) => {
                    total += item.food_price * item.quantity;
                    html += `
            <div class="flex items-center justify-between gap-2 py-2 border-b border-gray-700"
                id="cart-item-${item.id}" data-index="${index}">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/') }}/${item.food_image}"
                        class="w-10 h-10 object-cover rounded shadow aspect-square">
                    <div>
                        <span class="block text-xs text-white font-semibold">${item.food_name}</span>
                        <span class="block text-xs text-gray-400">${parseInt(item.food_price).toLocaleString()} VNĐ</span>
                        <span class="block text-xs text-green-400">${item.status}</span>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <button class="cart-btn-qty w-5 h-5 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-xs"
                        data-index="${index}" data-delta="-1">-</button>
                    <span class="mx-1 font-semibold text-white text-sm"
                        id="qty-${item.id}">${item.quantity}</span>
                    <button class="cart-btn-qty w-5 h-5 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-xs"
                        data-index="${index}" data-delta="1">+</button>
                    <button class="cart-btn-remove ml-2 px-2 py-1 rounded bg-red-600 text-white hover:bg-red-700 text-xs"
                        data-index="${index}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        `;
                });
                $('#cart-items').html(html);
                $('#cart-total').text('Tổng: ' + total.toLocaleString() + ' VNĐ');
            }
            // Đặt ngoài document.ready (chỉ đăng ký sự kiện 1 lần)
            $(document).on('click', '.cart-btn-qty', function () {
                let index = $(this).data('index');
                let delta = $(this).data('delta');
                console.log('Click', index, delta, Date.now());
                popupUpdateQty(index, delta);
            });
            $(document).on('click', '.cart-btn-remove', function () {
                let index = $(this).data('index');
                popupRemoveFromCart(index);
            });


            // Tăng/giảm số lượng món
            function popupUpdateQty(index, delta) {
                const detail = orderDetails[index];
                const newQty = detail.quantity + delta;
                if (newQty < 1) return;
                $.ajax({
                    url: `/order-details/${detail.id}`,
                    type: 'PATCH',
                    data: { quantity: newQty },
                    success: function (res) {
                        orderDetails[index].quantity = parseInt(res.quantity); // Cập nhật lại mảng sau khi backend thành công
                        renderPopupCart();
                    },
                    error: function () {
                        alert('Cập nhật thất bại.');
                    }
                });
            }
            function callDishes() {
    if (!confirm('Bạn chắc chắn muốn GỌI MÓN?')) return;

    let tableId = CURRENT_TABLE_ID;
    if (!tableId) {
        alert('Không xác định được bàn!');
        return;
    }

    $.ajax({
        url: `/api/order-details/call-dishes`, // route mới sẽ tạo ở backend
        type: 'POST',
        data: { table_id: tableId },
        success: function (res) {
            if (res.success) {
                alert('Đã gọi món thành công!');
                // Cập nhật lại orderDetails nếu muốn
                $.get('/api/order-details/' + tableId, function (data) {
                    if (data.success) {
                        orderDetails = data.orderDetails;
                        renderPopupCart();
                    }
                });
            } else {
                alert(res.message || 'Gọi món thất bại');
            }
        },
        error: function () {
            alert('Gọi món thất bại!');
        }
    });
}


            // Xóa món khỏi cart
            function popupRemoveFromCart(index) {
                const detail = orderDetails[index];
                $.ajax({
                    url: `/order-details/${detail.id}`,
                    type: 'DELETE',
                    success: function () {
                        orderDetails.splice(index, 1);
                        renderPopupCart();
                    },
                    error: function () {
                        alert('Xóa thất bại.');
                    }
                });
            }

            // Hiển thị/ẩn popup cart
            function toggleCart() {
                const cartPopup = document.getElementById('cart-popup');
                if (cartPopup) {
                    cartPopup.classList.toggle('hidden');
                    if (!cartPopup.classList.contains('hidden')) {
                        renderPopupCart();
                    }
                }
            }
            $(document).ready(function () {
                $('.cart-toggle, .close-btn').on('click', function (e) {
                    e.preventDefault();
                    toggleCart();
                });
            });

            // Clear cart (cẩn thận: tuỳ project mà cần làm trên server luôn)
            function cartClearCart() {
                if (!confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')) return;
                // Gọi API xoá tất cả cart nếu có route, hoặc loop từng item xóa
                // Tạm thời: Xoá từng item hiện tại cho đúng dữ liệu
                let ids = orderDetails.map(item => item.id);
                let count = 0;
                function removeNext() {
                    if (count >= ids.length) {
                        orderDetails = [];
                        renderPopupCart();
                        return;
                    }
                    $.ajax({
                        url: `/order-details/${ids[count]}`,
                        type: 'DELETE',
                        success: function () {
                            count++; removeNext();
                        },
                        error: function () { count++; removeNext(); }
                    });
                }
                removeNext();
            }

            // Demo thanh toán
            function cartCheckout() {
                if (orderDetails.length === 0) {
                    alert('Giỏ hàng trống!');
                } else {
                    let total = orderDetails.reduce((sum, item) => sum + item.food_price * item.quantity, 0);
                    alert('Thanh toán thành công! Tổng: ' + total.toLocaleString() + ' VNĐ');
                    cartClearCart();
                    toggleCart();
                }
            }

            // AJAX sản phẩm theo danh mục
            $(document).ready(function () {
                var initialComboData = <?php echo json_encode($comboData); ?> || [];
                $('.category-btn').on('click', function () {
                    var categoryId = $(this).data('category');
                    $.ajax({
                        url: '/get-products-by-category/' + categoryId,
                        type: 'GET',
                        success: function (data) {
                            var html = '';
                            data.foods.forEach(function (food) {
                                html += `
                                <div class="product-item w-[48%] sm:w-[48%] md:w-[32%] mb-2 p-2 bg-gray-darker rounded shadow text-center" data-category="${categoryId}">
                                    <img src="{{ asset('img/${food.image }') }}" alt="${food.name}" class="w-16 h-16 object-cover rounded shadow mx-auto aspect-square">
                                    <h3 class="text-xs sm:text-sm my-1 mx-2 text-white">${food.name}</h3>
                                    <p class="text-[10px] sm:text-xs text-gray-light">${food.price} VNĐ</p>
                                    <div class="flex items-center justify-center gap-2 mt-2 mb-2">
                                        <button class="btn-change-qty w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" data-delta="-1" type="button">-</button>
                                        <input type="number" value="1" min="1" class="w-10 h-8 text-center rounded-full border border-gray-200 bg-white text-gray-800 qty-input font-semibold" readonly>
                                        <button class="btn-change-qty w-7 h-7 flex items-center justify-center rounded-full bg-gray-700 text-white hover:bg-gray-600 text-base" data-delta="1" type="button">+</button>
                                    </div>
                                    <button class="btn-add-to-cart bg-red-primary text-white px-3 py-1 rounded w-full text-xs sm:text-sm hover:bg-red-hover transition-colors"
                                     data-product-id="${food.id}"    
                                    data-name="${food.name}"
                                        data-price="${food.price}"
                                        data-image="${food.image || 'img/default-food.jpg'}"
                                    >Thêm</button>
                                </div>
                            `;
                            });
                            $('.flex.flex-wrap.sm\\:flex-wrap.gap-1.sm\\:gap-2').html(html);
                        },
                        error: function (xhr) {
                            console.log('Lỗi: ', xhr);
                        }
                    });
                });
                if (initialComboData.length > 0) {
                    $('.category-btn').first().trigger('click');
                }
            });
            var CURRENT_TABLE_ID = {{ $table->id ?? 'null' }};
            // Sự kiện tăng/giảm số lượng sản phẩm ngoài (AJAX render)
            $(document).on('click', '.btn-change-qty', function () {
                let $input = $(this).siblings('.qty-input');
                let delta = parseInt($(this).data('delta'));
                let value = parseInt($input.val()) || 1;
                value += delta;
                if (value < 1) value = 1;
                $input.val(value);
            });

            $(document).on('click', '.btn-add-to-cart', function () {
                let $container = $(this).closest('.product-item');
                let qty = parseInt($container.find('.qty-input').val()) || 1;
                let productId = $(this).data('product-id');
                let tableId = CURRENT_TABLE_ID; // Lấy đúng table_id ở đâu đó
                console.log('Thêm sản phẩm:', productId, 'số lượng:', qty, 'table:', tableId);

                if (!tableId) {
                    alert('Chưa có table_id!'); // Thực tế nên set đúng giá trị cho tableId!
                    return;
                }

                $.ajax({
                    url: '/add-order-item-qrorder', // đúng route backend bạn đã setup
                    type: 'POST',
                    data: {
                        table_id: tableId,
                        product_id: productId,
                        quantity: qty
                    },
                    success: function (res) {
                        if (res.success) {
                            // Gọi lại API lấy giỏ hàng mới
                            $.get('/api/order-details/' + tableId, function (data) {
                                if (data.success) {
                                    orderDetails = data.orderDetails;
                                    renderPopupCart();
                                    //toggleCart();
                                    alert('Đã thêm món: ' + res.order_detail.food_name);
                                }
                            });
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function (xhr) {
                        alert('Lỗi khi thêm món!');
                    }
                });
            });


            // Swiper giữ nguyên
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
    </div>
</body>

</html>