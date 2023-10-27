<?php

namespace App\Models\Traits;

use App\Models\Barangays\BarangayRecord;
use Illuminate\Database\Eloquent\Builder;

trait BarangayScope
{
    public function scopeOfBarangayRecord(Builder $query, BarangayRecord $barangayRecord)
    {
        return $query->whereHas('barangay', function (Builder $query) use ($barangayRecord) {
            $query->where('id', $barangayRecord->id);
        });
    }
}
