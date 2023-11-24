<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class CurrentBarangayObserver
{
    public function creating(Model $model)
    {
        if (! empty($model->{$model->getBarangayKey()})) {
            return;
        }

        $currentBarangay = auth()->user()->barangay;
        if (auth()->check() && $currentBarangay) {
            $model->barangay()->associate($currentBarangay);
        }
    }
}
