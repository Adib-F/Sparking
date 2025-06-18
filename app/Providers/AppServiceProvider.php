<?php

namespace App\Providers;

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL; 
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
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Daftarkan middleware role dengan benar
        $this->app['router']->aliasMiddleware('role', EnsureTokenIsValid::class);

        // Force HTTPS di environment production
        if (env('APP_ENV') === 'production') {
            Log::info('Forcing HTTPS scheme');
            URL::forceScheme('https');
        }

    }
}
