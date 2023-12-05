<?php

namespace App\Providers;

use App\Models\BirthPlace;
use App\Models\Family;
use App\Models\FirstTimeJobSeeker;
use App\Models\House;
use App\Models\Household;
use App\Models\Inhabitant;
use App\Models\PersonWithDisability;
use App\Models\ResidencyCertificate;
use App\Models\Street;
use App\Models\Zone;
use App\Observers\BirthPlaceObserver;
use App\Observers\CurrentBarangayObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        House::observe(CurrentBarangayObserver::class);
        Household::observe(CurrentBarangayObserver::class);
        Inhabitant::observe(CurrentBarangayObserver::class);
        Street::observe(CurrentBarangayObserver::class);
        Zone::observe(CurrentBarangayObserver::class);

        BirthPlace::observe(BirthPlaceObserver::class);

        FirstTimeJobSeeker::observe(CurrentBarangayObserver::class);

        Family::observe(CurrentBarangayObserver::class);

        PersonWithDisability::observe(CurrentBarangayObserver::class);

        // certificates
        ResidencyCertificate::observe(CurrentBarangayObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
