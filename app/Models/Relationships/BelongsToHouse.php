<?php

namespace App\Models\Relationships;

use App\Models\House;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToHouse
{
    protected function initializeBelongsToHouse()
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
