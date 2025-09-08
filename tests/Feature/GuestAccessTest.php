<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;
use App\Models\User;

class GuestAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_view_the_paginated_list_of_upcoming_events()
    {
        // Arrange: Create an organiser
        $organiser = User::factory()->create([
            'user_type' => 'organiser',
        ]);

        // Arrange: Create an event
        $event = Event::factory()->create([
            'title' => 'Test Event',
            'date_time' => now()->addDays(1),
        ]);

        // Act: Simulate a guest opening the homepage
        $response = $this->get('/');

        // Assert: Confirm the webpage displays correctly
        $response->assertStatus(200);
        $response->assertSee('Test Event');
    }

    public function test_a_guest_can_view_a_specific_event_details_page()
    {
        // Arrange: Create an organiser + event
        $organiser = User::factory()->create(['user_type' => 'organiser']);
        $event = Event::factory()->create([
            'title' => 'Detail Event',
            'description' => 'Event detail description',
            'date_time' => now()->addDays(2),
            'organiser_id' => $organiser->id,
        ]);

        // Act: Guest opens the event details page
        $response = $this->get("/events/{$event->id}");

        // Assert: Page loads and shows event info
        $response->assertStatus(200);
        $response->assertSee('Detail Event');
        $response->assertSee('Event detail description');
    }

    public function test_a_guest_is_redirected_when_accessing_protected_routes()
    {
        // Act: Guest tries to access a protected route (e.g., bookings page)
        $response = $this->get('/myBookings');

        // Assert: Should be redirected to login page
        $response->assertRedirect('/login');
    }

    public function test_a_guest_cannot_see_action_buttons_on_event_details_page()
    {
        // Arrange: Create organiser + event
        $organiser = User::factory()->create(['user_type' => 'organiser']);
        $event = Event::factory()->create([
            'title' => 'Action Button Event',
            'date_time' => now()->addDays(3),
            'organiser_id' => $organiser->id,
        ]);

        // Act: Guest opens event details page
        $response = $this->get("/events/{$event->id}");

        // Assert: Page loads, but buttons should NOT be visible
        $response->assertStatus(200);
        $response->assertDontSee('Book Now');
        $response->assertDontSee('Edit');
        $response->assertDontSee('Confirm Delete');
    }

}