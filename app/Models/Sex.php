<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use \App\Attributes\InhabitantsAttribute;

    public $timestamps = false;

    public const MALE = 1;

    public const FEMALE = 2;

    public function __toString()
    {
        return $this->name;
    }

    public static function Male(): self
    {
        return self::find(self::MALE);
    }

    public static function Female(): self
    {
        return self::find(self::FEMALE);
    }
}
