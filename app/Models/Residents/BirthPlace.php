<?php

namespace App\Models\Residents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_or_municipality',
        'province',
        'country',
    ];

    public function resident_records()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
