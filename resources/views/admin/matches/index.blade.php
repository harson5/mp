@extends('layouts.app')

@section('title', 'Manage Matches')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;margin-bottom:1rem;">
        <div>
            <h2 style="margin:0;">Manage Matches</h2>
            <p class="muted" style="margin:0.35rem 0 0;">Create, edit, and delete matches. Upload team flags and enter final results.</p>
        </div>
        <div style="display:flex;gap:0.5rem;align-items:center;">
            <a href="{{ route('admin.matches.index') }}" class="btn" style="text-decoration:none;">All</a>
            <a href="{{ route('admin.matches.index', ['result_locked' => 1]) }}" class="btn" style="text-decoration:none;">Played Match</a>
            <a href="{{ route('admin.matches.index', ['today' => 1]) }}" class="btn" style="text-decoration:none;">Today's</a>
            <a href="{{ route('admin.matches.create') }}" class="btn" style="display:inline-block;text-decoration:none;">+ Add match</a>
        </div>
    </div>

    @if ($matches->isEmpty())
        <p class="muted">No matches yet. Add your first match.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Teams</th>
                    <th>Result</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                    <tr>
                        <td>{{ $match->match_no }}</td>
                        <td>{{ $match->match_datetime->format('M j, Y H:i') }}</td>
                        <td>
                            <div class="team-inline">
                                @if ($match->flagUrl($match->opponent1_flag))
                                    <img src="{{ $match->flagUrl($match->opponent1_flag) }}" alt="" class="team-flag-sm">
                                @endif
                                {{ $match->opponent1 }}
                                <span class="muted">vs</span>
                                @if ($match->flagUrl($match->opponent2_flag))
                                    <img src="{{ $match->flagUrl($match->opponent2_flag) }}" alt="" class="team-flag-sm">
                                @endif
                                {{ $match->opponent2 }}
                            </div>
                        </td>
                        <td>
                            @if ($match->hasResults())
                                {{ $match->resultLabel() }}
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.matches.edit', $match) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.matches.destroy', $match) }}" style="display:inline;" onsubmit="return confirm('Delete this match?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
