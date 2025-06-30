<script src="https://cdn.tailwindcss.com"></script>
<header>
    <div class="flex items-center justify-between  px-4 py-2 bg-white shadow">
        <!-- Logo - Bên trái -->
        <div class="flex-shrink-0 w-20 h-10">
            <a href="{{ route('views.index') }}"> <img class="h-10 w-20" src="{{ asset('img/logoadmin.jpg') }}"> </a>
        </div>

        <!-- Tìm Kiếm - Ở giữa -->
      <!--   <div class="flex-grow max-w-lg mx-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" placeholder="Search"
                    class="w-full py-1 px-10 text-sm text-gray-900 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-gray-300">
            </div>
        </div> -->

        <!-- Thông Tin - Bên phải -->
        <div class="flex items-center space-x-2">
            <!-- User Dropdown -->
            <div class="relative inline-block">
                <div id="userToggle"
                    class="flex items-center cursor-pointer space-x-1 hover:bg-gray-200 p-2 rounded-md h-10">
                    <i class="fa-solid fa-circle-user text-gray-500"></i>
                    <span class="text-sm text-gray-500">{{ session('staff_name') }}</span>
                </div>
                <div id="userDropdown"
                    class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg transform scale-y-0 opacity-0 transition-all duration-300 origin-top z-[999] hidden">
                    <div class="p-3">
                        <div class="mb-3">
                            <p class="text-sm font-semibold">{{ session('staff_name') }}</p>
                            <p class="text-xs text-gray-500">{{ session('staff_email') }}</p>
                        </div>
                        <div class="space-y-2">           
                            @if (session('staff_role') === 'Quản Lí')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-tachometer-alt text-red-500 w-4"></i>
                                    <span>Dashboard tổng quan</span>
                                </a>
                                <a href=""
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-chalkboard-teacher text-red-500 w-4"></i>
                                    <span>Quyền Nhân Viên</span>
                                </a>
                                 <a href="{{ route('admin.cashier') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-chalkboard-teacher text-red-500 w-4"></i>
                                    <span>Quyền Thu Ngân</span>
                                </a>
                                <a href="{{ route('views.deskmanage') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-bell-concierge text-red-500 w-4"></i>
                                    
                                    <span>Quản Lí Order</span>
                                </a>
                            @elseif (session('staff_role') === 'Nhân viên')
                                {{-- Chỉ hiển thị với Nhân viên --}}
                                <a href="{{ route('views.deskmanage') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-bell-concierge text-red-500 w-4"></i>
                                    <span>Quản Lí Order</span>
                                </a>
                             @elseif (session('staff_role') === 'Thu Ngân')
                                {{-- Chỉ hiển thị với Nhân viên --}}
                                <a href="{{ route('admin.cashier') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-chalkboard-teacher text-red-500 w-4"></i>
                                    <span>Quyền Thu Ngân</span>
                                </a>
                                <a href="{{ route('views.deskmanage') }}"
                                    class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                    <i class="fa-solid fa-bell-concierge text-red-500 w-4"></i>
                                    
                                    <span>Quản Lí Order</span>
                                </a>
                            @endif
                            
                            {{-- Đăng xuất (ai cũng có thể thấy) --}}
                            <a href="{{ route('logout') }}"
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-sign-out-alt text-red-500 w-4"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');

        if (userToggle && userDropdown) {
            userToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                if (userDropdown.classList.contains('hidden')) {
                    userDropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
                    userDropdown.classList.add('scale-y-100', 'opacity-100');
                } else {
                    userDropdown.classList.remove('scale-y-100', 'opacity-100');
                    userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
                }
            });

            // Đóng dropdown khi click ra ngoài
            document.addEventListener('click', function (event) {
                if (!userToggle.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.remove('scale-y-100', 'opacity-100');
                    userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
                }
            });
        }
    });
    </script>
</header>