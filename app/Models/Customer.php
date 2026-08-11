<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'mac_address',
        'ip_address',
        'last_seen_at',
        'username',
        'password',
        'router_id',
        'plan_id',
        'status',
        'starts_at',
        'expires_at',
        'mikrotik_created',
        'mikrotik_created_at',
        'mikrotik_error',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'mikrotik_created' => 'boolean',
        'mikrotik_created_at' => 'datetime',
    ];

    public function router()
    {
        return $this->belongsTo(Router::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
