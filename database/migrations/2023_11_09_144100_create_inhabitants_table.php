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
        $historized = function (Blueprint $table) {
            $table->foreignId('barangay_id')->constrained();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            //
            $table->string('birth_date')->nullable();
            // $table->string('birth_place')->nullable();
            // $table->string('sex')->nullable();
            //
            // $table->string('civil_status')->nullable();
            // $table->string('citizenship')->nullable();
            // $table->string('profession/occupation')->nullable();
            //
            // $table->string('house_number')->nullable();
            // $table->string('street_name')->nullable();
            // $table->string('subdivision/zone/sitio/purok')->nullable();
            //
            $table->string('date_accomplished')->nullable();
            // $table->string('household_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        };

        Schema::create('inhabitants', function (Blueprint $table) use ($historized) {
            $table->id();
            $historized($table);
        });

        Schema::create('inhabitant_history', function (Blueprint $table) use ($historized) {
            $table->id();
            $table->foreignId('inhabitant_id')->constrained();
            $historized($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $historized = function (Blueprint $table) {
            $table->dropForeign(['barangay_id']);
        };

        Schema::table('inhabitants', function (Blueprint $table) use ($historized) {
            $historized($table);
        });
        Schema::table('inhabitant_history', function (Blueprint $table) use ($historized) {
            $table->dropForeign(['inhabitant_id']);
            $historized($table);
        });

        Schema::dropIfExists('inhabitants');
        Schema::dropIfExists('inhabitant_history');
    }
};
