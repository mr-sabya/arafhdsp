<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    protected $fillable = [
        'name',
        'bn_name',
        'slug'
    ];

    // Relationship example: A blood group can have many users/members
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
