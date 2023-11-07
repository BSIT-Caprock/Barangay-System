<?php

namespace Tests\Feature\Models;

use App\Models\DocumentRequest;
use App\Models\DocumentTemplate;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
    }

    public function test_must_have_template()
    {
        // create a template
        $template = DocumentTemplate::create([
            'filename' => 'template.docx',
        ]);
        // create a request
        $request = DocumentRequest::create([
            'barangay_id' => 1,
            'document_template_id' => $template->id,
        ]);
        $this->assertModelExists($request->template);
    }

    public function test_can_generate_document()
    {
        // create a template
        $template = DocumentTemplate::create([
            'filename' => 'template.docx',
        ]);
        // create a request
        $request = DocumentRequest::create([
            'barangay_id' => 1,
            'document_template_id' => $template->id,
        ]);
        // set form data
        $request->setFormData([
            'placeholder1' => 'Test A',
            'placeholder2' => 'Test B',
        ]);
        // call generate method
        $request->generateDocument();
        // save
        $request->save();
        $filepath = $request->getFilePath();
        $this->assertFileExists($filepath);
    }
}
