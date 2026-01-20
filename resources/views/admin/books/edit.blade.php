<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700">Judul Buku</label>
                            <input type="text" name="title" value="{{ old('title', $book->title) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Penulis</label>
                            <input type="text" name="author" value="{{ old('author', $book->author) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Kategori</label>
                            <input type="text" name="category" value="{{ old('category', $book->category) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tahun Terbit</label>
                            <input type="number" name="publication_year"
                                value="{{ old('publication_year', $book->publication_year) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="0" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Cover (opsional)</label>
                            <input type="file" name="cover"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @if($book->cover)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="cover"
                                        class="h-20 w-auto rounded shadow">
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('admin.books.index') }}"
                                class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>