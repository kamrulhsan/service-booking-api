<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        $users = [
        [
            'email' => 'admin@example.com',
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'is_admin' => true,
        ],
        [
            'email' => 'user1@example.com',
            'name' => 'John Doe',
            'password' => Hash::make('123456'),
            'is_admin' => false,
        ],
        [
            'email' => 'user2@example.com',
            'name' => 'Rahim',
            'password' => Hash::make('123456'),
            'is_admin' => false,
        ],
    ];

    foreach ($users as $user) {
        User::updateOrCreate(
            ['email' => $user['email']],
            [
                'name' => $user['name'],
                'password' => Hash::make($user['password']),
                'is_admin' => $user['is_admin'],
                'email_verified_at' => now(),
            ]
        );
    }
        
    }
}
