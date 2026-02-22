@extends('common')
@section('title', 'My Profile')
@section('content')

<style>
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
    .camera-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        height: 30px;
        width: 30px;
        background: white;
        color: #4f46e5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        cursor: pointer;
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
        font-size: 0.8srem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .input-grp-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
        color: #9ca3af;
    }
    .input-with-icon {
        padding-left: 45px !important;
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
                    <a href="/profile" class="active">
                        <i class="bi bi-person-fill"></i> Edit Profile
                    </a>
                    <a href="/profile/security">
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
                <h4 class="fw-bold text-primary mb-4" style="color: #4f46e5 !important;">Personal Details</h4>
                
                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('profile_update') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label" style="font-size: 13px;">NAME</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label" style="font-size: 13px;">EMAIL ADDRESS</label>
                            <div class="position-relative">
                                <i class="bi bi-envelope input-grp-icon"></i>
                                <input type="email" class="form-control input-with-icon" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 13px;">PHONE NUMBER</label>
                            <div class="position-relative">
                                <i class="bi bi-telephone input-grp-icon"></i>
                                <input type="text" class="form-control input-with-icon" value="{{ Auth::user()->number }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label" style="font-size: 13px;">GENDER</label>
                            <select name="gender" class="form-select" style="background: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 15px; border-radius: 8px;" required>
                                <option value="Male" {{ Auth::user()->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ Auth::user()->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ Auth::user()->Gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient mt-2">SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
