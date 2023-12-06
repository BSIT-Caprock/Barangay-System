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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->nullableMorphs('location');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained();
            $table->foreignId('inhabitant_id')->constrained();
            $table->boolean('is_lgbtq')->nullable();
            $table->boolean('has_disability')->nullable();
            $table->boolean('has_disease')->nullable();
            $table->boolean('is_pregnant')->nullable();
            $table->date('pregnancy_due')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('families', function (Blueprint $table) {
            $table->foreignId('head_id')->nullable()->constrained('family_members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('families');
        Schema::dropIfExists('family_members');
        Schema::enableForeignKeyConstraints();
    }
};
