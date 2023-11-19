<?php

namespace App\Models;

use App\Functions\Arrays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthPlace extends Model
{
    protected $fillable = [
        'province',
        'city_or_municipality',
        'name',
    ];

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }

    public static function boot()
    {
        parent::boot();

        // When creating a new record
        static::creating(function (self $model) {
            $model->autoName();
        });

        // When updating an existing record
        static::updating(function (self $model) {
            $model->autoName();
        });
    }

    // Method to set the name attribute
    public function autoName()
    {
        if ($this->name === null || trim($this->name) === '') {
            if ($this->isDirty('city_or_municipality') || $this->isDirty('province')) {
                $this->name = Arrays::joinWhereNotNull(', ', [
                    $this->city_or_municipality,
                    $this->province,
                ]);
            }
        }
    }

    public function inhabitants()
    {
        return $this->hasMany(Inhabitant::class);
    }
}
