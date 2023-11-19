<?php

namespace App\Models\Relationships;

use App\Models\BirthPlace;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBirthPlace
{
    protected function initializeBelongsToBirthPlace()
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

    public function getPlaceOfBirthAttribute()
    {
        return $this->birth_place?->name;
    }
}
