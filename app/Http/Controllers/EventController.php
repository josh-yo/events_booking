<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // 8 events per page
        $events = Event::orderBy('date_time', 'asc')->paginate(8); 
        return view('events.index', compact('events'));
    }
}
