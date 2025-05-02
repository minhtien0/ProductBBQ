<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    @include('layouts.header')
    <div class="flex">
        <!-- Sidebar -->
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
        <!-- Content -->
        <div class=" flex-1 p-3 inline-block">
            <!-- Breadcrumb -->
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="#"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Flowbite</span>
                        </div>
                    </li>
                </ol>
            </nav>
            @yield('contentstaff')
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>