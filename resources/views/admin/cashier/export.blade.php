<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê doanh thu</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px;}
        th, td { border: 1px solid #888; padding: 5px; text-align: center;}
        th { background: #eee; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .fw-bold { font-weight: bold;}
    </style>
</head>
<body>
    <h2 style="text-align:center;">THỐNG KÊ DOANH THU</h2>
    <p><strong>Khoảng thống kê:</strong> 
        @if($period=='daily') 7 ngày gần nhất
        @elseif($period=='weekly') Theo tuần (năm {{ $year }})
        @elseif($period=='monthly') Theo tháng (năm {{ $year }})
        @else Theo năm @endif
    </p>
    <p><strong>Thời gian xuất:</strong> {{ \Carbon\Carbon::parse($export_time)->format('d/m/Y H:i:s') }}</p>
    <p><strong>Nhân viên lập thống kê:</strong> {{ $staff_name }}</p>

    <table>
        <thead>
            <tr>
                <th>Khoảng thời gian</th>
                <th>Số đơn hàng</th>
                <th>Tiền mặt</th>
                <th>Chuyển khoản</th>
                <th>Ăn tại chỗ</th>
                <th>Mang về</th>
                <th>Tổng doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td class="text-left">{{ $row['label'] }}</td>
                <td>{{ $row['total_orders'] }}</td>
                <td class="text-right">{{ number_format($row['cash'], 0, ',', '.') }} VNĐ</td>
                <td class="text-right">{{ number_format($row['transfer'], 0, ',', '.') }} VNĐ</td>
                <td class="text-right">{{ number_format($row['at_table'], 0, ',', '.') }} VNĐ</td>
                <td class="text-right">{{ number_format($row['take_away'], 0, ',', '.') }} VNĐ</td>
                <td class="text-right fw-bold">{{ number_format($row['total_revenue'], 0, ',', '.') }} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="margin-top:40px;text-align:right;">Người lập thống kê: <strong>{{ $staff_name }}</strong></p>
</body>
</html>
