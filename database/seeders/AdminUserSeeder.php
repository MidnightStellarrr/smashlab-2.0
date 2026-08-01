<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin (Owner) - Full access
        AdminUser::create([
            'name' => 'Super Admin',
            'email' => 'admin@smashlab.com',
            'password' => Hash::make('admin2026'),
            'role' => 'super_admin',
            'status' => 'active',
        ]);

        // Regular Admin (Manager)
        AdminUser::create([
            'name' => 'Operations Manager',
            'email' => 'manager@smashlab.com',
            'password' => Hash::make('manager2026'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Inactive Admin (can't login)
        AdminUser::create([
            'name' => 'Former Admin',
            'email' => 'former@smashlab.com',
            'password' => Hash::make('former2026'),
            'role' => 'admin',
            'status' => 'inactive',
        ]);
    }
}