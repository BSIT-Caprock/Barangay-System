<?php

namespace App\Attributes;

use App\Models\Citizenship;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CitizenshipAttribute
{
    protected function initializeCitizenshipAttribute()
    {
        $this->mergeFillable([$this->getCitizenshipKey()]);
    }

    protected function getCitizenshipKey()
    {
        return $this->citizenshipKey ?? 'citizenship_id';
    }

    public function citizenship(): BelongsTo
    {
        return $this->belongsTo(Citizenship::class, $this->getCitizenshipKey());
    }
}
