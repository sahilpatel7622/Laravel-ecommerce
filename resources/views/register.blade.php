@extends('common')
@section('content')
@section('hide_footer', true)

<div class="container custom-login" style="position: relative; bottom: 20px;">
    <div class="glass-card">
        <h1>Register</h1>

        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #dc3545; color: white; border: 1px solid #b02a37; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-custom-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Full Name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="number" class="form-control" value="{{ old('number') }}" placeholder="Phone Number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Choose Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</div>
@endsection
