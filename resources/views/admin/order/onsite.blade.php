@extends('admin.order.index')
@section('content_order')
    <div class="p-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Đơn Hàng Tại Quán</h2>
                <p class="text-gray-600 mt-2">Quản lý và theo dõi các đơn hàng được phục vụ trực tiếp tại quán</p>
            </div>
        </div>

        <!-- Status Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#"
                        class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 border-orange-500 text-orange-600">
                        <span class="flex items-center">
                            <span class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-orange-100 text-orange-600 rounded-full">
                                10
                            </span>
                            Tất Cả
                        </span>
                    </a>
                    <a href="#"
                        class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <span class="flex items-center">
                            <span class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-yellow-100 text-yellow-600 rounded-full">
                                3
                            </span>
                            Chờ xác nhận
                            <span class="ml-1 inline-flex items-center justify-center w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </span>
                    </a>
                    <a href="#"
                        class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <span class="flex items-center">
                            <span class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-blue-100 text-blue-600 rounded-full">
                                2
                            </span>
                            Đang phục vụ
                        </span>
                    </a>
                    <a href="#"
                        class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <span class="flex items-center">
                            <span class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-green-100 text-green-600 rounded-full">
                                5
                            </span>
                            Hoàn thành
                        </span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Filter & Search Section -->
        <div class="mb-6 p-4 bg-gray-50 rounded-xl">
            <form id="order-filter-form">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Search -->
                    <div class="flex-1 min-w-64">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="keyword"
                                placeholder="Tìm kiếm theo mã đơn, bàn, ghi chú..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <label class="text-sm text-gray-600">Từ ngày:</label>
                        <input type="date" name="date_from"
                            class="px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <label class="text-sm text-gray-600">Đến ngày:</label>
                        <input type="date" name="date_to"
                            class="px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    </div>
                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                            Tìm kiếm
                        </button>
                        <button type="button" id="reset-filter"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Đặt lại
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Orders Table with Sample Data -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="selectAll"
                                class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Chọn tất cả</span>
                        </label>
                        <span class="text-sm text-gray-500">10 đơn hàng</span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3"><input type="checkbox" class="w-4 h-4 text-orange-600 border-gray-300 rounded"></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã Đơn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bàn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số Người</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ghi Chú</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thời Gian Đặt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng Thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tổng Tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="order-table-section">
                        @php
                            $orders = [
                                [
                                    'code' => 'TQ0001',
                                    'table' => 'Bàn 5',
                                    'num_people' => 4,
                                    'note' => 'Không hành',
                                    'created_at' => '2025-07-02 18:30',
                                    'status' => 'Chờ xác nhận',
                                    'total' => 350000,
                                ],
                                [
                                    'code' => 'TQ0002',
                                    'table' => 'Bàn 7',
                                    'num_people' => 2,
                                    'note' => '',
                                    'created_at' => '2025-07-02 18:45',
                                    'status' => 'Đang phục vụ',
                                    'total' => 220000,
                                ],
                                [
                                    'code' => 'TQ0003',
                                    'table' => 'Bàn 1',
                                    'num_people' => 3,
                                    'note' => 'Thêm đá',
                                    'created_at' => '2025-07-02 19:00',
                                    'status' => 'Hoàn thành',
                                    'total' => 410000,
                                ],
                                // Thêm mẫu nếu cần
                            ];
                            $statusColors = [
                                'Chờ xác nhận' => 'bg-yellow-100 text-yellow-800',
                                'Đang phục vụ' => 'bg-blue-100 text-blue-800',
                                'Hoàn thành' => 'bg-green-100 text-green-800',
                                'Đã hủy' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="rowCheckbox w-4 h-4 text-orange-600 border-gray-300 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $order['code'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order['table'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order['num_people'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $order['note'] ?: '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($order['created_at'])->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{ number_format($order['total']) }} VNĐ
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="#" class="inline-flex items-center px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Chi tiết
                                    </a>
                                    @if($order['status'] === 'Chờ xác nhận')
                                    <button class="inline-flex items-center px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full hover:bg-green-200 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Xác nhận
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if(empty($orders))
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Không có đơn hàng nào</h3>
                                        <p class="text-gray-500">Chưa có đơn hàng tại quán nào được tạo</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Giả lập -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Hiển thị 1 đến {{ count($orders) }} trong tổng số {{ count($orders) }} kết quả
            </div>
            <div class="flex-1 flex justify-center">
                <!-- Pagination giả lập -->
                <nav class="inline-flex -space-x-px" aria-label="Pagination">
                    <span class="px-3 py-2 border border-gray-300 bg-gray-200 text-gray-500 rounded-l-lg">Trước</span>
                    <span class="px-3 py-2 border border-orange-500 bg-orange-100 text-orange-600">1</span>
                    <span class="px-3 py-2 border border-gray-300 bg-white text-gray-700 rounded-r-lg">Sau</span>
                </nav>
            </div>
        </div>
    </div>
@endsection
