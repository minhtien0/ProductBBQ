@extends('admin.index')
@section('content')
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-blue-800 text-center mb-4">THỐNG KÊ NĂM 2025</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-chalkboard-teacher"></i></div>
                <p class="text-gray-600">Lớp học Elearning</p>
                <p class="text-2xl font-bold text-blue-600">{{ $elearningClasses ?? 237 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-users"></i></div>
                <p class="text-gray-600">Lớp học trực trung</p>
                <p class="text-2xl font-bold text-blue-600">{{ $onlineClasses ?? 161 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-blue-600"><i class="fas fa-check"></i></div>
                <p class="text-gray-600">Kỳ thi đã tổ chức</p>
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
                <h2 class="text-lg font-semibold mb-2">Lượt truy cập hàng tháng</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full">
                        <canvas id="monthlyAccessChart"></canvas>
                    </div>
                </div>
                <p class="text-center mt-2">Lượt truy cập: {{ $totalMonthlyAccess ?? 459 }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-2">Số lượt truy cập theo thiết bị</h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="w-full">
                        <canvas id="deviceAccessChart"></canvas>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <p>Chrome: {{ $chromePercentage ?? '84.79%' }}</p>
                    <p>Edge: {{ $edgePercentage ?? '8.89%' }}</p>
                    <p>Firefox: {{ $firefoxPercentage ?? '3.16%' }}</p>
                    <p>Opera: {{ $operaPercentage ?? '2.02%' }}</p>
                    <p>Safari: {{ $safariPercentage ?? '1.14%' }}</p>
                </div>
                <p class="text-center mt-2">Số nhân viên tại đây: 1 Nhân viên</p>
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