@extends('admin.order.index')
@section('content_order')
    <div class="p-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Đơn Hàng Mang Về</h2>
                <p class="text-gray-600 mt-2">Quản lý và theo dõi các đơn hàng mang về</p>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center space-x-3">
                <!-- <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v1"></path>
                            </svg>
                            Xuất Excel
                        </button>
                        <button class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Làm mới
                        </button> -->
            </div>
        </div>

        <!-- Status Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <!-- Tất cả -->
                    <a href="{{ route('admin.order.bringback') }}"
                        class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 {{ is_null($statusorder) ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <span class="flex items-center">
                            <span
                                class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-gray-100 rounded-full {{ is_null($statusorder) ? 'bg-orange-100 text-orange-600' : 'text-gray-600' }}">
                                {{ $counts['all'] }}
                            </span>
                            Tất Cả
                        </span>
                    </a>

                    <!-- Các trạng thái -->
                    @foreach($statuses as $s)
                        <a href="{{ route('admin.order.bringback', ['statusorder' => $s]) }}"
                            class="py-3 px-1 border-b-2 font-medium text-sm whitespace-nowrap transition-colors duration-200 {{ $statusorder === $s ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <span class="flex items-center">
                                <span
                                    class="inline-flex items-center justify-center w-5 h-5 mr-2 text-xs font-bold bg-gray-100 rounded-full {{ $statusorder === $s ? 'bg-orange-100 text-orange-600' : 'text-gray-600' }}">
                                    {{ $counts[$s] }}
                                </span>
                                {{ $s }}
                                @if($s === 'Chờ xác nhận')
                                    <span
                                        class="ml-1 inline-flex items-center justify-center w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                @endif
                            </span>
                        </a>
                    @endforeach
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
                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Tìm kiếm theo mã đơn hàng, tên khách hàng..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <label class="text-sm text-gray-600">Từ ngày:</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <label class="text-sm text-gray-600">Đến ngày:</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
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

        <!-- Orders Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <!-- Table Header with Bulk Actions -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="selectAll"
                                class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Chọn tất cả</span>
                        </label>
                        <span class="text-sm text-gray-500">{{ $orders->total() }} đơn hàng</span>
                    </div>

                    
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" class="w-4 h-4 text-orange-600 border-gray-300 rounded">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mã Đơn Hàng
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Khách Hàng
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Liên Hệ
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày Đặt
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng Thái
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tổng Tiền
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao Tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="order-table-section">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rowCheckbox w-4 h-4 text-orange-600 border-gray-300 rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">#{{ $order->code }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->customer_email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'Chờ Xác Nhận' => 'bg-yellow-100 text-yellow-800',
                                            'Đang Giao Hàng' => 'bg-blue-100 text-blue-800',
                                            'Đang Thực Hiện' => 'bg-orange-100 text-orange-800',
                                            'Hoàn Thành' => 'bg-green-100 text-green-800',
                                            'Hoàn Tiền' => 'bg-gray-100 text-green-800',
                                            'Đã Hủy' => 'bg-red-100 text-red-800'
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->statusorder] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $order->statusorder }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ number_format($order->totalbill) }} VNĐ
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.order.show', $order->id) }}"
                                            class="inline-flex items-center px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Chi tiết
                                        </a>

                                        @if($order->statusorder === 'Chờ xác nhận')
                                            <button
                                                class="inline-flex items-center px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full hover:bg-green-200 transition-colors">
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
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Không có đơn hàng nào</h3>
                                        <p class="text-gray-500">Chưa có đơn hàng mang về nào được tạo</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Hiển thị {{ $orders->firstItem() }} đến {{ $orders->lastItem() }} trong tổng số {{ $orders->total() }} kết
                    quả
                </div>
                <div class="flex-1 flex justify-center">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
    <script>
        $(function () {
            // Khi submit form filter
            $('#order-filter-form').on('submit', function (e) {
                e.preventDefault();
                fetchOrders();
            });

            // Khi nhấn nút "Đặt lại"
            $('#reset-filter').on('click', function () {
                $('#order-filter-form')[0].reset();
                fetchOrders();
            });

            // Hàm fetch orders
            function fetchOrders(pageUrl = null) {
                let url = "{{ route('admin.order.bringback') }}";
                let data = $('#order-filter-form').serialize();
                if (pageUrl) url = pageUrl + (pageUrl.includes('?') ? '&' : '?') + data;
                else url += '?' + data;

                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "html",
                    beforeSend: function () {
                        $('#order-table-section').css('opacity', .5);
                    },
                    success: function (res) {
                        $('#order-table-section').html($(res).find('#order-table-section').html());
                        $('#order-table-section').css('opacity', 1);
                    },
                    error: function () {
                        alert('Có lỗi xảy ra!');
                        $('#order-table-section').css('opacity', 1);
                    }
                });
            }

            // Bắt sự kiện chuyển trang (pagination ajax)
            $(document).on('click', '#order-table-section .pagination a', function (e) {
                e.preventDefault();
                let pageUrl = $(this).attr('href');
                fetchOrders(pageUrl);
            });
        });
    </script>

    <!-- Additional Scripts -->
    <script>
        // Enhanced functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Status change animations
            const statusElements = document.querySelectorAll('[class*="bg-yellow-100"]');
            statusElements.forEach(el => {
                if (el.textContent.trim() === 'Chờ xác nhận') {
                    el.style.animation = 'pulse 2s infinite';
                }
            });

            // Search functionality
            const searchInput = document.querySelector('input[placeholder*="Tìm kiếm"]');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        // Implement search logic here
                        console.log('Searching for:', this.value);
                    }, 500);
                });
            }

            // Smooth hover effects
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function () {
                    this.style.transform = 'scale(1.01)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                });
                row.addEventListener('mouseleave', function () {
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = 'none';
                });
            });
        });
    </script>
@endsection