<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'type',
        'status'
    ];

    public function plans()
    {
        return $this->belongsToMany(PricingPlan::class, 'plan_service')
            ->withPivot('quantity', 'frequency', 'discount_value');
    }
}
