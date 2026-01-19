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
                <img id="bookImage" src="" alt="Book Cover" class="book-cover" />
            </div>

            <!-- Book Info -->
            <div class="book-info-section">
                <h1 id="bookTitle" class="book-title">Hujan</h1>

                <div class="book-meta">
                    <div class="meta-item">
                        <span class="meta-label">Penulis</span>
                        <span id="bookAuthor" class="meta-value">Tere Liye</span>
                    </div>

                    <div class="meta-item">
                        <span class="meta-label">Penerbit</span>
                        <span id="bookPublisher" class="meta-value">
                            PT Gramedia Pustaka Utama
                        </span>
                    </div>

                    <div class="meta-item">
                        <span class="meta-label">Halaman</span>
                        <span id="bookPages" class="meta-value">456 Halaman</span>
                    </div>

                    <div class="meta-item">
                        <span class="meta-label">Tahun Terbit</span>
                        <span id="bookYear" class="meta-value">2025</span>
                    </div>
                </div>

                <div class="book-description">
                    <h3>Deskripsi</h3>
                    <p id="bookDescription">
                        Blurb novel "Hujan" karya Tere Liye berkesan menarik (at poche
                        yuktin point of rhose depar). Delun yang tenangnyo dengan
                        menggunakan gayo bohoson gont! (agu bahasa, tokoh-tokoh yang petuh
                        cinta peda'bab. kehidupannya di pengarangan. ruman bercecan.
                        hingget alkhirnya leren merepa olat dini kembali ke owal
                        cerita—darl darl iniloh, Laly remarahami bahwa teenangon menyimpan
                        atau mempentahanconnya di tengos kilati dan gebal yang mendecat
                        Bumi, di mana kout menjadi kunei pertocyanaan untuk manulia.
                    </p>
                </div>

                <button id="borrowBtn" class="borrow-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    456 Halaman
                </button>
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