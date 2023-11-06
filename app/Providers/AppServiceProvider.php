<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::if('isRecruiter', function () {
            return request()->user()->isRecruiter();
        });

        Blade::if('isCandidate', function () {
            return !request()->user()->isRecruiter();
        });
    }
}
