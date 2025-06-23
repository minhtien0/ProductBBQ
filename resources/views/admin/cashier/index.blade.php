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
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="fas fa-download me-1"></i> Xuất báo cáo
                    </button>
                    <button class="btn btn-primary" onclick="refreshData()">
                        <i class="fas fa-sync-alt me-1"></i> Làm mới
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Khoảng thời gian</label>
                    <select class="form-select" id="timeRange" onchange="updateTimeRange()">
                        <option value="today">Hôm nay</option>
                        <option value="yesterday">Hôm qua</option>
                        <option value="this_week">Tuần này</option>
                        <option value="last_week">Tuần trước</option>
                        <option value="this_month" selected>Tháng này</option>
                        <option value="last_month">Tháng trước</option>
                        <option value="this_year">Năm này</option>
                        <option value="custom">Tùy chỉnh</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Từ ngày</label>
                    <input type="date" class="form-control" id="startDate" value="{{ date('Y-m-01') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Đến ngày</label>
                    <input type="date" class="form-control" id="endDate" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Loại dịch vụ</label>
                    <select class="form-select" id="serviceType" onchange="filterByService()">
                        <option value="all">Tất cả</option>
                        <option value="dine_in">Tại chỗ</option>
                        <option value="takeaway">Mang về</option>
                        <option value="delivery">Giao hàng</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn btn-success me-2" onclick="applyFilter()">
                        <i class="fas fa-filter me-1"></i> Áp dụng bộ lọc
                    </button>
                    <button class="btn btn-secondary" onclick="resetFilter()">
                        <i class="fas fa-undo me-1"></i> Đặt lại
                    </button>
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
                                {{ number_format(2847500, 0, ',', '.') }}đ
                            </div>
                            <div class="text-success text-xs mt-1">
                                <i class="fas fa-arrow-up"></i> +12.5% so với kỳ trước
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
                                1,247
                            </div>
                            <div class="text-success text-xs mt-1">
                                <i class="fas fa-arrow-up"></i> +8.2% so với kỳ trước
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
                                Giá trị trung bình
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgOrderValue">
                                {{ number_format(228400, 0, ',', '.') }}đ
                            </div>
                            <div class="text-info text-xs mt-1">
                                <i class="fas fa-arrow-up"></i> +3.8% so với kỳ trước
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
                                Lợi nhuận ước tính
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="estimatedProfit">
                                {{ number_format(1138500, 0, ',', '.') }}đ
                            </div>
                            <div class="text-warning text-xs mt-1">
                                <i class="fas fa-arrow-up"></i> Tỷ lệ lợi nhuận: 40%
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
                        biểu đồ doanh thu theo thời gian
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
                            <i class="fas fa-circle text-primary"></i> Tại chỗ (65%)
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Mang về (25%)
                        </span>
                        <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Giao hàng (10%)
                        </span>
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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tên món</th>
                                    <th class="text-center">SL bán</th>
                                    <th class="text-end">Doanh thu</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-warning">1</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Bò nướng</div>
                                                <small class="text-muted">300,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>147</strong></td>
                                    <td class="text-end">441,000,000đ</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-success" style="width: 85%"></div>
                                        </div>
                                        <small>85%</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-info">2</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Dê nướng</div>
                                                <small class="text-muted">350,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>132</strong></td>
                                    <td class="text-end">462,000,000đ</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-info" style="width: 78%"></div>
                                        </div>
                                        <small>78%</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-secondary">3</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Lẩu thái</div>
                                                <small class="text-muted">280,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>98</strong></td>
                                    <td class="text-end">274,400,000đ</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                                        </div>
                                        <small>65%</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark">4</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Tôm nướng</div>
                                                <small class="text-muted">180,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>89</strong></td>
                                    <td class="text-end">160,200,000đ</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-danger" style="width: 45%"></div>
                                        </div>
                                        <small>45%</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark">5</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Cá nướng</div>
                                                <small class="text-muted">220,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><strong>76</strong></td>
                                    <td class="text-end">167,200,000đ</td>
                                    <td class="text-center">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-secondary" style="width: 38%"></div>
                                        </div>
                                        <small>38%</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Need Upselling -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-arrow-trend-up me-2"></i>
                        Món cần Upsale
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên món</th>
                                    <th class="text-center">SL bán</th>
                                    <th class="text-center">Tiềm năng</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-warning">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Súp hải sản</div>
                                                <small class="text-muted">Giá: 120,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">23</span>
                                        <br><small class="text-muted">Giảm 45%</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success fw-bold">Cao</span>
                                        <br><small class="text-muted">Lợi nhuận 60%</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-bullhorn"></i> Khuyến mãi
                                        </button>
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Salad trộn</div>
                                                <small class="text-muted">Giá: 85,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">31</span>
                                        <br><small class="text-muted">Giảm 32%</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-warning fw-bold">Trung bình</span>
                                        <br><small class="text-muted">Lợi nhuận 45%</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-percent"></i> Giảm giá
                                        </button>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Gà nướng nguyên con</div>
                                                <small class="text-muted">Giá: 280,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">45</span>
                                        <br><small class="text-muted">Giảm 15%</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-info fw-bold">Thấp</span>
                                        <br><small class="text-muted">Lợi nhuận 35%</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary">
                                            <i class="fas fa-star"></i> Đặc biệt
                                        </button>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40x40" class="rounded me-2" width="30" height="30">
                                            <div>
                                                <div class="fw-semibold">Thịt xiên nướng</div>
                                                <small class="text-muted">Giá: 150,000đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">38</span>
                                        <br><small class="text-muted">Giảm 22%</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-info fw-bold">Thấp</span>
                                        <br><small class="text-muted">Lợi nhuận 30%</small>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fas fa-plus"></i> Combo
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 period-btn active" data-period="daily">
                                <i class="fas fa-sun me-2"></i>Theo ngày
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 period-btn" data-period="weekly">
                                <i class="fas fa-calendar-week me-2"></i>Theo tuần
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 period-btn" data-period="monthly">
                                <i class="fas fa-calendar me-2"></i>Theo tháng
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 period-btn" data-period="yearly">
                                <i class="fas fa-calendar-alt me-2"></i>Theo năm
                            </button>
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
                                    <th class="text-end">Giao hàng</th>
                                    <th class="text-end">Tổng doanh thu</th>
                                    <th class="text-center">So sánh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">Hôm nay</td>
                                    <td class="text-center">45</td>
                                    <td class="text-end">8,250,000đ</td>
                                    <td class="text-end">3,100,000đ</td>
                                    <td class="text-end">1,150,000đ</td>
                                    <td class="text-end fw-bold">12,500,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">+15.2%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Hôm qua</td>
                                    <td class="text-center">52</td>
                                    <td class="text-end">9,100,000đ</td>
                                    <td class="text-end">2,800,000đ</td>
                                    <td class="text-end">950,000đ</td>
                                    <td class="text-end fw-bold">12,850,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">+8.5%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">3 ngày trước</td>
                                    <td class="text-center">38</td>
                                    <td class="text-end">6,800,000đ</td>
                                    <td class="text-end">2,400,000đ</td>
                                    <td class="text-end">800,000đ</td>
                                    <td class="text-end fw-bold">10,000,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">-12.3%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">4 ngày trước</td>
                                    <td class="text-center">49</td>
                                    <td class="text-end">8,850,000đ</td>
                                    <td class="text-end">3,200,000đ</td>
                                    <td class="text-end">1,200,000đ</td>
                                    <td class="text-end fw-bold">13,250,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">+18.7%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">5 ngày trước</td>
                                    <td class="text-center">41</td>
                                    <td class="text-end">7,200,000đ</td>
                                    <td class="text-end">2,900,000đ</td>
                                    <td class="text-end">1,050,000đ</td>
                                    <td class="text-end fw-bold">11,150,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">-2.1%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">6 ngày trước</td>
                                    <td class="text-center">35</td>
                                    <td class="text-end">6,200,000đ</td>
                                    <td class="text-end">2,100,000đ</td>
                                    <td class="text-end">750,000đ</td>
                                    <td class="text-end fw-bold">9,050,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">-18.5%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">1 tuần trước</td>
                                    <td class="text-center">43</td>
                                    <td class="text-end">7,850,000đ</td>
                                    <td class="text-end">2,650,000đ</td>
                                    <td class="text-end">900,000đ</td>
                                    <td class="text-end fw-bold">11,400,000đ</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">+5.8%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">
                    <i class="fas fa-download me-2"></i>Xuất báo cáo doanh thu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="exportForm">
                    <div class="mb-3">
                        <label for="exportFormat" class="form-label">Định dạng xuất</label>
                        <select class="form-select" id="exportFormat">
                            <option value="excel">Excel (.xlsx)</option>
                            <option value="pdf">PDF (.pdf)</option>
                            <option value="csv">CSV (.csv)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exportPeriod" class="form-label">Khoảng thời gian</label>
                        <select class="form-select" id="exportPeriod">
                            <option value="current">Khoảng thời gian hiện tại</option>
                            <option value="custom">Tùy chỉnh</option>
                        </select>
                    </div>
                    <div id="customExportRange" style="display: none;">
                        <div class="row">
                            <div class="col-6">
                                <label for="exportStartDate" class="form-label">Từ ngày</label>
                                <input type="date" class="form-control" id="exportStartDate">
                            </div>
                            <div class="col-6">
                                <label for="exportEndDate" class="form-label">Đến ngày</label>
                                <input type="date" class="form-control" id="exportEndDate">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung báo cáo</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="includeKPI" checked>
                            <label class="form-check-label" for="includeKPI">
                                Chỉ số KPI
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="includeTopItems" checked>
                            <label class="form-check-label" for="includeTopItems">
                                Top món bán chạy
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="includeServiceBreakdown" checked>
                            <label class="form-check-label" for="includeServiceBreakdown">
                                Phân tích theo loại dịch vụ
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="includeCharts" checked>
                            <label class="form-check-label" for="includeCharts">
                                Biểu đồ
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="exportReport()">
                    <i class="fas fa-download me-1"></i>Xuất báo cáo
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: ['1/12', '2/12', '3/12', '4/12', '5/12', '6/12', '7/12', '8/12', '9/12', '10/12', '11/12', '12/12'],
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: [9050000, 11150000, 10000000, 13250000, 12850000, 12500000, 11400000, 14200000, 13800000, 15100000, 14500000, 16200000],
            borderColor: 'rgb(78, 115, 223)',
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
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
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(value);
                    }
                }
            }
        },
        elements: {
            point: {
                radius: 4,
                hoverRadius: 6
            }
        }
    }
});

// Service Distribution Chart
const serviceCtx = document.getElementById('serviceChart').getContext('2d');
const serviceChart = new Chart(serviceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Tại chỗ', 'Mang về', 'Giao hàng'],
        datasets: [{
            data: [65, 25, 10],
            backgroundColor: [
                'rgb(78, 115, 223)',
                'rgb(28, 200, 138)',
                'rgb(54, 185, 204)'
            ],
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

// Filter Functions
function updateTimeRange() {
    const timeRange = document.getElementById('timeRange').value;
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    
    const today = new Date();
    let start, end = today;
    
    switch(timeRange) {
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
    btn.addEventListener('click', function() {
        document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const period = this.dataset.period;
        showToast(`Đã chuyển sang xem theo ${period === 'daily' ? 'ngày' : period === 'weekly' ? 'tuần' : period === 'monthly' ? 'tháng' : 'năm'}`, 'info');
    });
});

// Export functions
document.getElementById('exportPeriod').addEventListener('change', function() {
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
document.addEventListener('DOMContentLoaded', function() {
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
    background-color: rgba(0,0,0,.075);
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
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out;
}

.fa-spin {
    animation: fa-spin 1s infinite linear;
}

@keyframes fa-spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

@endsection