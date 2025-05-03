@extends('staff.index')
@section('contentstaff')
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto mt-3">
        <!-- Header -->
        <div class="bg-blue-700 p-6 text-white rounded-lg shadow-md">
            <h1 class="text-3xl font-bold">Thống Kê Hoạt Động Giờ Làm Năm 2025</h1>
            <p class="mt-2">Chúc bạn một ngày làm việc hiệu quả nhất!</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-green-500 p-6 rounded-lg shadow-md text-center text-white">
                <i class="fas fa-check-circle text-3xl mb-2"></i>
                <p class="text-4xl font-bold">{{ $totalTeachingHours ?? 8 }}</p>
                <p class="text-lg">Tổng số giờ làm</p>
            </div>
            <div class="bg-red-300 p-6 rounded-lg shadow-md text-center text-white">
                <i class="fas fa-chalkboard text-3xl mb-2"></i>
                <p class="text-4xl font-bold">{{ $classesTaught ?? 121 }}</p>
                <p class="text-lg">Số lớp đã tăng ca</p>
            </div>
            <div class="bg-purple-500 p-6 rounded-lg shadow-md text-center text-white">
                <i class="fas fa-clock text-3xl mb-2"></i>
                <p class="text-4xl font-bold">{{ $classesNotTaught ?? 0 }}</p>
                <p class="text-lg">Số ca còn thiếu</p>
            </div>
        </div>

        <!-- Teaching Process Chart -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Thống kê số giờ làm của tôi</h2>
            <div class="h-80">
                <canvas id="teachingChart"></canvas>
            </div>
        </div>

        <!-- Calendar Placeholder -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Lịch giảng</h2>
            <p class="text-center text-gray-600">Lịch giảng dạy sẽ được hiển thị ở đây (có thể tích hợp FullCalendar hoặc thư viện tương tự)</p>
        </div>
    </div>

    <!-- Chart.js and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Teaching Process Chart
        const teachingCtx = document.getElementById('teachingChart').getContext('2d');
        new Chart(teachingCtx, {
            type: 'line',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Giờ đã làm',
                    data: {{ json_encode($teachingData ?? [50, 27, 21, 10, 0, 0, 0, 0, 0, 0, 0, 0]) }},
                    borderColor: 'rgba(0, 128, 128, 1)', // Teal
                    backgroundColor: 'rgba(0, 128, 128, 0.2)',
                    fill: true,
                    tension: 0.1
                }, {
                    label: 'Giờ tăng ca',
                    data: {{ json_encode($untaughtData ?? [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]) }},
                    borderColor: 'rgba(255, 215, 0, 1)', // Yellow
                    backgroundColor: 'rgba(255, 215, 0, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 60,
                        ticks: {
                            stepSize: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
@endsection
