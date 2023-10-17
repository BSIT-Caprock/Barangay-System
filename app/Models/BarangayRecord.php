<?php

namespace App\Models;

use App\Models\Abstract\RecordModel;

class BarangayRecord extends RecordModel
{
    protected $fillable = [
        'key_id',
        'region',
        'province',
        'city_or_municipality',
        'barangay',
    ];

    protected static $keyModel = Barangay::class;

    public function households()
    {
        return $this->hasMany(HouseholdRecord::class);
    }

    public function residents()
    {
        return $this->hasManyThrough(ResidentRecord::class, HouseholdRecord::class);
    }
}
