@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Order Details') }} #{{ $order->id }}</span>
                    <a href="{{ route('pharma.dashboard') }}" class="btn btn-sm btn-secondary">Back to Dashboard</a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <p>
                                <strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}<br>
                                <strong>Phone:</strong> {{ $order->delivery_phone }}<br>
                                <strong>District:</strong> {{ $order->delivery_district }}<br>
                                <strong>Pincode:</strong> {{ $order->delivery_pincode }}<br>
                                <strong>Address:</strong> {{ $order->delivery_address }}
                            </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h5>Order Summary</h5>
                            <p class="mb-2">
                                <strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}<br>
                                <strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}<br>
                                <strong>Payment Status:</strong> 
                                @if(in_array($order->payment_status, ['Completed', 'Received', 'Paid']))
                                    <span class="badge bg-success px-2 py-1"><i class="fas fa-check-circle me-1"></i> Completed</span>
                                @else
                                    <span class="badge bg-warning text-dark px-2 py-1"><i class="fas fa-clock me-1"></i> Pending</span>
                                @endif
                            </p>

                            <!-- Update Order Status -->
                            <div class="order-status-control mt-3 text-start text-md-end">
                                <label class="small text-muted mb-1 d-block font-weight-bold">Update Order / Shipping Status</label>
                                <form action="{{ route('pharma.orders.status.update', $order->id) }}" method="POST" class="d-inline-block" style="min-width: 250px;">
                                    @csrf
                                    @method('PUT')
                                    <select name="order_status" class="form-select" onchange="this.form.submit()">
                                        <option value="Placed" {{ $order->order_status == 'Placed' ? 'selected' : '' }}>📦 Order Placed (Processing)</option>
                                        <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>🚚 Shipped / Out for Delivery</option>
                                        <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>✅ Delivered to Customer</option>
                                        <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                    </select>
                                </form>
                            </div>

                            <!-- Update Payment Status -->
                            <div class="payment-status-control mt-3 text-start text-md-end">
                                <label class="small text-muted mb-1 d-block font-weight-bold">Update Payment Status</label>
                                <form action="{{ route('pharma.orders.status.update', $order->id) }}" method="POST" class="d-inline-block" style="min-width: 250px;">
                                    @csrf
                                    @method('PUT')
                                    <select name="payment_status" class="form-select" onchange="this.form.submit()">
                                        <option value="Pending" {{ !in_array($order->payment_status, ['Completed', 'Received', 'Paid']) ? 'selected' : '' }}>⏳ Payment Pending</option>
                                        <option value="Completed" {{ in_array($order->payment_status, ['Completed', 'Received', 'Paid']) ? 'selected' : '' }}>💰 Payment Received (Completed)</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <h5>Ordered Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('products.show', $item->product->id) }}" class="d-flex align-items-center text-decoration-none text-success fw-bold">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px; border-radius: 4px;">
                                                @endif
                                                {{ $item->product->name }}
                                            </a>
                                        </td>
                                        <td>Rs. {{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
