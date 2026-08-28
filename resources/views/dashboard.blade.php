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
    <!-- Tambahan p-4 sm:p-6 agar padding di HP tidak terlalu lebar -->
    <div class="card card-span-full bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 w-full overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">5 Karyawan Terbaru</h3>
        
        <!-- WRAPPER UTAMA RESPONSIVE -->
        <!-- overflow-x-auto mengizinkan tabel digeser ke samping di HP -->
        <div class="w-full overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
            
            <!-- min-w-full memastikan tabel mengambil ruang penuh jika layar besar -->
            <!-- whitespace-nowrap pada thead dan tbody mencegah teks turun ke bawah -->
            <table class="min-w-full bg-white text-sm text-left text-gray-500 whitespace-nowrap">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="py-3.5 px-4 text-center w-16">No</th>
                        <th scope="col" class="py-3.5 px-4">ID</th>
                        <th scope="col" class="py-3.5 px-4">Nama</th>
                        <th scope="col" class="py-3.5 px-4">Departemen</th>
                        <th scope="col" class="py-3.5 px-4">Posisi</th>
                        <th scope="col" class="py-3.5 px-4">Email</th>
                        <th scope="col" class="py-3.5 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($employees as $emp)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="py-3 px-4 text-center font-medium text-gray-600">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-3 px-4 font-mono text-xs text-indigo-600 font-semibold">{{ $emp->employee_code }}</td>
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $emp->name }}</td>
                            <td class="py-3 px-4">{{ $emp->department }}</td>
                            <td class="py-3 px-4">{{ $emp->position }}</td>
                            <td class="py-3 px-4">{{ $emp->email }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-md {{ $emp->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $emp->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500 font-medium">Belum ada data karyawan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
    </div>
</div>

    <!-- ================= SCRIPT JS ================= -->
    @push('scripts')
    
    @endpush

</x-app-layout>