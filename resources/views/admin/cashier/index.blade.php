@extends('admin.index')
@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 text-gray-800 mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>
                            Quản lý Doanh thu
                        </h1>
                        <p class="text-muted mb-0">Theo dõi và phân tích doanh thu chi tiết</p>
                    </div>
                    <div class="d-flex gap-2">
                        <!--  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <i class="fas fa-download me-1"></i> Xuất báo cáo
                            </button>
                            <button class="btn btn-primary" onclick="refreshData()">
                                <i class="fas fa-sync-alt me-1"></i> Làm mới
                            </button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng doanh thu
                                </div>
                                
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalRevenue">
                                    {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ
                                </div>
                                <div class="{{ $percentChange >= 0 ? 'text-success' : 'text-danger' }} text-xs mt-1">
                                    <i class="fas {{ $percentChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                    {{ $percentChange >= 0 ? '+' : '' }}{{ number_format($percentChange, 1) }}% so với tháng
                                    trước
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Số đơn hàng
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalOrders">
                                    {{ number_format($totalOrders, 0, ',', '.') }}
                                </div>
                                <div class="{{ $orderPercentChange >= 0 ? 'text-success' : 'text-danger' }} text-xs mt-1">
                                    <i class="fas {{ $orderPercentChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                    {{ $orderPercentChange >= 0 ? '+' : '' }}{{ number_format($orderPercentChange, 1) }}% so
                                    với tháng trước
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Doanh thu trung bình
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgOrderValue">
                                    {{ number_format($avgRevenuePerDay, 0, ',', '.') }} VNĐ
                                </div>
                                <div class="{{ $avgPercentChange >= 0 ? 'text-info' : 'text-danger' }} text-xs mt-1">
                                    <i class="fas {{ $avgPercentChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                    {{ $avgPercentChange >= 0 ? '+' : '' }}{{ number_format($avgPercentChange, 1) }}% so với
                                    tháng trước
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Áp Dụng Khuyến Mãi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="estimatedProfit">
                                    {{ number_format($totalDiscount, 0, ',', '.') }} VNĐ
                                </div>
                                <div class="text-warning text-xs mt-1">
                                    <i class="fas fa-arrow-up"></i>
                                    Tỷ lệ trong đơn: {{ number_format($discountOrderPercent, 1) }}%
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <!-- Revenue Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-area me-2"></i>
                            Biểu đồ doanh thu theo thời gian
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                                <a class="dropdown-item" href="#" onclick="changeChartType('line')">Biểu đồ đường</a>
                                <a class="dropdown-item" href="#" onclick="changeChartType('bar')">Biểu đồ cột</a>
                                <a class="dropdown-item" href="#" onclick="changeChartType('area')">Biểu đồ vùng</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="revenueChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Service Type Distribution -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-pie me-2"></i>
                            Phân bố theo loại dịch vụ
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="serviceChart" width="100%" height="50"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i>
                                Tại chỗ ({{ $atTablePercent }}%)
                            </span>
                            <br>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i>
                                Mang về ({{ $takeAwayPercent }}%)
                            </span>
                            <br>
                            <span class="mr-2">
                                Thống kê % số lượng đơn hàng
                            </span>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Tables -->
        <div class="row">
            <!-- Top Selling Items -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-star me-2"></i>
                            Top món bán chạy
                        </h6>
                        <select id="filterMonthProduct" class="form-select mb-3">
                                    @for($i=1;$i<=12;$i++)
                <option value="{{ $i }}" {{ $i==now()->month?'selected':'' }}>Tháng {{ $i }}</option>
            @endfor
                                </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="topProductsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên món</th>
                                        <th class="text-center">SL</th>
                                        <th class="text-end">Doanh thu</th>
                                        <th class="text-center">%</th>
                                    </tr>
                                </thead>
                               <tbody>
                                @foreach($listTopDeal as $index => $item)
                                    <tr>
                                        <td class="align-middle"><span class="badge align-items-center bg-{{ $item->badge }}">{{ $index + 1 }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->food_image ? asset('img/' . $item->food_image) : 'https://via.placeholder.com/40x40' }}"
                                                    class="rounded me-2" width="50" height="50">
                                                <div>
                                                    <div class="fw-semibold">{{ $item->food_name }}</div>
                                                    <small class="text-muted">{{ number_format($item->food_price, 0, ',', '.') }} VNĐ</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"><strong>{{ $item->total_quantity }}</strong></td>
                                        <td class="text-end">{{ number_format($item->total_revenue, 0, ',', '.') }} VNĐ</td>
                                        <td class="text-center">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar bg-{{ $item->badge }}" style="width: {{ $item->percent }}%"></div>
                                            </div>
                                            <small>{{ $item->percent }}%</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
  document.getElementById('filterMonthProduct')
    .addEventListener('change', function(){
      let month = this.value;
      fetch(`{{ route('admin.top-products') }}?month=${month}&year={{ now()->year }}`)
        .then(r => r.json())
        .then(res => {
          let tbody = document.querySelector('#topProductsTable tbody');
          tbody.innerHTML = '';
          res.data.forEach((it, idx) => {
            tbody.innerHTML += `
<tr>
  <td><span class="badge bg-${it.badge}">${idx+1}</span></td>
  <td>
    <div class="d-flex align-items-center">
      <img src="${it.food_image}" width="50" class="rounded me-2">
      <div>
        <div class="fw-semibold">${it.food_name}</div>
      </div>
    </div>
  </td>
  <td class="text-center"><strong>${it.total_quantity}</strong></td>
  <td class="text-end"> ${new Intl.NumberFormat('vi-VN').format(it.total_revenue)} VNĐ</td>
  <td class="text-center">
    <div class="progress" style="height:4px">
      <div class="progress-bar bg-${it.badge}" style="width:${it.percent}%"></div>
    </div>
    <small>${it.percent}%</small>
  </td>
</tr>`;
          });
        });
    });
</script>
            <!-- Items Need Upselling -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">
                            <i class="fas fa-arrow-trend-up me-2"></i>
                            Món cần Upsale
                        </h6>
                        <select id="filterMonthProductUpsale" class="form-select mb-3">
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ $i==now()->month?'selected':'' }}>
                                Tháng {{ $i }}
                                </option>
                            @endfor
                            </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="upsaleTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tên món</th>
                                        <th class="text-center">SL bán</th>
                                        <th class="text-center">Tiềm năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @forelse($upsaleList as $item)
                                        <tr class="{{ $item['decrease'] > 30 ? 'table-warning' : 'table-light' }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item['food_image'] ? asset('img/' . $item['food_image']) : 'https://via.placeholder.com/40x40' }}"
                                                        class="rounded me-2" width="30" height="30">
                                                    <div>
                                                        <div class="fw-semibold">{{ $item['food_name'] }}</div>
                                                        <small class="text-muted">Giá: {{ number_format($item['food_price'], 0, ',', '.') }} VNĐ</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger">{{ $item['sold'] }}</span>
                                                <br><small class="text-muted">Giảm {{ $item['decrease'] }}%</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-{{ $item['potential_class'] }} fw-bold">{{ $item['potential'] }}</span>
                                                <br><small class="text-muted">Lợi nhuận {{ $item['profit'] }}%</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Không có món upsale nào nổi bật tháng này.</td>
                                        </tr>
                                  @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('filterMonthProductUpsale')
            .addEventListener('change', function(){
                const month = this.value;
                fetch(`{{ route('admin.upsale-products') }}?month=${month}&year={{ now()->year }}`)
                .then(res => res.json())
                .then(res => {
                    const tbody = document.querySelector('#upsaleTable tbody');
                    tbody.innerHTML = '';
                    res.data.forEach(item => {
                    tbody.innerHTML += `
            <tr class="${item.decrease>30?'table-warning':'table-light'}">
            <td>
                <div class="d-flex align-items-center">
                <img src="${item.food_image}" width="30" height="30" class="rounded me-2">
                <div>
                    <div class="fw-semibold">${item.food_name}</div>
                    <small class="text-muted">Giá: ${item.food_price.toLocaleString()} VNĐ</small>
                </div>
                </div>
            </td>
            <td class="text-center">
                <span class="badge bg-danger">${item.sold}</span><br>
                <small class="text-muted">Giảm ${item.decrease}%</small>
            </td>
            <td class="text-center">
                <span class="text-${item.potential_class} fw-bold">${item.potential}</span><br>
                <small class="text-muted">Lợi nhuận ${item.profit}%</small>
            </td>
            </tr>`;
                    });
                });
            });
        </script>

        <!-- Revenue by Time Period -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Doanh thu theo khoảng thời gian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <!-- Nút lọc -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <button class="btn btn-outline-primary w-100 period-btn active" data-period="daily">Theo ngày</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-primary w-100 period-btn" data-period="weekly">Theo tuần</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-primary w-100 period-btn" data-period="monthly">Theo tháng</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-outline-primary w-100 period-btn" data-period="yearly">Theo năm</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="revenueTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Khoảng thời gian</th>
                                        <th class="text-center">Số đơn hàng</th>
                                        <th class="text-end">Tại chỗ</th>
                                        <th class="text-end">Mang về</th>
                                        <th class="text-end">Tổng doanh thu</th>
                                       
                                    </tr>
                                </thead>
                                    <tbody id="revenueTableBody">
                                        @foreach($data as $i => $row)
                                            <tr>
                                                <td class="fw-semibold">{{ $row['label'] }}</td>
                                                <td class="text-center">{{ $row['total_orders'] }}</td>
                                                <td class="text-end">{{ number_format($row['at_table'], 0, ',', '.') }} VNĐ</td>
                                                <td class="text-end">{{ number_format($row['take_away'], 0, ',', '.') }}  VNĐ</td>
                                                <td class="text-end fw-bold">{{ number_format($row['total_revenue'], 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    function renderTable(data) {
        let html = '';
        data.forEach(row => {
            html += `
                <tr>
                    <td class="fw-semibold">${row.label}</td>
                    <td class="text-center">${row.total_orders}</td>
                    <td class="text-end">${Number(row.at_table).toLocaleString()} VNĐ</td>
                    <td class="text-end">${Number(row.take_away).toLocaleString()} VNĐ</td>
                    <td class="text-end fw-bold">${Number(row.total_revenue).toLocaleString()} VNĐ</td>
                </tr>
            `;
        });
        document.querySelector('#revenueTable tbody').innerHTML = html;
    }

    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            let period = this.getAttribute('data-period');

            // Gửi AJAX
            fetch(`{{ route('admin.cashier.filter') }}?period=${period}`)
                .then(res => res.json())
                .then(res => {
                    renderTable(res.data);
                });
        });
    });
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const chartLabels = @json($labels);
        const chartData = @json($monthlyRevenue);

        let revenueChart;
        function renderRevenueChart(type = 'line') {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            if (revenueChart) revenueChart.destroy();

            let chartType = type === 'area' ? 'line' : type;
            let datasetOptions = {
                label: 'Doanh thu (VNĐ)',
                data: chartData,
                borderColor: 'rgb(78, 115, 223)',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 2,
                fill: (type === 'area'),
                tension: 0.4
            };
            if (type === 'bar') {
                datasetOptions.backgroundColor = 'rgba(78, 115, 223, 0.7)';
                datasetOptions.borderColor = 'rgba(78, 115, 223, 1)';
                datasetOptions.fill = false;
            }
            revenueChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: chartLabels,
                    datasets: [datasetOptions]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return new Intl.NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND'
                                    }).format(value);
                                }
                            }
                        }
                    },
                    elements: {
                        point: { radius: 4, hoverRadius: 6 }
                    }
                }
            });
        }

        function changeChartType(type) {
            renderRevenueChart(type);
        }

        document.addEventListener('DOMContentLoaded', function () {
            renderRevenueChart('line');
        });
        // Service Distribution Chart
        const serviceLabels = ['Tại chỗ', 'Mang về'];
        const serviceData = [{{ $atTable }}, {{ $takeAway }}];

        const serviceColors = [
            'rgb(78, 115, 223)',
            'rgb(28, 200, 138)'
        ];

        // Xóa chart cũ nếu cần thiết (nếu dùng reload)
        let serviceChart;
        function renderServiceChart() {
            const serviceCtx = document.getElementById('serviceChart').getContext('2d');
            if (serviceChart) serviceChart.destroy();
            serviceChart = new Chart(serviceCtx, {
                type: 'doughnut',
                data: {
                    labels: serviceLabels,
                    datasets: [{
                        data: serviceData,
                        backgroundColor: serviceColors,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', renderServiceChart);

        // Filter Functions
        function updateTimeRange() {
            const timeRange = document.getElementById('timeRange').value;
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');

            const today = new Date();
            let start, end = today;

            switch (timeRange) {
                case 'today':
                    start = today;
                    break;
                case 'yesterday':
                    start = new Date(today);
                    start.setDate(today.getDate() - 1);
                    end = start;
                    break;
                case 'this_week':
                    start = new Date(today);
                    start.setDate(today.getDate() - today.getDay());
                    break;
                case 'last_week':
                    start = new Date(today);
                    start.setDate(today.getDate() - today.getDay() - 7);
                    end = new Date(start);
                    end.setDate(start.getDate() + 6);
                    break;
                case 'this_month':
                    start = new Date(today.getFullYear(), today.getMonth(), 1);
                    break;
                case 'last_month':
                    start = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                    end = new Date(today.getFullYear(), today.getMonth(), 0);
                    break;
                case 'this_year':
                    start = new Date(today.getFullYear(), 0, 1);
                    break;
                case 'custom':
                    return; // Don't update dates for custom range
            }

            if (timeRange !== 'custom') {
                startDate.value = start.toISOString().split('T')[0];
                endDate.value = end.toISOString().split('T')[0];
            }
        }

        function applyFilter() {
            // Simulate loading
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.opacity = '0.7';
            });

            setTimeout(() => {
                cards.forEach(card => {
                    card.style.opacity = '1';
                });

                // Update sample data
                document.getElementById('totalRevenue').textContent = '3,247,500đ';
                document.getElementById('totalOrders').textContent = '1,387';
                document.getElementById('avgOrderValue').textContent = '234,200đ';
                document.getElementById('estimatedProfit').textContent = '1,298,750đ';

                showToast('Bộ lọc đã được áp dụng thành công!', 'success');
            }, 1000);
        }

        function resetFilter() {
            document.getElementById('timeRange').value = 'this_month';
            document.getElementById('startDate').value = new Date().getFullYear() + '-' + String(new Date().getMonth() + 1).padStart(2, '0') + '-01';
            document.getElementById('endDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('serviceType').value = 'all';

            showToast('Bộ lọc đã được đặt lại!', 'info');
        }

        function filterByService() {
            const serviceType = document.getElementById('serviceType').value;
            showToast(`Đã lọc theo loại dịch vụ: ${serviceType === 'all' ? 'Tất cả' : serviceType}`, 'info');
        }

        function refreshData() {
            const refreshBtn = document.querySelector('[onclick="refreshData()"]');
            const icon = refreshBtn.querySelector('i');

            icon.classList.add('fa-spin');
            refreshBtn.disabled = true;

            setTimeout(() => {
                icon.classList.remove('fa-spin');
                refreshBtn.disabled = false;
                showToast('Dữ liệu đã được cập nhật!', 'success');
            }, 2000);
        }

        function changeChartType(type) {
            revenueChart.config.type = type;
            revenueChart.update();
            showToast(`Đã chuyển sang biểu đồ ${type === 'line' ? 'đường' : type === 'bar' ? 'cột' : 'vùng'}`, 'info');
        }

        // Period buttons
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const period = this.dataset.period;
                showToast(`Đã chuyển sang xem theo ${period === 'daily' ? 'ngày' : period === 'weekly' ? 'tuần' : period === 'monthly' ? 'tháng' : 'năm'}`, 'info');
            });
        });

        // Export functions
        document.getElementById('exportPeriod').addEventListener('change', function () {
            const customRange = document.getElementById('customExportRange');
            if (this.value === 'custom') {
                customRange.style.display = 'block';
            } else {
                customRange.style.display = 'none';
            }
        });

        function exportReport() {
            const format = document.getElementById('exportFormat').value;
            const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));

            // Simulate export process
            showToast('Đang tạo báo cáo...', 'info');

            setTimeout(() => {
                modal.hide();
                showToast(`Báo cáo đã được xuất thành công định dạng ${format.toUpperCase()}!`, 'success');
            }, 2000);
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer') || createToastContainer();

            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            toastContainer.appendChild(toast);

            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '1055';
            document.body.appendChild(container);
            return container;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            updateTimeRange();
        });
    </script>

    <style>
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }

        .chart-area {
            position: relative;
            height: 300px;
        }

        .chart-pie {
            position: relative;
            height: 200px;
        }

        .progress {
            background-color: #e9ecef;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075);
        }

        .period-btn.active {
            background-color: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .badge {
            font-size: 0.75em;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        .fa-spin {
            animation: fa-spin 1s infinite linear;
        }

        @keyframes fa-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

@endsection