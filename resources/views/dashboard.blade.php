<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard Aparat') }}
            </h2>
            <div class="text-sm text-gray-600">
                <span class="font-medium">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Kiri: Status Absensi dengan Animasi -->
                <div class="lg:col-span-1">
                    <!-- Card Status Absensi -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-transform duration-300">
                        <div class="p-6 text-white">
                            <div class="flex items-center mb-4">
                                <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-xl font-bold">Status Absensi</h3>
                            </div>
                            <p class="text-blue-100 text-sm mb-6">{{ $statusAbsensi['message'] }}</p>
                            
                            <div class="space-y-4">
                                <!-- Status Masuk dengan Icon -->
                                <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-xl p-4 border border-white border-opacity-30">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3
                                                @if($statusAbsensi['masuk']) 
                                                    {{ $statusAbsensi['terlambat'] ? 'bg-yellow-400' : 'bg-green-400' }}
                                                @else 
                                                    bg-gray-400 
                                                @endif">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-semibold text-white block">Absen Masuk</span>
                                                @if($statusAbsensi['terlambat'])
                                                    <span class="text-xs text-yellow-200">(Terlambat)</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-2xl text-white">
                                                {{ $statusAbsensi['jam_masuk'] ?? '--:--' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Pulang dengan Icon -->
                                <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-xl p-4 border border-white border-opacity-30">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3
                                                @if($statusAbsensi['pulang']) 
                                                    bg-purple-400
                                                @else 
                                                    bg-gray-400 
                                                @endif">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-semibold text-white">Absen Pulang</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-2xl text-white">
                                                {{ $statusAbsensi['jam_pulang'] ?? '--:--' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Info Tambahan -->
                    <div class="mt-6 bg-white rounded-2xl shadow-lg p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Pastikan GPS aktif saat absensi
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Scan QR atau input kode manual
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Hubungi admin jika ada kendala
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Scanner & Input Manual dengan Design Modern -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                        <div class="p-8">
                            
                            @if(!$statusAbsensi['pulang'])
                                
                                <!-- Tab Switcher dengan Design Modern -->
                                <div class="flex bg-gray-100 rounded-xl p-1 mb-8">
                                    <button id="tab-scanner" class="tab-button active flex-1 py-3 px-6 rounded-lg font-semibold text-sm transition-all duration-300 bg-white shadow-md text-blue-600">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                        Scan QR Code
                                    </button>
                                    <button id="tab-manual" class="tab-button flex-1 py-3 px-6 rounded-lg font-semibold text-sm transition-all duration-300 text-gray-600 hover:text-gray-800">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        Input Kode Manual
                                    </button>
                                </div>

                                <!-- Content Scanner dengan Animasi -->
                                <div id="content-scanner" class="tab-content">
                                    <div class="text-center mb-8">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Scan QR Code</h3>
                                        <p class="text-gray-600">Arahkan kamera ke QR code yang disediakan oleh Admin</p>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <button id="btn-scan" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                                            <span class="relative flex items-center">
                                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Mulai Scan
                                            </span>
                                        </button>

                                        <div id="reader-wrapper" class="w-full max-w-md mx-auto mt-6" style="display: none;">
                                            <div id="reader" class="rounded-xl overflow-hidden shadow-2xl border-4 border-blue-500"></div>
                                        </div>

                                        <div id="scan-status" class="mt-6 font-semibold text-center text-lg h-8"></div>
                                    </div>
                                </div>

                                <!-- Content Manual Input dengan Design Card -->
                                <div id="content-manual" class="tab-content hidden">
                                    <div class="text-center mb-8">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Input Kode Absensi</h3>
                                        <p class="text-gray-600">Masukkan kode 6 digit yang ditampilkan di dashboard Admin</p>
                                    </div>

                                    <div class="max-w-md mx-auto">
                                        <div class="bg-gradient-to-br from-green-50 to-blue-50 border-2 border-green-200 rounded-2xl p-8 shadow-lg">
                                            <label for="manual-code" class="block text-sm font-bold text-gray-700 mb-3 text-center">
                                                KODE ABSENSI
                                            </label>
                                            <input 
                                                type="text" 
                                                id="manual-code" 
                                                maxlength="6"
                                                pattern="[0-9]{6}"
                                                placeholder="• • • • • •"
                                                class="w-full px-6 py-5 text-4xl font-bold text-center border-3 border-green-300 rounded-xl focus:ring-4 focus:ring-green-500 focus:border-green-500 tracking-widest bg-white shadow-inner transition-all duration-300"
                                            >
                                            <p class="mt-3 text-xs text-gray-600 text-center flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                                Masukkan 6 digit angka
                                            </p>
                                            
                                            <button id="btn-submit-code" class="w-full mt-6 inline-flex items-center justify-center px-6 py-4 text-lg font-bold text-white bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Absen Sekarang
                                            </button>
                                        </div>

                                        <div id="manual-status" class="mt-6 font-semibold text-center text-lg"></div>
                                    </div>
                                </div>

                            @else
                                <!-- Tampilan Success State -->
                                <div class="flex flex-col items-center justify-center text-center py-16">
                                    <div class="relative">
                                        <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
                                            <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="absolute inset-0 w-32 h-32 bg-green-200 rounded-full animate-ping opacity-25 mx-auto"></div>
                                    </div>
                                    <h3 class="text-3xl font-bold text-gray-800 mb-3">Absensi Selesai!</h3>
                                    <p class="text-gray-600 text-lg mb-6">Anda sudah menyelesaikan absensi hari ini</p>
                                    <div class="inline-flex items-center px-6 py-3 bg-green-100 text-green-800 rounded-full font-semibold">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Terima kasih!
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // --- TAB SWITCHING dengan Animasi ---
        document.addEventListener('DOMContentLoaded', function () {
            const tabScanner = document.getElementById('tab-scanner');
            const tabManual = document.getElementById('tab-manual');
            const contentScanner = document.getElementById('content-scanner');
            const contentManual = document.getElementById('content-manual');

            if (tabScanner && tabManual) {
                tabScanner.addEventListener('click', function() {
                    tabScanner.classList.add('active', 'bg-white', 'shadow-md', 'text-blue-600');
                    tabScanner.classList.remove('text-gray-600');
                    tabManual.classList.remove('active', 'bg-white', 'shadow-md', 'text-blue-600');
                    tabManual.classList.add('text-gray-600');
                    
                    contentScanner.classList.remove('hidden');
                    contentManual.classList.add('hidden');
                });

                tabManual.addEventListener('click', function() {
                    tabManual.classList.add('active', 'bg-white', 'shadow-md', 'text-blue-600');
                    tabManual.classList.remove('text-gray-600');
                    tabScanner.classList.remove('active', 'bg-white', 'shadow-md', 'text-blue-600');
                    tabScanner.classList.add('text-gray-600');
                    
                    contentManual.classList.remove('hidden');
                    contentScanner.classList.add('hidden');
                });
            }
        });

        // --- FUNGSI GLOBAL UNTUK ABSENSI ---
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        async function sendTokenToServer(token, statusElementId = 'scan-status') {
            const statusElement = document.getElementById(statusElementId);
            if (!statusElement) return;

            statusElement.style.color = '#f59e0b';
            statusElement.innerHTML = '<svg class="animate-spin w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses... Meminta lokasi Anda...';

            try {
                const position = await getGeolocation();
                const { latitude, longitude } = position.coords;

                statusElement.style.color = '#3b82f6';
                statusElement.innerHTML = '<svg class="animate-spin w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Lokasi didapat. Mengirim data...';

                const response = await fetch("{{ route('absensi.scan') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    body: JSON.stringify({ 
                        token: token,
                        latitude: latitude,
                        longitude: longitude
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    statusElement.style.color = '#10b981';
                    statusElement.innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' + result.message;
                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                } else {
                    statusElement.style.color = '#ef4444';
                    statusElement.innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Error: ' + (result.message || 'Terjadi kesalahan');
                }

            } catch (error) {
                console.error('Error proses absensi:', error);
                statusElement.style.color = '#ef4444';
                statusElement.innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Error: ' + error.message;
            }
        }

        function getGeolocation() {
            return new Promise((resolve, reject) => {
                if (!navigator.geolocation) {
                    reject(new Error('Geolocation tidak didukung oleh browser Anda.'));
                }
                
                navigator.geolocation.getCurrentPosition(
                    (position) => resolve(position), 
                    (error) => {
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                reject(new Error('Anda menolak izin lokasi. Absensi dibatalkan.'));
                                break;
                            case error.POSITION_UNAVAILABLE:
                                reject(new Error('Informasi lokasi tidak tersedia.'));
                                break;
                            case error.TIMEOUT:
                                reject(new Error('Gagal mendapatkan lokasi (timeout).'));
                                break;
                            default:
                                reject(new Error('Gagal mendapatkan lokasi.'));
                        }
                    },
                    { 
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            });
        }

        // --- QR CODE SCANNER ---
        document.addEventListener('DOMContentLoaded', function () {
            const scanButton = document.getElementById('btn-scan');
            if (!scanButton) return;

            const readerWrapper = document.getElementById('reader-wrapper');
            const statusElement = document.getElementById('scan-status');
            
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { 
                    fps: 10, 
                    qrbox: (viewfinderWidth, viewfinderHeight) => {
                        const size = Math.min(viewfinderWidth, viewfinderHeight) * 0.8;
                        return { width: size, height: size };
                    }
                },
                false
            );

            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear().catch(error => {
                    console.warn("Gagal membersihkan scanner.", error);
                });
                readerWrapper.style.display = 'none';
                sendTokenToServer(decodedText, 'scan-status');
            }

            function onScanFailure(error) {
                // Dibiarkan kosong
            }
            
            scanButton.addEventListener('click', () => {
                readerWrapper.style.display = 'block';
                scanButton.style.display = 'none';
                statusElement.style.color = '#6b7280';
                statusElement.innerHTML = '<svg class="w-5 h-5 inline mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>Arahkan kamera ke QR Code...';
                
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });
        });

        // --- MANUAL CODE INPUT ---
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('btn-submit-code');
            if (!submitButton) return;

            const codeInput = document.getElementById('manual-code');
            const statusElement = document.getElementById('manual-status');

            // Hanya izinkan input angka
            codeInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            submitButton.addEventListener('click', async function() {
                const code = codeInput.value.trim();
                
                // Validasi
                if (code.length !== 6) {
                    statusElement.style.color = '#ef4444';
                    statusElement.innerHTML = '<svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Kode harus 6 digit!';
                    return;
                }

                // Konversi kode numerik ke token hash
                // Karena kode numerik adalah representasi dari token,
                // kita kirim kode numerik ke server dan biarkan server yang validasi
                await sendTokenToServer(code, 'manual-status');
            });
        });
    </script>
    @endpush
</x-app-layout>