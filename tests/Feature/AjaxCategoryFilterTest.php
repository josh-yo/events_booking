<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AjaxCategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_filtering_by_category_returns_only_matching_events()
    {
        $music = Category::factory()->create(['name' => 'Music']);
        $workshop = Category::factory()->create(['name' => 'Workshop']);
        $organiser = User::factory()->create(['user_type' => 'Organiser']);

        $musicEvent = Event::factory()->create([
            'title' => 'Jazz Night',
            'organiser_id' => $organiser->id,
        ]);
        $workshopEvent = Event::factory()->create([
            'title' => 'Laravel Workshop',
            'organiser_id' => $organiser->id,
        ]);

        $musicEvent->categories()->attach($music->id);
        $workshopEvent->categories()->attach($workshop->id);

        $response = $this->get("/events/filter/{$music->id}", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Jazz Night');
        $response->assertDontSee('Laravel Workshop');
    }

    public function test_no_events_message_when_category_has_no_events()
    {
        $category = Category::factory()->create();

        $response = $this->get("/events/filter/{$category->id}", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertSee('No events found');
    }

    public function test_filtering_with_pagination_returns_correct_results()
    {
        $category = Category::factory()->create();
        $organiser = User::factory()->create(['user_type' => 'Organiser']);

        Event::factory()->count(15)->create([
            'organiser_id' => $organiser->id,
        ])->each(function ($event) use ($category) {
            $event->categories()->attach($category->id);
        });

        // fetch first page
        $page1 = $this->get("/events/filter/{$category->id}?page=1", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);
        $page1->assertStatus(200);

        // fetch second page
        $page2 = $this->get("/events/filter/{$category->id}?page=2", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);
        $page2->assertStatus(200);

        $this->assertNotEquals($page1->getContent(), $page2->getContent());
    }

    public function test_filtered_event_links_can_be_opened_to_detail_page()
    {
        $category = Category::factory()->create();
        $organiser = User::factory()->create(['user_type' => 'Organiser']);
        $event = Event::factory()->create([
            'title' => 'Tech Conference',
            'organiser_id' => $organiser->id,
        ]);
        $event->categories()->attach($category->id);

        $response = $this->get("/events/filter/{$category->id}", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertSee("/events/{$event->id}");

        // follow through to detail page
        $detail = $this->get("/events/{$event->id}");
        $detail->assertStatus(200);
        $detail->assertSee('Tech Conference');
    }

    public function test_filtering_with_invalid_category_id_returns_empty_results()
    {
        $response = $this->get("/events/filter/9999", [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertSee('No events found for this category.');
    }
    
}
