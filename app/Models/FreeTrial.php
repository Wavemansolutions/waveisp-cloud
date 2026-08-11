<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeTrial extends Model
{
    protected $fillable = [
        'mac_address',
        'hotspot_ip',
        'username',
        'password',
        'router_id',
        'limit_bytes',
        'status',
        'mikrotik_created',
        'mikrotik_created_at',
        'mikrotik_error',
        'last_seen_at',
    ];

    protected $casts = [
        'mikrotik_created' => 'boolean',
        'mikrotik_created_at' => 'datetime',
        'last_seen_at' => 'datetime',
    ];

    public function router()
    {
        return $this->belongsTo(Router::class);
    }
}
