<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Zone;

class ZonePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // normal user
        // barangay administrator
        // superadministrator
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Zone $zone)
    {
        // normal user
        return true;
        // barangay administrator
        // superadministrator
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        // normal user
        // barangay administrator
        if ($user->hasAnyRole('Barangay Administrator', 'Superadministrator')) {
            return true;
        }
        // superadministrator
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Zone $zone)
    {
        // normal user
        // barangay administrator
        if ($user->hasAnyRole('Barangay Administrator', 'Superadministrator')) {
            return true;
        }
        // superadministrator
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Zone $zone)
    {
        // normal user
        // barangay administrator
        if ($user->hasAnyRole('Barangay Administrator', 'Superadministrator')) {
            return true;
        }
        // superadministrator
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Zone $zone)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Zone $zone)
    {
        //
    }
}
