@extends('layouts.app')

@section('title', 'Manage Users')

@section('header')
@include('partials.app-header')
@endsection

@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;margin-bottom:1rem;">
        <div>
            <h2 style="margin:0;">Manage users</h2>
            <p class="muted" style="margin:0.35rem 0 0;">Toggle user payment status and manage user accounts.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn" style="text-decoration:none;">All</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'paid']) }}" class="btn" style="text-decoration:none;">Paid Users</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'verified']) }}" class="btn" style="text-decoration:none;">Verified</a>
            <!-- <a href="{{ route('admin.matches.create') }}" class="btn" style="display:inline-block;text-decoration:none;">+ Add match</a> -->
            <a href="{{ route('admin.users.create') }}" class="btn" style="display:inline-block;text-decoration:none;">+ Add user</a>
        </div>
    </div>

    @if ($users->isEmpty())
        <p class="muted">No users yet. Add your first user.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Transaction Code</th>
                    <th>Payment Status</th>
                    <th>Payment Proof</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="transaction-code">{{ $user->transaction_code ?: '-' }}</td>
                        <td class="d-flex align-items-center text-nowrap">
                            <span style="display:inline-block;padding:0.25rem 0.75rem;border-radius:0.25rem;font-size:0.9rem;font-weight:500;background-color:{{ $user->payment_status === 'verified' ? '#d4edda' : ($user->payment_status === 'paid' ? '#fff3cd' : '#f8d7da') }};color:{{ $user->payment_status === 'verified' ? '#155724' : ($user->payment_status === 'paid' ? '#856404' : '#721c24') }};">
                                {{ ucfirst($user->payment_status) }}
                            </span>
                            @if ($user->payment_status === 'paid')
                                <form method="POST" action="{{ route('admin.users.updateVerify', $user) }}" style="display:inline;margin-left:0.5rem;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn" style="font-size:0.85rem;padding:0.25rem 0.5rem;">Verify</button>
                                </form>
                            @elseif ($user->payment_status === 'unpaid')
                                <form method="POST" action="{{ route('admin.users.update', $user) }}" style="display:inline;margin-left:0.5rem;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="payment_status" value="paid">
                                    <button type="submit" class="btn" style="font-size:0.85rem;padding:0.25rem 0.5rem;">Paid</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($user->payment_proof)
                                <a href="{{ asset('storage/' . $user->payment_proof) }}" target="_blank" class="btn" style="font-size:0.85rem;padding:0.25rem 0.5rem;">View</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="d-flex align-items-center gap-1">

                            <a class="btn" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link-danger ms-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
