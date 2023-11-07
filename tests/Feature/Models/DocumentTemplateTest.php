<?php

namespace Tests\Feature\Models;

use App\Models\DocumentTemplate;
use Database\Seeders\BarangaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Tests\TestCase;

class DocumentTemplateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_may_have_barangay()
    {
        $this->seed(BarangaySeeder::class);
        $filename = 'template.docx';

        // notice how we didn't set the barangay
        $template = DocumentTemplate::create([
            'filename' => $filename,
        ]);
        $template->update([
            'barangay_id' => 1,
        ]);
        $this->assertModelExists($template->barangay);
    }

    public function test_may_have_price()
    {
        $filename = 'template.docx';

        // notice how we didn't set the price
        $template = DocumentTemplate::create([
            'filename' => $filename,
        ]);
        $template->update([
            'price' => 100.00,
        ]);

        $this->assertEquals(100.00, $template->price);
    }

    public function test_automatically_fill_form_schema_from_file()
    {
        $filename = 'template.docx';
        
        // notice we didn't set the form_schema
        $template = DocumentTemplate::create([
            'filename' => $filename,
        ]);
        
        $filePath = Storage::disk('local')->path('templates/' . $filename);
        $templateProcessor = new TemplateProcessor($filePath);
        $formSchema = $templateProcessor->getVariables();
        dump($formSchema);
        $this->assertEqualsCanonicalizing($formSchema, $template->form_schema);
    }
}
