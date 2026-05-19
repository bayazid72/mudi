<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'Beheerder@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'invoerder@gmail.com'],
            [
                'name' => 'invoerder',
                'password' => Hash::make('123'),
                'role' => 'invoerder',
            ]
        );
        User::updateOrCreate(
            ['email' => 'ophaler@gmail.com'],
            [
                'name' => 'ophaler',
                'password' => Hash::make('123'),
                'role' => 'ophaler',
            ]
        );
    }
}
