<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Detail Buku</h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow p-8 grid md:grid-cols-2 gap-8">

            <div>
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-[420px] object-cover rounded-xl">
                @else
                    <div class="h-[420px] bg-gray-100 flex items-center justify-center rounded-xl">
                        No Cover
                    </div>
                @endif
            </div>

            <div class="flex flex-col">
                <h1 class="text-2xl font-bold mb-2">{{ $book->title }}</h1>
                <p class="text-gray-500 mb-4">{{ $book->author }}</p>

                <div class="space-y-2 text-sm">
                    <p><b>Kategori:</b> {{ $book->category }}</p>
                    <p><b>Penerbit:</b> {{ $book->publisher }}</p>
                    <p><b>Tahun:</b> {{ $book->publication_year }}</p>
                    <p>
                        <b>Stok:</b>
                        <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $book->stock }}
                        </span>
                    </p>
                </div>

                <div class="mt-6">
                    @if($book->stock > 0)
                        <button onclick="openBorrowModal()" class="px-6 py-3 bg-purple-600 text-white rounded-xl font-bold">
                            Pinjam Buku
                        </button>
                    @else
                        <button disabled class="px-6 py-3 bg-gray-300 rounded-xl">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

   <div id="borrowModal" class="fixed inset-0 hidden z-50 flex items-center justify-center">

    <div class="absolute inset-0 bg-black/50" onclick="closeBorrowModal()"></div>

    <form method="POST"
          action="{{ route('student.loans.store') }}"
          class="relative bg-white rounded-2xl p-6 w-full max-w-md z-10">
        @csrf

        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <h3 class="text-lg font-bold mb-1">Pinjam Buku</h3>
        <p class="text-sm text-gray-500 mb-4">
            {{ $book->title }}
        </p>

        <div class="space-y-4">
            <div>
                <label class="text-sm">Tanggal Mulai</label>
                <input type="date"
                       name="start_date"
                       value="{{ now()->toDateString() }}"
                       class="w-full rounded-lg border px-3 py-2">
            </div>

            <div>
                <label class="text-sm">Tanggal Kembali</label>
                <input type="date"
                       name="end_date"
                       value="{{ now()->addDays(3)->toDateString() }}"
                       class="w-full rounded-lg border px-3 py-2">
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button type="button"
                    onclick="closeBorrowModal()"
                    class="px-4 py-2 border rounded-xl">
                Batal
            </button>
            <button type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-xl font-bold">
                Ajukan
            </button>
        </div>
    </form>
</div>

    <script>
        function openBorrowModal() {
            document.getElementById('borrowModal').classList.remove('hidden');
        }

        function closeBorrowModal() {
            document.getElementById('borrowModal').classList.add('hidden');
        }
    </script>
</x-app-layout>