<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Image Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            color: #2c3e50;
        }
        h1 {
            font-weight: 700;
            font-size: 2.5rem;
            background: linear-gradient(90deg, #ff6f61, #6a82fb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        h2 {
            font-weight: 600;
            color: #34495e;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            font-weight: 600;
            border-radius: 16px 16px 0 0;
        }
        .btn-primary {
            background-color: #6a82fb;
            border: none;
        }
        .btn-success {
            background-color: #00c9a7;
            border: none;
        }
        .btn-danger {
            background-color: #ff6f61;
            border: none;
        }
        .card-img-top {
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-img-top:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4 text-center">Gellie Anne Costales</h1>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Single Upload -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Single Image Upload</div>
        <div class="card-body">
            <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>

    <!-- Multiple Upload -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Multiple Images Upload</div>
        <div class="card-body">
            <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file" name="images[]" multiple class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Upload Multiple</button>
            </form>
        </div>
    </div>

    <!-- Gallery -->
    <h2 class="mb-3">Uploaded Images</h2>
    @if($photos->count() > 0)
        <div class="row">
            @foreach($photos as $photo)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 text-center p-2">
                        <img src="{{ asset('images/' . $photo->image) }}" class="card-img-top img-fluid" alt="Uploaded Image">
                        <div class="card-body">
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $photos->links() }}
        </div>
    @else
        <p class="text-muted">No images uploaded yet.</p>
    @endif
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
