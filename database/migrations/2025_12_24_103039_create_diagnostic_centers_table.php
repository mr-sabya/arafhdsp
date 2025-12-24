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
        Schema::create('diagnostic_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');

            // Location Fields
            $table->foreignId('division_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('set null');

            $table->string('address_en')->nullable();
            $table->string('address_bn')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable(); // Center Image

            // Offers & Tests
            $table->string('discount_badge_en')->nullable(); // e.g., Up to 50% Off
            $table->string('discount_badge_bn')->nullable(); // e.g., ৫০% পর্যন্ত ছাড়
            $table->json('test_list')->nullable(); // Array of tests like ["CBC", "RBS"]

            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_centers');
    }
};
