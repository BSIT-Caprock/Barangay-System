<?php

namespace App\Models\Locations;

use App\Models\Abstract\RecordModel;
use App\Models\Personnel\PersonnelRecord;
use App\Models\Residents\HouseholdRecord;
use App\Models\Residents\ResidentRecord;

class BarangayRecord extends RecordModel
{
    protected $table = 'barangay_records';
    
    protected static $keyModel = Barangay::class;

    protected $fillable = [
        'key_id',
        'place_id',
        'barangay',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function households()
    {
        return $this->hasMany(HouseholdRecord::class, 'barangay_id');
    }

    public function residents()
    {
        return $this->hasManyThrough(ResidentRecord::class, HouseholdRecord::class, 'household_id', 'barangay_id');
    }

    public function personnel()
    {
        return $this->hasMany(PersonnelRecord::class, 'barangay_id');
    }
}
