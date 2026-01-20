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
            @auth
                <li><a href="{{ route('dashboard') }}" class="btn-signin">{{ Auth::user()->name }}</a></li>
            @else
                <li><a href="{{ route('login') }}" class="btn-signin">Sign In</a></li>
            @endauth
        </ul>
    </nav>

    <header class="text-center mt-16 mb-10">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Katalog Buku</h1>
        <p class="text-slate-500">
            Cari, lihat, dan jelajahi koleksi buku dengan mudah.
        </p>
    </header>

    <section class="max-w-4xl mx-auto px-4 mb-16">
        <form action="{{ route('katalog') }}" method="GET"
            class="bg-white p-4 rounded-xl shadow-sm flex flex-col md:flex-row gap-4 border border-slate-100">
            <input type="text" name="search" id="searchInput" placeholder="Cari..." value="{{ request('search') }}"
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 border-slate-200" />
            <select name="category" id="categorySelect"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 border-slate-200 bg-white">
                <option value="Semua" {{ request('category') == 'Semua' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="Novel" {{ request('category') == 'Novel' ? 'selected' : '' }}>Novel</option>
                <option value="Edukasi" {{ request('category') == 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                <option value="Fiksi" {{ request('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
            </select>
            <button type="submit" id="searchBtn"
                class="btn-purple text-white px-8 py-2 rounded-lg font-medium transition-all">
                Cari Buku
            </button>
        </form>
    </section>

    <main class="max-w-6xl mx-auto px-6 mb-20">
        <div id="bookGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($books as $book)
                <div class="book-card" data-category="{{ $book->category }}">
                    <a href="{{ route('detail', $book->id) }}" class="block hover:opacity-90 transition-all">
                        <div class="book-image-container">
                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : 'https://via.placeholder.com/280x320?text=' . urlencode($book->title) }}"
                                alt="{{ $book->title }}" class="book-image">
                            <div class="book-tag">{{ $book->category }}</div>
                        </div>
                    </a>
                    <div class="book-content-row">
                        <div class="book-text-col">
                            <a href="{{ route('detail', $book->id) }}" class="hover:underline">
                                <h3 class="book-title">{{ $book->title }}</h3>
                            </a>
                            <p class="book-desc">{{ Str::limit($book->author ?? 'Tanpa Penulis', 30) }}</p>
                            <p class="text-xs text-slate-500 mt-1">Penerbit: {{ $book->publisher ?? '-' }}</p>
                            <p class="text-xs text-slate-500">Tahun: {{ $book->publication_year ?? '-' }}</p>
                            <p class="text-sm font-bold text-purple-600 mt-2">Stok: {{ $book->stock }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <button onclick="openBorrowModal({{ $book->id }}, '{{ addslashes($book->title) }}')"
                                class="btn-arrow" title="Pinjam Buku">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div id="noResults" class="col-span-full text-center py-12">
                    <p class="text-slate-500 text-lg">Tidak ada buku ditemukan</p>
                    <a href="{{ route('katalog') }}" class="mt-4 btn-purple text-white px-6 py-2 rounded-lg inline-block">
                        Reset Pencarian
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </main>

    <div id="borrowModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        style="display: none;">
        <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Pinjam Buku</h2>
            <p id="modalBookTitle" class="text-purple-600 font-medium mb-6"></p>

            <form action="{{ route('student.loans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" id="modalBookId">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Durasi Pinjam (Hari)</label>
                    <select name="duration"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 bg-slate-50">
                        <option value="3">3 Hari</option>
                        <option value="7" selected>7 Hari (1 Minggu)</option>
                        <option value="14">14 Hari (2 Minggu)</option>
                    </select>
                    <p class="text-xs text-slate-500 mt-2">* Maksimal peminjaman adalah 14 hari.</p>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="closeBorrowModal()"
                        class="flex-1 px-6 py-3 border border-slate-200 rounded-xl font-medium text-slate-600 hover:bg-slate-50 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 btn-purple text-white rounded-xl font-medium shadow-lg shadow-purple-200 hover:shadow-purple-300 transition-all">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>All Rights Reserved • Copyright LoansBooks by SaksiPambayun 2026</p>
    </footer>

    <script>
        function openBorrowModal(id, title) {
            @if(Auth::check())
                document.getElementById('modalBookId').value = id;
                document.getElementById('modalBookTitle').textContent = title;
                document.getElementById('borrowModal').style.display = 'flex';
            @else
                window.location.href = "{{ route('login') }}";
            @endif
        }

        function closeBorrowModal() {
            document.getElementById('borrowModal').style.display = 'none';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('borrowModal');
            if (event.target == modal) {
                closeBorrowModal();
            }
        }
    </script>
    <script src="{{ asset('assets/katalog.js') }}"></script>
</body>

</html>