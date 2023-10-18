<?php

namespace App\Models\Lookups;

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
}
