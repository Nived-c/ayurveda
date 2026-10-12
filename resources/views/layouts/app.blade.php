<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ayurveda App')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Royal Forest & Sage Mint Clinical Theme */
            --primary-green: #0c3b2e;       /* Deep Royal Forest Green */
            --primary-green-dark: #06231b;  /* Dark Forest Accent */
            --secondary-green: #6d9773;     /* Healing Sage Mint */
            --accent-gold: #ffba08;         /* Warm Honey Amber Accent */
            --light-bg: #e2ebe4;            /* Aesthetic Minimalist Green */
            --card-bg: #ffffff;
            --text-dark: #072a21;
            --text-muted: #577568;
            --border-color: rgba(109, 151, 115, 0.22);
            
            --shadow-sm: 0 4px 15px rgba(12, 59, 46, 0.05);
            --shadow-md: 0 10px 30px rgba(12, 59, 46, 0.10);
            --shadow-lg: 0 18px 45px rgba(12, 59, 46, 0.16);
            --radius-md: 16px;
            --radius-lg: 24px;
        }

        /* Hide browser-native password reveal eye icons (Edge / IE / Safari / Chrome) */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear,
        input[type="password"]::-webkit-contacts-auto-fill-button,
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(109, 151, 115, 0.16), transparent 34%),
                radial-gradient(circle at bottom right, rgba(255, 186, 8, 0.10), transparent 28%),
                linear-gradient(180deg, #f3f7f2 0%, #edf3ee 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-shell {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(109, 151, 115, 0.18);
            background: rgba(255, 255, 255, 0.38);
            border-radius: 30px;
            box-shadow: var(--shadow-sm);
            padding: 1.5rem;
        }

        .page-shell::before,
        .page-shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(10px);
        }

        .page-shell::before {
            width: 190px;
            height: 190px;
            background: rgba(109, 151, 115, 0.12);
            top: -40px;
            right: -20px;
        }

        .page-shell::after {
            width: 220px;
            height: 220px;
            background: rgba(255, 186, 8, 0.08);
            bottom: -55px;
            left: -30px;
        }

        .page-shell > * {
            position: relative;
            z-index: 1;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        h2 {
            color: var(--primary-green);
            font-weight: 700;
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-green) !important;
            padding: 1rem 2rem;
            box-shadow: var(--shadow-sm);
        }
        
        .navbar-brand {
            color: var(--accent-gold) !important;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 400;
            margin-left: 1rem;
            transition: color 0.3s ease;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .nav-link:hover, .nav-link:focus {
            color: var(--accent-gold) !important;
        }

        /* Buttons */
        .btn {
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            box-shadow: 0 4px 12px rgba(26, 77, 46, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--secondary-green);
            border-color: var(--secondary-green);
            transform: translateY(-1px);
        }
        
        .btn-outline-success {
            color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .btn-outline-success:hover {
            background-color: var(--primary-green);
            color: white;
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .card-header {
            background-color: white;
            border-bottom: 2px solid var(--light-bg);
            color: var(--primary-green);
            font-weight: 700;
            font-size: 1.2rem;
            padding: 1.25rem 1.5rem;
            font-family: 'Playfair Display', serif;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 3rem 0;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: var(--radius-md);
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #1b5e20;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
        }

        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
        }

        .navbar-nav .dropdown-menu {
            margin-top: 0.2rem;
        }

        /* Admin Sidebar Custom Styles */
        .admin-sidebar .hover-bg:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff !important;
            opacity: 1 !important;
        }
        .admin-sidebar .nav-link {
            transition: all 0.25s ease;
            color: rgba(255,255,255,0.8) !important;
        }
        .admin-sidebar .nav-link:hover {
            color: #fff !important;
        }
        .admin-sidebar .nav-link.active {
            color: var(--text-dark) !important;
            box-shadow: 0 4px 12px rgba(255, 186, 8, 0.25);
        }
    </style>
</head>
<body>
    @if(request()->is('admin*') && !request()->is('admin/login'))
        <div class="d-flex" style="min-height: 100vh;">
            <!-- Admin Sidebar -->
            <aside class="admin-sidebar text-white d-flex flex-column flex-shrink-0 p-3" style="width: 280px; background-color: var(--primary-green); border-right: 1px solid rgba(255,255,255,0.1); position: fixed; height: 100vh; top: 0; left: 0; z-index: 1030; overflow-y: auto;">
                <!-- Brand -->
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 me-md-auto text-white text-decoration-none px-2 py-3 border-bottom border-white border-opacity-10 w-100">
                    <i class="fas fa-user-shield me-2 fs-4 text-warning"></i>
                    <span class="fs-4 fw-bold letter-spacing-1">Admin Portal</span>
                </a>
                
                <!-- Navigation List -->
                <ul class="nav nav-pills flex-column mb-auto gap-1">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.dashboard') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-chart-line fs-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.bookings.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-calendar-check fs-5"></i>
                            <span>Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.orders.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-shopping-bag fs-5"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.products.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-cubes fs-5"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.product') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.categories.product*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-tags fs-5"></i>
                            <span>Product Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.doctors.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.doctors.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-user-md fs-5"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.doctor') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.categories.doctor*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-stethoscope fs-5"></i>
                            <span>Doctor Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.astrology.edit') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.astrology.edit') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-star-of-life fs-5"></i>
                            <span>Astrology Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.contact') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.settings.contact') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-address-book fs-5"></i>
                            <span>Contact Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pharmas.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.pharmas.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-building fs-5"></i>
                            <span>Pharmacies</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.users.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-users fs-5"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.advertisements.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 {{ request()->routeIs('admin.advertisements.*') ? 'active bg-warning fw-bold shadow-sm' : 'opacity-85 hover-bg' }}">
                            <i class="fas fa-bullhorn fs-5"></i>
                            <span>Advertisements</span>
                        </a>
                    </li>
                </ul>

                <!-- Footer / Logout -->
                <div class="mt-auto border-top border-white border-opacity-10 pt-3">
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2 fw-bold text-decoration-none">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Content Area -->
            <main class="flex-grow-1" style="margin-left: 280px; padding: 2.5rem; background-color: #f8faf9; min-height: 100vh; overflow-x: hidden;">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 border-0 mb-4" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle fs-5"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-4 border-0 mb-4" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-exclamation-circle fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    @else
        @yield('navbar')

        <div class="main-content" style="{{ isset($fullWidth) && $fullWidth ? 'padding: 0;' : 'padding: 3rem 0;' }}">
            @if(isset($fullWidth) && $fullWidth)
                @if(session('success') || session('error'))
                    <div class="container mt-3">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                @endif
                @yield('content')
            @else
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            @endif
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    @if(Auth::guard('web')->check())
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Request Native OS / Device Push Notification Permission
        if ("Notification" in window && Notification.permission !== "granted" && Notification.permission !== "denied") {
            Notification.requestPermission();
        }

        function checkNativeNotifications() {
            fetch("{{ route('notifications.unread_latest') }}", {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.has_notification) {
                        // 1. Trigger Native OS / Mobile Push Notification
                        if ("Notification" in window && Notification.permission === "granted") {
                            const nativeNotif = new Notification(data.title, {
                                body: data.message,
                                icon: "{{ asset('favicon.ico') }}",
                                vibrate: [200, 100, 200]
                            });
                            nativeNotif.onclick = function() {
                                window.focus();
                                if (data.link) window.location.href = data.link;
                            };
                        }

                        // 2. Trigger Floating Web Banner Toast Alert
                        if (data.type === 'appointment_no_confirmation' && data.booking_id) {
                            showNoConfirmationToastAlert(data.title, data.message, data.booking_id, data.doctors_link);
                        } else {
                            showNativeToastAlert(data.title, data.message, data.link);
                        }
                    }
                })
                .catch(err => console.log('Notification check:', err));
        }

        function showNoConfirmationToastAlert(title, message, bookingId, doctorsLink) {
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 m-4 p-4 rounded-4 shadow-lg text-white bg-dark border-0 fade show';
            toast.style.zIndex = '999999';
            toast.style.maxWidth = '400px';
            toast.style.borderLeft = '5px solid #ffba08';
            toast.innerHTML = `
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1 text-warning">${title}</h6>
                        <p class="mb-3 small opacity-90" style="line-height:1.4;">${message}</p>
                        <div class="d-flex gap-2">
                            <button onclick="cancelBookingFromAlert(${bookingId}, this)" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold">
                                <i class="fas fa-times-circle me-1"></i> Cancel Booking
                            </button>
                            <a href="${doctorsLink}" class="btn btn-sm btn-success rounded-pill px-3 fw-bold text-decoration-none">
                                <i class="fas fa-user-md me-1"></i> Consult Another
                            </a>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            document.body.appendChild(toast);
        }

        window.cancelBookingFromAlert = function(bookingId, btnElement) {
            if (!confirm('Are you sure you want to cancel this appointment?')) return;
            
            btnElement.disabled = true;
            btnElement.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Cancelling...';
            
            fetch('/bookings/' + bookingId + '/cancel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                // Remove the toast
                toastContainer = btnElement.parentElement.parentElement.parentElement.parentElement;
                if(toastContainer) toastContainer.remove();
                
                // Show a success toast or reload
                const successToast = document.createElement('div');
                successToast.className = 'position-fixed top-0 end-0 m-4 p-4 rounded-4 shadow-lg text-white bg-success border-0 fade show';
                successToast.style.zIndex = '999999';
                successToast.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <div>${data.message || 'Appointment cancelled successfully.'}</div>
                    </div>
                `;
                document.body.appendChild(successToast);
                setTimeout(() => { successToast.remove(); location.reload(); }, 2000);
            })
            .catch(err => {
                console.error(err);
                alert('Failed to cancel appointment. Please try again.');
                btnElement.disabled = false;
                btnElement.innerHTML = '<i class="fas fa-times-circle me-1"></i> Cancel Booking';
            });
        };

        function showNativeToastAlert(title, message, link) {
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 m-4 p-4 rounded-4 shadow-lg text-white bg-success border-0 fade show';
            toast.style.zIndex = '999999';
            toast.style.maxWidth = '380px';
            toast.innerHTML = `
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-check-circle fa-2x text-warning flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">${title}</h6>
                        <p class="mb-2 small opacity-90" style="line-height:1.4;">${message}</p>
                        <a href="${link || '#'}" class="btn btn-sm btn-light text-success fw-bold rounded-pill px-3">View Details</a>
                    </div>
                    <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            document.body.appendChild(toast);
        }

        // Check every 6 seconds
        setInterval(checkNativeNotifications, 6000);
    });
    </script>
    @endif

    @if(Auth::guard('doctor')->check())
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if ("Notification" in window && Notification.permission !== "granted" && Notification.permission !== "denied") {
            Notification.requestPermission();
        }

        function checkDoctorNotifications() {
            fetch("{{ route('doctor.notifications.unread_latest') }}", {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.has_notification) {
                        if ("Notification" in window && Notification.permission === "granted") {
                            const nativeNotif = new Notification(data.title, {
                                body: data.message,
                                icon: "{{ asset('favicon.ico') }}",
                                vibrate: [200, 100, 200]
                            });
                            nativeNotif.onclick = function() {
                                window.focus();
                                if (data.link) window.location.href = data.link;
                            };
                        }
                        showNativeToastAlert(data.title, data.message, data.link);
                    }
                })
                .catch(err => console.log('Doctor Notification check:', err));
        }

        function showNativeToastAlert(title, message, link) {
            const toast = document.createElement('div');
            toast.className = 'position-fixed top-0 end-0 m-4 p-4 rounded-4 shadow-lg text-white bg-success border-0 fade show';
            toast.style.zIndex = '999999';
            toast.style.maxWidth = '380px';
            toast.innerHTML = `
                <div class="d-flex align-items-start gap-3">
                    <i class="fas fa-check-circle fa-2x text-warning flex-shrink-0 mt-1"></i>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">${title}</h6>
                        <p class="mb-2 small opacity-90" style="line-height:1.4;">${message}</p>
                        <a href="${link || '#'}" class="btn btn-sm btn-light text-success fw-bold rounded-pill px-3">View Details</a>
                    </div>
                    <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;
            document.body.appendChild(toast);
        }

        setInterval(checkDoctorNotifications, 6000);
    });
    </script>
    @endif

    @yield('scripts')

    @if(request()->is('/') || request()->routeIs('home'))
        @include('partials.popup-ad')
    @endif
</body>
</html>
