<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = ModelsUser::create([
            'name' => 'Admin',
            'email' => 'admin@test.id',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = ModelsUser::create([
            'name' => 'User',
            'email' => 'user@test.id',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
