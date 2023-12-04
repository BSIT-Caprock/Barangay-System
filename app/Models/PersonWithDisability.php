<?php

namespace App\Models;

use App\Attributes\BarangayAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonWithDisability extends Model
{
    use BarangayAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persons_with_disabilities';

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'address',
        'disability_id',
        'disability_cause_id',
    ];

    public function disability(): BelongsTo
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }

    public function disability_cause(): BelongsTo
    {
        return $this->belongsTo(DisabilityCause::class, 'disability_cause_id');
    }
}
