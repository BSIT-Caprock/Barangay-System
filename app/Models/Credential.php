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
        'receipt_amount',
        'recipient',
        'date_issued',
        'credential_template_id',
        'credential_template_data',
    ];

    protected $casts = [
        'receipt_amount' => MoneyCast::class,
        'date_issued' => 'date',
        'credential_template_data' => 'array',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(CredentialTemplate::class, 'credential_template_id');
    }
}
