<?php

namespace App\Models\Relationships;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToOccupation
{
    protected function initializeBelongsToOccupation()
    {
        $this->mergeFillable([$this->getOccupationKey()]);
    }

    protected function getOccupationKey()
    {
        return $this->occupationKey ?? 'occupation_id';
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class, $this->getOccupationKey());
    }

    public function getOccupationNameAttribute()
    {
        return $this->occupation?->name;
    }
}
