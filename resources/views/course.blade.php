<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #f0fdf4 40%, #dcfce7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Soft decorative blobs in the background */
        body::before {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(134,239,172,0.35) 0%, transparent 70%);
            top: -100px; right: -80px;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(74,222,128,0.2) 0%, transparent 70%);
            bottom: -60px; left: -60px;
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            position: relative; z-index: 1;
            width: 400px;
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.9);
            border-radius: 28px;
            padding: 44px;
            box-shadow:
                0 2px 4px rgba(0,0,0,0.03),
                0 12px 40px rgba(22,163,74,0.08),
                0 0 0 1px rgba(22,163,74,0.06);
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

        .header-left {}

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #16a34a;
            background: rgba(22,163,74,0.08);
            border: 1px solid rgba(22,163,74,0.18);
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .tag::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: #16a34a;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            color: #111;
            line-height: 1.15;
        }

        .icon-wrap {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #bbf7d0, #86efac);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(22,163,74,0.2);
        }

        .subtitle {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
            font-style: italic;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, rgba(22,163,74,0.15), rgba(22,163,74,0.05), transparent);
            margin: 0 0 28px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 10px;
            background: rgba(240,253,244,0.6);
            border: 1px solid rgba(187,247,208,0.5);
            transition: background 0.2s ease, transform 0.2s ease;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .field:nth-child(1) { animation-delay: 0.15s; }
        .field:nth-child(2) { animation-delay: 0.25s; }
        .field:last-child { margin-bottom: 0; }
        .field:hover { background: rgba(220,252,231,0.8); transform: translateX(3px); }

        .field-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #86a98a;
            font-weight: 500;
        }

        .field-value {
            font-size: 15px;
            font-weight: 500;
            color: #1a2e1c;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="header-left">
                <div class="tag">Enrollment</div>
                <h1>Course<br>Enrollment</h1>
                <p class="subtitle">Student course information</p>
            </div>
            <div class="icon-wrap">📚</div>
        </div>
        <div class="divider"></div>
        <div class="field">
            <span class="field-label">Course</span>
            <span class="field-value">{{ $course }}</span>
        </div>
        <div class="field">
            <span class="field-label">Year Level</span>
            <span class="field-value">{{ $year }}</span>
        </div>
    </div>
</body>
</html>