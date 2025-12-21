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
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');    // A+, A-, B+, etc.
            $table->string('bn_name')->nullable(); // এ পজিটিভ, এ নেগেটিভ
            $table->string('slug')->unique();      // a-positive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_groups');
    }
};
