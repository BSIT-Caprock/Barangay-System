<?php

namespace App\Models\Residents;

use App\Models\Abstract\KeyModel;

class Resident extends KeyModel
{
    protected $table = 'resident_keys';

    protected static $recordModel = ResidentRecord::class;
}
