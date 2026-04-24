<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gellie Anne Costales — Book Collection</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream: #faf8f4; --ink: #1a1612; --warm: #8b6914; --accent: #c8860a;
            --soft: #f0ebe0; --border: #ddd5c0; --muted: #7a7060;
            --danger: #c0392b; --card: #ffffff;
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

        /* Alert */
        .alert { padding: 12px 16px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: #e8f5ee; color: #2d6a4f; border: 0.5px solid #a8d5b9; }

        /* Toolbar */
        .toolbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 10px; }
        .toolbar-left { display: flex; align-items: center; gap: 12px; }
        .count-badge { background: var(--soft); border: 0.5px solid var(--border); border-radius: 20px; padding: 4px 14px; font-size: 0.78rem; color: var(--muted); font-weight: 500; }
        .search-wrap { position: relative; }
        .search-wrap input { background: white; border: 0.5px solid var(--border); border-radius: 8px; padding: 7px 12px 7px 34px; font-size: 0.83rem; font-family: 'DM Sans', sans-serif; color: var(--ink); outline: none; width: 220px; transition: border-color 0.2s; }
        .search-wrap input:focus { border-color: #a89878; }
        .search-icon { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); opacity: 0.4; pointer-events: none; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; cursor: pointer; text-decoration: none; border: none; transition: background 0.2s, color 0.2s; }
        .btn-primary { background: var(--ink); color: #f0ebe0; }
        .btn-primary:hover { background: #2d2820; }
        .btn-secondary { background: transparent; color: var(--muted); border: 0.5px solid var(--border); }
        .btn-secondary:hover { background: var(--soft); color: var(--ink); }
        .btn-danger { background: transparent; color: var(--danger); border: 0.5px solid #f5c6c3; }
        .btn-danger:hover { background: #fff0ef; }

        /* Book Grid */
        .book-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1rem; }
        .book-card { background: white; border: 0.5px solid var(--border); border-radius: 12px; padding: 1.25rem; position: relative; transition: box-shadow 0.2s, transform 0.15s; }
        .book-card:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(26,22,18,0.09); }
        .book-spine { position: absolute; left: 0; top: 1rem; bottom: 1rem; width: 3px; border-radius: 0 2px 2px 0; }
        .book-num { font-size: 0.68rem; color: var(--muted); letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 8px; font-weight: 500; }
        .book-title { font-family: 'Playfair Display', serif; font-size: 1.05rem; color: var(--ink); line-height: 1.3; margin-bottom: 6px; font-weight: 600; }
        .book-author { font-size: 0.82rem; color: var(--muted); margin-bottom: 12px; display: flex; align-items: center; gap: 5px; }
        .book-author::before { content: ''; display: inline-block; width: 14px; height: 1px; background: var(--border); }
        .book-date { display: inline-flex; align-items: center; gap: 5px; background: var(--soft); border-radius: 6px; padding: 3px 9px; font-size: 0.73rem; color: var(--warm); font-weight: 500; }
        .book-actions { display: flex; gap: 6px; margin-top: 14px; padding-top: 12px; border-top: 0.5px solid var(--soft); }

        /* Empty State */
        .empty-state { text-align: center; padding: 4rem 2rem; color: var(--muted); }
        .empty-icon { font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.3; }
        .empty-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 0.4rem; color: var(--ink); }
        .empty-sub { font-size: 0.83rem; margin-bottom: 1.5rem; }

        /* Delete Modal */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(26,22,18,0.55); z-index: 100; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .del-box { background: white; border-radius: 14px; padding: 1.75rem; width: 100%; max-width: 360px; text-align: center; animation: slideUp 0.2s ease; }
        @keyframes slideUp { from { transform: translateY(14px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .del-icon { width: 44px; height: 44px; background: #fff0ef; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: var(--danger); }
        .del-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; margin-bottom: 0.4rem; }
        .del-msg { font-size: 0.82rem; color: var(--muted); margin-bottom: 1.25rem; line-height: 1.6; }
        .del-actions { display: flex; gap: 8px; }
        .btn-confirm-del { flex: 1; background: var(--danger); color: white; border: none; border-radius: 8px; padding: 10px; font-size: 0.83rem; font-family: 'DM Sans', sans-serif; font-weight: 500; cursor: pointer; }
        .btn-confirm-del:hover { background: #a93226; }

        /* Footer */
        .footer { text-align: center; padding: 2rem; color: var(--muted); font-size: 0.78rem; margin-top: 3rem; border-top: 0.5px solid var(--border); }

        @media (max-width: 600px) {
            .topbar { padding: 0 1rem; }
            .hero-title { font-size: 1.8rem; }
            .content { padding: 1.25rem; }
            .book-grid { grid-template-columns: 1fr; }
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
        <a href="{{ route('books.index') }}" class="active">Collection</a>
        <a href="{{ route('books.create') }}">Add Book</a>
    </nav>
</header>

<div class="hero">
    <div>
        <div class="hero-label">Book Management System</div>
        <div class="hero-title">Your Personal<br>Reading Collection</div>
        <div class="hero-sub">Manage, track, and organize every book in your library.</div>
    </div>
</div>

<main class="content">

    @if(session('success'))
        <div class="alert alert-success">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <div class="toolbar-left">
            <span class="count-badge">{{ $books->count() }} {{ Str::plural('book', $books->count()) }}</span>
            <div class="search-wrap">
                <svg class="search-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-input" placeholder="Search books or authors…" />
            </div>
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Add New Book
        </a>
    </div>

    @if($books->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">📚</div>
            <div class="empty-title">No books yet</div>
            <div class="empty-sub">Start building your collection by adding the first book.</div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add Your First Book</a>
        </div>
    @else
        @php $spineColors = ['#c8860a','#2d6a4f','#8b4513','#5b4a8a','#c0392b','#1a6b8a','#7a5c00','#4a5568']; @endphp
        <div class="book-grid" id="book-grid">
            @foreach($books as $index => $book)
            <div class="book-card" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}">
                <div class="book-spine" style="background: {{ $spineColors[$index % count($spineColors)] }}"></div>
                <div class="book-num">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="book-title">{{ $book->title }}</div>
                <div class="book-author">{{ $book->author }}</div>
                <div class="book-date">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($book->published_date)->format('M d, Y') }}
                </div>
                <div class="book-actions">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary" style="flex:1; justify-content:center; font-size:0.78rem; padding:6px 0;">Edit</a>
                    <button class="btn btn-danger" style="flex:1; justify-content:center; font-size:0.78rem; padding:6px 0;" onclick="openDeleteModal({{ $book->id }}, '{{ addslashes($book->title) }}')">Delete</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="empty-state" id="no-results" style="display:none;">
            <div class="empty-icon">🔍</div>
            <div class="empty-title">No results found</div>
            <div class="empty-sub">Try a different title or author name.</div>
        </div>
    @endif

</main>

<div class="modal-overlay" id="delete-modal">
    <div class="del-box">
        <div class="del-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
            </svg>
        </div>
        <div class="del-title">Remove this book?</div>
        <div class="del-msg" id="del-msg">This will permanently remove the book from your collection.</div>
        <div class="del-actions">
            <button class="btn btn-secondary" style="flex:1; justify-content:center;" onclick="closeDeleteModal()">Keep it</button>
            <form id="delete-form" method="POST" style="flex:1; display:contents;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm-del">Yes, remove</button>
            </form>
        </div>
    </div>
</div>

<footer class="footer">
    &copy; {{ date('Y') }} Gellie Anne Costales — Book Collection
</footer>

<script>
    const searchInput = document.getElementById('search-input');
    const cards = document.querySelectorAll('.book-card');
    const noResults = document.getElementById('no-results');
    searchInput && searchInput.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();
        let visible = 0;
        cards.forEach(card => {
            const match = !q || card.dataset.title.includes(q) || card.dataset.author.includes(q);
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (noResults) noResults.style.display = visible === 0 ? 'block' : 'none';
    });
    function openDeleteModal(id, title) {
        document.getElementById('del-msg').textContent = '"' + title + '" will be permanently removed from your collection.';
        document.getElementById('delete-form').action = '/books/' + id;
        document.getElementById('delete-modal').classList.add('open');
    }
    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.remove('open');
    }
    document.getElementById('delete-modal').addEventListener('click', function (e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
</body>
</html>