<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendeeActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_successfully_register_as_an_attendee()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => 'on',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'user_type' => 'Attendee'
        ]);

        $response->assertRedirect(route('events.index'));
    }

    public function test_a_registered_attendee_can_log_in_and_log_out()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);

        $this->post('/logout');
        $this->assertGuest();
    }

    public function test_a_logged_in_attendee_can_book_an_available_upcoming_event()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);
        $event = Event::factory()->create([
            'capacity' => 10,
            'date_time' => now()->addDays(2)
        ]);

        $this->actingAs($user)->post(route('bookings.store'), [
            'event_id' => $event->id,
        ]);

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);
    }

    public function test_after_booking_an_attendee_can_see_the_event_on_their_bookings_page()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);
        $event = Event::factory()->create([
            'capacity' => 5,
            'date_time' => now()->addDays(2),
        ]);

        Booking::create(['user_id' => $user->id, 'event_id' => $event->id]);

        $response = $this->actingAs($user)->get('/myBookings');
        $response->assertSee($event->title);
    }

    public function test_an_attendee_cannot_book_the_same_event_more_than_once()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);
        $event = Event::factory()->create(['capacity' => 5, 'date_time' => now()->addDays(2)]);

        // first booking should succeed
        Booking::create(['user_id' => $user->id, 'event_id' => $event->id]);

        // second booking should fail
        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'event_id' => $event->id,
        ]);

        $response->assertSessionHasErrors();
        $this->assertDatabaseCount('bookings', 1);
    }

    public function test_an_attendee_cannot_book_a_full_event()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);
        $event = Event::factory()->create(['capacity' => 1, 'date_time' => now()->addDays(2)]);
        $otherUser = User::factory()->create(['user_type' => 'Attendee']);

        Booking::create(['user_id' => $otherUser->id, 'event_id' => $event->id]);

        $response = $this->actingAs($user)->post(route('bookings.store'), [
            'event_id' => $event->id,
        ]);

        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('bookings', ['user_id' => $user->id, 'event_id' => $event->id]);
    }

    public function test_an_attendee_cannot_see_edit_or_delete_buttons_on_any_event_page()
    {
        $user = User::factory()->create(['user_type' => 'Attendee']);
        $event = Event::factory()->create(['date_time' => now()->addDays(2)]);

        $response = $this->actingAs($user)->get(route('events.show', $event->id));

        $response->assertDontSee('Edit');
        $response->assertDontSee('Delete');
    }
}
