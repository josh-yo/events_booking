<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // $events = [
        //     ['title' => 'Tech Meetup', 'date_time' => '2025-09-01 18:00', 'location' => 'Brisbane'],
        //     ['title' => 'Music Festival', 'date_time' => '2025-09-05 20:00', 'location' => 'Gold Coast']
        // ];

        // get all events
        $events = Event::orderBy('date_time', 'asc')->get();

        return view('events.index', compact('events'));
    }
}
