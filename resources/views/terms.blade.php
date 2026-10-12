@extends('layouts.app')

@section('navbar')
    @include('partials.nav-public')
@endsection

@section('title', 'Terms of Service | Ayurveda')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient text-white py-4 text-center" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);">
                    <h1 class="h3 fw-bold mb-0 text-white"><i class="fas fa-file-contract me-2"></i> Terms of Service</h1>
                    <p class="mb-0 opacity-75 small mt-1">Last Updated: August 2026</p>
                </div>
                <div class="card-body p-4 p-md-5 bg-white text-dark">
                    <div class="text-center mb-5">
                        <span class="d-inline-block bg-light p-3 rounded-circle text-success mb-3" style="font-size: 2.5rem;">
                            <i class="fas fa-balance-scale"></i>
                        </span>
                        <h2 class="h4 fw-bold">Platform Terms & Conditions</h2>
                        <p class="text-muted">Please read these Terms of Service carefully before using our platform.</p>
                    </div>

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-info-circle me-2"></i> 1. Acceptance of Terms</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            By accessing or using the Ayurveda Management System, including registering an account as a Patient, Practitioner, Pharmaceutical Representative, or Hospital Operator, you agree to comply with and be bound by these Terms of Service. If you do not agree, please do not access or use our services.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-user-check me-2"></i> 2. User Accounts & Registration</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            To access most features of the platform, you must register for an account. You agree to provide accurate, current, and complete information. You are solely responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-notes-medical me-2"></i> 3. Clinical & Astrology Services</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            The medical astrology and holistic consulting services provided on this platform are for informational and complementary health purposes. While our practitioners are certified experts, astrology consultations do not replace professional clinical diagnosis or emergency medical care. Always consult a qualified medical professional for serious conditions.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-shield-alt me-2"></i> 4. Professional Conduct</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            All registered medical practitioners, hospitals, and pharmaceutical companies must adhere strictly to professional medical code of conduct and registration requirements. Uploading falsified qualifications, licensing certificates, or drug registrations is strictly prohibited and will result in immediate termination of the account and referral to local authorities.
                        </p>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="terms-section mb-4">
                        <h4 class="fw-bold text-success mb-3"><i class="fas fa-credit-card me-2"></i> 5. Payments, Orders & Refunds</h4>
                        <p class="text-muted" style="line-height: 1.7;">
                            Transactions for consultation bookings and pharmaceutical products are handled securely through our verified payment routes. Users are responsible for paying all fees incurred. Cancellation, rescheduling, or refund policies for product orders or doctor bookings are subject to the specific provider's terms and must be initiated through the platform dashboards.
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
