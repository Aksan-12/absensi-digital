<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
            <div class="hidden md:flex items-center space-x-2 bg-white px-4 py-2 rounded-lg shadow-sm">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700" id="live-clock">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white shadow-xl">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-3xl font-bold mb-2">Ringkasan Absensi Hari Ini</h3>
                            <p class="text-indigo-100">Pantau aktivitas absensi aparat secara real-time</p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-xl p-4 text-center">
                            <div class="text-sm font-medium uppercase text-indigo-100">Tingkat Kehadiran</div>
                            <div class="text-4xl font-bold mt-1">
                                {{ $totalAparat > 0 ? round(($absenMasukHariIni / $totalAparat) * 100) : 0 }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Aparat Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total</span>
                        </div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Total Aparat</div>
                        <div class="text-4xl font-bold text-gray-800">{{ $totalAparat }}</div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500">Terdaftar dalam sistem</span>
                        </div>
                    </div>
                </div>

                <!-- Absen Masuk Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400 to-teal-500 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 uppercase tracking-wide flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1 animate-pulse"></span>
                                Aktif
                            </span>
                        </div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Absen Masuk</div>
                        <div class="text-4xl font-bold text-gray-800">{{ $absenMasukHariIni }}</div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500">{{ $totalAparat > 0 ? round(($absenMasukHariIni / $totalAparat) * 100) : 0 }}% dari total aparat</span>
                        </div>
                    </div>
                </div>

                <!-- Absen Pulang Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-yellow-600 uppercase tracking-wide">Selesai</span>
                        </div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Absen Pulang</div>
                        <div class="text-4xl font-bold text-gray-800">{{ $absenPulangHariIni }}</div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500">{{ $absenMasukHariIni > 0 ? round(($absenPulangHariIni / $absenMasukHariIni) * 100) : 0 }}% telah pulang</span>
                        </div>
                    </div>
                </div>
                
                <!-- Belum Absen Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-400 to-pink-500 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="p-3 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-red-600 uppercase tracking-wide flex items-center">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-1 animate-pulse"></span>
                                Perhatian
                            </span>
                        </div>
                        <div class="text-sm font-medium text-gray-600 mb-1">Belum Absen</div>
                        <div class="text-4xl font-bold text-gray-800">{{ $belumAbsenMasuk }}</div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500">Memerlukan tindak lanjut</span>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- QR Code & Numeric Code Section -->
            <div class="grid lg:grid-cols-2 gap-8 mb-8">
                
                <!-- QR Code Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-xl font-bold">QR Code Absensi</h3>
                                <p class="text-indigo-100 text-sm mt-1">Scan untuk absensi masuk atau pulang</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur-xl opacity-30"></div>
                                <div class="relative p-6 bg-white border-4 border-gray-100 rounded-2xl shadow-xl">
                                    {!! QrCode::size(220)->generate($token) !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-800 mb-2">Cara Menggunakan:</p>
                                    <ul class="text-gray-600 space-y-1">
                                        <li class="flex items-start">
                                            <span class="text-indigo-500 mr-2">•</span>
                                            <span>Buka aplikasi absensi di smartphone</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-indigo-500 mr-2">•</span>
                                            <span>Arahkan kamera ke QR code ini</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-indigo-500 mr-2">•</span>
                                            <span>Sistem akan otomatis mencatat absensi</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Numeric Code Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h3 class="text-xl font-bold">Kode Absensi Alternatif</h3>
                                <p class="text-purple-100 text-sm mt-1">Gunakan jika kamera tidak tersedia</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-red-500 rounded-2xl p-8 shadow-2xl mb-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-5 rounded-full -ml-16 -mb-16"></div>
                            
                            <div class="relative text-center text-white">
                                <div class="text-xs font-semibold uppercase tracking-wider mb-3 text-purple-100">
                                    Kode Hari Ini
                                </div>
                                <div class="text-6xl md:text-7xl font-bold tracking-widest font-mono mb-4 drop-shadow-lg">
                                    {{ $numericCode }}
                                </div>
                                <div class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 border-2 border-purple-200 rounded-xl p-5">
                            <div class="flex items-start">
                                <div class="p-2 bg-purple-100 rounded-lg mr-3 flex-shrink-0">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div class="text-sm">
                                    <p class="font-semibold text-purple-900 mb-2">Langkah Penggunaan:</p>
                                    <ol class="text-purple-800 space-y-2">
                                        <li class="flex items-start">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-purple-200 text-purple-700 text-xs font-bold mr-2 flex-shrink-0">1</span>
                                            <span>Pilih menu "Input Kode Manual" di dashboard</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-purple-200 text-purple-700 text-xs font-bold mr-2 flex-shrink-0">2</span>
                                            <span>Masukkan kode 6 digit di atas</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-purple-200 text-purple-700 text-xs font-bold mr-2 flex-shrink-0">3</span>
                                            <span>Klik tombol "Absen" untuk konfirmasi</span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ route('admin.laporan') }}" 
                   class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden p-8">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <div class="flex items-center mb-3">
                                <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg mr-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-800">Laporan Lengkap</h4>
                                    <p class="text-sm text-gray-500">Lihat detail absensi</p>
                                </div>
                            </div>
                        </div>
                        <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-600 group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </div>
                </a>

                <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-lg p-8 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="text-xl font-bold">Status Sistem</h4>
                            <p class="text-sm text-indigo-100 mt-1">Sistem berjalan normal</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                            <span class="text-sm font-medium">Online</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold">99%</div>
                            <div class="text-xs text-indigo-100 mt-1">Uptime</div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold">{{ $absenMasukHariIni + $absenPulangHariIni }}</div>
                            <div class="text-xs text-indigo-100 mt-1">Aktivitas</div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold">0</div>
                            <div class="text-xs text-indigo-100 mt-1">Error</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Live clock update
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const clockElement = document.getElementById('live-clock');
            if (clockElement) {
                clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }
        
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>