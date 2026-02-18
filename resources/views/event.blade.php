<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #fce7f3 0%, #fdf2f8 50%, #fce7f3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Pink glow top-right */
        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(236,72,153,0.15) 0%, transparent 65%);
            top: -150px; right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        /* Rose glow bottom-left */
        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(251,113,133,0.1) 0%, transparent 65%);
            bottom: -100px; left: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            position: relative; z-index: 1;
            width: 400px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(251,182,206,0.5);
            border-radius: 28px;
            padding: 44px;
            box-shadow:
                0 2px 4px rgba(236,72,153,0.06),
                0 16px 56px rgba(236,72,153,0.12),
                inset 0 1px 0 rgba(255,255,255,0.9);
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
            color: #db2777;
            background: rgba(236,72,153,0.08);
            border: 1px solid rgba(236,72,153,0.2);
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .tag::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #ec4899;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            color: #831843;
            line-height: 1.15;
        }

        .subtitle {
            font-size: 12px;
            color: #f9a8d4;
            margin-top: 6px;
            font-style: italic;
        }

        .icon-wrap {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #fbcfe8, #f9a8d4);
            border: 1px solid rgba(236,72,153,0.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(236,72,153,0.15);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, rgba(236,72,153,0.3), rgba(236,72,153,0.06), transparent);
            margin: 0 0 28px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 10px;
            background: rgba(253,242,248,0.8);
            border: 1px solid rgba(251,182,206,0.4);
            transition: background 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .field:nth-child(1) { animation-delay: 0.12s; }
        .field:nth-child(2) { animation-delay: 0.20s; }
        .field:nth-child(3) { animation-delay: 0.28s; }
        .field:last-child { margin-bottom: 0; }

        .field:hover {
            background: rgba(251,207,232,0.6);
            border-color: rgba(236,72,153,0.3);
            transform: translateX(3px);
        }

        .field-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #f9a8d4;
            font-weight: 500;
        }

        .field-value {
            font-size: 15px;
            font-weight: 500;
            color: #9d174d;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="tag">Event Registration</div>
                <h1>Event<br>Registration</h1>
                <p class="subtitle">School event participant details</p>
            </div>
            <div class="icon-wrap">🎟️</div>
        </div>
        <div class="divider"></div>
        <div class="field">
            <span class="field-label">Event Name</span>
            <span class="field-value">{{ $event }}</span>
        </div>
        <div class="field">
            <span class="field-label">Participant</span>
            <span class="field-value">{{ $participant }}</span>
        </div>
        <div class="field">
            <span class="field-label">Year Level</span>
            <span class="field-value">{{ $year }}</span>
        </div>
    </div>
</body>
</html>