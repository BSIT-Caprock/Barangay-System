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
        Schema::create('birth_places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('province')->nullable();
            $table->string('city_or_municipality')->nullable(); // city/municipality
        });

        Schema::create('sexes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('civil_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('street_id')->nullable()->constrained();
            $table->foreignId('zone_id')->nullable()->constrained();
            $table->string('number');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->timestamps();
            $table->softDeletes();
        });

        $historized = function (Blueprint $table) {
            $table->foreignId('birth_place_id')->nullable()->constrained();
            $table->foreignId('sex_id')->nullable()->constrained();
            $table->foreignId('civil_status_id')->nullable()->constrained();
            $table->foreignId('citizenship_id')->nullable()->constrained();
            $table->foreignId('occupation_id')->nullable()->constrained();
            /**
             * if the house_id is provided, no need for street_id, zone_id
             */
            $table->foreignId('house_id')->nullable()->constrained();
            $table->foreignId('street_id')->nullable()->constrained();
            $table->foreignId('zone_id')->nullable()->constrained();
            $table->foreignId('household_id')->nullable()->constrained();
        };

        Schema::table('inhabitants', function (Blueprint $table) use ($historized) {
            $historized($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $historized = function (Blueprint $table) {
            $table->dropForeign(['birth_place_id']);
            $table->dropForeign(['sex_id']);
            $table->dropForeign(['civil_status_id']);
            $table->dropForeign(['citizenship_id']);
            $table->dropForeign(['occupation_id']);
            $table->dropForeign(['house_id']);
            $table->dropForeign(['street_id']);
            $table->dropForeign(['zone_id']);
            $table->dropForeign(['household_id']);
        };

        Schema::table('inhabitants', function (Blueprint $table) use ($historized) {
            $historized($table);
        });

        Schema::dropIfExists('birth_places');
        Schema::dropIfExists('sexes');
        Schema::dropIfExists('civil_statuses');
        Schema::dropIfExists('citizenships');
        Schema::dropIfExists('occupations');
        Schema::dropIfExists('streets');
        Schema::dropIfExists('houses');
        Schema::dropIfExists('zones');
        Schema::dropIfExists('households');
    }
};
