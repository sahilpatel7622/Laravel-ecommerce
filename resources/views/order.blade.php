@extends('common')
@section('title', 'Orders')
@section('hide_footer', true)
@section('content')
    <div class="container" style="min-height: 500px;">        
        @if($orders->isEmpty())
            <div class="alert alert-warning text-center">
                You have no orders yet.
            </div>
        @else
            @php 
                $totalPrice = 0; 
                foreach ($orders as $item) {
                    $price = (float) str_replace(['₹', '$', '€', '£', ',', ' '], '', $item->price);
                    $totalPrice += $price; 
                }
                $tax = $totalPrice * 0.005; // 0.5% tax
                $delivery = $totalPrice > 0 ? 99 : 0; // Fixed delivery charge
                $discount = ($totalPrice + $tax + $delivery) * 0.03; // 3% discount
                $totalAmount = $totalPrice + $tax + $delivery - $discount;
            @endphp

            <style>
                .checkout-section {
                    background: #ffffff;
                    border-radius: 20px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
                    padding: 30px;
                    margin-bottom: 25px;
                }
                .section-title {
                    font-size: 1.3rem;
                    font-weight: 700;
                    color: #2b2d42;
                    margin-bottom: 20px;
                    display: flex;
                    align-items: center;
                }
                .section-title i {
                    color: #4338ca;
                    margin-right: 10px;
                    font-size: 1.5rem;
                }
                .form-control, .form-select {
                    border-radius: 10px;
                    padding: 12px 15px;
                    border: 1px solid #e2e8f0;
                    transition: border-color 0.3s ease, box-shadow 0.3s ease;
                }
                .form-control:focus, .form-select:focus {
                    border-color: #4338ca;
                    box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.1);
                }
                
                /* Custom Radio Buttons for Payment */
                .payment-option {
                    position: relative;
                    display: block;
                    padding: 15px 20px;
                    border: 2px solid #e2e8f0;
                    border-radius: 12px;
                    margin-bottom: 15px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }
                .payment-option:hover {
                    border-color: #a5b4fc;
                    background-color: #f8fafc;
                }
                .payment-option.active, .payment-option input:checked + div {
                    border-color: #4338ca;
                    background-color: #edf2ff;
                }
                .payment-option input[type="radio"] {
                    display: none;
                }
                .payment-content {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .payment-label {
                    font-weight: 600;
                    color: #2b2d42;
                    font-size: 1.1rem;
                }
                .payment-icon {
                    font-size: 1.8rem;
                    color: #6c757d;
                }
                .payment-option input:checked ~ .payment-content .payment-icon {
                    color: #4338ca;
                }

                /* Order Summary Styles (Retained) */
                .order-summary-card {
                    background: linear-gradient(145deg, #ffffff, #f0f2f5);
                    border-radius: 20px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                    overflow: hidden;
                    transition: transform 0.3s ease;
                    position: sticky;
                    top: 20px;
                }
                .order-summary-card:hover {
                    transform: translateY(-5px);
                }
                .summary-header {
                    background: linear-gradient(135deg, #6c63ff, #4338ca);
                    color: white;
                    padding: 20px 25px;
                    font-size: 1.25rem;
                    font-weight: 700;
                    letter-spacing: 0.5px;
                }
                .summary-body {
                    padding: 30px 25px;
                }
                .summary-row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 15px;
                    font-size: 1.05rem;
                }
                .summary-label {
                    color: #6c757d;
                    font-weight: 500;
                }
                .summary-value {
                    color: #2b2d42;
                    font-weight: 600;
                }
                .summary-divider {
                    border-top: 2px dashed #e2e8f0;
                    margin: 20px 0;
                }
                .total-row {
                    font-size: 1.4rem;
                }
                .total-label {
                    color: #2b2d42;
                    font-weight: 700;
                }
                .total-value {
                    color: #4338ca;
                    font-weight: 800;
                }
                .btn-checkout {
                    background: linear-gradient(135deg, #4338ca, #312e81);
                    color: white;
                    border: none;
                    border-radius: 12px;
                    padding: 15px;
                    font-size: 1.15rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 15px rgba(67, 56, 202, 0.3);
                }
                .btn-checkout:hover {
                    background: linear-gradient(135deg, #312e81, #1e1b4b);
                    color: #ffffff;
                    transform: scale(1.02);
                    box-shadow: 0 6px 20px rgba(67, 56, 202, 0.4);
                }
            </style>

            <form id="checkoutForm" action="/orderplace" method="POST">
                @csrf
                <input type="hidden" name="buy_now" value="{{ request('buy_now') }}">
                <div class="row mt-4">
                    <!-- Left Column: Address and Payment -->
                    <div class="col-lg-7 col-xl-8 mb-4">
                        
                        <!-- Shipping Address Section -->
                        <div class="checkout-section">
                            <h4 class="section-title"><i class="bi bi-geo-alt-fill"></i> Shipping Address</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" name="name" placeholder="John" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile Number</label>
                                    <input type="number" value="{{ Auth::user()->number }}" class="form-control" name="number" placeholder="1234567890" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" value="{{ Auth::user()->email }}" class="form-control" name="email" placeholder="johndoe@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Full Address</label>
                                    <textarea class="form-control" rows="3" name="address" placeholder="123 Main St, Apartment, Studio, or floor" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Mumbai" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="Maharashtra" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Zip</label>
                                    <input type="text" class="form-control" name="zip" placeholder="400001" pattern="[0-9]{6}" minlength="6" maxlength="6" title="Zip code must be exactly 6 digits" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Section -->
                        <div class="checkout-section">
                            <h4 class="section-title"><i class="bi bi-credit-card-fill"></i> Payment Method</h4>
                            
                            <label class="payment-option">
                                <input type="radio" name="payment" value="cash" onchange="document.querySelectorAll('.payment-option').forEach(el=>el.style.borderColor='#e2e8f0'); this.parentElement.style.borderColor='#4338ca';">
                                <div class="payment-content">
                                    <span class="payment-label">Cash on Delivery (COD)</span>
                                    <i class="payment-icon bi bi-cash-coin d-none d-sm-block"></i>
                                </div>
                            </label>
                            
                            <label class="payment-option">
                                <input type="radio" name="payment" value="upi" onchange="document.querySelectorAll('.payment-option').forEach(el=>el.style.borderColor='#e2e8f0'); this.parentElement.style.borderColor='#4338ca';">
                                <div class="payment-content">
                                    <span class="payment-label">UPI / Google Pay / PhonePe</span>
                                    <i class="payment-icon bi bi-phone-fill d-none d-sm-block"></i>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment" value="card" onchange="document.querySelectorAll('.payment-option').forEach(el=>el.style.borderColor='#e2e8f0'); this.parentElement.style.borderColor='#4338ca';">
                                <div class="payment-content">
                                    <span class="payment-label">Credit / Debit Card</span>
                                    <div class="d-none d-sm-flex gap-2 payment-icon">
                                        <i class="bi bi-credit-card-fill"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="col-lg-5 col-xl-4">
                        <div class="order-summary-card">
                            <div class="summary-header d-flex align-items-center">
                                <i class="bi bi-cart-check-fill me-2 fs-4"></i>
                                Order Summary
                            </div>
                            <div class="summary-body">
                                <div class="summary-row">
                                    <span class="summary-label">Items Subtotal</span>
                                    <span class="summary-value">₹{{ number_format($totalPrice, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Estimated Tax (0.5%)</span>
                                    <span class="summary-value">₹{{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span class="summary-label">Standard Delivery</span>
                                    <span class="summary-value">₹{{ number_format($delivery, 2) }}</span>
                                </div>
                                <div class="summary-row" style="color: #059669;">
                                    <span class="summary-label" style="color: #059669;"><i class="bi bi-tags-fill me-1"></i> Special Discount (3%)</span>
                                    <span class="summary-value" style="color: #059669;">- ₹{{ number_format($discount, 2) }}</span>
                                </div>
                                
                                <div class="summary-divider"></div>
                                
                                <div class="summary-row total-row mb-4">
                                    <span class="total-label">Grand Total</span>
                                    <span class="total-value">₹{{ number_format($totalAmount) }}</span>
                                    <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                                </div>
                                
                                <button type="submit" id="placeOrderBtn" class="btn btn-checkout w-100 d-flex justify-content-center align-items-center">
                                    <span>Place Order</span>
                                    <i class="bi bi-check-circle-fill ms-2"></i>
                                </button>
                                
                                <div class="text-center mt-3 text-muted small">
                                    <i class="bi bi-shield-lock-fill text-success me-1"></i> Secure and encrypted payment
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                    const paymentMethodSelected = document.querySelector('input[name="payment"]:checked');
                    
                    if (!paymentMethodSelected) {
                        e.preventDefault(); // Stop form submission
                        Swal.fire({
                            title: 'Payment Method Required',
                            text: 'Please select a payment method before placing your order.',
                            icon: 'warning',
                            confirmButtonColor: '#4338ca',
                            confirmButtonText: 'Okay'
                        });
                    }
                    // Otherwise, allow form to submit
                });
            </script>
        @endif
    </div>
@endsection