<?php

namespace App\Helpers;

use Arr;

class Strings
{
    public static function joinWithoutNulls(string $separator, array $array): string
    {
        return Arr::join(Arr::whereNotNull($array), $separator);
    }
}
