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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id');
            $table->jsonb('template_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outputs');
        Schema::dropIfExists('templates');
    }
};
