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
        // 1. Master List of Services (e.g., Doctor Visit, X-Ray, Medicine)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['limit', 'discount'])->default('limit');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 2. Pivot Table: Link Plans to Services with specific rules
        Schema::create('plan_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');

            // Quota logic (For 'limit' type)
            $table->integer('quantity')->default(0)->comment('How many times allowed');
            $table->enum('frequency', ['monthly', 'yearly', 'lifetime', 'per_instance'])->default('monthly');

            // Benefit logic (For 'discount' type)
            $table->decimal('discount_value', 5, 2)->nullable()->comment('Percentage or Fixed amount off');

            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     * Dropping in reverse order to avoid foreign key constraint violations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_service');
        Schema::dropIfExists('services');
    }
};