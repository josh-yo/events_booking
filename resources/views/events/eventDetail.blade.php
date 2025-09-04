@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white px-0 mb-0 py-4">
    <li class="breadcrumb-item">
      <a href="{{ route('events.index') }}">Home</a>
    </li>
    <li class="breadcrumb-item active nav-title" aria-current="page">
      {{ $event->title }}
    </li>
  </ol>
</nav>

<div class="container mt-5 mb-5">
  <div class="row">
    <!-- Picture -->
    <div class="col-md-6">
      <img src="{{ $event->image_path }}" 
            onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';"     
            alt="{{ $event->title }}" 
            style="height:100%; max-height:400px; object-fit:cover;"
            class="img-fluid rounded">
    </div>

    <!-- Event Information -->
    <div class="col-md-6">
      <h2 class="fw-bold mb-3">{{ $event->title }}</h2>
      <p>{{ $event->description }}</p>
      <ul class="list-unstyled">
        <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('d/M/Y') }}</li>
        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('g:i A') }}</li>
        <li><strong>Location:</strong> {{ $event->location }}</li>
        <li><strong>Capacity:</strong> {{ $event->capacity }}</li>
        <li><strong>Remaining Spots:</strong> {{ $availableSpots }}</li>
        <li><strong>Organiser:</strong> {{ $event->organiser->name }}</li>
      </ul>

        <!-- Logic of Buttons  -->
        @auth
            <!-- Attendee situation -->
            @if(Auth::user()->user_type === 'Attendee')
                <!-- Situation 1： Full booked -->
                @if($availableSpots <= 0)
                  <button id="booked_fully" class="btn btn-secondary w-100 no_booked" disabled>Fully Booked</button>
                <!-- Situation 2：Already Booked -->
                @elseif($alreadyBooked)
                  <button id="booked_exist" class="btn btn-primary w-100 no_booked" disabled>Already Booked</button>
                <!-- Situation 3：Can Book -->
                @else
                  <form action="{{ route('bookings.store') }}" method="POST">
                      @csrf
                      <input type="hidden" name="event_id" value="{{ $event->id }}">
                      <button type="submit" class="btn btn-success w-100">Book Now</button>
                  </form>
            @endif

            <!-- Organiser situation -->
            @elseif(Auth::user()->user_type === 'Organiser' && Auth::id() === $event->organiser_id)
                <button class="btn btn-warning w-100 mb-2">Edit</button>
                <button class="btn btn-danger w-100">Delete</button>
                <!-- TODO: Add Edit/Delete Action -->
            @endif
        @else
            <!-- Guest situation -->
            <a href="{{ route('login') }}" class="btn btn-info w-100">
                Login to book now
            </a>
        @endauth
    </div>
  </div>
</div>

<x-recommended :recommended="$recommended" />
@endsection