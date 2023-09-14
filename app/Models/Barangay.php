<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;
    protected $fillable = [
        'key_id',
        'region',
        'province',
        'city_or_municipality',
        'barangay',
    ];

    public function record_key()
    {
        return $this->belongsTo(BarangayKey::class, 'key_id');
    }

    public function record_history()
    {
        return $this->hasMany(self::class, 'key_id', 'key_id');
    }

    public static function createWithNewKey(array $data): Barangay
    {
        $key = new BarangayKey();
        $key->save();
        $brgy = new Barangay($data);
        $brgy->record_key()->associate($key);
        $brgy->save();
        return $brgy;
    }

    public function newRecord(array $data): Barangay
    {
        $brgy = new Barangay($data);
        $brgy->record_key()->associate($this->record_key);
        $brgy->save();
        return $brgy;
    }
}
