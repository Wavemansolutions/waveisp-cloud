<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'validity_value',
        'validity_unit',
        'data_limit_mb',
        'mikrotik_profile',
        'speed_limit',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function getDataLabelAttribute(): string
    {
        if ($this->data_limit_mb >= 1024) {
            return rtrim(rtrim(number_format($this->data_limit_mb / 1024, 2), '0'), '.') . 'GB';
        }

        return $this->data_limit_mb . 'MB';
    }
}
