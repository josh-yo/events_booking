<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => true, // Assuming there is a terms agreement checkbox
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('events.index'));
    }

    public function test_user_cannot_register_without_agreeing_to_privacy_policy(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            // No agree_terms
        ]);

        $this->assertGuest(); // Assert user is not authenticated
        $response->assertSessionHasErrors(['terms']); // Assert error is present
    }
}
