@extends('admin.index')
@section('content')
    <form action="{{ route('admin.staff.add') }}" method="POST" enctype="multipart/form-data" class="flex w-full">
        @csrf
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thêm Nhân Viên</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="fullname" class="block text-xs font-medium text-gray-700 mb-1">Họ Và Tên <span class="text-red-600">*</span></label>
                    
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="">
                    <label for="role" class="block text-xs font-medium text-gray-700 mb-1">Chức Vụ <span class="text-red-600">*</span></label>
                    <select id="role" name="role"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn chức vụ</option>
                        <option value="Quản Lí" {{ old('role') == 'Quản Lí' ? 'selected' : '' }}>Quản Lí</option>
                        <option value="Nhân Viên" {{ old('role') == 'Nhân Viên' ? 'selected' : '' }}>Nhân Viên</option>
                        <option value="Đầu Bếp" {{ old('role') == 'Đầu Bếp' ? 'selected' : '' }}>Đầu Bếp</option>
                        <option value="Tạp Vụ" {{ old('role') == 'Tạp Vụ' ? 'selected' : '' }}>Tạp Vụ</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date_of_birth" class="block text-xs font-medium text-gray-700 mb-1">Ngày Sinh <span class="text-red-600">*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Giới Tính <span class="text-red-600">*</span></label>
                    <select id="gender" name="gender"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Giới Tính</option>
                        <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="SDT" class="block text-xs font-medium text-gray-700 mb-1">Số Điện Thoại <span class="text-red-600">*</span></label>
                    <input type="number" id="SDT" name="SDT" value="{{ old('SDT') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="CCCD" class="block text-xs font-medium text-gray-700 mb-1">CCCD <span class="text-red-600">*</span></label>
                    <input type="number" id="CCCD" name="CCCD" value="{{ old('CCCD') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="address" class="block text-xs font-medium text-gray-700 mb-1">Địa Chỉ <span class="text-red-600">*</span></label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="time_work" class="block text-xs font-medium text-gray-700 mb-1">Ngày Vào Làm <span class="text-red-600">*</span></label>
                    <input type="date" id="time_work" name="time_work" value="{{ old('time_work') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="branch" class="block text-xs font-medium text-gray-700 mb-1">Đơn Vị <span class="text-red-600">*</span></label>
                    <select id="branch" name="branch"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Đơn Vị</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="type" class="block text-xs font-medium text-gray-700 mb-1">Loại Nhân Viên <span class="text-red-600">*</span></label>
                    <select id="type" name="type"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Loại Nhân Viên</option>
                        <option value="Full Time" {{ old('type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part Time" {{ old('type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Trạng Thái <span class="text-red-600">*</span></label>
                    <select id="status" name="status"
                        class="w-full text-sm px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn trạng thái</option>
                        <option value="Đang Làm" {{ old('status') == 'Đang Làm' ? 'selected' : '' }}>Đang Làm</option>
                        <option value="Thử Việc" {{ old('status') == 'Thử Việc' ? 'selected' : '' }}>Thử Việc</option>
                        <option value="Tạm Vắng" {{ old('status') == 'Tạm Vắng' ? 'selected' : '' }}>Tạm Vắng</option>
                        <option value="Ngưng Làm" {{ old('status') == 'Ngưng Làm' ? 'selected' : '' }}>Ngưng Làm</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div id="basic-salary-div" class="transition">
                    <label for="Basic_Salary" class="block text-xs font-medium text-gray-700 mb-1">Lương Cơ Bản</label>
                    <input type="number" id="Basic_Salary" name="Basic_Salary" value="{{ old('Basic_Salary') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div id="hourly-wage-div" class="transition">
                    <label for="hourly_wage" class="block text-xs font-medium text-gray-700 mb-1">Lương Theo Giờ</label>
                    <input type="number" id="hourly_wage" name="hourly_wage" value="{{ old('hourly_wage') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>



        <!-- Sidebar -->
        <div class="w-64 ml-3 space-y-3">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
                <div class="flex flex-col space-y-2">
                    <button type="submit"
                        class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Thêm
                    </button>
                    <a href="{{ route('admin.staff') }}">
                        <button type="button"
                            class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                            <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                        </button>
                    </a>
                </div>
            </div>

            <!-- Avatar -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <label class="block text-xs font-medium text-gray-700 mb-2">Hình Ảnh Cá Nhân</label>
                <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                    <div class="text-center">
                        {{-- Ảnh preview --}}
                        <img id="preview-img" src="#" alt="Ảnh xem trước"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden">

                        <input type="file" class="hidden" id="avatar" name="avatar" accept="image/*"
                            onchange="previewImage(event)">
                        <button type="button"
                            class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                            onclick="document.getElementById('avatar').click()">
                            Chọn tệp
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bank -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <h3 class="text-xs font-medium text-gray-700 mb-3">Thông Tin Chuyển Khoản</h3>
                <div class="mb-3">
                    <label for="STK" class="block text-xs font-medium text-gray-700 mb-1">Số Tài Khoản</label>
                    <input type="number" id="STK" name="STK" value="{{ old('STK') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-3">
                    <label for="bank" class="block text-xs font-medium text-gray-700 mb-1">Ngân Hàng</label>
                    <input type="text" id="bank" name="bank" value="{{ old('bank') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
    </form>

    <script>
        function toggleSalaryFields() {
            const type = document.getElementById('type').value;
            const basicSalary = document.getElementById('Basic_Salary');
            const hourlyWage = document.getElementById('hourly_wage');
            const basicSalaryDiv = basicSalary.closest('div');
            const hourlyWageDiv = hourlyWage.closest('div');
            if (type === 'Full Time') {
                basicSalary.disabled = false;
                basicSalaryDiv.classList.remove('opacity-50');
                hourlyWage.disabled = true;
                hourlyWageDiv.classList.add('opacity-50');
            } else if (type === 'Part Time') {
                basicSalary.disabled = true;
                basicSalaryDiv.classList.add('opacity-50');
                hourlyWage.disabled = false;
                hourlyWageDiv.classList.remove('opacity-50');
            } else {
                // Chưa chọn loại nhân viên
                basicSalary.disabled = true;
                hourlyWage.disabled = true;
                basicSalaryDiv.classList.add('opacity-50');
                hourlyWageDiv.classList.add('opacity-50');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('type').addEventListener('change', toggleSalaryFields);
            toggleSalaryFields(); // Đảm bảo đúng trạng thái khi load lại form (ví dụ khi validate lỗi)
        });
    </script>

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