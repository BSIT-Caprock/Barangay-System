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
        Schema::create('personnel_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('personnel_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained('personnel_keys');
            $table->foreignId('barangay_record_id')->constrained();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix_id')->nullable()->constrained();
            $table->string('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_records');
        Schema::dropIfExists('personnel_keys');
    }
};
