<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .bill-table td, .bill-table th { border:1px solid #ddd; padding:4px; }
    </style>
</head>
<body>
    <h2>HÓA ĐƠN THANH TOÁN BBQ</h2>
    <p>Bàn: <b>{{ $bill['table_name'] }}</b></p>
    <p>Nhân viên: {{ $bill['staff_name'] }}</p>
    <p>Mã hóa đơn: {{ $bill['bill_id'] }}</p>
    <p>Thời gian: {{ $bill['bill_time'] }}</p>

    <table width="100%" class="bill-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Món</th>
                <th>SL</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bill['items'] as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td align="center">{{ $item['quantity'] }}</td>
                <td align="right">{{ number_format($item['price']) }}</td>
                <td align="right">{{ number_format($item['price'] * $item['quantity']) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p style="text-align:right;"><b>Tổng cộng: {{ $bill['total'] }}</b></p>

    @if($qrBase64)
    <div style="margin-top: 30px; text-align:center;">
        <b>Quét mã QR để thanh toán VNPAY</b><br>
        <img src="{{ $qrBase64 }}" width="200">
        <div style="font-size:12px;">(Sử dụng app ngân hàng/ VNPay để quét)</div>
    </div>
    @endif

    <div style="margin-top:30px; text-align:center;">Cảm ơn Quý khách!</div>
</body>
</html>
