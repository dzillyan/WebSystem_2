<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJT Company Information</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(145deg, #e8d5c4 0%, #edddd0 50%, #e4cfc0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Warm brown glow top-right */
        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(146,64,14,0.15) 0%, transparent 65%);
            top: -150px; right: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        /* Hint of pink glow bottom-left */
        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(190,100,80,0.12) 0%, transparent 65%);
            bottom: -100px; left: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            position: relative; z-index: 1;
            width: 400px;
            background: rgba(255, 248, 242, 0.72);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(146,64,14,0.18);
            border-radius: 28px;
            padding: 44px;
            box-shadow:
                0 2px 4px rgba(100,40,10,0.08),
                0 16px 56px rgba(100,40,10,0.14),
                inset 0 1px 0 rgba(255,255,255,0.85);
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
            color: #92400e;
            background: rgba(146,64,14,0.1);
            border: 1px solid rgba(146,64,14,0.22);
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .tag::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #b45309;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            color: #431407;
            line-height: 1.15;
        }

        .subtitle {
            font-size: 12px;
            color: #a8795a;
            margin-top: 6px;
            font-style: italic;
        }

        .icon-wrap {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #c8956c, #b07850);
            border: 1px solid rgba(146,64,14,0.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(146,64,14,0.2);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, rgba(146,64,14,0.3), rgba(146,64,14,0.08), transparent);
            margin: 0 0 28px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 10px;
            background: rgba(220,185,160,0.3);
            border: 1px solid rgba(146,64,14,0.14);
            transition: background 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .field:nth-child(1) { animation-delay: 0.1s; }
        .field:nth-child(2) { animation-delay: 0.18s; }
        .field:nth-child(3) { animation-delay: 0.26s; }
        .field:last-child { margin-bottom: 0; }

        .field:hover {
            background: rgba(200,149,108,0.25);
            border-color: rgba(146,64,14,0.28);
            transform: translateX(3px);
        }

        .field-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #a8795a;
            font-weight: 500;
        }

        .field-value {
            font-size: 15px;
            font-weight: 500;
            color: #431407;
            letter-spacing: 0.3px;
        }

        .pill-yes {
            font-size: 11px; font-weight: 600;
            color: #15803d;
            background: rgba(134,239,172,0.2);
            border: 1px solid rgba(134,239,172,0.5);
            padding: 5px 14px; border-radius: 100px;
        }

        .pill-no {
            font-size: 11px; font-weight: 600;
            color: #b91c1c;
            background: rgba(252,165,165,0.2);
            border: 1px solid rgba(252,165,165,0.5);
            padding: 5px 14px; border-radius: 100px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div>
                <div class="tag">OJT Placement</div>
                <h1>OJT Company<br>Information</h1>
                <p class="subtitle">On-the-job training placement</p>
            </div>
            <div class="icon-wrap">🏢</div>
        </div>
        <div class="divider"></div>
        <div class="field">
            <span class="field-label">Company Name</span>
            <span class="field-value">{{ $company }}</span>
        </div>
        <div class="field">
            <span class="field-label">City</span>
            <span class="field-value">{{ $city }}</span>
        </div>
        <div class="field">
            <span class="field-label">Allowance</span>
            @if(strtolower($allowance) === 'yes')
                <span class="pill-yes">Yes</span>
            @else
                <span class="pill-no">No</span>
            @endif
        </div>
    </div>
</body>
</html>