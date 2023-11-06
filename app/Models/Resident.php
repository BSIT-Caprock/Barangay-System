<?php

namespace App\Models;

use App\Models\Scopes\BarangayScope;
use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    use HasFactory, HasHistory, SoftDeletes;

    protected $historyModel = ResidentHistory::class;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function householdNumber(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->household->number
        );
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(', ', array_filter([
                $this->last_name,
                $this->first_name . ' ' . $this->middle_name,
            ], fn ($x) => !empty($x)))
        );
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function streetName(): Attribute
    {
        return Attribute::make(
            // get: fn () => $this->street->name
            get: fn () => 'temp street'
        );
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function zoneName(): Attribute
    {
        return Attribute::make(
            // get: fn () => $this->zone->name
            get: fn () => 'temp zone'
        );
    }

    public function birth_place(): BelongsTo
    {
        return $this->belongsTo(BirthPlace::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function civil_status()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }
}
