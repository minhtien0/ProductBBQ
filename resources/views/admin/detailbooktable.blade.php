@extends('admin.index')
@section('content')
<style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .timeline-item {
            position: relative;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 50px;
            height: calc(100% - 50px);
            width: 2px;
            background: linear-gradient(to bottom, #e5e7eb, transparent);
        }
        
        .timeline-item:last-child::before {
            display: none;
        }

        .floating-action {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 50;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-in-up {
            animation: slideInUp 0.6s ease-out;
        }

        .info-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .priority-high {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-left: 4px solid #ef4444;
        }
        
        .priority-medium {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 4px solid #f59e0b;
        }
        
        .priority-low {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-left: 4px solid #10b981;
        }
    </style>

    <body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <div class="container mx-auto p-6" x-data="bookingDetailManager()">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <button @click="goBack()" 
                        class="w-12 h-12 bg-white hover:bg-gray-50 rounded-xl shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-105">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </button>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fas fa-receipt text-blue-600"></i>
                        Chi tiết đặt bàn
                        <span class="text-2xl text-blue-600" x-text="'#' + booking.id"></span>
                    </h1>
                    <p class="text-gray-600 mt-1">Thông tin chi tiết về đơn đặt bàn</p>
                </div>
            </div>
            
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Left Column - Main Info -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Customer Info Card -->
                <div class="glass-effect rounded-xl p-6 slide-in-up">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-user-circle text-blue-600"></i>
                            Thông tin khách hàng
                        </h2>
                        <span :class="{
                            'status-pending': booking.status === 'Chờ xác nhận',
                            'status-confirmed': booking.status === 'Đã xác nhận',
                            'status-cancelled': booking.status === 'Đã hủy'
                        }" class="px-4 py-2 rounded-full text-white text-sm font-medium">
                            <span x-text="booking.status"></span>
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Avatar & Basic Info -->
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                <span x-text="booking.nameuser.charAt(0).toUpperCase()"></span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900" x-text="booking.nameuser"></h3>
                                <p class="text-gray-600 flex items-center gap-2 mt-1">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                    <span x-text="booking.email"></span>
                                </p>
                                <p class="text-gray-600 flex items-center gap-2 mt-1">
                                    <i class="fas fa-phone text-green-500"></i>
                                    <span x-text="booking.sdt"></span>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Additional Info -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-users text-purple-500"></i>
                                    Số lượng khách
                                </span>
                                <span class="font-semibold text-gray-900" x-text="booking.quantitypeople + ' người'"></span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-table text-amber-500"></i>
                                    Số bàn
                                </span>
                                <span class="font-semibold text-gray-900" x-text="booking.table_id || 'Chưa chọn'"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Details Card -->
                <div class="glass-effect rounded-xl p-6 slide-in-up" style="animation-delay: 0.1s">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-blue-600"></i>
                        Chi tiết đặt bàn
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <!-- Booking Time -->
                            <div class="info-card bg-white p-6 rounded-xl shadow-sm">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clock text-blue-600"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Thời gian đặt bàn</h3>
                                </div>
                                <p class="text-2xl font-bold text-gray-900" x-text="formatDateTime(booking.time_booking)"></p>
                                <p class="text-sm text-gray-500 mt-1">Thời gian dự kiến</p>
                            </div>

                           
                        </div>

                        <div class="space-y-6">
                            <!-- Created Time -->
                            <div class="info-card bg-white p-6 rounded-xl shadow-sm">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-plus-circle text-purple-600"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Thời gian tạo</h3>
                                </div>
                                <p class="text-lg font-bold text-gray-900" x-text="formatDateTime(booking.created_at)"></p>
                                <p class="text-sm text-gray-500 mt-1">Đơn được tạo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes & Special Requests -->
                <div class="glass-effect rounded-xl p-6 slide-in-up" style="animation-delay: 0.2s">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-sticky-note text-blue-600"></i>
                        Ghi chú & Yêu cầu đặc biệt
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="priority-medium p-4 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-utensils text-amber-600"></i>
                                <span class="font-medium text-amber-800">Yêu cầu về món ăn</span>
                            </div>
                            <p class="text-amber-700">Không cay, ít dầu mỡ, có món chay</p>
                        </div>
                        
                        <div class="priority-low p-4 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-birthday-cake text-green-600"></i>
                                <span class="font-medium text-green-800">Dịp đặc biệt</span>
                            </div>
                            <p class="text-green-700">Sinh nhật bạn gái - cần bánh kem và nến</p>
                        </div>
                        
                        <div class="priority-high p-4 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-wheelchair text-red-600"></i>
                                <span class="font-medium text-red-800">Yêu cầu khác</span>
                            </div>
                            <p class="text-red-700">Cần bàn thuận tiện cho người khuyết tật</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Timeline & Actions -->
            <div class="space-y-6">

                <!-- Action Panel -->
                <div class="glass-effect rounded-xl p-6 slide-in-up" style="animation-delay: 0.5s">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-cogs text-blue-600"></i>
                        Thao tác
                    </h3>
                    
                    <div class="space-y-3">
                        <button @click="confirmBooking()" 
                                x-show="booking.status === 'Chờ xác nhận'"
                                class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-check"></i>
                            Xác nhận đặt bàn
                        </button>
                        
                        <button @click="assignTable()" 
                                x-show="!booking.table_id && booking.status === 'Đã xác nhận'"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-table"></i>
                            Chọn bàn
                        </button>
                        
                        <button @click="cancelBooking()" 
                                x-show="booking.status !== 'Đã hủy'"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Hủy đặt bàn
                        </button>
                        
                        <button @click="editBooking()" 
                                class="w-full bg-gray-500 hover:bg-gray-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i>
                            Chỉnh sửa
                        </button>
                    </div>
                </div>

                <!-- Contact Actions -->
                <div class="glass-effect rounded-xl p-6 slide-in-up" style="animation-delay: 0.6s">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-phone text-blue-600"></i>
                        Liên hệ khách hàng
                    </h3>
                    
                    <div class="space-y-3">
                        <button @click="callCustomer()" 
                                class="w-full bg-green-100 hover:bg-green-200 text-green-700 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-phone"></i>
                            Gọi điện
                        </button>
                        
                        <button @click="sendSMS()" 
                                class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-sms"></i>
                            Gửi SMS
                        </button>
                        
                        <button @click="sendEmail()" 
                                class="w-full bg-purple-100 hover:bg-purple-200 text-purple-700 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-envelope"></i>
                            Gửi Email
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <div class="floating-action">
            <button @click="showQuickActions = !showQuickActions" 
                    class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-xl flex items-center justify-center transition-all duration-200 hover:scale-110">
                <i class="fas fa-plus" :class="{'fa-rotate-45': showQuickActions}"></i>
            </button>
            
            <!-- Quick Action Menu -->
            <div x-show="showQuickActions" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="absolute bottom-16 right-0 space-y-3">
                
                <button class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110">
                    <i class="fas fa-phone"></i>
                </button>
                
                <button class="w-12 h-12 bg-purple-500 hover:bg-purple-600 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110">
                    <i class="fas fa-envelope"></i>
                </button>
                
                <button class="w-12 h-12 bg-orange-500 hover:bg-orange-600 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>

        <!-- Notification Toast -->
        <div x-show="notification.show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-6 left-6 z-50 max-w-sm">
            <div :class="notification.type === 'success' ? 'bg-green-500' : 'bg-red-500'" 
                 class="text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                <i :class="notification.type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'"></i>
                <span x-text="notification.message"></span>
            </div>
        </div>
    </div>

    <script>
        function bookingDetailManager() {
            return {
                showQuickActions: false,
                notification: {
                    show: false,
                    message: '',
                    type: 'success'
                },
                booking: {
                    id: 1,
                    nameuser: 'Nguyễn Minh Tiến',
                    sdt: '0373214547',
                    email: 'admin@gmail.com',
                    quantitypeople: 3,
                    time_booking: '2025-06-19 13:00:00',
                    table_id: null,
                    time_order: '2025-06-18 16:14:54',
                    status: 'Chờ xác nhận',
                    created_at: '2025-06-18 16:14:54',
                    updated_at: '2025-06-18 16:14:54'
                },
                activities: [
                    {
                        title: 'Đặt bàn được tạo',
                        description: 'Khách hàng đã tạo đơn đặt bàn mới',
                        time: '18/06/2025 16:14',
                        icon: 'fas fa-plus',
                        color: 'bg-blue-500'
                    },
                    {
                        title: 'Chờ xác nhận',
                        description: 'Đơn đặt bàn đang chờ nhân viên xác nhận',
                        time: '18/06/2025 16:15',
                        icon: 'fas fa-clock',
                        color: 'bg-yellow-500'
                    },
                    {
                        title: 'Nhân viên xem đơn',
                        description: 'Nhân viên đã xem chi tiết đơn đặt bàn',
                        time: '18/06/2025 16:30',
                        icon: 'fas fa-eye',
                        color: 'bg-purple-500'
                    }
                ],

                formatDateTime(dateTimeString) {
                    if (!dateTimeString) return 'Chưa có';
                    const date = new Date(dateTimeString);
                    return date.toLocaleString('vi-VN', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                getBookingDuration() {
                    const created = new Date(this.booking.created_at);
                    const booking = new Date(this.booking.time_booking);
                    const diffHours = Math.round((booking - created) / (1000 * 60 * 60));
                    return diffHours > 24 ? Math.round(diffHours / 24) + ' ngày' : diffHours + ' giờ';
                },

                goBack() {
                    this.showNotification('Quay lại danh sách đặt bàn', 'success');
                    // window.history.back();
                },

                confirmBooking() {
                    this.booking.status = 'Đã xác nhận';
                    this.activities.unshift({
                        title: 'Đặt bàn được xác nhận',
                        description: 'Nhân viên đã xác nhận đơn đặt bàn',
                        time: new Date().toLocaleString('vi-VN'),
                        icon: 'fas fa-check',
                        color: 'bg-green-500'
                    });
                    this.showNotification('Đã xác nhận đặt bàn thành công!', 'success');
                },

                cancelBooking() {
                    if (confirm('Bạn có chắc chắn muốn hủy đặt bàn này?')) {
                        this.booking.status = 'Đã hủy';
                        this.activities.unshift({
                            title: 'Đặt bàn bị hủy',
                            description: 'Đơn đặt bàn đã được hủy',
                            time: new Date().toLocaleString('vi-VN'),
                            icon: 'fas fa-times',
                            color: 'bg-red-500'
                        });
                        this.showNotification('Đã hủy đặt bàn!', 'success');
                    }
                },

                assignTable() {
    const tableNumber = prompt('Chọn số bàn cho khách hàng:');
    if (tableNumber) {
        this.booking.table_id = tableNumber;
        this.activities.unshift({
            title: 'Chọn bàn',
            description: `Đã chọn bàn số ${tableNumber} cho khách hàng`,
            time: new Date().toLocaleString('vi-VN'),
            icon: 'fas fa-table',
            color: 'bg-blue-500'
        });
        this.showNotification('Đã chọn bàn thành công!', 'success');
    }
}}
        }
</script>
@endsection