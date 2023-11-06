<?php

namespace App\Models;

use App\Models\Scopes\BarangayScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
