<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px 50px;
            width: 420px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e94560, #0f3460);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 15px;
            color: #fff;
        }

        .card-header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .card-header p {
            color: #a0aec0;
            font-size: 13px;
            margin-top: 5px;
        }

        .divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 0 0 30px;
        }

        .info-row {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .info-icon {
            font-size: 22px;
            margin-right: 16px;
        }

        .info-label {
            color: #a0aec0;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .info-value {
            color: #ffffff;
            font-size: 17px;
            font-weight: 600;
            margin-top: 2px;
        }

        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #e94560, #c0392b);
            color: #fff;
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="avatar">&#128100;</div>
            <h1>Student Profile</h1>
            <p>Basic Student Information</p>
        </div>
        <hr class="divider">

        <div class="info-row">
            <span class="info-icon">&#127380;</span>
            <div>
                <div class="info-label">Student ID</div>
                <div class="info-value">{{ $id }}</div>
            </div>
        </div>

        <div class="info-row">
            <span class="info-icon">&#128100;</span>
            <div>
                <div class="info-label">Student Name</div>
                <div class="info-value">{{ $name }}</div>
                <span class="badge">Enrolled</span>
            </div>
        </div>
    </div>
</body>
</html>