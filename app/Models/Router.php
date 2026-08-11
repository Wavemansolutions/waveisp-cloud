<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $fillable = [
        'name',
        'ip_address',
        'api_port',
        'username',
        'password',
        'api_ssl',
        'location',
        'is_active',
        'sync_mode',
        'agent_token',
        'last_seen_at',
    ];

    protected $casts = [
        'api_ssl' => 'boolean',
        'is_active' => 'boolean',
        'last_seen_at' => 'datetime',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function jobs()
    {
        return $this->hasMany(RouterJob::class);
    }
}