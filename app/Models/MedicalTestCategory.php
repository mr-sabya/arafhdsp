<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class MedicalTestCategory extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'sort_order',
        'status'
    ];

    public function tests()
    {
        return $this->hasMany(MedicalTest::class);
    }

    public function getDisplayNameAttribute()
    {
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }
}
