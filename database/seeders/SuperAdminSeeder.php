<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew([
            'email' => 'admin@kampusmart.com',
        ]);

        $admin->name = 'Super Admin';
        $admin->phone = '081234567890';
        $admin->role = 'admin';
        $admin->status = 'active';
        $admin->email_verified_at = now();
        $admin->password = Hash::make('admin12345');

        $admin->save();
    }
}
