<?php

namespace App\Attributes;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ZoneAttribute
{
    protected function initializeZoneAttribute()
    {
        $this->mergeFillable([$this->getZoneKey()]);
    }

    protected function getZoneKey()
    {
        return $this->zoneKey ?? 'zone_id';
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, $this->getZoneKey());
    }

    public function getZoneNameAttribute()
    {
        return $this->zone?->name;
    }
}
