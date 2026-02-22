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

                <form action="/add_to_cart" method="POST" style="display: inline-block;">
                    <input type="hidden" name="product_id" value="{{ $data->id }}">
                    @csrf
                    <button class="btn btn-success">Add to Cart</button>
                </form>

                <form action="/buynow" method="POST" style="display: inline-block;" class="ms-2">
                    <input type="hidden" name="product_id" value="{{ $data->id }}">
                    @csrf
                    <button class="btn btn-primary">Buy Now</button>
                </form>
            </div>
        </div>
    </div>

@endsection