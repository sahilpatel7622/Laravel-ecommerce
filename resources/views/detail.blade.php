@extends('common')
@section('title', 'Item Detail')
@section('content')

    <div class="container mt-5 mb-5 pt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $data->gallery }}" class="detail-img" alt="{{ $data->name }}">
            </div>
            <div class="col-md-6">
                <a href="/" class="btn btn-outline-dark mb-4"></i> &#8592; Go Back</a>
                <h2><b>Name : </b>{{ $data->name }}</h2><br>
                <h4><b>Description : </b>{{ $data->description }}</h4><br>
                <h4><b>Category : </b>{{ $data->category }}</h4><br>
                <h3><b>Price: </b>{{ $data->price }}</h3><br><br>

                <div class="d-flex align-items-center mb-4">
                    <span class="fw-bold me-3 fs-5">Quantity:</span>
                    <div class="input-group" style="width: 140px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
                        <button class="btn btn-light border-secondary-subtle px-3" type="button" onclick="decrementQty()">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                        <input type="text" class="form-control text-center fw-bold border-secondary-subtle bg-white" id="qty_display" value="1" readonly>
                        <button class="btn btn-light border-secondary-subtle px-3" type="button" onclick="incrementQty()">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <form action="/add_to_cart" method="POST">
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <input type="hidden" name="quantity" id="cart_qty" value="1">
                        @csrf
                        <button class="btn btn-success px-4 py-2" style="border-radius: 8px; font-weight: 500;">
                            <i class="bi bi-cart-plus me-1"></i> Add to Cart
                        </button>
                    </form>

                    <form action="/buynow" method="POST">
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <input type="hidden" name="quantity" id="buy_qty" value="1">
                        @csrf
                        <button class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 500;">
                            <i class="bi bi-bag-check me-1"></i> Buy Now
                        </button>
                    </form>
                </div>

                <script>
                    function decrementQty() {
                        let display = document.getElementById('qty_display');
                        let val = parseInt(display.value);
                        if(val > 1) {
                            display.value = val - 1;
                            updateHiddenQtys(val - 1);
                        }
                    }
                    function incrementQty() {
                        let display = document.getElementById('qty_display');
                        let val = parseInt(display.value);
                        if(val < 10) {
                            display.value = val + 1;
                            updateHiddenQtys(val + 1);
                        }
                    }
                    function updateHiddenQtys(val) {
                        document.getElementById('cart_qty').value = val;
                        document.getElementById('buy_qty').value = val;
                    }
                </script>
            </div>
        </div>
    </div>

@endsection