<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
          $this->routes(function () {
            Route::prefix('api/v1')
                ->middleware('api')
                ->namespace('App\Http\Controllers\Api\v1')
                ->group(base_path('routes/api.php'));
            });
    }
}
