<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Đăng ký các command artisan.
     */
    protected $commands = [
        // Đăng ký command nếu cần, ví dụ:
        // \App\Console\Commands\AutoCancelOrders::class,
    ];

    /**
     * Định nghĩa các scheduled tasks.
     */
    protected function schedule(Schedule $schedule)
    {
        // Lệnh tự động hủy đơn hàng
        $schedule->command('orders:auto-cancel')->everyFiveMinutes();
    }

    /**
     * Đăng ký các file command tự động.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
