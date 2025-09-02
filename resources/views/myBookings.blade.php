@extends('layouts.app', ['containerClass' => 'container-fluid mt-4'])

@section('content')
    <h3>My Bookings</h3>
    <hr />

    <!-- Desktop Version -->
    <div class="d-none d-md-block">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->event->date_time)->format('d/M/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->event->date_time)->format('g:i A') }}</td>
                        <td>{{ $booking->event->location }}</td>
                        <td>
                            <form action="{{ route('bookings.cancel', $booking->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">You have no bookings.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Version -->
    <div class="d-block d-md-none">
        @forelse ($bookings as $booking)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $booking->event->title }}</h5>
                    <p class="card-text">
                        <ul class="list-unstyled mb-0">
                            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->event->date_time)->format('d/M/Y') }}</li>
                            <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->event->date_time)->format('g:i A') }}</li>
                            <li><strong>Location:</strong> {{ $booking->event->location }}</li>
                        </ul>
                    </p>
                    <form action="{{ route('bookings.cancel', $booking->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center">You have no bookings.</p>
        @endforelse
    </div>
@endsection