<?php

namespace App\Models\Locations;

use App\Models\Abstract\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'street_id',
        'number',
    ];

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class, 'barangay_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function streetAndZone(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => $this->street->street . ', ' . $this->zone->zone,
        );
    }
}
