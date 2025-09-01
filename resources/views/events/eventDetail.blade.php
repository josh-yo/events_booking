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
        <li><strong>Date:</strong> {{ $event->date_time }}</li>
        <li><strong>Time:</strong> {{ $event->time }}</li>
        <li><strong>Location:</strong> {{ $event->location }}</li>
        <li><strong>Capacity:</strong> {{ $event->capacity }}</li>
        <li><strong>Available Spots:</strong> {{ $availableSpots }}</li>
        <li><strong>Organiser:</strong> {{ $event->organiser->name }}</li>
      </ul>

      <!-- Logic of Button -->
      @auth
          <!-- Attendee situation -->
          @if(Auth::user()->user_type === 'Attendee')
              @if($availableSpots > 0)
                  <button class="btn btn-success w-100">Book Now</button>
              @else
                  <button class="btn btn-secondary w-100" disabled>已額滿</button>
              @endif

          <!-- Organiser situation -->
          @elseif(Auth::user()->user_type === 'Organiser' && Auth::id() === $event->organiser_id)
              <button class="btn btn-warning w-100 mb-2">Edit</button>
              <button class="btn btn-danger w-100">Delete</button>
              <!-- TODO: Edit/Delete Action -->
          @endif
      @endauth
    </div>
  </div>
</div>
@endsection