<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show user bookings
    public function myBookings()
    {
        $userId = Auth::id();

        $bookings = Booking::with('event')
        ->where('user_id', $userId)
        ->get();

        return view('myBookings', compact('bookings'));
    }

    // Store a new booking
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        Booking::create([
            'event_id'    => $request->event_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('myBookings')->with('success', 'Booking successful!');
    }

    // Cancel a booking
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->delete();

        return redirect()->route('myBookings')->with('success', 'Booking cancelled.');
    }

}