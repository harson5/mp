

<form method="POST"
      action="{{ route('predictions.store', $match) }}"
      class="prediction-form"
      data-team1="{{ $match->opponent1 }}"
      data-team2="{{ $match->opponent2 }}">
    @csrf
    
    <p class="text-muted small mb-3">
        <i class="bi bi-info-circle me-1"></i> 
        Enter scores — winner is set automatically
    </p>
    
    <div class="row g-3 mb-3">
        <div class="col-6">
            <label class="nation-label form-label fw-semibold small text-dark">
                @if ($url = $match->flagUrl($match->opponent1_flag))
                    <img src="{{ $url }}" class="flag-icon-mini me-1" style="vertical-align: middle;">
                @else
                    <span class="flag-icon-placeholder me-1" style="vertical-align: middle;">{{ strtoupper(substr($match->opponent1, 0, 1)) }}</span>
                @endif
                {{ $match->opponent1 }}
            </label>
            <div class="input-group input-group-wrapper">
                <input type="number"
                       name="opponent1_score"
                       class="form-control rounded-pill pred-score-1"
                       min="0"
                       max="99"
                       placeholder="0"
                       value="{{ old('opponent1_score', optional($prediction)->opponent1_score) }}"
                       required>
            </div>
        </div>
        
        <div class="col-6">
            <label class="nation-label form-label fw-semibold small text-dark">
                @if ($url = $match->flagUrl($match->opponent2_flag))
                    <img src="{{ $url }}" class="flag-icon-mini me-1" style="vertical-align: middle;">
                @else
                    <span class="flag-icon-placeholder me-1" style="vertical-align: middle;">{{ strtoupper(substr($match->opponent2, 0, 1)) }}</span>
                @endif
                {{ $match->opponent2 }}
            </label>
            <div class="input-group input-group-wrapper">
                <input type="number"
                       name="opponent2_score"
                       class="form-control rounded-pill pred-score-2"
                       min="0"
                       max="99"
                       placeholder="0"
                       value="{{ old('opponent2_score', optional($prediction)->opponent2_score) }}"
                       required>
            </div>
        </div>
    </div>
    
    <!-- Winner Preview -->
     <div class="d-flex justify-content-center">

         <strong class="text-center rounded-pill px-4 py-1 winner-preview mb-3 w-fit text-success mx-auto">
                     <!-- Preview text inserted by JS -->
     </strong>
     </div>
    
    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
            @if($prediction)
                <i class="bi bi-arrow-repeat me-2"></i> Update Prediction
            @else
                <i class="bi bi-pencil-square me-2"></i> Submit Prediction
            @endif
        </button>
    </div>
    
    @if ($prediction)
        <div class="text-center mt-3">
            <span class="badge bg-warning text-dark rounded-pill px-3 py-1 small">
                <i class="bi bi-clock me-1"></i>
                Editable until 10 minutes before match
            </span>
        </div>
    @endif
</form>