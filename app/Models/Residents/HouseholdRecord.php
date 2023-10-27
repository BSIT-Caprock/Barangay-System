<?php

namespace App\Models\Residents;

use App\Models\Abstract\RecordModel;
use App\Models\Locations\BarangayRecord;

class HouseholdRecord extends RecordModel
{
    protected $table = 'household_records';

    protected static $keyModel = Household::class;
    
    protected $fillable = [
        'key_id',
        'barangay_id',
        'number',
    ];

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class, 'barangay_id');
    }

    public function residents()
    {
        return $this->hasMany(ResidentRecord::class, 'household_id');
    }
}
