<?php

namespace App\Models\Scopes;

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
        $user = Auth::user(); // Assuming the user is authenticated
        // user with no barangay id is usually a super admin
        if ($user->barangay_id) {
            $builder->where('barangay_id', $user->barangay_id);
        }
    }
}
