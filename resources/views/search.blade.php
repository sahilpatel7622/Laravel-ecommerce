@extends('common')
@section('title', 'Search Results')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 500px;">
        <h2 class="text-center fw-bold text-dark mb-4">Search Results</h2>
        
        @if($data->isEmpty())
            <div class="alert alert-warning text-center">
                No products found matching your search.
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($data as $item)
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
        @endif
    </div>
@endsection