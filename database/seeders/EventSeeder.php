<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Film Screening Night',
                'description' => 'Join us for a relaxing night with a curated selection of films.',
                'date_time' => Carbon::now()->addDays(2),
                'location' => 'Nathan Campus Theater',
                'capacity' => 120,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/1450586354/photo/group-of-people-watching-a-movie-at-the-outdoors-cinema.webp?a=1&b=1&s=612x612&w=0&k=20&c=q4fGDB4ymEy7oaSrsh1U_6Wq2UHUEmw-EB9B75AD8Xk=',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Charity Run',
                'description' => 'Join the 5K charity run to support local communities.',
                'date_time' => Carbon::now()->addDays(3),
                'location' => 'Brisbane Riverside',
                'capacity' => 400,
                'organiser_id' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1613937574892-25f441264a09?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fG1hcmF0aG9ufGVufDB8fDB8fHww',
                'tags' => 'outdoor',
            ],
            [
                'title' => 'Food Festival',
                'description' => 'Taste dishes from around the world at our annual food fair.',
                'date_time' => Carbon::now()->addDays(5),
                'location' => 'West End Park',
                'capacity' => 300,
                'organiser_id' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1532634922-8fe0b757fb13?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Rm9vZCUyMEZlc3RpdmFsfGVufDB8fDB8fHww',
                'tags' => 'outdoor',
            ],
            [
                'title' => 'Startup Workshop',
                'description' => 'Learn how to pitch your startup idea to investors.',
                'date_time' => Carbon::now()->addDays(7),
                'location' => 'Gold Coast Innovation Hub',
                'capacity' => 80,
                'organiser_id' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1527529482837-4698179dc6ce',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Campus Music Night',
                'description' => 'An evening of live music performances from university bands.',
                'date_time' => Carbon::now()->addDays(8),
                'location' => 'Nathan Campus Auditorium',
                'capacity' => 200,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/2218496418/photo/young-woman-dancing-during-party-outdoors.webp?a=1&b=1&s=612x612&w=0&k=20&c=eca6WzDcxmBApulJGCAf39TSovlmF4doCmOi4y_biMg=',
                'tags' => 'outdoor',
            ],
            [
                'title' => 'Yoga in the Park',
                'description' => 'Enjoy a peaceful yoga session in the fresh air.',
                'date_time' => Carbon::now()->addDays(10),
                'location' => 'Roma Street Parkland',
                'capacity' => 50,
                'organiser_id' => 1,
                'image_path' => 'https://plus.unsplash.com/premium_photo-1713908274754-4610e1ca3a89?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8WW9nYSUyMGluJTIwdGhlJTIwUGFya3xlbnwwfHwwfHx8MA%3D%3D',
                'tags' => 'outdoor',
            ],
            [
                'title' => 'Tech Meetup Brisbane',
                'description' => 'A networking event for developers and tech enthusiasts.',
                'date_time' => Carbon::now()->addDays(12),
                'location' => 'Brisbane City Hall',
                'capacity' => 120,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/1499670337/photo/diverse-audience-listening-closely-to-lively-panel-discussion-at-tech-conference.webp?a=1&b=1&s=612x612&w=0&k=20&c=6D3r30O7eb6KFuwVKRsAvfpOS9Cvl5YdCHKm-tdowvg=',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Art Exhibition',
                'description' => 'Showcasing student artworks and local talent.',
                'date_time' => Carbon::now()->addDays(14),
                'location' => 'South Bank Gallery',
                'capacity' => 150,
                'organiser_id' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1566954979172-eaba308acdf0?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8QXJ0JTIwRXhoaWJpdGlvbnxlbnwwfHwwfHx8MA%3D%3D',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Soccer Friendly Match',
                'description' => 'A friendly soccer game between local teams.',
                'date_time' => Carbon::now()->addDays(15),
                'location' => 'Nathan Sports Field',
                'capacity' => 50,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/904269770/photo/football-player-going-to-kick-football.webp?a=1&b=1&s=612x612&w=0&k=20&c=AjaFfntOyTakkvS8GryJQmIXdfjjIfnsSGjnUHSE7dE=',
                'tags' => 'outdoor',
            ],

            [
                'title' => 'Science Fair',
                'description' => 'Explore student science projects and interactive experiments.',
                'date_time' => Carbon::now()->addDays(17),
                'location' => 'Nathan Campus Science Hall',
                'capacity' => 100,
                'organiser_id' => 1,
                'image_path' => 'https://plus.unsplash.com/premium_photo-1663075816404-dd00f19247e7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fFNjaWVuY2UlMjBGYWlyfGVufDB8fDB8fHww',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Career Expo',
                'description' => 'Meet recruiters and explore job opportunities.',
                'date_time' => Carbon::now()->addDays(20),
                'location' => 'Brisbane Convention Center',
                'capacity' => 250,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/481068305/photo/hospital-employee-and-nurse-at-job-interview.webp?a=1&b=1&s=612x612&w=0&k=20&c=zeNSv2tgzHxCHtyiQP1_KA-USkhiNur16clDmzXfSqI=',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Book Fair',
                'description' => 'A wide variety of books from different genres and cultures.',
                'date_time' => Carbon::now()->addDays(22),
                'location' => 'Brisbane Library',
                'capacity' => 180,
                'organiser_id' => 1,
                'image_path' => 'https://plus.unsplash.com/premium_photo-1713720662476-0bf9c2d59308?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Qm9vayUyMEZhaXJ8ZW58MHx8MHx8fDA%3D',
                'tags' => 'indoor',
            ],
            [
                'title' => 'International Cultural Day',
                'description' => 'Celebrate cultural diversity with performances, food, and exhibitions.',
                'date_time' => Carbon::now()->addDays(24),
                'location' => 'Nathan Campus Main Hall',
                'capacity' => 220,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/2181570242/photo/blackboard-decorated-with-flags.webp?a=1&b=1&s=612x612&w=0&k=20&c=_PPsB-l00GO-dap2D0TJMWmrtziEA4ZpnH80yIEEUfc=',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Coding Bootcamp',
                'description' => 'Intensive coding training session for beginners.',
                'date_time' => Carbon::now()->addDays(26),
                'location' => 'Gold Coast Tech Hub',
                'capacity' => 90,
                'organiser_id' => 1,
                'image_path' => 'https://images.unsplash.com/photo-1529429612779-c8e40ef2f36d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Q29kaW5nJTIwQm9vdGNhbXB8ZW58MHx8MHx8fDA%3D',
                'tags' => 'indoor',
            ],
            [
                'title' => 'Photography Workshop',
                'description' => 'Learn photography skills with hands-on practice.',
                'date_time' => Carbon::now()->addDays(28),
                'location' => 'South Bank Studio',
                'capacity' => 70,
                'organiser_id' => 1,
                'image_path' => 'https://media.istockphoto.com/id/1387274536/photo/team-of-female-photographers.webp?a=1&b=1&s=612x612&w=0&k=20&c=OYp5Yc_J6Opu8lBnVp5upNVstuRcWmVqHYtD5vERIok=',
                'tags' => 'indoor',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}