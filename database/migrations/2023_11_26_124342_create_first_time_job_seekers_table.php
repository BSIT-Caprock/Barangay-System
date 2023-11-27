<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('educational_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('first_time_job_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->date('birth_date');
            $table->foreignId('sex_id')->constrained();
            $table->foreignId('educational_level_id')->constrained();
            $table->foreignId('course_id')->nullable()->constrained();
            $table->date('date_applied');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_time_job_seekers');
    }
};
