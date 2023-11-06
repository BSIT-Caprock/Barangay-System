<?php

namespace App\Models\Scopes;

use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BarangayScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // return; // may something so gin exit ko dayon

         // Assuming the user is authenticated
         /** @var User */
        $user = Auth::user();
        
        if ($user->hasRole('Superadministrator')) {
            // Superadministrators can access all models
            return;
        }

        if ($user->barangay_id) {
            $builder->where('barangay_id', $user->barangay_id);
        } else {
            // If user doesn't have a barangay_id, restrict access to no models
            $builder->where('barangay_id', 0);
        }
        
    }
}
