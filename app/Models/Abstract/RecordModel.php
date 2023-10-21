<?php

namespace App\Models\Abstract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class RecordModel extends Model
{
    use HasFactory;

    protected static $keyModel;

    protected static $keyId = 'key_id';

    public function record_key()
    {
        return $this->belongsTo(static::$keyModel, static::$keyId);
    }
}
