<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'fullname' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role'     => UserRole::ADMIN->value,
        ]);

        User::factory()->create([
            'fullname' => 'Operator1',
            'username' => 'operator1',
            'password' => bcrypt('operator123'),
            'role'     => UserRole::OPERATOR->value,
        ]);
    }
}
