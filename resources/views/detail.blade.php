<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Buku - LoansBooks</title>
    <link rel="stylesheet" href="{{ asset('assets/detail.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="image/logo.png" alt="LoansBooks" />
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('index') }}">Beranda</a></li>
            <li><a href="{{ route('katalog') }}">Katalog</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#" class="btn-signin">Sign In</a></li>
        </ul>
    </nav>

    <!-- Back Button -->
    <div class="main-wrapper">
        <div class="back-section">
            <a href="{{ route('katalog') }}" class="back-btn">Kembali</a>
        </div>

        <div class="detail-container"></div>
    </div>

    <!-- Detail Book Section -->
    <main class="detail-container">
        <div class="detail-card">
            <!-- Book Image -->
            <div class="book-image-section">
                <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://via.placeholder.com/280x320?text=' . urlencode($book->title) }}"
                    alt="{{ $book->title }}" class="book-cover" />
            </div>

            <!-- Book Info -->
            <div class="book-info-section">
                <h1 class="book-title">{{ $book->title }}</h1>

                <div class="book-meta">
                    <div class="meta-item">
                        <span class="meta-label">Penulis</span>
                        <span class="meta-value">{{ $book->author ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Penerbit</span>
                        <span class="meta-value">{{ $book->publisher ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Kategori</span>
                        <span class="meta-value">{{ $book->category ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Tahun Terbit</span>
                        <span class="meta-value">{{ $book->publication_year ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Stok</span>
                        <span class="meta-value">{{ $book->stock }}</span>
                    </div>
                </div>

                <div class="book-description">
                    <h3>Deskripsi</h3>
                    <p>{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                @if($book->stock > 0)
                    <form action="{{ route('student.loans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="borrow-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Pinjam Buku
                        </button>
                    </form>
                @else
                    <button class="borrow-btn bg-gray-400 cursor-not-allowed" disabled>Stok Habis</button>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>All Rights Reserved • Copyright LoansBooks by SaksiPembayun 2025</p>
    </footer>

    <script src="{{ asset('assets/detail.js') }}"></script>
</body>

</html>