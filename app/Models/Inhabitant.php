<?php

namespace App\Models;

use App\Models\Scopes\BarangayScope;
use App\Models\Traits\HasHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inhabitant extends Model
{
    use HasFactory, HasHistory, SoftDeletes;

    protected $historyModel = InhabitantHistory::class;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }

    public function household(): BelongsTo
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

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function houseNumber(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->house->number
        );
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    public function streetName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->street->name
        );
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function zoneName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->zone->name
        );
    }

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->birth_date)->age
        );
    }

    public function birthPlace(): BelongsTo
    {
        return $this->belongsTo(BirthPlace::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Sex::class);
    }

    public function civilStatus(): BelongsTo
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship(): BelongsTo
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }
}
