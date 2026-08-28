<x-app-layout>
    
    <!-- ================= KARTU STATISTIK ================= -->
   <div class="card-grid">
    <!-- Total Keseluruhan Karyawan -->
    <div class="stat-card">
        <div class="card-icon blue"><i class="fa-solid fa-users"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalEmployees, 0, ',', '.') }}</h2>
            <p>Karyawan</p>
            <span><i class="fas fa-layer-group text-blue-500"></i> Seluruh Karyawan</span>
        </div>
    </div>

    <!-- Karyawan Aktif (BARU) -->
    <div class="stat-card">
        <div class="card-icon green"><i class="fa-solid fa-user-check"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalAktif, 0, ',', '.') }}</h2>
            <p>Karyawan Aktif</p>
            <span><i class="fas fa-arrow-up text-green-500"></i> Status Aktif</span>
        </div>
    </div>

    <!-- Karyawan Non-Aktif (BARU) -->
    <div class="stat-card">
        <div class="card-icon red"><i class="fa-solid fa-user-xmark"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalNonAktif, 0, ',', '.') }}</h2>
            <p>Karyawan Non-Aktif</p>
            <span><i class="fas fa-arrow-down text-red-500"></i> Status Non-Aktif</span>
        </div>
    </div>

    <!-- Departemen -->
    <div class="stat-card">
        <div class="card-icon purple"><i class="fa-solid fa-building"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalDepartments, 0, ',', '.') }}</h2>
            <p>Departmen</p>
            <span><i class="fas fa-building text-purple-500"></i> Bidang Kerja</span>
        </div>
    </div>

    <!-- Posisi / Jabatan -->
    <div class="stat-card">
        <div class="card-icon orange"><i class="fa-solid fa-id-badge"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalPositions, 0, ',', '.') }}</h2>
            <p>Posisi</p>
            <span><i class="fas fa-briefcase text-orange-500"></i> Ragam Jabatan</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="card-icon indigo" style="background-color: #e0e7ff; color: #4f46e5;"><i class="fa-solid fa-clock-rotate-left"></i></div>
        <div class="card-info">
            <h2 class="text-2xl font-bold">{{ number_format($totalHistories, 0, ',', '.') }}</h2>
            <p>Total Histori</p>
            <span><i class="fas fa-history text-indigo-500"></i> Rekam Jejak Sistem</span>
        </div>
    </div>
</div>

    <!-- ================= BAGIAN GRAFIK & TABEL ================= -->
    <div class="main-grid">

        <!-- Kendaraan di Jalan -->
        <div class="card card-span-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">5 Karyawan Terbaru</h3>
            <div class="table-responsive overflow-x-auto">
                <table class="min-w-full bg-white text-sm text-left text-gray-500 border border-gray-200 rounded-lg">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Nama</th>
                            <th class="py-3 px-4">Departemen</th>
                            <th class="py-3 px-4">Posisi</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $emp)
                            <tr class="border-b hover:bg-gray-50">
                                <!-- Nomor urut otomatis 1 sampai 5 -->
                                <td class="py-3 px-4 text-center font-medium text-gray-600">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-3 px-4 font-mono text-xs text-indigo-600 font-semibold">{{ $emp->employee_code }}</td>
                                <td class="py-3 px-4 font-medium text-gray-900">{{ $emp->name }}</td>
                                <td class="py-3 px-4">{{ $emp->department }}</td>
                                <td class="py-3 px-4">{{ $emp->position }}</td>
                                <td class="py-3 px-4">{{ $emp->email }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 text-xs rounded-md font-semibold {{ $emp->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $emp->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500 font-medium">Belum ada data karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= SCRIPT CHART JS ================= -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('shipmentChart');
            if (ctx) {
                const shipmentChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Nov', 'Des'],
                        datasets: [
                            {
                                type: 'line',
                                label: 'Delivery',
                                data: [24, 28, 24, 32, 27, 43, 31, 38, 26, 34, 46],
                                borderColor: '#7367F0',
                                backgroundColor: 'rgba(115, 103, 240, 0.1)',
                                fill: false,
                                tension: 0.4,
                                pointBackgroundColor: '#7367F0',
                                pointBorderColor: '#fff',
                                pointHoverRadius: 7,
                                pointRadius: 5
                            },
                            {
                                type: 'bar',
                                label: 'Shipment',
                                data: [38, 45, 33, 38, 32, 48, 40, 38, 42, 35, 50],
                                backgroundColor: '#FF9F43',
                                borderColor: 'transparent',
                                borderRadius: 5,
                                barThickness: 10
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    padding: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 50,
                                ticks: {
                                    stepSize: 12.5,
                                    callback: function (value) { return value + '%' }
                                }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush

</x-app-layout>