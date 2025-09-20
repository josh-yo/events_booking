@extends('layouts.app', ['containerClass' => 'container-fluid mt-4 mb-5'])

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
                    <th>Event Time</th>
                    <th>Total Capacity</th>
                    <th>Current Bookings</th>
                    <th>Remaining Spots</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr @if(session('highlight_event_id') == $event->id) class="highlight_row" @endif>
                         <td>
                            <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-dark hover_title">
                                {{ $event->title }}
                            </a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($event->date_time)->format('d/M/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date_time)->format('g:i A') }}</td>
                        <td>{{ $event->capacity }}</td>
                        <td>{{ $event->bookings }}</td>
                        <td>{{ $event->remaining }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form id="delete-form-{{ $event->id }}" 
                                action="{{ url('/events/'.$event->id) }}" 
                                method="POST" 
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <!-- Delete Button (only open modal) -->
                                <button 
                                    type="button" 
                                    class="btn btn-outline-danger btn-sm ms-2"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $event->id }}"
                                    data-url="{{ route('events.destroy', $event->id) }}"
                                    data-title="{{ $event->title }}">
                                    Delete
                                </button>
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
            <div class="card mb-3 shadow-sm @if(session('highlight_event_id') == $event->id) highlight_row @endif">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-dark hover_title">
                            {{ $event->title }}
                        </a>
                    </h5>
                    <p class="card-text">
                        <ul class="list-unstyled mb-0">
                            <li><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('d/M/Y') }}</li>
                            <li><strong>Event Time:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('g:i A') }}</li>
                            <li><strong>Total Capacity:</strong> {{ $event->capacity }}</li>
                            <li><strong>Bookings:</strong> {{ $event->bookings }}</li>
                            <li><strong>Remaining:</strong> {{ $event->remaining }}</li>
                        </ul>
                    </p>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <!-- Delete Button (only open modal) -->
                    <button 
                        type="button" 
                        class="btn btn-outline-danger btn-sm ms-2"
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal"
                        data-id="{{ $event->id }}"
                        data-url="{{ route('events.destroy', $event->id) }}"
                        data-title="{{ $event->title }}">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

@include('components.toast')
@include('components.delete_modal')
@include('components.alert')
@endsection