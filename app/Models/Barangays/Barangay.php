<?php

namespace App\Models\Barangays;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barangays';

    protected $fillable = [
        'name',
        'logo',
    ];

    public function history()
    {
        return $this->hasMany(BarangayHistory::class);
    }
}
