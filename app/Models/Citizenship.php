<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
