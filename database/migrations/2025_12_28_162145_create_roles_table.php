<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // e.g., 'hospital'
            $table->string('name');           // e.g., 'Hospital Partner'
            $table->timestamps();
        });

        // Insert the default roles immediately
        DB::table('roles')->insert([
            ['slug' => 'member',      'name' => 'Regular Member'],
            ['slug' => 'hospital',    'name' => 'Hospital Partner'],
            ['slug' => 'diagnostic',  'name' => 'Diagnostic Center'],
            ['slug' => 'worker',      'name' => 'Field Worker'],
            ['slug' => 'dealer',      'name' => 'Authorized Dealer'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
