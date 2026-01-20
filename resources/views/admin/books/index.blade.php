<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Manajemen Buku</h3>
                        <a href="{{ route('admin.books.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Buku
                        </a>
                    </div>


                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        JudulBuku</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penulis</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penerbit</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kode Buku</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tahun Terbit</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Detail
                                    </th>
                                </tr>

                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($books as $book)
                                    <tr>
                                        {{-- KOLOM 1: JUDUL BUKU --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($book->cover)
                                                    <img class="h-12 w-10 object-cover rounded shadow-sm"
                                                        src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                                                @else
                                                    <div
                                                        class="h-10 w-8 bg-gray-200 mr-3 rounded flex items-center justify-center text-[8px] text-gray-400">
                                                        No Cover</div>
                                                @endif
                                                <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                                            </div>
                                        </td>

                                        {{-- KOLOM 2: PENULIS --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $book->author }}
                                        </td>

                                        {{-- KOLOM 3: PENERBIT --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $book->publisher }}
                                        </td>

                                        {{-- KOLOM 4: KATEGORI --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $book->category }}
                                        </td>

                                        {{-- KOLOM 5: KODE BUKU (ISBN) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $book->isbn ?? '-' }}
                                        </td>


                                        {{-- KOLOM 6: TAHUN TERBIT --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $book->publication_year }}
                                        </td>

                                        {{-- KOLOM 7: STOK --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $book->stock }}
                                        </td>

                                        {{-- KOLOM 7: DETAIL & AKSI --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('admin.books.show', $book) }}"
                                                    class="text-green-600 hover:text-green-900">Detail</a>
                                                <a href="{{ route('admin.books.edit', $book) }}"
                                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Belum ada koleksi buku.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>