<?php

namespace App\Models;

use App\Models\Abstract\KeyModel;

class HouseholdKey extends KeyModel
{
    protected static $recordModel = HouseholdRecord::class;
}
