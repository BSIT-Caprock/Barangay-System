<?php

namespace App\Models\Documents;

use App\Models\Locations\BarangayRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'template_id',
        'template_data',
    ];

    protected $casts = [
        'template_data' => 'array',
    ];

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class, 'barangay_id');
    }

    public function template()
    {
        return $this->belongsTo(DocumentTemplate::class, 'template_id');
    }
}
