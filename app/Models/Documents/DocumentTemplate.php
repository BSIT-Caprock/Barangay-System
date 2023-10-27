<?php

namespace App\Models\Documents;

use App\Models\Locations\BarangayRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay_id',
        'template',
        'price',
    ];

    public function barangay()
    {
        return $this->belongsTo(BarangayRecord::class, 'barangay_id');
    }

    public function requests()
    {
        return $this->hasMany(DocumentRequest::class, 'template_id');
    }
}
