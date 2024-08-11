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
        Schema::create('rbi_households', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rbi_inhabitants', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('zone_name')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('occupation')->nullable();
            $table->foreignId('rbi_household_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rbi_inhabitants');
        Schema::dropIfExists('rbi_households');
    }
};
