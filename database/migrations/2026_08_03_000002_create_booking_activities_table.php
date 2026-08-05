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
        Schema::create('booking_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('patient_name');
            $table->string('action');
            $table->string('status')->default('accepted');
            $table->string('activity_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_activities');
    }
};
