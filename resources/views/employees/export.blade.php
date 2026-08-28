<x-app-layout>
    <div x-data="{ isAddModalOpen: false }" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Header & Tombol Tambah -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-4 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Riwayat Data Laporan</h2>
                        <p class="text-sm text-gray-500 mt-1">Kelola dan unduh laporan rekapitulasi karyawan per periode bulan.</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        
                        <!-- Tombol Buka Modal -->
                        <button @click="isAddModalOpen = true" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                            <i class="fas fa-plus mr-2"></i> Tambah Data Laporan
                        </button>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Riwayat Laporan -->
                <div class="overflow-x-auto border rounded-xl">
                    <table class="min-w-full bg-white text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="py-3 px-4 text-center w-16">No</th>
                                <th class="py-3 px-4">Bulan / Periode</th>
                                <th class="py-3 px-4">Tanggal Dibuat</th>
                                <th class="py-3 px-4 text-center w-40">Downnload</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3.5 px-4 text-center font-medium">
                                        {{ ($reports->currentPage() - 1) * $reports->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-gray-800">
                                        {{ \Carbon\Carbon::parse($report->period_month)->locale('id')->translatedFormat('F Y') }}
                                    </td>
                                    <td class="py-3.5 px-4 text-xs text-gray-500">
                                       {{ $report->created_at->locale('id')->translatedFormat('H:i, d F Y') }}
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <a href="{{ route('employees.export.excel', $report->period_month) }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-md transition-colors">
                                            <i class="fas fa-file-excel mr-1.5"></i> Excel
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-500 font-medium">
                                        Belum ada data laporan yang dibuat. Klik tombol <strong>+ Tambah Data Laporan</strong> untuk membuat baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $reports->links() }}
                </div>

            </div>
        </div>

        <!-- MODAL FORM "TAMBAH DATA LAPORAN" (DESAIN PERSIS DENGAN REFERENSI GAMBAR) -->
        <div x-show="isAddModalOpen" style="display: none;" class="fixed inset-0 z-[9999] overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <!-- Overlay Dark Background -->
                <div x-show="isAddModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" @click="isAddModalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Window Box -->
                <div x-show="isAddModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative inline-block align-middle bg-white rounded-2xl px-6 pt-6 pb-6 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    
                    <!-- Judul Modal -->
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Tambah Data Laporan</h3>

                    <form action="{{ route('employees.export.store') }}" method="POST">
                        @csrf
                        
                        <!-- Input Periode Bulan -->
                        <div class="mb-8">
                            <label for="period_month" class="block text-sm font-semibold text-slate-700 mb-2">
                                Periode Bulan
                            </label>
                            <div class="relative">
                                <input type="month" 
                                       name="period_month" 
                                       id="period_month" 
                                       value="{{ date('Y-m') }}" 
                                       required
                                       class="w-full border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-medium">
                            </div>
                        </div>

                        <!-- Tombol Batal & Simpan Generate -->
                        <div class="flex items-center justify-end gap-3">
                            <button type="button" 
                                    @click="isAddModalOpen = false" 
                                    class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold transition-colors">
                                Batal
                            </button>
                            
                            <button type="submit" 
                                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold shadow-md hover:shadow-lg transition-all">
                                Simpan & Generate
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>