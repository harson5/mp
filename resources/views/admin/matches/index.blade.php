@extends('layouts.app')

@section('title', 'Manage Matches')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card border-0 rounded-4 shadow-sm">
    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">⚽ Manage Matches</h4>
            <p class="text-muted small mb-0">Create, edit, and manage match fixtures and results</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.matches.index') }}" class="btn btn-filter {{ !request('result_locked') && !request('today') ? 'active' : '' }}">All</a>
            <a href="{{ route('admin.matches.index', ['result_locked' => 1]) }}" class="btn btn-filter {{ request('result_locked') ? 'active' : '' }}">Played</a>
            <a href="{{ route('admin.matches.index', ['today' => 1]) }}" class="btn btn-filter {{ request('today') ? 'active' : '' }}">Today's</a>
            <a href="{{ route('admin.matches.create') }}" class="btn btn-add">
                <i class="bi bi-plus-lg me-1"></i> Add Match
            </a>
        </div>
    </div>

    @if ($matches->isEmpty())
    <div class="text-center py-5">
        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
            <i class="bi bi-calendar-x text-muted" style="font-size: 2.5rem;"></i>
        </div>
        <h5 class="text-muted fw-bold">No Matches Found</h5>
        <p class="text-muted small">Add your first match to get started.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table app-table table-striped" style="table-layout: unset;">
            <thead>
                <tr>
                    <th>Match #</th>
                    <th>Date & Time</th>
                    <th>Teams</th>
                    <th>Result</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                    <tr>
                        <td data-label="Match #">
                            <span class="user-id">#{{ $match->match_no }}</span>
                        </td>
                        <td data-label="Date & Time">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-muted"></i>
                                <div>
                                    <span class="fw-medium">{{ $match->match_datetime->format('M j, Y') }}</span>
                                    <span class="text-muted ms-2 small">{{ $match->match_datetime->format('H:i') }}</span>
                                </div>
                            </div>
                        </td>
                        <td data-label="Teams">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                @if ($match->flagUrl($match->opponent1_flag))
                                    <img src="{{ $match->flagUrl($match->opponent1_flag) }}" alt="" class="team-flag-sm">
                                @else
                                    <span class="flag-placeholder-sm">{{ strtoupper(substr($match->opponent1, 0, 1)) }}</span>
                                @endif
                                <span class="fw-semibold">{{ $match->opponent1 }}</span>
                                <span class="badge bg-light text-muted mx-1">VS</span>
                                @if ($match->flagUrl($match->opponent2_flag))
                                    <img src="{{ $match->flagUrl($match->opponent2_flag) }}" alt="" class="team-flag-sm">
                                @else
                                    <span class="flag-placeholder-sm">{{ strtoupper(substr($match->opponent2, 0, 1)) }}</span>
                                @endif
                                <span class="fw-semibold">{{ $match->opponent2 }}</span>
                            </div>
                        </td>
                        <td data-label="Result">
                            @if ($match->hasResults())
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-semibold">
                                    <i class="bi bi-trophy-fill me-1"></i>
                                    {{ $match->resultLabel() }}
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1 fw-semibold">
                                    <i class="bi bi-clock me-1"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td data-label="Actions">
                            @if (!$match->hasResults())
                            <a href="{{ route('admin.matches.edit', $match) }}" class="btn btn-sm btn-edit" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @else
                            <span class="badge bg-light rounded-pill px-3 py-1 text-success">
                                <i class="bi bi-check-circle me-1"></i> Done
                            </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection