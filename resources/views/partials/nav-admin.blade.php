<style>
    .admin-navbar {
        background: linear-gradient(135deg, #0c3b2e 0%, #1d5c42 60%, #6d9773 100%) !important;
        padding: 0.85rem 2rem;
        box-shadow: 0 4px 20px rgba(12, 59, 46, 0.25);
        z-index: 1050;
    }
    .admin-navbar .navbar-brand {
        color: #ffba08 !important;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .admin-navbar .nav-link {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 500;
        margin-left: 0.8rem;
        font-size: 0.92rem;
        transition: all 0.2s ease;
        position: relative;
        padding-bottom: 6px;
    }
    .admin-navbar .nav-link:hover, 
    .admin-navbar .nav-link:focus {
        color: #ffba08 !important;
        transform: translateY(-1px);
    }
    .admin-navbar .nav-link::after {
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
    .admin-navbar .nav-link.active {
        color: #ffba08 !important;
        font-weight: 700;
    }
    .admin-navbar .nav-link.active::after,
    .admin-navbar .nav-link:hover::after {
        width: 80%;
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top admin-navbar">
    <div class="container-fluid">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand d-flex align-items-center gap-2">
            <i class="fas fa-user-shield text-warning"></i>
            <span>Admin Portal</span>
        </a>
        <button class="navbar-toggler text-white border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-1">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check me-1"></i> Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag me-1"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-cubes me-1"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.product') }}" class="nav-link {{ request()->routeIs('admin.categories.product*') ? 'active' : '' }}">
                        <i class="fas fa-boxes me-1"></i> Product Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                        <i class="fas fa-user-md me-1"></i> Doctors
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.doctor') }}" class="nav-link {{ request()->routeIs('admin.categories.doctor*') ? 'active' : '' }}">
                        <i class="fas fa-stethoscope me-1"></i> Doctor Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.astrology.edit') }}" class="nav-link {{ request()->routeIs('admin.astrology.*') ? 'active' : '' }}">
                        <i class="fas fa-star-of-life me-1"></i> Astrology Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.contact') }}" class="nav-link {{ request()->routeIs('admin.settings.contact*') ? 'active' : '' }}">
                        <i class="fas fa-address-book me-1"></i> Contact Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pharmas.index') }}" class="nav-link {{ request()->routeIs('admin.pharmas.*') ? 'active' : '' }}">
                        <i class="fas fa-building me-1"></i> Pharmacies
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-1"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.advertisements.index') }}" class="nav-link {{ request()->routeIs('admin.advertisements.*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn me-1"></i> Ads
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
