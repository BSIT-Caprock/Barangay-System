<?php

namespace App\Attributes;

use App\Models\Sex;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SexAttribute
{
    protected function initializeSexAttribute()
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

    public function scopeMale(Builder $query)
    {
        return $query->where($this->getSexKey(), Sex::MALE);
    }

    public function scopeFemale(Builder $query)
    {
        return $query->where($this->getSexKey(), Sex::FEMALE);
    }
}
