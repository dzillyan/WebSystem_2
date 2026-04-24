<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gellie Anne Costales — Edit Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream: #faf8f4; --ink: #1a1612; --warm: #8b6914; --accent: #c8860a;
            --soft: #f0ebe0; --border: #ddd5c0; --muted: #7a7060; --danger: #c0392b;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--ink); min-height: 100vh; }

        /* Topbar */
        .topbar { background: var(--ink); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; height: 60px; position: sticky; top: 0; z-index: 50; }
        .topbar-brand { font-family: 'Playfair Display', serif; color: #f0ebe0; font-size: 1.15rem; letter-spacing: 0.02em; display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .topbar-nav { display: flex; gap: 1.5rem; }
        .topbar-nav a { color: #a89878; font-size: 0.82rem; text-decoration: none; letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; transition: color 0.2s; }
        .topbar-nav a:hover, .topbar-nav a.active { color: #f0ebe0; }

        /* Hero */
        .hero { background: var(--ink); padding: 2.5rem 2rem 3.5rem; position: relative; }
        .hero::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 40px; background: var(--cream); border-radius: 40px 40px 0 0; }
        .hero-label { font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: #8b6914; font-weight: 500; margin-bottom: 0.75rem; }
        .hero-title { font-family: 'Playfair Display', serif; color: #faf8f4; font-size: 2.4rem; line-height: 1.15; margin-bottom: 0.75rem; }
        .hero-sub { color: #a89878; font-size: 0.92rem; line-height: 1.6; max-width: 420px; }

        /* Content */
        .content { padding: 2rem; max-width: 960px; margin: 0 auto; width: 100%; }

        /* Form Card */
        .form-card { background: white; border: 0.5px solid var(--border); border-radius: 14px; padding: 2rem; max-width: 520px; }
        .form-card-title { font-family: 'Playfair Display', serif; font-size: 1.35rem; margin-bottom: 0.25rem; color: var(--ink); }
        .form-card-sub { font-size: 0.83rem; color: var(--muted); margin-bottom: 1.75rem; }

        /* Editing Banner */
        .editing-banner { display: flex; align-items: center; gap: 10px; background: var(--soft); border: 0.5px solid var(--border); border-radius: 8px; padding: 10px 14px; margin-bottom: 1.5rem; font-size: 0.82rem; color: var(--warm); }
        .editing-banner strong { color: var(--ink); font-weight: 500; }

        /* Form Elements */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.78rem; font-weight: 500; color: var(--muted); margin-bottom: 6px; letter-spacing: 0.04em; text-transform: uppercase; }
        .form-control { width: 100%; background: var(--cream); border: 0.5px solid var(--border); border-radius: 8px; padding: 10px 13px; font-size: 0.88rem; font-family: 'DM Sans', sans-serif; color: var(--ink); outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { border-color: #a89878; background: white; box-shadow: 0 0 0 3px rgba(200,134,10,0.08); }
        .form-control.is-invalid { border-color: #f5c6c3; }
        .form-error { font-size: 0.78rem; color: var(--danger); margin-top: 5px; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; cursor: pointer; text-decoration: none; border: none; transition: background 0.2s, color 0.2s; justify-content: center; }
        .btn-primary { background: var(--ink); color: #f0ebe0; }
        .btn-primary:hover { background: #2d2820; }
        .btn-secondary { background: transparent; color: var(--muted); border: 0.5px solid var(--border); }
        .btn-secondary:hover { background: var(--soft); color: var(--ink); }

        .form-actions { display: flex; gap: 10px; margin-top: 1.75rem; }
        .form-actions .btn { flex: 1; }

        /* Footer */
        .footer { text-align: center; padding: 2rem; color: var(--muted); font-size: 0.78rem; margin-top: 3rem; border-top: 0.5px solid var(--border); }

        @media (max-width: 600px) {
            .topbar { padding: 0 1rem; }
            .hero-title { font-size: 1.8rem; }
            .content { padding: 1.25rem; }
        }
    </style>
</head>
<body>

<header class="topbar">
    <a href="{{ route('books.index') }}" class="topbar-brand">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#c8860a" stroke-width="1.8">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
        Gellie Anne Costales
    </a>
    <nav class="topbar-nav">
        <a href="{{ route('books.index') }}">Collection</a>
        <a href="{{ route('books.create') }}" class="active">Add Book</a>
    </nav>
</header>

<div class="hero">
    <div>
        <div class="hero-label">Book Management System</div>
        <div class="hero-title">Edit Book</div>
        <div class="hero-sub">Update the details for this title in your collection.</div>
    </div>
</div>

<main class="content">
    <div class="form-card">
        <div class="form-card-title">Edit Book Details</div>
        <div class="form-card-sub">Changes will be saved immediately to your collection.</div>

        <div class="editing-banner">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Editing: <strong>{{ $book->title }}</strong>
        </div>

        <form action="{{ route('books.update', $book->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="e.g. The Great Gatsby" autofocus>
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="author">Author</label>
                <input class="form-control @error('author') is-invalid @enderror" type="text" id="author" name="author" value="{{ old('author', $book->author) }}" placeholder="e.g. F. Scott Fitzgerald">
                @error('author')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="published_date">Published Date</label>
                <input class="form-control @error('published_date') is-invalid @enderror" type="date" id="published_date" name="published_date" value="{{ old('published_date', \Carbon\Carbon::parse($book->published_date)->format('Y-m-d')) }}">
                @error('published_date')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Update Book
                </button>
            </div>
        </form>
    </div>
</main>

<footer class="footer">
    &copy; {{ date('Y') }} Gellie Anne Costales — Book Collection
</footer>

</body>
</html>