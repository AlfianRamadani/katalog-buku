<?php

namespace App\Providers;

use App\Models\HistoryLoanBook;
use App\Models\Review;
use App\Observers\HistoryLoanBookObserver;
use App\Observers\ReviewObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        } else {
            URL::forceScheme('http');
        }
        Model::unguard();
        Review::observe(ReviewObserver::class);
    }
}
