<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚽</text></svg>">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            margin: 0;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }
        .wrap { max-width: 1100px; margin: 0 auto; padding: 1.5rem; }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }
        h1, h2 { margin: 0; color: #0f172a; }
        h1 { font-size: 1.5rem; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { color: #1d4ed8; text-decoration: underline; }
        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
        }
        label { display: block; margin-bottom: 0.35rem; font-size: 0.9rem; color: #64748b; }
        input, select {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #1e293b;
            margin-bottom: 0.85rem;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        button{
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
        }
        .btn:hover{
            background: #2563eb !important;
            text-decoration: none !important;
            color: #fff !important;
        }
        .btn.btn-link-danger:hover{
            background: #d12d2d !important;
            color: #fff !important;
        }
     
        button:hover, .btn:hover { background: #1d4ed8; }
        .btn-secondary { background: #64748b; }
        .btn-secondary:hover { background: #475569; }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .alert-success { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .alert-warning { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .alert-error { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { color: #64748b; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.04em; background: #f8fafc; }
        tbody tr:hover { background: #f8fafc; }
        .score-badge {
            background: #d1fae5;
            color: #047857;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            font-weight: 700;
        }
        .admin-badge {
            display: inline-block;
            margin-left: 0.35rem;
            padding: 0.15rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 4px;
        }
        .points-positive { color: #047857; font-weight: 700; }
        .muted { color: #64748b; font-size: 0.9rem; }
        .tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0;
        }
        .tab {
            padding: 0.65rem 1.1rem;
            border-radius: 8px 8px 0 0;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid transparent;
            border-bottom: none;
            margin-bottom: -1px;
        }
        .tab:hover { color: #1e293b; text-decoration: none; background: #f8fafc; }
        .tab.active {
            color: #2563eb;
            background: #ffffff;
            border-color: #e2e8f0;
        }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; }
        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
        .team-flag {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
        }
        .team-flag-sm { width: 24px; height: 24px; object-fit: cover; border-radius: 50%; vertical-align: middle; }
        .team-flag-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            color: #475569;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .match-card {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1.25rem;
            margin-top: 1rem;
            background: #f8fafc;
        }
        .match-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .match-teams {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .team-block { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; min-width: 100px; }
        .team-name { font-weight: 600; text-align: center; }
        .vs { color: #94a3b8; font-weight: 700; font-size: 0.9rem; }
        .match-result-line { margin: 0 0 1rem; text-align: center; }
        .prediction-form { margin-top: 0.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0; }
        .prediction-locked {
            margin-top: 0.5rem;
            padding: 1rem;
            border-top: 1px solid #e2e8f0;
            background: #fff;
            border-radius: 8px;
        }
        .status-pill {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            text-transform: uppercase;
        }
        .status-open { background: #dbeafe; color: #1d4ed8; }
        .status-wait { background: #fef3c7; color: #b45309; }
        .status-done { background: #d1fae5; color: #047857; }
        .team-inline { display: flex; align-items: center; gap: 0.35rem; flex-wrap: wrap; }
        .flag-preview { margin-bottom: 0.5rem; }
        .btn-link-danger {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            padding: 0;
            font-weight: 600;
            margin-left: 0.75rem;
        }
        .btn-link-danger:hover { text-decoration: underline; }
        input[type="file"] { padding: 0.35rem 0; }
        .user-result-block {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }
        .user-result-block:first-of-type { margin-top: 1rem; padding-top: 0; border-top: none; }
        .user-result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .transaction-code{
            white-space: nowrap;     
            overflow: hidden;        
            text-overflow: ellipsis; 
            max-width: 200px;             
        }
        .user-result-header h3 { font-size: 1.1rem; color: #0f172a; }
        @media (max-width: 700px) {
            .grid-2 { grid-template-columns: 1fr; }
        }
        @media (max-width: 700px) {
            .grid-3 { grid-template-columns: 1fr; }
            table, thead, tbody, th, td, tr { display: block; }
            th { display: none; }
            td { border: none; padding: 0.25rem 0; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        @hasSection('header')
            @yield('header')
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
    @stack('scripts')
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
