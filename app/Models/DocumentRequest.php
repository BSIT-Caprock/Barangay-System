<?php

namespace App\Models;

use App\Casts\MoneyCast;
use ArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Str;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $casts = [
        'form_data' => 'array', //AsArrayObject::class,
        'fee_paid' => MoneyCast::class,
        'dst' => MoneyCast::class,
        'date_issued' => 'date',
    ];

    protected $guarded = ['id'];

    protected static function booted()
    {
        parent::booted();

        // static::creating(function (self $model) {
        //     // // get form_schema from template
        //     // // convert to an associate array
        //     // $formData = array_fill_keys($model->template->form_schema, null);
        //     // // assign to form data
        //     // $model->form_data = new ArrayObject($formData);
        // });

        // static::updating(function (self $model) {
        //     // bad idea
        //     // // get form_schema from template
        //     // // convert to an associate array
        //     // $formData = array_fill_keys($model->template->form_schema, null);
        //     // // assign to form data
        //     // $model->form_data = new ArrayObject($formData);
        // });
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function template()
    {
        return $this->belongsTo(DocumentTemplate::class, 'document_template_id');
    }

    public function setFormData(array $data)
    {
        $formData = array_fill_keys($this->template->form_schema, null);
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $formData)) {
                $formData[$key] = $value;
            }
        }
        $this->form_data = $formData;
    }

    public function generateDocument()
    {
        // open a template processor
        $templateProcessor = new TemplateProcessor($this->template->getTemplatePath());
        // set values with form data
        $templateProcessor->setValues($this->form_data);
        // set filename
        $fileName = Str::random(10) . '.docx';
        $outputPath = Storage::disk('local')->path('requests/' . $fileName);
        // save file
        $templateProcessor->saveAs($outputPath);
        // set filename
        $this->filename = $fileName;
    }

    public function getFilePath()
    {
        $filePath = Storage::disk('local')->path('requests/' . $this->filename);

        return $filePath;
    }
}
