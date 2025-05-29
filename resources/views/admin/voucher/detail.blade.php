@extends('admin.index')
@section('content')
<form action="{{ route('admin.voucher.update', $voucher->id) }}" method="POST" class="flex w-full">
    @csrf
    {{-- Show lỗi validate --}}
    <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
        <h1 class="text-lg font-bold text-gray-800 mb-6">Sửa Voucher</h1>

        {{-- Hiển thị lỗi nếu có --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="code" class="block text-xs font-medium text-gray-700 mb-1">Mã Voucher <span class="text-red-600">*</span></label>
                <input type="text" id="code" name="code"
                    value="{{ old('code', $voucher->code) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="value" class="block text-xs font-medium text-gray-700 mb-1">Giá Trị (%) <span class="text-red-600">*</span></label>
                <input type="number" step="0.01" id="value" name="value"
                    value="{{ old('value', $voucher->value) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="time_start" class="block text-xs font-medium text-gray-700 mb-1">Thời Gian Bắt Đầu <span class="text-red-600">*</span></label>
                <input type="datetime-local" id="time_start" name="time_start"
                    value="{{ old('time_start', \Carbon\Carbon::parse($voucher->time_start)->format('Y-m-d\TH:i')) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="time_end" class="block text-xs font-medium text-gray-700 mb-1">Thời Gian Kết Thúc <span class="text-red-600">*</span></label>
                <input type="datetime-local" id="time_end" name="time_end"
                    value="{{ old('time_end', \Carbon\Carbon::parse($voucher->time_end)->format('Y-m-d\TH:i')) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="quantity" class="block text-xs font-medium text-gray-700 mb-1">Số Lượng <span class="text-red-600">*</span></label>
                <input type="number" id="quantity" name="quantity"
                    value="{{ old('quantity', $voucher->quantity) }}"
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
                    <i class="fa-solid fa-pen-to-square mr-2"></i> Cập Nhật
                </button>
                <a href="{{ route('admin.voucher') }}">
                    <button type="button"
                        class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                    </button>
                </a>
            </div>
        </div>
    </div>
</form>

<x-notification-popup />
<script src="{{ asset('js/notification.js') }}"></script>
@endsection
