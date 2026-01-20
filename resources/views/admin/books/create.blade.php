<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Judul Buku</label>
                            <input type="text" name="title"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Penulis</label>
                            <input type="text" name="author"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Penerbit</label>
                            <input type="text" name="publisher"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Kategori</label>
                            <input type="text" name="category"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tahun Terbit</label>
                            <input type="number" name="year"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Stok</label>
                            <input type="number" name="stock"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="0" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Cover (opsional)</label>
                            <input type="file" name="cover"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('admin.books.index') }}"
                                class="mr-2 px-4 py-2 bg-gray-300 rounded">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>