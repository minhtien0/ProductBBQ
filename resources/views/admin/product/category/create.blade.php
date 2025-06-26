@extends('admin.index')
@section('content')
<form action="{{ route('admin.menu.add') }}" method="POST" class="flex w-full">
    @csrf
     {{-- Show lỗi validate --}}
    <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
    <h1 class="text-lg font-bold text-gray-800 mb-6">Thêm Menu Mới</h1>

    <div class="mb-4">
        <label for="name" class="block text-xs font-medium text-gray-700 mb-1">
            Tên Menu <span class="text-red-600">*</span>
        </label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <div class="mb-4">
        <label for="notes" class="block text-xs font-medium text-gray-700 mb-1">
            Note <span class="text-red-600">*</span>
        </label>
        <textarea name="notes" id="notes"
            class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
            rows="4">{{ old('notes') }}</textarea>
    </div>
    </div>


    <!-- Sidebar -->
    <div class="w-64 ml-3 space-y-3">
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <div class="flex flex-col space-y-2">
                <button type="submit"
                    class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                    <i class="fa-solid fa-plus mr-2"></i> Thêm Menu
                </button>
                <a href="{{ route('admin.product.category.index') }}">
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
