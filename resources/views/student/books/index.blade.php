<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Katalog Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 bg-white p-6 rounded-xl shadow border border-gray-100">
                <form method="GET" class="flex flex-col md:flex-row gap-4">

                    <div class="flex-grow relative">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari judul atau penulis..."
                               class="w-full pl-10 pr-4 py-2 rounded-lg border focus:ring-2 focus:ring-purple-500">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            
                        </div>
                    </div>

                    <div class="w-full md:w-48">
                        <select name="category"
                                class="w-full rounded-lg border focus:ring-2 focus:ring-purple-500">
                            <option value="Semua">Semua Kategori</option>
                            @foreach(['Novel','Pelajaran','Komik','Ensiklopedia'] as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold">
                        Cari
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @forelse($books as $book)
                    <div
                        class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden transition hover:shadow-2xl hover:-translate-y-1 flex flex-col">

                        <a href="{{ route('student.books.show', $book->id) }}"
                           class="relative h-64 overflow-hidden bg-gray-100">
                            @if($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="h-full flex items-center justify-center text-gray-400">
                                    No Cover
                                </div>
                            @endif

                            <span
                                class="absolute top-3 right-3 px-3 py-1 bg-white/90 text-xs font-bold rounded-full text-purple-600 shadow">
                                {{ $book->category }}
                            </span>
                        </a>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-bold text-lg line-clamp-2 mb-1 min-h-[3.5rem]">
                                {{ $book->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mb-4">
                                {{ $book->author }}
                            </p>

                            <div class="mt-auto">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <span class="text-xs text-gray-400">Stok</span>
                                        <div
                                            class="font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $book->stock }} Buku
                                        </div>
                                    </div>

                                    @if($book->publication_year)
                                        <span class="text-xs text-gray-400">
                                            {{ $book->publication_year }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('student.books.show', $book->id) }}"
                                   class="block text-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 rounded-xl transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center text-gray-500">
                        Buku tidak ditemukan
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
