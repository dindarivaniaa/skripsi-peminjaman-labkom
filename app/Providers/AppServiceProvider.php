<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

if (PHP_VERSION_ID < 80100 && !class_exists('Illuminate\Support\SortDirection')) {
    eval('
        namespace Illuminate\Support;
        class SortDirection {
            const Ascending = "asc";
            const Descending = "desc";
        }
    ');
}

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
        //
    }
}
