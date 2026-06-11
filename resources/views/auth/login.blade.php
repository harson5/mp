@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width:420px;margin:3rem auto;">
    <h1 style="margin-bottom:1rem;">Log in</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ old('name') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem;">
            <input type="checkbox" name="remember" style="width:auto;margin:0;">
            Remember me
        </label>

        <button type="submit">Log in</button>
    </form>
    <p class="muted" style="margin-top:1rem;">
        New here? <a href="{{ route('register') }}">Register</a>
    </p>
</div>
@endsection
