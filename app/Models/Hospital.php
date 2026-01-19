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
        'serial_phones', // New field
        'photo',
        'type',          // New field: hospital, diagnostic, nursing_home, clinic
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
        'serial_phones' => 'array', // Automatically converts JSON to PHP Array
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)
            ->withPivot('fee', 'discount_percent')
            ->withTimestamps();
    }

    public function tests()
    {
        return $this->belongsToMany(MedicalTest::class, 'hospital_medical_test')
            ->withPivot('price', 'discount_percent')
            ->withTimestamps();
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


    public static function getTypes()
    {
        return [
            'hospital'          => App::getLocale() == 'bn' ? 'হাসপাতাল' : 'Hospital',
            'diagnostic_center' => App::getLocale() == 'bn' ? 'ডায়াগনস্টিক সেন্টার' : 'Diagnostic Center',
            'nursing_home'      => App::getLocale() == 'bn' ? 'নার্সিং হোম' : 'Nursing Home',
            'clinic'            => App::getLocale() == 'bn' ? 'ক্লিনিক' : 'Clinic',
        ];
    }
}
