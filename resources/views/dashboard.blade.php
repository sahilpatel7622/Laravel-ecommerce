@extends('common')
@section('content')


    <!-- Carousel -->
    <div class="container-fluid p-0">
        <div>
            <div id="carouselExampleCaptions" class="carousel slide carousel-premium-border" data-bs-ride="carousel"
                data-bs-interval="2500">
                <div class="carousel-indicators">
                    @foreach ($data as $item)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"
                            aria-label="Slide {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($data as $item)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-color: #ffffff;">
                            <a href="detail/{{ $item['id'] }}">
                                <img src="{{ $item['gallery'] }}" class="d-flex"
                                    style="height: 400px; width: 500px; object-fit: contain; position: relative; left: 20%;"
                                    alt="{{ $item['name'] }}">
                                <div class="carousel-caption d-none d-md-block carousel-caption-custom">
                                    <h5
                                        style="color:aqua; background-color: rgba(0, 0, 0, 0.5); width: 340px; position: relative; left: 600px; bottom: 110px; font-size: 25px;">
                                        {{ $item['name'] }}</h5>
                                    <p
                                        style="color:rgba(74, 9, 227, 0.5); background-color: rgba(84, 34, 34, 0.5); width: 340px; position: relative; left: 600px; bottom: 95px; font-size: 20px;">
                                        {{ $item['description'] }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div><br><br>

    <!-- Trending Products -->
    <div class="container mb-5 pb-4 mt-5">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
            <div>
                <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Trending Products <i class="bi bi-fire text-danger ms-1"></i></h2>
                <p class="text-muted mb-0 mt-1">Discover what everyone is buying right now.</p>
            </div>
            <a href="{{ route('products') }}" class="btn btn-outline-primary rounded-pill px-4 d-none d-sm-block fw-semibold hover-lift" style="border-width: 2px;">View All <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 pt-2">
            @foreach ($trending as $item)
                <div class="col">
                    <div class="card h-100 border-0 rounded-4 shadow-sm hover-card premium-transition bg-white">
                        <a href="detail/{{ $item['id'] }}" class="text-decoration-none text-dark">
                        <div class="position-relative overflow-hidden rounded-top-4 bg-light d-flex align-items-center justify-content-center p-4">
                            <img src="{{ $item['gallery'] }}" class="card-img-top object-fit-contain premium-transition" style="height: 180px; mix-blend-mode: multiply;" alt="{{ $item['name'] }}">
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column text-center rounded-bottom-4">
                            <span class="text-muted small text-uppercase fw-bold tracking-wider mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">{{ $item['category'] ?? 'Popular' }}</span>
                            <h5 class="card-title fw-bold text-dark mb-2 text-truncate" title="{{ $item['name'] }}">{{ $item['name'] }}</h5>
                            
                            <!-- Rating -->
                            <div class="mb-3 text-warning small d-flex justify-content-center align-items-center">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <span class="text-muted ms-2 fw-medium" style="font-size: 0.8rem;">(4.5)</span>
                            </div>
                            
                            <div class="mt-auto pt-3 border-top border-light">
                                <h4 class="fw-bolder text-dark mb-0 d-flex justify-content-center align-items-baseline">
                                    <span style="font-size: 0.9rem; margin-right: 2px;"></span>
                                    <span>{{ $item['price'] }}</span>
                                </h4>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>        
        .premium-transition {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
            border-color: rgba(67, 56, 202, 0.1) !important;
            z-index: 5;
        }
        .hover-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 100%);
            border-radius: 1rem 1rem 0 0;
            cursor: pointer;
        }
        .hover-card:hover .hover-overlay {
            opacity: 1 !important;
        }
        .hover-card:hover .card-img-top {
            transform: scale(1.08);
        }
    </style>

    @if(session('order_placed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Order Placed!',
                    text: '{{ session('order_placed') }}',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#4338ca',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="bi bi-box-seam me-1"></i> My Orders',
                    cancelButtonText: '<i class="bi bi-cart me-1"></i> Continue Shopping',
                    reverseButtons: true,
                    showClass: { popup: 'animate__animated animate__zoomIn' },
                    hideClass: { popup: 'animate__animated animate__zoomOut' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/myorders';
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = '/products';
                    }
                });
            });
        </script>
    @endif
@endsection