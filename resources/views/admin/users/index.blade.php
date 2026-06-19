@extends('layouts.app')

@section('title', 'Manage Users')

@section('header')
@include('partials.app-header')
@endsection

@section('content')
<div class="card border-0 rounded-4 shadow-sm">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">👥 Manage Users</h4>
            <p class="text-muted mb-0">Toggle payment status and manage user accounts</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.users.index') }}"
                class="btn btn-filter {{ !request('payment_status') ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'unpaid']) }}"
                class="btn btn-filter {{ request('payment_status') == 'unpaid' ? 'active' : '' }}">Unpaid</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'paid']) }}"
                class="btn btn-filter {{ request('payment_status') == 'paid' ? 'active' : '' }}">Paid</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'verified']) }}"
                class="btn btn-filter {{ request('payment_status') == 'verified' ? 'active' : '' }}">Verified</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-add">
                <i class="bi bi-plus-lg me-1"></i> Add User
            </a>
        </div>
    </div>

    @if ($users->isEmpty())
    <div class="text-center py-5">
        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
            <i class="bi bi-people text-muted" style="font-size: 2.5rem;"></i>
        </div>
        <h5 class="text-muted fw-bold">No Users Found</h5>
        <p class="text-muted">Add your first user to get started.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table app-table table-striped" style="table-layout: unset;">
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
                    <td data-label="#">
                        <span class="user-id">#{{ $user->id }}</span>
                    </td>
                    <td data-label="Name">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-semibold">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td data-label="Email">
                        <span class="text-muted">{{ $user->email }}</span>
                    </td>
                    <td data-label="Transaction Code">
                        <span class="transaction-code">{{ $user->transaction_code ?: '—' }}</span>
                    </td>
                    <td data-label="Payment Status">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge-payment 
                                @if($user->payment_status === 'verified') badge-verified
                                @elseif($user->payment_status === 'paid') badge-paid
                                @else badge-unpaid
                                @endif
                            ">
                                @if($user->payment_status === 'verified')
                                Verified
                                @elseif($user->payment_status === 'paid')
                                Paid
                                @else
                                Unpaid
                                @endif
                            </span>

                            @if ($user->payment_status === 'paid')
                            <form method="POST" action="{{ route('admin.users.updateVerify', $user) }}"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-verify text-nowrap" title="Verify payment">
                                    <span class="btn-text">Verify</span>
                                </button>
                            </form>
                            @elseif ($user->payment_status === 'unpaid')
                            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="payment_status" value="paid">
                                <button type="submit" class="btn btn-sm btn-mark-paid text-nowrap" title="Mark as paid">
                                    <span class="btn-text">Mark Paid</span>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td class="payment-proof" data-label="Payment Proof" >
                        @if ($user->payment_proof)
                        <a href="{{ asset('storage/' . $user->payment_proof) }}" target="_blank"
                            class="btn btn-sm btn-view" title="View proof">
                            <i class="bi bi-eye"></i>
                            <span class="btn-text">View</span>
                        </a>
                        @else
                        <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td data-label="Actions">
                        <div class="d-flex align-items-center gap-1">
                            <a class="btn btn-sm btn-edit" href="{{ route('admin.users.edit', $user) }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @if ($user->payment_status != 'verified')
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline"
                                onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection