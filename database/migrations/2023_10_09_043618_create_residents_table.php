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
        Schema::create('resident_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        /**
         * lookup table for name suffixes
         */
        Schema::create('suffixes', function (Blueprint $table) {
            $table->id();
            $table->string('suffix');
        });

        /**
         * list of birth places
         */
        Schema::create('birth_places', function (Blueprint $table) {
            $table->id();
            $table->string('city_or_municipality');
            $table->string('province');
        });

        /**
         * list of citizenships/nationalities
         */
        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->string('citizenship');
        });

        /**
         * list of occupations/professions
         */
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('occupation');
        });

        /**
         * list of streets
         */
        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->string('street');
        });

        /**
         * list of zones per barangay
         */
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->string('zone');
        });

        /**
         * list of residence addresses
         */
        Schema::create('residence_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('house_number');
            $table->foreignId('street_id')->nullable()->constrained();
            $table->foreignId('zone_id')->nullable()->constrained();
        });

        /**
         * We might need to optimize the foreign key joins 
         * or eliminate them using denormalization.
         */
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained('resident_keys');
            $table->foreignId('household_id')->constrained('households')->nullable()->constrained();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->foreignId('birth_place_id')->nullable()->constrained();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable(); // F, M
            $table->string('civil_status')->nullable(); // S, M, W, SE
            $table->foreignId('citizenship_id')->nullable()->constrained();
            $table->foreignId('occupation_id')->nullable()->constrained();
            $table->foreignId('residence_address_id')->nullable()->constrained();
            $table->string('left_fingerprint')->nullable();
            $table->string('right_fingerprint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
        Schema::dropIfExists('residence_addresses');
        Schema::dropIfExists('occupations');
        Schema::dropIfExists('citizenships');
        Schema::dropIfExists('birth_places');
        Schema::dropIfExists('suffixes');
        Schema::dropIfExists('resident_keys');
    }
};
