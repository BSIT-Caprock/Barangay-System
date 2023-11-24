<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
         * Implicitly grant "Super Admin" role all permissions if not restricted by policies
         * Also implicitly denies all permissions to non-administrators
         * This works in the app by using gate-related functions like auth()->user->can() and @can()
         * https://spatie.be/docs/laravel-permission/v6/basic-usage/super-admin#content-gateafter
         */
        Gate::after(function (User $user, $ability) {
            return $user->hasAnyRole('Superadministrator', 'Barangay Administrator'); // note this returns boolean
        });
    }
}
