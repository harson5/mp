@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="card" style="max-width:420px;margin:3rem auto;">
    <h1 style="margin-bottom:1rem;">Reset Password</h1>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
  @if (!session('status'))
    <p style="margin-bottom: 1.5rem; color: #666;">
        Enter your email address and we'll send you a link to reset your password.
    </p>
   

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

        <button type="submit" style="margin-top: 1.5rem;">Send Reset Link</button>
    </form>
    @endif

    <p class="muted" style="margin-top: 1rem;">
        <a href="{{ route('login') }}">Back to login</a>
    </p>
</div>
@endsection
