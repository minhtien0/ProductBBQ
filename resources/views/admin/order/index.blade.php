@extends('admin.index')
@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Quản Lý Đơn Hàng</h1>
                        <p class="text-gray-600 mt-1">Theo dõi và xử lý các đơn hàng</p>
                    </div>
                    
                    <!-- Order Type Navigation -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.order.onsite') }}" 
                           class="group relative inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.order.onsite*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-200 hover:bg-blue-50 hover:border-blue-200' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-5a2 2 0 012-2h4a2 2 0 012 2v5"></path>
                            </svg>
                            Đơn Tại Quán
                            @if(request()->routeIs('admin.order.onsite*'))
                                <div class="absolute -bottom-1 left-0 right-0 h-1 bg-white rounded-full opacity-60"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.order.bringback') }}" 
                           class="group relative inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.order.bringback*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-200 hover:bg-orange-50 hover:border-orange-200' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M8 13l-4-2m0 0l4-2m-4 2v8"></path>
                            </svg>
                            Đơn Mang Về
                            @if(request()->routeIs('admin.order.bringback*'))
                                <div class="absolute -bottom-1 left-0 right-0 h-1 bg-white rounded-full opacity-60"></div>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="py-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                @yield('content_order')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select All Functionality
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.rowCheckbox');

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            }

            // Add smooth transitions to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection