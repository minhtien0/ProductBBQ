@extends('admin.index')
@section('content')
<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="flex w-full">
    @csrf

    <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
        <h1 class="text-lg font-bold text-gray-800 mb-6">Sửa Blog</h1>

        {{-- Hiển thị lỗi validate --}}
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc pl-5 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Thông báo --}}
        @if (session('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded">{!! session('error') !!}</div>
        @endif
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-6">
            <label for="title" class="block text-xs font-medium text-gray-700 mb-1">Tiêu đề <span class="text-red-600">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="type" class="block text-xs font-medium text-gray-700 mb-1">Loại Blog <span class="text-red-600">*</span></label>
            <input type="text" id="type" name="type" value="{{ old('type', $blog->type) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" required>
            {{-- Nếu bạn có bảng loại blog, hãy thay bằng select --}}
        </div>
        <div class="mb-6">
            <label for="content" class="block text-xs font-medium text-gray-700 mb-1">Nội dung <span class="text-red-600">*</span></label>
            <textarea id="content" name="content" rows="10"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">{{ old('content', $blog->content) }}</textarea>
        </div>
    </div>
    <div class="w-64 ml-3 space-y-3">
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <button type="submit"
                class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Lưu
            </button>
            <a href="{{ route('admin.blog') }}">
                <button type="button"
                    class="w-full mt-2 px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                    <i class="fa-regular fa-rectangle-xmark mr-2"></i> Hủy
                </button>
            </a>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <label class="block text-xs font-medium text-gray-700 mb-2">Ảnh Đại Diện</label>
            <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                <div class="text-center">
                    {{-- Ảnh cũ --}}
                    @if ($blog->image)
                        <div class="mb-2 flex justify-center">
                            <img src="{{ asset('img/blog/' . $blog->image) }}" alt="Ảnh hiện tại"
                                class="w-24 h-24 rounded-full object-cover">
                        </div>
                    @endif
                    {{-- Ảnh preview khi chọn mới --}}
                    <img id="preview-img" src="#" alt="Ảnh xem trước"
                        class="w-24 h-24 rounded-full object-cover mx-auto mb-2 hidden">
                    <input type="file" class="hidden" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <button type="button"
                        class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        onclick="document.getElementById('image').click()">Chọn Tệp</button>
                </div>
            </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('content');
    });
</script>
@endsection
