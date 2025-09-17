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
        User::create([
            'name' => '	Doctor Strange',
            'email' => 'attendee02@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Invisible Woman',
            'email' => 'attendee03@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Iron Man',
            'email' => 'attendee04@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Mister Fantastic',
            'email' => 'attendee05@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Deadpool',
            'email' => 'attendee06@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Psylocke',
            'email' => 'attendee07@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Moon Knight',
            'email' => 'attendee08@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Scarlet Witch',
            'email' => 'attendee09@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
        User::create([
            'name' => 'Captain America',
            'email' => 'attendee10@test.com',
            'password' => Hash::make('password'),
            'user_type' => 'Attendee',
        ]);
    }
}
