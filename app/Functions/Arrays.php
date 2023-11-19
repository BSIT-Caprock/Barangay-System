<?php

namespace App\Functions;

use Arr;

class Arrays
{

    public static function joinWhereNotNull(string $separator, array $array): string
    {
        return Arr::join(Arr::whereNotNull($array), $separator);
    }
}
