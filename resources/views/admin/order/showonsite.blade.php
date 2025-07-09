@extends('admin.index')
@section('content')
    <div class="max-w-7xl mx-auto px-1 py-1">
        {{-- Header với mã đơn hàng và trạng thái --}}
        <div class="bg-white rounded-lg shadow-sm border mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Đơn hàng #{{ $order->code }}</h1>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        @php
                            $statusColors = [
                                'Đang Mở' => 'bg-blue-100 text-blue-800',
                                'Hoàn Thành' => 'bg-green-100 text-green-800',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-medium  {{ $statusColors[$order->statusorder] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $order->statusorder }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Cột trái: Thông tin khách hàng và đơn hàng --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Danh sách sản phẩm --}}
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Sản phẩm đã đặt - Bàn {{ $order->table_id }}
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sản phẩm</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Đơn giá</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SL</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                               @foreach($details as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{-- Nếu có combo_id thì hiện tên combo, không thì hiện tên món --}}
                                                @if($item->combo_id)
                                                    <span class="text-indigo-600 font-bold">[Combo]</span>
                                                    {{ $item->combo_name }}
                                                @else
                                                    {{ $item->food_name }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-sm text-gray-900">
                                                {{-- Nếu là combo thì hiện giá combo, không thì giá món --}}
                                                @if($item->combo_id)
                                                    {{ number_format($item->combo_price) }}đ
                                                @else
                                                    {{ number_format($item->food_price) }}đ
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{-- Tổng giá = số lượng * giá --}}
                                                @if($item->combo_id)
                                                    {{ number_format($item->quantity * $item->combo_price) }}đ
                                                @else
                                                    {{ number_format($item->quantity * $item->food_price) }}đ
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Cột phải: Tóm tắt đơn hàng và cập nhật trạng thái --}}
            <div class="space-y-6">
                {{-- Tóm tắt thanh toán --}}
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Tóm tắt đơn hàng</h3>
                    </div>
                    <div class="px-6 py-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Nhân Viên Phục Vụ:</span>
                            <span class="font-medium">{{ $order->staff_name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Phương thức thanh toán:</span>
                            <span class="font-medium">{{ $order->typepayment == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</span>
                        </div>
                        @if($order->voucher_code)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Mã giảm giá:</span>
                                <span class="font-medium text-green-600">{{ $order->voucher_code }}</span>
                            </div>
                        @endif
                        <hr class="my-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Tổng cộng:</span>
                            <span class="text-orange-600">{{ is_numeric($order->totalbill) ? number_format($order->totalbill) . ' VNĐ' : 'Chưa tính' }}</span>
                        </div>
                    </div>
                </div>
                {{-- Nút quay lại --}}
                <div class="pt-4">
                    <a href="{{ route('admin.order.onsite') }}"
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection