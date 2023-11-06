<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseholdHistory extends Model
{
    protected $table = 'household_history';

    protected $guarded = ['id'];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
