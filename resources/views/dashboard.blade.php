@extends('layouts.app', ['containerClass' => 'container-fluid mt-4'])

@section('content')
    <h3>Event List</h3>
    <hr />

    <div class="text-end mb-3">
        <a href="{{ url('/events/createEvent') }}" class="btn btn-primary btn-sm">
            Create New Event
        </a>
    </div>

    <!-- Desktop Version -->
    <div class="d-none d-md-block">
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Total Capacity</th>
                    <th>Current Bookings</th>
                    <th>Remaining Spots</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ $event->capacity }}</td>
                        <td>{{ $event->bookings }}</td>
                        <td>{{ $event->remaining }}</td>
                        <td>
                            <a href="{{ url('/events/'.$event->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ url('/events/'.$event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile Version -->
    <div class="d-block d-md-none">
        @foreach ($events as $event)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d H:i') }}<br>
                        <strong>Total Capacity:</strong> {{ $event->capacity }}<br>
                        <strong>Bookings:</strong> {{ $event->bookings }}<br>
                        <strong>Remaining:</strong> {{ $event->remaining }}
                    </p>
                    <a href="{{ url('/events/'.$event->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ url('/events/'.$event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection
