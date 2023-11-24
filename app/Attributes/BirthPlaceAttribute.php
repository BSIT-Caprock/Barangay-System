<?php

namespace App\Attributes;

use App\Models\BirthPlace;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BirthPlaceAttribute
{
    protected function initializeBirthPlaceAttribute()
    {
        $this->mergeFillable([$this->getBirthPlaceKey()]);
    }

    protected function getBirthPlaceKey()
    {
        return $this->birthPlaceKey ?? 'birth_place_id';
    }

    public function birth_place(): BelongsTo
    {
        return $this->belongsTo(BirthPlace::class, $this->getBirthPlaceKey());
    }
}
