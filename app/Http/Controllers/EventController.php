<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class EventController extends Controller
{
    public function index()
    {
        // 8 events per page
        $events = Event::orderBy('date_time', 'asc')->paginate(8); 
        $categories = Category::withCount('events')->get();
        $totalEvents = Event::count();
        return view('events.index', compact('events', 'categories', 'totalEvents'));
    }

    // Show the form for creating a new event
    public function create()
    {
       $categories = Category::all();
        return view('events.createEvent', compact('categories'));
    }

    // Store a newly created event in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:100',
            'description' => 'nullable|string',
            'date_time'   => 'required|date|after:now',
            'location'    => 'required|max:255',
            'capacity'    => 'required|integer|min:1|max:1000',
            'image_path'  => 'nullable|url', // New validation rule for image URL
            'categories'   => 'required|array', // at least one category
            'categories.*' => 'exists:categories,id', // each category must exist in categories table
        ]);

        // Add the currently logged-in Organiser ID
        $validated['organiser_id'] = auth()->id();

        // Create the new event
        $event = Event::create($validated);
        $event->categories()->sync($request->categories);

        return redirect()->route('dashboard')
                        ->with('title', $event->title)
                        ->with('highlight_event_id', $event->id)
                        ->with('success', "created successfully!");
    }

    // show edit page
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // only the owner can enter edit page (front end side)
        if ($event->organiser_id !== Auth::id()) {
            return redirect()->route('dashboard')
                ->with('error', '⚠️ You are only allowed to edit events you have created below!');
        }

        $categories = Category::all();
        return view('events.edit', [
            'event' => $event,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|max:100',
            'description' => 'nullable',
            'date_time'   => 'required|date|after:now',
            'location'    => 'required|max:255',
            'capacity'    => 'required|integer|min:1|max:1000',
            'image_path'  => 'nullable|url',
            'categories'   => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $event = Event::where('id', $id)
            // only the owner can update (back end side)
            ->where('organiser_id', Auth::id())
            ->firstOrFail();

        $event->update($validated);
        $event->categories()->sync($request->categories);

        return redirect()->route('dashboard')
            ->with('success', "\"{$event->title}\" updated successfully!")
            ->with('highlight_event_id', $event->id);
    }

    public function destroy($id)
    {
        $event = DB::table('events')
            ->where('id', $id)
            ->where('organiser_id', Auth::id()) // Ensure only the owner can delete
            ->first();

        if (!$event) {
            return redirect()->route('dashboard')->with('error', 'Event not found or unauthorized.');
        }

        // if there are any bookings, prevent deletion
        $bookingCount = DB::table('bookings')
            ->where('event_id', $id)
            ->count();

        if ($bookingCount > 0) {
            return back()
            ->with('error', '⚠️ This event already has attendees and cannot be deleted.')
            ->with('highlight_event_id', $id);
        }

        DB::table('events')->where('id', $id)->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', "\"$event->title\" deleted successfully!");
    }

    public function show($id)
    {
        $event = Event::with('organiser')->findOrFail($id);

        // get all bookings for this event and count them
        $currentBookings = $event->bookings->count();
        $availableSpots = $event->capacity - $currentBookings;

        // Check if the user has already booked this event
        $alreadyBooked = false;
        if (auth()->check()) {
            $alreadyBooked = $event->bookings()
                ->where('user_id', auth()->id())
                ->exists();
        }

        // random recommendations few events
        $recommended = Event::where('id', '!=', $id)
        ->inRandomOrder()
        ->limit(6)
        ->get();

        return view('events.eventDetail', [
            'event' => $event,
            'availableSpots' => $availableSpots,
            'alreadyBooked' => $alreadyBooked,
            'recommended' => $recommended,
        ]);
    }
}