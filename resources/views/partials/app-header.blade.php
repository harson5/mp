<header>
    <div>
        <h1>Match Predictor</h1>
        <p class="muted">
                @php
                $user = auth()->user();
                @endphp
            Hello, @if (!($user->isAdmin())) {{ $user->name }} @endif
            @if ($user->isAdmin())
            <span class="admin-badge">Admin</span>
            @endif
        </p>
    </div>
    <div style="display:flex;align-items:center;gap:1rem;">
        @if (!$user->isAdmin())
        <span class="score-badge">Total score: {{ $totalScore }}</span>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-secondary">Logout</button>
        </form>
    </div>
</header>

<nav class="tabs">

    <a href="{{ route('matches.index') }}" class="tab {{ request()->routeIs('matches.index') ? 'active' : '' }}">Today's Matches</a>
    @if (!$user->isAdmin())
    @if($user->payment_status === 'verified')
    <a href="{{ route('user-results.index') }}" class="tab {{ request()->routeIs('user-results.index') ? 'active' : '' }}">My Results</a>
    @endif
    @endif
    @if ($user->isAdmin())
    <a href="{{ route('admin.matches.index') }}" class="tab {{ request()->routeIs('admin.matches.*') ? 'active' : '' }}">Manage Matches</a>
    <a href="{{ route('admin.users.index') }}" class="tab {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Manage Users</a>
    @endif
    @if($user->payment_status === 'verified')
    <a href="{{ route('all-users-results.index') }}" class="tab {{ request()->routeIs('all-users-results.index') ? 'active' : '' }}">All Users Results</a>
    @endif
</nav>