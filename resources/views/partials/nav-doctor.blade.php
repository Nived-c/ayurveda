<style>
    .doctor-navbar {
        background: linear-gradient(135deg, #0c3b2e 0%, #1d5c42 60%, #6d9773 100%) !important;
        padding: 0.85rem 2rem;
        box-shadow: 0 4px 20px rgba(12, 59, 46, 0.25);
        z-index: 1050;
    }
    .doctor-navbar .navbar-brand {
        color: #ffba08 !important;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .doctor-navbar .nav-link {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 500;
        margin-left: 1.2rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        position: relative;
        padding-bottom: 6px;
    }
    .doctor-navbar .nav-link:hover, 
    .doctor-navbar .nav-link:focus {
        color: #ffba08 !important;
        transform: translateY(-1px);
    }
    .doctor-navbar .nav-link::after {
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
    .doctor-navbar .nav-link.active {
        color: #ffba08 !important;
        font-weight: 700;
    }
    .doctor-navbar .nav-link.active::after,
    .doctor-navbar .nav-link:hover::after {
        width: 80%;
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top doctor-navbar">
    <div class="container-fluid">
        @php
            $isAstrologer = \Illuminate\Support\Facades\Auth::guard('doctor')->user()?->is_admin_astrologer;
        @endphp
        <a href="{{ route('doctor.dashboard') }}" class="navbar-brand d-flex align-items-center gap-2">
            @if($isAstrologer)
                <i class="fas fa-star-of-life text-warning"></i>
                <span>Astrologer Portal</span>
            @else
                <i class="fas fa-user-md text-warning"></i>
                <span>Doctor Portal</span>
            @endif
        </a>
        <button class="navbar-toggler text-white border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a href="{{ route('doctor.dashboard') }}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                @if(!$isAstrologer)
                    <li class="nav-item">
                        <a href="{{ route('doctor.products.index') }}" class="nav-link {{ request()->routeIs('doctor.products.*') ? 'active' : '' }}">
                            <i class="fas fa-boxes me-1"></i> My Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('doctor.orders.index') }}" class="nav-link {{ request()->routeIs('doctor.orders.*') ? 'active' : '' }}">
                            <i class="fas fa-truck me-1"></i> Product Orders
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('doctor.profile') }}" class="nav-link {{ request()->routeIs('doctor.profile*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle me-1"></i> My Profile
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-decoration-none border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
