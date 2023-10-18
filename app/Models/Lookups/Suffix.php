<?php

namespace App\Models\Lookups;

use App\Models\ResidentRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suffix extends Model
{
    use HasFactory;

    protected $fillable = [
        'suffix',
    ];

    public function resident_records()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
