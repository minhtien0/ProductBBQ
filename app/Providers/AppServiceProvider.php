<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Company;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('infos', Company::first());
        View::composer('*', function ($view) {
        $countCart = 0;
        if (session()->has('user_id')) {
            $countCart = Cart::where('user_id', session('user_id'))
                ->where('type', 'Giỏ Hàng')
                ->count();
        }
        $view->with('countCart', $countCart);
    });

    }
}
