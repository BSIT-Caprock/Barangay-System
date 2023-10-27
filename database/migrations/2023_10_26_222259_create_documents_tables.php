<?php

use App\Database\Blueprint;
use App\Database\SchemaPattern;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        SchemaPattern::createIdTimestamps('document_templates', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained('barangay_records');
            $table->string('template'); // path to the template
            $table->unsignedInteger('price')->nullable(); // must be cast to float
        });
        
        SchemaPattern::createIdTimestamps('document_requests', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained('barangay_records');
            $table->foreignId('template_id')->constrained('document_templates');
            $table->jsonb('template_data')->nullable(); // null means pending/unprocessed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SchemaPattern::dropIfExists('document_requests');
        SchemaPattern::dropIfExists('document_templates');
    }
};
