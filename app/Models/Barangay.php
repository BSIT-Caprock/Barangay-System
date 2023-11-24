<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = [
        'name',
    ];

    public function __toString()
    {
        return $this->name;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function streets()
    {
        return $this->hasMany(Street::class);
    }

    public function households()
    {
        return $this->hasMany(Household::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function inhabitants()
    {
        return $this->hasMany(Inhabitant::class);
    }
}
