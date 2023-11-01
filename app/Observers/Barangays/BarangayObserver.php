<?php

namespace App\Observers\Barangays;

use App\Models\Barangays\Barangay;
use App\Models\Barangays\BarangayHistory;

class BarangayObserver
{
    /**
     * Handle the Barangay "created" event.
     */
    public function created(Barangay $barangay): void
    {
        // Create history entry for the newly created barangay
        BarangayHistory::create(array_merge(
            [
                'barangay_id' => $barangay->id
            ],
            $barangay->getAttributes()
        ));
    }

    /**
     * Handle the Barangay "updated" event.
     */
    public function updated(Barangay $barangay): void
    {
        // Check if any changes have occurred
        if ($barangay->wasChanged()) {
            // Create a history entry capturing the changes
            BarangayHistory::create(array_merge(
                [
                    'barangay_id' => $barangay->id
                ],
                $barangay->getAttributes()
            ));
        }
    }

    /**
     * Handle the Barangay "deleted" event.
     */
    public function deleted(Barangay $barangay): void
    {
        // Create a history entry for the deleted barangay
        BarangayHistory::create(array_merge(
            [
                'barangay_id' => $barangay->id,
            ],
            $barangay->getAttributes()
        ));
    }

    /**
     * Handle the Barangay "restored" event.
     */
    public function restored(Barangay $barangay): void
    {
        // TODO Create a history entry for the restored barangay
        BarangayHistory::create(array_merge(
            [
                'barangay_id' => $barangay->id,
            ],
            $barangay->getAttributes()
        ));
    }

    /**
     * Handle the Barangay "force deleted" event.
     */
    public function forceDeleted(Barangay $barangay): void
    {
        //
    }
}
