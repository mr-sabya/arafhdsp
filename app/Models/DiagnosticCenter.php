<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DiagnosticCenter extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'division_id',
        'district_id',
        'upazila_id',
        'area_id',
        'address_en',
        'address_bn',
        'phone',
        'photo',
        'discount_badge_en',
        'discount_badge_bn',
        'test_list',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'test_list' => 'array',
    ];

    // Relationships
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

    // Localization Accessors
    public function getDisplayNameAttribute()
    {
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }

    public function getDisplayAddressAttribute()
    {
        return App::getLocale() == 'bn' ? $this->address_bn : $this->address_en;
    }

    public function getDisplayBadgeAttribute()
    {
        return App::getLocale() == 'bn' ? $this->discount_badge_bn : $this->discount_badge_en;
    }
}
