<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EduPortal') — Student Enrollment System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:   #0B1D3A;
            --navy2:  #142850;
            --gold:   #C9A84C;
            --gold2:  #E8C46A;
            --cream:  #F8F4EE;
            --white:  #FFFFFF;
            --gray50: #F9FAFB;
            --gray100:#F3F4F6;
            --gray200:#E5E7EB;
            --gray400:#9CA3AF;
            --gray600:#4B5563;
            --gray800:#1F2937;
            --red:    #DC2626;
            --green:  #059669;
            --blue:   #2563EB;
            --shadow-sm: 0 1px 3px rgba(11,29,58,.08), 0 1px 2px rgba(11,29,58,.06);
            --shadow-md: 0 4px 16px rgba(11,29,58,.10), 0 2px 6px rgba(11,29,58,.06);
            --shadow-lg: 0 20px 48px rgba(11,29,58,.14), 0 8px 16px rgba(11,29,58,.08);
            --radius:  12px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--gray800);
            min-height: 100vh;
        }

        /* ── Navbar ────────────────────────────────────────── */
        .navbar {
            background: var(--navy);
            padding: 0 2rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,.3);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: var(--gold);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .brand-name {
            font-family: 'Playfair Display', serif;
            color: var(--white);
            font-size: 1.35rem;
            letter-spacing: .02em;
        }
        .brand-name span { color: var(--gold); }
        .navbar-nav {
            display: flex; align-items: center; gap: .25rem;
        }
        .nav-link {
            color: rgba(255,255,255,.75);
            text-decoration: none;
            padding: .5rem 1rem;
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 500;
            transition: all .2s;
            display: flex; align-items: center; gap: .45rem;
        }
        .nav-link:hover, .nav-link.active { color: var(--white); background: rgba(255,255,255,.1); }
        .nav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--gold);
            color: var(--navy);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .85rem;
            overflow: hidden;
        }
        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .btn-logout {
            background: rgba(220,38,38,.15);
            border: 1px solid rgba(220,38,38,.3);
            color: #FCA5A5;
            padding: .45rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: .85rem;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            transition: all .2s;
        }
        .btn-logout:hover { background: rgba(220,38,38,.25); color: #FEE2E2; }

        /* ── Page wrapper ──────────────────────────────────── */
        .page-wrapper { max-width: 1200px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* ── Alerts ────────────────────────────────────────── */
        .alert {
            padding: .85rem 1.25rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: .9rem;
            display: flex; align-items: flex-start; gap: .75rem;
            animation: slideDown .35s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background: #D1FAE5; color: #065F46; border-left: 4px solid #059669; }
        .alert-error   { background: #FEE2E2; color: #991B1B; border-left: 4px solid #DC2626; }
        .alert-warning { background: #FEF3C7; color: #92400E; border-left: 4px solid #D97706; }

        /* ── Card ──────────────────────────────────────────── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray200);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: var(--navy);
        }
        .card-body { padding: 2rem; }

        /* ── Form elements ─────────────────────────────────── */
        .form-group { margin-bottom: 1.25rem; }
        .form-row { display: grid; gap: 1.25rem; }
        .form-row-2 { grid-template-columns: 1fr 1fr; }
        .form-row-3 { grid-template-columns: 1fr 1fr 1fr; }
        @media(max-width:640px) {
            .form-row-2, .form-row-3 { grid-template-columns: 1fr; }
        }

        label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--gray600);
            margin-bottom: .4rem;
            letter-spacing: .03em;
            text-transform: uppercase;
        }
        .form-control {
            width: 100%;
            padding: .7rem 1rem;
            border: 1.5px solid var(--gray200);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--gray800);
            background: var(--white);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(11,29,58,.08);
        }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback {
            font-size: .78rem;
            color: var(--red);
            margin-top: .3rem;
            display: flex; align-items: center; gap: .3rem;
        }

        /* ── Buttons ───────────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .75rem 1.75rem;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s;
            letter-spacing: .02em;
        }
        .btn-primary {
            background: var(--navy);
            color: var(--white);
        }
        .btn-primary:hover { background: var(--navy2); transform: translateY(-1px); box-shadow: var(--shadow-md); }
        .btn-gold {
            background: var(--gold);
            color: var(--navy);
        }
        .btn-gold:hover { background: var(--gold2); transform: translateY(-1px); }
        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--gray200);
            color: var(--gray600);
        }
        .btn-outline:hover { border-color: var(--navy); color: var(--navy); background: var(--gray50); }
        .btn-danger {
            background: #FEE2E2;
            color: var(--red);
            border: 1.5px solid #FECACA;
        }
        .btn-danger:hover { background: #FCA5A5; }
        .btn-sm { padding: .45rem 1rem; font-size: .82rem; }
        .btn-full { width: 100%; justify-content: center; }

        /* ── Section divider ───────────────────────────────── */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--navy);
            padding-bottom: .65rem;
            border-bottom: 2px solid var(--gold);
            margin-bottom: 1.25rem;
            display: inline-block;
        }

        /* ── Badge ─────────────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .25rem .75rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .03em;
        }
        .badge-success { background: #D1FAE5; color: #065F46; }
        .badge-danger  { background: #FEE2E2; color: #991B1B; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-info    { background: #DBEAFE; color: #1D4ED8; }
        .badge-secondary { background: var(--gray100); color: var(--gray600); }

        /* ── Table ─────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        th {
            background: var(--gray50);
            padding: .75rem 1rem;
            text-align: left;
            font-size: .75rem;
            font-weight: 700;
            color: var(--gray600);
            letter-spacing: .06em;
            text-transform: uppercase;
            border-bottom: 2px solid var(--gray200);
        }
        td {
            padding: .875rem 1rem;
            border-bottom: 1px solid var(--gray100);
            color: var(--gray800);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--gray50); }

        /* ── Stat Cards ────────────────────────────────────── */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            border-left: 4px solid var(--gold);
            display: flex; flex-direction: column; gap: .5rem;
        }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--navy); font-family: 'Playfair Display', serif; }
        .stat-label { font-size: .82rem; color: var(--gray400); font-weight: 500; letter-spacing: .04em; text-transform: uppercase; }
        .stat-icon { font-size: 1.5rem; }

        /* ── Profile photo ─────────────────────────────────── */
        .photo-upload-area {
            border: 2px dashed var(--gray200);
            border-radius: var(--radius);
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
        }
        .photo-upload-area:hover { border-color: var(--navy); background: var(--gray50); }
        .current-photo {
            width: 90px; height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gold);
            margin-bottom: .75rem;
        }

        /* ── Tab nav ───────────────────────────────────────── */
        .tab-nav {
            display: flex;
            gap: .25rem;
            border-bottom: 2px solid var(--gray200);
            margin-bottom: 2rem;
        }
        .tab-btn {
            padding: .75rem 1.5rem;
            border: none;
            background: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 500;
            color: var(--gray400);
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all .2s;
        }
        .tab-btn.active, .tab-btn:hover { color: var(--navy); border-bottom-color: var(--navy); }

        /* ── Decorative page header ────────────────────────── */
        .page-header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
            border-radius: var(--radius);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        .page-header::after {
            content: '';
            position: absolute;
            right: -40px; top: -40px;
            width: 220px; height: 220px;
            background: rgba(201,168,76,.12);
            border-radius: 50%;
        }
        .page-header::before {
            content: '';
            position: absolute;
            right: 60px; bottom: -60px;
            width: 160px; height: 160px;
            background: rgba(201,168,76,.08);
            border-radius: 50%;
        }
        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            margin-bottom: .3rem;
        }
        .page-header p { color: rgba(255,255,255,.65); font-size: .9rem; }
    </style>
    @stack('styles')
</head>
<body>

@auth('student')
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand">
        <div class="brand-icon">🎓</div>
        <span class="brand-name">Edu<span>Portal</span></span>
    </a>
    <div class="navbar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            ⊞ Dashboard
        </a>
        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
            ◉ Profile
        </a>
        <div style="width:1px; height:24px; background:rgba(255,255,255,.15); margin:0 .5rem;"></div>
        <div class="nav-avatar">
            @if(Auth::guard('student')->user()->profile_photo)
                <img src="{{ Storage::url(Auth::guard('student')->user()->profile_photo) }}" alt="Photo">
            @else
                {{ strtoupper(substr(Auth::guard('student')->user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::guard('student')->user()->last_name, 0, 1)) }}
            @endif
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout">↪ Logout</button>
        </form>
    </div>
</nav>
@endauth

<div class="page-wrapper">
    @if(session('success'))
        <div class="alert alert-success">✓ {!! session('success') !!}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    @yield('content')
</div>

@stack('scripts')
</body>
</html>