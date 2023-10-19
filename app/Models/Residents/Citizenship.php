<?php

namespace App\Models\Residents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;

    protected $table = 'citizenships';

    protected $fillable = [
        'citizenship',
    ];

    public function resident_records()
    {
        return $this->hasMany(ResidentRecord::class);
    }
}
