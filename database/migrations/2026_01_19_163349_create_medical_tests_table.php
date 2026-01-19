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
        // 2. Master Medical Tests Table (Belongs to a Category)
        Schema::create('medical_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_test_category_id')->constrained()->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_bn');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // 3. Pivot Table (Assigning specific tests to hospitals with pricing)
        Schema::create('hospital_medical_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
            $table->foreignId('medical_test_id')->constrained()->onDelete('cascade');

            $table->decimal('price', 10, 2); // Hospital's standard price
            $table->integer('discount_percent')->default(0); // Discount given to App users

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_medical_test');
        Schema::dropIfExists('medical_tests');
    }
};
