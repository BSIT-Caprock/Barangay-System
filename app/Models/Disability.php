<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    protected $fillable = ['name'];

    public function __toString()
    {
        return $this->name;
    }

    public function persons()
    {
        return $this->hasMany(PersonWithDisability::class);
    }
}
