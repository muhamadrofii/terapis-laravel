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
        Schema::create('qris_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('merchant_name')->default('SerenePath Mental Health');
            $table->string('merchant_city')->default('Jakarta');
            $table->string('provider_name')->default('GoPay QRIS / All Payment');
            $table->string('qris_image')->nullable();
            $table->text('static_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qris_settings');
    }
};
