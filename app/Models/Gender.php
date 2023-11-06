<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public static function getMale()
    {
        return static::find(1);
    }

    public static function getFemale()
    {
        return static::find(2);
    }
}
