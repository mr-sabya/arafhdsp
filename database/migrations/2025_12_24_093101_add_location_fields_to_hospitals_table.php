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
            $table->foreignId('division_id')->nullable()->after('photo')->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->after('division_id')->constrained()->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->after('district_id')->constrained()->onDelete('set null');
            $table->foreignId('area_id')->nullable()->after('upazila_id')->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropForeign(['division_id', 'district_id', 'upazila_id', 'area_id']);
            $table->dropColumn(['division_id', 'district_id', 'upazila_id', 'area_id']);
        });
    }
};
