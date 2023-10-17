<?php

namespace App\Models;

use App\Models\Abstract\RecordModel;

class HouseholdRecord extends RecordModel
{
    protected $fillable = [
        'key_id',
        'barangay_id',
        'number',
    ];

    protected static $keyModel = HouseholdKey::class;

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class);
    }

    public function members()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
