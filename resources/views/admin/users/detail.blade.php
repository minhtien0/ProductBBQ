@extends('admin.index')
@section('content')
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
        class="flex w-full">
        @csrf
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Sửa Thông Tin Khách Hàng</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="user" class="block text-xs font-medium text-gray-700 mb-1">Tên Đăng Nhập</label>
                    <input type="text" id="user" name="user" value="{{ old('user', $user->user) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly>
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="fullname" class="block text-xs font-medium text-gray-700 mb-1">Họ và tên</label>
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="sdt" class="block text-xs font-medium text-gray-700 mb-1">Số điện thoại</label>
                    <input type="text" id="sdt" name="sdt" value="{{ old('sdt', $user->sdt) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="birthday" class="block text-xs font-medium text-gray-700 mb-1">Ngày sinh</label>
                    <input type="date" id="birthday" name="birthday"
                        value="{{ old('birthday', $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Giới tính</label>
                    <select id="gender" name="gender"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn giới tính</option>
                        <option value="Nam" {{ old('gender', $user->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender', $user->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ old('gender', $user->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>
            <h3 class="text-base font-bold mb-2 mt-6">Địa Chỉ Mặc Định</h3>
            <div class="bg-gray-50 rounded p-3 mb-3">
                <input type="hidden" name="addresses[0][id]" value="{{ $addresses ? $addresses->id : '' }}">
                <div class="mb-2">
                    <label class="text-xs">Tên người nhận</label>
                    <input type="text" name="addresses[0][name]"
                        value="{{ old('addresses.0.name', $addresses ? $addresses->name : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">SĐT</label>
                    <input type="text" name="addresses[0][sdt]"
                        value="{{ old('addresses.0.sdt', $addresses ? $addresses->sdt : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Số nhà</label>
                    <input type="text" name="addresses[0][house_number]"
                        value="{{ old('addresses.0.house_number', $addresses ? $addresses->house_number : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Phường</label>
                    <input type="text" name="addresses[0][ward]"
                        value="{{ old('addresses.0.ward', $addresses ? $addresses->ward : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Quận/Huyện</label>
                    <input type="text" name="addresses[0][district]"
                        value="{{ old('addresses.0.district', $addresses ? $addresses->district : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Tỉnh/Thành</label>
                    <input type="text" name="addresses[0][city]"
                        value="{{ old('addresses.0.city', $addresses ? $addresses->city : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-2">
                    <label class="text-xs">Ghi chú</label>
                    <input type="text" name="addresses[0][note]"
                        value="{{ old('addresses.0.note', $addresses ? $addresses->note : '') }}"
                        class="w-full border rounded p-2">
                </div>
                <div>
                    <label><input type="checkbox" name="addresses[0][default]" value="1" {{ old('addresses.0.default', $addresses ? $addresses->default : 1) ? 'checked' : '' }}>
                        Địa chỉ mặc định
                    </label>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-64 ml-3 space-y-3">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
                <div class="flex flex-col space-y-2">
                    <button type="submit"
                        class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu
                    </button>
                    <a href="{{ route('admin.user.list') }}">
                        <button type="button"
                            class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                            <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                        </button>
                    </a>
                </div>
            </div>
            <!-- Avatar -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <label class="block text-xs font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                    <div class="text-center">
                        @if ($user->avatar)
                            <div class="mb-2 flex justify-center">
                                <img src="{{ asset('img/' . $user->avatar) }}" alt="Avatar"
                                    class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif
                        <input type="file" class="hidden" id="avatar" name="avatar" accept="image/*"
                            onchange="previewImage(event)">
                        <button type="button"
                            class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                            onclick="document.getElementById('avatar').click()">
                            Chọn tệp
                        </button>
                        
                        <img id="preview-img" src="#" alt="Ảnh xem trước"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden">
                    </div>
                </div>
            </div>
            <!-- Role -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <label for="role" class="block text-xs font-medium text-gray-700 mb-1">Quyền Truy Cập</label>
                <select id="role" name="role"
                    class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn vai trò</option>
                    <option selected value="Hoạt Động" {{ old('role', $user->role) == 'Hoạt Động' ? 'selected' : '' }}>Hoạt Động</option>
                    <option value="Ngưng Hoạt Động" {{ old('role', $user->role) == 'Ngưng Hoạt Động' ? 'selected' : '' }}>Ngưng Hoạt Động</option>
                </select>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection