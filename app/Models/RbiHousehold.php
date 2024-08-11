<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RbiHousehold extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'number',
    ];

    public function inhabitants(): HasMany
    {
        return $this->hasMany(RbiInhabitant::class, 'rbi_household_id');
    }
}
