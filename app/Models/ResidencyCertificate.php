<?php

namespace App\Models;

use App\Contracts\DownloadableDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ResidencyCertificate extends Model implements DownloadableDocument
{
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

    public function getTemplate(): string
    {
        return Storage::path('/templates/brgy-25/residency-certificate.docx');
    }

    public function getTemplateValues(): array
    {
        return [
            'resident_name' => $this->resident_name,
            'resident_age' => $this->resident_age,
            'resident_citizenship' => $this->resident_citizenship,
            'resident_civil_status' => $this->resident_civil_status,
            'date_issued_day_ord' => $this->date_issued->isoFormat('Do'),
            'date_issued_month' => $this->date_issued->isoFormat('MMMM'),
            'date_issued_year' => $this->date_issued->isoFormat('YYYY'),
            'punong_barangay' => $this->punong_barangay,
            'amount_paid' => $this->amount_paid,
            'dst' => $this->dst,
            'receipt_number' => $this->receipt_number,
            'date_issued' => $this->date_issued->isoFormat('MMMM D, YYYY'),
        ];
    }

    public function getFilename(): string
    {
        return time()
            . '_' . \Illuminate\Support\Str::slug($this->resident_name)
            . '_' . pathinfo($this->getTemplate())['basename'];
    }
}
