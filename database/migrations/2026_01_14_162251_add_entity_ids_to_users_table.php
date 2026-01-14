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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('hospital_id')->nullable()->after('role_id')->constrained('hospitals')->onDelete('set null');
            $table->foreignId('diagnostic_center_id')->nullable()->after('hospital_id')->constrained('diagnostic_centers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['hospital_id']);
            $table->dropForeign(['diagnostic_center_id']);
            $table->dropColumn(['hospital_id', 'diagnostic_center_id']);
        });
    }
};
