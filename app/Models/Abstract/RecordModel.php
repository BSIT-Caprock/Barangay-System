<?php

namespace App\Models\Abstract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class RecordModel extends Model
{
    use HasFactory;

    protected static $keyModel;

    public function record_key()
    {
        return $this->belongsTo(static::$keyModel, 'key_id');
    }
}
