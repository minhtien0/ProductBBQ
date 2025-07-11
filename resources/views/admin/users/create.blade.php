@extends('admin.index')
@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="flex w-full">
        @csrf

        {{-- Khung chính --}}
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thêm Người Dùng Mới</h1>

            {{-- Hiển thị lỗi validate (nếu có) --}}
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                    {!! session('error') !!}
                </div>
            @endif

            {{-- Thông tin cơ bản --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="user" class="block text-xs font-medium text-gray-700 mb-1">
                        Tên Đăng Nhập <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="user" name="user" value="{{ old('user') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="fullname" class="block text-xs font-medium text-gray-700 mb-1">
                        Họ Và Tên <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-700 mb-1">
                        Mật Khẩu <span class="text-red-600">*</span>
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">
                        Nhập Lại Mật Khẩu <span class="text-red-600">*</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="sdt" class="block text-xs font-medium text-gray-700 mb-1">
                        Số Điện Thoại <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="sdt" name="sdt" value="{{ old('sdt') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-1">
                        Email <span class="text-red-600">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="birthday" class="block text-xs font-medium text-gray-700 mb-1">
                        Ngày Sinh
                    </label>
                    <input type="date" id="birthday" name="birthday" value="{{ old('birthday') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">
                        Giới Tính <span class="text-red-600">*</span>
                    </label>
                    <select id="gender" name="gender"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Giới Tính</option>
                        <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            {{-- Phần Địa Chỉ Mặc Định --}}
            <h3 class="text-base font-bold mb-2 mt-6">Địa Chỉ Mặc Định</h3>
            <div class="bg-gray-50 rounded p-3 mb-3">
                {{-- ID nếu cập nhật, nhưng với thêm mới ta để trống --}}
                <input type="hidden" name="addresses[0][id]" value="">

                <div class="mb-2">
                    <label class="text-xs">Tên Người Nhận <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][name]" value="{{ old('addresses.0.name') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">SĐT <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][sdt]" value="{{ old('addresses.0.sdt') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Số Nhà <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][house_number]" value="{{ old('addresses.0.house_number') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Phường <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][ward]" value="{{ old('addresses.0.ward') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Quận/Huyện <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][district]" value="{{ old('addresses.0.district') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Tỉnh/Thành <span class="text-red-600">*</span></label>
                    <input type="text" name="addresses[0][city]" value="{{ old('addresses.0.city') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Ghi Chú</label>
                    <input type="text" name="addresses[0][note]" value="{{ old('addresses.0.note') }}"
                        class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="text-xs">
                        <input type="checkbox" name="addresses[0][default]" value="1" checked>
                        Địa chỉ mặc định
                    </label>
                </div>
            </div>
        </div>

        {{-- Sidebar: Avatar + Nút Thêm/Hủy --}}
        <div class="w-64 ml-3 space-y-3">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
                <div class="flex flex-col space-y-2">
                    <button type="submit"
                        class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                        <i class="fa-solid fa-plus mr-2"></i> Thêm Người Dùng
                    </button>
                    <a href="{{ route('admin.user.list') }}">
                        <button type="button"
                            class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                            <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                        </button>
                    </a>
                </div>
            </div>

            {{-- Avatar --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <label class="block text-xs font-medium text-gray-700 mb-2">Ảnh Đại Diện</label>
                <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                    <div class="text-center">
                        <img id="preview-img" src="#" alt="Ảnh xem trước"
                             class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden">

                        <input type="file" class="hidden" id="avatar" name="avatar" accept="image/*"
                               onchange="previewImage(event)">
                        <button type="button"
                                class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                                onclick="document.getElementById('avatar').click()">
                            Chọn Tệp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- JavaScript cho preview ảnh --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{-- Popup thông báo --}}
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection
