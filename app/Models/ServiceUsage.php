<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceUsage extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'consumed_at',
        'remarks'
    ];

    protected $casts = [
        'consumed_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
