<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>LoansBooks</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"
        href="{{ asset('assets/style.css') }}" />
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="image/logo.png" alt="" />
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('index') }}" class="active">Beranda</a></li>
            <li><a href="{{ route('katalog') }}">Katalog</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#" class="btn-signin" style="color: white">Sign In</a></li>
        </ul>
    </nav>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Selamat Datang di <span class="d-block">LoansBooks</span></h1>
                <p>
                    “Jelajahi ratusan buku dari berbagai kategori dengan cepat dan
                    mudah.”
                </p>
                <div class="hero-buttons">
                    <a href="#catalog" class="btn-primary">Cari Buku</a>
                    <a href="katalog.html" class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        Jelajahi Katalog
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <img src="image/hero.png" alt="Students reading books 3D illustration" />
            </div>
        </section>

        <section class="catalog" id="catalog">
            <div class="catalog-header">
                <h2>Katalog Buku</h2>
                <p>Cari, lihat, dan jelajahi koleksi buku dengan mudah.</p>
            </div>

            <div id="book-list" class="book-grid">
                <!-- Books will be rendered here by JS -->
            </div>

            <div class="catalog-footer">
                <a href="katalog.html" class="btn-primary btn-centered">Lihat Daftar Buku</a>
            </div>
        </section>

        <section class="features">
            <div class="catalog-header">
                <h2>Keunggulan <span class="d-purple">LoansBooks</span></h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <h3>Mudah & Cepat</h3>
                    <p>
                        Pengguna dapat mencari dan meminjam buku secara online tanpa
                        proses rumit.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <h3>Koleksi Buku Lengkap</h3>
                    <p>
                        Tersedia berbagai kategori buku, dari akademik hingga bacaan umum.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3>Sistem Peminjaman Digital</h3>
                    <p>
                        Peminjaman tercatat otomatis, lengkap dengan status dan riwayat.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3>Dashboard User & Admin</h3>
                    <p>
                        Memiliki dashboard masing-masing untuk pengelolaan data yang rapi.
                    </p>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="stats-container">
                <div class="stats-image">
                    <img src="image/piala.png" alt="Statistics Illustration" />
                </div>
                <div class="stats-content">
                    <h2>
                        Jelajahi Dunia Buku <span class="d-block">dalam Satu Tempat</span>
                    </h2>
                    <p>
                        “Telusuri ratusan judul buku dengan tampilan yang rapi, cepat, dan
                        mudah digunakan.”
                    </p>

                    <div class="stat-items">
                        <div class="stat-item">
                            <div class="stat-icon purple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </div>
                            <div class="stat-text">
                                <h4>1.200+</h4>
                                <p>Koleksi Buku</p>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon purple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="stat-text">
                                <h4>320+</h4>
                                <p>Pengguna Pendaftar</p>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon purple">
                                <svg xmlns="http://www.w3.org/2001/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    <path d="M12 6v6l4 2"></path>
                                </svg>
                            </div>
                            <div class="stat-text">
                                <h4>450+</h4>
                                <p>Peminjaman Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>All Rights Reserved • Copyright LoansBooks by SaksiPambayun 2026</p>
    </footer>

    <script src="{{ asset('assets/main.js') }}"></script>
</body>

</html>