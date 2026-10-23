<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        RateLimiter::for('visits', function (Request $request): Limit {
            $maxAttempts = max(1, (int) config('visits.rate_limit_per_minute', 30));

            return Limit::perMinute($maxAttempts)->by((string) $request->ip());
        });
    }
}
