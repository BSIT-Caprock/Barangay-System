<?php

namespace App\Scopes;

use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CurrentBarangayScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (! Auth::check()) {
            return;
        }

        /** @var User */
        $user = Auth::user();

        if ($user->barangay) {
            $builder->where($model->getBarangayKey(), $user->{$user->getBarangayKey()});
        }
    }
}
