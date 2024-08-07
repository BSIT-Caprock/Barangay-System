<?php

namespace App\Models\Generator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Output extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'template_id',
        'template_data',
    ];

    protected $casts = [
        'template_data' => 'array',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }
}
