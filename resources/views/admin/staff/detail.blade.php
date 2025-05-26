@extends('admin.index')
@section('content')
    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data"
        class="flex w-full">
        @csrf
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thông Tin Nhân Viên</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="fullname" class="block text-xs font-medium text-gray-700 mb-1">Họ Và Tên</label>
                    <input type="text" id="fullname" name="fullname" value="{{ $staff->fullname }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="code_nv" class="block text-xs font-medium text-gray-700 mb-1">Mã Nhân Viên</label>
                    <input type="text" id="code_nv" name="code_nv" value="{{ $staff->code_nv }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="date_of_birth" class="block text-xs font-medium text-gray-700 mb-1">Ngày Sinh</label>
                    <input type="text" id="date_of_birth" name="date_of_birth" value="{{ $staff->date_of_birth }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Giới Tính</label>
                    <select id="gender" name="gender"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Giới Tính</option>
                        <option value="Nam" {{ $staff->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $staff->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ $staff->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="SDT" class="block text-xs font-medium text-gray-700 mb-1">Số Điện Thoại</label>
                    <input type="text" id="SDT" name="SDT" value="{{ $staff->SDT }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="CCCD" class="block text-xs font-medium text-gray-700 mb-1">CCCD</label>
                    <input type="text" id="CCCD" name="CCCD" value="{{ $staff->CCCD }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="address" class="block text-xs font-medium text-gray-700 mb-1">Địa Chỉ</label>
                    <input type="text" id="address" name="address" value="{{ $staff->address }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" id="email" name="email" value="{{ $staff->email }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="time_work" class="block text-xs font-medium text-gray-700 mb-1">Ngày Vào Làm</label>
                    <input type="text" id="time_work" name="time_work" value="{{ $staff->time_work }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="branch" class="block text-xs font-medium text-gray-700 mb-1">Đơn Vị</label>
                    <select id="branch" name="branch"
                        class="w-full px-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Đơn Vị</option>
                        <option value="kho1" {{ $staff->branch == 'kho1' ? 'selected' : '' }}>Hà Nội</option>
                        <option value="kho2" {{ $staff->branch == 'kho2' ? 'selected' : '' }}>Hồ Chí Minh</option>
                        <option value="kho3" {{ $staff->branch == 'kho3' ? 'selected' : '' }}>Đà Nẵng</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="type" class="block text-xs font-medium text-gray-700 mb-1">Loại Nhân Viên</label>
                    <select id="type" name="type"
                        class="w-full px-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Loại Nhân Viên</option>
                        <option value="Full Time" {{ $staff->type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part Time" {{ $staff->type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Trạng Thái</label>
                    <select id="status" name="status"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn trạng thái</option>
                        <option value="Đang Làm" {{ $staff->status == 'Đang Làm' ? 'selected' : '' }}>Đang Làm</option>
                        <option value="Thử Việc" {{ $staff->status == 'Thử Việc' ? 'selected' : '' }}>Thử Việc</option>
                        <option value="Tạm Vắng" {{ $staff->status == 'Tạm Vắng' ? 'selected' : '' }}>Tạm Vắng</option>
                        <option value="Ngưng Làm" {{ $staff->status == 'Ngưng Làm' ? 'selected' : '' }}>Ngưng Làm</option>
                    </select>
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
                        @if ($staff->avata)
                            <div class="mb-2 flex justify-center">
                                <img src="{{ asset('img/' . $staff->avata) }}" alt="Avatar"
                                    class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif
                        <input type="file" class="hidden" id="avatar" name="avatar" accept="image/*">
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
                    <input type="text" id="STK" name="STK" value="{{ $staff->STK }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="bank" class="block text-xs font-medium text-gray-700 mb-1">Ngân Hàng</label>
                    <input type="text" id="bank" name="bank" value="{{ $staff->bank }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
    </form>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
@endsection