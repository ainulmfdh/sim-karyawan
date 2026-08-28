<!-- resources/views/employees/index.blade.php -->
<x-app-layout>
    <!-- Deklarasi State Alpine.js untuk Modal Hapus -->
    <div x-data="{ isDeleteModalOpen: false, deleteUrl: '' }" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Data Karyawan</h2>
                    <a href="{{ route('employees.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Tambah Karyawan
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Baris Filter / Pencarian & Pilihan Tampilkan Data -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4 gap-4">
                    <form method="GET" action="{{ route('employees.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">

                        <!-- Pilihan Tampilkan per Halaman -->
                        <div class="flex items-center justify-between sm:justify-start">
                            <label for="per_page" class="text-sm font-bold text-gray-700 mr-2 whitespace-nowrap">Tampilkan:</label>
                            <select name="per_page" id="per_page" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-blue-500 focus:border-blue-500 py-1.5 pl-3 pr-8 font-medium">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>

                        <!-- Input Kotak Pencarian -->
                        <div class="relative w-full sm:w-72">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama, Kode, Email..." class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 pl-9 py-1.5">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Tombol Cari & Reset -->
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 sm:flex-none bg-gray-800 hover:bg-gray-700 text-white text-xs font-semibold px-4 py-2.5 sm:py-2 rounded-md shadow-sm transition duration-150">
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('employees.index') }}" class="flex-1 sm:flex-none flex justify-center items-center bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold px-4 py-2.5 sm:py-2 rounded-md shadow-sm transition duration-150 whitespace-nowrap">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="py-3 px-4 w-10 text-center whitespace-nowrap">No</th>
                                <th class="py-2 px-4 text-left">ID</th>
                                <th class="py-2 px-4 text-left">Nama</th>
                                <th class="py-2 px-4 text-left">Departemen</th>
                                <th class="py-2 px-4 text-left">Jabatan</th>
                                <th class="py-2 px-4 text-left">Email</th>
                                <th class="py-2 px-4 text-left">Status</th>
                                <th class="py-2 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $emp)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-center font-medium text-gray-600">
                                        {{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="py-2 px-4">{{ $emp->employee_code }}</td>
                                    <td class="py-2 px-4">{{ $emp->name }}</td>
                                    <td class="py-2 px-4">{{ $emp->department }}</td>
                                    <td class="py-2 px-4">{{ $emp->position }}</td>
                                    <td class="py-2 px-4">{{ $emp->email }}</td>
                                    <td class="py-2 px-4">
                                        <span class="px-2 py-1 text-xs rounded {{ $emp->status == 'Aktif' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ $emp->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 text-center flex justify-center gap-2 items-center">
                                        <a href="{{ route('employees.edit', $emp->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i> Edit</a>

                                        <!-- Tombol Hapus yang memicu Modal Alpine.js -->
                                        <button type="button" 
                                                @click="deleteUrl = '{{ route('employees.destroy', $emp->id) }}'; isDeleteModalOpen = true;" 
                                                class="text-red-500 hover:text-red-700 inline-flex items-center">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-center text-gray-500">Belum ada data karyawan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Navigasi Pagination -->
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>

        <!-- Memanggil File Terpisah Modal Hapus -->
        @include('employees.delete') 

    </div>
</x-app-layout>