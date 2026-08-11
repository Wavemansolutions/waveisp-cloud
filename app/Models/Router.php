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
    ];

    protected $casts = [
        'api_ssl' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
