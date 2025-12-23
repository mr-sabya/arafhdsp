<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'account_number',
        'qr_code',
        'instruction',
        'driver',
        'config',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'config' => 'array', // Automatically handles JSON conversion
        'status' => 'boolean',
    ];

    // Helper to get QR URL
    public function getQrImageUrlAttribute()
    {
        return $this->qr_code ? asset('storage/' . $this->qr_code) : null;
    }
}
