<?php

namespace App\Attributes;

use App\Models\CivilStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CivilStatusAttribute
{
    protected function initializeCivilStatusAttribute()
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

    public function scopeSingle(Builder $query)
    {
        return $query->where($this->getCivilStatusKey(), CivilStatus::SINGLE);
    }

    public function scopeMarried(Builder $query)
    {
        return $query->where($this->getCivilStatusKey(), CivilStatus::MARRIED);
    }

    public function scopeWidowed(Builder $query)
    {
        return $query->where($this->getCivilStatusKey(), CivilStatus::WIDOWED);
    }

    public function scopeSeparated(Builder $query)
    {
        return $query->where($this->getCivilStatusKey(), CivilStatus::SEPARATED);
    }
}
