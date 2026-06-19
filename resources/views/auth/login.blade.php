@extends('layouts.app')

@section('title', 'Login')

@section('content')


<!-- Loading Screen -->
<div id="loading-screen">
    <div class="loader-logo-wrap" id="loader-logo-wrap">
        <img src="{{ asset('fifa-logo.png') }}" alt="FIFA" class="loader-logo-img">
    </div>
    <div class="loader-dots" id="loader-dots">
        LOADING<span>.</span><span>.</span><span>.</span>
    </div>
</div>

<!-- Page Content -->
<div id="page-content" class="page-content">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5">
            
            <!-- Login Card -->
            <div class="card border-0 rounded-4 shadow-sm login-card visible p-2 p-sm-3">
                
                <div class="card-body p-2 text-center">
                    
                    <!-- Logo -->
                    <div class="mb-3">
                        <img src="{{ asset('fifa-logo.png') }}" alt="FIFA" class="login-logo">
                    </div>
                    
                    <!-- Heading -->
                    <h1 class="fw-bold mb-0 reveal reveal-delay-2 login-heading">
                        WELCOME BACK
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-muted mb-4 reveal reveal-delay-2 login-subtitle">
                        Sign in to your account
                    </p>
                    
                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" class="text-start reveal reveal-delay-3">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label small fw-semibold text-secondary">Name</label>
                            <input id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   class="form-control input-modern rounded-pill @error('name') is-invalid @enderror" 
                                   placeholder="Enter your name"
                                   tabindex="-1"
                                   required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                            <div class="password-wrapper">
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       class="form-control input-modern rounded-pill @error('password') is-invalid @enderror" 
                                       placeholder="Enter your password"
                                       tabindex="-1"
                                       required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password', this)" tabindex="-1" title="Show password">
                                <i class="bi bi-eye-slash" style="font-size: 1.1rem;"></i>
                            </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Remember + Forgot -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="d-flex align-items-center gap-2 remember-label">
                                <input type="checkbox" name="remember" class="form-check-input remember-checkbox">
                                <span class="small text-muted">Remember me</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-decoration-none fw-medium forgot-link">
                                    Forgot?
                                </a>
                            @endif
                        </div>
                        
                        <!-- Submit -->
                        <button type="submit" class="btn btn-login w-100 py-2 fw-bold text-white border-0 rounded-pill">
                            SIGN IN
                        </button>
                    </form>
                    
                    <!-- Register -->
                    <p class="text-center text-muted mb-0 mt-4 pt-3 border-top small reveal reveal-delay-4">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="fw-semibold text-decoration-none register-link">
                            Create one
                        </a>
                    </p>
                    
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-3 reveal reveal-delay-5">
                <span class="small text-muted">
                    <i class="bi bi-shield-lock me-1"></i>Secure Login
                </span>
            </div>
            
        </div>
    </div>
</div>

<script>
   window.addEventListener('load', function() {
    const loadingScreen = document.getElementById('loading-screen');
    const loaderLogoWrap = document.getElementById('loader-logo-wrap');
    const loaderDots = document.getElementById('loader-dots');
    const pageContent = document.getElementById('page-content');
    const reveals = document.querySelectorAll('.reveal');
    const nameInput = document.getElementById('name');
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    
    const hasErrors = document.querySelector('.alert-danger') || document.querySelector('.is-invalid');
    
    if (hasErrors) {
        loadingScreen.classList.add('hidden');
        pageContent.classList.add('visible');
        reveals.forEach(function(el) {
            el.classList.add('visible');
        });
        if (nameInput) nameInput.removeAttribute('tabindex');
        if (passwordInput) passwordInput.removeAttribute('tabindex');
        if (passwordToggle) passwordToggle.removeAttribute('tabindex');
        if (nameInput) nameInput.focus();
    } else {
        // Detect target logo position
        const targetLogo = document.querySelector('.login-logo');
        const loaderLogoImg = document.querySelector('.loader-logo-img');
        
        if (targetLogo && loaderLogoImg) {
            const targetRect = targetLogo.getBoundingClientRect();
            const loaderRect = loaderLogoImg.getBoundingClientRect();
            
            const translateY = targetRect.top + (targetRect.height / 2) - loaderRect.top - (loaderRect.height / 2);
            const scaleX = targetRect.width / loaderRect.width;
            const scaleY = targetRect.height / loaderRect.height;
            const scale = Math.min(scaleX, scaleY);
            
            // Set transform directly
            const flyUpTransform = `translateY(${translateY}px) scale(${scale})`;
            loaderLogoWrap.dataset.flyTransform = flyUpTransform;
        }
        
        setTimeout(function() {
            if (loaderLogoWrap.dataset.flyTransform) {
                loaderLogoWrap.style.transform = loaderLogoWrap.dataset.flyTransform;
            }
            loaderDots.classList.add('fade-out');
        }, 600);
        
        setTimeout(function() {
            loadingScreen.classList.add('hidden');
        }, 1000);
        
        setTimeout(function() {
            pageContent.classList.add('visible');
        }, 1100);
        
        setTimeout(function() {
            reveals.forEach(function(el, index) {
                setTimeout(function() {
                    el.classList.add('visible');
                }, index * 80);
            });
        }, 1200);
        
        setTimeout(function() {
            if (nameInput) nameInput.removeAttribute('tabindex');
            if (passwordInput) passwordInput.removeAttribute('tabindex');
            if (passwordToggle) passwordToggle.removeAttribute('tabindex');
            if (nameInput) nameInput.focus();
        }, 1800);
    }
});

</script>
@endsection