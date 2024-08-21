<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrpwdPersonWithDisability extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'prpwd_persons_with_disabilities';

    protected $fillable = [
        'last_name',  
        'first_name',  
        'middle_name',  
        'suffix',  
        'address',  
        'disability_type',  
        'disability_cause',  
    ];
}
