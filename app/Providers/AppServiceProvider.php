<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;



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
        // Đăng ký middleware tại đây
        $this->app['router']->aliasMiddleware('role', Role::class);
        
        Schema::defaultStringLength(191);
    }
}
