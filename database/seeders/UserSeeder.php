<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nickname' => "super_admin",
            'email' => "super_admin@gmail.com",
            'password' => "123456",
            'role' => "super_admin"
        ]);

        User::create([
            'nickname' => "admin",
            'email' => "admin@gmail.com",
            'password' => "123456",
            'role' => "admin"
        ]);
    }
}
