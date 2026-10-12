@extends('layouts.app')

@section('navbar')
    @include('partials.nav-public')
@endsection

@section('title', 'Privacy Policy | Ayurveda')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient text-white py-4 text-center" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);">
                    <h1 class="h3 fw-bold mb-0 text-white"><i class="fas fa-user-shield me-2"></i> Privacy Policy</h1>
                    <p class="mb-0 opacity-75 small mt-1">Last Updated: August 2026</p>
                </div>
                <div class="card-body p-4 p-md-5 bg-white text-dark">
                    <div class="text-center mb-5">
                        <span class="d-inline-block bg-light p-3 rounded-circle text-success mb-3" style="font-size: 2.5rem;">
                            <i class="fas fa-lock"></i>
                        </span>
                        <h2 class="h4 fw-bold">Your Privacy & Safeguards</h2>
                        <p class="text-muted">We respect your privacy and are committed to protecting your personal data.</p>
                    </div>

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-database me-2"></i> 1. Information We Collect</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            We collect data that you provide during registration or order checkout, including your name, email, phone number, physical address, professional license documents (for doctors/hospitals/pharma), and payment records. No payment card details are stored directly on our servers.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-chart-line me-2"></i> 2. How We Use Your Data</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            Your information is utilized to authenticate your identity, process product orders, schedule clinical consultation tokens, send notifications (order shipments/cancellations/reminders), and ensure regulatory compliance for medical practitioners and retail outlets.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-share-alt me-2"></i> 3. Sharing of Information</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            We do not sell or lease your personal information. Your contact and shipping details are shared strictly with the relevant doctors or pharmacy companies fulfilling your specific appointments or product purchases, as necessary to perform the requested service.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-user-lock me-2"></i> 4. Security Measures</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            We implement industry-standard encryption, firewall protection, and secure socket layers (SSL) to safeguard your data. Access to medical history, doctor licenses, and transaction records is strictly limited to authorized platform operators and the user.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-cookie-bite me-2"></i> 5. Cookies & Tracking</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            We use cookies to maintain your login session state, remember items added to your shopping cart, and improve overall dashboard performance. You can disable cookies in your browser settings, though some interactive elements may not work properly.
                        </p>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ url()->previous() ?? url('/') }}" class="btn btn-primary px-5 py-3 fw-bold rounded-pill text-white shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
