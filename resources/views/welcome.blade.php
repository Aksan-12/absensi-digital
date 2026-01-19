<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"> <!-- <-- INI YANG SAYA PERBAIKI DARI 'utf-t' -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Absensi Desa - Selamat Datang</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <!-- 
        PERBAIKAN: 
        Saya ganti  di atas dengan link CDN Tailwind. 
        Ini akan memastikan style (CSS) tetap dimuat walau 'npm run dev' tidak berjalan.
        -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Style kustom untuk animasi dan gradient -->
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
                50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
            }
            .float-animation {
                animation: float 3s ease-in-out infinite;
            }
            .fade-in-up {
                animation: fadeInUp 0.8s ease-out forwards;
            }
            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; }
            .delay-400 { animation-delay: 0.4s; }
            
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                position: relative;
                overflow: hidden;
            }
            .gradient-bg::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
                animation: rotate 20s linear infinite;
            }
            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            .card-hover {
                transition: all 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            }
            
            .btn-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        
        <!-- Navigation Bar -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass-effect">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="bg-white p-2 rounded-xl shadow-lg">
                            <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Absensi Desa</h1>
                            <p class="text-xs text-white/80">Sistem Presensi Modern</p>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-6 py-2.5 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-white font-semibold hover:text-yellow-300 transition-colors duration-300">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2.5 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-yellow-300 hover:text-indigo-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <div class="relative min-h-screen">
            
            <!-- Hero Section dengan Gradient -->
            <section class="gradient-bg pt-32 pb-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 left-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
                
                <div class="max-w-7xl mx-auto relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        
                        <!-- Left Content -->
                        <div class="text-white space-y-8 fade-in-up">
                            <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm font-medium">Sistem Aktif & Terpercaya</span>
                            </div>

                            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight">
                                Absensi Aparat Desa
                                <span class="block text-yellow-300 mt-2">Lebih Mudah!</span>
                            </h1>
                            
                            <p class="text-xl md:text-2xl text-white/90 leading-relaxed">
                                Sistem presensi digital dengan QR Code yang praktis, cepat, dan akurat untuk meningkatkan produktivitas kerja aparat desa.
                            </p>

                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-indigo-600 font-bold text-lg rounded-xl shadow-2xl hover:bg-yellow-300 hover:text-indigo-800 transition-all duration-300 transform hover:scale-105 btn-glow">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Mulai Sekarang
                                </a>
                                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold text-lg rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Pelajari Fitur
                                </a>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
                                <div>
                                    <div class="text-4xl font-bold text-yellow-300">100%</div>
                                    <div class="text-sm text-white/80 mt-1">Digital</div>
                                </div>
                                <div>
                                    <div class="text-4xl font-bold text-yellow-300">24/7</div>
                                    <div class="text-sm text-white/80 mt-1">Akses</div>
                                </div>
                                <div>
                                    <div class="text-4xl font-bold text-yellow-300">Aman</div>
                                    <div class="text-sm text-white/80 mt-1">Terpercaya</div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Illustration -->
                        <div class="relative fade-in-up delay-200">
                            <div class="relative z-10 float-animation">
                                <div class="bg-white rounded-3xl shadow-2xl p-8 backdrop-blur-lg">
                                    <!-- QR Code Illustration -->
                                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-8 mb-6">
                                        <svg class="w-full h-64 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm-2 8h8v8H3v-8zm2 6h4v-4H5v4zm8-16v8h8V3h-8zm6 6h-4V5h4v4zm-6 4h2v2h-2v-2zm2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm6-4h2v2h-2v-2zm0 4h2v4h-2v-4zm-2-2h2v2h-2v-2zm0-2h2v2h-2v-2zm2-2h2v2h-2v-2z"/>
                                        </svg>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-gray-900">Scan QR Code</div>
                                                <div class="text-sm text-gray-500">Presensi otomatis tercatat</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Floating Cards -->
                            <div class="absolute -top-10 -right-10 bg-white rounded-xl shadow-xl p-4 float-animation" style="animation-delay: 0.5s;">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Waktu Real-time</div>
                                        <div class="font-bold text-gray-900">{{ date('H:i:s') }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="absolute -bottom-10 -left-10 bg-white rounded-xl shadow-xl p-4 float-animation" style="animation-delay: 1s;">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Status</div>
                                        <div class="font-bold text-green-600">Aktif</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section id="fitur" class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16 fade-in-up">
                        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold mb-4">
                            Fitur Unggulan
                        </span>
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                            Kenapa Memilih Kami?
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Solusi terbaik untuk modernisasi sistem absensi desa dengan fitur-fitur canggih
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <!-- Feature 1 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-blue-500 fade-in-up">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Scan QR Code</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Cukup scan QR Code harian yang unik untuk mencatat kehadiran masuk dan pulang dengan cepat dan mudah.
                            </p>
                            <div class="mt-6 flex items-center text-blue-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-green-500 fade-in-up delay-100">
                            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Laporan Lengkap</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Admin dapat melihat rekapitulasi absensi bulanan dan mencetaknya ke format PDF atau Excel dengan mudah.
                            </p>
                            <div class="mt-6 flex items-center text-green-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-yellow-500 fade-in-up delay-200">
                            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Cepat & Akurat</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Tidak perlu lagi buku absensi manual. Data kehadiran dicatat secara real-time dengan akurasi tinggi.
                            </p>
                            <div class="mt-6 flex items-center text-yellow-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-purple-500 fade-in-up delay-300">
                            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Aman Terjamin</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Data absensi tersimpan dengan aman dan terenkripsi. Hanya yang berwenang yang dapat mengakses.
                            </p>
                            <div class="mt-6 flex items-center text-purple-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>

                        <!-- Feature 5 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-red-500 fade-in-up delay-400">
                            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Mobile Friendly</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Bisa diakses dari smartphone manapun. Tidak perlu instalasi aplikasi khusus, cukup browser saja.
                            </p>
                            <div class="mt-6 flex items-center text-red-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>

                        <!-- Feature 6 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border-t-4 border-indigo-500 fade-in-up delay-400">
                            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl w-16 h-16 flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">Manajemen Izin</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Aparat bisa mengajukan izin secara online dan admin dapat menyetujui atau menolak dengan mudah.
                            </p>
                            <div class="mt-6 flex items-center text-indigo-600 font-semibold">
                                <span>Pelajari lebih lanjut</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-semibol
d mb-4">
                            Cara Kerja
                        </span>
                        <h2 class="text-4xl md:text-5xl font-extrabold mb-4">
                            Mudah Digunakan dalam 3 Langkah
                        </h2>
                        <p class="text-xl text-white/90 max-w-2xl mx-auto">
                            Sistem absensi yang simpel dan efisien untuk aparat desa
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Step 1 -->
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 h-full card-hover border border-white/20">
                                <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 shadow-2xl">
                                    <span class="text-3xl font-bold text-white">1</span>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">Login ke Sistem</h3>
                                <p class="text-white/80 text-lg leading-relaxed">
                                    Masuk menggunakan akun yang sudah didaftarkan oleh admin desa dengan username dan password Anda.
                                </p>
                                <div class="mt-6">
                                    <svg class="w-full h-32 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                    </svg>
                                </div>
                            </div>
                            <!-- Arrow -->
                            <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                                <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 h-full card-hover border border-white/20">
                                <div class="bg-gradient-to-br from-green-400 to-emerald-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 shadow-2xl">
                                    <span class="text-3xl font-bold text-white">2</span>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">Scan QR Code</h3>
                                <p class="text-white/80 text-lg leading-relaxed">
                                    Arahkan kamera smartphone ke QR Code yang ditampilkan di kantor desa untuk mencatat kehadiran.
                                </p>
                                <div class="mt-6">
                                    <svg class="w-full h-32 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm-2 8h8v8H3v-8zm2 6h4v-4H5v4zm8-16v8h8V3h-8zm6 6h-4V5h4v4zm-6 4h2v2h-2v-2zm2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm6-4h2v2h-2v-2zm0 4h2v4h-2v-4zm-2-2h2v2h-2v-2zm0-2h2v2h-2v-2zm2-2h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <!-- Arrow -->
                            <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                                <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 h-full card-hover border border-white/20">
                                <div class="bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full w-16 h-16 flex items-center justify-center mb-6 shadow-2xl">
                                    <span class="text-3xl font-bold text-white">3</span>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">Selesai!</h3>
                                <p class="text-white/80 text-lg leading-relaxed">
                                    Absensi Anda otomatis tercatat dengan timestamp yang akurat. Lihat riwayat absensi di dashboard.
                                </p>
                                <div class="mt-6">
                                    <svg class="w-full h-32 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonial Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-16">
                        <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold mb-4">
                            Testimoni
                        </span>
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                            Apa Kata Mereka?
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Dipercaya oleh berbagai desa di Indonesia
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Testimonial 1 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    BS
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Budi Santoso</h4>
                                    <p class="text-sm text-gray-500">Kepala Desa Sukamaju</p>
                                </div>
                            </div>
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed">
                                "Sistem absensi ini sangat membantu kami dalam meningkatkan disiplin aparat desa. Proses absensi menjadi lebih cepat dan transparan!"
                            </p>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    SW
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Siti Wahyuni</h4>
                                    <p class="text-sm text-gray-500">Sekretaris Desa Makmur</p>
                                </div>
                            </div>
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed">
                                "Pembuatan laporan bulanan sekarang jadi mudah banget! Tinggal klik cetak PDF dan semua data langsung tersaji dengan rapi."
                            </p>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    AP
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Ahmad Pratama</h4>
                                    <p class="text-sm text-gray-500">Kaur Umum Desa Sejahtera</p>
                                </div>
                            </div>
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 italic leading-relaxed">
                                "Sangat mudah digunakan, bahkan untuk yang tidak terlalu paham teknologi. Interface-nya user-friendly sekali!"
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/2 translate-y-1/2"></div>
                
                <div class="max-w-4xl mx-auto text-center relative z-10">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
                        Siap Modernisasi Sistem Absensi Desa Anda?
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90 mb-10">
                        Bergabunglah dengan ratusan desa yang telah mempercayai sistem kami untuk mengelola absensi aparat dengan lebih efisien.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-5 bg-white text-indigo-600 font-bold text-lg rounded-xl shadow-2xl hover:bg-yellow-300 hover:text-indigo-800 transition-all duration-300 transform hover:scale-105 btn-glow">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Daftar Gratis Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-5 bg-transparent border-2 border-white text-white font-bold text-lg rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3
3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login
                        </a>
                    </div>
                    
                    <!-- Trust badges -->
                    <div class="mt-12 flex flex-wrap justify-center items-center gap-8 text-white/80">
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Aman & Terpercaya</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span>Mudah Digunakan</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                            <span>Akses Cepat</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                        <!-- Company Info -->
                        <div class="md:col-span-2">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="bg-indigo-600 p-2 rounded-xl shadow-lg">
                                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Absensi Desa</h3>
                                    <p class="text-sm text-gray-400">Sistem Presensi Modern</p>
                                </div>
                            </div>
                            <p class="text-gray-400 mb-4">
                                Solusi digital terpercaya untuk sistem absensi aparat desa di seluruh Indonesia. Meningkatkan efisiensi dan transparansi dalam pengelolaan kehadiran.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-lg font-bold mb-4">Menu Cepat</h4>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Beranda</a></li>
                                <li><a href="#fitur" class="text-gray-400 hover:text-white transition-colors duration-300">Fitur</a></li>
                                <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Login</a></li>
                                <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Daftar</a></li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div>
                            <h4 class="text-lg font-bold mb-4">Kontak</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-indigo-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-gray-400">Okumel, Indonesia</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-indigo-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-gray-400">pemdesokumel@gmail.com</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-indigo-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-gray-400">+62 81354545825</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Footer -->
                    <div class="border-t border-gray-800 pt-8 mt-8">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <p class="text-gray-400 text-sm mb-4 md:mb-0">
                                &copy; {{ date('Y') }} Absensi Desa Okumel.
                            </p>
                            <div class="flex space-x-6 text-sm">
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Kebijakan Privasi</a>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Syarat & Ketentuan</a>
                                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Bantuan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scroll to Top Button -->
        <button id="scrollToTop" class="fixed bottom-8 right-8 bg-indigo-600 text-white p-4 rounded-full shadow-2xl hover:bg-indigo-700 transition-all duration-300 transform hover:scale-110 opacity-0 invisible z-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>

        <script>
            // Scroll to Top Button
            const scrollBtn = document.getElementById('scrollToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollBtn.classList.remove('opacity-0', 'invisible');
                    scrollBtn.classList.add('opacity-100', 'visible');
                } else {
                    scrollBtn.classList.add('opacity-0', 'invisible');
                    scrollBtn.classList.remove('opacity-100', 'visible');
                }
            });

            scrollBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>
