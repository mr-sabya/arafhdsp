<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class MedicalTest extends Model
{
    protected $fillable = [
        'medical_test_category_id',
        'name_en',
        'name_bn',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(MedicalTestCategory::class, 'medical_test_category_id');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'hospital_medical_test')
            ->withPivot('price', 'discount_percent');
    }

    public function getDisplayNameAttribute()
    {
        return App::getLocale() == 'bn' ? $this->name_bn : $this->name_en;
    }
}
