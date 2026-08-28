<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 border-b pb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Histori Keseluruhan Aktivitas Karyawan</h2>
                        <p class="text-sm text-gray-500 mt-1">Rekam jejak seluruh perubahan data, penambahan, dan penghapusan data karyawan di sistem.</p>
                    </div>
                    
                </div>

                <!-- Tabel Riwayat Keseluruhan -->
                <div class="overflow-x-auto border rounded-lg">
                    <table class="min-w-full bg-white text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="py-3 px-4 w-10 text-center whitespace-nowrap">No</th>
                                <th class="py-2 px-4 text-left">ID</th>
                                <th class="py-3 px-4">Karyawan</th>
                                <th class="py-3 px-4">Aktivitas</th>
                                <th class="py-3 px-4">Admin / User</th>
                                <th class="py-3 px-4">Waktu</th>
                                <th class="py-3 px-4">Detail Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                                @php
                                    // Mengambil data karyawan berdasarkan subject_id jika record-nya masih ada
                                    $employee = $activity->subject;
                                @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-center font-medium text-gray-600">
                                        {{ ($activities->currentPage() - 1) * $activities->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $employee?->employee_code ?? 'N/A' }} 
                                    </td>
                                  
                                    <td class="py-3 px-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $employee ? $employee->name : 'Data Karyawan Telah Dihapus' }}
                                    </td>
                                    
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        @if($activity->description == 'created')
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Dibuat</span>
                                        @elseif($activity->description == 'updated')
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">Diperbarui</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">{{ ucfirst($activity->description) }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        {{ $activity->causer ? $activity->causer->name : 'Sistem / Tamu' }}
                                    </td>
                                    <td class="py-3 px-4 whitespace-nowrap text-xs text-gray-600">
                                        {{ $activity->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="py-3 px-4 text-xs">
                                        @if($activity->description == 'updated' && isset($activity->properties['attributes']))
                                            <div class="space-y-1">
                                                @foreach($activity->properties['attributes'] as $key => $newValue)
                                                    @if(in_array($key, ['updated_at', 'created_at'])) 
                                                        @continue 
                                                    @endif

                                                    @php
                                                        $oldValue = $activity->properties['old'][$key] ?? '-';
                                                    @endphp
                                                    @if($oldValue != $newValue)
                                                        <div>
                                                            <span class="font-semibold text-gray-700">{{ $key }}:</span> 
                                                            <span class="text-red-600 line-through">{{ $oldValue }}</span> 
                                                            <span class="text-gray-400">-></span> 
                                                            <span class="text-green-600 font-medium">{{ $newValue }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @elseif($activity->description == 'created')
                                            <span class="text-gray-500 italic">Data awal berhasil dimasukkan ke sistem.</span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-gray-500 font-medium">Belum ada catatan histori aktivitas sama sekali.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $activities->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>