<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id',
        'plan_id',
        'amount',
        'reference',
        'provider',
        'status',
        'payload',
        'hotspot_login_url',
        'hotspot_mac',
        'hotspot_ip',
        'hotspot_dst',
        'hotspot_captured_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'hotspot_captured_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
