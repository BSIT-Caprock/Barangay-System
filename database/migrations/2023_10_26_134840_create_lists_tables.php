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
        Schema::create('suffixes', function (Blueprint $table) {
            $table->id();
            $table->string('suffix');
        });

        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->string('citizenship');
        });

        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('occupation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suffixes');
        Schema::dropIfExists('citizenships');
        Schema::dropIfExists('occupations');
    }
};
