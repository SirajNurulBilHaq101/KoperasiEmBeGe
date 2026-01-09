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
    }
}

