<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('admin.loans.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                        <div class="flex space-x-2">
                            @php $currentStatus = $loan->latestStatus->status ?? 'pending'; @endphp

                            @if($currentStatus == 'pending')
                                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin menolak?')"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Tolak
                                    </button>
                                </form>
                            @endif

                            @if($currentStatus == 'approved')
                                <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Kembalikan Buku
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-lg font-bold mb-4 border-b pb-2">Informasi Peminjam</h4>
                            <dl class="grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->student->user->name }}</dd>

                                <dt class="text-sm font-medium text-gray-500">NISN</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->student->nisn }}</dd>

                                <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                                <dd class="text-sm text-gray-900 col-span-2">
                                    {{ $loan->student->classroom->name ?? '-' }}</dd>
                            </dl>
                        </div>

                        <div>
                            <h4 class="text-lg font-bold mb-4 border-b pb-2">Informasi Buku</h4>
                            <dl class="grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Judul</dt>
                                <dd class="text-sm text-gray-900 col-span-2 font-bold">{{ $loan->book->title }}</dd>

                                <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->author ?? '-' }}</dd>

                                <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->category }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-bold mb-4 border-b pb-2">Detail Transaksi</h4>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Tanggal Pinjam</p>
                                    <p class="text-sm font-bold">
                                        {{ $loan->start_date ? $loan->start_date->format('d M Y') : '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Batas Kembali</p>
                                    <p class="text-sm font-bold">
                                        {{ $loan->end_date ? $loan->end_date->format('d M Y') : '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Status Saat Ini</p>
                                    @php
                                        $status = $loan->latestStatus->status ?? 'pending';
                                        $badgeClass = match ($status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'returned' => 'bg-blue-100 text-blue-800',
                                            'late' => 'bg-red-100 text-red-800',
                                            'rejected' => 'bg-gray-100 text-gray-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Dibuat Oleh</p>
                                    <p class="text-sm font-bold text-gray-600">
                                        {{ $loan->created_by == 0 ? 'Sistem' : 'Administrator' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-bold mb-4 border-b pb-2">Riwayat Status</h4>
                        <ul class="space-y-4">
                            @foreach($loan->statuses as $history)
                                <li class="flex items-center space-x-4">
                                    <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-purple-600"></div>
                                    <div class="flex-1 text-sm">
                                        <span class="font-bold text-purple-700 capitalize">{{ $history->status }}</span>
                                        <span class="text-gray-500 ml-2">pada
                                            {{ $history->created_at ? $history->created_at->format('d M Y H:i') : '-' }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>