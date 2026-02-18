<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #1e2a3a 0%, #243447 50%, #1a2535 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(99,102,241,0.18) 0%, transparent 65%);
            top: -150px; right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(56,189,248,0.1) 0%, transparent 65%);
            bottom: -100px; left: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            position: relative; z-index: 1;
            width: 400px;
            background: rgba(148,163,184,0.15);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(148,163,184,0.25);
            border-radius: 28px;
            padding: 44px;
            box-shadow:
                0 4px 6px rgba(0,0,0,0.15),
                0 20px 60px rgba(0,0,0,0.25),
                inset 0 1px 0 rgba(255,255,255,0.12);
            animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #c7d2fe;
            background: rgba(99,102,241,0.2);
            border: 1px solid rgba(99,102,241,0.35);
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .tag::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #a5b4fc;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            color: #f1f5f9;
            line-height: 1.15;
        }

        .subtitle {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
            font-style: italic;
        }

        .icon-wrap {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, rgba(99,102,241,0.35), rgba(139,92,246,0.35));
            border: 1px solid rgba(99,102,241,0.35);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, rgba(148,163,184,0.4), rgba(148,163,184,0.1), transparent);
            margin: 0 0 28px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 10px;
            background: rgba(30,42,58,0.5);
            border: 1px solid rgba(148,163,184,0.15);
            transition: background 0.2s ease, transform 0.2s ease;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .field:nth-child(1) { animation-delay: 0.15s; }
        .field:nth-child(2) { animation-delay: 0.25s; }
        .field:last-child { margin-bottom: 0; }
        .field:hover {
            background: rgba(99,102,241,0.15);
            border-color: rgba(99,102,241,0.3);
            transform: translateX(3px);
        }

        .field-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 500;
        }

        .field-value {
            font-size: 15px;
            font-weight: 500;
            color: #e2e8f0;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="tag">Student Profile</div>
                <h1>Student<br>Information</h1>
                <p class="subtitle">Basic profile details retrieved from URL</p>
            </div>
            <div class="icon-wrap">🎓</div>
        </div>
        <div class="divider"></div>
        <div class="field">
            <span class="field-label">Student ID</span>
            <span class="field-value">{{ $id }}</span>
        </div>
        <div class="field">
            <span class="field-label">Student Name</span>
            <span class="field-value">{{ $name }}</span>
        </div>
    </div>
</body>
</html>