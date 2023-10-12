<?php

namespace App\Models;

use App\Models\Abstract\KeyModel;

class ResidentKey extends KeyModel
{
    protected static $recordModel = Resident::class;
}
