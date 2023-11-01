<?php

namespace App\Providers;

use App\Models\Barangays\Barangay;
use App\Observers\Barangays\BarangayObserver;
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
        /**
         * MySQL 8.0 limits index keys to 1000 characters.
         * Spatie Permissions publishes a migration
         * which combines multiple columns in single index.
         *
         * With utf8mb4 the 4-bytes-per-character requirement of mb4
         * means the max length of the columns in
         * the hybrid index can only be 125 characters.
         */
        Schema::defaultStringLength(125);
    }
}
