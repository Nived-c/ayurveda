@extends('layouts.app')

@section('navbar')
    @include('partials.nav-public')
@endsection

@section('content')
<div class="container page-shell">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4 text-center" style="color: #2c5f2d;">My Orders</h2>

            @if($orders->count() > 0)
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Items &amp; Seller</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            @foreach($order->items as $item)
                                                <div class="mb-1">
                                                    @if($item->product)
                                                        <a href="{{ route('products.show', $item->product->id) }}" class="fw-bold text-success text-decoration-none">{{ $item->product->name }}</a>
                                                     @else
                                                         <span class="fw-bold text-muted">Product Removed</span>
                                                     @endif
                                                    @if($item->product)
                                                        @if($item->product->doctor)
                                                            <small class="text-muted d-block"><i class="fas fa-user-md me-1"></i>Dr. {{ $item->product->doctor->name }}</small>
                                                        @elseif($item->product->pharmaCompany)
                                                            <small class="text-muted d-block"><i class="fas fa-building me-1"></i>{{ $item->product->pharmaCompany->company_name }}</small>
                                                        @else
                                                            <small class="text-muted d-block"><i class="fas fa-store me-1"></i>Ayurveda System</small>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->order_status == 'Delivered' ? 'success' : 'primary' }}">
                                                {{ $order->order_status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(in_array($order->payment_status, ['Completed', 'Received', 'Paid']))
                                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Completed</span>
                                            @else
                                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    You haven't placed any orders yet. <a href="{{ url('products') }}">Start shopping!</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
