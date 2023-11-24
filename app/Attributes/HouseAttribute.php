<?php

namespace App\Attributes;

use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HouseAttribute
{
    protected function initializeHouseAttribute()
    {
        $this->mergeFillable([$this->getHouseKey()]);
    }

    protected function getHouseKey()
    {
        return $this->houseKey ?? 'house_id';
    }

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class, $this->getHouseKey());
    }

    public function getHouseNumberAttribute()
    {
        return $this->house?->number;
    }
}
