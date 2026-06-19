@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
        
        <div class="card border-0 rounded-4 shadow-sm login-card p-2 p-sm-3">
            
            <div class="card-body p-2 text-center">
                
                <!-- Logo -->
                <div class="mb-3">
                    <img src="{{ asset('fifa-logo.png') }}" alt="FIFA" class="login-logo">
                </div>
                
                <!-- Heading -->
                <h1 class="fw-bold mb-0 login-heading">SET NEW PASSWORD</h1>
                
                <!-- Subtitle -->
                <p class="text-muted mb-4 login-subtitle">Choose a strong password for your account</p>
                
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 text-start">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.update') }}" class="text-start">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold text-secondary">New Password</label>
                        <div class="password-wrapper">
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   class="form-control input-modern rounded-pill @error('password') is-invalid @enderror" 
                                   placeholder="Enter new password"
                                   required 
                                   autofocus>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)" tabindex="-1" title="Show password">
                                <i class="bi bi-eye-slash" style="font-size: 1.1rem;"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label small fw-semibold text-secondary">Confirm Password</label>
                        <div class="password-wrapper">
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   class="form-control input-modern rounded-pill" 
                                   placeholder="Confirm new password"
                                   required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" tabindex="-1" title="Show password">
                                <i class="bi bi-eye-slash" style="font-size: 1.1rem;"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <button type="submit" class="btn btn-login w-100 py-2 fw-bold text-white border-0 rounded-pill">
                        RESET PASSWORD
                    </button>
                </form>
                
                <!-- Back to Login -->
                <p class="text-center text-muted mb-0 mt-4 pt-3 border-top small">
                    <a href="{{ route('login') }}" class="fw-semibold text-decoration-none register-link">
                        <i class="bi bi-arrow-left me-1"></i>Back to login
                    </a>
                </p>
                
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-3">
            <span class="small text-muted">
                <i class="bi bi-shield-check me-1"></i>Secure Password Reset
            </span>
        </div>
        
    </div>
</div>

@endsection