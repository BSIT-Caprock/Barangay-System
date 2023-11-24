<?php

namespace App\Attributes;

use App\Models\Street;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait StreetAttribute
{
    protected function initializeStreetAttribute()
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
