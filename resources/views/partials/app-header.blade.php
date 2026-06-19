

<header>
    <style>
        .fifa-logo {
    width: 64px;
    height: 64px;
    object-fit: contain;
    flex-shrink: 0;
}
    </style>
   <div class="match-header">
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('fifa-logo.png') }}" alt="FIFA Logo" class="fifa-logo">
        <div>
            <h1>Match Predictor</h1>
            <p class="muted">
                @php
                $user = auth()->user();
                @endphp
                Hello, @if (!($user->isAdmin())) {{ $user->name }} @endif
                @if ($user->isAdmin())
                <span class="admin-badge">👑 Admin</span>
                @endif
            </p>
        </div>
    </div>
</div>
    <div class="score-wrapper">
        @if (!$user->isAdmin())
        <span class="score-badge worldcup-badge">
            <svg class="trophy-icon" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M18 4h-2V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v1H6a2 2 0 0 0-2 2v2c0 3.5 2.5 6.5 6 7.5V18H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-3v-1.5c3.5-1 6-4 6-7.5V6a2 2 0 0 0-2-2zM8 6v4c0 3 2 5 4 6 2-1 4-3 4-6V6H8z" />
                <path d="M12 2v2" stroke="currentColor" stroke-width="1" fill="none" />
                <circle cx="12" cy="11" r="1.5" />
            </svg>
            Total score: <span class="score-value">{{ $totalScore }}</span>
        </span>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secondary logout-btn">
                <svg class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout</button>
        </form>
    </div>
</header>

<nav class="d-flex gap-2 mb-4 flex-wrap" role="tablist" style="scrollbar-width: none;">
    <a href="{{ route('matches.index') }}" 
       class="nav-link rounded-pill px-4 py-2 fw-medium {{ request()->routeIs('matches.index') ? 'active bg-primary text-white shadow-sm' : 'bg-secondary bg-opacity-10 text-dark' }}">
        <i class="bi bi-calendar-check me-1"></i> Today's Matches
    </a>
    
    @if (!$user->isAdmin())
        @if($user->payment_status === 'verified')
        <a href="{{ route('user-results.index') }}" 
           class="nav-link rounded-pill px-4 py-2 fw-medium {{ request()->routeIs('user-results.index') ? 'active bg-primary text-white shadow-sm' : 'bg-secondary bg-opacity-10 text-dark' }}">
            <i class="bi bi-person-check me-1"></i> My Results
        </a>
        @endif
    @endif
    
    @if ($user->isAdmin())
    <a href="{{ route('admin.matches.index') }}" 
       class="nav-link rounded-pill px-4 py-2 fw-medium {{ request()->routeIs('admin.matches.*') ? 'active bg-primary text-white shadow-sm' : 'bg-secondary bg-opacity-10 text-dark' }}">
        <i class="bi bi-gear me-1"></i> Manage
    </a>
    <a href="{{ route('admin.users.index') }}" 
       class="nav-link rounded-pill px-4 py-2 fw-medium {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white shadow-sm' : 'bg-secondary bg-opacity-10 text-dark' }}">
        <i class="bi bi-people me-1"></i> Users
    </a>
    @endif
    
    @if($user->payment_status === 'verified')
    <a href="{{ route('all-users-results.index') }}" 
       class="nav-link rounded-pill px-4 py-2 fw-medium {{ request()->routeIs('all-users-results.index') ? 'active bg-primary text-white shadow-sm' : 'bg-secondary bg-opacity-10 text-dark' }}">
        <i class="bi bi-trophy me-1"></i>All Users Results
    </a>
    @endif
</nav>

<style>
.nav-link {
    white-space: nowrap;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}
.bg-secondary.bg-opacity-10:hover {
    background-color: rgba(108, 117, 125, 0.2) !important;
    transition: all 0.2s ease;
}
</style>