@extends('common')
@section('content')
@section('hide_footer', true)

    <div class="container custom-login">
        <div class="glass-card" style="background-color: #667eea;">
            <h2>Set New Password</h2>

            @if(session('error'))
                <div class="alert alert-danger">
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

            <form method="post" action="{{ route('Password.update-password') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter new password">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
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