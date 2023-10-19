<?php

namespace App\Models\Households;

use App\Models\Abstract\RecordModel;

class HouseholdRecord extends RecordModel
{
    protected $fillable = [
        'key_id',
        'barangay_id',
        'number',
    ];

    protected static $keyModel = Household::class;

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class);
    }

    public function members()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
