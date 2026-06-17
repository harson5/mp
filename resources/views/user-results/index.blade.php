@extends('layouts.app')

@section('title', 'My Results')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card">
    <h2 style="margin-top:0;">Your predicted results</h2>
    <p class="muted">All matches you have predicted, ordered by match date.</p>

    @if ($predictions->isEmpty())
        <p class="muted" style="margin-top:1rem;">You have not submitted any predictions yet. Go to the <a href="{{ route('matches.index') }}">Matches</a> tab to predict.</p>
    @else
    <div class="table-responsive">

        <table class="table app-table">
            <thead>
                <tr>
                    <th>Match #</th>
                    <th>Date & time</th>
                    <th>Match</th>
                    <th>Your winner</th>
                    <th>Your score</th>
                    <th>Actual result</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($predictions as $prediction)
                    @php
                        $match = $prediction->matchGame;
                    @endphp
                    <tr>
                        <td data-label="Match #">{{ $match->match_no }}</td>
                        <td data-label="Date">{{ $match->match_datetime->format('M j, Y H:i') }}</td>
                        <td data-label="Match">{{ $match->opponent1 }} vs {{ $match->opponent2 }}</td>
                        <td data-label="Your winner">{{ $prediction->winner }}</td>
                        <td data-label="Your score">{{ $prediction->opponent1_score }} – {{ $prediction->opponent2_score }}</td>
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
                                    <strong class="points-chip" >+{{ $prediction->points_earned }}</strong>
                                @else
                                    <span class="points-chip">0</span>
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
@endsection
