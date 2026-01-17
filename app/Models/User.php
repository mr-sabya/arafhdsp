<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * -------------------------------------------------------------------------
     * Configuration & Attributes
     * -------------------------------------------------------------------------
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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

        // Subscription & Pricing
        'pricing_plan_id',
        'package_level',
        'family_members',
        'total_price',

        // Verification & OTP
        'otp',
        'otp_expires_at',
        'is_verified',

        // Payment & Application Status
        'payment_status',
        'application_status',
        'transaction_id',
        'payment_method',

        // Monthly Subscription Tracking
        'subscription_expires_at',
        'last_payment_date',

        // Referral System
        'referred_by',
        'referral_code',

        'hospital_id',
        'diagnostic_center_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

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

    /**
     * -------------------------------------------------------------------------
     * Relationships
     * -------------------------------------------------------------------------
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    // Address Relationships
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

    // Business Logic Relationships
    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }

    // Referral Relationships
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function diagnosticCenter()
    {
        return $this->belongsTo(DiagnosticCenter::class);
    }


    /**
     * -------------------------------------------------------------------------
     * Scopes
     * -------------------------------------------------------------------------
     */

    public function scopeReferredBy($query, $workerId)
    {
        return $query->where('referred_by', $workerId);
    }

    /**
     * -------------------------------------------------------------------------
     * Accessors & Mutators (Virtual Attributes)
     * -------------------------------------------------------------------------
     */

    /**
     * Get the count of successful referrals for a worker.
     * Usage: $user->commission_count
     */
    public function getCommissionCountAttribute()
    {
        if (!$this->isWorker()) return 0;

        return $this->referrals()
            ->where('application_status', 'approved')
            ->where('payment_status', 'paid')
            ->count();
    }

    /**
     * -------------------------------------------------------------------------
     * Role & Status Helpers
     * -------------------------------------------------------------------------
     */

    public function hasRole($slug)
    {
        return $this->role && $this->role->slug === $slug;
    }

    public function isHospital()
    {
        return $this->hasRole('hospital');
    }
    public function isDiagnostic()
    {
        return $this->hasRole('diagnostic');
    }
    public function isWorker()
    {
        return $this->hasRole('worker');
    }
    public function isDealer()
    {
        return $this->hasRole('dealer');
    }

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
     * -------------------------------------------------------------------------
     * Subscription Logic
     * -------------------------------------------------------------------------
     */

    public function isSubscriptionExpired()
    {
        return !$this->subscription_expires_at || now()->gt($this->subscription_expires_at);
    }

    public function subscriptionDaysLeft()
    {
        if ($this->isSubscriptionExpired()) return 0;
        return now()->diffInDays($this->subscription_expires_at);
    }

    /**
     * -------------------------------------------------------------------------
     * Referral System Logic
     * -------------------------------------------------------------------------
     */

    /**
     * Generate a unique referral code for a worker.
     */
    public static function generateReferralCode($name)
    {
        $prefix = strtoupper(substr($name, 0, 3));
        $code = $prefix . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Recursive check to ensure uniqueness
        if (static::where('referral_code', $code)->exists()) {
            return self::generateReferralCode($name);
        }

        return $code;
    }


    /**
     * Relationship to Service Usage Logs
     */
    public function serviceUsages()
    {
        return $this->hasMany(ServiceUsage::class, 'user_id');
    }

    /**
     * Helper: Get usage count for a specific service within its plan frequency
     */
    public function getServiceUsageCount($serviceSlug)
    {
        $service = Service::where('slug', $serviceSlug)->first();
        if (!$service || !$this->pricingPlan) return 0;

        $planEntitlement = $this->pricingPlan->services()->where('service_id', $service->id)->first();
        if (!$planEntitlement) return 0;

        $frequency = $planEntitlement->pivot->frequency;

        $query = $this->serviceUsages()->where('service_id', $service->id);

        if ($frequency === 'monthly') {
            $query->whereMonth('consumed_at', now()->month)
                ->whereYear('consumed_at', now()->year);
        } elseif ($frequency === 'yearly') {
            $query->whereYear('consumed_at', now()->year);
        }

        return $query->count();
    }

    /**
     * Helper: Check if a user has remaining quota for a service
     */
    public function hasServiceQuota($serviceSlug)
    {
        $service = Service::where('slug', $serviceSlug)->first();
        if (!$service) return false;

        // Discount types are always available if they are in the plan
        if ($service->type === 'discount') {
            return $this->pricingPlan->services()->where('service_id', $service->id)->exists();
        }

        // Limit types: compare usage vs plan quantity
        $planEntitlement = $this->pricingPlan->services()->where('service_id', $service->id)->first();
        if (!$planEntitlement) return false;

        return $this->getServiceUsageCount($serviceSlug) < $planEntitlement->pivot->quantity;
    }
}
