<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        {{ __('Pengajuan Izin / Sakit') }}
                    </h2>
                    <p class="text-sm text-gray-600">Ajukan permohonan izin atau sakit dengan mudah</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="mb-6 animate-shake">
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-bold text-red-800 mb-2">Oops! Ada kesalahan:</h3>
                                    <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 animate-shake">
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-md overflow-hidden">
                        <div class="p-5">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                
                <!-- Card Header with Gradient -->
                <div class="bg-gradient-to-r from-purple-500 via-indigo-500 to-blue-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-1">Form Pengajuan</h3>
                            <p class="text-purple-100 text-sm">Lengkapi formulir di bawah ini dengan benar</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-16 h-16 bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl flex items-center justify-center border border-white border-opacity-30">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('izin.store') }}" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf

                    <!-- Tanggal Izin -->
                    <div class="group">
                        <label for="tanggal_izin" class="flex items-center text-sm font-bold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            Tanggal Izin/Sakit
                        </label>
                        <input 
                            id="tanggal_izin" 
                            type="date"
                            name="tanggal_izin"
                            value="{{ old('tanggal_izin', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                            required 
                            autofocus
                            class="w-full px-4 py-3 text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-300 hover:border-purple-300"
                        >
                        @error('tanggal_izin')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tipe Izin dengan Radio Buttons -->
                    <div class="group">
                        <label class="flex items-center text-sm font-bold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            Tipe Pengajuan
                        </label>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Option Izin -->
                            <label class="relative flex items-center p-5 bg-gradient-to-br from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl cursor-pointer hover:shadow-lg hover:border-blue-400 transition-all duration-300 group">
                                <input 
                                    type="radio" 
                                    name="tipe_izin" 
                                    value="izin" 
                                    {{ old('tipe_izin', 'izin') == 'izin' ? 'checked' : '' }}
                                    class="w-5 h-5 text-blue-600 focus:ring-blue-500 focus:ring-2"
                                >
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-lg font-bold text-gray-800">Izin</span>
                                            <p class="text-sm text-gray-600 mt-1">Untuk keperluan pribadi/keluarga</p>
                                        </div>
                                        <svg class="w-10 h-10 text-blue-400 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </label>

                            <!-- Option Sakit -->
                            <label class="relative flex items-center p-5 bg-gradient-to-br from-red-50 to-pink-50 border-2 border-red-200 rounded-xl cursor-pointer hover:shadow-lg hover:border-red-400 transition-all duration-300 group">
                                <input 
                                    type="radio" 
                                    name="tipe_izin" 
                                    value="sakit" 
                                    {{ old('tipe_izin') == 'sakit' ? 'checked' : '' }}
                                    class="w-5 h-5 text-red-600 focus:ring-red-500 focus:ring-2"
                                >
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-lg font-bold text-gray-800">Sakit</span>
                                            <p class="text-sm text-gray-600 mt-1">Karena kondisi kesehatan</p>
                                        </div>
                                        <svg class="w-10 h-10 text-red-400 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        @error('tipe_izin')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="group">
                        <label for="keterangan_izin" class="flex items-center text-sm font-bold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            Keterangan / Alasan
                        </label>
                        <textarea 
                            id="keterangan_izin" 
                            name="keterangan_izin" 
                            rows="5"
                            placeholder="Jelaskan alasan izin atau sakit Anda secara singkat. Contoh: Menghadiri acara keluarga, Demam tinggi dan perlu istirahat, dll."
                            class="w-full px-4 py-3 text-gray-700 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-300 hover:border-green-300 resize-none"
                        >{{ old('keterangan_izin') }}</textarea>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Jelaskan dengan jelas dan singkat
                        </div>
                        @error('keterangan_izin')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- File Upload dengan Preview -->
                    <div class="group">
                        <label for="file_bukti_izin" class="flex items-center text-sm font-bold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            </div>
                            File Bukti (Opsional)
                        </label>
                        
                        <div class="relative">
                            <div class="flex items-center justify-center w-full">
                                <label for="file_bukti_izin" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gradient-to-br from-gray-50 to-blue-50 hover:bg-gray-100 hover:border-blue-400 transition-all duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-12 h-12 mb-3 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-600">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-500">JPG, PNG, atau PDF (Max. 2MB)</p>
                                    </div>
                                    <input 
                                        id="file_bukti_izin" 
                                        type="file" 
                                        name="file_bukti_izin"
                                        accept="image/jpeg,image/png,application/pdf"
                                        class="hidden"
                                        onchange="previewFile(this)"
                                    >
                                </label>
                            </div>
                            
                            <!-- Preview area -->
                            <div id="file-preview" class="hidden mt-4 p-4 bg-blue-50 border-2 border-blue-200 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p id="file-name" class="text-sm font-semibold text-gray-800"></p>
                                            <p id="file-size" class="text-xs text-gray-600"></p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-2 flex items-start text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Upload surat dokter atau bukti pendukung lainnya (opsional)</span>
                        </div>
                        
                        @error('file_bukti_izin')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="border-t-2 border-gray-100"></div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 hover:shadow-md group">
                            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white bg-gradient-to-r from-purple-500 via-indigo-500 to-blue-500 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>

            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-md border border-blue-100 p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-2">Informasi Penting</h4>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Pengajuan izin harus diajukan maksimal H-1 sebelum tanggal izin
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Untuk sakit, lampirkan surat dokter jika memungkinkan
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Status pengajuan dapat dilihat di halaman riwayat izin
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function previewFile(input) {
            const preview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validasi ukuran file (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    input.value = '';
                    return;
                }
                
                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipe file tidak didukung! Hanya JPG, PNG, atau PDF.');
                    input.value = '';
                    return;
                }
                
                // Tampilkan preview
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                preview.classList.remove('hidden');
                preview.classList.add('animate-fadeIn');
            }
        }
        
        function removeFile() {
            const input = document.getElementById('file_bukti_izin');
            const preview = document.getElementById('file-preview');
            
            input.value = '';
            preview.classList.add('hidden');
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Add animation class
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 0.3s ease-out;
            }
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
            .animate-shake {
                animation: shake 0.4s ease-in-out;
            }
        `;
        document.head.appendChild(style);
    </script>
    @endpush
</x-app-layout>