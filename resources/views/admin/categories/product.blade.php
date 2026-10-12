@extends('layouts.app')

@section('navbar')
    @include('partials.nav-admin')
@endsection

@section('title', 'Manage Product Categories | Admin Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--primary-green);">
                <i class="fas fa-pills me-2"></i>Product Categories
            </h2>
            <p class="text-muted mb-0">Create and manage main product categories for products.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Left Form: Add Main Product Category --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3 text-dark">
                    <i class="fas fa-plus-circle text-success me-2"></i>Add Product Category
                </h5>
                <form action="{{ route('admin.categories.product.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Category Name</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3" placeholder="e.g. Herbal Formulation, Medicines, Oils" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold py-2 rounded-3">
                        <i class="fas fa-plus me-1"></i> Add Category
                    </button>
                </form>
            </div>
        </div>

        {{-- Right Column: Existing Main Categories --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3 text-dark d-flex align-items-center justify-content-between">
                    <span><i class="fas fa-layer-group text-success me-2"></i>Existing Product Categories ({{ $categories->count() }})</span>
                </h5>
                
                @forelse($categories as $category)
                    <div class="border rounded-3 p-3 mb-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="fas fa-pills fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold m-0 text-dark fs-5">{{ $category->name }}</h6>
                                </div>
                            </div>
                            <form action="{{ route('admin.categories.product.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Delete Category">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-folder-open fa-3x mb-3 text-secondary opacity-50"></i>
                        <p class="mb-0 fs-6">No product categories added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
