<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Doctor extends Model
{
    protected $fillable = [
        'department_id',
        'name_en',
        'name_bn',
        'designation_en',
        'designation_bn',
        'degree_en',
        'degree_bn',
        'base_fee',
        'discount_percentage',
        'discount_badge_en',
        'discount_badge_bn',
        'bio_en',
        'bio_bn',
        'photo',
        'appointment_number',
        'sort_order',
        'status'
    ];

    // --- Localization Accessors ---
    public function getDisplayNameAttribute()
    {
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }

    public function getDisplayDesignationAttribute()
    {
        return App::getLocale() == 'bn' ? $this->designation_bn : $this->designation_en;
    }

    public function getDisplayDegreeAttribute()
    {
        return App::getLocale() == 'bn' ? $this->degree_bn : $this->degree_en;
    }

    public function getDisplayBadgeAttribute()
    {
        $badge = App::getLocale() == 'bn' ? $this->discount_badge_bn : $this->discount_badge_en;
        if ($badge) return $badge;

        return $this->discount_percentage > 0
            ? (App::getLocale() == 'bn' ? "ফি: {$this->discount_percentage}% ছাড়" : "Fee: {$this->discount_percentage}% Off")
            : null;
    }

    // --- Price Logic ---
    public function getDiscountedFeeAttribute()
    {
        return $this->base_fee - ($this->base_fee * ($this->discount_percentage / 100));
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
