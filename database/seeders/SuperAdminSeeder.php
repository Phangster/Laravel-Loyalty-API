<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Check if a super admin already exists to avoid duplicates
        if (User::where('role', 1)->exists()) {
            return; // Exit if a super admin already exists
        }

        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '123456789',
            'membership_tier_id' => null, // Adjust this if needed
            'role' => 1, // Assuming '1' corresponds to 'super admin'
        ]);
    }
}
