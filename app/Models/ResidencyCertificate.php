<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidencyCertificate extends Model
{
    use \App\Attributes\BarangayAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'resident_name',
        'resident_age',
        'resident_citizenship',
        'resident_civil_status',
        'punong_barangay',
        'date_issued',
        'amount_paid',
        'dst',
        'receipt_number',
    ];

    protected $casts = [
        'date_issued' => 'date',
    ];

    public function getTemplatePathAttribute()
    {
        return '/templates/brgy-25/residency-certificate.docx';
    }
}
