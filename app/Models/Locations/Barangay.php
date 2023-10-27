<?php

namespace App\Models\Locations;

use App\Models\Abstract\KeyModel;

class Barangay extends KeyModel
{
    protected $table = 'barangay_keys';

    protected static $recordModel = BarangayRecord::class;
}
