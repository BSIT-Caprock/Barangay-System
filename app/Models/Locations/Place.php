<?php

namespace App\Models\Locations;

use App\Models\Abstract\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'province',
        'city_or_municipality',
    ];

    public function barangays()
    {
        return $this->hasMany(BarangayRecord::class);
    }
}
