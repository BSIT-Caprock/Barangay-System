<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'date_payed',
        'name',
        'particulars',
        'date_applied',
        'date_release',
        'date_recieved',
        'image_signature',
    ];
}
