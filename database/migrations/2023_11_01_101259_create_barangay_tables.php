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
        $this->down();
        
        // columns to track in history
        $tracked = function (Blueprint $table) {
            $table->string('name');
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        };
        
        Schema::create('barangays', function (Blueprint $table) use ($tracked) {
            $table->id();
            $tracked($table);
        });
        
        Schema::create('barangay_histories', function (Blueprint $table) use ($tracked) {
            $table->id();
            $table->foreignId('barangay_id');
            $tracked($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangay_histories');
        Schema::dropIfExists('barangays');
    }
};
