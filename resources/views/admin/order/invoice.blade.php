<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $order->code }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #888; padding: 6px; text-align: left; }
        th { background: #eee; }
        h2 { text-align: center; margin-bottom: 8px;}
    </style>
</head>
<body>
    <h2>HÓA ĐƠN THANH TOÁN</h2>
    <p><strong>Mã đơn:</strong> #{{ $order->code }}</p>
    <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
    <p><strong>Điện thoại:</strong> {{ $order->customer_sdt }}</p>
    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
    <p><strong>Địa chỉ:</strong>
        {{ $order->house_number }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}
        @if($order->note_address) ({{ $order->note_address }}) @endif
    </p>
    <p><strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>SL</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        @foreach($details as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>
                    @if($item->combo_id)
                        [Combo] {{ $item->combo_name }}
                    @else
                        {{ $item->food_name }}
                    @endif
                </td>
                <td>{{ $item->quantity }}</td>
                <td>
                    @if($item->combo_id)
                        {{ number_format($item->combo_price) }}đ
                    @else
                        {{ number_format($item->food_price) }}đ
                    @endif
                </td>
                <td>
                    @if($item->combo_id)
                        {{ number_format($item->quantity * $item->combo_price) }}đ
                    @else
                        {{ number_format($item->quantity * $item->food_price) }}đ
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Tổng cộng</strong></td>
                <td><strong>{{ number_format($order->totalbill) }}đ</strong></td>
            </tr>
            @if($order->voucher_code)
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Voucher giảm</strong></td>
                <td>{{ $order->voucher_code }} - {{ number_format($order->voucher_value) }}đ</td>
            </tr>
            @endif
        </tfoot>
    </table>
    <p style="margin-top:30px;">Ghi chú: {{ $order->note_order ?? '---' }}</p>
    <p style="text-align:right;margin-top:50px;">
    Người lập hóa đơn<br>
    <strong>{{ $staff_name }}</strong>
</p>
</body>
</html>
