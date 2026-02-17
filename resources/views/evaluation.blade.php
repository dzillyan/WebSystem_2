<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Evaluation System</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    @csrf
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #0f0e0d;
            --paper:     #f5f0e8;
            --cream:     #ede8dc;
            --rule:      #c8bfa8;
            --accent:    #c94f2c;
            --gold:      #b8962e;
            --pass:      #2a6e4a;
            --fail:      #8b1a1a;
            --mono:      'DM Mono', monospace;
            --serif:     'Playfair Display', Georgia, serif;
        }

        body {
            background-color: var(--paper);
            color: var(--ink);
            font-family: var(--mono);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Ledger line background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: repeating-linear-gradient(
                transparent,
                transparent 31px,
                var(--rule) 31px,
                var(--rule) 32px
            );
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        /* Red margin line */
        body::after {
            content: '';
            position: fixed;
            left: 80px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: rgba(201, 79, 44, 0.25);
            pointer-events: none;
            z-index: 0;
        }

        .wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 680px;
        }

        /* ── HEADER ── */
        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header-stamp {
            display: inline-block;
            border: 3px double var(--accent);
            padding: 0.2rem 1.2rem;
            font-size: 0.65rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.75rem;
        }

        .header h1 {
            font-family: var(--serif);
            font-size: clamp(2rem, 6vw, 3rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.01em;
        }

        .header-sub {
            font-size: 0.7rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--rule);
            margin-top: 0.5rem;
        }

        /* ── CARD ── */
        .card {
            background: var(--cream);
            border: 1.5px solid var(--rule);
            border-radius: 2px;
            padding: 2rem 2.5rem;
            box-shadow:
                4px 4px 0 var(--rule),
                8px 8px 0 rgba(0,0,0,0.06);
        }

        /* ── FORM ── */
        .form-section-label {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
            padding-bottom: 0.4rem;
            border-bottom: 1px solid var(--rule);
        }

        .field-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6b6050;
            margin-bottom: 0.4rem;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1.5px solid var(--ink);
            padding: 0.5rem 0;
            font-family: var(--serif);
            font-size: 1.1rem;
            color: var(--ink);
            outline: none;
            transition: border-color 0.2s;
            border-radius: 0;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-bottom-color: var(--accent);
        }

        input[type="number"] {
            font-family: var(--mono);
            font-size: 1rem;
        }

        .grades-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1.5rem;
        }

        .formula-note {
            font-size: 0.65rem;
            color: #9a8f80;
            margin-top: 0.5rem;
            font-style: italic;
        }

        /* ── SUBMIT BUTTON ── */
        .btn-submit {
            display: block;
            width: 100%;
            margin-top: 2rem;
            padding: 0.9rem;
            background: var(--ink);
            color: var(--paper);
            font-family: var(--mono);
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            position: relative;
        }

        .btn-submit:hover  { background: var(--accent); }
        .btn-submit:active { transform: translate(2px, 2px); }

        /* ── DIVIDER ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            color: var(--rule);
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--rule);
        }

        /* ── RESULTS PANEL ── */
        .results {
            animation: fadeSlide 0.4s ease both;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .result-student {
            font-family: var(--serif);
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .result-meta {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #9a8f80;
            margin-bottom: 1.5rem;
        }

        /* Score breakdown table */
        .score-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .score-table th {
            text-align: left;
            font-size: 0.6rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #9a8f80;
            padding: 0.4rem 0.5rem;
            border-bottom: 1px solid var(--rule);
        }

        .score-table td {
            padding: 0.5rem 0.5rem;
            border-bottom: 1px dashed var(--rule);
        }

        .score-table .score-val {
            text-align: right;
            font-family: var(--mono);
            font-size: 0.9rem;
        }

        .score-table .average-row {
            font-weight: 700;
            border-top: 2px solid var(--ink);
            border-bottom: none;
        }

        .score-table .average-row td {
            border-bottom: none;
            padding-top: 0.7rem;
        }

        /* Badge row */
        .badge-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .badge {
            border: 1.5px solid var(--rule);
            padding: 0.8rem 0.6rem;
            text-align: center;
        }

        .badge-label {
            font-size: 0.55rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #9a8f80;
            display: block;
            margin-bottom: 0.4rem;
        }

        .badge-value {
            font-family: var(--serif);
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        /* Remarks banner */
        .remarks-banner {
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .remarks-banner.passed {
            background: rgba(42, 110, 74, 0.1);
            border: 1.5px solid var(--pass);
            color: var(--pass);
        }

        .remarks-banner.failed {
            background: rgba(139, 26, 26, 0.08);
            border: 1.5px solid var(--fail);
            color: var(--fail);
        }

        .remarks-word {
            font-family: var(--serif);
            font-size: 1.4rem;
            font-weight: 700;
        }

        .remarks-rule {
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            opacity: 0.7;
        }

        /* Award banner */
        .award-banner {
            background: rgba(184, 150, 46, 0.12);
            border: 1.5px solid var(--gold);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #7a6010;
        }

        .award-banner .award-icon { font-size: 1.4rem; }

        .award-banner .award-text {
            font-family: var(--serif);
            font-size: 1rem;
            font-weight: 700;
        }

        .award-banner.no-award {
            background: var(--cream);
            border-color: var(--rule);
            color: #9a8f80;
        }

        /* ── RE-EVALUATE BTN ── */
        .btn-reset {
            display: inline-block;
            margin-top: 1.5rem;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
            text-decoration: none;
            border-bottom: 1px solid var(--accent);
            padding-bottom: 2px;
        }

        /* ── VALIDATION ERRORS ── */
        .error-box {
            background: rgba(139,26,26,0.07);
            border: 1.5px solid var(--fail);
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.78rem;
            color: var(--fail);
        }

        .error-box ul { padding-left: 1.2rem; margin-top: 0.3rem; }
        .error-box li { margin-bottom: 0.2rem; }

        /* ── REFERENCE TABLE ── */
        .ref-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2.5rem;
            font-size: 0.68rem;
        }

        .ref-block h4 {
            font-size: 0.58rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
            padding-bottom: 0.3rem;
            border-bottom: 1px solid var(--rule);
        }

        .ref-block table { width: 100%; border-collapse: collapse; }
        .ref-block td { padding: 0.2rem 0; color: #5a5040; }
        .ref-block td:last-child { text-align: right; color: var(--ink); font-family: var(--mono); }

        @media (max-width: 540px) {
            .card { padding: 1.5rem; }
            .grades-row { grid-template-columns: 1fr; gap: 1rem; }
            .badge-row  { grid-template-columns: 1fr 1fr; }
            .ref-grid   { grid-template-columns: 1fr; }
            body::after { display: none; }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <header class="header">
        <div class="header-stamp">Academic Record Office</div>
        <h1>Grade Evaluation<br>System</h1>
        <p class="header-sub">Route: /evaluation &nbsp;·&nbsp; Single Route · GET / POST</p>
    </header>

    <div class="card">

        {{-- ═══════════════════════════════════════════════════════
             BLADE CONDITIONAL: show results ONLY after submission
        ════════════════════════════════════════════════════════════ --}}

        @if(isset($submitted) && $submitted)

            {{-- ── RESULTS SECTION ── --}}
            <div class="results">
                <p class="form-section-label">Evaluation Results</p>

                <p class="result-student">{{ $student_name }}</p>
                <p class="result-meta">Academic Performance Report &nbsp;·&nbsp; Computed via /evaluation</p>

                {{-- Score breakdown --}}
                <table class="score-table">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th class="score-val">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Preliminary</td>
                            <td class="score-val">{{ number_format($prelim, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Midterm</td>
                            <td class="score-val">{{ number_format($midterm, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Final</td>
                            <td class="score-val">{{ number_format($final, 2) }}</td>
                        </tr>
                        <tr class="average-row">
                            <td>Average &nbsp;<span style="font-size:0.7rem;font-weight:400;opacity:0.6">(Prelim + Midterm + Final) / 3</span></td>
                            <td class="score-val">{{ number_format($average, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Badges: Letter Grade, Remarks hint, Average --}}
                <div class="badge-row">
                    <div class="badge">
                        <span class="badge-label">Letter Grade</span>
                        <span class="badge-value">{{ $letterGrade }}</span>
                    </div>
                    <div class="badge">
                        <span class="badge-label">Average</span>
                        <span class="badge-value" style="font-size:1.2rem">{{ number_format($average, 2) }}</span>
                    </div>
                    <div class="badge">
                        <span class="badge-label">Award</span>
                        <span class="badge-value" style="font-size:0.75rem;line-height:1.3">{{ $award }}</span>
                    </div>
                </div>

                {{-- Remarks Banner (Blade conditional) --}}
                @if($remarks === 'Passed')
                    <div class="remarks-banner passed">
                        <span class="remarks-word">✓ &nbsp;Passed</span>
                        <span class="remarks-rule">Average ≥ 75</span>
                    </div>
                @else
                    <div class="remarks-banner failed">
                        <span class="remarks-word">✗ &nbsp;Failed</span>
                        <span class="remarks-rule">Average &lt; 75</span>
                    </div>
                @endif

                {{-- Award Banner (Blade conditional) --}}
                @if($award !== 'No Award')
                    <div class="award-banner">
                        <span class="award-icon">🏅</span>
                        <div>
                            <div class="award-text">{{ $award }}</div>
                            <div style="font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;opacity:0.7;margin-top:0.2rem">
                                @if($average >= 98)
                                    Average: 98 – 100
                                @elseif($average >= 95)
                                    Average: 95 – 97
                                @elseif($average >= 90)
                                    Average: 90 – 94
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="award-banner no-award">
                        <span class="award-icon">—</span>
                        <div>
                            <div class="award-text" style="font-family:var(--mono);font-size:0.85rem">No Award</div>
                            <div style="font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;margin-top:0.2rem">Average below 90</div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('evaluation') }}" class="btn-reset">← Evaluate Another Student</a>
            </div>

        @else

            {{-- ═══════════════════════════════════════════════════
                 FORM SECTION — shown before submission
            ════════════════════════════════════════════════════════ --}}

            {{-- Validation errors --}}
            @if($errors->any())
                <div class="error-box">
                    <strong>Please correct the following:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('evaluation') }}" novalidate>
                @csrf

                <p class="form-section-label">Student Information</p>

                <div class="field-group">
                    <label for="student_name">Full Name</label>
                    <input type="text"
                           id="student_name"
                           name="student_name"
                           value="{{ old('student_name') }}"
                           placeholder="e.g. Juan dela Cruz"
                           autocomplete="off"
                           required>
                </div>

                <div class="divider">Grade Components</div>

                <div class="grades-row">
                    <div class="field-group">
                        <label for="prelim">Preliminary</label>
                        <input type="number"
                               id="prelim"
                               name="prelim"
                               value="{{ old('prelim') }}"
                               min="0" max="100" step="0.01"
                               placeholder="0 – 100"
                               required>
                    </div>
                    <div class="field-group">
                        <label for="midterm">Midterm</label>
                        <input type="number"
                               id="midterm"
                               name="midterm"
                               value="{{ old('midterm') }}"
                               min="0" max="100" step="0.01"
                               placeholder="0 – 100"
                               required>
                    </div>
                    <div class="field-group">
                        <label for="final">Final</label>
                        <input type="number"
                               id="final"
                               name="final"
                               value="{{ old('final') }}"
                               min="0" max="100" step="0.01"
                               placeholder="0 – 100"
                               required>
                    </div>
                </div>

                <p class="formula-note">Average = (Prelim + Midterm + Final) / 3</p>

                <button type="submit" class="btn-submit">Evaluate Student →</button>
            </form>

            {{-- Reference tables --}}
            <div class="ref-grid">
                <div class="ref-block">
                    <h4>Letter Grade Scale</h4>
                    <table>
                        <tr><td>A</td><td>90 – 100</td></tr>
                        <tr><td>B</td><td>80 – 89</td></tr>
                        <tr><td>C</td><td>70 – 79</td></tr>
                        <tr><td>D</td><td>60 – 69</td></tr>
                        <tr><td>F</td><td>Below 60</td></tr>
                    </table>
                </div>
                <div class="ref-block">
                    <h4>Remarks &amp; Awards</h4>
                    <table>
                        <tr><td>Passed</td><td>≥ 75</td></tr>
                        <tr><td>Failed</td><td>&lt; 75</td></tr>
                        <tr><td colspan="2" style="padding-top:0.5rem;opacity:0.4">────</td></tr>
                        <tr><td>Highest Honors</td><td>98–100</td></tr>
                        <tr><td>High Honors</td><td>95–97</td></tr>
                        <tr><td>Honors</td><td>90–94</td></tr>
                        <tr><td>No Award</td><td>&lt; 90</td></tr>
                    </table>
                </div>
            </div>

        @endif

    </div>{{-- /card --}}
</div>{{-- /wrapper --}}

</body>
</html>