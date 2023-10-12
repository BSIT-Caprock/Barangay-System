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

    public function record_history()
    {
        return $this->hasMany(static::class, 'key_id', 'key_id');
    }

    public function latest_record()
    {
        return $this->record_history()->one()->ofMany();
    }

    public static function createWithNewKey(array $data)
    {
        // Create a new key model and associate it with the record
        $key = static::$keyModel::create();
        $key->save();
        $record = new static($data);
        $record->record_key()->associate($key);
        $record->save();

        return $record;
    }

    public function newRecord(array $data)
    {
        $record = new static($data);
        $record->record_key()->associate($this->record_key);
        $record->save();

        return $record;
    }
}
