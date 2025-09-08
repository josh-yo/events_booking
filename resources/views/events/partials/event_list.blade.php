@forelse($events as $event)
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
@empty
    <p class="text-muted">No events found for this category.</p>
@endforelse

@if ($events->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $events->links() }}
    </div>
@endif