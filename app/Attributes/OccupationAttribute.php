<?php

namespace App\Attributes;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait OccupationAttribute
{
    protected function initializeOccupationAttribute()
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
}
