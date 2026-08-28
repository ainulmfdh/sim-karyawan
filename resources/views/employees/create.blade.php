<x-app-layout>
    <div x-data="{ isModalOpen: true }" 
         x-init="$watch('isModalOpen', value => { if(!value) window.location.href = '{{ route('employees.index') }}' })">
        
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Karyawan') }}
            </h2>
        </x-slot>

        <!-- Background Placeholder ketika Modal Aktif -->
        <div class="py-2 opacity-50 pointer-events-none select-none">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-2">
                <div class="p-4 sm:p-6 bg-white shadow sm:rounded-lg">
                    <p class="text-sm text-gray-500">Membuka form tambah karyawan...</p>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Karyawan -->
        <div x-show="isModalOpen" 
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-900 bg-opacity-75 transition-opacity"
             style="display: none;">
            
            <div class="relative w-full max-w-2xl mx-4 my-auto">
                <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                    
                    <!-- Header Modal -->
                    <div class="flex-shrink-0 flex items-start justify-between p-5 border-b bg-white">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Tambah Karyawan Baru
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Silakan isi formulir di bawah ini dengan data karyawan yang valid.</p>
                        </div>
                        <a href="{{ route('employees.index') }}" class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Body / Form Input -->
                    <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
                        <form id="form-tambah-karyawan" method="POST" action="{{ route('employees.store') }}" class="space-y-6">
                            @csrf
                            
                            <!-- Notifikasi Error Validasi -->
                            @if($errors->any())
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                                    <span class="font-bold">Gagal menyimpan data!</span> Periksa kesalahan berikut:
                                    <ul class="list-disc pl-5 mt-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="grid grid-cols-1 gap-2">
                                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm space-y-2">

                                    <div>
                                        <x-input-label for="employee_code" value="ID / Kode Karyawan" />   
                                        <x-text-input id="employee_code" name="employee_code" type="text" class="mt-1 block w-full text-sm" value="{{ old('employee_code') }}" placeholder="011" required />
                                    </div>

                                    <div>
                                        <x-input-label for="name" value="Nama Lengkap" />   
                                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-sm" value="{{ old('name') }}" placeholder="Nama Karyawan" required />
                                    </div>

                                    <div>
                                        <x-input-label for="department" value="Departemen" />
                                        <x-text-input id="department" name="department" type="text" class="mt-1 block w-full text-sm" value="{{ old('department') }}" placeholder="IT / Finance / HR / dll" required />
                                    </div>
                                   
                                    <div>
                                        <x-input-label for="position" value="Jabatan" />
                                        <x-text-input id="position" name="position" type="text" class="mt-1 block w-full text-sm" value="{{ old('position') }}" placeholder="Staff / Programmer / dll" required />
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="email" value="Email Perusahaan" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full text-sm" value="{{ old('email') }}" placeholder="nama@properindoenviro.co.id" required />
                                    </div>

                                    <div>
                                        <x-input-label for="status" value="Status" />
                                        <select id="status" name="status" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Non-Aktif" {{ old('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Footer Modal -->
                    <div class="flex-shrink-0 flex items-center justify-end p-5 border-t bg-white gap-3 rounded-b-xl">
                        <a href="{{ route('employees.index') }}" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" form="form-tambah-karyawan" class="px-5 py-2 bg-indigo-600 text-xs font-semibold text-white uppercase tracking-widest rounded-lg shadow-md hover:bg-indigo-700 transition-colors">
                            Simpan Data
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>