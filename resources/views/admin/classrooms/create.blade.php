<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kelas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('admin.classrooms.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="class_name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Kelas</label>
                            <x-text-input id="class_name" name="class_name" type="text" class="block w-full"
                                :value="old('class_name')" required placeholder="Contoh: XII RPL 1" />
                            <x-input-error :messages="$errors->get('class_name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.classrooms.index') }}"
                                class="mr-4 text-sm text-gray-600 hover:text-gray-900 transition underline">Batal</a>
                            <x-primary-button class="bg-purple-600 hover:bg-purple-700 px-8 py-3">
                                Simpan Kelas
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>