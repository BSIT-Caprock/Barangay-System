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
        if (!app()->environment('testing')) {
            return;
        }

        Schema::create('test_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        
        Schema::create('test_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained('test_keys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->environment('testing')) {
            return;
        }

        Schema::dropIfExists('test_keys');
        Schema::dropIfExists('test_records');
    }
};
