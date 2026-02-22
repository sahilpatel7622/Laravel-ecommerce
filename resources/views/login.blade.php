@extends('common')
@section('content')

    <div class="container custom-login">
        <div class="glass-card">
            <h1>Login</h1>
            
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

            <form method="post" action="{{ route('login_store') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>New here? <a href="{{ route('register') }}">Create an Account</a></p>
            </form>
        </div>
    </div>

@endsection

<style>
    .custom-login{
        height: 500px;
        padding-top: 100px;
    }
</style>