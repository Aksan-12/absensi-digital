<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
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
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient 15s ease infinite;
            }
            .float-animation {
                animation: float 6s ease-in-out infinite;
            }
            .fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Background dengan Gradient Animasi -->
        <div class="min-h-screen flex relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 animate-gradient">
            
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <!-- Circles -->
                <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-pink-500/10 rounded-full blur-3xl"></div>
                
                <!-- Floating Icons -->
                <div class="absolute top-20 right-20 float-animation opacity-20">
                    <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    </svg>
                </div>
                <div class="absolute bottom-40 left-20 float-animation opacity-20" style="animation-delay: 2s;">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="absolute top-1/2 right-40 float-animation opacity-20" style="animation-delay: 4s;">
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                    </svg>
                </div>
            </div>

            <!-- Main Container -->
            <div class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
                <div class="w-full max-w-6xl">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        
                        <!-- Left Side - Branding & Info -->
                        <div class="hidden lg:block text-white space-y-8 fade-in-up">
                            <!-- Logo & Brand -->
                            <div class="flex items-center space-x-4">
                                <div class="bg-white p-3 rounded-2xl shadow-2xl">
                                    <x-application-logo class="w-12 h-12 text-indigo-600" />
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold">Absensi Desa</h1>
                                    <p class="text-white/80">Sistem Presensi Modern</p>
                                </div>
                            </div>

                            <!-- Ilustrasi/Info -->
                            <div class="space-y-6">
                                <div>
                                    <h2 class="text-4xl font-extrabold leading-tight mb-4">
                                        Kelola Absensi Aparat Desa dengan Lebih Mudah
                                    </h2>
                                    <p class="text-xl text-white/90 leading-relaxed">
                                        Sistem digital berbasis QR Code yang praktis, cepat, dan akurat untuk meningkatkan produktivitas kerja.
                                    </p>
                                </div>

                                <!-- Features List -->
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-lg">Scan QR Code</h3>
                                            <p class="text-white/80 text-sm">Absensi praktis dengan scan QR</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-lg">Laporan Real-time</h3>
                                            <p class="text-white/80 text-sm">Data absensi tersaji secara langsung</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-lg">Aman & Terpercaya</h3>
                                            <p class="text-white/80 text-sm">Data terenkripsi dengan baik</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="grid grid-cols-3 gap-4 pt-6">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">100%</div>
                                        <div class="text-sm text-white/80">Digital</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">24/7</div>
                                        <div class="text-sm text-white/80">Akses</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">Aman</div>
                                        <div class="text-sm text-white/80">Terpercaya</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Form Card -->
                        <div class="fade-in-up" style="animation-delay: 0.2s;">
                            <!-- Mobile Logo -->
                            <div class="lg:hidden text-center mb-8">
                                <a href="/" class="inline-flex items-center space-x-3">
                                    <div class="bg-white p-3 rounded-2xl shadow-2xl">
                                        <x-application-logo class="w-12 h-12 text-indigo-600" />
                                    </div>
                                    <div class="text-white text-left">
                                        <h1 class="text-2xl font-bold">Absensi Desa</h1>
                                        <p class="text-sm text-white/80">Sistem Presensi Modern</p>
                                    </div>
                                </a>
                            </div>

                            <!-- Form Card -->
                            <div class="glass-effect rounded-3xl shadow-2xl p-8 sm:p-10">
                                {{ $slot }}
                            </div>

                            <!-- Back to Home Link -->
                            <div class="text-center mt-6">
                                <a href="/" class="inline-flex items-center text-white hover:text-yellow-300 transition-colors duration-300 font-semibold">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="absolute bottom-0 left-0 right-0 p-6 text-center text-white/60 text-sm z-10">
                <p>&copy; {{ date('Y') }} Absensi Desa. Semua hak dilindungi.</p>
            </div>
        </div>
    </body>
</html>