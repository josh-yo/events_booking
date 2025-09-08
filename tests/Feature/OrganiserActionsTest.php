<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganiserActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_organiser_can_log_in_and_view_their_specific_dashboard()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);

        $response = $this->actingAs($organiser)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('dashboard');
    }

    public function test_an_organiser_can_successfully_create_an_event_with_valid_data()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);
        $category = \App\Models\Category::factory()->create();

        $response = $this->actingAs($organiser)->post(route('events.store'), [
            'title' => 'Sample Event',
            'description' => 'Test description',
            'date_time' => now()->addDays(2),
            'location' => 'Test Location',
            'capacity' => 50,
            'categories' => [$category->id],
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('events', [
            'title' => 'Sample Event',
            'organiser_id' => $organiser->id,
        ]);
    }

    public function test_an_organiser_receives_validation_errors_for_invalid_event_data()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);

        $response = $this->actingAs($organiser)->post(route('events.store'), [
            'title' => '', // null title
            'date_time' => now()->subDays(1), // past date
        ]);

        $response->assertSessionHasErrors(['title', 'date_time']);
    }

    public function test_an_organiser_can_successfully_update_an_event_they_own()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);
        $event = Event::factory()->create(['organiser_id' => $organiser->id]);
        $category = \App\Models\Category::factory()->create();

        $response = $this->actingAs($organiser)->put(route('events.update', $event->id), [
            'title' => 'Updated Event Title',
            'description' => 'Updated Description',
            'date_time' => now()->addDays(5),
            'location' => 'Updated Location',
            'capacity' => 100,
            'categories' => [$category->id],
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'title' => 'Updated Event Title',
        ]);
    }

    public function test_an_organiser_cannot_update_an_event_created_by_another_organiser()
    {
        $organiser1 = User::factory()->create(['user_type' => 'Organiser']);
        $organiser2 = User::factory()->create(['user_type' => 'Organiser']);
        $event = Event::factory()->create(['organiser_id' => $organiser1->id]);
        $category = \App\Models\Category::factory()->create();

        $response = $this->actingAs($organiser2)->put(route('events.update', $event->id), [
            'title' => 'Hacked Title',
            'date_time' => now()->addDays(7),
            'location' => 'Hacked Location',
            'capacity' => 1000,
            'categories' => [$category->id],
        ]);

        $response->assertStatus(403); // Forbidden
        $this->assertDatabaseMissing('events', ['title' => 'Hacked Title']);
    }

    public function test_an_organiser_can_delete_an_event_they_own_that_has_no_bookings()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);
        $event = Event::factory()->create(['organiser_id' => $organiser->id]);

        $response = $this->actingAs($organiser)->delete(route('events.destroy', $event->id));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    public function test_an_organiser_cannot_delete_an_event_that_has_active_bookings()
    {
        $organiser = User::factory()->create(['user_type' => 'Organiser']);
        $event = Event::factory()->create(['organiser_id' => $organiser->id]);
        $attendee = User::factory()->create(['user_type' => 'Attendee']);

        Booking::create(['user_id' => $attendee->id, 'event_id' => $event->id]);

        $response = $this->actingAs($organiser)->delete(route('events.destroy', $event->id));

        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('events', ['id' => $event->id]); // Event still exists
    }
}