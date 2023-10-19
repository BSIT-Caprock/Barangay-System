<?php

namespace App\Models\Lookups;

use App\Models\BarangayRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = [
        'barangay_id',
        'zone',
    ];

    public function barangay_record()
    {
        return $this->belongsTo(BarangayRecord::class);
    }

    public function residence_addresses()
    {
        return $this->hasMany(ResidenceAddress::class);
    }
}
