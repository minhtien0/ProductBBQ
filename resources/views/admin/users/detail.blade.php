@extends('admin.index')
@section('content')
    <div class="flex">
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thêm sản phẩm mới</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Product Name -->
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">TÊN SẢN PHẨM</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">MÃ SKU</label>
                    <input type="text" id="sku" name="sku"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Product Description -->
            <div class="mb-6">
                <label for="description" class="block text-xs font-medium text-gray-700 mb-1">MÔ TẢ SẢN PHẨM</label>
                <div class="border border-gray-300 rounded-md">
                    <!-- Toolbar -->
                    <div class="flex flex-wrap items-center gap-1 p-2 border-b border-gray-200 bg-gray-50">
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-bold"></i></button>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-italic"></i></button>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-underline"></i></button>
                        <span class="border-r border-gray-300 h-6 mx-1"></span>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-list"></i></button>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-list-ol"></i></button>
                        <span class="border-r border-gray-300 h-6 mx-1"></span>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-image"></i></button>
                        <button class="p-1 hover:bg-gray-200 rounded"><i class="fa-solid fa-link"></i></button>
                    </div>

                    <!-- Editor Area -->
                    <div class="p-3 min-h-32">
                        <textarea id="description" name="description"
                            class="w-full min-h-24 border-0 focus:ring-0 focus:outline-none"
                            placeholder="Nhập mô tả sản phẩm..."></textarea>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Warehouse -->
                <div>
                    <label for="warehouse" class="block text-xs font-medium text-gray-700 mb-1">KHO HÀNG</label>
                    <select id="warehouse" name="warehouse"
                        class="w-full px-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn kho hàng</option>
                        <option value="kho1">Kho Hà Nội</option>
                        <option value="kho2">Kho Hồ Chí Minh</option>
                        <option value="kho3">Kho Đà Nẵng</option>
                    </select>
                </div>

                <!-- Product Status -->
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">TRẠNG THÁI SẢN PHẨM</label>
                    <select id="status" name="status"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn trạng thái</option>
                        <option value="active">Đang bán</option>
                        <option value="outofstock">Hết hàng</option>
                        <option value="discontinued">Ngừng kinh doanh</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-medium text-gray-700 mb-1">DANH MỤC SẢN PHẨM</label>
                    <select id="category" name="category"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">--- Chọn ---</option>
                        <option value="cat1">Điện thoại</option>
                        <option value="cat2">Máy tính</option>
                        <option value="cat3">Thiết bị điện tử</option>
                    </select>
                </div>

                <!-- Product Type -->
                <div>
                    <label for="productType" class="block text-xs font-medium text-gray-700 mb-1">THẺ SẢN PHẨM</label>
                    <select id="productType" name="productType"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">--- Chọn ---</option>
                        <option value="type1">Sản phẩm mới</option>
                        <option value="type2">Khuyến mãi</option>
                        <option value="type3">Bán chạy</option>
                    </select>
                </div>
            </div>
        </div>
        <!--Phần nút chức năng-->
        <div class="w-64 ml-3 space-y-3">
        <!-- Action buttons -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 mt-3">
            <div class="flex flex-col space-y-2">
                <button type="submit" class="w-full px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all duration-200 flex items-center justify-center">
                    <i class="fa-solid fa-plus mr-1"></i> Thêm sản phẩm
                </button>
                <button type="button" class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                    Hủy
                </button>
            </div>
        </div>
        
        <!-- Product Image -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <label class="block text-xs font-medium text-gray-700 mb-2">HÌNH ẢNH SẢN PHẨM</label>
            <div class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-4">
                <div class="text-center">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                    <p class="text-xs text-gray-500">Kéo thả hoặc nhấp vào đây</p>
                    <p class="text-xs text-gray-400">PNG, JPG, GIF tối đa 10MB</p>
                    <input type="file" class="hidden" id="productImage" name="productImage">
                    <button type="button" class="mt-2 px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-all duration-200" onclick="document.getElementById('productImage').click()">
                        Chọn tệp
                    </button>
                </div>
            </div>
        </div>

        <!-- Pricing -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <h3 class="text-xs font-medium text-gray-700 mb-3">THÔNG TIN GIÁ</h3>
            
            <!-- Product Price -->
            <div class="mb-3">
                <label for="price" class="block text-xs font-medium text-gray-700 mb-1">GIÁ SẢN PHẨM</label>
                <div class="relative">
                    <input type="number" id="price" name="price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-6" placeholder="0">
                    <span class="absolute left-2 top-2.5 text-gray-500">₫</span>
                </div>
            </div>

            <!-- Promo Price -->
            <div>
                <label for="promoPrice" class="block text-xs font-medium text-gray-700 mb-1">GIÁ KHUYẾN MÃI</label>
                <div class="relative">
                    <input type="number" id="promoPrice" name="promoPrice" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-6" placeholder="0">
                    <span class="absolute left-2 top-2.5 text-gray-500">₫</span>
                </div>
            </div>
        </div>
        
        <!-- Product Visibility -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <h3 class="text-xs font-medium text-gray-700 mb-3">HIỂN THỊ</h3>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" id="featured" name="featured" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <label for="featured" class="ml-2 text-sm text-gray-700">Sản phẩm nổi bật</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="homepage" name="homepage" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <label for="homepage" class="ml-2 text-sm text-gray-700">Hiển thị trang chủ</label>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection