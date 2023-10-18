<?php

namespace App\Models\Lookups;

use App\Models\ResidentRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidenceAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'street_id',
        'zone_id',
    ];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function resident_records()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
