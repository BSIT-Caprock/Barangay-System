<?php

namespace App\Attributes;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HistoryAttribute
{
    public function getHistoryKey()
    {
        return $this->historyKey ?? $this->getForeignKey();
    }

    public function history(): HasMany
    {
        return $this->hasMany($this->historyModel, $this->getHistoryKey());
    }
}
