@extends('common')
@section('content')
@section('hide_footer', true)

    <div class="container custom-login">
        <div class="glass-card" style="background-color: #667eea;">
            <h1>Forgot Password</h1>
            <p style="position: relative; bottom: 17px;">Enter your email address to reset your password.</p>
            @if(session('error'))
                <div class="alert alert-custom-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom-error">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('Password.send-otp') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

@endsection

<style>
    .custom-login {
        height: 500px;
        padding-top: 100px;
    }
</style>