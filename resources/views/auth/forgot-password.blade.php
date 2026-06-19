@extends('layouts.app')

@section('title', 'Forgot Password')

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
                <h1 class="fw-bold mb-0 login-heading">RESET PASSWORD</h1>
                
                <!-- Subtitle -->
                <p class="text-muted mb-4 login-subtitle">Enter your email to receive a reset link</p>
                
                @if (session('status'))
                    <div class="alert alert-success rounded-3">
                        <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (!session('status'))
                <form method="POST" action="{{ route('password.email') }}" class="text-start">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               class="form-control input-modern rounded-pill @error('email') is-invalid @enderror" 
                               placeholder="Enter your email"
                               required 
                               autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-login w-100 py-2 fw-bold text-white border-0 rounded-pill">
                        SEND RESET LINK
                    </button>
                </form>
                @endif
                
                <p class="text-center text-muted mb-0 mt-4 pt-3 border-top small">
                    <a href="{{ route('login') }}" class="fw-semibold text-decoration-none register-link">
                        <i class="bi bi-arrow-left me-1"></i>Back to login
                    </a>
                </p>
                
            </div>
        </div>
        
        <div class="text-center mt-3">
            <span class="small text-muted">
                <i class="bi bi-shield-lock me-1"></i>Secure Password Reset
            </span>
        </div>
        
    </div>
</div>
@endsection