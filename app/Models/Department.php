<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Department extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'icon',
        'sort_order',
        'status'
    ];

    /**
     * Helper to get name based on current language
     */
    public function getDisplayNameAttribute()
    {
        // If your app locale is 'bn', it returns name_bn, otherwise name_en
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }
}
