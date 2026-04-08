<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login — EduPortal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0B1D3A; --navy2: #142850; --gold: #C9A84C; --gold2: #E8C46A;
            --cream: #F8F4EE; --white: #FFFFFF;
            --gray200: #E5E7EB; --gray400: #9CA3AF; --gray600: #4B5563; --gray800: #1F2937;
            --red: #DC2626;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--cream);
        }
        /* Left panel */
        .left-panel {
            flex: 1;
            background: linear-gradient(155deg, var(--navy) 0%, #1a3460 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem 3rem;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C9A84C' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .left-content { position: relative; z-index: 1; text-align: center; max-width: 380px; }
        .school-seal {
            width: 100px; height: 100px;
            background: rgba(201,168,76,.15);
            border: 2px solid rgba(201,168,76,.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.8rem;
            margin: 0 auto 2rem;
        }
        .left-content h1 {
            font-family: 'Playfair Display', serif;
            color: var(--white);
            font-size: 2.25rem;
            line-height: 1.25;
            margin-bottom: 1rem;
        }
        .left-content h1 span { color: var(--gold); }
        .left-content p { color: rgba(255,255,255,.6); font-size: .95rem; line-height: 1.7; }
        .divider-line {
            width: 50px; height: 3px;
            background: var(--gold);
            margin: 1.5rem auto;
            border-radius: 2px;
        }
        .feature-list { list-style: none; margin-top: 2rem; text-align: left; }
        .feature-list li {
            display: flex; align-items: center; gap: .75rem;
            color: rgba(255,255,255,.7);
            font-size: .88rem;
            padding: .4rem 0;
        }
        .feature-list li::before {
            content: '✓';
            width: 22px; height: 22px;
            background: rgba(201,168,76,.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: .75rem;
            flex-shrink: 0;
        }
        /* Right panel */
        .right-panel {
            width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
            background: var(--white);
        }
        .form-header { margin-bottom: 2.5rem; }
        .form-header h2 { font-family: 'Playfair Display', serif; font-size: 1.75rem; color: var(--navy); }
        .form-header p { color: var(--gray400); font-size: .9rem; margin-top: .35rem; }
        label {
            display: block; font-size: .78rem; font-weight: 600;
            color: var(--gray600); margin-bottom: .4rem;
            letter-spacing: .05em; text-transform: uppercase;
        }
        .form-group { margin-bottom: 1.25rem; }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: .85rem; top: 50%; transform: translateY(-50%);
            color: var(--gray400); font-size: 1rem; pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: .75rem 1rem .75rem 2.75rem;
            border: 1.5px solid var(--gray200);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            color: var(--gray800);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(11,29,58,.07); }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback { font-size: .78rem; color: var(--red); margin-top: .3rem; }
        .form-check { display: flex; align-items: center; gap: .5rem; }
        .form-check input { accent-color: var(--navy); }
        .form-check label { font-size: .85rem; color: var(--gray600); text-transform: none; letter-spacing: 0; font-weight: 400; margin: 0; }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
            padding: .85rem 1.75rem; border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: .9rem; font-weight: 600;
            cursor: pointer; border: none; width: 100%;
            transition: all .2s; letter-spacing: .03em;
        }
        .btn-primary { background: var(--navy); color: var(--white); }
        .btn-primary:hover { background: var(--navy2); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(11,29,58,.2); }
        .register-link {
            text-align: center; margin-top: 1.5rem;
            font-size: .88rem; color: var(--gray400);
        }
        .register-link a { color: var(--navy); font-weight: 600; text-decoration: none; }
        .register-link a:hover { color: var(--gold); }
        .alert {
            padding: .85rem 1.1rem; border-radius: 8px; margin-bottom: 1.5rem;
            font-size: .875rem; display: flex; align-items: flex-start; gap: .6rem;
            animation: slideDown .3s ease;
        }
        @keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:none; } }
        .alert-success { background: #D1FAE5; color: #065F46; border-left: 4px solid #059669; }
        .alert-error   { background: #FEE2E2; color: #991B1B; border-left: 4px solid #DC2626; }
        @media(max-width:860px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 2rem; }
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="left-content">
            <div class="school-seal">🎓</div>
            <h1>Student <span>Enrollment</span> Portal</h1>
            <div class="divider-line"></div>
            <p>Your gateway to academic excellence. Manage your enrollment, track your progress, and access your records securely.</p>
            <ul class="feature-list">
                <li>Secure student account management</li>
                <li>Real-time enrollment tracking</li>
                <li>Profile & document management</li>
                <li>Activity & audit log history</li>
            </ul>
        </div>
    </div>

    <div class="right-panel">
        <div class="form-header">
            <h2>Welcome Back</h2>
            <p>Sign in to your student account to continue</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <span class="input-icon">✉</span>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="your@email.edu.ph" value="{{ old('email') }}" autocomplete="email">
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Enter your password" autocomplete="current-password">
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign In →</button>
        </form>

        <div class="register-link">
            New student? <a href="{{ route('register') }}">Create an account</a>
        </div>
    </div>
</body>
</html>