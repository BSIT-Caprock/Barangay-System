<?php

namespace App\Models\Lookups;

use App\Models\ResidentRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupation',
    ];

    public function resident_records()
    {
            return $this->hasMany(ResidentRecord::class);
    }
}
