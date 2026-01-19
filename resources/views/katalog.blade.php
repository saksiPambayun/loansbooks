<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LoansBooks - Katalog Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/katalog.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="image/logo.png" alt="LoansBooks Logo" />
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('index') }}">Beranda</a></li>
            <li><a href="{{ route('katalog') }}" class="active">Katalog</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#" class="btn-signin">Sign In</a></li>
        </ul>
    </nav>

    <!-- Header Section -->
    <header class="text-center mt-16 mb-10">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Katalog Buku</h1>
        <p class="text-slate-500">
            Cari, lihat, dan jelajahi koleksi buku dengan mudah.
        </p>
    </header>

    <!-- Search & Filter Section -->
    <section class="max-w-4xl mx-auto px-4 mb-16">
        <div class="bg-white p-4 rounded-xl shadow-sm flex flex-col md:flex-row gap-4 border border-slate-100">
            <input type="text" id="searchInput" placeholder="Cari..."
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 border-slate-200" />
            <select id="categorySelect"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 border-slate-200 bg-white">
                <option value="Semua">Semua Kategori</option>
                <option value="Novel">Novel</option>
                <option value="Edukasi">Edukasi</option>
                <option value="Fiksi">Fiksi</option>
            </select>
            <button id="searchBtn" class="btn-purple text-white px-8 py-2 rounded-lg font-medium transition-all">
                Cari Buku
            </button>
        </div>
    </section>

    <!-- Book Grid Section -->
    <main class="max-w-6xl mx-auto px-6 mb-20">
        <div id="bookGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Books will be rendered here by JavaScript -->
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-12">
            <p class="text-slate-500 text-lg">Tidak ada buku ditemukan</p>
            <button id="resetBtn" class="mt-4 btn-purple text-white px-6 py-2 rounded-lg">
                Reset Pencarian
            </button>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>All Rights Reserved • Copyright LoansBooks by SaksiPambayun 2026</p>
    </footer>

    <script src="{{ asset('assets/katalog.js') }}"></script>
</body>

</html>