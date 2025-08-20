<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    [cite_start]<h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Persentase
                        Kehadiran Harian [cite: 88]</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $dailyAttendancePercentage }}%</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:col-span-2">
                    [cite_start]<h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Prediksi AI:
                        Satpam Berisiko Terlambat [cite: 88]</h3>
                    <div class="mt-2">
                        @forelse ($atRiskGuards as $guard)
                            <div class="flex items-center justify-between py-1">
                                <p class="text-gray-900">{{ $guard->name }}</p>
                                <span class="text-sm text-red-600">{{ $guard->lates_last_7_days }} keterlambatan dalam 7
                                    hari</span>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada data risiko yang terdeteksi.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                [cite_start]<h3 class="text-lg font-medium leading-6 text-gray-900">Grafik Kehadiran dalam 1 Bulan
                    [cite: 88]</h3>
                <canvas id="attendanceChart" class="mt-4"></canvas>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    [cite_start]<h3 class="text-lg font-medium leading-6 text-gray-900">Top 10 Karyawan Paling Sering
                        Terlambat [cite: 88]</h3>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Keterlambatan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($topLateEmployees as $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $employee->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $employee->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $employee->attendances_count }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const attendanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Tepat Waktu',
                        data: @json($chartOnTimeData),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Terlambat',
                        data: @json($chartLateData),
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Kehadiran Harian Bulan Ini'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>