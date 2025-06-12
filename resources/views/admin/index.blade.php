<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
</head>

<body class="bg-gray-100" @if(session('success')) data-success="{{ session('success') }}" @elseif(session('error'))
data-error="{{ session('error') }}" @endif>
    <!-- Header -->
    @include('layouts.admin.header')
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.admin.sidebar')
        <!-- Content -->
        <div class=" flex-1 h-full p-3 inline-block">
            <!-- Breadcrumb -->
            @yield('content')
        </div>
    </div>

</body>

</html>