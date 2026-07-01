<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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

        $this->call([
            TerritorySeeder::class,
            FamilySeeder::class,
            CitizenSeeder::class,
            EducationProfileSeeder::class,
            EmploymentProfileSeeder::class,
            HealthProfileSeeder::class,
            HousingProfileSeeder::class,
            MsmeSeeder::class,
            InfrastructureSeeder::class,
            ChildGrowthLogSeeder::class,
        ]);
    }
}
