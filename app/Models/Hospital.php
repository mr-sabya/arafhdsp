<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Hospital extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'address_en',
        'address_bn',
        'phone',
        'photo',
        'benefits',
        'division_id',
        'district_id',
        'upazila_id',
        'area_id',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'benefits' => 'array',
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

    // Dynamic Display Attributes
    public function getDisplayNameAttribute()
    {
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }

    public function getDisplayAddressAttribute()
    {
        return App::getLocale() == 'bn' ? $this->address_bn : $this->address_en;
    }
}
