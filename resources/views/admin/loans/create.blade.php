<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.loans.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih
                                Siswa</label>
                            <select name="student_id" id="student_id"
                                class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->user->name }} ({{ $student->nisn }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label for="book_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Buku</label>
                            <select name="book_id" id="book_id"
                                class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} (Stok: {{ $book->stock }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                    Pinjam</label>
                                <x-text-input id="start_date" name="start_date" type="date" class="block w-full"
                                    :value="old('start_date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Batas
                                    Kembali</label>
                                <x-text-input id="end_date" name="end_date" type="date" class="block w-full"
                                    :value="old('end_date', date('Y-m-d', strtotime('+7 days')))" required />
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.loans.index') }}"
                                class="mr-4 text-sm text-gray-600 hover:text-gray-900 transition underline">Batal</a>
                            <x-primary-button class="bg-purple-600 hover:bg-purple-700 px-8 py-3">
                                Buat Peminjaman
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>