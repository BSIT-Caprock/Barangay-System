<?php

namespace App\Models\Locations;

use App\Models\Abstract\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'zone',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
