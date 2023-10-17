<?php

namespace App\Models;

use App\Models\Abstract\KeyModel;

class Household extends KeyModel
{
    protected $table = 'household_keys';

    protected static $recordModel = HouseholdRecord::class;
}
