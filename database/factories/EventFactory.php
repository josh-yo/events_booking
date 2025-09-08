<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use Carbon\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date_time' => Carbon::now()->addDays(rand(1, 30)),
            'location' => $this->faker->city(),
            'capacity' => $this->faker->numberBetween(10, 100),
            'organiser_id' => 1,
        ];
    }
}