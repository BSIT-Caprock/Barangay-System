<?php

use App\Database\SchemaPattern;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        SchemaPattern::createKeyRecordOf('household', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable();
            $table->string('number');
        });

        SchemaPattern::createKeyRecordOf('resident', function (Blueprint $table) {
            $table->foreignId('household_id')->nullable()->constrained('household_records');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->foreignId('suffix_id')->nullable()->constrained();
            $table->foreignId('birth_place_id')->nullable()->constrained('places');
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable(); // F, M
            $table->string('civil_status')->nullable(); // S, M, W, SE
            $table->foreignId('citizenship_id')->nullable()->constrained();
            $table->foreignId('occupation_id')->nullable()->constrained();
            $table->foreignId('residence_id')->nullable()->constrained('houses');
            $table->string('left_fingerprint')->nullable();
            $table->string('right_fingerprint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SchemaPattern::dropKeyRecordOf('resident');
        SchemaPattern::dropKeyRecordOf('household');
    }
};
