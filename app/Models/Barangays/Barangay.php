<?php

namespace App\Models\Barangays;

use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory, HasHistory, SoftDeletes;

    protected $table = 'barangays';

    protected $fillable = [
        'name',
        'logo',
    ];

    protected $historyModel = BarangayHistory::class;
}
