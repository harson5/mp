@extends('layouts.app')

@section('title', 'Matches')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-12 mb-3">
           <div class="alert alert-warning" role="alert" style="border-radius:0.5rem; background-color: #fcf3d6; border-left: 6px solid #ffc107; color: #856404;">
  <ul style="margin-bottom: 0; padding-left: 1.2rem;">
    <strong>Note:</strong>
    <li class="text-danger"> This is not a betting website. The game is only for entertainment purposes and fun competition inside<strong> Miracle Interface</strong> Only.</li>
    <li>The collected money will be divided into prizes for the top 3 users at the end of the tournament.</li>
    <li>The scoring system is designed to reward accurate predictions, with points awarded based on how closely your prediction matches the actual match results.</li>
    <li>Please refer to the scoring rules on the right for more details.</li>
    <strong>Disclaimers:</strong>
    <li class="text-danger"><i>This Website does not endorse or promote any form of gambling.</i></li>
  </ul>
</div>
        </div>
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Scoring Rules</h5>
                </div>
                    <ul class="card-body ms-4" style="line-height:1.6;">
                        <li>Correct winner: <strong>2 points</strong></li>
                        <li class="mt-2">Correct opponent 1 score: <strong>1 point</strong></li>
                        <li class="mt-2">Correct opponent 2 score: <strong>1 point</strong></li>
                        <li class="mt-2">All three correct: <strong>5 points</strong></li>
                        <li class="mt-2">Draw — exact score: <strong>5 points</strong></li>
                        <li class="mt-2">Draw — wrong score: <strong>2 points</strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Top 5 Users - Highest Score</h5>
                </div>
                <div class="card-body">
                    <canvas id="topUsersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h2 style="margin-top:0;">Today's matches</h2>
    
    @if (auth()->user()->payment_status == 'unpaid')
    <div style="margin-top:1rem;padding:1.5rem;background-color:#f8f9fa;border-radius:0.5rem;text-align:center;max-width:400px;margin-left:auto;margin-right:auto;">
        <p class="muted" style="margin-bottom:1rem;"><strong>Payment Required</strong></p>
        <p style="margin-bottom:1.5rem;font-size:0.95rem;">Please scan the QR code below from your eSewa app and Pay RS.100 to complete your payment:</p>
        
        @php
        $data = json_encode([
            'eSewa_id' => '9843724837',
            'name' => 'Hari Sharan Suwal'
        ]);
        @endphp
        <div style="background:white;padding:1rem;border-radius:0.5rem;display:inline-block;margin-bottom:1.5rem;">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($data) }}"style="width:200px;height:200px;">

        
        
        </div>
        
        <p class="muted" style="margin-bottom:1.5rem;font-size:0.9rem;">After paying, click the button below and the admin will verify your payment.</p>
        
        <form method="POST" action="{{ route('payment.request') }}" enctype="multipart/form-data" style="margin:0;">
            @csrf
            <div style="margin-bottom:1rem;text-align:left;">
                <label for="transaction_code" style="display:block;margin-bottom:0.35rem;font-weight:600;">Transaction Code</label>
                <input type="text" id="transaction_code" name="transaction_code" value="{{ old('transaction_code') }}" required style="width:100%;padding:0.5rem;border:1px solid #ced4da;border-radius:0.375rem;">
                @error('transaction_code')
                    <p class="text-danger" style="margin:0.35rem 0 0;font-size:0.9rem;">{{ $message }}</p>
                @enderror
            </div>
            <div style="margin-bottom:1rem;text-align:left;">
                <label for="payment_proof" style="display:block;margin-bottom:0.35rem;font-weight:600;">Payment Proof</label>
                <input type="file" id="payment_proof" name="payment_proof" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" required style="width:100%;padding:0.35rem;border:1px solid #ced4da;border-radius:0.375rem;">
                <p class="muted" style="margin:0.35rem 0 0;font-size:0.9rem;">Allowed types: jpeg, png, jpg, gif, webp. Max size: 1 MB.</p>
                <p id="payment-proof-warning" class="text-danger" style="margin:0.35rem 0 0;font-size:0.9rem;display:none;"></p>
                @error('payment_proof')
                    <p class="text-danger" style="margin:0.35rem 0 0;font-size:0.9rem;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn" style="background-color:#198754;color:white;border:none;padding:0.75rem 1.5rem;cursor:pointer;border-radius:0.375rem;">Submit Payment</button>
        </form>
        <p class="muted" style="margin-top:1rem;font-size:0.85rem;">Admin verification typically takes 60 minutes.</p>
    </div>
    @elseif(auth()->user()->payment_status == 'paid')
    <p class="muted" style="margin-top:1rem;">Your payment is pending verification. Please
     wait for the admin to verify your payment. This usually takes 60 minutes.</p>
    </p>
    @elseif($matches->isEmpty())
    <p class="muted" style="margin-top:1rem;">No matches scheduled for today.</p>
    @else
    @foreach ($matches as $match)
    <p class="muted">{{ $match->match_datetime->format('l, F j, Y') }}</p>
            @php
                $prediction = $userPredictions->get($match->id);
            @endphp
            <div class="match-card">
                <div class="match-card-header">
                    <span class="muted">Match #{{ $match->match_no }} · {{ $match->match_datetime->format('H:i') }}</span>
                    @if ($match->hasResults())
                        <span class="status-pill status-done">Final</span>
                    @elseif ($match->isPredictionOpen())
                        <span class="status-pill status-open">Open</span>

                    @else
                        <span class="status-pill status-wait">Awaiting results</span>
                    @endif
                </div>

                <div class="match-teams">
                    <div class="team-block">
                        @if ($url = $match->flagUrl($match->opponent1_flag))
                            <img src="{{ $url }}" alt="{{ $match->opponent1 }} flag" class="team-flag">
                        @else
                            <div class="team-flag team-flag-placeholder">{{ strtoupper(substr($match->opponent1, 0, 1)) }}</div>
                        @endif
                        <span class="team-name">{{ $match->opponent1 }}</span>
                    </div>
                    <span class="vs">VS</span>
                    <div class="team-block">
                        @if ($url = $match->flagUrl($match->opponent2_flag))
                            <img src="{{ $url }}" alt="{{ $match->opponent2 }} flag" class="team-flag">
                        @else
                            <div class="team-flag team-flag-placeholder">{{ strtoupper(substr($match->opponent2, 0, 1)) }}</div>
                        @endif
                        <span class="team-name">{{ $match->opponent2 }}</span>
                    </div>
                </div>

                @if ($match->hasResults())
                    <p class="muted match-result-line">
                        Result: <strong>{{ $match->resultLabel() }}</strong>
                    </p>
                @endif

                @if ($prediction && ! $match->isPredictionOpen())
                    <div class="prediction-locked">
                        <p class="muted" style="margin:0 0 0.35rem;">Your prediction <span class="status-pill status-done">Locked</span></p>
                        <p style="margin:0;">
                            <strong>{{ \App\Models\MatchGame::resolveWinner($match->opponent1, $match->opponent2, $prediction->opponent1_score, $prediction->opponent2_score) }}</strong>,
                            {{ $prediction->opponent1_score }} – {{ $prediction->opponent2_score }}
                            @if ($prediction->points_earned > 0)
                                <span class="points-positive">(+{{ $prediction->points_earned }} pts)</span>
                            @endif
                        </p>
                        <p class="muted" style="margin:0.5rem 0 0;font-size:0.85rem;">Predictions can no longer be changed within 10 minutes of match start.</p>
                    </div>
                @elseif ($match->isPredictionOpen() && !auth()->user()->isAdmin())
                    @include('partials.prediction-form', ['match' => $match, 'prediction' => $prediction])
                @elseif(!auth()->user()->isAdmin())
                    <p class="muted" style="margin:0;">Predictions closed.</p>
                @endif
            </div>
        @endforeach
    @endif
</div>
@endsection

@push('scripts')
<script>
(function () {
    const DRAW = @json(\App\Models\MatchGame::DRAW);

    function updatePredictionPreview(form) {
        const s1 = form.querySelector('.pred-score-1');
        const s2 = form.querySelector('.pred-score-2');
        const preview = form.querySelector('.winner-preview');
        const t1 = form.dataset.team1;
        const t2 = form.dataset.team2;

        if (!s1 || !s2 || !preview) return;

        const a = s1.value === '' ? null : parseInt(s1.value, 10);
        const b = s2.value === '' ? null : parseInt(s2.value, 10);

        if (a === null || b === null || Number.isNaN(a) || Number.isNaN(b)) {
            preview.textContent = '';
            return;
        }

        if (a === b) {
            preview.textContent = 'Your pick: ' + DRAW + ' (' + a + '–' + b + ')';
        } else if (a > b) {
            preview.textContent = 'Your pick: ' + t1 + ' (' + a + '–' + b + ')';
        } else {
            preview.textContent = 'Your pick: ' + t2 + ' (' + a + '–' + b + ')';
        }
    }

    document.querySelectorAll('.prediction-form').forEach(function (form) {
        form.querySelectorAll('.pred-score-1, .pred-score-2').forEach(function (input) {
            input.addEventListener('input', function () { updatePredictionPreview(form); });
        });
        updatePredictionPreview(form);
    });
})();
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const proofInput = document.getElementById('payment_proof');
    const warning = document.getElementById('payment-proof-warning');
    const MAX_BYTES = 1 * 1024 * 1024; // 1 MB

    if (!proofInput) return;

    proofInput.addEventListener('change', function () {
        warning.style.display = 'none';
        warning.textContent = '';

        const file = this.files && this.files[0];
        if (!file) return;

        const allowed = ['image/jpeg','image/png','image/jpg','image/gif','image/webp'];
        if (!allowed.includes(file.type)) {
            warning.textContent = 'File type not allowed. Please upload jpeg, png, jpg, gif or webp.';
            warning.style.display = 'block';
            this.value = '';
            return;
        }

        if (file.size > MAX_BYTES) {
            warning.textContent = 'File is too large. Maximum allowed size is 1 MB.';
            warning.style.display = 'block';
            this.value = '';
            return;
        }
    });
});
</script>

<script>
    const users = @json($topUsers);

    const labels = users.map(u => u.name);
    const scores = users.map(u => u.score);

    const ctx = document.getElementById('topUsersChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Score',
                data: scores,
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#ffc107',
                    '#dc3545',
                    '#6f42c1'
                ],
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endpush
