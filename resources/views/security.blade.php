@extends('common')
@section('title', 'Security Settings')
@section('content')

<style>
    /* Use the same styling from profile.blade.php */
    .profile-sidebar {
        background: white;
        border-radius: 15px;
        padding: 20px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .profile-user-card {
        background: #4f46e5;
        border-radius: 15px;
        padding: 30px 20px;
        text-align: center;
        color: white;
        margin: 0 20px 20px 20px;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 50%;
        margin: 0 auto 15px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        font-size: 40px;
        font-weight: bold;
        position: relative;
    }
    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 15px 30px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
    }
    .sidebar-menu a:hover, .sidebar-menu a.active {
        background: #f8f9fa;
        color: #4f46e5;
        border-left: 4px solid #4f46e5;
    }
    .sidebar-menu i {
        margin-right: 15px;
        font-size: 1.2rem;
    }
    .sidebar-menu a.text-danger:hover {
        background: #fef2f2;
        color: #ef4444;
        border-left: 4px solid #ef4444;
    }
    .profile-content {
        background: white;
        border-radius: 15px;
        padding: 40px;
        min-height: 400px; /* Force minimum height to match visual length */
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);    
    }
    .form-control {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        padding: 12px 15px;
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
    }
    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .btn-gradient {
        background: linear-gradient(to right, #6366f1, #d946ef);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-gradient:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>

<div class="container mt-5 mb-5 pb-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="profile-sidebar">
                <div class="profile-user-card">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                    <p class="small mb-0 opacity-75">{{ Auth::user()->email }}</p>
                </div>
                
                <div class="sidebar-menu">
                    <a href="/profile">
                        <i class="bi bi-person-fill"></i> Edit Profile
                    </a>
                    <a href="/profile/security" class="active">
                        <i class="bi bi-shield-lock-fill"></i> Security
                    </a>
                    <a href="{{ route('logout') }}" class="text-danger mt-3" style="border-left-color: transparent;">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-8 col-lg-9">
            <div class="profile-content">
                <h4 class="fw-bold text-primary mb-4" style="color: #4f46e5 !important;">Change Password</h4>
                
                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 10px; background-color: #fef2f2; color: #ef4444;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('security_update') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <label class="form-label">CURRENT PASSWORD</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">NEW PASSWORD</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Create new password" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">CONFIRM NEW PASSWORD</label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm your new password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient mt-2">UPDATE PASSWORD</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
