<?php

namespace App\Models\Barangays;

use App\Models\Abstract\KeyModel;

class Barangay extends KeyModel
{
    protected $table = 'barangay_keys';

    protected static $recordModel = BarangayRecord::class;
}
