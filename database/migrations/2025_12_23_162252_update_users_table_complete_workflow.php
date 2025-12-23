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
            // 1. Modify existing columns
            // Make email nullable because we are using mobile for registration
            $table->string('email')->nullable()->change();

            // 2. Personal Information
            $table->string('father_name')->nullable()->after('name');
            $table->string('mobile')->unique()->after('father_name');
            $table->date('dob')->nullable()->after('mobile');
            $table->foreignId('blood_group_id')->nullable()->after('dob')->constrained()->onDelete('set null');
            $table->string('nid')->nullable()->after('blood_group_id');
            $table->string('photo')->nullable()->after('nid');

            // 3. Address Information
            $table->foreignId('division_id')->nullable()->after('photo')->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->after('division_id')->constrained()->onDelete('set null');
            $table->foreignId('upazila_id')->nullable()->after('district_id')->constrained()->onDelete('set null');
            $table->foreignId('area_id')->nullable()->after('upazila_id')->constrained()->onDelete('set null');

            // 4. Pricing & Package Information
            $table->foreignId('pricing_plan_id')->nullable()->after('area_id')->constrained()->onDelete('set null');
            $table->string('package_level')->nullable()->after('pricing_plan_id'); // Stores the name of the plan at time of reg
            $table->integer('family_members')->default(1)->after('package_level');
            $table->decimal('total_price', 10, 2)->default(0.00)->after('family_members');

            // 5. Verification & Security (OTP)
            $table->string('otp')->nullable()->after('password');
            $table->timestamp('otp_expires_at')->nullable()->after('otp');
            $table->boolean('is_verified')->default(false)->after('otp_expires_at');

            // 6. Payment & Admin Approval Workflow
            // payment_status: pending, paid, failed, pending_renewal
            $table->string('payment_status')->default('pending')->after('is_verified');
            // application_status: pending, approved, rejected
            $table->string('application_status')->default('pending')->after('payment_status');
            $table->string('transaction_id')->nullable()->unique()->after('application_status');
            $table->string('payment_method')->nullable()->after('transaction_id');
            $table->string('nominee_name')->nullable()->after('payment_method');
            $table->string('nominee_relation')->nullable()->after('nominee_name');

            // 7. Monthly Subscription Tracking
            $table->timestamp('subscription_expires_at')->nullable()->after('nominee_relation');
            $table->timestamp('last_payment_date')->nullable()->after('subscription_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop Foreign Keys first
            $table->dropForeign(['blood_group_id', 'division_id', 'district_id', 'upazila_id', 'area_id', 'pricing_plan_id']);

            // Drop all added columns
            $table->dropColumn([
                'father_name',
                'mobile',
                'dob',
                'nid',
                'photo',
                'division_id',
                'district_id',
                'upazila_id',
                'area_id',
                'pricing_plan_id',
                'package_level',
                'family_members',
                'total_price',
                'otp',
                'otp_expires_at',
                'is_verified',
                'payment_status',
                'application_status',
                'transaction_id',
                'payment_method',
                'nominee_name',
                'nominee_relation',
                'subscription_expires_at',
                'last_payment_date'
            ]);

            // Revert email to NOT NULL if required
            $table->string('email')->nullable(false)->change();
        });
    }
};
