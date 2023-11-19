<?php

namespace App\Models;

use App\Models\Scopes\BarangayScope;
use App\Models\Traits\AuthBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory, AuthBarangay;

    protected $fillable = [
        'barangay_id',
        'street_id',
        'zone_id',
        'number',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function __toString()
    {
        return $this->number;
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function inhabitants()
    {
        return $this->hasMany(Inhabitant::class);
    }
}
