<?php

namespace App\Models\Relationships;

use App\Models\Street;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToStreet
{
    protected function initializeBelongsToStreet()
    {
        $this->mergeFillable([$this->getStreetKey()]);
    }

    protected function getStreetKey()
    {
        return $this->streetKey ?? 'street_id';
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class, $this->getStreetKey());
    }

    public function getStreetNameAttribute()
    {
        return $this->street?->name;
    }
}
