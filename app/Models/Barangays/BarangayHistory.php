<?php

namespace App\Models\Barangays;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangayHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
