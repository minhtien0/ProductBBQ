<header>
    <div class="flex items-center justify-between w-full px-4 py-2 bg-white shadow">
        <!-- Logo - Bên trái -->
        <div class="flex-shrink-0">
            <a> <img class="h-10 w-20" src="{{ asset('img/logo1.jpg') }}"> </a>
        </div>

        <!-- Tìm Kiếm - Ở giữa -->
        <div class="flex-grow max-w-lg mx-auto">
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
        </div>

        <!-- Thông Tin - Bên phải -->
        <div class="flex items-center space-x-2">
            <div class="relative inline-block">
                <!-- Nút lá cờ để toggle dropdown -->
                <button id="languageToggle" class="focus:outline-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg" alt="Tiếng Việt"
                        class="w-8 h-6 cursor-pointer">
                </button>

                <!-- Dropdown menu - mặc định ẩn -->
                <div id="languageDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden">
                    <div class="py-1">
                        <!-- Tiếng Anh -->
                        <a href="{{ route('user.change-language', 'en') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Flag_of_the_United_Kingdom_%283-5%29.svg"
                                alt="English" class="w-8 h-6 mr-3">
                            <span>Tiếng Anh</span>
                        </a>

                        <!-- Tiếng Nhật -->
                        <a href="{{ route('user.change-language', 'ja') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Flag_of_Japan.svg" alt="日本語"
                                class="w-8 h-6 mr-3">
                            <span>Tiếng Nhật</span>
                        </a>

                        <!-- Tiếng Việt -->
                        <a href="{{ route('user.change-language', 'vi') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg" alt="日本語"
                                class="w-8 h-6 mr-3">
                            <span>Tiếng Việt</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Notification Bell and Dropdown -->
            <div class="relative inline-block">
                <div id="notificationBell" class="cursor-pointer hover:bg-gray-200 p-2 rounded-md w-10 text-center">
                    <i class="fa-solid fa-bell text-gray-500"></i>
                </div>
                <!-- Notification Dropdown -->
                <div id="notificationDropdown"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg transform scale-y-0 opacity-0 transition-all duration-300 origin-top z-60 hidden max-h-96 overflow-y-auto">
                    <div class="p-3">
                        <h2 class="text-base font-semibold mb-3">Notifications</h2>
                        <!-- Notification Items -->
                        <div class="space-y-3">
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Bonnie Green</span>: "Hey, what's
                                        up? All set for the presentation?"</p>
                                    <p class="text-xs text-gray-500">a few moments ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Jese Leos</span> and 5 others
                                        started following you.</p>
                                    <p class="text-xs text-gray-500">10 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Joseph McFall</span> and 141
                                        others love your story. See it and view more stories.</p>
                                    <p class="text-xs text-gray-500">44 minutes ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Leslie Livingston</span>
                                        mentioned you in a comment: @bonnie.green what do you say?</p>
                                    <p class="text-xs text-gray-500">1 hour ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Robert Brown</span> posted a new
                                        video: Glassmorphism - learn how to implement the new design trend.</p>
                                    <p class="text-xs text-gray-500">3 hours ago</p>
                                </div>
                            </div>
                            <!-- Additional items to test scrollbar -->
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">Anna Smith</span> shared your
                                        post.</p>
                                    <p class="text-xs text-gray-500">4 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <img src="{{ asset('img/user.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="text-sm"><span class="font-semibold">John Doe</span> liked your
                                        comment.</p>
                                    <p class="text-xs text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="#" class="text-blue-600 hover:underline text-sm">View all</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative inline-block">
                <div id="userToggle"
                    class="flex items-center cursor-pointer space-x-1 hover:bg-gray-200 p-2 rounded-md h-10">
                    <i class="fa-solid fa-circle-user text-gray-500"></i>
                    <span class="text-sm text-gray-500">Đăng nhập</span>
                </div>
                <div id="userDropdown"
                    class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg transform scale-y-0 opacity-0 transition-all duration-300 origin-top z-70 hidden">
                    <div class="p-3">
                        <div class="mb-3">
                            <p class="text-sm font-semibold">Admin Super</p>
                            <p class="text-xs text-gray-500">superadmin@gmail.com</p>
                        </div>
                        <div class="space-y-2">
                            <a href="#"
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-user text-red-500 w-4"></i>
                                <span>Thông tin học viên</span>
                            </a>
                            <a href="#"
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-tachometer-alt text-red-500 w-4"></i>
                                <span>Dashboard tổng quan</span>
                            </a>
                            <a href="{{ route('staff.dashboard') }}"
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-chalkboard-teacher text-red-500 w-4"></i>
                                <span>Quyền Nhân Viên</span>
                            </a>
                            <a href=""
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-sign-out-alt text-red-500 w-4"></i>
                                <span>Đăng xuất</span>
                            </a>
                            <div
                                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                                <i class="fa-solid fa-moon text-yellow-500 w-4"></i>
                                <span>Night mode</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="relative inline-block">
                <div id="settingsToggle" class="cursor-pointer hover:bg-gray-200 p-2 rounded-md w-10 text-center">
                    <i class="fa-solid fa-gear text-gray-500"></i>
                </div>
                <div id="settingsDropdown"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg transform scale-y-0 opacity-0 transition-all duration-300 origin-top z-80 hidden">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-lg font-semibold text-teal-500">Dashboard Configurator</h2>

                        </div>
                        <p class="text-sm text-gray-500 mb-4">See our dashboard options.</p>

                        <!-- Sidenav Colors -->
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Sidenav Colors</h3>
                            <div class="flex space-x-2">
                                <div class="w-6 h-6 rounded-full bg-white border border-gray-300"></div>
                                <div class="w-6 h-6 rounded-full bg-black"></div>
                                <div class="w-6 h-6 rounded-full bg-green-500"></div>
                                <div class="w-6 h-6 rounded-full bg-orange-500"></div>
                                <div class="w-6 h-6 rounded-full bg-red-500"></div>
                                <div class="w-6 h-6 rounded-full bg-pink-500"></div>
                            </div>
                        </div>

                        <!-- Sidenav Types -->
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Sidenav Types</h3>
                            <p class="text-xs text-gray-500 mb-2">Choose between 3 different sidenav types.</p>
                            <div class="flex space-x-2">
                                <button
                                    class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium">DARK</button>
                                <button
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium">TRANSPARENT</button>
                                <button
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium">WHITE</button>
                            </div>
                        </div>

                        <!-- Navbar Fixed -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-700">Navbar Fixed</span>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-teal-500 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                                </div>
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-2">
                            <a href="#"
                                class="block px-4 py-2 bg-black text-white text-center rounded-md text-sm font-medium">FREE
                                DOWNLOAD</a>
                            <a href="#"
                                class="block px-4 py-2 border border-gray-300 text-gray-700 text-center rounded-md text-sm font-medium">VIEW
                                DOCUMENTATION</a>
                            <a href="#"
                                class="block px-4 py-2 border border-gray-300 text-gray-700 text-center rounded-md text-sm font-medium">MATERIAL
                                TAILWIND PRO</a>
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-center space-x-2 mt-4">
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span class="text-sm text-gray-700">402+ STARS</span>
                            <i class="fa-brands fa-github text-gray-700"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle language dropdown
        document.getElementById('languageToggle').addEventListener('click', function () {
            var dropdown = document.getElementById('languageDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close language dropdown when clicking outside
        window.addEventListener('click', function (e) {
            if (!document.getElementById('languageToggle').contains(e.target) &&
                !document.getElementById('languageDropdown').contains(e.target)) {
                document.getElementById('languageDropdown').classList.add('hidden');
            }
        });

        // Toggle notification dropdown
        const bell = document.getElementById('notificationBell');
        const dropdown = document.getElementById('notificationDropdown');

        bell.addEventListener('click', () => {
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
                dropdown.classList.add('scale-y-100', 'opacity-100');
            } else {
                dropdown.classList.remove('scale-y-100', 'opacity-100');
                dropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });

        // Close notification dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('scale-y-100', 'opacity-100');
                dropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });

        // Toggle user dropdown
        const userToggle = document.getElementById('userToggle');
        const userDropdown = document.getElementById('userDropdown');

        userToggle.addEventListener('click', () => {
            if (userDropdown.classList.contains('hidden')) {
                userDropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
                userDropdown.classList.add('scale-y-100', 'opacity-100');
            } else {
                userDropdown.classList.remove('scale-y-100', 'opacity-100');
                userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });

        // Close user dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!userToggle.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.remove('scale-y-100', 'opacity-100');
                userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });

        // Toggle settings dropdown
        const settingsToggle = document.getElementById('settingsToggle');
        const settingsDropdown = document.getElementById('settingsDropdown');

        settingsToggle.addEventListener('click', () => {
            if (settingsDropdown.classList.contains('hidden')) {
                settingsDropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
                settingsDropdown.classList.add('scale-y-100', 'opacity-100');
            } else {
                settingsDropdown.classList.remove('scale-y-100', 'opacity-100');
                settingsDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });

        // Close settings dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!settingsToggle.contains(event.target) && !settingsDropdown.contains(event.target)) {
                settingsDropdown.classList.remove('scale-y-100', 'opacity-100');
                settingsDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
            }
        });
    </script>
</header>