@extends('admin.index')
@section('content')

    <body class="bg-gray-100 font-sans">
        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold text-blue-800 text-center mb-6">THỐNG KÊ NĂM 2025</h1>

            <!-- Overview Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow text-center">
                    <div class="text-green-500"><i class="fas fa-dollar-sign"></i></div>
                    <p class="text-gray-600">Doanh Thu</p>
                    <p class="text-2xl font-bold text-green-500"> {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow text-center">
                    <div class="text-blue-500"><i class="fas fa-users"></i></div>
                    <p class="text-gray-600">Khách Hàng</p>
                    <p class="text-2xl font-bold text-blue-500">{{ $totalUser }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow text-center">
                    <div class="text-yellow-500"><i class="fas fa-shopping-cart"></i></div>
                    <p class="text-gray-600">Đơn Hàng</p>
                    <p class="text-2xl font-bold text-yellow-500">{{ $totalOrder }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow text-center">
                    <div class="text-purple-500"><i class="fas fa-user-tie"></i></div>
                    <p class="text-gray-600">Nhân Viên</p>
                    <p class="text-2xl font-bold text-purple-500">{{ $totalStaff }}</p>
                </div>
            </div>

            <!-- Detailed Charts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Monthly Revenue -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Doanh Thu Hàng Tháng</h2>
                    <select id="filterYear" class="border p-2 rounded mb-2">
                        @for ($i = 2025; $i <= 2030; $i++)
                            <option value="{{ $i }}">Năm {{ $i }}</option>
                        @endfor
                    </select>
                    <canvas id="monthlyRevenueChart" height="200"></canvas>
                </div>

                <!-- Employee Performance -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Top Nhân Viên Xuất Sắc</h2>
                    <select id="filterMonth" class="border p-2 rounded mb-2">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">Tháng {{ $i }}</option>
                        @endfor
                    </select>
                    <canvas id="topEmployeeChart" height="200"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Customer Growth -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Khách Hàng Theo Tháng</h2>
                    <select id="filterYearCustomers" class="border p-2 rounded mb-2">
                        @for ($i = 2025; $i <= 2030; $i++)
                            <option value="{{ $i }}">Năm {{ $i }}</option>
                        @endfor
                    </select>
                    <canvas id="newCustomersChart" height="180"></canvas>
                </div>

                <!-- Ratings Distribution -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Phân Bố Đánh Giá</h2>
                    <select id="filterMonthRate" class="border p-2 rounded mb-2">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>Tháng {{ $i }}</option>
                        @endfor
                    </select>
                    <canvas id="ratingsChart" height="180"></canvas>
                </div>

                <!-- Highest Revenue Products -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Sản Phẩm Doanh Thu Cao Nhất</h2>
                    <select id="filterMonthProduct" class="border p-2 rounded mb-2">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">Tháng {{ $i }}</option>
                        @endfor
                    </select>
                    <canvas id="topProductsChart" height="180"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            // Monthly Revenue Chart
            const monthlyChartCtx = document.getElementById('monthlyRevenueChart').getContext('2d');

            let monthlyChart = new Chart(monthlyChartCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Doanh Thu (Triệu đồng)',
                        data: {!! json_encode($monthlyRevenue) !!},
                        backgroundColor: 'rgba(59,130,246,0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return value + ' triệu';
                                }
                            }
                        }
                    }
                }
            });

            document.getElementById('filterYear').addEventListener('change', function () {
                const selectedYear = this.value;
                fetch(`/admin/stats/monthly-revenue?year=${selectedYear}`)
                    .then(res => res.json())
                    .then(data => {
                        monthlyChart.data.labels = data.labels;
                        monthlyChart.data.datasets[0].data = data.data;
                        monthlyChart.update();
                    });
            });


            // Employee Performance Chart
            const employeeChartCtx = document.getElementById('topEmployeeChart').getContext('2d');

            let employeeChart = new Chart(employeeChartCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($employeeLabels) !!},
                    datasets: [{
                        label: 'Doanh Thu (Triệu đồng)',
                        data: {!! json_encode($employeeRevenues) !!},
                        backgroundColor: 'rgba(99,102,241,0.7)'
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    scales: {
                        x: { beginAtZero: true }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.raw + ' triệu';
                                }
                            }
                        }
                    }
                }
            });

            document.getElementById('filterMonth').addEventListener('change', function () {
                const selectedMonth = this.value;
                fetch(`/admin/stats/employees?month=${selectedMonth}`)
                    .then(res => res.json())
                    .then(data => {
                        employeeChart.data.labels = data.labels;
                        employeeChart.data.datasets[0].data = data.data;
                        employeeChart.update();
                    });
            });

            // New Customers Chart
            const newCustomersCtx = document.getElementById('newCustomersChart').getContext('2d');

            let newCustomersChart = new Chart(newCustomersCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Khách Hàng Mới',
                        data: {!! json_encode($newCustomers) !!},
                        borderColor: 'rgba(16,185,129,1)',
                        backgroundColor: 'rgba(16,185,129,0.2)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            document.getElementById('filterYearCustomers').addEventListener('change', function () {
                const selectedYear = this.value;
                fetch(`/admin/stats/new-customers?year=${selectedYear}`)
                    .then(res => res.json())
                    .then(data => {
                        newCustomersChart.data.labels = data.labels;
                        newCustomersChart.data.datasets[0].data = data.data;
                        newCustomersChart.update();
                    });
            });


            // Ratings Distribution Chart
            const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
            let ratingsChart = new Chart(ratingsCtx, {
                type: 'pie',
                data: {
                    labels: ['1⭐', '2⭐', '3⭐', '4⭐', '5⭐'],
                    datasets: [{
                        data: {!! json_encode($ratingsDistribution) !!},
                        backgroundColor: ['#f87171', '#fb923c', '#facc15', '#34d399', '#60a5fa']
                    }]
                },
                options: { responsive: true }
            });

            document.getElementById('filterMonthRate').addEventListener('change', function () {
                const month = this.value;
                fetch(`/admin/stats/ratings-distribution?month=${month}`)
                    .then(res => res.json())
                    .then(data => {
                        ratingsChart.data.datasets[0].data = data.data;
                        ratingsChart.update();
                    });
            });



            // Top Products Revenue Chart
            const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
let topProductsChart = new Chart(topProductsCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($productLabels) !!},
        datasets: [{
            data: {!! json_encode($productRevenue) !!},
            backgroundColor: ['#3b82f6', '#10b981', '#ef4444', '#f59e0b', '#6366f1']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ': ' + context.raw + ' triệu';
                    }
                }
            }
        }
    }
});

document.getElementById('filterMonthProduct').addEventListener('change', function () {
    const month = this.value;
    fetch(`/admin/stats/top-products?month=${month}`)
        .then(res => res.json())
        .then(data => {
            topProductsChart.data.labels = data.labels;
            topProductsChart.data.datasets[0].data = data.data;
            topProductsChart.update();
        });
});

        </script>
    </body>
@endsection