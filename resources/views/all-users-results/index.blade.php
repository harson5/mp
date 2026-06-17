@extends('layouts.app')

@section('title', 'All Users Results')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card border-0 rounded-4 shadow-sm">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
            <h4 class="fw-bold mb-1">🏆 Leaderboard</h4>
            <p class="text-muted small mb-0">All users ranked by total points</p>
        </div>
        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
            <i class="bi bi-people-fill me-1"></i> {{ $users->count() }} Users
        </span>
    </div>

    @if ($users->isEmpty())
    <div class="text-center py-5">
        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
            <i class="bi bi-people text-muted" style="font-size: 2.5rem;"></i>
        </div>
        <h5 class="text-muted fw-bold">No Users Found</h5>
        <p class="text-muted small">Users will appear here once they join.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table app-table table-bordered table-striped">
            <!-- Define column widths -->
            <colgroup>
                <col style="width: 80px;"> <!-- Rank -->
                <col style="width: auto;"> <!-- User - takes remaining space -->
                <col style="width: 240px;"> <!-- Points -->
                <col style="width: 240px;"> <!-- Predictions -->
            </colgroup>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Points</th>
                    <th>Predictions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <!-- Rank -->
                    <td data-label="Rank">
                        <div class="rank-cell">
                            @if ($index == 0)
                            <span class="rank-medal gold">🥇</span>
                            @elseif ($index == 1)
                            <span class="rank-medal silver">🥈</span>
                            @elseif ($index == 2)
                            <span class="rank-medal bronze">🥉</span>
                            @else
                            <span class="rank-number">{{ $index + 1 }}</span>
                            @endif
                        </div>
                    </td>

                    <!-- User -->
                    <td class="user-td" data-label="User">
                        <div class="d-flex align-items-center gap-2 user-cell">
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span class="fw-bold text-dark">{{ $user->name }}</span>
                                        @if ($user->isAdmin())
                                        <span class="admin-chip">
                                            <i class="bi bi-shield-check me-1"></i>Admin
                                        </span>
                                        @endif
                                    </div>
                                    @if(isset($selectedUser) && $selectedUser->id === $user->id)
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mt-1">
                                        <i class="bi bi-check-circle me-1"></i>Selected
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- View Button -->
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 view-btn"
                                data-bs-toggle="modal" data-bs-target="#predictionsModal{{ $user->id }}">
                                <i class="bi bi-eye me-md-1"></i>
                                <span class="d-none d-md-inline">View</span>
                            </button>
                        </div>
                    </td>

                    <!-- Points -->
                    <td data-label="Points">
                        <span class="points-chip">
                            {{ $user->score }}
                        </span>
                    </td>

                    <!-- Predictions Count -->
                    <td data-label="Predictions">
                        <span class="predictions-count">
                            {{ $user->predictions->count() }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Prediction Modals -->
    @foreach ($users as $user)
    <div class="modal fade" id="predictionsModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-primary text-white rounded-top-4 border-0 px-4 py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-avatar">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-white">{{ $user->name }}'s <span
                                    class="fw-normal">Predictions</span></h5>
                            <div class="d-flex gap-3 mt-1">
                                <small class="text-white text-opacity-75">
                                    <i class="bi bi-star-fill me-1"></i>{{ $user->score }} pts
                                </small>
                                <small class="text-white text-opacity-75">
                                    <i class="bi bi-bar-chart-fill me-1"></i>{{ $user->predictions->count() }}
                                    predictions
                                </small>
                            </div>
                        </div>
                    </div>
                    <div type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    @if ($user->predictions->isEmpty())
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3" style="
                                    width: 80px;
                                    height: 80px;
                                    align-items: center;
                                ">
                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-muted fw-bold">No Predictions Yet</h6>
                        <p class="text-muted small">This user hasn't submitted any predictions.</p>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table modal-table table-bordered">
                            <thead>
                                <tr>
                                    <th>Match</th>
                                    <th>Date</th>
                                    <th>Teams</th>
                                    <th>Prediction</th>
                                    <th>Result</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->predictions as $prediction)
                                @php $match = $prediction->matchGame; @endphp
                                <tr>
                                    <td data-label="Match">
                                        <span class="match-badge">#{{ $match->match_no }}</span>
                                    </td>
                                    <td data-label="Date">
                                        <span class="date-text">{{ $match->match_datetime->format('M j, H:i') }}</span>
                                    </td>
                                    <td data-label="Teams">
                                        <div class="teams-container">
                                            <span class="team-name">{{ $match->opponent1 }}</span>
                                            <span class="vs-text">vs</span>
                                            <span class="team-name">{{ $match->opponent2 }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Prediction">
                                        <div class="prediction-container">
                                            <span class="prediction-winner">{{ $prediction->winner }}</span>
                                            <span
                                                class="prediction-score">({{ $prediction->opponent1_score }}–{{ $prediction->opponent2_score }})</span>
                                        </div>
                                    </td>
                                    <td data-label="Result">
                                        @if ($match->hasResults())
                                        <span class="status-badge status-completed">
                                            <i class="bi bi-check-circle me-1"></i>{{ $match->resultLabel() }}
                                        </span>
                                        @else
                                        <span class="status-badge status-pending">
                                            <i class="bi bi-clock me-1"></i>Pending
                                        </span>
                                        @endif
                                    </td>
                                    <td data-label="Points">
                                        @if ($match->hasResults())
                                        @if ($prediction->points_earned > 0)
                                        <span
                                            class="points-badge points-earned">+{{ $prediction->points_earned }}</span>
                                        @else
                                        <span class="points-badge points-zero">0</span>
                                        @endif
                                        @else
                                        <span class="points-badge points-na">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 px-4 py-2 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>

@endsection