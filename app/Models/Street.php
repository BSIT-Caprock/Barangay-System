<?php

namespace App\Models;

use App\Models\Scopes\BarangayScope;
use App\Models\Traits\AuthBarangay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory, AuthBarangay;

    protected $guarded = ['id'];

    public function __toString()
    {
        return $this->name;
    }

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
        return $this->hasMany(Inhabitant::class);
    }
}
