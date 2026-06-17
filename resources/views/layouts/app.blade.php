<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚽</text></svg>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
    <style>
    /* ============================================
   CSS Custom Properties (Variables)
   ============================================ */
    :root {
        --primary: #0d6efd;
        --primary-dark: #0a58ca;
        --primary-light: #6ea8fe;
        --danger: #dc2626;
        --success: #047857;
        --warning: #b45309;
        --gold: #ffc107;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 999px;
        --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06);
        --shadow-md: 0 4px 20px rgba(13, 110, 253, 0.08);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.2s ease;
    }

    /* ============================================
   Reset & Base
   ============================================ */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        margin: 0;
        background: var(--gray-100);
        color: var(--gray-800);
        min-height: 100vh;
        line-height: 1.5;
    }

    /* ============================================
   Layout
   ============================================ */
    .wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    /* ============================================
   Typography
   ============================================ */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        color: var(--gray-900);
    }

    h1 {
        font-size: 1.5rem;
    }

    a {
        color: #2563eb;
        text-decoration: none;
        transition: var(--transition);
    }

    a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .muted {
        color: var(--gray-500);
        font-size: 0.9rem;
    }
    header{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e4e4e4
    }

    /* ============================================
   Components: Card
   ============================================ */
    .card {
        background: #ffffff;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
    }

    /* ============================================
   Components: Form Elements
   ============================================ */
    label {
        display: block;
        margin-bottom: 0.35rem;
        font-size: 0.9rem;
        color: var(--gray-500);
    }

    input,
    select {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-300);
        background: #ffffff;
        color: var(--gray-800);
        transition: var(--transition);
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: none;
    }

    input[type="file"] {
        padding: 0.35rem 0;
    }

    /* ============================================
   Components: Buttons
   ============================================ */
    button,
    .btn {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 0.6rem 1rem;
        border-radius: var(--radius-sm);
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    button:hover,
    .btn:hover {
        background: #1d4ed8;
        text-decoration: none;
        color: #fff;
    }

    .btn-secondary {
        background: var(--gray-500);
    }

    .btn-secondary:hover {
        background: var(--gray-600);
    }

    .btn-link-danger {
        background: none;
        border: none;
        color: var(--danger);
        cursor: pointer;
        padding: 0;
        font-weight: 600;
        margin-left: 0.75rem;
    }

    .btn-link-danger:hover {
        text-decoration: underline;
        background: none;
        color: var(--danger);
    }

    /* Rounded Button */
    .btn-rounded {
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.6rem 1.5rem;
        transition: var(--transition);
    }

    .btn-rounded:hover {
        transform: translateY(-1px);
    }

    /* ============================================
   Components: Logout Button
   ============================================ */
    .btn-secondary.logout-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1.5px solid #d1d5db;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        outline: none;
    }

    .btn-secondary.logout-btn:hover {
        background-color: #fee2e2;
        color: var(--danger);
        border-color: #fca5a5;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
    }

    .btn-secondary.logout-btn:active {
        box-shadow: none;
        transform: none;
    }

    .btn-secondary.logout-btn:focus-visible {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.3);
    }

    .logout-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* ============================================
   Components: Alerts
   ============================================ */
    .alert {
        padding: 0.75rem 1rem;
        border-radius: var(--radius-sm);
        margin-bottom: 1rem;
    }

    .alert-success {
        background: #ecfdf5;
        color: var(--success);
        border: 1px solid #a7f3d0;
    }

    .alert-warning {
        background: #fffbeb;
        color: var(--warning);
        border: 1px solid #fde68a;
    }

    .alert-error {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* ============================================
   Components: Table
   ============================================ */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }

    th {
        color: var(--gray-500);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: var(--gray-50);
    }

    tbody tr:hover {
        background: var(--gray-50);
    }

    /* ============================================
   Components: Badges
   ============================================ */
    .score-badge {
        background: #d1fae5;
        color: var(--success);
        padding: 0.35rem 0.75rem;
        border-radius: var(--radius-full);
        font-weight: 700;
    }

    .admin-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: linear-gradient(135deg, var(--gold), #e0a800);
        color: #084298;
        padding: 0.15rem 0.65rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1.5px solid #cc9a06;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
        animation: adminPulse 2s ease-in-out infinite;
    }

    .points-badge-sm {
        background: var(--gold);
        color: var(--gray-800);
        padding: 0.2rem 0.7rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.75rem;
    }

    .points-positive {
        color: var(--success);
        font-weight: 700;
    }

    /* ============================================
   Components: World Cup Score Badge
   ============================================ */
    .score-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .score-badge.worldcup-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 30%, #084298 100%);
        color: #ffffff;
        padding: 0.5rem 1.25rem;
        border-radius: var(--radius-full);
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.3px;
        border: 2px solid var(--primary-light);
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.2),
            0 0 0 3px rgba(13, 110, 253, 0.15);
        position: relative;
        transition: all 0.3s ease;
    }

    .score-badge.worldcup-badge::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: var(--radius-full);
        background: linear-gradient(135deg, var(--primary-light) 0%, #9ec5fe 50%, var(--primary-light) 100%);
        z-index: -1;
        opacity: 0.3;
    }

    .score-badge.worldcup-badge:hover {
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.25),
            0 0 0 4px rgba(13, 110, 253, 0.2);
    }

    .trophy-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        color: var(--gold);
        filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.3));
        animation: shimmer 2s ease-in-out infinite;
    }

    .score-value {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--gold) 0%, #ffca2c 50%, #e0a800 100%);
        color: #084298;
        border-radius: 50%;
        font-size: 16px;
        font-weight: 800;
        padding: 0 4px;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
        border: 1.5px solid #cc9a06;
        animation: pulseGlow 2s ease-in-out infinite;
    }

    /* ============================================
   Components: Status Pills
   ============================================ */
    .status-pill {
        padding: 0.3rem 0.9rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-open {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-wait {
        background: #fef3c7;
        color: var(--warning);
    }

    .status-done {
        background: #d1fae5;
        color: var(--success);
    }

    .live-indicator {
        width: 6px;
        height: 6px;
        background: var(--danger);
        border-radius: 50%;
        display: inline-block;
        animation: pulse 1.5s infinite;
    }

    /* ============================================
   Components: Flags
   ============================================ */
    .team-flag {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid var(--gray-200);
    }

    .team-flag-sm {
        width: 24px;
        height: 24px;
        object-fit: cover;
        border-radius: 50%;
        vertical-align: middle;
    }

    .team-flag-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-200);
        color: var(--gray-600);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .flag-circle {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--gray-100);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .flag-circle-placeholder {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 20px;
        border: 3px solid var(--gray-100);
    }

    .flag-icon-mini {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--gray-200);
    }

    .flag-icon-placeholder {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--gray-200);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        color: var(--gray-500);
    }

    /* ============================================
   Components: Match Card
   ============================================ */
    .match-card {
        border: 1px solid var(--gray-200);
        border-radius: 10px;
        padding: 1.25rem;
        margin-top: 1rem;
        background: var(--gray-50);
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

    .team-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        min-width: 100px;
    }

    .team-name,
    .team-label {
        font-weight: 600;
        text-align: center;
        color: var(--gray-800);
    }

    .team-label {
        font-weight: 700;
        font-size: 0.85rem;
    }

    .vs {
        color: var(--gray-400);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .vs-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 0.75rem;
    }

    .match-result-line {
        margin: 0 0 1rem;
        text-align: center;
    }

    /* ============================================
   Components: Match Card Wrapper (New Design)
   ============================================ */
    .match-card-wrapper {
        border: none;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm), var(--shadow-lg);
    }

    .match-header-bar {
        background: var(--primary);
        padding: 12px 20px;
    }

    .match-item {
        background: #ffffff;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: var(--transition);
    }

    .match-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .match-item.closed {
        background: var(--gray-50);
        border-color: var(--gray-200);
        opacity: 0.85;
    }

    .match-item.closed:hover {
        border-color: var(--gray-300);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        opacity: 1;
    }

    .match-item.closed .flag-circle-placeholder,
    .match-item.closed .vs-circle {
        background: var(--gray-400);
    }

    .match-item.closed .team-label {
        color: var(--gray-400);
    }

    /* ============================================
   Components: Prediction
   ============================================ */
    .prediction-locked {
        margin-top: 0.5rem;
        padding: 1rem;
        border-top: 1px solid var(--gray-200);
        background: #fff;
        border-radius: var(--radius-sm);
    }

    .prediction-area {
        background: var(--gray-50);
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-top: 0.75rem;
        border: 1px solid var(--gray-200);
    }

    .prediction-area.open {
        background: #eff6ff;
        border-color: #bfdbfe;
    }

    .prediction-area.locked {
        background: #f0fdf4;
        border-color: #bbf7d0;
    }

    /* ============================================
   Components: Payment
   ============================================ */
    .payment-card {
        background: var(--gray-50);
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 2rem;
        max-width: 450px;
        margin: 0 auto;
    }

    .qr-container {
        background: white;
        padding: 1rem;
        border-radius: 14px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    /* ============================================
   Components: Input Group Wrapper
   ============================================ */
    .input-group-wrapper {
        transition: var(--transition);
        border-radius: 50px;
    }

    .input-group-wrapper:focus-within {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        transform: translateY(-1px);
    }

    .input-group-wrapper input:focus {
        border: 1px solid var(--primary);
        box-shadow: none;
    }

    .input-group-wrapper .input-group-text {
        transition: var(--transition);
    }

    .input-group-wrapper:focus-within .input-group-text {
        border-color: #86b7fe;
        background: #eff6ff;
    }

    .input-group-wrapper .form-control {
        transition: var(--transition);
    }

    .input-group-wrapper:focus-within .form-control {
        border-color: #86b7fe;
    }

    /* ============================================
   Components: Match Header
   ============================================ */
    .match-header {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .match-header h1 {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary), #084298);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .match-header .muted {
        font-size: 0.95rem;
        color: #6c757d;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* ============================================
   Components: Misc
   ============================================ */
    .icon-box {
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nation-label {
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .team-inline {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        flex-wrap: wrap;
    }

    .flag-preview {
        margin-bottom: 0.5rem;
    }

    /* ============================================
   Layout: Grid System
   ============================================ */
    .grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }

    .divider {
        border: none;
        border-top: 1px solid var(--gray-200);
        margin: 1.5rem 0;
    }

    /* ============================================
   Components: User Results
   ============================================ */
    .user-result-block {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--gray-200);
    }

    .user-result-block:first-of-type {
        margin-top: 1rem;
        padding-top: 0;
        border-top: none;
    }

    .user-result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .user-result-header h3 {
        font-size: 1.1rem;
        color: var(--gray-900);
    }

    /* ============================================
   Components: Chart
   ============================================ */
    #topUsersChart {
        min-height: 300px;
        max-height: 320px;
        width: 100% !important;
    }

    /* ============================================
   Animations
   ============================================ */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }
    }

    @keyframes shimmer {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }

    @keyframes pulseGlow {

        0%,
        100% {
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        50% {
            box-shadow: 0 2px 15px rgba(255, 193, 7, 0.8),
                0 0 25px rgba(255, 193, 7, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }
    }

    @keyframes adminPulse {

        0%,
        100% {
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
        }

        50% {
            box-shadow: 0 2px 15px rgba(255, 193, 7, 0.5), 0 0 20px rgba(255, 193, 7, 0.2);
        }
    }

    /* ============================================
   Responsive: Max 700px
   ============================================ */
    @media (max-width: 700px) {

        .grid-2,
        .grid-3 {
            grid-template-columns: 1fr;
        }

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        th {
            display: none;
        }

        td {
            border: none;
            padding: 0.25rem 0;
        }
    }
/* ============================================
       Main Table with Borders
       ============================================ */
.table-responsive {
    border: 1px solid #d1d5db;
    border-radius: 12px;
    overflow: hidden;
}

.app-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #d1d5db;
    table-layout: fixed;
    margin: 0;
}

.app-table th,
.app-table td {
    border: 1px solid #d1d5db;
    padding: 0.75rem 1.25rem;
}

.app-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border-bottom: 2px solid #cbd5e1;
    white-space: nowrap;
}

.app-table thead th:first-child {
    border-top-left-radius: 16px;
}

.app-table thead th:last-child {
    border-top-right-radius: 16px;
}

.app-table tbody td {
    font-size: 0.9rem;
    color: #334155;
    vertical-align: middle;
    transition: background 0.15s ease;
    border-bottom: 1px solid #d1d5db;
}

.app-table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 16px;
}

.app-table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 16px;
}

.app-table tbody tr:hover td {
    background: #fafcfd;
}

.user-td {}

/* ============================================
       Modal Table with Borders
       ============================================ */
.modal-body .table-responsive {
    overflow: scroll;
}

.modal-table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    margin: 0;
}

.modal-table th,
.modal-table td {
    border: 1px solid #d1d5db;
    padding: 0.65rem 1rem;
}

.modal-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    border-bottom: 2px solid #cbd5e1;
    white-space: nowrap;
}

.modal-table thead th:first-child {
    border-top-left-radius: 12px;
}

.modal-table thead th:last-child {
    border-top-right-radius: 12px;
}

.modal-table tbody td {
    font-size: 0.85rem;
    color: #334155;
    vertical-align: middle;
    border-bottom: 1px solid #d1d5db;
}

.modal-table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.modal-table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

.modal-table tbody tr:hover td {
    background: #fafcfd;
}

/* ============================================
       Other Styles
       ============================================ */
.rank-cell {
    display: flex;
    align-items: center;
    justify-content: center;
}

.rank-medal {
    font-size: 1.5rem;
}

.rank-number {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #585858;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
}

.user-cell {
    min-width: 0;
    width: 100%;
}

.user-cell .d-flex {
    min-width: 0;
    width: 100%;
}

.modal-avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.admin-chip {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    padding: 0.15rem 0.55rem;
    border-radius: 50px;
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    border: 1px solid #fcd34d;
    white-space: nowrap;
}

.points-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    color: #047857;
    padding: 0.3rem 0.85rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    border: 1px solid #a7f3d0;
    white-space: nowrap;
}

.predictions-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #eff6ff;
    color: #0d6efd;
    font-weight: 700;
    font-size: 0.85rem;
    white-space: nowrap;
}

.view-btn {
    transition: all 0.2s ease;
    background-color: #fff;
    color: #0d6efd;
    border: 1px solid #0d6efd !important;
    white-space: nowrap;
    flex-shrink: 0;
}

.view-btn:hover {
    background: #0d6efd;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}

/* Match Badge */
.match-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    color: #475569;
    padding: 0.2rem 0.65rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8rem;
    min-width: 40px;
}

.date-text {
    color: #64748b;
    font-size: 0.8rem;
    white-space: nowrap;
}

.teams-container {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    flex-wrap: wrap;
}

.team-name {
    font-weight: 500;
    color: #1e293b;
}

.vs-text {
    color: #94a3b8;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.prediction-container {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    flex-wrap: wrap;
}

.prediction-winner {
    font-weight: 600;
    color: #0d6efd;
}

.prediction-score {
    color: #64748b;
    font-size: 0.8rem;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
}

.status-completed {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
}

.status-pending {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fcd34d;
}

.points-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.2rem 0.6rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    min-width: 32px;
}

.points-earned {
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
}

.points-zero {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.points-na {
    background: transparent;
    color: #94a3b8;
}

/* ============================================
       Mobile Responsive
       ============================================ */
@media (max-width: 1024px) {
    colgroup col:nth-child(3), colgroup col:nth-child(4){
        width: 130px !important;
    }
}
@media (max-width: 768px) {
    .table-responsive {
        border: none;
        padding: 0;
    }

    .app-table {
        table-layout: auto;
        border: none;
        display: block;
        overflow: unset;
    }


    .app-table thead {
        display: none;
    }

    /* Make tbody a grid container with 2 columns */
    .app-table tbody {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        width: 100%;
    }

    .app-table tbody tr {
        display: block;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        background: #fff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        width: 100%;
        margin: 0;
        /* Remove margin, use grid gap instead */
    }

    .app-table tbody td {
        display: flex;
        justify-content: space-between;
        --bs-table-bg-type: #fff !important;
        align-items: center;
        padding: 0.7rem 1rem;
        border: none;
        border-bottom: 1px solid #e5e7eb;
        text-align: right;
        gap: 1rem;
        width: 100% !important;
    }

    .app-table tbody td:last-child {
        border-bottom: none;
    }

    .app-table tbody td::before {
        content: attr(data-label);
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        font-size: 0.6rem;
        letter-spacing: 0.6px;
        text-align: left;
        flex-shrink: 0;
        min-width: 60px;
    }

    .app-table tbody tr:hover td {
        background: #fff;
    }

    /* Make sure rank cell works in grid */
    .rank-cell {
        justify-content: flex-start;
    }

    .rank-medal {
        font-size: 1.3rem;
    }

    .rank-number {
        width: 30px;
        height: 30px;
        font-size: 0.75rem;
    }

    /* User cell adjustments for grid */
    .user-cell {
        justify-content: end;
        gap: 0.5rem;
    }

    .user-cell .d-flex {
        flex-wrap: wrap;
        gap: 0.25rem;
        width: fit-content;
    }

    .view-btn {
        padding: 0.2rem 0.6rem;
        font-size: 0.75rem;
    }


    .points-chip {
        font-size: 0.8rem;
        padding: 0.2rem 0.6rem;
    }

    .predictions-count {
        width: 30px;
        height: 30px;
        font-size: 0.75rem;
    }

    /* Modal Table Mobile */
    .modal-table {
        border-radius: 12px;
        border: none;
    }

    .modal-table thead {
        display: none;
    }

    .modal-table tbody {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 10px;
        width: 100%;
    }

    .modal-table tbody tr {
        display: block;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        margin: 0;
        background: #fff;
        overflow: hidden;
    }

    .modal-table tbody td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0.85rem;
        border: none;
        border-bottom: 1px solid #e5e7eb;
        text-align: right;
        gap: 0.75rem;
        width: 100% !important;
        font-size: 0.75rem;
    }

    .modal-table tbody td:last-child {
        border-bottom: none;
    }

    .modal-table tbody td::before {
        content: attr(data-label);
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 0.5px;
        text-align: left;
        flex-shrink: 0;
        min-width: 50px;
    }

    .modal-table tbody tr:hover td {
        background: #fff;
    }

    .teams-container {
        justify-content: flex-end;
        gap: 0.25rem;
    }

    .team-name {
        font-size: 0.75rem;
    }

    .prediction-container {
        justify-content: flex-end;
        gap: 0.2rem;
    }

    .prediction-winner {
        font-size: 0.75rem;
    }

    .prediction-score {
        font-size: 0.7rem;
    }

    .match-badge {
        font-size: 14px;
        padding: 0.15rem 0.5rem;
        min-width: 30px;
    }

    .date-text {
        font-size: 14px;
    }

    .status-badge {
        font-size: 14px;
        padding: 0.15rem 0.5rem;
    }

    .points-badge {
        font-size: 14px;
        padding: 0.15rem 0.4rem;
        min-width: 28px;
    }
}

/* Optional: For very small screens, switch to 1 column */
@media (max-width: 576px) {
    .btn{
        font-size: 14px;
    }
    .app-table tbody {
        grid-template-columns: 1fr;
        /* Single column on very small screens */
    }

    .modal-table tbody {
        grid-template-columns: 1fr;
    }
    header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        }
    
    .score-wrapper {
        justify-content: space-between;
        width: 100%;
    }
}

    </style>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>