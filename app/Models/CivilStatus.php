<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use \App\Attributes\InhabitantsAttribute;

    public $timestamps = false;

    public const SINGLE = 1;

    public const MARRIED = 2;

    public const WIDOWED = 3;

    public const SEPARATED = 4;

    public function __toString()
    {
        return $this->name;
    }

    public static function Single()
    {
        return static::find(self::SINGLE);
    }

    public static function Married()
    {
        return static::find(self::MARRIED);
    }

    public static function Widowed()
    {
        return static::find(self::WIDOWED);
    }

    public static function Separated()
    {
        return static::find(self::SEPARATED);
    }
}
