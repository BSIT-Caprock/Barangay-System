<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentTemplate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'barangay_id',
        'name',
        'filename',
        'form_schema',
        'price',
    ];

    protected $casts = [
        'form_schema' => 'array', //AsArrayObject::class,
        'price' => MoneyCast::class,
    ];

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($documentTemplate) {
            $templateProcessor = new TemplateProcessor($documentTemplate->getTemplatePath());
            $formSchema = $templateProcessor->getVariables();
            $documentTemplate->form_schema = $formSchema;
        });

        static::updating(function ($documentTemplate) {
            $templateProcessor = new TemplateProcessor($documentTemplate->getTemplatePath());
            $formSchema = $templateProcessor->getVariables();
            $documentTemplate->form_schema = $formSchema;
        });

    }

    public function getTemplatePath()
    {
        $templatePath = Storage::disk('local')->path('templates/' . $this->filename);

        return $templatePath;
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
