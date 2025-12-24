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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('address_en')->nullable();
            $table->string('address_bn')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();

            // ডিসকাউন্ট ব্যাজগুলোর জন্য JSON কলাম (যাতে একাধিক ব্যাজ রাখা যায়)
            $table->json('benefits')->nullable();

            $table->integer('sort_order')->default(0); // সিরিয়াল নম্বর হিসেবে কাজ করবে
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
