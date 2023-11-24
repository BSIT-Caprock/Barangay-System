<?php

namespace App\Attributes;

use App\Models\Barangay;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BarangayAttribute
{
    protected function initializeBarangayAttribute()
    {
        $this->mergeFillable([$this->getBarangayKey()]);
    }

    public function getBarangayKey()
    {
        return $this->barangayKey ?? 'barangay_id';
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, $this->getBarangayKey());
    }
}
