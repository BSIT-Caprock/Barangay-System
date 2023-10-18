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
        Schema::create('household_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('household_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained('household_keys');
            $table->foreignId('barangay_record_id')->constrained();
            $table->string('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_records');
        Schema::dropIfExists('household_keys');
    }
};
