<?php

namespace App\Models\Personnel;

use App\Models\Abstract\KeyModel;

class Personnel extends KeyModel
{
    protected $table = 'personnel_keys';

    protected static $recordModel = PersonnelRecord::class;
}
