<?php

namespace App\Models\Abstract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class KeyModel extends Model
{
    use HasFactory;

    protected static $recordModel;

    public function records()
    {
        return $this->hasMany(static::$recordModel, 'key_id');
    }

    public function latest_record()
    {
        return $this->records()->one()->ofMany();
    }

    public function scopeUnused(Builder $query)
    {
        return $query->has('records', '=', 0);
    }

    public static function createRecord(array $attributes = [])
    {
        $model = static::create();
        $record = new static::$recordModel($attributes);
        $model->records()->save($record);
        $model->refresh();
        
        return $model;
    }
}
