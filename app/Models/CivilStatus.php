<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    public static function getSingle()
    {
        return static::find(1);
    }
    
    public static function getMarried()
    {
        return static::find(2);
    }

    public static function getWidowed()
    {
        return static::find(3);
    }

    public static function getSeparated()
    {
        return static::find(4);
    }
}
