@extends('admin.index')
@section('content')
<style>
        .star-rating {
            color: #fbbf24;
        }
        .filter-panel {
            min-height: 400px;
        }
        .table-container {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
    </style>
    <body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Quản lý đánh giá</h1>
            <p class="text-gray-600">Quản lý và theo dõi các đánh giá từ khách hàng</p>
        </div>

        <!-- Filters & Actions Bar -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6" x-data="{ 
            filterOpen: false, 
            selectedItems: [],
            selectAll: false,
            toggleSelectAll() {
                this.selectAll = !this.selectAll;
                if (this.selectAll) {
                    this.selectedItems = [1, 2, 3]; // Sample IDs
                } else {
                    this.selectedItems = [];
                }
            }
        }">
            <div class="p-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Left side - Filter toggle -->
                    <div class="flex items-center gap-3">
                        <button @click="filterOpen = !filterOpen"
                            class="action-btn bg-blue-50 border border-blue-200 text-blue-700 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-100 transition-colors">
                            <i class="fas fa-filter text-sm"></i>
                            <span>Bộ lọc</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': filterOpen}"></i>
                        </button>
                        
                        <!-- Quick stats -->
                        <div class="hidden lg:flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-500"></i>
                                <span>Tổng: 1,234 đánh giá</span>
                            </span>
                        </div>
                    </div>

                    <!-- Right side - Actions -->
                    <div class="flex items-center gap-2">
                        <button class="action-btn bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-green-100 transition-colors">
                            <i class="fas fa-download text-sm"></i>
                            <span>Xuất file</span>
                        </button>
                        
                        <button class="action-btn bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-red-100 transition-colors"
                            :class="{'opacity-50 cursor-not-allowed': selectedItems.length === 0}">
                            <i class="fas fa-trash text-sm"></i>
                            <span>Xóa (<span x-text="selectedItems.length"></span>)</span>
                        </button>
                    </div>
                </div>

                <!-- Expandable Filter Panel -->
                <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mt-4 pt-4 border-t border-gray-200">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Star Rating Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Số sao</label>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Tất cả</option>
                                <option value="5">⭐⭐⭐⭐⭐ 5 sao</option>
                                <option value="4">⭐⭐⭐⭐ 4 sao</option>
                                <option value="3">⭐⭐⭐ 3 sao</option>
                                <option value="2">⭐⭐ 2 sao</option>
                                <option value="1">⭐ 1 sao</option>
                            </select>
                        </div>

                        <!-- Product Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sản phẩm</label>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Tất cả sản phẩm</option>
                                <option value="1">Sản phẩm A</option>
                                <option value="2">Sản phẩm B</option>
                                <option value="3">Sản phẩm C</option>
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Từ ngày</label>
                            <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Đến ngày</label>
                            <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="flex items-center gap-3 mt-4">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <i class="fas fa-search text-sm"></i>
                            <span>Áp dụng lọc</span>
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-redo text-sm"></i>
                            <span>Đặt lại</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 table-container">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="w-12 p-4 text-left">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    @change="toggleSelectAll()">
                            </th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Khách hàng</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Nội dung đánh giá</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Đánh giá</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Sản phẩm</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Thời gian</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Hình ảnh</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Sample Row 1 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-medium">
                                        NT
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">Nguyễn Minh Tiến</div>
                                        <div class="text-sm text-gray-500">tiennguyen@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="max-w-xs">
                                    <p class="text-gray-900 text-sm leading-relaxed">
                                        Sản phẩm rất tốt, chất lượng như mô tả. Giao hàng nhanh, đóng gói cẩn thận. Sẽ mua lại lần sau.
                                    </p>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-1">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-1">5.0</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-gray-900">Laptop Gaming XYZ</span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-900">15/06/2024</div>
                                <div class="text-xs text-gray-500">14:30</div>
                            </td>
                            <td class="p-4">
                                <div class="flex gap-1">
                                    <img src="https://via.placeholder.com/40x40/e5e7eb/6b7280?text=1" alt="Review image" 
                                        class="w-8 h-8 rounded object-cover border border-gray-200">
                                    <img src="https://via.placeholder.com/40x40/e5e7eb/6b7280?text=2" alt="Review image" 
                                        class="w-8 h-8 rounded object-cover border border-gray-200">
                                    <div class="w-8 h-8 rounded bg-gray-100 border border-gray-200 flex items-center justify-center text-xs text-gray-500">
                                        +2
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-800 transition-colors" title="Phê duyệt">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 2 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white font-medium">
                                        LH
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">Lê Thị Hoa</div>
                                        <div class="text-sm text-gray-500">lehoa@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="max-w-xs">
                                    <p class="text-gray-900 text-sm leading-relaxed">
                                        Chất lượng ổn nhưng giao hàng hơi chậm. Sản phẩm đúng như mô tả.
                                    </p>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-1">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star text-gray-300"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-1">4.0</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-gray-900">Điện thoại ABC</span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-900">14/06/2024</div>
                                <div class="text-xs text-gray-500">09:15</div>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-500">Không có</div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-800 transition-colors" title="Phê duyệt">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 3 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center text-white font-medium">
                                        VD
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">Võ Minh Duy</div>
                                        <div class="text-sm text-gray-500">duyvo@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="max-w-xs">
                                    <p class="text-gray-900 text-sm leading-relaxed">
                                        Sản phẩm không đúng mô tả, chất lượng kém. Rất thất vọng với lần mua hàng này.
                                    </p>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-1">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star text-gray-300"></i>
                                        <i class="far fa-star text-gray-300"></i>
                                        <i class="far fa-star text-gray-300"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-1">2.0</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-gray-900">Tai nghe DEF</span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-900">13/06/2024</div>
                                <div class="text-xs text-gray-500">16:45</div>
                            </td>
                            <td class="p-4">
                                <div class="flex gap-1">
                                    <img src="https://via.placeholder.com/40x40/e5e7eb/6b7280?text=1" alt="Review image" 
                                        class="w-8 h-8 rounded object-cover border border-gray-200">
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-800 transition-colors" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-800 transition-colors" title="Phê duyệt">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800 transition-colors" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">10</span> 
                        trong tổng số <span class="font-medium">1,234</span> kết quả
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-500 hover:bg-gray-50">
                            Trước
                        </button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">3</button>
                        <span class="px-2 text-gray-500">...</span>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">124</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">
                            Sau
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection