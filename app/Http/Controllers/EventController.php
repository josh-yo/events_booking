<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = [
            ['title' => 'Tech Meetup', 'date_time' => '2025-09-01 18:00', 'location' => 'Brisbane'],
            ['title' => 'Music Festival', 'date_time' => '2025-09-05 20:00', 'location' => 'Gold Coast']
        ];

        return view('events.index', compact('events'));
    }
}
