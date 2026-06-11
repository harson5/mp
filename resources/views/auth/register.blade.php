@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card" style="max-width:420px;margin:3rem auto;">
    <h1 style="margin-bottom:1rem;">Create account</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name') }}" required autofocus>
        
        <label for="email">Email</label>
        <input id="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <button type="submit">Register</button>
    </form>
    <p class="muted" style="margin-top:1rem;">
        Already have an account? <a href="{{ route('login') }}">Log in</a>
    </p>
</div>
@endsection
