<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Database\Seeders\TerritoriesSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'fullname' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        $this->call([
            TerritoriesSeeder::class,
        ]);
    }
}
