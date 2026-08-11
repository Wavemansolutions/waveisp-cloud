<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDevice extends Model
{
    protected $fillable = [
        'mac_address',
        'ip_address',
        'customer_id',
        'router_id',
        'status',
        'first_seen_at',
        'last_seen_at',
        'last_user_agent',
    ];

    protected $casts = [
        'first_seen_at' => 'datetime',
        'last_seen_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function router()
    {
        return $this->belongsTo(Router::class);
    }
}