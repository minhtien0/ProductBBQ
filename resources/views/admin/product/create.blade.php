@extends('admin.index')
@section('content')
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="flex w-full">
        @csrf

        {{-- Phần chính --}}
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thêm Món Ăn Mới</h1>

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

            {{-- Tên Món & Loại --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-700 mb-1">
                        Tên Món Ăn <span class="text-red-600">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div>
                    <label for="type" class="block text-xs font-medium text-gray-700 mb-1">
                        Chọn Menu <span class="text-red-600">*</span>
                    </label>
                    <select
                        id="type"
                        name="type"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Chọn Menu</option>
                        @foreach ($menus as $menu)
                            <option
                                value="{{ $menu->id }}"
                                {{ old('type') == $menu->id ? 'selected' : '' }}
                            >
                                {{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
            </div>

             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-xs font-medium text-gray-700 mb-1">
                        Giá Tiền <span class="text-red-600">*</span>
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
            </div>

            {{-- Mô tả & Ghi chú (với CKEditor) --}}
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <label for="description" class="block text-xs font-medium text-gray-700 mb-1">
                        Mô Tả
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="note" class="block text-xs font-medium text-gray-700 mb-1">
                        Ghi Chú
                    </label>
                    <textarea
                        id="note"
                        name="note"
                        rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('note') }}</textarea>
                </div>
            </div>
            
        </div>

        {{-- Sidebar: Ảnh & Nút Thêm/Hủy --}}
        <div class="w-64 ml-3 space-y-3">
            {{-- Nút Thêm/Hủy --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
                <div class="flex flex-col space-y-2">
                    <button
                        type="submit"
                        class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center"
                    >
                        <i class="fa-solid fa-plus mr-2"></i> Thêm Món Ăn
                    </button>
                    <a href="{{ route('admin.product') }}">
                        <button
                            type="button"
                            class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200"
                        >
                            <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                        </button>
                    </a>
                </div>
            </div>

            {{-- Ảnh Món Ăn --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                <label class="block text-xs font-medium text-gray-700 mb-2">Ảnh Món Ăn</label>
                <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                    <div class="text-center">
                        {{-- Ảnh preview --}}
                        <img
                            id="preview-img"
                            src="#"
                            alt="Ảnh xem trước"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden"
                        >

                        <input
                            type="file"
                            class="hidden"
                            id="image"
                            name="image"
                            accept="image/*"
                            onchange="previewImage(event)"
                        >
                        <button
                            type="button"
                            class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                            onclick="document.getElementById('image').click()"
                        >
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

    <script>
        // Khi DOM đã sẵn sàng, khởi tạo CKEditor cho các textarea
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('description');
            CKEDITOR.replace('note');
        });
    </script>
@endsection
    

