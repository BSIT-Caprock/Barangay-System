<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
    ];

    public function residence_addresses()
    {
        return $this->hasMany(ResidenceAddress::class);
    }
}
