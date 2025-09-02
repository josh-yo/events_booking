<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('events.index') }}">Events Booking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('events.index') }}">Home</a>
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
                        <a class="nav-link" href="{{ route('myBookings') }}">My Bookings</a>
                    </li>
                @endif
            @endauth
        </ul>

        <ul class="navbar-nav">
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-flex align-items-center">
                        <span class="navbar-text text-light me-3">
                            {{ Auth::user()->name }}
                            <span class="badge bg-primary">{{ Auth::user()->user_type }}</span>
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-light p-0" style="text-decoration: none;">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            @endguest
    </ul>
        </div>
    </div>
</nav>