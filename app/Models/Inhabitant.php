<?php

namespace App\Models;

use App\Helpers\Strings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inhabitant extends Model
{
    use \App\Attributes\BarangayAttribute;
    use \App\Attributes\BirthPlaceAttribute;
    use \App\Attributes\CitizenshipAttribute;
    use \App\Attributes\CivilStatusAttribute;
    use \App\Attributes\HouseAttribute;
    use \App\Attributes\HouseholdAttribute;
    use \App\Attributes\OccupationAttribute;
    use \App\Attributes\SexAttribute;
    use \App\Attributes\StreetAttribute;
    use \App\Attributes\ZoneAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'birth_date',
        'date_accomplished',
    ];

    public function getFullNameAttribute()
    {
        return Strings::joinWithoutNulls(', ', [
            $this->last_name,
            Strings::joinWithoutNulls(' ', [
                $this->first_name,
                $this->middle_name,
                $this->extension_name,
            ]),
        ]);
    }

    public function getFullNameFirstAttribute()
    {
        return Strings::joinWithoutNulls(' ', [
            $this->first_name,
            $this->middle_name,
            $this->last_name,
            $this->extension_name,
        ]);
    }

    public function getAddressAttribute()
    {
        return Strings::joinWithoutNulls(', ', [
            $this->house_number,
            $this->street_name,
            $this->zone_name,
        ]) ?: null;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function scopewhereFullName(Builder $query, string $search)
    {
        $split = array_map('trim', explode(',', $search, 2));
        $lastName = $split[0] ?? null;
        $firstName = $split[1] ?? $split[0];

        if (! empty($lastName)) {
            $query->where('last_name', 'like', "%{$lastName}%");
        }

        if (! empty($firstName)) {
            $query->orWhere('first_name', 'like', "%{$firstName}%");
        }
    }
}
