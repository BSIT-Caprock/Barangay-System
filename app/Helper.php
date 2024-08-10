<?php

namespace App;

use Illuminate\Support\Arr;

class Helper
{
    public static function rename_key(array &$array, string $parentPath, string $oldName, string $newName): array
    {
        $value = Arr::get($array, $parentPath . '.' . $oldName);
        Arr::forget($array, $parentPath . '.' . $oldName);
        $parentArray = Arr::get($array, $parentPath);
        $parentArray[$newName] = $value;
        Arr::set($array, $parentPath, $parentArray);
        return $array;
    }
}
