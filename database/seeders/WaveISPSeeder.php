<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WaveISPSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@waveisp.local'],
            [
                'name' => 'WaveISP Admin',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        $plans = [
            ['Daily 1GB', 300, 1, 1024, 1],
            ['Daily 2GB', 450, 1, 2048, 2],
            ['Daily 4GB', 600, 1, 4096, 3],
            ['Daily 7GB', 1000, 1, 7168, 4],

            ['Weekly 3.5GB', 500, 7, 3584, 5],
            ['Weekly 5GB', 800, 7, 5120, 6],
            ['Weekly 10GB', 2500, 7, 10240, 7],
            ['Weekly 15GB', 4500, 7, 15360, 8],

            ['Monthly 10GB', 3000, 30, 10240, 9],
            ['Monthly 12GB', 4000, 30, 12288, 10],
            ['Monthly 20GB', 8000, 30, 20480, 11],
            ['Monthly 30GB', 11000, 30, 30720, 12],
        ];

        foreach ($plans as [$name, $price, $days, $mb, $order]) {
            Plan::updateOrCreate(
                ['name' => $name],
                [
                    'price' => $price,
                    'validity_value' => $days,
                    'validity_unit' => 'days',
                    'data_limit_mb' => $mb,
                    'mikrotik_profile' => 'WAVEISP-2M',
                    'speed_limit' => '2M/2M',
                    'is_active' => true,
                    'sort_order' => $order,
                ]
            );
        }
    }
}