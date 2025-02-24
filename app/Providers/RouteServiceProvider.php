<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ProvidersRouteServiceProvider
{
    public function boot()
    {
        $this->configureRateLimiting();
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('requestBook', function ($request) {
            return Limit::perDay(5)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
