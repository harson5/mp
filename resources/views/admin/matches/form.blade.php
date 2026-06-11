@extends('layouts.app')

@section('title', $match->exists ? 'Edit Match' : 'Add Match')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="card">
    <h2 style="margin-top:0;">{{ $match->exists ? 'Edit match' : 'Add match' }}</h2>
    <p class="muted"><a href="{{ route('admin.matches.index') }}">← Back to manage matches</a></p>

    <form method="POST"
          action="{{ $match->exists ? route('admin.matches.update', $match) : route('admin.matches.store') }}"
          enctype="multipart/form-data"
          style="margin-top:1rem;">
        @csrf
        @if ($match->exists)
            @method('PUT')
        @endif

        <div class="grid-2">
            <div>
                <label for="match_no">Match number</label>
                <input type="number" id="match_no" name="match_no" min="1" value="{{ old('match_no', $match->match_no) }}" required>
            </div>
            <div>
                <label for="match_datetime">Match date & time</label>
                <input type="datetime-local" id="match_datetime" name="match_datetime"
                       value="{{ old('match_datetime', $match->match_datetime?->format('Y-m-d\TH:i')) }}" required>
            </div>
        </div>

        <div class="grid-2">
            <div>
                <label for="opponent1">Team 1 name</label>
                <input type="text" id="opponent1" name="opponent1" value="{{ old('opponent1', $match->opponent1) }}" required>
                <label for="opponent1_flag" style="margin-top:0.75rem;">Team 1 flag (image)</label>
                @if ($match->opponent1_flag)
                    <div class="flag-preview">
                        <img src="{{ $match->flagUrl($match->opponent1_flag) }}" alt="Team 1 flag" class="team-flag">
                    </div>
                @endif
                <input type="file" id="opponent1_flag" name="opponent1_flag" accept="image/*">
            </div>
            <div>
                <label for="opponent2">Team 2 name</label>
                <input type="text" id="opponent2" name="opponent2" value="{{ old('opponent2', $match->opponent2) }}" required>
                <label for="opponent2_flag" style="margin-top:0.75rem;">Team 2 flag (image)</label>
                @if ($match->opponent2_flag)
                    <div class="flag-preview">
                        <img src="{{ $match->flagUrl($match->opponent2_flag) }}" alt="Team 2 flag" class="team-flag">
                    </div>
                @endif
                <input type="file" id="opponent2_flag" name="opponent2_flag" accept="image/*">
            </div>
        </div>

        <hr class="divider">

        <h3 style="margin:0 0 0.5rem;">Match result (optional)</h3>
        <p class="muted" style="margin:0 0 1rem;">Enter final scores only. The winner is set automatically (higher score wins; equal scores = Draw).</p>

        <div class="grid-2">
            <div>
                <label for="opponent1_score"><span id="team1-label">{{ old('opponent1', $match->opponent1) ?: 'Team 1' }}</span> final score</label>
                <input type="number" id="opponent1_score" name="opponent1_score" min="0" max="99"
                       value="{{ old('opponent1_score', $match->opponent1_score) }}">
            </div>
            <div>
                <label for="opponent2_score"><span id="team2-label">{{ old('opponent2', $match->opponent2) ?: 'Team 2' }}</span> final score</label>
                <input type="number" id="opponent2_score" name="opponent2_score" min="0" max="99"
                       value="{{ old('opponent2_score', $match->opponent2_score) }}">
            </div>
        </div>
        <p class="muted" id="winner-preview" style="margin:0.75rem 0 0;"></p>
        <input type="hidden" name="winner" id="winner" value="">

        <label style="display:flex;align-items:center;gap:0.5rem;margin:1rem 0;">
            <input type="checkbox" name="results_locked" value="1" style="width:auto;margin:0;" @checked(old('results_locked', $match->results_locked))>
            Lock results (close predictions)
        </label>

        <button type="submit">{{ $match->exists ? 'Update match' : 'Create match' }}</button>
    </form>
</div>

<script>
(function () {
    const o1 = document.getElementById('opponent1');
    const o2 = document.getElementById('opponent2');
    const s1 = document.getElementById('opponent1_score');
    const s2 = document.getElementById('opponent2_score');
    const preview = document.getElementById('winner-preview');
    const winnerInput = document.getElementById('winner');
    const team1Label = document.getElementById('team1-label');
    const team2Label = document.getElementById('team2-label');

    function updatePreview() {
        if (team1Label && o1) team1Label.textContent = o1.value || 'Team 1';
        if (team2Label && o2) team2Label.textContent = o2.value || 'Team 2';

        const a = s1.value === '' ? null : parseInt(s1.value, 10);
        const b = s2.value === '' ? null : parseInt(s2.value, 10);
        const t1 = o1?.value || 'Team 1';
        const t2 = o2?.value || 'Team 2';

        if (a === null || b === null || Number.isNaN(a) || Number.isNaN(b)) {
            preview.textContent = '';
            winnerInput.value = '';
            return;
        }

        let winner;
        if (a === b) {
            winner = 'Draw';
            preview.textContent = 'Winner from score: Draw (' + a + '-' + b + ')';
        } else if (a > b) {
            winner = t1;
            preview.textContent = 'Winner from score: ' + t1 + ' (' + a + '-' + b + ')';
        } else {
            winner = t2;
            preview.textContent = 'Winner from score: ' + t2 + ' (' + a + '-' + b + ')';
        }
        winnerInput.value = winner;
    }

    [o1, o2, s1, s2].forEach(function (el) {
        if (el) el.addEventListener('input', updatePreview);
    });
    updatePreview();
})();
</script>
@endsection
