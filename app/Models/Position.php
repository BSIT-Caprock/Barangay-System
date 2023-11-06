<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public static function getPunongBarangay()
    {
        return static::find(1);
    }

    public static function getBarangaySecretary()
    {
        return static::find(2);
    }

    public static function getBarangayTreasurer()
    {
        return static::find(3);
    }

    public static function getBarangayKagawad()
    {
        return static::find(4);
    }
}
