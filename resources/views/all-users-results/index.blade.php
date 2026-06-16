@extends('layouts.app')

@section('title', 'All Users Results')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Leaderboard</h2>
    <p class="muted">All users ranked by total points.</p>

    @if ($users->isEmpty())
        <p class="muted" style="margin-top:1rem;">No users found.</p>
    @else
    <div class="table-responsive" style="margin-top:1rem;">
    <table class="table table-striped table-bordered responsive-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Total points</th>
                <th>Predictions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr class="parent-row">
                    <td data-label="Rank">{{ $index + 1 }}</td>
                    <td data-label="User">
                        <a href="{{ route('all-users-results.index', ['user' => $user->id]) }}" class="user-toggle" data-user-id="{{ $user->id }}" style="text-decoration:none;color:inherit;display:block;">
                            {{ $user->name }}
                        </a>
                        @if ($user->isAdmin())
                            <span class="admin-badge">Admin</span>
                        @endif
                        @if (isset($selectedUser) && $selectedUser->id === $user->id)
                            <span class="badge bg-secondary">Selected</span>
                        @endif
                    </td>
                    <td data-label="Total points"><strong class="points-positive">{{ $user->score }}</strong></td>
                    <td data-label="Predictions">{{ $user->predictions->count() }}</td>
                </tr>
                <tr class="nested-row" data-user-id="{{ $user->id }}" @if(isset($selectedUser) && $selectedUser->id === $user->id) style="display:table-row;" @else style="display:none;" @endif>
                    <td colspan="4" style="padding:0;border-top:none;">
                        <div class="nested-content">
                            @if ($user->predictions->isEmpty())
                                <p class="muted" style="margin:0;">No predictions submitted by this user.</p>
                            @else
                                <h3 class="mb-2" style="margin-top:0;">{{ $user->name }}'s Predictions</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered nested-table">
                                        <thead>
                                            <tr>
                                                <th>Match #</th>
                                                <th>Date</th>
                                                <th>Match</th>
                                                <th>Predicted winner</th>
                                                <th>Predicted score</th>
                                                <th>Actual result</th>
                                                <th>Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->predictions as $prediction)
                                                @php $match = $prediction->matchGame; @endphp
                                                <tr>
                                                    <td data-label="Match #">{{ $match->match_no }}</td>
                                                    <td data-label="Date">{{ $match->match_datetime->format('M j, Y H:i') }}</td>
                                                    <td data-label="Match">{{ $match->opponent1 }} vs {{ $match->opponent2 }}</td>
                                                    <td data-label="Predicted winner">{{ $prediction->winner }}</td>
                                                    <td data-label="Predicted score">{{ $prediction->opponent1_score }} – {{ $prediction->opponent2_score }}</td>
                                                    <td data-label="Actual result">
                                                        @if ($match->hasResults())
                                                            {{ $match->resultLabel() }}
                                                        @else
                                                            <span class="muted">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td data-label="Points">
                                                        @if ($match->hasResults())
                                                            @if ($prediction->points_earned > 0)
                                                                <strong class="points-positive">+{{ $prediction->points_earned }}</strong>
                                                            @else
                                                                <span class="muted">0</span>
                                                            @endif
                                                        @else
                                                            <span class="muted">—</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
/* Responsive styles */
@media (max-width: 768px) {
    /* Convert main table to block/card layout */
    .responsive-table,
    .responsive-table tbody,
    .responsive-table tr,
    .responsive-table td,
    .responsive-table th {
        display: block;
    }
    
    .responsive-table thead {
        display: none;
    }
    
    .responsive-table tr {
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    
    .responsive-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #dee2e6;
        text-align: right;
    }
    
    .responsive-table td:last-child {
        border-bottom: none;
    }
    
    .responsive-table td:before {
        content: attr(data-label);
        font-weight: bold;
        text-align: left;
        margin-right: 1rem;
        flex: 1;
    }
    
    /* Nested table styles */
    .nested-content {
        padding: 1rem;
        background: #f9fafb;
        border-top: 1px solid #dee2e6;
    }
    
    .nested-table,
    .nested-table tbody,
    .nested-table tr,
    .nested-table td,
    .nested-table th {
        display: block;
    }
    
    .nested-table thead {
        display: none;
    }
    
    .nested-table tr {
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 4px;
    }
    
    .nested-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border: none;
        border-bottom: 1px solid #dee2e6;
        text-align: right;
    }
    
    .nested-table td:last-child {
        border-bottom: none;
    }
    
    .nested-table td:before {
        content: attr(data-label);
        font-weight: bold;
        text-align: left;
        margin-right: 1rem;
        flex: 1;
    }
    
    /* Typography adjustments */
    h3 {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }
    
    .admin-badge,
    .badge {
        display: inline-block;
        margin-left: 0.5rem;
        font-size: 0.75rem;
    }
}

/* Desktop styles remain the same */
@media (min-width: 769px) {
    .nested-content {
        padding: 1rem;
        background: #f9fafb;
        border-top: 1px solid #dee2e6;
    }
    
    .nested-table {
        margin: 0;
        width: 100%;
    }
}

/* Additional small screen optimizations */
@media (max-width: 480px) {
    .responsive-table td {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .responsive-table td:before {
        margin-bottom: 0.5rem;
        margin-right: 0;
    }
    
    .nested-table td {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .nested-table td:before {
        margin-bottom: 0.5rem;
        margin-right: 0;
    }
}
</style>
    @endif
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.user-toggle').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const id = this.dataset.userId;
                const nested = document.querySelector('.nested-row[data-user-id="' + id + '"]');

                if (! nested) {
                    window.location = this.href;
                    return;
                }

                const open = nested.style.display === 'table-row';
                document.querySelectorAll('.nested-row').forEach(function (row) {
                    row.style.display = 'none';
                });

                if (! open) {
                    nested.style.display = 'table-row';
                }
            });
        });
    });
</script>
@endpush
@endsection
