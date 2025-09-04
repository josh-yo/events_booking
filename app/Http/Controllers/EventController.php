<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // 8 events per page
        $events = Event::orderBy('date_time', 'asc')->paginate(8); 
        return view('events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        return view('events.createEvent');
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
            'tags' => 'required|in:indoor,outdoor',
        ]);

        // Add the currently logged-in Organiser ID
        $validated['organiser_id'] = auth()->id();

        // Create the new event
        $event = Event::create($validated);

        return redirect()->route('dashboard')
                        ->with('title', $event->title)
                        ->with('success', "created successfully!");
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

        DB::table('events')->where('id', $id)->delete();

        return redirect()->route('dashboard')->with('success', "Event \"$event->title\" deleted successfully!");
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