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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., সাধারণ
            $table->string('level_text'); // e.g., লেভেল ১
            $table->decimal('price', 8, 2); // e.g., 100
            // Strategy: 'fixed', 'per_member', or 'tiered'
            $table->string('pricing_type')->default('fixed');
            // For discounts: Store percentage (e.g., 30 for 30%)
            $table->integer('discount_percentage')->default(0);
            // For family/tiered: Store rules in JSON 
            $table->json('pricing_rules')->nullable();
            $table->json('features'); // We will store features as an array
            $table->boolean('is_featured')->default(false); // To highlight Level 2
            $table->string('ribbon_text')->nullable(); // e.g., সেরা পছন্দ
            $table->integer('sort_order')->default(0); // To arrange order

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
