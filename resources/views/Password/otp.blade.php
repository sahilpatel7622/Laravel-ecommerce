@extends('common')
@section('content')
@section('hide_footer', true)

    <div class="container custom-login">
        <div class="glass-card" style="background-color: #667eea;">
            <h1 class="mb-3">OTP Verification</h1>
            <p style="position: relative; bottom: 8px;">Enter the 6 digit OTP sent to your email</p>

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

            <form method="post" action="{{ route('Password.verify-otp') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="otp" class="form-control" id="exampleInputEmail1" placeholder="Enter OTP"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Verify OTP</button>
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