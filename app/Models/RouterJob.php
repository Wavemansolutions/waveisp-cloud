<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouterJob extends Model
{
    protected $fillable = [
        'router_id',
        'customer_id',
        'job_type',
        'status',
        'payload',
        'result',
        'attempts',
        'available_at',
        'locked_at',
        'completed_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'available_at' => 'datetime',
        'locked_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function router()
    {
        return $this->belongsTo(Router::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}