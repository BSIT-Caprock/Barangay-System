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
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number');
            $table->unsignedInteger('receipt_amount');
            $table->string('recipient');
            $table->date('date_issued');
            $table->foreignId('credential_template_id');
            $table->jsonb('credential_template_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credentials');
    }
};
