<x-app-layout>
    <div x-data="{ isEditModalOpen: true }" 
         x-init="$watch('isEditModalOpen', value => { if(!value) window.location.href = '{{ route('employees.index') }}' })">
        
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">
                {{ __('Data Karyawan') }}
            </h2>
        </x-slot>
        <div class="py-2 opacity-50 pointer-events-none select-none">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-2">
                <div class="p-4 sm:p-6 bg-white shadow sm:rounded-lg">
                    <p class="text-sm text-gray-500">Sedang memperbarui data karyawan...</p>
                </div>
            </div>
        </div>

        <div x-show="isEditModalOpen" 
             class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-900 bg-opacity-75 transition-opacity"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="relative w-full max-w-2xl mx-4 my-auto"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95">
                
                <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                    
                    <div class="flex-shrink-0 flex items-start justify-between p-5 border-b bg-white">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Edit Data Karyawan
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Mengubah data karyawan: <span class="text-indigo-600 font-semibold">{{ $employee->name }}</span>. Kosongkan lampiran jika tidak ingin diganti.</p>
                        </div>
                        <a href="{{ route('employees.index') }}" class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
                        <form id="form-edit-karyawan" method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            @if($errors->any())
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                                    <span class="font-bold">Gagal memperbarui data!</span> Periksa kesalahan berikut:
                                    <ul class="list-disc pl-5 mt-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
                                
                                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                                    <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider border-b pb-3 mb-4">Data Pribadi</h3>
                                    <div class="space-y-4">

                                        <div>
                                            <x-input-label for="employee_code" value="Kode Karyawan" />   
                                            <x-text-input id="employee_code" name="employee_code" type="text" class="mt-1 block w-full text-sm" value="{{ old('employee_code', $employee->employee_code) }}" required />
                                        </div>
                                        <div>
                                            <x-input-label for="name" value="Nama Lengkap" />   
                                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full text-sm" value="{{ old('name', $employee->name) }}" required />
                                        </div>
                                        <div>
                                            <x-input-label for="department" value="Departemen" />
                                            <x-text-input id="department" name="department" type="text" class="mt-1 block w-full text-sm" value="{{ old('department', $employee->department) }}" />
                                        </div>
                                       
                                        <div>
                                            <x-input-label for="position" value="Posisi" />
                                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full text-sm" value="{{ old('position', $employee->position) }}" />
                                        </div>
                                        
                                        <div>
                                            <x-input-label for="email" value="Email" />
                                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full text-sm" value="{{ old('email', $employee->email) }}" />
                                        </div>

                                        <div>
                                            <x-input-label for="status" value="Status" />
                                            <select id="status" name="status" class="mt-1 block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                <option value="Aktif" {{ old('status', $employee->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="Non-Aktif" {{ old('status', $employee->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>

                                
                               
                            </div>
                        </form>
                    </div>

                    <div class="flex-shrink-0 flex items-center justify-end p-5 border-t bg-white gap-3 rounded-b-xl">
                        <a href="{{ route('employees.index') }}" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" form="form-edit-karyawan" class="px-5 py-2 bg-indigo-600 text-xs font-semibold text-white uppercase tracking-widest rounded-lg shadow-md hover:bg-indigo-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>