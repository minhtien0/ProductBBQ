<div class="w-72 bg-white rounded-md border border-gray-200 shadow-sm">
    <div class="flex flex-col p-4 space-y-2">
        <!-- Header -->
        <!-- Sidebar Items -->
        <div class="space-y-1">
            <!-- Dashboard -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer  hover:bg-gray-300 hover:bg-gradient-to-r hover:from-gray-300 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-house w-4 h-4 text-gray-500"></i>
                        <span class="text-sm">Dashboard</span>
                    </div>
                </div>
            </div>
            <span class="font-bold">Gruop 1</span>
            <!-- Câu hỏi -->
            <div class="py-2 px-3 rounded-md text-gray-700 cursor-pointer  hover:bg-gray-300 hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200"
                onclick="toggleDropdown('questionDropdown', this)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-question-circle w-4 h-4 text-gray-500"></i>
                        <span class="text-sm">Câu hỏi</span>
                    </div>
                    <i class="fa-solid fa-chevron-down w-4 h-4 text-gray-500 transition-transform duration-300"></i>
                </div>
            </div>
            <div id="questionDropdown"
                class="pl-6 space-y-1 hidden transform scale-y-0 opacity-0 transition-all duration-300 origin-top">
                <div class="py-1.5 px-2 rounded-md text-gray-700 cursor-pointer hover:bg-gray-300 hover:text-teal-500 hover:scale-105 transition-all duration-200 opacity-0 animate-fade-in"
                    style="animation-delay: 0.1s;">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-plus w-4 h-4"></i>
                        <span class="text-sm">Thêm Câu hỏi</span>
                    </div>
                </div>
                <div class="py-1.5 px-2 rounded-md text-gray-700 cursor-pointer hover:bg-gray-300 hover:text-teal-500 hover:scale-105 transition-all duration-200 opacity-0 animate-fade-in"
                    style="animation-delay: 0.2s;">
                    <div class="flex items-center space-x-2">
                        <i class="fa-solid fa-list w-4 h-4"></i>
                        <span class="text-sm">DS Câu hỏi</span>
                    </div>
                </div>
            </div>

            <!-- Thống Báo -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:bg-gray-300 hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-bell w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">Thống Báo</span>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-shopping-cart w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">Đơn hàng</span>
                </div>
            </div>

            <!-- Sản phẩm -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-box w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">Sản phẩm</span>
                </div>
            </div>
            <span>Group 2</span>
            <!-- NVgT truyển -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-user-tie w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">NVgT truyển</span>
                </div>
            </div>

            <!-- QL Khách hàng -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-users w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">QL Khách hàng</span>
                </div>
            </div>

            <!-- QL Quản trị -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-user-shield w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">QL Quản trị</span>
                </div>
            </div>

            <!-- Sliders -->
            <div
                class="py-2 px-3 rounded-md text-gray-700 cursor-pointer hover:bg-gradient-to-r hover:from-gray-100 hover:to-gray-50 hover:scale-105 hover:shadow-sm transition-all duration-200">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-sliders-h w-4 h-4 text-gray-500"></i>
                    <span class="text-sm">Sliders</span>
                </div>
            </div>
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