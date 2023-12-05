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
        Schema::create('residency_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->string('resident_name');
            $table->string('resident_age');
            $table->string('resident_citizenship');
            $table->string('resident_civil_status');
            $table->string('punong_barangay');
            $table->date('date_issued');
            $table->string('amount_paid');
            $table->string('dst');
            $table->string('receipt_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residency_certificates');
    }
};
