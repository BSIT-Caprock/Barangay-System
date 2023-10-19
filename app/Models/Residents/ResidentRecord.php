<?php

namespace App\Models\Residents;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Models\Abstract\RecordModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ResidentRecord extends RecordModel
{
    protected $table = 'resident_records';
    
    protected $fillable = [
        'key_id',
        'household_record_id',
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

    protected static $keyModel = Resident::class;

    public function barangay()
    {
        return $this->hasOneThrough(BarangayRecord::class, HouseholdRecord::class);
    }

    public function household()
    {
        return $this->belongsTo(HouseholdRecord::class);
    }

    public function birth_place()
    {
        return $this->belongsTo(BirthPlace::class);
    }

    public function citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function residence_address()
    {
        return $this->belongsTo(ResidenceAddress::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => (
                $attributes['last_name'].', '.$attributes['first_name']
            ),
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => (
                'TODO: use `ResidenceAddress` model'
            ),
        );
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Carbon::parse($this->attributes['birth_date'])->age,
        );
    }
}
