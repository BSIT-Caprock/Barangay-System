<?php

namespace App\Models\Traits;

use App\Models\Locations\BarangayRecord;
use Illuminate\Database\Eloquent\Builder;

/**
 * model must have a 'barangay' relationship
 */
trait BarangayScope
{
    
    public function scopeOfBarangayRecord(Builder $query, BarangayRecord $barangayRecord)
    {
        // where 'barangay' has 'id' equal to $barangayRecord->id
        return $query->whereHas('barangay', function (Builder $query) use ($barangayRecord) {
            $query->where('id', $barangayRecord->id);
        });
    }
}
