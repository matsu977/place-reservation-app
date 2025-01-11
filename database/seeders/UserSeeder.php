<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => '山田 太郎',
            'email' => 'leader@test.com',
            'password' => bcrypt('password'),
            'role' => 'team_leader',
            'phone' => '090-1234-5678',
            'email_verified_at' => now(),
        ]);
    }
}
