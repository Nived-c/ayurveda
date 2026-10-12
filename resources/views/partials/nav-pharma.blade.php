<style>
    .pharma-navbar {
        background: linear-gradient(135deg, #0c3b2e 0%, #1d5c42 60%, #6d9773 100%) !important;
        padding: 0.85rem 2rem;
        box-shadow: 0 4px 20px rgba(12, 59, 46, 0.25);
        z-index: 1050;
    }
    .pharma-navbar .navbar-brand {
        color: #ffba08 !important;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .pharma-navbar .nav-link {
        color: rgba(255, 255, 255, 0.92) !important;
        font-weight: 500;
        margin-left: 1.2rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        position: relative;
        padding-bottom: 6px;
    }
    .pharma-navbar .nav-link:hover, 
    .pharma-navbar .nav-link:focus {
        color: #ffba08 !important;
        transform: translateY(-1px);
    }
    .pharma-navbar .nav-link::after {
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
    .pharma-navbar .nav-link.active {
        color: #ffba08 !important;
        font-weight: 700;
    }
    .pharma-navbar .nav-link.active::after,
    .pharma-navbar .nav-link:hover::after {
        width: 80%;
    }
</style>
<nav class="navbar navbar-expand-lg sticky-top pharma-navbar">
    <div class="container-fluid">
        <a href="{{ route('pharma.dashboard') }}" class="navbar-brand d-flex align-items-center gap-2">
            <i class="fas fa-pills text-warning"></i>
            <span>Ayurveda</span>
            <span class="badge bg-warning text-dark fs-6 px-2.5 py-1 rounded-pill ms-1" style="font-family: sans-serif; font-size: 0.75rem !important;">Pharmacy Portal</span>
        </a>
        <button class="navbar-toggler text-white border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a href="{{ route('pharma.dashboard') }}" class="nav-link {{ request()->routeIs('pharma.dashboard') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pharma.orders.index') }}" class="nav-link {{ request()->routeIs('pharma.orders.*') ? 'active' : '' }}">
                        Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pharma.products.create') }}" class="nav-link {{ request()->routeIs('pharma.products.create') ? 'active' : '' }}">
                        Add Product
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pharma.profile.edit') }}" class="nav-link {{ request()->routeIs('pharma.profile.*') ? 'active' : '' }}">
                        Profile
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-decoration-none border-0 bg-transparent">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
