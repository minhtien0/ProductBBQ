@extends('admin.index')
@section('content')
<div class="px-6 py-4 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Chi Tiết Đơn Hàng: {{ $order->code }}</h2>

    {{-- Thông tin chung --}}
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="font-semibold">Khách hàng</h3>
            <p>{{ $order->customer_name }}</p>
            <p>{{ $order->customer_email }}</p>
        </div>
        <div>
            <h3 class="font-semibold">Thông tin đơn hàng</h3>
            <p>Địa chỉ: {{ $order->house_number }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</p><span>({{ $order->note_address }})</span>
            <p>Ngày: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
            <p>Thanh toán: {{ $order->typepayment == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</p>
            <p>Voucher: {{ $order->voucher_code ?? 'Không' }}</p>
            <p>Ghi chú: {{ $order->note ?? '-' }}</p>
            <p>Trạng thái: {{ $order->statusorder }}</p>
        </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Sản Phẩm</th>
                    <th class="px-4 py-2">Giá</th>
                    <th class="px-4 py-2">SL</th>
                    <th class="px-4 py-2">Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $item)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $item->food_name }}</td>
                    <td class="px-4 py-2">{{ number_format($item->food_price) }} VNĐ</td>
                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                    <td class="px-4 py-2">{{ number_format($item->quantity * $item->food_price) }} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Tổng kết và cập nhật trạng thái --}}
    <div class="flex justify-between items-center">
        <div class="text-lg font-bold">
            Tổng cộng: {{ number_format($order->totalbill) }} VNĐ
        </div>
        <form action="{{ route('admin.order.updateStatusBringBack', $order->id_order) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <select name="statusorder" class="border rounded p-1">
                @foreach(['Chờ Xác Nhận','Đang Thực Hiện','Đang Giao Hàng','Hoàn Thành'] as $st)
                    <option value="{{ $st }}" @if($order->statusorder == $st) selected @endif>{{ $st }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded">Cập nhật</button>
        </form>
    </div>
</div>
@endsection