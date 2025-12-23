<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name',
        'level_text',
        'price',
        'features',
        'is_featured',
        'ribbon_text',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'features' => 'array', // This is crucial for JSON
        'is_featured' => 'boolean',
    ];
}
