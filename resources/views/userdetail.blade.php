<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trang Cá Nhân</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
    <script>
        // Lấy CSRF token từ meta
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        // Bắt sự kiện click trên tất cả nút .add-to-cart
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', async e => {
                const foodId = btn.dataset.foodId;
                try {
                    const res = await fetch("{{ route('cart.add') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({
                            food_id: foodId,
                            quantity: 1
                        })
                    });

                    const data = await res.json();
                    if (res.ok && data.success) {
                        // gọi trực tiếp hàm showPopup với message
                        showPopup(data.message);
                    } else {
                        // API trả lỗi, hoặc success=false
                        showPopup(data.message || data.error || 'Có lỗi xảy ra');
                    }

                } catch (err) {
                    showPopup(err.message || 'Lỗi kết nối');
                }
            });
        });
    </script>
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
</head>

<body class="font-mont" @if(session('success')) data-success="{{ session('success') }}" @elseif(session('error'))
data-error="{{ session('error') }}" @endif>
    @include('layouts.user.header')
    <div class="relative w-full">
        <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
        <img src="img/banner1.jpg" alt="User Detail" class="w-full h-[260px] md:h-[360px] object-cover">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">User Detail</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">BBQ User Detail</span>
            </div>
        </div>
    </div>

    <!-- MAIN DASHBOARD -->
    <div class="max-w-6xl mx-auto px-2 md:px-4 py-8">
        <div class="bg-white rounded-xl shadow border overflow-hidden flex flex-col md:flex-row">
            <!-- SIDEBAR -->
            <div class="bg-[#e60012] w-full md:w-60 flex-shrink-0 flex flex-col items-center py-6">
                <div class="relative">
                   <img id="avatar-img" src="{{ asset('img/' . (session('user_avatar') ?? 'mtien.jpg')) }}" class="w-24 h-24 rounded-full border-4 border-white object-cover" />
                    <label class="absolute bottom-1 right-0 bg-white rounded-full p-1 shadow cursor-pointer">
                        <i class="fa fa-camera text-[#e60012]"></i>
                        <input type="file" id="avatar-input" class="hidden" accept="image/*" />
                    </label>
                </div>
                <div class="mt-3 mb-6 text-lg font-bold text-white">{{ session('user_name') }}</div>
                <nav class="w-full">
                    <button
                        class="tab-btn ml-1 w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none active-tab"
                        data-tab="profile">
                        <i class="fa fa-user mr-2"></i> Thông Tin Cá Nhân
                    </button>
                    <button
                        class="tab-btn ml-1 w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none"
                        data-tab="address">
                        <i class="fa fa-map-marker-alt mr-2"></i> Địa Chỉ
                    </button>
                    <button
                        class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none"
                        data-tab="order">
                        <i class="fa fa-shopping-cart mr-2"></i> Đơn Hàng
                    </button>
                    <button
                        class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none"
                        data-tab="wishlist">
                        <i class="fa fa-heart mr-2"></i> Yêu Thích
                    </button>
                    <button
                        class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none"
                        data-tab="review">
                        <i class="fa fa-star mr-2"></i> Đánh Giá
                    </button>
                    <button
                        class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none"
                        data-tab="password">
                        <i class="fa fa-key mr-2"></i> Đổi Mật Khẩu
                    </button>
                    <a href="{{ route('logout') }}"><button
                            class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none border-t border-orange-400"
                            data-tab="logout">
                            <i class="fa fa-sign-out-alt mr-2"></i> Đăng Xuất
                        </button>
                    </a>
                </nav>
            </div>

            <!-- Thay đổi hình nền -->
            <script>
                document.getElementById('avatar-input').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('avatar', file);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    fetch('{{ route("user.update-avatar") }}', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật avatar mới ngay
                            document.getElementById('avatar-img').src = data.avatar_url + '?t=' + new Date().getTime();
                            showPopup(data.message);
                        } else {
                            showPopup(data.message || 'Đổi ảnh thất bại!');
                        }
                    })
                    .catch(() => showPopup('Lỗi kết nối server!'));
                });
            </script>   
            <!-- CONTENT -->
            <div class="flex-1 p-6 bg-blue-50 min-h-[520px]">
                <!-- Personal Info -->
                <div class="tab-content" id="tab-profile">
                    <!-- Xem thông tin -->
                    <div id="profile-view">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Thông Tin Cá Nhân</h2>
                            <button id="btn-edit-profile"
                                class="px-4 py-1.5 bg-[#e60012] hover:bg-orange-600 text-white rounded-full text-sm font-semibold">
                                Chỉnh Sửa
                            </button>
                        </div>
                        <div class="bg-white rounded shadow p-5">
                            <div class="flex flex-col gap-3">
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">Họ Và Tên:</span>
                                    <span class="text-gray-800">{{ session('user_name') }}</span>
                                </div>
                                <hr>
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">Ngày sinh:</span>
                                      {{ \Carbon\Carbon::parse(session('user_birthday'))->format('d/m/Y') ??"-"}}
                                </div>
                                <hr>
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">Giới Tính:</span>
                                    <span class="text-gray-800">{{ session('user_gender')??"-" }}</span>
                                </div>
                                <hr>
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">Email:</span>
                                    <span class="text-gray-800">{{ session('user_email') }}</span>
                                </div>
                                <hr>
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">SĐT:</span>
                                    <span class="text-gray-800">{{ session('user_sdt') }}</span>
                                </div>
                                <hr>
                                <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                                    <span class="w-28 font-semibold text-gray-700">Địa Chỉ:</span>
                                    <span class="text-gray-800">
                                        @if($address)
                                            {{ $address->house_number }}, {{ $address->ward }},
                                            {{ $address->district }}, {{ $address->city }}
                                        @else
                                            Chưa có địa chỉ mặc định
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form chỉnh sửa -->
                    <div id="profile-edit" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Chỉnh Sửa Thông Tin</h2>
                            <button id="btn-cancel-edit"
                                class="px-4 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-semibold">
                                Hủy
                            </button>
                        </div>
                        <form action="{{ route('user.update-profile') }}" method="POST"
                            class="bg-white rounded shadow p-5">
                            @csrf

                            <div class="flex flex-col gap-5">
                                {{-- Email --}}
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email"
                                        class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror"
                                        value="{{ old('email', session('user_email')) }}" required>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Fullname --}}
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Họ Và Tên</label>
                                    <input type="text" name="fullname"
                                        class="w-full border rounded px-3 py-2 @error('fullname') border-red-500 @enderror"
                                        value="{{ old('fullname', session('user_name')) }}" required>
                                    @error('fullname')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Ngày Sinh</label>
                                    <input type="date" name="birthday"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm w-full @error('birthday') border-red-500 @enderror"
                                    value="{{ old('birthday', (session('user_birthday') ? \Carbon\Carbon::parse(session('user_birthday'))->format('Y-m-d') : '') ) }}"
                                    required>
                                    @error('birthday')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Giới Tính</label>
                                    <div class="flex items-center gap-3">
                                        <label><input type="radio" name="gender" value="Nam" {{ old('gender', session('user_gender') ?? '') == 'Nam' ? 'checked' : '' }}> Nam</label>
                                        <label><input type="radio" name="gender" value="Nữ" {{ old('gender', session('user_gender') ?? '') == 'Nữ' ? 'checked' : '' }}> Nữ</label>
                                        <label><input type="radio" name="gender" value="Khác" {{ old('gender', session('user_gender') ?? '') == 'Khác' ? 'checked' : '' }}> Khác</label>
                                    </div>
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">SĐT:</label>
                                    <input type="text" name="sdt"
                                        class="w-full border rounded px-3 py-2 @error('sdt') border-red-500 @enderror"
                                        value="{{ old('sdt', session('user_sdt')) }}" required>
                                    @error('sdt')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Địa chỉ --}}
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Số Nhà</label>
                                    <input type="text" name="house_number"
                                        class="w-full border rounded px-3 py-2 @error('house_number') border-red-500 @enderror"
                                        value="{{ old('house_number', $address->house_number ?? '') }}" required>
                                    @error('house_number')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tương tự cho ward, district, city -->
                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Xã/Phường</label>
                                    <input type="text" name="ward"
                                        class="w-full border rounded px-3 py-2 @error('ward') border-red-500 @enderror"
                                        value="{{ old('ward', $address->ward ?? '') }}" required>
                                    @error('ward')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Huyện/Quận</label>
                                    <input type="text" name="district"
                                        class="w-full border rounded px-3 py-2 @error('district') border-red-500 @enderror"
                                        value="{{ old('district', $address->district ?? '') }}" required>
                                    @error('district')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block font-semibold text-gray-700 mb-1">Tỉnh/TP</label>
                                    <input type="text" name="city"
                                        class="w-full border rounded px-3 py-2 @error('city') border-red-500 @enderror"
                                        value="{{ old('city', $address->city ?? '') }}" required>
                                    @error('city')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit"
                                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded font-bold">
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Address -->
                <div class="tab-content hidden" id="tab-address">
                    <!-- Address List View -->
                    <div id="address-list-view">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Địa Chỉ</h2>
                            <button id="btn-show-add-address"
                                class="px-4 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-semibold">
                                Thêm mới
                            </button>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach ($addressAll as $addressAlls)
                                <!-- Address Card -->
                                <div class="bg-white p-4 rounded shadow flex flex-col gap-1">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-bold text-orange-500">
                                            <i class="fa fa-home mr-1"></i> {{ $addressAlls->name }}
                                        </span>
                                        <span>

                                            <button type="button" id="btn-show-edit-address"
                                                class="btn-show-edit-address  text-orange-500"
                                                data-id="{{ $addressAlls->id }}" data-name="{{ $addressAlls->name }}"
                                                data-sdt="{{ $addressAlls->sdt }}"
                                                data-house_number="{{ $addressAlls->house_number }}"
                                                data-ward="{{ $addressAlls->ward }}"
                                                data-district="{{ $addressAlls->district }}"
                                                data-city="{{ $addressAlls->city }}" data-note="{{ $addressAlls->note }}"
                                                data-default="{{ $addressAlls->default }}">
                                                <i class="fa fa-edit"></i>
                                            </button>


                                            <form action="{{ route('user.destroyAddress', $addressAlls->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="ml-2 text-orange-400 hover:text-orange-600 btn-delete-address">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        {{ $addressAlls->house_number }}, {{ $addressAlls->ward }},
                                        {{ $addressAlls->district }}, {{ $addressAlls->city }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Add Address View -->
                    <div id="address-add-view" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Thêm Địa Chỉ</h2>
                            <button id="btn-cancel-add-address"
                                class="px-4 py-1.5 bg-orange-200 hover:bg-orange-300 text-orange-600 rounded-full text-sm font-semibold">
                                Hủy
                            </button>
                        </div>
                        <form action="{{ route('user.add-address') }}" method="POST" class="bg-white rounded shadow p-6"
                            id="addressForm">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-3 mb-3">
                                <input type="text" name="name" placeholder="Tên người nhận *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('name') border-red-500 @enderror"
                                    value="{{ old('name') }}" required>
                                <input type="text" name="sdt" placeholder="Số điện thoại *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('sdt') border-red-500 @enderror"
                                    value="{{ old('sdt') }}" required>
                                <input type="text" name="house_number" placeholder="Số nhà *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('house_number') border-red-500 @enderror"
                                    value="{{ old('house_number') }}" required>
                                <input type="text" name="ward" placeholder="Phường/Xã *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('ward') border-red-500 @enderror"
                                    value="{{ old('ward') }}" required>
                                <input type="text" name="district" placeholder="Quận/Huyện *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('district') border-red-500 @enderror"
                                    value="{{ old('district') }}" required>
                                <input type="text" name="city" placeholder="Tỉnh/Thành phố *"
                                    class="border border-gray-300 rounded px-3 py-2 text-sm @error('city') border-red-500 @enderror"
                                    value="{{ old('city') }}" required>
                            </div>
                            <textarea name="note" placeholder="Ghi chú"
                                class="border border-gray-300 rounded px-3 py-2 w-full text-sm min-h-[70px] mb-4">{{ old('note') }}</textarea>
                            <div class="mb-4 flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="default" value="1" class="mr-1" {{ old('default', '1') == '1' ? 'checked' : '' }} onclick="setDefaultRadio(this.value)"> Nhà
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="default" value="0" class="mr-1" {{ old('default', '0') == '0' ? 'checked' : '' }} onclick="setDefaultRadio(this.value)"> Khác
                                </label>
                            </div>
                            <div class="flex gap-3">
                                <button type="reset" class="bg-orange-200 text-orange-700 px-6 py-2 rounded font-bold"
                                    onclick="clearFormData()">Cài Lại</button>
                                <button type="submit"
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-bold">Lưu</button>
                            </div>
                        </form>
                        <script>
                            function clearFormData() {
                                // Xóa mọi dữ liệu nhập trên form (giữ đúng theo nút reset)
                                document.getElementById('addressForm').reset();
                            }
                        </script>
                    </div>

                    <!-- edit Address View -->
                    <div id="address-edit-view" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Sửa Địa Chỉ</h2>
                            <button id="btn-cancel-edit-address"
                                class="px-4 py-1.5 bg-orange-200 hover:bg-orange-300 text-orange-600 rounded-full text-sm font-semibold">
                                Hủy
                            </button>
                        </div>
                        <form action="{{ route('user.edit-address') }}" method="POST"
                            class="bg-white rounded shadow p-6" id="addressEditForm">
                            @csrf
                            <input type="hidden" name="id" id="edit_address_id">
                            <div class="grid md:grid-cols-2 gap-3 mb-3">
                                <div><label class="block font-semibold text-gray-700 mb-1">Tên người nhận</label>
                                    <input type="text" name="name" placeholder="Tên người nhận *"
                                        class="border border-gray-300 rounded px-3 py-2 text-sm w-full @error('name') border-red-500 @enderror"
                                        value="{{ old('name') }}" required>
                                </div>

                                <div><label class="block font-semibold text-gray-700 mb-1">Số điện thoại</label><input
                                        type="text" name="sdt" placeholder="Số điện thoại *"
                                        class="border border-gray-300 rounded px-3 py-2 text-sm w-full @error('sdt') border-red-500 @enderror"
                                        value="{{ old('sdt') }}" required></div>

                                <div><label class="block font-semibold text-gray-700 mb-1">Số nhà</label>
                                    <input type="text" name="house_number" placeholder="Số nhà *"
                                        class="border border-gray-300 rounded px-3 py-2 text-sm w-full @error('house_number') border-red-500 @enderror"
                                        value="{{ old('house_number') }}" required>
                                </div>


                                <div><label class="block font-semibold text-gray-700 mb-1">Phường/Xã</label>
                                    <input type="text" name="ward" placeholder="Phường/Xã *"
                                        class="border border-gray-300 rounded px-3 py-2 text-sm w-full @error('ward') border-red-500 @enderror"
                                        value="{{ old('ward') }}" required>
                                </div>

                                <div><label class="block font-semibold text-gray-700 mb-1">Quận/Huyện</label>
                                    <input type="text" name="district" placeholder="Quận/Huyện *"
                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm @error('district') border-red-500 @enderror"
                                        value="{{ old('district') }}" required>
                                </div>


                                <div><label class="block font-semibold text-gray-700 mb-1">Tỉnh/TP</label>
                                    <input type="text" name="city" placeholder="Tỉnh/Thành phố *"
                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm @error('city') border-red-500 @enderror"
                                        value="{{ old('city') }}" required>
                                </div>

                            </div>
                            <div><label class="block font-semibold text-gray-700 mb-1">Ghi Chú</label>
                                <textarea name="note" placeholder="Ghi chú"
                                    class="border border-gray-300 rounded px-3 py-2 w-full text-sm min-h-[70px] mb-4">{{ old('note') }}</textarea>
                            </div>

                            <div class="mb-4 flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="default" value="1" class="mr-1" {{ old('default', '1') == '1' ? 'checked' : '' }} onclick="setDefaultRadio(this.value)"> Nhà
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="default" value="0" class="mr-1" {{ old('default', '0') == '0' ? 'checked' : '' }} onclick="setDefaultRadio(this.value)"> Khác
                                </label>
                            </div>
                            <div class="flex gap-3">
                                <button type="reset" class="bg-orange-200 text-orange-700 px-6 py-2 rounded font-bold"
                                    onclick="clearFormData()">Cài Lại</button>
                                <button type="submit"
                                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-bold">Lưu</button>
                            </div>
                        </form>
                        <script>
                            function clearFormData() {
                                // Xóa mọi dữ liệu nhập trên form (giữ đúng theo nút reset)
                                document.getElementById('addressEditForm').reset();
                            }
                        </script>
                    </div>
                </div>

                <!-- Order -->
                <!-- Order List Tab -->
                <div class="tab-content hidden" id="tab-order">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Danh Sách Đơn Hàng</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded shadow overflow-hidden text-sm">
                            <thead>
                                <tr class="bg-orange-500 text-white">
                                    <th class="px-4 py-2 text-left">Mã Đơn</th>
                                    <th class="px-4 py-2 text-left">Ngày Đặt Đơn</th>
                                    <th class="px-4 py-2 text-left">Trạng Thái</th>
                                    <th class="px-4 py-2 text-right">Giá Trị</th>
                                    <th class="px-4 py-2">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody id="order-table-body">
                                @forelse($myOrderLists as $orderId => $items)
                                    @php $firstItem = $items->first(); @endphp
                                    <tr class="order-row">
                                        <td class="px-4 py-2">#{{ $firstItem->order_code }}</td>
                                        <td class="px-4 py-2">{{ $firstItem->time_order }}</td>
                                        <td class="px-4 py-2">
                                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">
                                                {{ $firstItem->statusorder }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-right">
                                            {{ number_format($firstItem->totalprice, 0, ',', '.') }}đ
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <button
                                                class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs view-detail-btn"
                                                data-order-id="{{ $firstItem->id_order }}">
                                                Chi Tiết
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 py-4">Chưa có đơn hàng</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- PHÂN TRANG -->
                        <div id="order-pagination" class="flex justify-center items-center gap-2 mt-4"></div>
                        <script>

                            document.addEventListener("DOMContentLoaded", () => {
                                const rows = document.querySelectorAll('#order-table-body .order-row');
                                const pagination = document.getElementById('order-pagination');
                                const itemsPerPage = 6; // số dòng mỗi trang
                                let currentPage = 1;

                                function showPage(page) {
                                    const start = (page - 1) * itemsPerPage;
                                    const end = start + itemsPerPage;
                                    rows.forEach((row, idx) => {
                                        row.style.display = (idx >= start && idx < end) ? '' : 'none';
                                    });
                                }

                                function renderPagination() {
                                    pagination.innerHTML = '';
                                    const totalPages = Math.ceil(rows.length / itemsPerPage);
                                    if (totalPages <= 1) return;
                                    for (let i = 1; i <= totalPages; i++) {
                                        const btn = document.createElement('button');
                                        btn.textContent = i;
                                        btn.className = 'w-8 h-8 border rounded ' +
                                            (i === currentPage ? 'bg-[#e60012] text-white font-bold' : 'text-gray-700 border-gray-300') +
                                            ' hover:bg-[#e60012] hover:text-white transition';
                                        btn.addEventListener('click', () => {
                                            currentPage = i;
                                            showPage(currentPage);
                                            renderPagination();
                                        });
                                        pagination.appendChild(btn);
                                    }
                                }

                                // Chỉ chạy nếu có đơn hàng
                                if (rows.length > 0) {
                                    showPage(currentPage);
                                    renderPagination();
                                }
                            });

                        </script>
                        </table>
                    </div>
                </div>

                <!-- Invoice Detail (ẩn mặc định) -->
                <div class="tab-content hidden" id="invoice-detail"
                    data-order-status="{{ $firstItem->statusorder ?? '' }}"
                    data-order-id="{{ $firstItem->id_order ?? 0 }}">
                    <div class="flex items-center gap-2 mb-2">
                        <button id="go-back-btn"
                            class="bg-orange-100 hover:bg-orange-200 text-orange-500 px-4 py-1.5 rounded-full text-sm font-bold flex items-center">
                            <i class="fa fa-arrow-left mr-2"></i>Quay Lại
                        </button>
                        <span class="text-lg font-semibold text-gray-800">Đơn Hàng</span>
                    </div>
                    <!-- Steps -->
                    <div class="flex items-center gap-0 mt-2 mb-4" id="order-status-steps">
                        <div class="flex flex-col items-center flex-1" data-step="Chờ Xác Nhận">
                            <div
                                class="border-2 border-orange-400 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg mb-1 text-orange-500">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="text-xs text-orange-500 font-bold">Chờ Xác Nhận</div>
                        </div>
                        <div class="h-1 w-8 bg-orange-400"></div>
                        <div class="flex flex-col items-center flex-1" data-step="Đã Xác Nhận">
                            <div
                                class="border-2 border-gray-300 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg mb-1">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="text-xs text-gray-500 font-bold">Đã Xác Nhận</div>
                        </div>
                        <div class="h-1 w-8 bg-gray-300"></div>
                        <div class="flex flex-col items-center flex-1" data-step="Đang Thực Hiện">
                            <div
                                class="border-2 border-gray-300 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg mb-1">
                                <i class="fa fa-box"></i>
                            </div>
                            <div class="text-xs text-gray-500 font-bold">Đang Thực Hiện</div>
                        </div>
                        <div class="h-1 w-8 bg-gray-300"></div>
                        <div class="flex flex-col items-center flex-1" data-step="Đang Giao Hàng">
                            <div
                                class="border-2 border-gray-300 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg mb-1">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="text-xs text-gray-500 font-bold">Đang Giao Hàng</div>
                        </div>
                        <div class="h-1 w-8 bg-gray-300"></div>
                        <div class="flex flex-col items-center flex-1" data-step="Hoàn Thành">
                            <div
                                class="border-2 border-gray-300 rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg mb-1">
                                <i class="fa fa-flag-checkered"></i>
                            </div>
                            <div class="text-xs text-gray-500 font-bold">Hoàn Thành</div>
                        </div>
                    </div>
                    <!-- Invoice Info -->
                    <div class="flex flex-col md:flex-row md:justify-between mb-2 gap-3">
                        <div>
                            <div class="text-xs text-gray-700 font-semibold mb-1">Đơn Hàng:</div>
                            <div class="text-sm text-gray-700">

                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mt-2 md:mt-0">
                            <div><span class="font-semibold">Invoice No:</span> 4576</div>
                            <div><span class="font-semibold">Mã Hóa Đơn:</span> #2545768745</div>
                            <div><span class="font-semibold">Ngày Tháng:</span> 10-11-2022</div>
                        </div>
                    </div>
                    <!-- Table Invoice -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border rounded shadow mt-2 mb-2 text-sm">
                            <thead>
                                <tr class="bg-orange-500 text-white">
                                    <th class="px-2 py-1 border">STT</th>
                                    <th class="px-2 py-1 border">Tên Món Ăn</th>
                                    <th class="px-2 py-1 border">Giá</th>
                                    <th class="px-2 py-1 border">Số Lượng</th>
                                    <th class="px-2 py-1 border">Tổng Tiền</th>
                                    <th class="px-2 py-1 border">Đánh Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="px-2 py-1 border text-center">01</td>
                                    <td class="px-2 py-1 border">
                                        Hyderabadi Biryani<br><span class="text-xs text-gray-400">Small<br>Coca
                                            Cola</span>
                                    </td>
                                    <td class="px-2 py-1 border text-right">$120</td>
                                    <td class="px-2 py-1 border text-center">2</td>
                                    <td class="px-2 py-1 border text-right">$240</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                            <tfoot>
                                <tr class="bg-white">
                                    <td colspan="3" class="border px-2 py-1 text-right font-bold">Chi Tiết:</td>
                                    <td class="border px-2 py-1 text-center font-bold">2</td>
                                    <td class="border px-2 py-1 text-right font-bold">$240</td>
                                </tr>
                                <tr class="bg-white">
                                    <td colspan="4" class="border px-2 py-1 text-right text-xs text-gray-600">
                                        (-) Mã Giảm Giá</td>
                                    <td class="border px-2 py-1 text-right">$0.00</td>
                                </tr>
                                <tr class="bg-white">
                                    <td colspan="4" class="border px-2 py-1 text-right text-xs text-gray-600">
                                        (+) Phí Vận Chuyển</td>
                                    <td class="border px-2 py-1 text-right">$10.00</td>
                                </tr>
                                <tr class="bg-white">
                                    <td colspan="4" class="border px-2 py-1 text-right font-bold">Tổng Thanh Toán
                                    </td>
                                    <td class="border px-2 py-1 text-right font-bold">$250</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="flex justify-end">
                        <button id="btn-cancel-order"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded mt-2 mr-2 font-bold"><i
                                class="fa fa-file-pdf mr-2 "></i>Hủy</button>
                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded mt-2 mr-2 font-bold"><i
                                class="fa fa-file-pdf mr-2"></i>Liên Hệ</button>
                        <button id="btn-review-order"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded mt-2 mr-2 font-bold"><i
                                class="fa fa-file-pdf mr-2"></i>Đánh Giá</button>
                    </div>
                </div>

                <div id="modal-review"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md overflow-hidden">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-xl font-bold">Viết Đánh Giá</h2>
                        </div>
                        <form id="form-review" action="{{ route('reviews.store') }}" method="POST"
                            enctype="multipart/form-data" class="px-6 py-4 space-y-4">
                            @CSRF
                            <!-- Chọn sao -->
                            <input type="hidden" name="order_id" id="review-order-id" value="">
                            <div>
                                <label class="block font-medium mb-2">Chọn số sao:</label>
                                <div id="star-container" class="flex space-x-1 text-yellow-400 cursor-pointer">
                                    <i class="star fa-regular fa-star text-2xl" data-value="1"></i>
                                    <i class="star fa-regular fa-star text-2xl" data-value="2"></i>
                                    <i class="star fa-regular fa-star text-2xl" data-value="3"></i>
                                    <i class="star fa-regular fa-star text-2xl" data-value="4"></i>
                                    <i class="star fa-regular fa-star text-2xl" data-value="5"></i>
                                </div>
                                <input type="hidden" name="rating" id="rating-value" value="0">
                            </div>

                            <div>
                                <label class="block font-medium mb-2">Chọn sản phẩm để đánh giá:</label>
                                <select name="food_id" id="select-review-product"
                                    class="w-full border rounded px-3 py-2" required>
                                    <!-- JS sẽ render -->
                                </select>
                            </div>

                            <!-- Thêm hình -->
                            <div>
                                <label class="block font-medium mb-2">Thêm hình (tối đa 4):</label>
                                <input type="file" id="review-images" accept="image/*" multiple class="block w-full" />
                                <div id="preview-container" class="mt-2 grid grid-cols-4 gap-2"></div>
                            </div>
                            <div>
                                <textarea name="review" rows="4" placeholder="Write your review"
                                    class="w-full border rounded px-3 py-2" required></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2">
                                <button type="button" id="btn-close-review"
                                    class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Hủy</button>
                                <button type="submit"
                                    class="px-6 py-2 rounded bg-orange-500 text-white hover:bg-orange-600">Đánh
                                    Giá</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Wishlist -->
                <div class="tab-content hidden" id="tab-wishlist">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Yêu Thích</h2>
                    <div class="grid md:grid-cols-3 gap-4" id="wishlist-list">
                        @foreach ($foodFavorites as $foodFavorite)
                            <div class="bg-white rounded shadow p-3 flex flex-col items-center wishlist-row">
                                <a href="{{ route('views.menudetail', [$foodFavorite->id, $foodFavorite->slug]) }}">
                                    <img src="{{ asset('img/' . $foodFavorite->image) }}" class="@if($foodFavorite->status == 'Hết Hàng') opacity-60 grayscale @endif">
                                </a>
                                <a href="{{ route('views.menudetail', [$foodFavorite->id, $foodFavorite->slug]) }}">
                                    <div class="text-base font-semibold text-gray-800 text-center mb-1">
                                        {{ $foodFavorite->name }}
                                    </div>
                                </a>
                                <div class="flex items-center text-yellow-400 mb-1 text-xs">
                                @php
                                    $avg = round($foodFavorite->avg_rate, 1);
                                    $stars = floor($avg);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $stars)
                                    <i class="fa-solid fa-star"></i>
                                    @elseif($i - $avg < 1)
                                    <i class="fa-solid fa-star-half-alt"></i>
                                    @else
                                    <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                                <span class="ml-1 text-gray-600">({{ $foodFavorite->count_rate }})</span>
                                </div>
                                <div class="mb-2 text-orange-500 font-bold">
                                    {{ number_format($foodFavorite->price, 0, ',', '.') }}đ
                                </div>
                               <div class="flex items-center justify-between gap-2 mt-2">
                                <button
                                    type="button"
                                    class="add-to-cart @if($foodFavorite->status == 'Hết Hàng') opacity-60 grayscale @endif bg-orange-500 text-white px-4 py-1 rounded"
                                    data-food-id="{{ $foodFavorite->id }}"
                                    @if($foodFavorite->status == 'Hết Hàng') disabled @endif
                                >
                                    Thêm Giỏ Hàng
                                </button>
                                <span>
                                    <i class="fa-solid fa-trash text-red-500 cursor-pointer ml-2 btn-remove-wishlist"
                                    data-id="{{ $foodFavorite->id_cart }}"></i>
                                </span>
                            </div>

                            </div>
                        @endforeach
                    </div>
                    <div id="wishlist-pagination" class="flex justify-center items-center gap-2 mt-4"></div>    
             </div>
<!--  Xóa yêu thích  -->           
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-remove-wishlist').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const id = btn.dataset.id;
            if (!id) return showPopup('Không xác định sản phẩm!');
            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa sản phẩm này khỏi yêu thích?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/wishlist/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Xóa dòng trên giao diện
                            const card = btn.closest('.wishlist-row');
                            if (card) card.remove();
                            showPopup(data.message || 'Đã xóa!');
                        } else {
                            showPopup(data.message || 'Xóa thất bại!');
                        }
                    })
                    .catch(() => showPopup('Lỗi kết nối server!'));
                }
            });
        });
    });
});
</script>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const wishlistRows = document.querySelectorAll("#wishlist-list .wishlist-row");
                        const wishlistPagination = document.getElementById("wishlist-pagination");
                        const wishlistPerPage = 3; // Giảm xuống 2 để test nếu ít sản phẩm!
                        let wishlistPage = 1;

                        function showWishlistPage(page) {
                            const start = (page - 1) * wishlistPerPage;
                            const end = start + wishlistPerPage;
                            wishlistRows.forEach((row, idx) => {
                                row.style.display = (idx >= start && idx < end) ? "" : "none";
                            });
                        }

                        function renderWishlistPagination() {
                            wishlistPagination.innerHTML = "";
                            const totalPages = Math.ceil(wishlistRows.length / wishlistPerPage);
                            if (totalPages <= 1) return;



                            for (let i = 1; i <= totalPages; i++) {
                                const btn = document.createElement("button");
                                btn.textContent = i;
                                btn.className =
                                    "w-8 h-8 border rounded " +
                                    (i === wishlistPage
                                        ? "bg-[#e60012] text-white font-bold"
                                        : "text-gray-700 border-gray-300") +
                                    " hover:bg-[#e60012] hover:text-white transition";
                                btn.onclick = () => {
                                    wishlistPage = i;
                                    showWishlistPage(wishlistPage);
                                    renderWishlistPagination();
                                };
                                wishlistPagination.appendChild(btn);
                            }



                        }

                        if (wishlistRows.length > 0) {
                            showWishlistPage(wishlistPage);
                            renderWishlistPagination();
                        }
                    });
                </script>
                <!-- Review -->
                <div class="tab-content hidden" id="tab-review">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Đánh Giá</h2>
                    <div class="space-y-6" id="review-list">
                        @foreach ($myReviews as $myReview)
                            <div class="flex gap-4 bg-white rounded shadow p-4 items-center review-row">
                                <img src="{{ asset('img/' . $myReview->image) }}"
                                    class="rounded-full w-14 h-14 object-cover" />
                                <div class="flex-2">
                                    <div class="font-bold text-gray-800">{{ $myReview->name }} <span
                                            class="ml-3 text-xs text-gray-400">{{ $myReview->time }}</span></div>
                                    <div class="flex items-center text-yellow-400 text-xs mb-1">
                                        @php
                                            $fullStars = floor($myReview->rate);
                                            $halfStar = ($myReview->rate - $fullStars) >= 0.5 ? 1 : 0;
                                            $emptyStars = 5 - $fullStars - $halfStar;
                                        @endphp

                                        {{-- In sao đầy --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa fa-star text-yellow-500"></i>
                                        @endfor

                                        {{-- In nửa sao nếu có --}}
                                        @if ($halfStar)
                                            <i class="fa fa-star-half-alt text-yellow-500"></i>
                                        @endif

                                        {{-- In sao rỗng --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fa-regular fa-star text-yellow-500"></i>
                                        @endfor

                                        <span class="ml-1 text-gray-600">(120)</span>
                                    </div>
                                    <div class="text-sm text-gray-600">{!! $myReview->description !!}</div>
                                    <div class="mt-1">
                                        <span
                                            class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">{{ $myReview->type_menu }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 flex items-end justify-end">
                                    <i class="fa-solid fa-trash text-red-500 cursor-pointer btn-remove-review"
                                    data-id="{{ $myReview->id_rate }}"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="review-pagination" class="flex justify-center items-center gap-2 mt-4"></div>
                </div>
                <!-- Xóa đánh giá -->
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.btn-remove-review').forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            const id = btn.dataset.id;
                            if (!id) return showPopup('Không xác định đánh giá!');

                            Swal.fire({
                                title: 'Bạn chắc chắn muốn xóa đánh giá này?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Xóa',
                                cancelButtonText: 'Hủy'
                            }).then(result => {
                                if (result.isConfirmed) {
                                    fetch(`/delete/reviews/${id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.success) {
                                            // Xóa review khỏi giao diện
                                            const card = btn.closest('.review-row');
                                            if (card) card.remove();
                                            showPopup(data.message || 'Đã xóa!');
                                        } else {
                                            showPopup(data.message || 'Xóa thất bại!');
                                        }
                                    })
                                    .catch(() => showPopup('Lỗi kết nối server!'));
                                }
                            });
                        });
                    });
                });
                </script>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // --- Phân trang Đánh giá ---
                        const reviewRows = document.querySelectorAll("#review-list .review-row");
                        const reviewPagination = document.getElementById("review-pagination");
                        const reviewsPerPage = 3;
                        let reviewPage = 1;

                        function showReviewPage(page) {
                            const start = (page - 1) * reviewsPerPage;
                            const end = start + reviewsPerPage;
                            reviewRows.forEach((row, idx) => {
                                row.style.display = (idx >= start && idx < end) ? "" : "none";
                            });
                        }

                        function renderReviewPagination() {
                            reviewPagination.innerHTML = "";
                            const totalPages = Math.ceil(reviewRows.length / reviewsPerPage);
                            if (totalPages <= 1) return;



                            // Các nút số trang
                            for (let i = 1; i <= totalPages; i++) {
                                const btn = document.createElement("button");
                                btn.textContent = i;
                                btn.className =
                                    "w-8 h-8 flex items-center justify-center border rounded " + // Bỏ 'rounded-full', chỉ 'rounded'
                                    (i === reviewPage
                                        ? "bg-[#e60012] text-white font-bold"  // Nền đỏ, chữ trắng, in đậm nếu đang chọn
                                        : "text-gray-700 border-gray-300") +  // Trang khác: xám, viền xám
                                    " hover:bg-[#e60012] hover:text-white transition"; // Hover: nền đỏ, chữ trắng, chuyển mượt
                                btn.onclick = () => { reviewPage = i; showReviewPage(reviewPage); renderReviewPagination(); };
                                reviewPagination.appendChild(btn);
                            }



                        }

                        if (reviewRows.length > 0) {
                            showReviewPage(reviewPage);
                            renderReviewPagination();
                        }
                    });
                </script>

                <!-- Change Password -->
                <div class="tab-content hidden" id="tab-password">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Đổi Mật Khẩu</h2>
                    <form id="changePasswordForm" class="bg-white rounded shadow p-6 flex flex-col md:flex-row gap-4">
                        @csrf
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật Khẩu Hiện Tại</label>
                            <input type="password" name="current_password"
                                class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Current Password"
                                required>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mật Khẩu Mới</label>
                            <input type="password" name="new_password"
                                class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="New Password"
                                required>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nhập Lại Mật Khẩu</label>
                            <input type="password" name="new_password_confirmation"
                                class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Confirm Password"
                                required>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded mt-6 font-bold">Xác
                                Nhận</button>
                        </div>
                    </form>
                    <div id="changePasswordMsg" class="mt-2"></div>
                </div>
                <!-- Logout (fake redirect) -->
                <div class="tab-content hidden text-center" id="tab-logout">
                    <div class="text-2xl text-orange-500 font-bold mt-20 mb-4"><i class="fa fa-sign-out-alt"></i> Logout
                    </div>
                    <p class="text-gray-700">You have been logged out!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sửa địa chỉ -->
    <script>
        document.querySelectorAll('.btn-show-edit-address').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                // 1. Đưa view list đi, hiển thị view edit
                document.getElementById('address-list-view').classList.add('hidden');
                document.getElementById('address-edit-view').classList.remove('hidden');
                // 2. Điền data vào form edit
                document.getElementById('edit_address_id').value = btn.dataset.id;
                document.querySelector('#address-edit-view input[name="name"]').value = btn.dataset.name;
                document.querySelector('#address-edit-view input[name="sdt"]').value = btn.dataset.sdt;
                document.querySelector('#address-edit-view input[name="birthday"]').value = btn.dataset.birthday;
                document.querySelector('#address-edit-view input[name="gender"][value="' + btn.dataset.gender + '"]').checked = true;
                document.querySelector('#address-edit-view input[name="house_number"]').value = btn.dataset.house_number;
                document.querySelector('#address-edit-view input[name="ward"]').value = btn.dataset.ward;
                document.querySelector('#address-edit-view input[name="district"]').value = btn.dataset.district;
                document.querySelector('#address-edit-view input[name="city"]').value = btn.dataset.city;
                document.querySelector('#address-edit-view textarea[name="note"]').value = btn.dataset.note;
                // radio default
                const def = btn.dataset.default;
                document.querySelector(`#address-edit-view input[name="default"][value="${def}"]`).checked = true;
            });
        });

        // Hủy chỉnh sửa
        document.getElementById('btn-cancel-edit-address').addEventListener('click', e => {
            e.preventDefault();
            document.getElementById('address-edit-view').classList.add('hidden');
            document.getElementById('address-list-view').classList.remove('hidden');
        });
    </script>

    <!-- Thêm giỏ hàng -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Đặt toàn bộ JS thêm giỏ hàng ở đây
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', async e => {
                    const foodId = btn.dataset.foodId;
                    try {
                        const res = await fetch("{{ route('cart.add') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            body: JSON.stringify({
                                food_id: foodId,
                                quantity: 1
                            })
                        });

                        const data = await res.json();
                        if (res.ok && data.success) {
                            showPopup(data.message);
                        } else {
                            showPopup(data.message || data.error || 'Có lỗi xảy ra');
                        }

                    } catch (err) {
                        showPopup(err.message || 'Lỗi kết nối');
                    }
                });
            });
        });
    </script>


    <!-- Đổi Mật Khẩu -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('changePasswordForm');
            const msgDiv = document.getElementById('changePasswordMsg');
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                msgDiv.innerHTML = '';
                const formData = new FormData(form);
                fetch("{{ route('user.change-password') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(async res => {
                        const data = await res.json();
                        if (data.success) {
                            msgDiv.innerHTML = '<div class="text-green-600 font-bold">' + data.message + '</div>';
                            form.reset();
                        } else {
                            // Nếu có lỗi validate từng trường
                            if (data.errors) {
                                let errorHtml = '<ul class="text-red-500 font-bold">';
                                Object.values(data.errors).forEach(errArr => {
                                    errorHtml += '<li>' + errArr[0] + '</li>';
                                });
                                errorHtml += '</ul>';
                                msgDiv.innerHTML = errorHtml;
                            } else {
                                msgDiv.innerHTML = '<div class="text-red-500 font-bold">' + data.message + '</div>';
                            }
                        }
                    })
                    .catch(error => {
                        msgDiv.innerHTML = '<div class="text-red-500 font-bold">Có lỗi kết nối server!</div>';
                    });
            });
        });
    </script>


    <!-- Popup comfirm xóa -->
    <script>
        document.querySelectorAll('.btn-delete-address').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                let form = this.closest('form');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn xóa?',
                    text: "Không thể hoàn tác sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- Xử lí content -->
    <script>
        (function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // ===== HELPER FUNCTIONS =====

            // Cập nhật màu sắc cho các bước trạng thái
            function setOrderStepStatus(currentStatus) {
                const steps = [
                    'Chờ Xác Nhận',
                    'Đã Xác Nhận',
                    'Đang Thực Hiện',
                    'Đang Giao Hàng',
                    'Hoàn Thành'
                ];
                const idx = steps.indexOf(currentStatus);
                document.querySelectorAll('#order-status-steps [data-step]').forEach((stepDiv, i) => {
                    const iconDiv = stepDiv.querySelector('.border-2');
                    const labelDiv = stepDiv.querySelector('.text-xs');
                    // border
                    iconDiv.classList.toggle('border-orange-400', i <= idx);
                    iconDiv.classList.toggle('border-gray-300', i > idx);
                    // text color
                    iconDiv.classList.toggle('text-orange-500', i <= idx);
                    iconDiv.classList.toggle('text-gray-500', i > idx);
                    labelDiv.classList.toggle('text-orange-500', i <= idx);
                    labelDiv.classList.toggle('text-gray-500', i > idx);
                });
                document.querySelectorAll('#order-status-steps .h-1').forEach((bar, i) => {
                    bar.classList.toggle('bg-orange-400', i < idx);
                    bar.classList.toggle('bg-gray-300', i >= idx);
                });
            }

            // Hiển thị popup (SweetAlert2)
            function showAlert(icon, title) {
                Swal.fire({
                    icon,
                    title,
                    confirmButtonText: 'Đồng ý'
                });
            }

            // ===== MAIN SCRIPT =====
            document.addEventListener('DOMContentLoaded', () => {

                // --- TAB SWITCHING ---
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
                        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
                        btn.classList.add('active-tab');
                        document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
                    });
                });

                // --- PROFILE EDIT ---
                document.getElementById('btn-edit-profile')?.addEventListener('click', () => {
                    document.getElementById('profile-view').classList.add('hidden');
                    document.getElementById('profile-edit').classList.remove('hidden');
                });
                document.getElementById('btn-cancel-edit')?.addEventListener('click', () => {
                    document.getElementById('profile-edit').classList.add('hidden');
                    document.getElementById('profile-view').classList.remove('hidden');
                });

                // --- ADDRESS ADD/EDIT TOGGLE ---
                ['add', 'edit'].forEach(mode => {
                    const showBtn = document.getElementById(`btn-show-${mode}-address`);
                    const cancelBtn = document.getElementById(`btn-cancel-${mode}-address`);
                    const listView = document.getElementById('address-list-view');
                    const formView = document.getElementById(`address-${mode}-view`);
                    showBtn?.addEventListener('click', () => {
                        listView.classList.add('hidden');
                        formView.classList.remove('hidden');
                    });
                    cancelBtn?.addEventListener('click', e => {
                        e.preventDefault();
                        formView.classList.add('hidden');
                        listView.classList.remove('hidden');
                    });
                });

                // --- DELETE ADDRESS CONFIRM ---
                document.querySelectorAll('.btn-delete-address').forEach(btn => {
                    btn.addEventListener('click', e => {
                        e.preventDefault();
                        const form = btn.closest('form');
                        Swal.fire({
                            title: 'Bạn chắc chắn muốn xóa?',
                            text: 'Không thể hoàn tác!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonText: 'Hủy',
                            confirmButtonText: 'Xóa'
                        }).then(res => {
                            if (res.isConfirmed) form.submit();
                        });
                    });
                });

                // --- ORDER DETAIL & STEPS ---
                document.querySelectorAll('.view-detail-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const orderId = btn.dataset.orderId;
                        fetch(`/order-detail/${orderId}`)
                            .then(r => r.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    renderInvoiceDetail(data);
                                    document.getElementById('tab-order').classList.add('hidden');
                                    document.getElementById('invoice-detail').classList.remove('hidden');
                                } else {
                                    showAlert('error', 'Không tìm thấy đơn hàng');
                                }
                            })
                            .catch(() => showAlert('error', 'Lỗi kết nối máy chủ'));
                    });
                });
                document.getElementById('go-back-btn')?.addEventListener('click', () => {
                    document.getElementById('invoice-detail').classList.add('hidden');
                    document.getElementById('tab-order').classList.remove('hidden');
                });

                function renderInvoiceDetail(data) {
                    const o = data.order;
                    const ds = data.details;
                    currentOrderId = o.id;
                    const selectProduct = document.getElementById('select-review-product');
                    const unrated = data.unrated_details || [];
                    if (selectProduct) {
    selectProduct.innerHTML = unrated.length > 0
        ? unrated.filter(item => !item.combo_id).map(item =>
            `<option value="${item.product_id}">
                ${item.food_name} (${item.quantity} x ${Number(item.food_price).toLocaleString()}đ)
            </option>`
        ).join('')
        : '<option disabled>Đã đánh giá hết các sản phẩm!</option>';
}

                    // Khách & header
                    document.querySelector('#invoice-detail .text-sm.text-gray-700').innerHTML =
                        `${o.customer_name}<br>${o.house_number}, ${o.ward}, ${o.district}, ${o.city}<br>${o.sdt}`;
                    document.querySelector('#invoice-detail .text-sm.text-gray-600').innerHTML =
                        `<div><strong>Invoice No:</strong> ${o.id}</div>` +
                        `<div><strong>Mã Hóa Đơn:</strong> #${o.code}</div>` +
                        `<div><strong>Ngày:</strong> ${o.created_at.substr(0, 10)}</div>`;

                    // Table body
                    let html = '', sum = 0, qty = 0;
                    const unratedIds = (data.unrated_details || []).map(item => item.product_id);

                    ds.forEach((it, i) => {
    // Nếu là combo thì lấy combo_name, combo_price
    const isCombo = it.combo_id && it.combo_id !== '0' && it.combo_name;
    const name = isCombo ? it.combo_name : it.food_name;
    const price = isCombo ? it.combo_price : it.food_price;
    const line = price * it.quantity;
    sum += line; qty += it.quantity;
    // Đánh giá chỉ dùng cho món ăn thường, không áp dụng cho combo
    const reviewStatus = (!isCombo && unratedIds.includes(it.product_id)) ? '-' : (isCombo ? '' : 'Rated');
    html += `
      <tr>
        <td class="px-2 py-1 border text-center">${String(i + 1).padStart(2, '0')}</td>
        <td class="px-2 py-1 border">${name}</td>
        <td class="px-2 py-1 border text-right">${Number(price).toLocaleString('vi-VN', { maximumFractionDigits: 0 })}đ</td>
        <td class="px-2 py-1 border text-center">${it.quantity}</td>
        <td class="px-2 py-1 border text-right">${line.toLocaleString()}đ</td>
        <td class="px-2 py-1 border text-right">${reviewStatus}</td>
      </tr>`;
});
                    document.querySelector('#invoice-detail tbody').innerHTML = html;

                    // Table footer
                    const disc = data.discount || 0;
                    const ship = data.shipping || 0;
                    const total = sum - disc + ship;
                    document.querySelector('#invoice-detail tfoot').innerHTML =
                        `<tr>
           <td colspan="3" class="border px-2 py-1 text-right font-bold">Chi Tiết:</td>
           <td class="border px-2 py-1 text-center font-bold">${qty}</td>
           <td class="border px-2 py-1 text-right font-bold">${sum.toLocaleString()}đ</td>
         </tr>
         <tr>
           <td colspan="4" class="border px-2 py-1 text-right text-xs text-gray-600">(-) Mã Giảm Giá</td>
           <td class="border px-2 py-1 text-right">${disc.toLocaleString()}đ</td>
         </tr>
         <tr>
           <td colspan="4" class="border px-2 py-1 text-right text-xs text-gray-600">(+) Phí Vận Chuyển</td>
           <td class="border px-2 py-1 text-right">${ship.toLocaleString()}đ</td>
         </tr>
         <tr>
           <td colspan="4" class="border px-2 py-1 text-right font-bold">Tổng Thanh Toán</td>
           <td class="border px-2 py-1 text-right font-bold">${total.toLocaleString()}đ</td>
         </tr>`;

                    // Cập nhật bước trạng thái
                    setOrderStepStatus(o.statusorder);

                    // Nút Hủy & Đánh Giá
                    const cb = document.getElementById('btn-cancel-order');
                    const rb = document.getElementById('btn-review-order');
                    cb.style.display = (o.statusorder === 'Chờ Xác Nhận') ? '' : 'none';
                    rb.style.display = (o.statusorder === 'Hoàn Thành') ? '' : 'none';

                    cb.onclick = async () => {
                        const ok = await Swal.fire({
                            title: 'Bạn có chắc muốn hủy đơn?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Hủy đơn',
                            cancelButtonText: 'Đóng'
                        }).then(r => r.isConfirmed);
                        if (!ok) return;
                        try {
                            const res = await fetch(`/orders/${o.id}/cancel`, {
                                method: 'PATCH',
                                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                            });
                            const j = await res.json();
                            if (res.ok && j.success) {
                                showAlert('success', j.message);
                                setOrderStepStatus('Đã Hủy');
                                cb.style.display = 'none';
                            } else {
                                showAlert('error', j.message || 'Hủy không thành công');
                            }
                        } catch {
                            showAlert('error', 'Lỗi kết nối server');
                        }
                    };
                }
                window.renderInvoiceDetail = renderInvoiceDetail;

                // ===== REVIEW MODAL & STAR-RATING =====

                // *** CẬN: UPDATE HTML STAR-ICON ***
                // Trong <div id="star-container"> đảm bảo bạn dùng FA6 như sau:
                //   <i class="star fa-regular fa-star text-2xl" data-value="1"></i>
                //   … (repeat data-value 1→5)
                // fa-regular = outline star, fa-solid = filled star

                const modal = document.getElementById('modal-review');
                const openReview = document.getElementById('btn-review-order');
                const closeReview = document.getElementById('btn-close-review');
                const starsEls = document.querySelectorAll('#star-container .star');
                const ratingInput = document.getElementById('rating-value');
                const fileInput = document.getElementById('review-images');
                const previewBox = document.getElementById('preview-container');
                let filesArr = [];

                openReview?.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    // Gán order_id vào input ẩn
                    document.getElementById('review-order-id').value = currentOrderId || '';
                    ratingInput.value = 5;
                    starsEls.forEach(s => {
                        const v = +s.dataset.value;
                        if (v <= 5) {
                            s.classList.add('fa-solid');
                            s.classList.remove('fa-regular');
                        } else {
                            s.classList.add('fa-regular');
                            s.classList.remove('fa-solid');
                        }
                    });
                });
                closeReview?.addEventListener('click', () => {
                    // 1. Ẩn modal
                    modal.classList.add('hidden');
                    // 2. Reset form
                    formReview.reset();
                    // 3. Reset star rating
                    ratingInput.value = 0;
                    starsEls.forEach(s => {
                        s.classList.add('fa-regular');
                        s.classList.remove('fa-solid');
                    });
                    // 4. Xóa preview images
                    filesArr = [];
                    document.getElementById('preview-container').innerHTML = '';
                    document.getElementById('review-images').disabled = false;
                });

                // Star click
                starsEls.forEach(s => {
                    s.addEventListener('click', () => {
                        const v = +s.dataset.value;
                        ratingInput.value = v;
                        starsEls.forEach(x => {
                            x.classList.toggle('fa-solid', +x.dataset.value <= v);
                            x.classList.toggle('fa-regular', +x.dataset.value > v);
                        });
                    });
                });


                // Image preview + limit 4
                function renderPreviews() {
                    previewBox.innerHTML = '';
                    filesArr.forEach((f, i) => {
                        const url = URL.createObjectURL(f);
                        const d = document.createElement('div');
                        d.className = 'relative inline-block m-1';
                        d.innerHTML = `
          <img src="${url}" class="w-16 h-16 object-cover rounded"/>
          <button data-i="${i}" type="button" class="absolute top-0 right-0 bg-black bg-opacity-50 text-white rounded-bl px-1">×</button>`;
                        previewBox.appendChild(d);
                    });
                    fileInput.disabled = filesArr.length >= 4;
                }
                fileInput?.addEventListener('change', e => {
                    Array.from(e.target.files).forEach(f => {
                        if (filesArr.length < 4) filesArr.push(f);
                    });
                    e.target.value = '';
                    renderPreviews();
                });
                previewBox?.addEventListener('click', e => {
                    const b = e.target.closest('button[data-i]');
                    if (!b) return;
                    filesArr.splice(+b.dataset.i, 1);
                    renderPreviews();
                });

                // AJAX submit review
                document.getElementById('form-review')?.addEventListener('submit', async e => {
                    e.preventDefault();
                    const form = e.target;
                    const fd = new FormData(form);
                    console.log("food_id gửi lên thực tế:", fd.get('food_id'));
                    fd.set('food_id', parseInt(fd.get('food_id')));
                    console.log("food_id gửi lên:", fd.get('food_id'));
                    filesArr.forEach(f => fd.append('images[]', f));
                    try {
                        const res = await fetch(form.action || location.href, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            body: fd
                        });
                        const j = await res.json();
                        if (res.ok && j.success) {
                            showAlert('success', j.message || 'Cảm ơn bạn đã đánh giá!');
                            modal.classList.add('hidden');
                            form.reset();
                            filesArr = [];
                            starsEls.forEach(x => x.classList.replace('fa-solid', 'fa-regular'));
                            renderPreviews();
                        } else {
                            showAlert('error', j.message || 'Gửi đánh giá thất bại');
                        }
                    } catch {
                        showAlert('error', 'Đánh giá thất bại');
                    }
                });

            }); // DOMContentLoaded
        })();  
    </script>


</body>

@include('layouts.user.footer')

</html>