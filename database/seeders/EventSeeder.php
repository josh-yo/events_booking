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
        // create 15 dummy data
        for ($i = 1; $i <= 3; $i++) {
            Event::create([
                'title' => "Sample Event $i",
                'description' => "This is the description for event $i",
                'date_time' => Carbon::now()->addDays($i),
                'location' => "Room $i, Nathan Campus N79",
                'capacity' => rand(10, 100),
                'organiser_id' => 1,  // initial user_id=1 is Organiser
                'image_path' => null, // can be changed to image path later
            ]);
        }
    }
}
