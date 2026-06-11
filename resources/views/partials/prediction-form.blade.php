<form method="POST"
      action="{{ route('predictions.store', $match) }}"
      class="prediction-form"
      data-team1="{{ $match->opponent1 }}"
      data-team2="{{ $match->opponent2 }}">
    @csrf
    <p class="muted" style="margin:0 0 0.5rem;">Your prediction — enter scores; winner is set automatically</p>
    <div class="grid-2">
        <div>
            <label>{{ $match->opponent1 }} score</label>
            <input type="number"
                   name="opponent1_score"
                   class="pred-score-1"
                   min="0"
                   max="99"
                   value="{{ old('opponent1_score', optional($prediction)->opponent1_score) }}"
                   required>
        </div>
        <div>
            <label>{{ $match->opponent2 }} score</label>
            <input type="number"
                   name="opponent2_score"
                   class="pred-score-2"
                   min="0"
                   max="99"
                   value="{{ old('opponent2_score', optional($prediction)->opponent2_score) }}"
                   required>
        </div>
    </div>
    <p class="muted winner-preview"
            style="margin:0.5rem 0 0; min-height:2.25rem; font-weight:bold; font-size:1.2rem; color:green">
    </p>
    <button type="submit">{{ $prediction ? 'Update prediction' : 'Submit prediction' }}</button>

    @if ($prediction)
        <p class="muted" style="margin:0.5rem 0 0;font-size:0.9rem;">
            You can update your prediction until 10 minutes before the match starts.
        </p>
    @endif
</form>
