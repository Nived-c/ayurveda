@extends('layouts.app')

@section('navbar')
    @include('partials.nav-admin')
@endsection

@section('title', 'Portal Contact Settings | Admin Portal')

@section('content')
<div class="container py-4 px-4 px-xl-5" style="max-width: 900px;">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 p-4 bg-white rounded-4 shadow-sm border">
        <div>
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1.5 rounded-pill small fw-bold mb-2">
                <i class="fas fa-address-book me-1"></i> Global Portal Settings
            </span>
            <h2 class="fw-bold text-dark mb-0">Portal Contact Settings</h2>
            <p class="text-muted small mb-0 mt-1">Manage contact number and email address shown on the user home page.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark px-3 py-2 fw-bold small rounded-3 shadow-sm text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('admin.settings.contact.update') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="contact_phone" class="form-label fw-bold">Contact Phone Number</label>
                        <input type="text" 
                               name="contact_phone" 
                               id="contact_phone" 
                               class="form-control form-control-lg @error('contact_phone') is-invalid @enderror" 
                               placeholder="e.g. 8678888777" 
                               value="{{ old('contact_phone', $settings['contact_phone']) }}"
                               pattern="[6-9][0-9]{9}" 
                               maxlength="10" 
                               minlength="10" 
                               title="Valid 10-digit mobile number starting with 6-9" 
                               oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                               required>
                        @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="contact_email" class="form-label fw-bold">Contact Email Address</label>
                        <input type="email" 
                               name="contact_email" 
                               id="contact_email" 
                               class="form-control form-control-lg @error('contact_email') is-invalid @enderror" 
                               placeholder="e.g. info@ayurveda.com" 
                               value="{{ old('contact_email', $settings['contact_email']) }}"
                               required>
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 pt-2 border-top d-flex gap-3">
                    <button type="submit" class="btn btn-success btn-lg rounded-3 px-5 shadow-sm fw-bold">
                        <i class="fas fa-save me-2"></i>Save Contact Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-3 px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
