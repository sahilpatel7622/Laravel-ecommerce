@extends('common')
@section('title', 'My Orders')
@section('content')

    <style>
        .order-table-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 25px;
            margin-bottom: 40px;
        }
        .table-custom {
            vertical-align: middle;
        }
        .table-custom th {
            font-weight: 600;
            color: #4a5568;
            border-bottom-width: 2px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table-custom td {
            color: #2b2d42;
            padding: 1.2rem 0.5rem;
        }
        .order-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 5px;
            background: #f8fafc;
            transition: transform 0.3s ease;
        }
        .order-img:hover {
            transform: scale(1.05);
        }
        .product-name {
            font-weight: 600;
            color: #2b2d42;
            margin-bottom: 4px;
        }
        .product-desc {
            font-size: 0.85rem;
            color: #718096;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        .status-delivered {
            background-color: #d1fae5;
            color: #059669;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .order-price {
            font-weight: 700;
            color: #4338ca;
            font-size: 1.1rem;
        }
        .btn-cancel {
            font-size: 0.75rem;
            color: #ef4444;
            border: 1px solid #fca5a5;
            background-color: transparent;
            text-decoration: none;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 50px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancel:hover {
            background-color: #fee2e2;
            color: #dc2626;
            border-color: #f87171;
        }
    </style>

    <div class="container mt-5 mb-5" style="min-height: 600px;">
        <h2 class="fw-bold text-dark mb-4 d-flex align-items-center justify-content-center">
            <i class="bi bi-box-seam me-3 text-primary"></i> My Orders
        </h2><br>
        
        @if($orders->isEmpty())
            <div class="alert alert-warning text-center p-5 rounded-3 shadow-sm" style="background-color: #fffbf0; border-color: #fde68a;">
                <i class="bi bi-bag-x fs-1 text-warning mb-3 d-block"></i>
                <h4 class="fw-bold text-dark mb-3">No Orders Found</h4>
                <p class="text-muted mb-4">Looks like you haven't placed any orders yet. Start exploring our amazing products!</p>
                <a href="/products" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">Shop Now</a>
            </div>
        @else
            <div class="order-table-container">
                <div class="table-responsive">
                    <table class="table table-hover table-custom mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 100px;">Item</th>
                                <th scope="col">Product Details</th>
                                <th scope="col">Shipping Info</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Order Placed</th>
                                <th scope="col" class="text-end">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a href="/detail/{{ $order->id }}">
                                            <img src="{{ $order->gallery }}" alt="{{ $order->name }}" class="order-img">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="product-name">
                                            <a href="/detail/{{ $order->id }}" class="text-decoration-none text-dark">
                                                {{ $order->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-muted mb-1"><i class="bi bi-geo-alt-fill me-1"></i> {{ $order->address }}</div>
                                        <div class="small text-muted mb-1"><i class="bi bi-credit-card-fill me-1"></i> Paid via: <span class="text-uppercase fw-semibold">{{ $order->payment_method }}</span></div>
                                        @if(in_array(strtolower($order->status), ['delivered', 'done']) || strtolower($order->payment_method) != 'cash')
                                            <div class="small text-success fw-semibold mt-1"><i class="bi bi-check2-circle me-1"></i> Payment Confirmed</div>
                                        @else
                                            <div class="small text-warning fw-semibold mt-1"><i class="bi bi-hourglass-split me-1"></i> Payment Pending</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="gap: 8px;">
                                            <span class="status-badge {{ in_array(strtolower($order->status), ['delivered', 'done']) ? 'status-delivered' : (strtolower($order->status) == 'cancelled' ? 'status-cancelled' : 'status-pending') }}">
                                                @if(in_array(strtolower($order->status), ['delivered', 'done']))
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                @elseif(strtolower($order->status) == 'cancelled')
                                                    <i class="bi bi-x-circle-fill me-1"></i>
                                                @else
                                                    <i class="bi bi-clock-history me-1"></i>
                                                @endif
                                                {{ ucfirst($order->status ?? 'Processing') }}
                                            </span>
                                            @if(strtolower($order->status) == 'pending')
                                                <a href="/cancelorder/{{ $order->order_id }}" class="btn-cancel" onclick="return confirm('Are you sure you want to cancel this order?');">
                                                    <i class="bi bi-x me-1 fs-6"></i> Cancel
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="small text-dark fw-medium">
                                            @if(isset($order->created_at))
                                                <i class="bi bi-calendar-check me-1 text-muted"></i> {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                                                <br>
                                                <span class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($order->created_at)->format('h:i A') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-end align-middle">
                                        @php
                                            $basePrice = (float) str_replace(['₹', '$', '€', '£', ',', ' '], '', $order->price);
                                            $tax = $basePrice * 0.005;
                                            $delivery = $basePrice > 0 ? 99 : 0;
                                            $discount = ($basePrice + $tax + $delivery) * 0.03;
                                            $grandTotal = $basePrice + $tax + $delivery - $discount;
                                        @endphp
                                        <div class="order-price">₹{{ number_format($grandTotal) }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection