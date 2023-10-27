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
        SchemaPattern::createIdTimestamps('places', function (Blueprint $table) {
            $table->string('country');
            $table->string('province');
            $table->string('city_or_municipality');
        });

        SchemaPattern::createKeyRecordOf('barangay', function (Blueprint $table) {
            $table->foreignId('place_id');
            $table->string('barangay');
        });

        SchemaPattern::createIdTimestamps('zones', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained('barangay_records');
            $table->string('zone'); // subdivision name/zone/sitio/purok
        });

        SchemaPattern::createIdTimestamps('streets', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained('barangay_records');
            $table->string('street');
        });

        SchemaPattern::createIdTimestamps('houses', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained('barangay_records');
            $table->foreignId('zone_id');
            $table->foreignId('street_id');
            $table->string('number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SchemaPattern::dropIfExists('houses');
        SchemaPattern::dropIfExists('streets');
        SchemaPattern::dropIfExists('zones');
        SchemaPattern::dropKeyRecordOf('barangay');
        SchemaPattern::dropIfExists('places');
    }
};
