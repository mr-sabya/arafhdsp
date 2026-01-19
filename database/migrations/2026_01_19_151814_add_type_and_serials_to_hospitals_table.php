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
        Schema::table('hospitals', function (Blueprint $table) {
            // Adding the 'type' column (hospital, clinic, etc.)
            // We place it after 'photo' for organization
            $table->string('type')->default('hospital')->after('photo');

            // Adding 'serial_phones' as a JSON column to store multiple numbers
            // We place it after the main 'phone' column
            $table->json('serial_phones')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn(['type', 'serial_phones']);
        });
    }
};
