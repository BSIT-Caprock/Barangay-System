<?php

namespace App\Models;

use App\Models\Abstract\KeyModel;

class BarangayKey extends KeyModel
{
    protected static $recordModel = Barangay::class;
}
