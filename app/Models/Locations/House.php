<?php

namespace App\Models\Locations;

use App\Models\Abstract\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'street_id',
        'number',
    ];

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class, 'barangay_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
