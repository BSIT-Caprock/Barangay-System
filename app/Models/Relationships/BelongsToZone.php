<?php

namespace App\Models\Relationships;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToZone
{
    protected function initializeBelongsToZone()
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
