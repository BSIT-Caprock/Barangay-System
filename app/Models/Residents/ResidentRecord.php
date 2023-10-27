<?php

namespace App\Models\Residents;

use App\Enums\CivilStatus;
use App\Enums\Gender;
use App\Models\Abstract\RecordModel;
use App\Models\Lists\Citizenship;
use App\Models\Lists\Occupation;
use App\Models\Locations\BarangayRecord;
use App\Models\Locations\House;
use App\Models\Locations\Place;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ResidentRecord extends RecordModel
{
    protected $table = 'resident_records';

    protected static $keyModel = Resident::class;
    
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
        'residence_id',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'civil_status' => CivilStatus::class,
    ];

    public function barangay()
    {
        return $this->hasOneThrough(BarangayRecord::class, HouseholdRecord::class, 'barangay_id', 'household_id');
    }

    public function household()
    {
        return $this->belongsTo(HouseholdRecord::class, 'household_id');
    }

    public function birth_place()
    {
        return $this->belongsTo(Place::class, 'birth_place_id');
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
        return $this->belongsTo(House::class, 'residence_id');
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
                'TODO: use `House` model'
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
