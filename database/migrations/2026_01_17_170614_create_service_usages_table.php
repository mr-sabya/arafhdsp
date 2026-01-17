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
        // 3. Usage Logs: Track when and where a member used a service
        Schema::create('service_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The Patient/Member
            $table->foreignId('service_id')->constrained()->onDelete('cascade');

            // Where was this service provided?
            $table->foreignId('hospital_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('diagnostic_center_id')->nullable()->constrained()->onDelete('set null');

            // Who recorded this? (The staff member/admin)
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');

            $table->timestamp('consumed_at');
            $table->text('remarks')->nullable(); // e.g., "Dr. Kamal Visit", "Invoice #102"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_usages');
    }
};
