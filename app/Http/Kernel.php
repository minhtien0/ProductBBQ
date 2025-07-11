<?php
namespace App\Http;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\Locale::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'locale' => \App\Http\Middleware\Locale::class,
        'check.admin' => \App\Http\Middleware\CheckAdminRole::class,
        'checkLoggedIn' => \App\Http\Middleware\CheckLoggedIn::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('orders:auto-cancel')->everyFiveMinutes();
    }
}
