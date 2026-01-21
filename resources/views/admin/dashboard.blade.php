<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>

            <div class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-3">
                <span>Hello Admin, {{ Auth::user()->name }}</span>

                @if($pendingLoans > 0)
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">
                        {{ $pendingLoans }} pending
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- STATISTIC CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- TOTAL BOOKS -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total Buku
                            </p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $totalBooks }}
                            </p>
                        </div>

                        <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- ACTIVE LOANS -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Peminjaman Aktif
                            </p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $activeLoans }}
                            </p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- OVERDUE -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Terlambat
                            </p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">
                                {{ $overdueLoans }}
                            </p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-900 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CHART -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Tren Peminjaman Bulanan
                </h3>

                <div class="relative" style="height: 350px;">
                    <canvas id="loanChart"></canvas>
                </div>
            </div>

            <!-- LATEST LOANS -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Peminjaman Terbaru
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-left text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="py-2">Siswa</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200">
                            @forelse($latestLoans as $loan)
                                <tr class="border-t dark:border-gray-700">
                                    <td class="py-2">
                                        {{ $loan->student->user->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $loan->book->title ?? '-' }}
                                    </td>
                                    <td>
                                        <span class="px-2 py-1 text-xs rounded-full
                                                        @if($loan->latestStatus?->status === 'approved') bg-green-100 text-green-700
                                                        @elseif($loan->latestStatus?->status === 'pending') bg-yellow-100 text-yellow-700
                                                        @elseif($loan->latestStatus?->status === 'late') bg-red-100 text-red-700
                                                        @else bg-gray-100 text-gray-700
                                                        @endif
                                                    ">
                                            {{ ucfirst($loan->latestStatus?->status ?? '-') }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $loan->created_at?->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">
                                        Belum ada peminjaman
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        window.addEventListener('load', () => {
            const ctx = document.getElementById('loanChart')
            if (!ctx) return

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                    ],
                    datasets: [{
                        label: 'Total Peminjaman',
                        data: @json($loanChartData),
                        tension: 0.4,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            })
        })
    </script>

</x-app-layout>