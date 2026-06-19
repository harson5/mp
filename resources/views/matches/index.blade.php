@extends('layouts.app')

@section('title', 'Matches')

@section('header')
@include('partials.app-header', ['totalScore' => $totalScore])
@endsection

@section('content')
<div class="mt-4 mb-4">
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

<div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden p-0">
    <div class="card-header text-white border-0 py-2 px-3">
        <div class="d-flex align-items-center">
            <div class="bg-white bg-opacity-25 rounded-3 p-2 py-1 me-3">
                <i class="bi bi-list-check fs-5"></i>
            </div>
            <h5 class="mb-0 fw-bold text-white">Scoring Rules</h5>
        </div>
    </div>
    <div class="card-body p-3 py-4">
        <div class="d-flex flex-column gap-2">
            <!-- Correct winner -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light hover-effect">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-warning bg-opacity-10 p-2">
                        <i class="bi bi-trophy-fill text-warning fs-7"></i>
                    </div>
                    <span class="fw-medium">Correct winner</span>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2 fs-8">2 pts</span>
            </div>

            <!-- Correct opponent 1 score -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-info bg-opacity-10 p-2">
                        <i class="bi bi-1-circle-fill text-info fs-7"></i>
                    </div>
                    <span class="fw-medium">Correct opponent 1 score</span>
                </div>
                <span class="badge bg-info rounded-pill px-3 py-2 fs-8">1 pt</span>
            </div>

            <!-- Correct opponent 2 score -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-info bg-opacity-10 p-2">
                        <i class="bi bi-2-circle-fill text-info fs-7"></i>
                    </div>
                    <span class="fw-medium">Correct opponent 2 score</span>
                </div>
                <span class="badge bg-info rounded-pill px-3 py-2 fs-8">1 pt</span>
            </div>

            <!-- All three correct -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-warning bg-opacity-25 p-2">
                        <i class="bi bi-stars text-warning fs-7"></i>
                    </div>
                    <span class="fw-semibold">All three correct</span>
                </div>
                <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fs-8 fw-bold">5 pts</span>
            </div>

            <!-- Draw exact score -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-success bg-opacity-25 p-2">
                       <i class="bi bi-dash-circle-fill text-success fs-7"></i>
                    </div>
                    <span class="fw-semibold">Draw — exact score</span>
                </div>
                <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fs-8 fw-bold">5 pts</span>
            </div>

            <!-- Draw wrong score -->
            <div class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle bg-secondary bg-opacity-10 p-2">
                       <i class="bi bi-dash-circle-fill text-success fs-7"></i>
                    </div>
                    <span class="fw-medium">Draw — wrong score</span>
                </div>
                <span class="badge bg-success rounded-pill px-3 py-2 fs-8">2 pts</span>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden p-0">
                <div class="card-header text-white border-0 py-2 px-3">
                    
                     <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 rounded-3 p-2 py-1 me-3">
                            <i class="bi bi-trophy-fill fs-5"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-white">Top 5 Users - Highest Score</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="topUsersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="card match-card-wrapper p-0">
    <div class="match-header-bar">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:1.5rem;">⚽</span>
                <div>
                    <h4 class="text-white mb-0 fw-bold">Today's Matches</h4>
                    @if($matches->isNotEmpty())
                        <p class="text-white text-opacity-75 mb-0 small">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $matches->first()->match_datetime->format('l, F j, Y') }}
                        </p>
                    @endif
                </div>
            </div>
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                🏆 FIFA 2026
            </span>
        </div>
    </div>
    
    <div class="card-body p-2 p-sm-4">
        @if (auth()->user()->payment_status == 'unpaid')
        <div class="text-center py-3">
            <div class="payment-card">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">
                    <i class="bi bi-lock-fill me-1"></i> Payment Required
                </span>
                
                <p class="text-muted mb-3">Pay <strong>Rs. 100</strong> via eSewa to unlock predictions</p>
                
                @php
                $data = json_encode([
                    'eSewa_id' => '9843724837',
                    'name' => 'Hari Sharan Suwal'
                ]);
                @endphp
                
                <div class="qr-container mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($data) }}" 
                         style="width:170px;height:170px;border-radius:10px;" alt="QR Code">
                </div>
                
                <form method="POST" action="{{ route('payment.request') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-semibold">Transaction Code</label>
                        <input type="text" name="transaction_code" class="form-control rounded-3" placeholder="Enter transaction code" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-semibold">Payment Screenshot</label>
                        <input type="file" name="payment_proof" class="form-control rounded-3" accept="image/*" required>
                        <div class="text-muted small mt-1">Max 1 MB · JPEG, PNG, GIF, WebP</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-rounded w-100">
                        <i class="bi bi-check-circle me-2"></i>Submit Payment
                    </button>
                </form>
                <p class="text-muted small mb-0 mt-3">
                    <i class="bi bi-clock me-1"></i>Verification within ~60 minutes
                </p>
            </div>
        </div>
        
        @elseif(auth()->user()->payment_status == 'paid')
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-hourglass-split text-warning" style="font-size:2.5rem;"></i>
            </div>
            <h5 class="fw-bold">Verification in Progress</h5>
            <p class="text-muted">Admin will verify your payment within 60 minutes.</p>
            <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold">
                <i class="bi bi-clock me-1"></i> Pending
            </span>
        </div>
        
        @elseif($matches->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-calendar-x text-muted" style="font-size:2.5rem;"></i>
            </div>
            <h5 class="fw-bold text-muted">No Matches Today</h5>
            <p class="text-muted">Check back later for upcoming matches!</p>
        </div>
        
        @else
        @foreach ($matches as $match)
            @php 
                $prediction = $userPredictions->get($match->id);
                $isClosed = !$match->isPredictionOpen() && !$match->hasResults();
            @endphp
            
            <div class="match-item {{ $isClosed && !auth()->user()->isAdmin() ? 'closed' : '' }}">
                <!-- Match Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark rounded-pill">Match #{{ $match->match_no }}</span>
                        <span class="text-muted small">
                            <i class="bi bi-clock me-1"></i>{{ $match->match_datetime->format('H:i') }}
                        </span>
                        @php
                            $matchDate = $match->match_datetime->startOfDay();
                            $today = now()->startOfDay();
                            $tomorrow = now()->addDay()->startOfDay();
                            $yesterday = now()->subDay()->startOfDay();
                            
                            if ($matchDate->equalTo($today)) {
                                $dayBadge = 'bg-success';
                                $dayText = 'Today';
                            } elseif ($matchDate->equalTo($tomorrow)) {
                                $dayBadge = 'bg-warning text-dark';
                                $dayText = 'Tomorrow';
                            } elseif ($matchDate->equalTo($yesterday)) {
                                $dayBadge = 'bg-danger';
                                $dayText = 'Yesterday';
                            } elseif ($matchDate->between(now()->subDays(7), now()->addDays(7))) {
                                $dayBadge = 'bg-info text-dark';
                                $dayText = $match->match_datetime->format('D, M j');
                            } else {
                                $dayBadge = 'bg-secondary';
                                $dayText = $match->match_datetime->format('M j, Y');
                            }
                        @endphp
                        <span class="badge {{ $dayBadge }} rounded-pill px-2" style="font-size: 0.7rem;">
                            {{ $dayText }}
                        </span>
                    </div>
                    <div>
                        @if ($match->hasResults())
                            <span class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                <span class="live-indicator me-1"></span>Final
                            </span>
                        @elseif ($match->isPredictionOpen())
                            <span class="status-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                <i class="bi bi-play-fill me-1"></i>Open
                            </span>
                        @else
                            <span class="status-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                <i class="bi bi-clock me-1"></i>Awaiting
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Teams -->
                <div class="d-flex justify-content-between gap-4 gap-sm-5 mx-auto" style="max-width: 380px">
                    <div class="text-center flag-wrapper">
                        @if ($url = $match->flagUrl($match->opponent1_flag))
                            <img src="{{ $url }}" class="flag-circle mx-auto d-block mb-2">
                        @else
                            <div class="flag-circle-placeholder mx-auto mb-2">
                                {{ strtoupper(substr($match->opponent1, 0, 1)) }}
                            </div>
                        @endif
                        <span class="team-label">{{ $match->opponent1 }}</span>
                    </div>
                    
                    <div class="vs-circle my-auto">VS</div>
                    
                    <div class="text-center flag-wrapper">
                        @if ($url = $match->flagUrl($match->opponent2_flag))
                            <img src="{{ $url }}" class="flag-circle mx-auto d-block mb-2">
                        @else
                            <div class="flag-circle-placeholder mx-auto mb-2">
                                {{ strtoupper(substr($match->opponent2, 0, 1)) }}
                            </div>
                        @endif
                        <span class="team-label">{{ $match->opponent2 }}</span>
                    </div>
                </div>
                
                <!-- Result -->
                @if ($match->hasResults())
                    <div class="text-center mt-3">
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            Result: <strong>{{ $match->resultLabel() }}</strong>
                        </span>
                    </div>
                @endif
                
                <!-- Prediction -->
                @if ($prediction && !$match->isPredictionOpen())
                    <div class="prediction-area locked mt-3">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <small class="text-muted">Your Prediction</small>
                            <span class="badge bg-success rounded-pill">Locked</span>
                        </div>
                        <strong>
                            {{ \App\Models\MatchGame::resolveWinner($match->opponent1, $match->opponent2, $prediction->opponent1_score, $prediction->opponent2_score) }},
                            {{ $prediction->opponent1_score }} – {{ $prediction->opponent2_score }}
                        </strong>
                        @if ($prediction->points_earned > 0)
                            <span class="points-badge-sm ms-2">+{{ $prediction->points_earned }} pts</span>
                        @endif
                    </div>
                @elseif ($match->isPredictionOpen() && !auth()->user()->isAdmin())
                    <div class="prediction-area open mt-3">
                        @include('partials.prediction-form', ['match' => $match, 'prediction' => $prediction])
                    </div>
                @elseif(!auth()->user()->isAdmin())
                    <div class="text-center mt-3">
                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                            <i class="bi bi-lock me-1"></i>Predictions Closed
                        </span>
                    </div>
                @endif
            </div>
        @endforeach
        @endif
    </div>
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

    // Truncate names if too long
    const labels = users.map(u => {
        return u.name.length > 12 ? u.name.substring(0, 10) + '...' : u.name;
    });
    const scores = users.map(u => u.score);
    const maxScore = Math.max(...scores, 1);

    const ctx = document.getElementById('topUsersChart').getContext('2d');

    // Medal colors for top 3
    const medalGradients = [
        createGradient(ctx, '#FFD700', '#FFA000'), // Gold - 1st
        createGradient(ctx, '#C0C0C0', '#9E9E9E'), // Silver - 2nd
        createGradient(ctx, '#CD7F32', '#8B6914'), // Bronze - 3rd
        createGradient(ctx, '#0d6efd', '#0a58ca'),   // Blue - 4th
        createGradient(ctx, '#6c757d', '#495057')    // Gray - 5th
    ];

    function createGradient(ctx, color1, color2) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, color1);
        gradient.addColorStop(1, color2);
        return gradient;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Score',
                data: scores,
                backgroundColor: medalGradients,
                borderRadius: {
                    topLeft: 12,
                    topRight: 12,
                    bottomLeft: 4,
                    bottomRight: 4
                },
                borderSkipped: false,
                barPercentage: 0.7,
                categoryPercentage: 0.85,
                borderWidth: 0,
                maxBarThickness: 60
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: false 
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleFont: {
                        size: 14,
                        weight: 'bold',
                        family: "'Inter', system-ui, sans-serif"
                    },
                    bodyFont: {
                        size: 13,
                        family: "'Inter', system-ui, sans-serif"
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        title: function(context) {
                            // Show full name in tooltip
                            return users[context[0].dataIndex].name;
                        },
                        label: function(context) {
                            const rank = context.dataIndex + 1;
                            const medals = ['🥇', '🥈', '🥉', '⭐', '⭐'];
                            return medals[context.dataIndex] + ' ' + context.parsed.y + ' points (#' + rank + ')';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: maxScore + Math.ceil(maxScore * 0.2),
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false,
                        lineWidth: 1
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        color: '#64748b',
                        padding: 10,
                        stepSize: Math.ceil(maxScore / 6),
                        callback: function(value) {
                            return value + ' pts';
                        }
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        color: '#334155',
                        padding: 10,
                        maxRotation: 0,
                        autoSkip: false,
                        callback: function(value, index) {
                            // Ellipsis for long labels
                            const label = labels[index];
                            if (label.length > 12) {
                                return label.substring(0, 10) + '...';
                            }
                            return label;
                        }
                    },
                    border: {
                        display: false
                    },
                    offset: true
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            },
            layout: {
                padding: {
                    top: 25,
                    right: 20,
                    bottom: 15,
                    left: 14
                }
            }
        },
        plugins: [{
            afterDatasetsDraw: function(chart) {
                const ctx = chart.ctx;
                chart.data.datasets[0].data.forEach(function(value, index) {
                    const meta = chart.getDatasetMeta(0);
                    const bar = meta.data[index];
                    
                    ctx.save();
                    ctx.font = 'bold 14px "Inter", system-ui, sans-serif';
                    ctx.fillStyle = '#1e293b';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';
                    
                    const medals = ['🥇', '🥈', '🥉', '4th', '5th'];
                    ctx.fillText(medals[index], bar.x, bar.y - 5);
                    
                    ctx.restore();
                });
            }
        }]
    });
</script>


@endpush
