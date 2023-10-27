<?php

namespace App\Models\Residents;

use App\Models\Abstract\KeyModel;

class Household extends KeyModel
{
    protected $table = 'household_keys';

    protected static $recordModel = HouseholdRecord::class;
}
