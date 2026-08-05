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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignUuid('therapist_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('therapist_name');
            $table->string('patient_name');
            $table->string('session_type');
            $table->date('booking_date');
            $table->string('booking_time');
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->text('qris_payload')->nullable();
            $table->text('notes')->nullable();
            $table->string('price')->default('Rp 350.000');
            $table->string('whatsapp_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
