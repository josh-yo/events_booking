<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // organiser
        User::create([
            'name' => 'Organiser 1',
            'email' => 'organiser01@test.com',
            'password' => Hash::make('password01'),
            'user_type' => 'Organiser',
        ]);

        User::create([
            'name' => 'Organiser 2',
            'email' => 'organiser02@test.com',
            'password' => Hash::make('password02'),
            'user_type' => 'Organiser',
        ]);

        // attendee
        User::create([
            'name' => 'Attendee One',
            'email' => 'attendee1@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'attendee',
        ]);
    }
}
