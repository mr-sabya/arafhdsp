<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'upazila_id',
        'name',
        'bn_name',
        'post_code'
    ];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
