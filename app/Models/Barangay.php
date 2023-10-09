<?php

namespace App\Models;

use App\Models\Abstract\RecordModel;

class Barangay extends RecordModel
{
    protected $fillable = [
        'key_id',
        'region',
        'province',
        'city_or_municipality',
        'barangay',
    ];

    protected static $keyModel = BarangayKey::class;

    public function households()
    {
        return $this->hasMany(Household::class);
    }
}
