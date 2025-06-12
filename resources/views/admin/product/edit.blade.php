@extends('admin.index')
@section('content')
    <form action="{{ route('admin.product.update', $food->id) }}" method="POST" enctype="multipart/form-data"
        class="flex w-full">
        @csrf

        {{-- Phần chính --}}
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Sửa Món Ăn</h1>

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

            {{-- Hiển thị popup error/ success --}}
            @if (session('error'))
                <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">
                    {!! session('error') !!}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tên Món & Chọn Menu --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Tên món --}}
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-700 mb-1">
                        Tên Món Ăn <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $food->name) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Dropdown Menu --}}
                <div>
                    <label for="type" class="block text-xs font-medium text-gray-700 mb-1">
                        Chọn Menu <span class="text-red-600">*</span>
                    </label>
                    <select id="type" name="type"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}" {{ old('type', $food->type) == $menu->id ? 'selected' : '' }}>
                                {{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Giá Tiền & Trạng Thái --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Giá tiền --}}
                <div>
                    <label for="price" class="block text-xs font-medium text-gray-700 mb-1">
                        Giá Tiền <span class="text-red-600">*</span>
                    </label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $food->price) }}"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Trạng thái --}}
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">
                        Trạng Thái <span class="text-red-600">*</span>
                    </label>
                    <select id="status" name="status"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Trạng Thái</option>
                        <option value="Còn Hàng" {{ old('status', $food->status) == 'Còn Hàng' ? 'selected' : '' }}>
                            Còn Hàng
                        </option>
                        <option value="Hết Hàng" {{ old('status', $food->status) == 'Hết Hàng' ? 'selected' : '' }}>
                            Hết Hàng
                        </option>
                        <option value="Ngừng Kinh Doanh" {{ old('status', $food->status) == 'Ngừng Kinh Doanh' ? 'selected' : '' }}>
                            Ngừng Kinh Doanh
                        </option>
                    </select>
                </div>
            </div>

            {{-- Mô tả & Ghi chú (CKEditor) --}}
            <div class="grid grid-cols-1 gap-6 mb-6">
                {{-- Mô tả --}}
                <div>
                    <label for="description" class="block text-xs font-medium text-gray-700 mb-1">
                        Mô Tả
                    </label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $food->description) }}</textarea>
                </div>

                {{-- Ghi chú --}}
                <div>
                    <label for="note" class="block text-xs font-medium text-gray-700 mb-1">
                        Ghi Chú
                    </label>
                    <textarea id="note" name="note" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('note', $food->note) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Sidebar: Ảnh, preview và Nút Lưu/Hủy --}}
        <div class="w-64 ml-3 space-y-3">
            {{-- Nút Lưu/Hủy --}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
                <div class="flex flex-col space-y-2">
                    <button type="submit"
                        class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu
                    </button>
                    <a href="{{ route('admin.product') }}">
                        <button type="button"
                            class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
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
                        {{-- Ảnh cũ (nếu có) --}}
                        @if ($food->image)
                            <div class="mb-2 flex justify-center">
                                <img src="{{ asset('img/' . $food->image) }}" alt="Ảnh hiện tại"
                                    class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif

                        {{-- Ảnh preview khi user chọn file mới --}}
                        <img id="preview-img" src="#" alt="Ảnh xem trước"
                            class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden">

                        <input type="file" class="hidden" id="image" name="image" accept="image/*"
                            onchange="previewImage(event)">
                        <button type="button"
                            class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                            onclick="document.getElementById('image').click()">
                            Chọn Tệp
                        </button>
                    </div>
                </div>
            </div>

            {{-- Ảnh Món Ăn Chi Tiết--}}
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-4">
                <h3 class="text-xs font-medium text-gray-700 mb-2">Hình Chi Tiết</h3>

                <div id="detail-images-container" class="flex flex-wrap gap-4">
                    {{-- 1) Các ảnh cũ --}}
                    @foreach($images as $img)
                        <div id="detail-img-wrapper-{{ $img->id }}" class="relative w-24 h-24">
                            <img src="{{ asset('img/details/food/' . $img->img) }}" class="w-24 h-24 object-cover rounded"
                                onclick="document.getElementById('replace-{{ $img->id }}').click()">
                            <button type="button"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"
                                onclick="deleteDetailImage({{ $img->id }})">&times;</button>
                            <input type="checkbox" name="delete_images[]" value="{{ $img->id }}" id="delete-{{ $img->id }}"
                                class="hidden">
                            <input type="file" name="replace_images[{{ $img->id }}]" id="replace-{{ $img->id }}"
                                accept="image/*" class="hidden" onchange="previewReplaceImage(event, {{ $img->id }})">
                        </div>
                    @endforeach
                    {{-- 2) Các ảnh mới sẽ được JS append vào đây --}}
                </div>

                <button type="button" id="add-detail-image"
                    class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    + Thêm hình chi tiết
                </button>
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
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        // Xóa ảnh cũ: đánh dấu checkbox & remove DOM
        function deleteDetailImage(id) {
            document.getElementById('delete-' + id).checked = true;
            document.getElementById('detail-img-wrapper-' + id).style.display = 'none';
        }

        // Preview khi replace
        function previewReplaceImage(e, id) {
            const reader = new FileReader();
            reader.onload = ev => {
                document
                    .querySelector('#detail-img-wrapper-' + id + ' img')
                    .src = ev.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // Thêm mới ảnh detail
        let detailImageIndex = 0;
        document.getElementById('add-detail-image')
            .addEventListener('click', () => {
                const container = document.getElementById('detail-images-container');
                const idx = 'new-' + (detailImageIndex++);

                // Tạo wrapper
                const wrapper = document.createElement('div');
                wrapper.id = 'detail-img-wrapper-' + idx;
                wrapper.className = 'relative w-24 h-24';

                // Input file (ẩn)
                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'detail_images[]';
                input.accept = 'image/*';
                input.className = 'hidden';
                input.onchange = e => {
                    const reader = new FileReader();
                    reader.onload = ev => {
                        img.src = ev.target.result;
                        img.classList.remove('hidden');
                    };
                    reader.readAsDataURL(e.target.files[0]);
                };

                // Img preview
                const img = document.createElement('img');
                img.src = '#';
                img.alt = 'Preview';
                img.className = 'w-24 h-24 object-cover rounded hidden';
                img.onclick = () => input.click();

                // Nút xóa wrapper mới
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '&times;';
                btn.className = 'absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs';
                btn.onclick = () => wrapper.remove();

                wrapper.append(input, img, btn);
                container.append(wrapper);
                input.click();
            });
    </script>


    {{-- Popup thông báo --}}
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            CKEDITOR.replace('description');
            CKEDITOR.replace('note');
        });
    </script>
@endsection