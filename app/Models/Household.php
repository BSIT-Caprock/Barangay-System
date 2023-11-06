<?php

namespace App\Models;

use App\Models\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Household extends Model
{
    use HasFactory, HasHistory, SoftDeletes;

    protected $historyModel = HouseholdHistory::class;

    protected $fillable = [
        'barangay_id',
        'number',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
