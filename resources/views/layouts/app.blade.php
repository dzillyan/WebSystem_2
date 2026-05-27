<!DOCTYPE html>
<html>
<head>
    <title>Student QR CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
        }
        .btn-success {
            background-color: #1cc88a;
            border: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('students.index') }}">Student Manager</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('students.create') }}">Add Student</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
