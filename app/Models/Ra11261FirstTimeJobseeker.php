<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ra11261FirstTimeJobseeker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'birthdate',
        'sex',
        'educational_level',
        'course',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    protected function age(): Attribute
    {
        return Attribute::make(fn () => $this->birthdate->age);
    }
}
