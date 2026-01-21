<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Dashboard Siswa
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Hello, {{ Auth::user()->name }} 👋
            </div>
        </div>
    </x-slot>
    @extends('layouts.app')

    @section('content')
        <h1>Student Dashboard</h1>
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Buku Tersedia</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalBooks }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                    <p class="text-3xl font-bold mt-2">{{ $activeLoans }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingLoans }}</p>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Riwayat Peminjaman Saya ({{ now()->year }})
                </h3>

                <div style="height: 350px">
                    <canvas id="loanChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        window.addEventListener('load', () => {
            const ctx = document.getElementById('loanChart')

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                    ],
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: @json($loanChartData),
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
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