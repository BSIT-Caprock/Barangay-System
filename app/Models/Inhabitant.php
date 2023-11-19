<?php

namespace App\Models;

use App\Functions\Arrays;
use App\Models\Relationships\BelongsToBarangay;
use App\Models\Relationships\BelongsToBirthPlace;
use App\Models\Relationships\BelongsToCitizenship;
use App\Models\Relationships\BelongsToCivilStatus;
use App\Models\Relationships\BelongsToHouse;
use App\Models\Relationships\BelongsToHousehold;
use App\Models\Relationships\BelongsToOccupation;
use App\Models\Relationships\BelongsToSex;
use App\Models\Relationships\BelongsToStreet;
use App\Models\Relationships\BelongsToZone;
use App\Models\Scopes\BarangayScope;
use App\Models\Traits\AuthBarangay;
use App\Models\Traits\HasHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inhabitant extends Model
{
    use HasFactory,
        BelongsToBarangay,
        BelongsToHousehold,
        BelongsToHouse,
        BelongsToStreet,
        BelongsToZone,
        BelongsToBirthPlace,
        BelongsToSex,
        BelongsToCivilStatus,
        BelongsToCitizenship,
        BelongsToOccupation,
        SoftDeletes,
        // HasHistory,
        AuthBarangay;

    // protected $historyModel = InhabitantHistory::class;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'birth_date',
        'date_accomplished',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function getFullNameAttribute()
    {
        return Arrays::joinWhereNotNull(', ', [
            $this->last_name,
            Arrays::joinWhereNotNull(' ', [
                $this->first_name,
                $this->middle_name,
                $this->extension_name,
            ]),
        ]);
    }

    public function getAddressAttribute()
    {
        return Arrays::joinWhereNotNull(', ', [
            $this->house_number,
            $this->street_name, 
            $this->zone_name,
        ]) ?: null;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }
}
