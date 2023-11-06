<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentHistory extends Model
{
    protected $table = 'resident_history';

    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
