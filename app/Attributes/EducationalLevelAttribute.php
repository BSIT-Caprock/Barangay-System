<?php

namespace App\Attributes;

use App\Models\EducationalLevel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait EducationalLevelAttribute
{
    protected function initializeEducationalLevelAttribute()
    {
        $this->mergeFillable([$this->getEducationalLevelKey()]);
    }

    public function getEducationalLevelKey()
    {
        return $this->educationalLevelKey ?? 'educational_level_id';
    }

    public function educational_level(): BelongsTo
    {
        return $this->belongsTo(EducationalLevel::class, $this->getEducationalLevelKey());
    }
}
