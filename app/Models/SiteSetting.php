<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'setting_group',
        'setting_key',
        'setting_value',
        'input_type',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}