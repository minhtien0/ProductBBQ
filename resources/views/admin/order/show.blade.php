@extends('admin.index')
@section('content')
<div class="max-w-7xl mx-auto px-1 py-1">
    {{-- Header với mã đơn hàng và trạng thái --}}
    <div class="bg-white rounded-lg shadow-sm border mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Đơn hàng #{{ $order->code }}</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($order->statusorder == 'Hoàn Thành') bg-green-100 text-green-800
                        @elseif($order->statusorder == 'Đang Giao Hàng') bg-blue-100 text-blue-800
                        @elseif($order->statusorder == 'Đang Thực Hiện') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $order->statusorder }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Cột trái: Thông tin khách hàng và đơn hàng --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Thông tin khách hàng --}}
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Thông tin khách hàng
                    </h3>
                </div>
                <div class="px-6 py-4 space-y-3">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500 w-20">Tên:</span>
                        <span class="text-sm text-gray-900">{{ $order->customer_name }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-500 w-20">Email:</span>
                        <span class="text-sm text-gray-900">{{ $order->customer_email }}</span>
                    </div>
                </div>
            </div>

            {{-- Thông tin giao hàng --}}
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Địa chỉ giao hàng
                    </h3>
                </div>
                <div class="px-6 py-4">
                    <p class="text-sm text-gray-900 leading-relaxed">
                        {{ $order->house_number }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}
                        @if($order->note_address)
                            <span class="text-gray-500">({{ $order->note_address }})</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Danh sách sản phẩm --}}
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Sản phẩm đã đặt
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Đơn giá</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SL</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($details as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->food_name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm text-gray-900">{{ number_format($item->food_price) }}đ</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="text-sm font-medium text-gray-900">{{ number_format($item->quantity * $item->food_price) }}đ</div>
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
                        <span class="text-orange-600">{{ number_format($order->totalbill) }}đ</span>
                    </div>
                </div>
            </div>

            {{-- Cập nhật trạng thái --}}
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Cập nhật trạng thái</h3>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('admin.order.updateStatusBringBack', $order->id_order) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Trạng thái đơn hàng</label>
                            <select name="statusorder" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                @foreach(['Chờ Xác Nhận','Đang Thực Hiện','Đang Giao Hàng','Hoàn Thành'] as $st)
                                    <option value="{{ $st }}" @if($order->statusorder == $st) selected @endif>{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Cập nhật trạng thái
                        </button>
                    </form>
                </div>
            </div>

            {{-- Ghi chú --}}
            @if($order->note)
            <div class="bg-amber-50 border border-amber-200 rounded-lg">
                <div class="px-6 py-4">
                    <h4 class="text-sm font-semibold text-amber-800 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Ghi chú từ khách hàng
                    </h4>
                    <p class="text-sm text-amber-700">{{ $order->note }}</p>
                </div>
            </div>
            @endif

            {{-- Nút quay lại --}}
            <div class="pt-4">
                <a href="{{ route('admin.order.bringback') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection