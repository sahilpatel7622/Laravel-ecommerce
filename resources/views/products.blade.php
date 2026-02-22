@extends('common')
@section('title', 'Products')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 500px;">
        <h1 class="text-center fw-bold text-dark mb-5">Products</h1>
        
        <!-- Mobiles Section -->
        <h3 class="fw-bold mb-4 border-bottom pb-2">Mobiles</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
            @foreach ($mobiles as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)';">
                        <a href="detail/{{ $item['id'] }}" class="text-decoration-none text-dark">
                            <img src="{{ $item['gallery'] }}" class="card-img-top p-3" alt="{{ $item['name'] }}" style="height: 200px; object-fit: contain;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-truncate">{{ $item['name'] }}</h5>
                                <p class="card-text text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $item['description'] }}</p>
                                <h5 class="text-primary mt-2">Price: {{ $item['price'] }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><br>

        <!-- TVs Section -->
        <h3 class="fw-bold mb-4 border-bottom pb-2 mt-5">TVs</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($tvs as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)';">
                        <a href="detail/{{ $item['id'] }}" class="text-decoration-none text-dark">
                            <img src="{{ $item['gallery'] }}" class="card-img-top p-3" alt="{{ $item['name'] }}" style="height: 200px; object-fit: contain;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-truncate">{{ $item['name'] }}</h5>
                                <p class="card-text text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $item['description'] }}</p>
                                <h5 class="text-primary mt-2">Price: {{ $item['price'] }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection