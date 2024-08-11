<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RbiInhabitant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'house_number',
        'street_name',
        'zone_name',
        'birthplace',
        'birthdate',
        'sex',
        'civil_status',
        'citizenship',
        'occupation',
        'rbi_household_id',
    ];

    public function household(): BelongsTo
    {
        return $this->belongsTo(RbiHousehold::class);
    }
}
