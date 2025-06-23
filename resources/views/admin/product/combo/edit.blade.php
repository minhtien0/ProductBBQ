@extends('admin.index')
@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <nav class="flex items-center text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.product.combo.index') }}" class="hover:text-blue-600">Combo Món Ăn</a>
                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-800">Chỉnh sửa</span>
            </nav>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Chỉnh sửa Combo</h1>
                    <p class="text-gray-600 mt-1">Cập nhật thông tin combo món ăn</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.product.combo.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Quay lại
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.food_combo.update', $combo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Thông tin cơ bản -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-info-circle text-blue-600 mr-2"></i>
                                Thông tin cơ bản
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="codecombo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mã Combo <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="codecombo" name="codecombo" 
                                               value="{{ old('codecombo', $combo->codecombo) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fa-solid fa-barcode text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('codecombo')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tên Combo <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="name" name="name" 
                                               value="{{ old('name', $combo->name) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fa-solid fa-utensils text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                    Giá Combo <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="price" name="price" min="0" step="0.01" 
                                           value="{{ old('price', $combo->price) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 font-medium">VNĐ</span>
                                    </div>
                                </div>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Chọn món ăn -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-50 to-amber-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-utensils text-orange-600 mr-2"></i>
                                Chọn Món Ăn
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="foods" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tìm kiếm và chọn món ăn <span class="text-red-500">*</span>
                                </label>
                                <select id="foods-select2" class="w-full" style="width:100%;"></select>
                                <input type="hidden" name="foods" id="foods-hidden">
                                @error('foods')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- Danh sách món đã chọn -->
                            <div class="mt-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-3">Món ăn đã chọn:</h3>
                                <div id="selected-foods" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Ghi chú -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-sticky-note text-green-600 mr-2"></i>
                                Ghi chú
                            </h2>
                        </div>
                        <div class="p-6">
                            <textarea id="note" name="note" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                      placeholder="Nhập ghi chú cho combo...">{{ old('note', $combo->note) }}</textarea>
                            @error('note')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Thao tác -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-cog text-purple-600 mr-2"></i>
                                Thao tác
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center">
                                    <i class="fa-solid fa-save mr-2"></i>
                                    Cập nhật Combo
                                </button>
                                
                                <a href="{{ route('admin.product.combo.index') }}" 
                                   class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center border border-gray-300">
                                    <i class="fa-solid fa-times mr-2"></i>
                                    Hủy bỏ
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-image text-indigo-600 mr-2"></i>
                                Hình ảnh Combo
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <div class="relative inline-block">
                                    <img id="preview-img"
                                         src="{{ $combo->image ? asset('img/combo/'.$combo->image) : '/api/placeholder/200/200' }}"
                                         alt="Ảnh combo"
                                         class="w-32 h-32 rounded-xl object-cover border-4 border-gray-200 shadow-lg {{ $combo->image ? '' : 'opacity-50' }}">
                                    <div class="absolute -bottom-2 -right-2 bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg">
                                        <i class="fa-solid fa-camera text-sm"></i>
                                    </div>
                                </div>
                                
                                <input type="file" class="hidden" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                
                                <div class="mt-4 space-y-2">
                                    <button type="button"
                                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02]"
                                            onclick="document.getElementById('image').click()">
                                        <i class="fa-solid fa-upload mr-2"></i>
                                        Chọn ảnh mới
                                    </button>
                                    
                                    @if($combo->image)
                                        <p class="text-xs text-gray-500">Giữ trống nếu không muốn thay đổi ảnh</p>
                                    @endif
                                </div>
                            </div>
                            
                            @error('image')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fa-solid fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Thông tin tổng quan -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fa-solid fa-chart-line text-emerald-600 mr-2"></i>
                                Thống kê
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Tổng món ăn:</span>
                                    <span id="total-foods" class="font-semibold text-blue-600">0</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Giá gốc:</span>
                                    <span id="original-price" class="font-semibold text-gray-700">0đ</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Tiết kiệm:</span>
                                    <span id="savings" class="font-semibold text-green-600">0đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- CSS & JS Libraries -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Custom Select2 Styles */
    .select2-container--default .select2-selection--single {
        height: 48px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        padding: 8px 12px !important;
        display: flex !important;
        align-items: center !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px !important;
        right: 8px !important;
    }
    
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
    
    .select2-dropdown {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }
    
    .select2-results__option {
        padding: 12px !important;
    }
    
    .select2-results__option--highlighted {
        background-color: #3b82f6 !important;
    }
</style>

<script>
    $(document).ready(function() {
        if (document.getElementById('note')) {
            CKEDITOR.replace('note', {
                height: 180,
                removePlugins: 'elementspath',
                resize_enabled: false,
                toolbar: [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ] },
                    { name: 'links', items: [ 'Link', 'Unlink' ] },
                    { name: 'insert', items: [ 'Image', 'Table' ] },
                    { name: 'styles', items: [ 'Format' ] },
                    { name: 'tools', items: [ 'Maximize' ] }
                ]
            });
        }
    });
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('opacity-50');
            }
            reader.readAsDataURL(input.files[0]);
        }
        
        
    }

    $(document).ready(function() {
        let selectedFoods = [];
        
        // Khởi tạo dữ liệu cũ
        @php
            $old_foods = old('foods') ? explode(',', old('foods')) : $combo->foods->pluck('id')->toArray();
            $foodModels = \App\Models\Food::whereIn('id', $old_foods)->get();
        @endphp

        selectedFoods = [
            @foreach($foodModels as $food)
                {id: '{{ $food->id }}', name: '{{ $food->name }}', price: {{ $food->price }} },
            @endforeach
        ];

        // Khởi tạo Select2
        $('#foods-select2').select2({
            placeholder: "🔍 Tìm kiếm món ăn...",
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('admin.food.search') }}",
                dataType: 'json',
                delay: 300,
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
            
            return $(`
                <div class="flex items-center justify-between py-1">
                    <div>
                        <div class="font-semibold text-gray-800">${option.food_name}</div>
                    </div>
                    <div class="text-blue-600 font-bold">${Number(option.food_price).toLocaleString()}đ</div>
                </div>
            `);
        }

        // Khi chọn món
        $('#foods-select2').on('select2:select', function(e) {
            const data = e.params.data;
            if (!selectedFoods.some(f => f.id == data.id)) {
                selectedFoods.push({ 
                    id: data.id, 
                    name: data.food_name, 
                    price: parseFloat(data.food_price) 
                });
                updateSelectedFoods();
            }
            $('#foods-select2').val(null).trigger('change');
        });

        function updateSelectedFoods() {
            const container = $('#selected-foods');
            container.html('');
            
            if (selectedFoods.length === 0) {
                container.html(`
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-utensils text-4xl mb-4 opacity-50"></i>
                        <p>Chưa có món ăn nào được chọn</p>
                    </div>
                `);
            } else {
                selectedFoods.forEach((food, index) => {
                    container.append(`
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-orange-50 to-amber-50 border border-orange-200 rounded-lg hover:shadow-md transition-all duration-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    ${index + 1}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">${food.name}</h4>
                                    <p class="text-sm text-orange-600 font-medium">${Number(food.price).toLocaleString()}đ</p>
                                </div>
                            </div>
                            <button type="button" class="remove-food w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors duration-200" data-id="${food.id}">
                                <i class="fa-solid fa-times text-sm"></i>
                            </button>
                        </div>
                    `);
                });
            }
            
            $('#foods-hidden').val(selectedFoods.map(f => f.id).join(','));
            updateStatistics();
        }

        function updateStatistics() {
            const totalFoods = selectedFoods.length;
            const originalPrice = selectedFoods.reduce((sum, food) => sum + food.price, 0);
            const comboPrice = parseFloat($('#price').val()) || 0;
            const savings = originalPrice - comboPrice;

            $('#total-foods').text(totalFoods);
            $('#original-price').text(Number(originalPrice).toLocaleString() + 'đ');
            $('#savings').text(Number(Math.max(0, savings)).toLocaleString() + 'đ');
            
            if (savings > 0) {
                $('#savings').removeClass('text-red-600').addClass('text-green-600');
            } else {
                $('#savings').removeClass('text-green-600').addClass('text-red-600');
            }
        }

        // Xóa món ăn
        $('#selected-foods').on('click', '.remove-food', function() {
            const id = $(this).data('id');
            selectedFoods = selectedFoods.filter(f => f.id != id);
            updateSelectedFoods();
        });

        // Cập nhật thống kê khi thay đổi giá
        $('#price').on('input', function() {
            updateStatistics();
        });

        // Khởi tạo lần đầu
        updateSelectedFoods();
    });
    
</script>

@endsection