<style>
    .public-navbar {
        background: linear-gradient(135deg, #0c3b2e 0%, #1d5c42 60%, #6d9773 100%) !important;
        padding: 0.85rem 2rem;
        box-shadow: 0 4px 20px rgba(12, 59, 46, 0.25);
        z-index: 1050;
    }
    .public-navbar .navbar-brand {
        color: #ffba08 !important;
        font-family: 'Playfair Display', serif;
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .public-navbar .nav-link {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 500;
        margin-left: 1.2rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        position: relative;
        padding-bottom: 6px;
    }
    .public-navbar .nav-link:hover, 
    .public-navbar .nav-link:focus {
        color: #ffba08 !important;
        transform: translateY(-1px);
    }
    .public-navbar .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: #ffba08;
        transition: all 0.25s ease;
        transform: translateX(-50%);
    }
    .public-navbar .nav-link.active {
        color: #ffba08 !important;
        font-weight: 700;
    }
    .public-navbar .nav-link.active::after {
        width: 80%;
    }
    .public-navbar .nav-link:hover::after {
        width: 80%;
    }
    .public-navbar .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.4);
    }
    .public-navbar .navbar-toggler-icon {
        filter: invert(1);
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top public-navbar">
    <div class="container-fluid">
        <a href="{{ url('/') }}" class="navbar-brand">
            <i class="fas fa-leaf me-2 text-warning"></i> Ayurveda
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') || request()->is('products*') ? 'active' : '' }}">Products</a></li>
                <li class="nav-item"><a href="{{ route('doctors.index') }}" class="nav-link {{ request()->routeIs('doctors.*') || request()->is('doctors*') ? 'active' : '' }}">Doctors</a></li>
                <li class="nav-item"><a href="{{ route('medical_astrology') }}" class="nav-link {{ request()->routeIs('medical_astrology') ? 'active' : '' }}"> Medical Astrology</a></li>
                
                @if(Auth::guard('admin')->check())
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-user-shield me-1"></i> Admin Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                        </form>
                    </li>
                @elseif(Auth::guard('doctor')->check())
                    <li class="nav-item"><a href="{{ route('doctor.dashboard') }}" class="nav-link"><i class="fas fa-user-md me-1"></i> Doctor Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                        </form>
                    </li>
                @elseif(Auth::guard('pharma')->check())
                    <li class="nav-item"><a href="{{ route('pharma.dashboard') }}" class="nav-link"><i class="fas fa-clinic-medical me-1"></i> Pharmacy Dashboard</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                        </form>
                    </li>
                @elseif(Auth::guard('web')->check())
                    <li class="nav-item"><a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                    <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.index') || request()->routeIs('orders.show') ? 'active' : '' }}">My Orders</a></li>
                    <li class="nav-item"><a href="{{ route('bookings.my') }}" class="nav-link {{ request()->routeIs('bookings.my') ? 'active' : '' }}"><i class="fas fa-calendar-check"></i> My Appointments</a></li>
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="fas fa-user-circle me-1"></i> My Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') || request()->routeIs('register') ? 'active' : '' }}"><i class="fas fa-user me-1"></i> Login / Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
