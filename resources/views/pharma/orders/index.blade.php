@extends('layouts.app')

@section('navbar')
    @include('partials.nav-pharma')
@endsection

@section('title', 'Manage Customer Orders | Pharma Portal')

@section('content')
<div class="container py-4">
    {{-- Header Banner --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--primary-green);">
                <i class="fas fa-shopping-bag me-2"></i>Product Orders
            </h2>
            <p class="text-muted mb-0">View and manage customer product orders for your pharmacy.</p>
        </div>
        <a href="{{ route('pharma.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>
    </div>

    {{-- Metrics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-boxes fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Total Orders</div>
                        <div class="fs-4 fw-bold text-dark">{{ $totalOrdersCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-15 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-clock fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Pending Orders</div>
                        <div class="fs-4 fw-bold text-dark">{{ $pendingCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-truck fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Shipped</div>
                        <div class="fs-4 fw-bold text-dark">{{ $shippedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase">Delivered</div>
                        <div class="fs-4 fw-bold text-dark">{{ $deliveredCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-list text-success me-2"></i>Order List
            </h5>
            <div class="d-flex align-items-center gap-1 flex-wrap">
                @php $currentStatus = request()->query('status', 'All'); @endphp
                <a href="{{ route('pharma.orders.index') }}" class="btn btn-sm rounded-pill px-3 fw-semibold {{ $currentStatus == 'All' ? 'btn-success' : 'btn-light border' }}">
                    All
                </a>
                <a href="{{ route('pharma.orders.index', ['status' => 'Pending']) }}" class="btn btn-sm rounded-pill px-3 fw-semibold {{ $currentStatus == 'Pending' ? 'btn-warning text-dark' : 'btn-light border' }}">
                    Pending
                </a>
                <a href="{{ route('pharma.orders.index', ['status' => 'Shipped']) }}" class="btn btn-sm rounded-pill px-3 fw-semibold {{ $currentStatus == 'Shipped' ? 'btn-info text-white' : 'btn-light border' }}">
                    Shipped
                </a>
                <a href="{{ route('pharma.orders.index', ['status' => 'Delivered']) }}" class="btn btn-sm rounded-pill px-3 fw-semibold {{ $currentStatus == 'Delivered' ? 'btn-success' : 'btn-light border' }}">
                    Delivered
                </a>
                <a href="{{ route('pharma.orders.index', ['status' => 'Cancelled']) }}" class="btn btn-sm rounded-pill px-3 fw-semibold {{ $currentStatus == 'Cancelled' ? 'btn-danger' : 'btn-light border' }}">
                    Cancelled
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light small text-uppercase text-muted fw-bold">
                        <tr>
                            <th class="ps-4">Order ID</th>
                            <th>Order Date</th>
                            <th>Customer Info</th>
                            <th>Purchased Items</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Payment</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">#{{ $order->id }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $order->created_at ? $order->created_at->format('d M Y') : 'N/A' }}</div>
                                    <small class="text-muted">{{ $order->created_at ? $order->created_at->format('h:i A') : '' }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $order->user->name ?? 'Guest Customer' }}</div>
                                    <div class="small text-muted">
                                        <i class="fas fa-phone-alt me-1 text-secondary"></i>{{ $order->delivery_phone ?? 'N/A' }}
                                    </div>
                                    @if($order->delivery_pincode)
                                        <div class="small text-muted">
                                            <i class="fas fa-map-marker-alt me-1 text-secondary"></i>PIN: {{ $order->delivery_pincode }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @foreach($order->items as $item)
                                        <div class="small fw-semibold text-dark mb-1">
                                            <i class="fas fa-pills text-success me-1"></i>{{ $item->product ? $item->product->name : 'Product' }}
                                            <span class="badge bg-light text-dark border ms-1">x{{ $item->quantity }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="fw-bold text-success fs-6">
                                    ₹{{ number_format($order->total_price, 2) }}
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($order->order_status) {
                                            'Delivered' => 'bg-success bg-opacity-10 text-success border-success',
                                            'Shipped' => 'bg-info bg-opacity-10 text-info border-info',
                                            'Cancelled' => 'bg-danger bg-opacity-10 text-danger border-danger',
                                            default => 'bg-warning bg-opacity-20 text-dark border-warning',
                                        };
                                    @endphp
                                    <span class="badge rounded-pill border px-3 py-1.5 fw-semibold {{ $statusClass }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td>
                                    @if(in_array($order->payment_status, ['Completed', 'Received', 'Paid', 'Success']))
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-2.5 py-1">
                                            <i class="fas fa-check-circle me-1"></i> Paid
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-20 text-dark border border-warning border-opacity-25 rounded-pill px-2.5 py-1">
                                            <i class="fas fa-clock me-1"></i> Unpaid
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('pharma.orders.show', $order->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-shopping-bag fa-3x mb-3 text-secondary opacity-50"></i>
                                    <p class="mb-0 fs-6">No orders found matching the criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
                <div class="p-3 border-top">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
