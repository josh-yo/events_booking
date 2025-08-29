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
            'name' => 'Organiser One',
            'email' => 'organiser1@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'organiser',
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
