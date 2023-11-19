<?php

namespace App\Models\Relationships;

use App\Models\Household;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToHousehold
{
    protected function initializeBelongsToHousehold()
    {
        $this->mergeFillable([$this->getHouseholdKey()]);
    }

    protected function getHouseholdKey()
    {
        return $this->householdKey ?? 'household_id';
    }

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class, $this->getHouseholdKey());
    }

    public function getHouseholdNumberAttribute()
    {
        return $this->household?->number;
    }
}
