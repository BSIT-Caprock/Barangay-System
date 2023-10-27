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
        SchemaPattern::createKeyRecordOf('personnel', function (Blueprint $table) {
            $table->foreignId('barangay_id')->constrained('barangay_records');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix_id')->nullable()->constrained();
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SchemaPattern::dropKeyRecordOf('personnel');
    }
};
