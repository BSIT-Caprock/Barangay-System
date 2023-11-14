<?php

namespace App\Specifications;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BarangaySpecification
{
    public static function hasBarangay($model)
    {
        return (bool) $model->barangay;
    }

    public static function authUserHasBarangay()
    {
        return auth()->check() && static::hasBarangay(auth()->user());
    }
}
