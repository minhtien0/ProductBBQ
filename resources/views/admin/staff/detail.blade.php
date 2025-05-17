@extends('admin.index')
@section('content')
    <div class="flex">
        <div class="flex-1 bg-white rounded-lg border border-gray-200 shadow-sm p-6 mt-3">
            <h1 class="text-lg font-bold text-gray-800 mb-6">Thông Tin Nhân Viên</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">Họ Và Tên</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">Mã Nhân Viên</label>
                    <input type="text" id="sku" name="sku"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">Ngày Sinh</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">Giới Tính</label>
                    <select id="status" name="status"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Giới Tính</option>
                        <option value="boy">Nam</option>
                        <option value="girl">Nữ</option>
                        <option value="orther">Khác</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">Số Điện Thoại</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">CCCD</label>
                    <input type="text" id="sku" name="sku"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">Địa Chỉ</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input type="text" id="sku" name="sku"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="productName" class="block text-xs font-medium text-gray-700 mb-1">Ngày Vào Làm</label>
                    <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="sku" class="block text-xs font-medium text-gray-700 mb-1">Đơn Vị</label>
                    <select id="warehouse" name="warehouse"
                        class="w-full px-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Đơn Vị</option>
                        <option value="kho1">Hà Nội</option>
                        <option value="kho2">Hồ Chí Minh</option>
                        <option value="kho3">Đà Nẵng</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Warehouse -->
                <div>
                    <label for="warehouse" class="block text-xs font-medium text-gray-700 mb-1">Loại Nhân Viên</label>
                    <select id="warehouse" name="warehouse"
                        class="w-full px-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn Loại Nhân Viên</option>
                        <option value="kho1">Full Time</option>
                        <option value="kho2">Part Time</option>
                        <option value="kho3">Thời Vụ</option>
                    </select>
                </div>

                <!-- Product Status -->
                <div>
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-1">Trạng Thái</label>
                    <select id="status" name="status"
                        class="w-full text-xs px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn trạng thái</option>
                        <option value="active">Đang làm</option>
                        <option value="outofstock">Thử Việc</option>
                        <option value="discontinued">Tạm Vắng</option>
                        <option value="discontinued">Ngưng Làm</option>
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
                    <i class="fa-solid fa-plus mr-1"></i> Lưu
                </button>
                <button type="button" class="w-full px-2 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-all duration-200">
                    Hủy
                </button>
            </div>
        </div>
        
        <!-- Product Image -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
            <label class="block text-xs font-medium text-gray-700 mb-2">Hình Ảnh Cá Nhân</label>
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
            <h3 class="text-xs font-medium text-gray-700 mb-3">Thông Tin Chuyển Khoản</h3>
            
            <!-- Product Price -->
            <div class="mb-3">
                <label for="price" class="block text-xs font-medium text-gray-700 mb-1">Số Tài Khoản</label>
                <div class="relative">
                <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Promo Price -->
            <div>
                <label for="promoPrice" class="block text-xs font-medium text-gray-700 mb-1">Nhân Hàng</label>
                <div class="relative">
                <input type="text" id="productName" name="productName"
                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                
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