<div class="w-72 bg-white rounded-md border border-gray-200 shadow-sm">
    <div class="flex flex-col p-4 space-y-2">
        <!-- Header -->
        <!-- Sidebar Items -->
        <div class="space-y-1">
            @if (session('staff_role') === 'Quản Lí')
            <!-- Dashboard -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer  hover:bg-gray-300 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house w-4 h-4 text-gray-500 mr-2"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Nhân Viên -->
            <div class="py-2 px-3 rounded-md text-gray-700 cursor-pointer  hover:bg-gray-300 hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200"
              >
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.staff') }}">
                        <i class="fa-solid fa-clipboard-user w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Nhân viên</span>
                        </a>
                    </div>
                 
                </div>
            </div>
            

            <!-- Khách Hàng -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.user.list') }}">
                        <i class="fa-solid fa-user-tie w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Khách Hàng</span>
                    </a>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.order') }}">
                        <i class="fa-solid fa-shopping-cart w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Đơn Hàng</span>
                    </a>
                </div>
            </div>

            <!-- Sản phẩm -->
            <div class="py-2 px-3 rounded-md text-gray-700 cursor-pointer  hover:bg-gray-300 hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200"
                onclick="toggleDropdown('productDropdown', this)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-burger w-4 h-4 text-gray-500 mr-1"></i>
                        <span class="text-sm">Sản Phẩm</span>
                    </div>
                    <i class="fa-solid fa-chevron-down w-4 h-4 text-gray-500 transition-transform duration-300"></i>
                </div>
            </div>
            <div id="productDropdown"
                class="pl-6 space-y-1 hidden transform scale-y-0 opacity-0 transition-all duration-300 origin-top">
                <div class="py-1.5 px-2 rounded-md text-gray-700 cursor-pointer hover:bg-gray-300 hover:text-teal-500 hover:scale-105 transition-all duration-200 opacity-0 animate-fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.product') }}">
                            <i class="fa-solid fa-bowl-food w-4 h-4 mr-2"></i>
                            <span class="text-sm">Món Ăn</span>
                        </a>
                    </div>
                </div>
                <div class="py-1.5 px-2 rounded-md text-gray-700 cursor-pointer hover:bg-gray-300 hover:text-teal-500 hover:scale-105 transition-all duration-200 opacity-0 animate-fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.product.category.index') }}">
                            <i class="fa-solid fa-plus w-4 h-4 mr-2"></i>
                            <span class="text-sm">Danh mục món ăn</span>
                        </a>
                    </div>
                </div>
                <div class="py-1.5 px-2 rounded-md text-gray-700 cursor-pointer hover:bg-gray-300 hover:text-teal-500 hover:scale-105 transition-all duration-200 opacity-0 animate-fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.product.combo.index') }}">
                        <i class="fa-solid fa-list w-4 h-4 mr-2"></i>
                        <span class="text-sm">Combo món ăn</span>
                        </a>
                    </div>
                </div>
            </div>  

            <!-- Đánh Giá -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.rate') }}">
                        <i class="fa-solid fa-comments w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">{{ __('messages.rate') }}</span>
                    </a>
                </div>
            </div>


            <!-- Voucher -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.voucher') }}">
                        <i class="fa-solid fa-ticket w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Voucher</span>
                    </a>

                </div>
            </div>

            <!-- Tin Tức -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.blog') }}">
                        <i class="fa-solid fa-newspaper w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">{{ __('messages.blog') }}</span>
                    </a>
                </div>
            </div>

            <!-- Bàn -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="">
                        <i class="fa-solid fa-couch w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">{{ __('messages.table') }}</span>
                    </a>
                </div>
            </div>

            <!-- Trợ Giúp -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.help') }}">
                        <i class="fa-solid fa-circle-question w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">{{ __('messages.help') }}</span>
                    </a>
                </div>
            </div>

            <!-- Booking -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.booktable') }}">
                        <i class="fa-solid fa-utensils w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">{{ __('messages.booking') }}</span>
                    </a>
                </div>
            </div>


            <!-- Loại Thanh toán -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.rate') }}">
                        <i class="fa-solid fa-credit-card w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Loại Thanh Toán</span>
                    </a>
                </div>
            </div>

            <!-- Thông báo -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="">
                        <i class="fa-solid fa-bell w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Thông báo</span>
                    </a>
                </div>
            </div>

            <!-- Thông tin -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.info') }}">
                        <i class="fa-solid fa-circle-info w-4 h-4 text-gray-500 mr-2"></i>
                        <span class="text-sm">Thông Tin</span>
                    </a>
                </div>
            </div>
            @elseif (session('staff_role') === 'Thu Ngân')
                 <div
                    class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.cashier') }}">
                            <i class="fa-solid fa-comments w-4 h-4 text-gray-500 mr-2"></i>
                            <span class="text-sm">Quản Lí Doanh Thu</span>
                        </a>
                    </div>
                </div>


                <!-- Đon hàng -->
                <div
                    class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.order') }}">
                            <i class="fa-solid fa-shopping-cart w-4 h-4 text-gray-500 mr-2"></i>
                            <span class="text-sm">Quản Lí Đơn Hàng</span>
                        </a>
                    </div>
                </div>
             @endif
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }
    </style>

    <script>
        function toggleDropdown(dropdownId, element) {
            const dropdown = document.getElementById(dropdownId);
            const chevron = element.querySelector('.fa-chevron-down');
            const allDropdowns = document.querySelectorAll('.transform');

            // Close all other dropdowns and reset their chevrons
            allDropdowns.forEach(dd => {
                if (dd.id !== dropdownId && !dd.classList.contains('hidden')) {
                    dd.classList.add('hidden', 'scale-y-0', 'opacity-0');
                    dd.classList.remove('scale-y-100', 'opacity-100');
                    const otherChevron = dd.previousElementSibling.querySelector('.fa-chevron-down');
                    if (otherChevron) otherChevron.classList.remove('rotate-180');
                }
            });

            // Toggle the target dropdown and chevron
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
                dropdown.classList.add('scale-y-100', 'opacity-100');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                dropdown.classList.remove('scale-y-100', 'opacity-100');
                dropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }
    </script>
</div>