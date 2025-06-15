@extends('admin.index')
@section('content')
<form action="{{ route('admin.food_combo.update', $combo->id) }}" method="POST" enctype="multipart/form-data" class="flex w-full">
    @csrf
    @method('PUT')

    <!-- MAIN -->
    <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6">
        <h1 class="text-lg font-bold text-gray-800 mb-6">Sửa Combo Món Ăn</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="codecombo" class="block text-xs font-medium text-gray-700 mb-1">Mã Combo <span class="text-red-600">*</span></label>
                <input type="text" id="codecombo" name="codecombo" value="{{ old('codecombo', $combo->codecombo) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('codecombo')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="name" class="block text-xs font-medium text-gray-700 mb-1">Tên Combo <span class="text-red-600">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $combo->name) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="price" class="block text-xs font-medium text-gray-700 mb-1">Giá Combo <span class="text-red-600">*</span></label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="{{ old('price', $combo->price) }}"
                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('price')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="foods" class="block text-xs font-medium text-gray-700 mb-1">Chọn Món Ăn <span class="text-red-600">*</span></label>
                <select id="foods-select2" class="w-full" style="width:100%;"></select>
                <input type="hidden" name="foods" id="foods-hidden">
                <div id="selected-foods" class="flex flex-wrap gap-2 mt-2"></div>
                @error('foods')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-6">
            <label for="note" class="block text-xs font-medium text-gray-700 mb-1">Ghi chú</label>
            <textarea id="note" name="note" class="w-full px-3 py-2 border border-gray-300 rounded-md">{{ old('note', $combo->note) }}</textarea>
            @error('note')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- SIDEBAR phải -->
    <div class="w-64 ml-3 space-y-3 flex flex-col">

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
          <!-- Nút lưu & hủy -->
            <div class="flex flex-col space-y-2">
                <button type="submit"
                    class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Cập nhật
                </button>
                <a href="{{ route('admin.product.combo.index') }}">
                    <button type="button"
                        class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                        <i class="fa-regular fa-rectangle-xmark mr-2"></i>Hủy
                    </button>
                </a>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
            <label class="block text-xs font-medium text-gray-700 mb-2">Hình Ảnh Combo</label>
            <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                <div class="text-center">
                    <img id="preview-img"
                         src="{{ $combo->image ? asset('img/combo/'.$combo->image) : '#' }}"
                         alt="Ảnh xem trước"
                         class="w-24 h-24 rounded-full object-cover mx-auto mb-2 {{ $combo->image ? '' : 'hidden' }}">
                    <input type="file" class="hidden" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <button type="button"
                        class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200"
                        onclick="document.getElementById('image').click()">
                        Chọn tệp
                    </button>
                    @if($combo->image)
                        <div class="text-xs text-gray-400 mt-1">Giữ trống nếu không đổi ảnh</div>
                    @endif
                </div>
            </div>
            @error('image')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
$(document).ready(function() {
    let selectedFoods = [];
    // Nếu có dữ liệu cũ (submit lỗi) thì lấy old, ngược lại lấy từ $combo->foods
    @php
        $old_foods = old('foods') ? explode(',', old('foods')) : $combo->foods->pluck('id')->toArray();
        $foodModels = \App\Models\Food::whereIn('id', $old_foods)->get();
    @endphp

    selectedFoods = [
        @foreach($foodModels as $food)
            {id: '{{ $food->id }}', name: '{{ $food->name }}', price: '{{ $food->price }}' },
        @endforeach
    ];

    $('#foods-select2').select2({
        placeholder: "Tìm và chọn món ăn...",
        minimumInputLength: 0,
        ajax: {
            url: "{{ route('admin.food.search') }}",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    q: params.term || '',
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items.map(item => ({
                        id: item.id,
                        text: item.name + ' - ' + Number(item.price).toLocaleString() + 'đ',
                        food_name: item.name,
                        food_price: item.price
                    })),
                    pagination: {
                        more: data.more
                    }
                };
            },
            cache: true
        },
        templateResult: formatFoodOption,
        templateSelection: function (option) {
            return option.text || option.id;
        }
    });

    function formatFoodOption(option) {
        if (!option.id) return option.text;
        return $('<div><span class="font-bold">' + option.food_name + '</span> <span class="text-gray-400 ml-2">' + Number(option.food_price).toLocaleString() + 'đ</span></div>');
    }

    // Khi chọn món
    $('#foods-select2').on('select2:select', function(e) {
        const data = e.params.data;
        if (!selectedFoods.some(f => f.id == data.id)) {
            selectedFoods.push({ id: data.id, name: data.food_name, price: data.food_price });
            updateSelectedFoods();
        }
        $('#foods-select2').val(null).trigger('change');
    });

    function updateSelectedFoods() {
        const container = $('#selected-foods');
        container.html('');
        selectedFoods.forEach(food => {
            container.append(
                `<div class="px-2 py-1 bg-orange-100 text-orange-700 rounded flex items-center gap-1 mb-1">
                    <span class="font-bold">${food.name}</span>
                    <span class="ml-1 text-gray-500">(${Number(food.price).toLocaleString()}đ)</span>
                    <button type="button" class="remove-food ml-2 text-red-600 font-bold" data-id="${food.id}">&times;</button>
                </div>`
            );
        });
        $('#foods-hidden').val(selectedFoods.map(f => f.id).join(','));
    }

    $('#selected-foods').on('click', '.remove-food', function() {
        const id = $(this).data('id');
        selectedFoods = selectedFoods.filter(f => f.id != id);
        updateSelectedFoods();
    });

    // Khởi tạo lần đầu (show lại món ăn cũ)
    updateSelectedFoods();
});
</script>
@endsection
