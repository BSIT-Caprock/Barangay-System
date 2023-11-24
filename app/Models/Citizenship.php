<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use \App\Attributes\InhabitantsAttribute;

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
