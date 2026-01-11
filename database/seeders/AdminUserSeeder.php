<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Raja Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Raja Lapangan',
            'email' => 'lapangan@lapangan.com',
            'password' => Hash::make('lapanganlapangan'),
            'role' => 'karyawan_lapangan',
        ]);
        User::create([
            'name' => 'Raja Dashboard',
            'email' => 'dashboard@dashboard.com',
            'password' => Hash::make('dashboarddashboard'),
            'role' => 'operator_dashboard',
        ]);
        User::create([
            'name' => 'Raja User',
            'email' => 'user@user.com',
            'password' => Hash::make('useruser'),
            'role' => 'user',
        ]);
    }
}

