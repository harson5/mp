@extends('layouts.app')

@section('title', $user->exists ? 'Edit User' : 'Add User')

@section('header')
@endsection

@section('content')
<div class="card">
    <h2 style="margin-top:0;">{{ $user->exists ? 'Edit user' : 'Add user' }}</h2>
    <p class="muted"><a href="{{ route('admin.users.index') }}">← Back to manage users</a></p>

    <form method="POST"
          action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}"
          style="margin-top:1rem;">
        @csrf
        @if ($user->exists)
            @method('PUT')
        @endif

        <div class="grid-2">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="grid-2">
            <div>
                <label for="password">{{ $user->exists ? 'Password (leave blank to keep current)' : 'Password' }}</label>
                <input type="password" id="password" name="password" {{ $user->exists ? '' : 'required' }}>
            </div>
            <div>
                <label for="payment_status">Payment Status</label>
                <select id="payment_status" name="payment_status" required>
                    <option value="unpaid" {{ old('payment_status', $user->payment_status ?? 'unpaid') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ old('payment_status', $user->payment_status ?? 'unpaid') === 'paid' ? 'selected' : '' }}>Paid (Pending Verification)</option>
                    <option value="verified" {{ old('payment_status', $user->payment_status ?? 'unpaid') === 'verified' ? 'selected' : '' }}>Verified</option>
                </select>
            </div>
        </div>

        <button type="submit">{{ $user->exists ? 'Update user' : 'Create user' }}</button>
    </form>
</div>
@endsection
