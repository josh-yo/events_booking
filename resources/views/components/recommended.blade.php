<h3 class="fw-bold text-center mt-4 mb-5 nav-title">You might also like!</h3>

<div id="recommendCarousel" class="carousel slide mb-4">
  <div class="carousel-inner">
    @foreach($recommended->chunk(2) as $index => $chunk)
      <div class="container carousel-item {{ $index === 0 ? 'active' : '' }}">
        <div class="row">
          <div class="col-10 mx-auto">
            <div class="row">
              @foreach($chunk as $rec)
                <div class="col-12 col-md-6 mb-4">
                  <div class="card h-100 shadow-sm mx-2">
                    <img src="{{ $rec->image_path }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;"
                         alt="{{ $rec->title }}">
                    <div class="card-body text-center">
                      <h5 class="card-title fw-bold">{{ $rec->title }}</h5>
                      <p class="card-text text-muted mb-1">
                        <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($rec->date_time)->format('Y-m-d H:i') }}
                      </p>
                      <p class="card-text text-muted">
                        <i class="bi bi-geo-alt"></i> {{ $rec->location }}
                      </p>
                      <a href="{{ route('events.show', $rec->id) }}" class="btn btn-primary">
                        <i class="bi bi-search"></i> View Details
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Button -->
  <button class="carousel-control-prev carousel-control-custom" type="button" data-bs-target="#recommendCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next carousel-control-custom" type="button" data-bs-target="#recommendCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
