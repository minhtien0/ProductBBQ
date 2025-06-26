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
                <a href="{{ route('admin.booktable') }}">
                <button
                        class="w-12 h-12 bg-white hover:bg-gray-50 rounded-xl shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-105">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </button>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fas fa-receipt text-blue-600"></i>
                        Chi tiết đặt bàn
                        <span class="text-2xl text-blue-600">#{{ $details->id }}</span>
                    </h1>
                    <p class="text-gray-600 mt-1">Thông tin chi tiết về đơn đặt bàn</p>
                </div>
            </div>
            
        </div>
<form action="{{ route('admin.booking.confirm', $details->id_booking) }}" method="POST">
    @csrf
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
                            @if($details->status === 'Chờ xác nhận')
                                <span class="bg-yellow-500 text-black px-4 py-2 rounded-full text-sm font-medium">
                                    {{ $details->status }}
                                </span>
                            @elseif($details->status === 'Đã xác nhận')
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    {{ $details->status }}
                                </span>
                            @elseif($details->status === 'Đã hủy')
                                <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    {{ $details->status }}
                                </span>
                            @endif
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Avatar & Basic Info -->
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                <span >User</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900" >{{ $details->nameuser }}</h3>
                                <p class="text-gray-600 flex items-center gap-2 mt-1">
                                    <i class="fas fa-envelope text-blue-500"></i>
                                    <span >{{ $details->email }}</span>
                                </p>
                                <p class="text-gray-600 flex items-center gap-2 mt-1">
                                    <i class="fas fa-phone text-green-500"></i>
                                    <span >{{ $details->sdt }}</span>
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
                                <span class="font-semibold text-gray-900">{{ $details->quantitypeople }} người</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-table text-amber-500"></i>
                                    Số bàn hiện tại: {{ $details->name_table ?? 'chưa có' }}
                                </span>
                                <span class="font-semibold text-gray-900">
                                    <select name="table_id" class="ml-2 px-2 py-1 border rounded" >
                                        <option value="">Chọn</option>
                                        @foreach($listTable as $table)
                                            <option value="{{ $table->id }}"
                                                >
                                                {{ $table->number }}
                                            </option>
                                        @endforeach
                                    </select>
                            </span>
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
                                <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($details->time_booking)->format('d/m/Y H:i') }}</p>
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
                                <p class="text-lg font-bold text-gray-900" >{{ \Carbon\Carbon::parse($details->time_order)->format('d/m/Y H:i') }}</p>
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
                                <span class="font-medium text-amber-800">Yêu cầu</span>
                            </div>
                            <textarea
                                class="w-full bg-amber-50 border border-amber-300 text-amber-800 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-amber-400"
                                rows="4"
                            >{{ $details->notes ?? 'Chưa có ghi chú' }}</textarea>
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
                        @if( $details->status =='Chờ xác nhận')
                        
                        <button class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-check"></i>
                            Xác nhận đặt bàn
                        </button>
                        
                        @elseif($details->status == 'Đã xác nhận')
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-table"></i>
                            Cập Nhật
                        </button>
                        @endif
                        <button class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Hủy đặt bàn
                        </button>
                        
                        <!-- <button @click="editBooking()" 
                                class="w-full bg-gray-500 hover:bg-gray-600 text-white py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i>
                            Chỉnh sửa
                        </button> -->
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
</form>
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
</body>
<script>
        function bookingDetailManager() {
            return {
                showQuickActions: false,
                notification: {
                    show: false,
                    message: '',
                    type: 'success'
                },
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
}}
        
</script>
@endsection