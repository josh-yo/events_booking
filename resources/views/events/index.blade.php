@extends('layouts.app')
@section('content')
    <h1>Upcoming Events</h1>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-3 mb-3">
                <div class="card h-100 shadow-sm">
                    <!-- <img src="{{ $event->image_path ?? 'https://picsum.photos/400/200?random='.$event->id }}" class="card-img-top" alt="{{ $event->title }}"> -->
                    <img src="{{ $event->image_path }}" 
                        onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';" 
                        class="card-img-top" 
                        style="height:200px;object-fit:cover;" 
                        alt="{{ $event->title }}">


                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->location }} <br> {{ $event->date_time }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection