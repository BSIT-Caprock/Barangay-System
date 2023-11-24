<?php

namespace App\Observers;

use App\Helpers\Strings;
use App\Models\BirthPlace;

class BirthPlaceObserver
{
    /**
     * Handle the BirthPlace "created" event.
     */
    public function creating(BirthPlace $birthPlace): void
    {
        $this->autoName($birthPlace);
    }

    /**
     * Handle the BirthPlace "updated" event.
     */
    public function updating(BirthPlace $birthPlace): void
    {
        $this->autoName($birthPlace);
    }

    // Method to set the name attribute
    public function autoName(BirthPlace $birthPlace)
    {
        if ($birthPlace->name === null || trim($birthPlace->name) === '') {
            if ($birthPlace->isDirty('city_or_municipality') || $birthPlace->isDirty('province')) {
                $name = Strings::joinWithoutNulls(', ', [
                    $birthPlace->city_or_municipality,
                    $birthPlace->province,
                ]);
                $birthPlace->name = $name;
            }
        }
    }
}
