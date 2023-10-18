<?php

namespace App\Models\Lookups;

use App\Models\ResidentRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizenship',
    ];

    public function resident_records()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
