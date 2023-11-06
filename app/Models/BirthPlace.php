<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthPlace extends Model
{
    protected $fillable = [
        'province',
        'city_or_municipality',
        'label',
    ];

    public static function boot()
    {
        parent::boot();

        // When creating a new record
        static::creating(function (self $model) {
            $model->autosetLabel();
        });

        // When updating an existing record
        static::updating(function (self $model) {
            $model->autosetLabel();
        });
    }

    // Method to set the label attribute
    public function autosetLabel()
    {
        if ($this->label === null || trim($this->label) === '') {
            if ($this->isDirty('city_or_municipality') || $this->isDirty('province')) {
                $this->label = implode(', ', array_filter([
                    $this->city_or_municipality,
                    $this->province,
                ], fn ($x) => !empty($x)));
            }
        }
    }
}
