<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'family_id',
        'inhabitant_id',
        'is_lgbtq',
        'has_disability',
        'has_disease',
        'is_pregnant',
        'pregnancy_due',
    ];
    
    public function getNameAttribute()
    {
        return $this->inhabitant->full_name;
    }

    public function inhabitant(): BelongsTo
    {
        return $this->belongsTo(Inhabitant::class);
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
