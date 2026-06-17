@extends('layouts.app')

@section('title', 'Manage Users')

@section('header')
@include('partials.app-header')
@endsection

@section('content')
<div class="card">
    <div
        style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;margin-bottom:1rem;">
        <div>
            <h2 style="margin:0;">Manage users</h2>
            <p class="muted" style="margin:0.35rem 0 0;">Toggle user payment status and manage user accounts.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn" style="text-decoration:none;">All</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'unpaid']) }}" class="btn"
                style="text-decoration:none;">Unpaid Users</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'paid']) }}" class="btn"
                style="text-decoration:none;">Paid Users</a>
            <a href="{{ route('admin.users.index', ['payment_status' => 'verified']) }}" class="btn"
                style="text-decoration:none;">Verified</a>
            <!-- <a href="{{ route('admin.matches.create') }}" class="btn" style="display:inline-block;text-decoration:none;">+ Add match</a> -->
            <a href="{{ route('admin.users.create') }}" class="btn" style="display:inline-block;text-decoration:none;">+
                Add user</a>
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
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
                            @if ($user->payment_status != 'verified')
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link-danger ms-0">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <style>
  /* ==========================
   TABLE WRAPPER
========================== */

.users-table-wrapper {
    width: 100%;
}
.transaction-code .status-wrapper{
    max-width: 150px;         
  white-space: nowrap; 
  overflow: hidden;       
  text-overflow: ellipsis; 
  margin-left: auto;
  display: inline-block;
}

/* ==========================
   STATUS BADGES
========================== */

.payment-badge {
    display: inline-block;
    padding: .35rem .8rem;
    border-radius: 999px;
    font-size: .85rem;
    font-weight: 600;
}

.payment-verified {
    background: #d4edda;
    color: #155724;
}

.payment-paid {
    background: #fff3cd;
    color: #856404;
}

.payment-unpaid {
    background: #f8d7da;
    color: #721c24;
}

/* ==========================
   DESKTOP
========================== */

.status-wrapper {
    display: flex;
    align-items: center;
    gap: .5rem;
    flex-wrap: wrap;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: .5rem;
}

/* ==========================
   TABLET
   Horizontal Scroll
========================== */

@media (max-width: 991px) and (min-width: 768px) {

    .users-table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .users-table {
        min-width: 950px;
    }
}

/* ==========================
   MOBILE
   Card Layout
========================== */

@media (max-width: 767px) {

    .users-table,
    .users-table tbody,
    .users-table tr,
    .users-table td {
        display: block;
        width: 100%;
    }

    .users-table thead {
        display: none;
    }

    .users-table {
        border: none;
    }

    .users-table tr {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        margin-bottom: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
    }

    .users-table td {
        position: relative;
        padding: 12px 12px 12px 42%;
        border: none !important;
        border-bottom: 1px solid #eee !important;
        text-align: right;
        min-height: 48px;
        word-break: break-word;
    }

    .users-table td:last-child {
        border-bottom: none !important;
    }

    .users-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 12px;
        top: 12px;
        width: 35%;
        font-weight: 600;
        color: #495057;
        text-align: left;
    }

    .status-wrapper {
        display: flex;
        justify-content: flex-end;
        gap: .5rem;
        flex-wrap: wrap;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: .5rem;
        flex-wrap: wrap;
    }

    .users-table form {
        margin: 0;
    }

    .users-table .btn {
        font-size: .85rem;
    }
}
    </style>
   <div class="users-table-wrapper">

    <table class="table table-striped table-bordered users-table">

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

                <td data-label="ID">
                    {{ $user->id }}
                </td>

                <td data-label="Name">
                    {{ $user->name }}
                </td>

                <td data-label="Email">
                    {{ $user->email }}
                </td>

                <td class="transaction-code" data-label="Transaction Code">
                    <div class="status-wrapper">{{ $user->transaction_code ?: '-' }}</div>
                </td>

                <td data-label="Payment Status">

                    <div class="status-wrapper">

                        <span class="payment-badge payment-{{ $user->payment_status }}">
                            {{ ucfirst($user->payment_status) }}
                        </span>

                        @if ($user->payment_status === 'paid')

                        <form method="POST"
                            action="{{ route('admin.users.updateVerify', $user) }}">

                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn btn-sm">
                                Verify
                            </button>

                        </form>

                        @elseif ($user->payment_status === 'unpaid')

                        <form method="POST"
                            action="{{ route('admin.users.update', $user) }}">

                            @csrf
                            @method('PUT')

                            <input type="hidden"
                                name="payment_status"
                                value="paid">

                            <button type="submit" class="btn btn-sm">
                                Paid
                            </button>

                        </form>

                        @endif

                    </div>

                </td>

                <td data-label="Payment Proof">

                    @if ($user->payment_proof)

                    <a href="{{ asset('storage/' . $user->payment_proof) }}"
                        target="_blank"
                        class="btn btn-sm">
                        View
                    </a>

                    @else
                    -
                    @endif

                </td>

                <td data-label="Actions">

                    <div class="action-buttons">

                        <a class="btn btn-sm"
                            href="{{ route('admin.users.edit', $user) }}">
                            Edit
                        </a>

                        <form method="POST"
                            action="{{ route('admin.users.destroy', $user) }}"
                            onsubmit="return confirm('Delete this user?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-link-danger">
                                Delete
                            </button>

                        </form>

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