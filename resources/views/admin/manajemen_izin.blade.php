<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        {{ __('Manajemen Izin & Sakit') }}
                    </h2>
                    <p class="text-sm text-gray-600">Kelola pengajuan izin dan sakit dari aparat</p>
                </div>
            </div>
            
            <!-- Stats Summary -->
            <div class="hidden lg:flex items-center space-x-4">
                <div class="bg-orange-50 px-4 py-2 rounded-lg border border-orange-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-semibold text-orange-700">{{ $pengajuan_menunggu->count() }} Menunggu</span>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                    <span class="text-sm font-semibold text-gray-700">{{ $riwayat_pengajuan->count() }} Riwayat</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Bagian Pengajuan Menunggu Persetujuan -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                
                <!-- Header Card -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white bg-opacity-20 backdrop-blur-lg rounded-xl flex items-center justify-center border border-white border-opacity-30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Menunggu Persetujuan</h3>
                                <p class="text-orange-100 text-sm">Segera proses pengajuan berikut</p>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-full px-4 py-2 border border-white border-opacity-30">
                            <span class="text-white font-bold text-lg">{{ $pengajuan_menunggu->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="p-6">
                    @if($pengajuan_menunggu->count() > 0)
                        <div class="space-y-4">
                            @foreach ($pengajuan_menunggu as $izin)
                                <div class="bg-gradient-to-r from-orange-50 to-red-50 border-2 border-orange-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                        
                                        <!-- Info Section -->
                                        <div class="flex-1 space-y-3">
                                            <!-- User Info -->
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-400 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                                                    {{ strtoupper(substr($izin->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-800 text-lg">{{ $izin->user->name ?? 'User Dihapus' }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $izin->user->email ?? '-' }}</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Details Grid -->
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 ml-15">
                                                <!-- Tanggal -->
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Tanggal</p>
                                                        <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($izin->tanggal_absen)->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                                
                                                <!-- Tipe -->
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Tipe</p>
                                                        @if($izin->status_kehadiran == 'izin')
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                </svg>
                                                                Izin
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                                </svg>
                                                                Sakit
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Bukti -->
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Bukti</p>
                                                        @if ($izin->file_bukti_izin)
                                                            <a href="{{ Storage::url($izin->file_bukti_izin) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                </svg>
                                                                Lihat
                                                            </a>
                                                        @else
                                                            <span class="text-gray-400 text-sm">Tidak ada</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Keterangan -->
                                            <div class="bg-white bg-opacity-60 rounded-lg p-3 ml-15">
                                                <p class="text-xs text-gray-500 mb-1 font-semibold">Keterangan:</p>
                                                <p class="text-sm text-gray-700">{{ $izin->keterangan_izin ?? '-' }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="flex lg:flex-col gap-3 lg:ml-4">
                                            <!-- Setujui Button -->
                                            <form method="POST" action="{{ route('admin.izin.approve', $izin->id) }}" onsubmit="return confirm('Anda yakin ingin MENYETUJUI pengajuan ini?');" class="flex-1 lg:flex-none">
                                                @csrf
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                                                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Setujui
                                                </button>
                                            </form>
                                            
                                            <!-- Tolak Button -->
                                            <form method="POST" action="{{ route('admin.izin.reject', $izin->id) }}" onsubmit="return confirm('Anda yakin ingin MENOLAK pengajuan ini?');" class="flex-1 lg:flex-none">
                                                @csrf
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                                                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak Ada Pengajuan</h3>
                            <p class="text-gray-600">Tidak ada pengajuan izin yang menunggu persetujuan saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bagian Riwayat Pengajuan -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                
                <!-- Header Card -->
                <div class="bg-gradient-to-r from-gray-700 to-gray-900 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white bg-opacity-20 backdrop-blur-lg rounded-xl flex items-center justify-center border border-white border-opacity-30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Riwayat Pengajuan</h3>
                                <p class="text-gray-300 text-sm">Pengajuan yang telah diproses</p>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-full px-4 py-2 border border-white border-opacity-30">
                            <span class="text-white font-bold text-lg">{{ $riwayat_pengajuan->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="p-6">
                    @if($riwayat_pengajuan->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aparat</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tipe</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($riwayat_pengajuan as $izin)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white font-bold shadow-sm">
                                                        {{ strtoupper(substr($izin->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-800">{{ $izin->user->name ?? 'User Dihapus' }}</p>
                                                        <p class="text-xs text-gray-500">{{ $izin->user->email ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span class="text-gray-700 font-medium">{{ \Carbon\Carbon::parse($izin->tanggal_absen)->format('d M Y') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($izin->status_kehadiran == 'izin')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        Izin
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                                        </svg>
                                                        Sakit
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($izin->status_izin == 1)
                                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800 shadow-sm">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Disetujui
                                                    </span>
                                                @elseif ($izin->status_izin == 2)
                                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-800 shadow-sm">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Riwayat</h3>
                            <p class="text-gray-600">Belum ada pengajuan izin yang telah diproses.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @push('styles')
    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
    @endpush
</x-app-layout>