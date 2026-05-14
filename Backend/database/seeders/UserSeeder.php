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
            'name' => 'Super Admin',
            'username' => 'Admin',
            'email' => 'admin@mail.com',
            'phone_number' => '6280987654321',
            'password' => '12345678',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Rafka Dyta',
            'username' => 'dpraf51',
            'email' => 'rafka@mail.com',
            'phone_number' => '6281234567890',
            'password' => '12345678',
            'role' => 'user'
        ]);
    }
}
