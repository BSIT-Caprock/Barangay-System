<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait AuthBarangay
{
    protected static function bootAuthBarangay()
    {
        static::creating(function (Model $model) {
            if (auth()->check() && auth()->user()->barangay) {
                $model->barangay()->associate(auth()->user()->barangay);
            }
        });
    }
}