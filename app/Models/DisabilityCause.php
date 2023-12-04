<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityCause extends Model
{
    use HasFactory;

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
