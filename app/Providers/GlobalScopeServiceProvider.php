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
use App\Scopes\CurrentBarangayScope;
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
        // Scope models to the currently authenticated user's barangay
        House::addGlobalScope(new CurrentBarangayScope);
        Household::addGlobalScope(new CurrentBarangayScope);
        Inhabitant::addGlobalScope(new CurrentBarangayScope);
        Street::addGlobalScope(new CurrentBarangayScope);
        Zone::addGlobalScope(new CurrentBarangayScope);
        FirstTimeJobSeeker::addGlobalScope(new CurrentBarangayScope);
        Family::addGlobalScope(new CurrentBarangayScope);
        PersonWithDisability::addGlobalScope(new CurrentBarangayScope);

        // certificates
        ResidencyCertificate::addGlobalScope(new CurrentBarangayScope);
    }
}
