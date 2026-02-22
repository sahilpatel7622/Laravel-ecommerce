<?php
use App\Http\Controllers\products;
$total = 0;
if(Auth::check()) {
    $total = products::cartItem();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" style="font-size: 27px; margin-right: 30px;" href="/">E-Comm</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" style="font-size: 17px;" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="margin-left: 5px; font-size: 16px;" href="{{ route('products') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="margin-left: 5px; font-size: 16px;" href="{{ route('about') }}">About Us</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        @if(Auth::check())
              <form action="/search" class="d-flex me-5 pe-5">
                <input class="form-control me-2 search-box" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            <li class="nav-item ms-3" style="position: relative; left: 40px;">
                <a class="nav-link fw-bold text-dark" href="/cartlist">
                     Cart ({{ $total }})
                </a>
            </li>
            <li class="nav-item dropdown ms-4">
                <a class="nav-link text-dark d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding:0;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; position: relative; left: 40px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown" style="border-radius: 12px; padding: 10px; min-width: 200px; margin-top: 15px;">
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="/profile" style="font-weight: 500;">
                            <i class="bi bi-person-fill text-primary me-3" style="font-size: 1.2rem;"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="/myorders" style="font-weight: 500;">
                            <i class="bi bi-box-seam-fill text-primary me-3" style="font-size: 1.2rem;"></i> My Orders
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-2"></li>
                    <li>
                        <a class="dropdown-item text-danger py-2 d-flex align-items-center" href="{{ route('logout') }}" style="font-weight: 500;">
                            <i class="bi bi-box-arrow-right me-3" style="font-size: 1.2rem;"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
            </li>
        @endif
      </ul>
    </div>
  </div>
</nav>