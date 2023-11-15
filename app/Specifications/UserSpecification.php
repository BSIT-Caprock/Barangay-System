<?php

namespace App\Specifications;

use App\Models\User;

class UserSpecification
{
    protected static function getUser(?User $user = null)
    {
        return $user ?? auth()->user();
    }
    public static function hasBarangay(?User $user = null)
    {
        return (bool) static::getUser($user)->barangay;
    }
}
