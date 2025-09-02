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

        $events = DB::select("
            SELECT e.id, e.title, e.date_time, e.capacity,
                COUNT(b.id) AS bookings,
                (e.capacity - COUNT(b.id)) AS remaining
            FROM events e
            LEFT JOIN bookings b ON e.id = b.event_id
            WHERE e.organiser_id = ?
            GROUP BY e.id, e.title, e.date_time, e.capacity
            ORDER BY e.date_time ASC
        ", [$userId]);

        return view('dashboard', compact('events'));
    }
}
