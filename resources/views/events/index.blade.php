@extends('layouts.app')
@section('content')
    <h1 class="mb-5">Upcoming Events</h1>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3 mb-5">
            <div class="filter">
                <h5 class="filter-title">FILTER</h5>
                <ul class="list-group">
                    <li class="list-group-item filter-item" data-tag="all">
                        <span>All</span>
                        <span class="badge float-end item-amount">( {{ $totalEvents }} )</span>
                    </li>
                    <!-- Categories -->
                    @foreach($categories as $category)
                        <li class="list-group-item filter-item" data-tag="{{ $category->id }}">
                            <span>{{ $category->name }}</span>
                            <span class="badge float-end item-amount">( {{ $category->events_count }} )</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Event List -->
        <div class="col-md-9">
            <div id="eventList" class="row">
                @foreach($events as $event)
                    <!-- <div class="col-md-4 mb-3"> -->
                    <div class="col-6 col-lg-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="img_container">
                                <a href="{{ route('events.show', $event->id) }}">
                                    <img src="{{ $event->image_path }}" 
                                        onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';" 
                                        class="card-img-top img_hover" 
                                        style="height:200px;object-fit:cover;" 
                                        alt="{{ $event->title }}">
                                </a>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title event_title">
                                    <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-dark">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <p class="card-text date_time">{{ \Carbon\Carbon::parse($event->date_time)->format('d/M/Y, g:i A') }} </p>
                                <p class="card-text">{{ $event->location }}</p>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection

<!-- Welcome message for new users -->
@if(session('register_success'))
    <div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1100">
        <div id="actionToast" 
             class="toast align-items-center border-0" 
             role="alert" 
             aria-live="assertive" 
             aria-atomic="true"
             style="border-radius: 20px; background-color: #fff; color: #333; font-size: 1.1rem; min-width: 350px; padding: 0.75rem 1rem;">
            <div class="d-flex">
                <div class="toast-body">
                    😊 {{ session('register_success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('actionToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, { delay: 5500 });
            toast.show();
        }
    });

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.filter-item');

        items.forEach(item => {
            item.addEventListener('click', function () {
                // delete active class from all
                items.forEach(i => i.classList.remove('active-category'));
                // add active class to the currently clicked item
                this.classList.add('active-category');
            });
        });
    });
</script>