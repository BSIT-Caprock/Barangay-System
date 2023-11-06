<?php

namespace App\Providers;

use App\Models\Barangays\Barangay;
use App\Observers\Barangays\BarangayObserver;
use Illuminate\Database\Eloquent\Model;
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

        /**
         * By default, attributes that are not included in the $fillable array 
         * are silently discarded when performing mass-assignment operations. 
         * In production, this is expected behavior; however, 
         * during local development it can lead to confusion 
         * as to why model changes are not taking effect.
         */
        Model::preventSilentlyDiscardingAttributes(app()->environment('local'));
        Model::preventSilentlyDiscardingAttributes(app()->environment('testing'));
    }
}
