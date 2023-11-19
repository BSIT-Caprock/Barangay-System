<?php

namespace App\Models\Relationships;

use App\Models\CivilStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCivilStatus
{
    protected function initializeBelongsToCivilStatus()
    {
        $this->mergeFillable([$this->getCivilStatusKey()]);
    }

    protected function getCivilStatusKey()
    {
        return $this->civilStatusKey ?? 'civil_status_id';
    }

    public function civil_status(): BelongsTo
    {
        return $this->belongsTo(CivilStatus::class, $this->getCivilStatusKey());
    }

    public function getCivilStatusNameAttribute()
    {
        return $this->civil_status?->name;
    }
}
