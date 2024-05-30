<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credential extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'recipient',
        'credential_template_id',
        'total_amount',
        'date_issued',
        'data',
    ];

    protected $casts = [
        'total_amount' => MoneyCast::class,
        'date_issued' => 'date',
        'data' => 'array',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(CredentialTemplate::class, 'credential_template_id');
    }
}
