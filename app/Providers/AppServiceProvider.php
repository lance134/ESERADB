<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CartComposer;
use App\Http\ViewComposers\ServiceComposer;
use Illuminate\Support\Facades\Cookie; 


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
    public function boot()
    {
        View::composer('*', CartComposer::class);
        
        View::composer('*', function ($view) {
            // Access cookie value
            $serviceType = Cookie::get('order_type'); // Get 'order_type' from the cookie
            $view->with('serviceType', $serviceType);
        });
    }
}
