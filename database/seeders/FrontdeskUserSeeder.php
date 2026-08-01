<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\FrontdeskUser;

class FrontdeskUserSeeder extends Seeder
{
    public function run(): void
    {
        // Morning Shift Staff
        FrontdeskUser::create([
            'name' => 'Anna Reyes',
            'email' => 'anna@smashlab.com',
            'password' => Hash::make('frontdesk2026'),
            'employee_code' => 'FD-001',
            'phone' => '+63 917 123 4567',
            'shift' => 'morning',
            'status' => 'active',
        ]);

        // Afternoon Shift Staff
        FrontdeskUser::create([
            'name' => 'Carlos Garcia',
            'email' => 'carlos@smashlab.com',
            'password' => Hash::make('frontdesk2026'),
            'employee_code' => 'FD-002',
            'phone' => '+63 918 234 5678',
            'shift' => 'afternoon',
            'status' => 'active',
        ]);

        // Evening Shift Staff
        FrontdeskUser::create([
            'name' => 'Maria Santos',
            'email' => 'maria@smashlab.com',
            'password' => Hash::make('frontdesk2026'),
            'employee_code' => 'FD-003',
            'phone' => '+63 919 345 6789',
            'shift' => 'evening',
            'status' => 'active',
        ]);

        // Inactive Staff (can't login)
        FrontdeskUser::create([
            'name' => 'John Doe',
            'email' => 'john@smashlab.com',
            'password' => Hash::make('frontdesk2026'),
            'employee_code' => 'FD-004',
            'phone' => '+63 920 456 7890',
            'shift' => 'morning',
            'status' => 'inactive',
        ]);
    }
}