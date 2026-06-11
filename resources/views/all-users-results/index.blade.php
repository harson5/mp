@extends('layouts.app')

@section('title', 'All Users Results')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Leaderboard</h2>
    <p class="muted">All users ranked by total points.</p>
    {{$selectedUser}}

    @if ($users->isEmpty())
        <p class="muted" style="margin-top:1rem;">No users found.</p>
    @else
    <table class="table table-striped table-bordered" style="margin-top:1rem;">
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
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('all-users-results.index', ['user' => $user->id]) }}" class="user-toggle" data-user-id="{{ $user->id }}" style="text-decoration:none;color:inherit;display:block;">
                                {{ $user->name }}
                   
                            @if ($user->isAdmin())
                                <span class="admin-badge">Admin</span>
                            @endif
                            @if (isset($selectedUser) && $selectedUser->id === $user->id)
                                <span class="badge bg-secondary">Selected</span>
                            @endif
                            </a>
                        </td>
                        <td><strong class="points-positive">{{ $user->score }}</strong></td>
                        <td>{{ $user->predictions->count() }}</td>
                    </tr>
                    <tr class="nested-row" data-user-id="{{ $user->id }}" @if(isset($selectedUser) && $selectedUser->id === $user->id) style="display:table-row;" @else style="display:none;" @endif>
                        <td colspan="4" style="padding:0;border-top:none;">
                            <div style="padding:1rem;background:#f9fafb;border-top:1px solid #dee2e6;">
                                @if ($user->predictions->isEmpty())
                                    <p class="muted" style="margin:0;">No predictions submitted by this user.</p>
                                @else
                                 
                                   <h3 class="mb-2" style="margin-top:0;"> {{ $user->name }}'s Prediction</h3>
                                    <table class="table table-striped table-bordered" style="margin:0;">
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
                                                    <td>{{ $match->match_no }}</td>
                                                    <td>{{ $match->match_datetime->format('M j, Y H:i') }}</td>
                                                    <td>{{ $match->opponent1 }} vs {{ $match->opponent2 }}</td>
                                                    <td>{{ $prediction->winner }}</td>
                                                    <td>{{ $prediction->opponent1_score }} – {{ $prediction->opponent2_score }}</td>
                                                    <td>
                                                        @if ($match->hasResults())
                                                            {{ $match->resultLabel() }}
                                                        @else
                                                            <span class="muted">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
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
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
