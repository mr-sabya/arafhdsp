<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    // Fillable attributes
    protected $fillable = [
        'name',
        'bn_name'
    ];


    // Relationship with District
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
