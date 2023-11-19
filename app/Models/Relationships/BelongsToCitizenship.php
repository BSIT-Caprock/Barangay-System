<?php

namespace App\Models\Relationships;

use App\Models\Citizenship;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCitizenship
{
    protected function initializeBelongsToCitizenship()
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

    public function getCitizenshipNameAttribute()
    {
        return $this->citizenship?->name;
    }
}
