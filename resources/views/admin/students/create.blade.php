<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Siswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.students.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap</label>
                                <x-text-input id="name" name="name" type="text" class="block w-full"
                                    :value="old('name')" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                                <x-text-input id="nisn" name="nisn" type="text" class="block w-full"
                                    :value="old('nisn')" required />
                                <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <x-text-input id="email" name="email" type="email" class="block w-full"
                                    :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <label for="classroom_id"
                                    class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                                <select name="classroom_id" id="classroom_id"
                                    class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                            {{ $classroom->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('classroom_id')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <x-text-input id="password" name="password" type="password" class="block w-full"
                                    required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                    class="block w-full" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.students.index') }}"
                                class="mr-4 text-sm text-gray-600 hover:text-gray-900 transition underline">Batal</a>
                            <x-primary-button class="bg-purple-600 hover:bg-purple-700 px-8 py-3">
                                Simpan Siswa
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>