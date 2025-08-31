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
        ->get()
        ->map(function ($event) {
            $event->bookings = 0; // fixed number for test
            $event->remaining = $event->capacity; // capacity - 0
            return $event;
        });

        return view('dashboard', compact('events'));
    }
}
