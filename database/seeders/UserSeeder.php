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
            'name' => 'Wanda Maximoff',
            'email' => 'organiser01@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Organiser',
        ]);

        User::create([
            'name' => 'Agatha Harkness',
            'email' => 'organiser02@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Organiser',
        ]);

        // attendee
        User::create([
            'name' => 'Chris Hemsworth',
            'email' => 'attendee01@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
    }
}
