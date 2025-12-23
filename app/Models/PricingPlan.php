<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'level_text',
        'price',
        'billing_interval',    // Added: monthly, yearly, lifetime
        'pricing_type',        // fixed, per_member
        'discount_percentage',
        'pricing_rules',       // JSON for family rules
        'features',
        'is_featured',
        'ribbon_text',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'pricing_rules' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Helper to get interval text in Bengali
     */
    public function getIntervalBnAttribute()
    {
        return match ($this->billing_interval) {
            'monthly' => 'মাসিক',
            'yearly'  => 'বার্ষিক',
            'lifetime' => 'আজীবন',
            default    => 'এককালীন',
        };
    }

    /**
     * Scope to only include active plans
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
