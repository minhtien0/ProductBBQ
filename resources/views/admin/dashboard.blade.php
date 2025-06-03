@extends('admin.index')
@section('content')
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-blue-800 text-center mb-4">THỐNG KÊ NĂM 2025</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-chalkboard-teacher"></i></div>
                <p class="text-gray-600">Doanh thu</p>
                <p class="text-2xl font-bold text-blue-600">{{ $elearningClasses ?? 237 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-users"></i></div>
                <p class="text-gray-600">Khách hàng</p>
                <p class="text-2xl font-bold text-blue-600">{{ $onlineClasses ?? 161 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-check"></i></div>
                <p class="text-gray-600">Đánh giá</p>
                <p class="text-2xl font-bold text-blue-600">{{ $examsHeld ?? 68 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-red-600"><i class="fas fa-users"></i></div>
                <p class="text-gray-600">Nhân viên</p>
                <p class="text-2xl font-bold text-red-600">{{ $staff ?? 7109 }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Doanh thu hàng tháng</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full">
                        <canvas id="monthlyAccessChart"></canvas>
                    </div>
                </div>
                <p class="text-center mt-2">Tổng Doanh Thu: {{ $totalMonthlyAccess ?? 459 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Số Lượt Đánh Giá</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full">
                        <canvas id="deviceAccessChart"></canvas>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <p>1 Sao: {{ $chromePercentage ?? '84.79%' }}</p>
                    <p>2 Sao: {{ $edgePercentage ?? '8.89%' }}</p>
                    <p>3 Sao: {{ $firefoxPercentage ?? '3.16%' }}</p>
                    <p>4 Sao: {{ $operaPercentage ?? '2.02%' }}</p>
                    <p>5 Sao: {{ $safariPercentage ?? '1.14%' }}</p>
                </div>
                <p class="text-center mt-2">Trung Bình Đánh Giá: 3,5</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Access Chart
        const monthlyAccessCtx = document.getElementById('monthlyAccessChart').getContext('2d');
        new Chart(monthlyAccessCtx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Lượt truy cập',
                    data: {{ json_encode($monthlyData ?? [180, 216, 360, 393, 337, 380, 432, 459, 0, 0, 0, 0]) }},
                    fill: true,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Device Access Chart
        const deviceAccessCtx = document.getElementById('deviceAccessChart').getContext('2d');
        new Chart(deviceAccessCtx, {
            type: 'doughnut',
            data: {
                labels: ['Desktop', 'Mobile'],
                datasets: [{
                    data: {{ json_encode([$desktopAccess ?? 1385, $mobileAccess ?? 101]) }},
                    backgroundColor: ['rgba(59, 130, 246, 0.8)', 'rgba(239, 68, 68, 0.8)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
@endsection