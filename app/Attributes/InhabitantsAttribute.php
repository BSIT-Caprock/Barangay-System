<?php

namespace App\Attributes;

use App\Models\Inhabitant;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InhabitantsAttribute
{
    public function getInhabitantKey()
    {
        return $this->inhabitantKey ?? $this->getForeignKey();
    }

    public function inhabitants(): HasMany
    {
        return $this->hasMany(Inhabitant::class, $this->getInhabitantKey());
    }
}
