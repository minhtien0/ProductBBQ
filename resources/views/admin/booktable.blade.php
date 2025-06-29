@extends('admin.index')
@section('content')
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .status-pending {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        }

        .status-confirmed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .status-cancelled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .filter-slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: scale(1.005);
        }
    </style>

    <body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
        <div class="container mx-auto p-6" x-data="bookingManager()">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-utensils text-blue-600 mr-3"></i>
                    Quản lý đặt bàn
                </h1>
                <p class="text-gray-600">Quản lý các đơn đặt bàn của nhà hàng</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="glass-effect rounded-xl p-6 hover-lift border border-white/20">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Tổng đặt bàn</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $countAll }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-effect rounded-xl p-6 hover-lift border border-white/20">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Chờ xác nhận</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $countPending }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-effect rounded-xl p-6 hover-lift border border-white/20">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Đã xác nhận</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $countConfirm }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-effect rounded-xl p-6 hover-lift border border-white/20">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-times-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Đã hủy</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $countCancel }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="glass-effect rounded-xl border border-white/20 overflow-hidden">
                <!-- Toolbar -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Filter Tabs -->
                        <div class="flex flex-wrap gap-2">
                            <button @click="currentFilter = 'all'" :class="currentFilter === 'all' ? 'bg-white text-blue-600' : 'bg-blue-500/30 text-white hover:bg-blue-500/50'"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-list"></i>
                                Tất cả ({{ $countAll }})
                            </button>
                            <button @click="currentFilter = 'pending'" :class="currentFilter === 'pending' ? 'bg-white text-blue-600' : 'bg-blue-500/30 text-white hover:bg-blue-500/50'"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                Chờ xác nhận ({{ $countPending }})
                            </button>
                            <button @click="currentFilter = 'confirmed'" :class="currentFilter === 'confirmed' ? 'bg-white text-blue-600' : 'bg-blue-500/30 text-white hover:bg-blue-500/50'"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-check"></i>
                                Đã xác nhận ({{ $countConfirm }})
                            </button>

                            <button @click="currentFilter = 'cancelled'" :class="currentFilter === 'cancelled' ? 'bg-white text-blue-600' : 'bg-blue-500/30 text-white hover:bg-blue-500/50'"
                                class="px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-check"></i>
                                Đã Hủy ({{ $countCancel }})
                            </button>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <button @click="showFilter = true"
                                class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-filter"></i>
                                Bộ lọc
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="w-12 p-4 text-left">
                                    <input type="checkbox" @change="toggleAllSelection($event.target.checked)"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                </th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Khách hàng</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Liên hệ</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Chi tiết</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Thời gian</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Trạng thái</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        <template x-for="info in filteredBookings" :key="info.id">
                            <tr class="table-row border-b border-gray-100">
                                <td class="p-4">
                                    <input type="checkbox"
                                        :value="info.id"
                                        @change="toggleSelection(info.id, $event.target.checked)"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-medium mr-3">
                                            <span x-text="info.nameuser ? info.nameuser.charAt(0).toUpperCase() : ''"></span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900" x-text="info.nameuser"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div>
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <i class="fas fa-phone text-blue-500"></i>
                                            <span x-text="info.sdt"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="space-y-1">
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <i class="fas fa-users text-green-500"></i>
                                            <span x-text="info.quantitypeople"></span> người
                                        </p>
                                        <p class="text-gray-600 flex items-center gap-2">
                                            <i class="fas fa-table text-purple-500"></i>
                                            <span x-text="info.table.number"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="space-y-1">
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <i class="fas fa-calendar-alt text-blue-500"></i>
                                            <span x-text="new Date(info.time_booking).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}) + ' ' + new Date(info.time_booking).toLocaleDateString('vi-VN')"></span>
                                        </p>
                                        <p class="text-sm text-gray-500 flex items-center gap-2">
                                            <i class="fas fa-clock text-gray-400"></i>
                                            Đặt lúc: <span x-text="new Date(info.time_order).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}) + ' ' + new Date(info.time_order).toLocaleDateString('vi-VN')"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span :class="{
                                                'status-pending': info.status === 'Chờ xác nhận',
                                                'status-confirmed': info.status === 'Đã xác nhận',
                                                'status-cancelled': info.status === 'Đã hủy'
                                            }"
                                            class="px-3 py-1 rounded-full text-white text-sm font-medium">
                                        <span x-text="info.status"></span>
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a :href="'{{ route('admin.booktable.detail', '') }}' + '/' + info.id">
                                            <button class="w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-lg flex items-center justify-center transition-colors duration-200" title="Xem chi tiết">
                                                <i class="fas fa-eye text-xs"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div x-show="filteredBookings.length === 0" class="text-center py-12">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Không có đặt bàn nào</h3>
                    <p class="text-gray-500">Chưa có đơn đặt bàn nào phù hợp với bộ lọc hiện tại.</p>
                </div>
            </div>

            <!-- Filter Sidebar -->
            <div x-show="showFilter" @click="showFilter = false"
                class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            </div>

            <div x-show="showFilter"
                class="fixed left-0 top-0 h-full w-96 max-w-full bg-white shadow-2xl z-50 filter-slide-in" @click.stop
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full">

                <div class="h-full flex flex-col">
                    <!-- Filter Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold flex items-center gap-2">
                                <i class="fas fa-filter"></i>
                                Bộ lọc tìm kiếm
                            </h3>
                            <button @click="showFilter = false"
                                class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition-colors duration-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Content -->
                    <div class="flex-1 p-6 space-y-6 overflow-y-auto">
                        <!-- Date Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Khoảng thời gian</label>
                            <div class="space-y-3">
                                <div class="relative">
                                    <input type="date" x-model="filters.startDate"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-500">Từ
                                        ngày</label>
                                </div>
                                <div class="relative">
                                    <input type="date" x-model="filters.endDate"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <label class="absolute -top-2 left-3 bg-white px-1 text-xs text-gray-500">Đến
                                        ngày</label>
                                </div>
                            </div>
                        </div>

                        <!-- Guest Count -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Số lượng khách</label>
                            <select x-model="filters.guestCount"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Tất cả</option>
                                <option value="1-2">1-2 người</option>
                                <option value="3-4">3-4 người</option>
                                <option value="5-8">5-8 người</option>
                                <option value="8+">Trên 8 người</option>
                            </select>
                        </div>

                        <!-- Table -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Bàn</label>
                            <select x-model="filters.table"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Tất cả bàn</option>
                                <option value="1">Bàn 1</option>
                                <option value="2">Bàn 2</option>
                                <option value="3">Bàn 3</option>
                                <option value="VIP">Bàn VIP</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Tìm kiếm</label>
                            <div class="relative">
                                <input type="text" x-model="filters.search"
                                    placeholder="Tên khách hàng hoặc số điện thoại..."
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="p-6 bg-gray-50 border-t space-y-3">
                        <button @click="applyFilters()"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i>
                            Áp dụng bộ lọc
                        </button>
                        <button @click="resetFilters()"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-undo"></i>
                            Đặt lại
                        </button>
                    </div>
                </div>
            </div>

            <!-- Notification Toast -->
            <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2" class="fixed bottom-6 right-6 z-50 max-w-sm">
                <div :class="notification . type === 'success' ? 'bg-green-500' : 'bg-red-500'"
                    class="text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                    <i :class="notification . type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'"></i>
                    <span x-text="notification.message"></span>
                </div>
            </div>
        </div>
        <script>
            window.bookingsData = @json($infos);
        </script>
        <script>
            function bookingManager() {
                return {
                    showFilter: false,
                    currentFilter: 'all',
                    selectedBookings: [],
                    notification: { show: false, message: '', type: 'success' },
                    filters: {
                        startDate: '',
                        endDate: '',
                        guestCount: '',
                        table: '',
                        search: ''
                    },
                    bookings: window.bookingsData ?? [], // <-- LẤY DỮ LIỆU ĐẶT BÀN

                    // Trả về mảng đã lọc theo status & filter form
                    get filteredBookings() {
                        let filtered = this.bookings;

                        // Lọc theo tab
                        if (this.currentFilter !== 'all') {
                            let statusText = '';
                            if (this.currentFilter === 'pending') statusText = 'Chờ xác nhận';
                            else if (this.currentFilter === 'confirmed') statusText = 'Đã xác nhận';
                            else if (this.currentFilter === 'cancelled') statusText = 'Đã hủy';
                            filtered = filtered.filter(b => b.status === statusText);
                        }

                        // Lọc theo bộ lọc
                        if (this.filters.startDate) {
                            filtered = filtered.filter(b => b.time_booking >= this.filters.startDate);
                        }
                        if (this.filters.endDate) {
                            filtered = filtered.filter(b => b.time_booking <= this.filters.endDate);
                        }
                        if (this.filters.guestCount) {
                            const val = this.filters.guestCount;
                            filtered = filtered.filter(b => {
                                const count = parseInt(b.quantitypeople);
                                if (val === '1-2') return count >= 1 && count <= 2;
                                if (val === '3-4') return count >= 3 && count <= 4;
                                if (val === '5-8') return count >= 5 && count <= 8;
                                if (val === '8+') return count > 8;
                                return true;
                            });
                        }
                        if (this.filters.table) {
                            filtered = filtered.filter(b => String(b.table) === String(this.filters.table));
                        }
                        if (this.filters.search) {
                            const s = this.filters.search.toLowerCase();
                            filtered = filtered.filter(b =>
                                (b.nameuser && b.nameuser.toLowerCase().includes(s)) ||
                                (b.sdt && b.sdt.includes(s))
                            );
                        }
                        return filtered;
                    },

                    toggleSelection(bookingId, checked) {
                        if (checked) {
                            if (!this.selectedBookings.includes(bookingId)) {
                                this.selectedBookings.push(bookingId);
                            }
                        } else {
                            this.selectedBookings = this.selectedBookings.filter(id => id !== bookingId);
                        }
                    },

                    toggleAllSelection(checked) {
                        if (checked) {
                            this.selectedBookings = this.filteredBookings.map(booking => booking.id);
                        } else {
                            this.selectedBookings = [];
                        }
                    },

                    confirmBooking(bookingId) {
                        const booking = this.bookings.find(b => b.id === bookingId);
                        if (booking) {
                            booking.status = 'confirmed';
                            this.showNotification('Đã xác nhận đặt bàn thành công!', 'success');
                        }
                    },

                    cancelBooking(bookingId) {
                        const booking = this.bookings.find(b => b.id === bookingId);
                        if (booking) {
                            booking.status = 'cancelled';
                            this.showNotification('Đã hủy đặt bàn thành công!', 'success');
                        }
                    },

                    confirmSelected() {
                        if (this.selectedBookings.length === 0) return;

                        this.selectedBookings.forEach(bookingId => {
                            const booking = this.bookings.find(b => b.id === bookingId);
                            if (booking && booking.status === 'pending') {
                                booking.status = 'confirmed';
                            }
                        });

                        this.showNotification(`Đã xác nhận ${this.selectedBookings.length} đặt bàn!`, 'success');
                        this.selectedBookings = [];
                    },

                    cancelSelected() {
                        if (this.selectedBookings.length === 0) return;

                        this.selectedBookings.forEach(bookingId => {
                            const booking = this.bookings.find(b => b.id === bookingId);
                            if (booking && booking.status !== 'cancelled') {
                                booking.status = 'cancelled';
                            }
                        });

                        this.showNotification(`Đã hủy ${this.selectedBookings.length} đặt bàn!`, 'success');
                        this.selectedBookings = [];
                    },

                    viewDetails(booking) {
                        this.showNotification(`Xem chi tiết đặt bàn ${booking.id}`, 'success');
                    },

                    getStatusText(status) {
                        const statusMap = {
                            'pending': 'Chờ xác nhận',
                            'confirmed': 'Đã xác nhận',
                            'cancelled': 'Đã hủy'
                        };
                        return statusMap[status] || status;
                    },

                    applyFilters() {
                        this.showFilter = false;
                        this.showNotification('Đã áp dụng bộ lọc!', 'success');
                    },

                    resetFilters() {
                        this.filters = { startDate: '', endDate: '', guestCount: '', table: '', search: '' };
                        this.showNotification('Đã đặt lại bộ lọc!', 'success');
                    },

                    showNotification(message, type = 'success') {
                        this.notification = {
                            show: true,
                            message: message,
                            type: type
                        };

                        setTimeout(() => {
                            this.notification.show = false;
                        }, 3000);
                    }
                }
            }
        </script>
    </body>
@endsection