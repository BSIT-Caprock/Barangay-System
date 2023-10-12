<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_or_municipality',
        'province',
    ];
}
