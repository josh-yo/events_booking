<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganiserController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
       
        $events = DB::table('events')
        ->select('id', 'title', 'date_time', 'capacity')
        ->where('organiser_id', $userId)
        ->orderBy('date_time', 'asc')
        ->paginate(8);

        foreach ($events as $event) {
            $event->bookings = 0;
            $event->remaining = $event->capacity;
        }

        return view('dashboard', compact('events'));
    }
}
