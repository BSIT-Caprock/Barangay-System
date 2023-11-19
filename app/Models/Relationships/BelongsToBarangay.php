<?php

namespace App\Models\Relationships;

use App\Models\Barangay;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBarangay
{
    protected function initializeBelongsToBarangay()
    {
        $this->mergeFillable([$this->getBarangayKey()]);
    }

    protected function getBarangayKey()
    {
        return $this->barangayKey ?? 'barangay_id';
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, $this->getBarangayKey());
    }

    public function getBarangayNameAttribute()
    {
        return $this->barangay?->name;
    }
}
