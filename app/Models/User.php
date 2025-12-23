<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'father_name',
        'mobile',
        'dob',
        'blood_group_id',
        'nid',
        'photo',

        // Address Fields
        'division_id',
        'district_id',
        'upazila_id',
        'area_id',

        // Subscription & Pricing Fields
        'pricing_plan_id',
        'package_level',
        'family_members',
        'total_price',

        // Verification & OTP
        'otp',
        'otp_expires_at',
        'is_verified',

        // Payment & Application Status
        'payment_status',       // pending, paid, failed, pending_renewal
        'application_status',   // pending, approved, rejected
        'transaction_id',
        'payment_method',

        // Monthly Subscription Tracking
        'subscription_expires_at',
        'last_payment_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'dob' => 'date',
        'otp_expires_at' => 'datetime',
        'is_verified' => 'boolean',
        'subscription_expires_at' => 'datetime',
        'last_payment_date' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    // --- Relationships ---

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }

    // --- Helper Methods (Accessors) ---

    /**
     * Check if the user is fully approved and subscription is active.
     */
    public function isActiveMember()
    {
        return $this->is_verified && 
               $this->application_status === 'approved' && 
               !$this->isSubscriptionExpired();
    }

    /**
     * Check if the monthly subscription has expired.
     */
    public function isSubscriptionExpired()
    {
        if (!$this->subscription_expires_at) {
            return true;
        }
        return now()->gt($this->subscription_expires_at);
    }

    /**
     * Get remaining days in current subscription.
     */
    public function subscriptionDaysLeft()
    {
        if ($this->isSubscriptionExpired()) {
            return 0;
        }
        return now()->diffInDays($this->subscription_expires_at);
    }
}