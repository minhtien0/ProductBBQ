@extends('admin.index')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Thêm Combo Món Ăn</h1>
                <p class="text-sm text-gray-600 mt-1">Tạo combo mới từ các món ăn có sẵn</p>
            </div>
            <nav class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.product.combo.index') }}" class="hover:text-gray-700">Combo</a>
                <span>/</span>
                <span class="text-gray-900">Thêm mới</span>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.product.food_combo.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
            {{-- Main Content --}}
            <div class="xl:col-span-3 space-y-6">
                {{-- Thông tin cơ bản --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Thông tin cơ bản
                        </h2>
                    </div>
                    <div class="px-6 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="codecombo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mã Combo <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="codecombo" name="codecombo" value="{{ old('codecombo') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nhập mã combo...">
                                @error('codecombo')
                                    <div class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tên Combo <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Nhập tên combo...">
                                @error('name')
                                    <div class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Giá Combo <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="price" name="price" min="0" step="1000" value="{{ old('price') }}"
                                    class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="0">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 text-sm">VNĐ</span>
                                </div>
                            </div>
                            @error('price')
                                <div class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="note" class="block text-sm font-medium text-gray-700 mb-2">Ghi chú</label>
                            <textarea id="note" name="note" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Mô tả thêm về combo...">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Chọn món ăn --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                            Cấu hình món ăn
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Chọn các món ăn để tạo thành combo</p>
                    </div>
                    <div class="px-6 py-6">
                        <div class="mb-4">
                            <label for="foods" class="block text-sm font-medium text-gray-700 mb-2">
                                Tìm và chọn món ăn <span class="text-red-500">*</span>
                            </label>
                            <select id="foods-select2" class="w-full"></select>
                            <input type="hidden" name="foods" id="foods-hidden">
                            @error('foods')
                                <div class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Danh sách món đã chọn --}}
                        <div id="selected-foods-container" class="hidden">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">Món ăn đã chọn:</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div id="selected-foods" class="grid grid-cols-1 md:grid-cols-2 gap-3"></div>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="font-medium text-gray-700">Tổng giá trị món ăn:</span>
                                        <span id="total-food-price" class="font-bold text-green-600">0đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="xl:col-span-1 space-y-6">
                {{-- Hình ảnh --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Hình ảnh combo</h3>
                    </div>
                    <div class="px-6 py-6">
                        <div class="flex flex-col items-center">
                            <div class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors duration-200 cursor-pointer" onclick="document.getElementById('image').click()">
                                <div class="text-center" id="upload-placeholder">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="text-sm text-gray-500">Nhấp để chọn hình ảnh</p>
                                </div>
                                <img id="preview-img" src="#" alt="Ảnh xem trước" class="w-full h-full object-cover rounded-lg hidden">
                            </div>
                            <input type="file" class="hidden" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        </div>
                        @error('image')
                            <div class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Thao tác --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Thao tác</h3>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Thêm combo
                        </button>
                        <a href="{{ route('admin.product.combo.index') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Hủy bỏ
                        </a>
                    </div>
                </div>

                {{-- Thông tin bổ sung --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0118 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Lưu ý khi tạo combo</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Mã combo phải duy nhất</li>
                                    <li>Chọn ít nhất 2 món ăn</li>
                                    <li>Giá combo nên thấp hơn tổng giá các món</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Select2, jQuery -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
.select2-container--default .select2-selection--single {
    height: 42px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 40px !important;
    padding-left: 12px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
}
.select2-dropdown {
    border-radius: 0.5rem !important;
    border: 1px solid #d1d5db !important;
}
</style>

<script>
// Xem trước ảnh
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview-img');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    let selectedFoods = [];
    
    // Select2 AJAX
    $('#foods-select2').select2({
        placeholder: "Tìm kiếm món ăn...",
        minimumInputLength: 0,
        ajax: {
            url: "{{ route('admin.food.search') }}",
            dataType: 'json',
            delay: 250,
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
        return $('<div class="flex justify-between items-center"><span class="font-medium">' + option.food_name + '</span> <span class="text-blue-600 font-semibold">' + Number(option.food_price).toLocaleString() + 'đ</span></div>');
    }

    // Chọn food
    $('#foods-select2').on('select2:select', function(e) {
        const data = e.params.data;
        if (!selectedFoods.some(f => f.id == data.id)) {
            selectedFoods.push({ id: data.id, name: data.food_name, price: data.food_price });
            updateSelectedFoods();
        }
        $('#foods-select2').val(null).trigger('change');
    });

    // Hiện danh sách món ăn đã chọn
    function updateSelectedFoods() {
        const container = $('#selected-foods');
        const totalContainer = $('#selected-foods-container');
        
        if (selectedFoods.length === 0) {
            totalContainer.addClass('hidden');
            return;
        }
        
        totalContainer.removeClass('hidden');
        container.html('');
        
        let totalPrice = 0;
        selectedFoods.forEach(food => {
            totalPrice += parseInt(food.price);
            container.append(`
                <div class="bg-white rounded-lg border border-gray-200 p-3 flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">${food.name}</h4>
                        <p class="text-sm text-gray-500">${Number(food.price).toLocaleString()}đ</p>
                    </div>
                    <button type="button" class="remove-food ml-2 text-red-500 hover:text-red-700 p-1" data-id="${food.id}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            `);
        });
        
        $('#total-food-price').text(Number(totalPrice).toLocaleString() + 'đ');
        $('#foods-hidden').val(selectedFoods.map(f => f.id).join(','));
    }

    // Xoá món đã chọn
    $('#selected-foods').on('click', '.remove-food', function() {
        const id = $(this).data('id');
        selectedFoods = selectedFoods.filter(f => f.id != id);
        updateSelectedFoods();
    });

    // Giữ lại món đã chọn nếu submit lỗi
    @if(old('foods'))
        selectedFoods = [
            @foreach(\App\Models\Food::whereIn('id', explode(',', old('foods')))->get() as $food)
                {id: '{{ $food->id }}', name: '{{ $food->name }}', price: '{{ $food->price }}' },
            @endforeach
        ];
        updateSelectedFoods();
    @endif
});
</script>
@endsection