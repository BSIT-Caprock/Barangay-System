<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthPlace extends Model
{
    use \App\Attributes\InhabitantsAttribute;

    protected $fillable = [
        'province',
        'city_or_municipality',
        'name',
    ];

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
