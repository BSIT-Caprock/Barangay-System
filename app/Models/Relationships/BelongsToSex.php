<?php

namespace App\Models\Relationships;

use App\Models\Sex;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToSex
{
    protected function initializeBelongsToSex()
    {
        $this->mergeFillable([$this->getSexKey()]);
    }

    protected function getSexKey()
    {
        return $this->sexKey ?? 'sex_id';
    }

    public function sex(): BelongsTo
    {
        return $this->belongsTo(Sex::class, $this->getSexKey());
    }
    
    public function getAssignedSexAttribute()
    {
        return $this->sex?->name;
    }

    public function getIsMaleAttribute()
    {
        return $this->getSexKey() === Sex::MALE;
    }

    public function getIsFemaleAttribute()
    {
        return $this->getSexKey() === Sex::FEMALE;
    }
}
