<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use DB;

class AutoCancelOrders extends Command
{
    protected $signature = 'orders:auto-cancel';
    protected $description = 'Tự động hủy các đơn hàng quá hạn';

    public function handle()
    {
        $now = Carbon::now();

        // 1. Đơn "Chờ xác nhận" quá 30 phút
        $waitingOrders = Order::where('statusorder', 'Chờ Xác Nhận')
            ->where('type', 1)
            ->where('created_at', '<=', $now->copy()->subMinutes(2))
            ->get();

        foreach ($waitingOrders as $order) {
            $order->statusorder = 'Đã Hủy';
            $order->note = ($order->note ?? '') . "\nĐơn tự động hủy do quá 30 phút chờ xác nhận.";
            $order->save();
        }

        // 2. Đơn "Đang Giao Hàng" quá 2 tiếng
        $shippingOrders = Order::where('statusorder', 'Đang Giao Hàng')
            ->where('type', 1)
            ->where('updated_at', '<=', $now->copy()->subHours(2))
            ->get();

        foreach ($shippingOrders as $order) {
            $order->statusorder = 'Đã Hủy';
            $order->note = ($order->note ?? '') . "\nĐơn tự động hủy do giao hàng quá 2 tiếng.";
            $order->save();
        }

        $this->info('Đã tự động xử lý các đơn hàng quá hạn!');
    }
}
