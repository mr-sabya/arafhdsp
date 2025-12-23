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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., 'Bkash', 'Nagad', 'PayCheckout'
            $table->string('slug')->unique(); // e.g., 'bkash', 'paycheckout'
            $table->enum('type', ['manual', 'gateway'])->default('manual');

            // Fields for Manual Mobile Banking
            $table->string('account_number')->nullable();
            $table->string('qr_code')->nullable(); // Store file path
            $table->string('instruction')->nullable(); // e.g., "Send money to this personal number"

            // Fields for Automated Gateways
            $table->string('driver')->nullable(); // e.g., 'paycheckout', 'stripe'
            $table->json('config')->nullable(); // Store API Key, Secret, Mode (Sandbox/Live)

            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
