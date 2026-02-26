@extends('common')
@section('title', 'Cart List')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 500px;">
        <h2 class="text-center fw-bold text-dark mb-4">Cart List</h2>
        
        @if($products->isEmpty())
            <div class="alert alert-warning text-center p-5 rounded-3 shadow-sm" style="background-color: #fffbf0; border-color: #fde68a;">
                <i class="bi bi-bag-x fs-1 text-warning mb-3 d-block"></i>
                <h4 class="fw-bold text-dark mb-3">No Orders Found</h4>
                <p class="text-muted mb-4">Looks like you haven't placed any orders yet. Start exploring our amazing products!</p>
                <a href="/products" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">Shop Now</a>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive bg-white rounded shadow-sm p-3">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Product</th>
                                    <th scope="col" class="border-0">Description</th>
                                    <th scope="col" class="border-0 text-center">Qty</th>
                                    <th scope="col" class="border-0 text-center">Price</th>
                                    <th scope="col" class="border-0 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0; @endphp
                                @foreach ($products as $item)
                                    @php 
                                        $price = (float) str_replace(['₹', '$', '€', '£', ',', ' '], '', $item->price);
                                        $itemTotal = $price * $item->quantity;
                                        $totalPrice += $itemTotal; 
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="detail/{{ $item->id }}" class="text-decoration-none text-dark d-flex align-items-center">
                                                <img src="{{ $item->gallery }}" class="img-fluid rounded me-3" alt="{{ $item->name }}" style="width: 80px; height: 80px; object-fit: contain; border: 1px solid #eee;">
                                                <div class="fw-bold">{{ $item->name }}</div>
                                            </a>
                                        </td>
                                        <td>
                                            <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">
                                                {{ $item->description }}
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group input-group-sm mx-auto" style="width: 110px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-radius: 6px; overflow: hidden;">
                                                <button class="btn btn-light border-secondary-subtle px-2" type="button" onclick="updateCartQty({{ $item->cart_id }}, {{ $item->quantity - 1 }})" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <input type="text" class="form-control text-center fw-bold border-secondary-subtle bg-white px-0" value="{{ $item->quantity }}" readonly>
                                                <button class="btn btn-light border-secondary-subtle px-2" type="button" onclick="updateCartQty({{ $item->cart_id }}, {{ $item->quantity + 1 }})">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold text-dark fs-5">
                                            ₹{{ number_format($itemTotal, 2) }}
                                        </td>
                                        <td class="text-center">
                                            <a href="/removecart/{{ $item->cart_id }}" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Remove
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                function updateCartQty(cartId, newQty) {
                    if (newQty > 0) {
                        window.location.href = `/updatecart/${cartId}/${newQty}`;
                    }
                }
            </script>

            @php
                $totalAmount = $totalPrice; // No tax or delivery charge
            @endphp

            <div class="row justify-content-end mt-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #f8f9fa;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">Cart Summary</h5>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Subtotal</span>
                                <span class="fw-bold fs-5 text-success">₹{{ number_format($totalAmount, 2) }}</span>
                            </div>
                            <a href="/order" class="btn btn-success w-100 fw-bold py-2" style="border-radius: 8px;">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection