<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizenship',
    ];
}
