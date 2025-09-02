<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function myBookings()
    {
        $userId = Auth::id();

        $bookings = Booking::with('event')
        ->where('attendee_id', $userId)
        ->get();

        return view('myBookings', compact('bookings'));
    }
}
