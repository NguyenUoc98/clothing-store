<?php

namespace App\Providers;

use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Schema;
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
        // Đăng ký middleware tại đây
        $this->app['router']->aliasMiddleware('role', Role::class);
        
        Schema::defaultStringLength(191);
    }
}
