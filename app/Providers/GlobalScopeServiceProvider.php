<?php

namespace App\Providers;

use App\Models\Family;
use App\Models\FirstTimeJobSeeker;
use App\Models\House;
use App\Models\Household;
use App\Models\Inhabitant;
use App\Models\PersonWithDisability;
use App\Models\ResidencyCertificate;
use App\Models\Street;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\ServiceProvider;

class GlobalScopeServiceProvider extends ServiceProvider
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
        //
    }
}
