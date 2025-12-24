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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');

            // Names & Designations
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('designation_en')->nullable(); // e.g. Medicine Specialist
            $table->string('designation_bn')->nullable(); // e.g. মেডিসিন বিশেষজ্ঞ
            $table->string('degree_en')->nullable();      // e.g. MBBS, FCPS
            $table->string('degree_bn')->nullable();      // e.g. এমবিবিএস, এফসিপিএস

            // Fee & Discount Logic
            $table->decimal('base_fee', 10, 2)->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->string('discount_badge_en')->nullable();
            $table->string('discount_badge_bn')->nullable();

            // Profile Details
            $table->text('bio_en')->nullable();
            $table->text('bio_bn')->nullable();
            $table->string('photo')->nullable();
            $table->string('appointment_number')->nullable();

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
        Schema::dropIfExists('doctors');
    }
};
