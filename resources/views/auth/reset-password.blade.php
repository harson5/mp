@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="card" style="max-width:420px;margin:3rem auto;">
    <h1 style="margin-bottom:1rem;">Set New Password</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <label for="password">New Password</label>
        <input type="password" id="password" name="password" required autofocus>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit" style="margin-top: 1.5rem;">Reset Password</button>
    </form>

    <p class="muted" style="margin-top: 1rem;">
        <a href="{{ route('login') }}">Back to login</a>
    </p>
</div>
@endsection
