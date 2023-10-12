<?php

namespace App\Models;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Models\Abstract\RecordModel;

class Resident extends RecordModel
{
    protected $fillable = [
        'key_id',
        'household_id',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'birth_place_id',
        'birth_date',
        'gender',
        'civil_status',
        'citizenship_id',
        'occupation_id',
        'residence_address_id',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'civil_status' => CivilStatus::class,
    ];

    protected static $keyModel = ResidentKey::class;

    public function barangay()
    {
        return $this->hasOneThrough(Barangay::class, Household::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
