<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const ELEMENTARY_OR_HIGH_SCHOOL = 1;

    public const COLLEGE = 2;

    public const OUT_OF_SCHOOL_YOUTH = 3;

    public function __toString()
    {
        return $this->name;
    }
}
