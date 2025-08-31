<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('events.index') }}">Events Booking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('events.index') }}">Home</a>
            </li>
            <!-- Show user-specific links -->
            @auth
                @if(Auth::user()->user_type === 'Organiser')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.createEvent') }}">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endif

                @if(Auth::user()->user_type === 'Attendee')
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Bookings</a>
                    </li>
                @endif
            @endauth
        </ul>

        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
                <div class="d-flex align-items-center">
                    <span class="navbar-text text-light me-3">
                        {{ Auth::user()->name }}
                        <span class="badge bg-primary">{{ Auth::user()->user_type }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display:inline; cursor:pointer;">
                            Logout
                        </button>
                    </form>
                </div>
            @endguest
    </ul>
        </div>
    </div>
</nav>