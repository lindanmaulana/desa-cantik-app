<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'fullname' => 'Admin User',
            'username' => 'admin',
            'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD')),
            'role'     => UserRole::ADMIN->value,
        ]);

        User::factory()->create([
            'fullname' => 'Operator1',
            'username' => 'operator1',
            'password' => Hash::make(env('DEFAULT_OPERATOR_PASSWORD')),
            'role'     => UserRole::OPERATOR->value,
        ]);
    }
}
