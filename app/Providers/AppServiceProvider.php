<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        // foreach (glob(app_path('routes') . '/*.php') as $file) { require_once $file; }

        Route::middleware('web')
             ->group(base_path('routes/web.php'));

        Route::middleware('web')
             ->group(base_path('routes/auth.php'));

        Route::middleware('api')
             ->prefix('api')
             ->group(base_path('routes/api.php'));
    }
}
