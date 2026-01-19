<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Absensi Desa</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts (Tailwind) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Animasi untuk elemen latar belakang yang mengapung */
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            .animate-float-delayed {
                animation: float 8s ease-in-out infinite;
                animation-delay: 2s;
            }
            .animate-float-slow {
                animation: float 10s ease-in-out infinite;
                animation-delay: 1s;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50 overflow-hidden relative h-screen w-screen">
        
        <!-- Latar Belakang Dekoratif (Blobs) -->
        <div class="absolute inset-0 overflow-hidden -z-10">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
            <div class="absolute top-20 -right-20 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-delayed"></div>
            <div class="absolute -bottom-40 left-20 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-slow"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>
        </div>

        <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-lg text-center relative">
                
                <!-- Kartu Efek Kaca (Glassmorphism) -->
                <div class="relative bg-white/60 backdrop-blur-xl border border-white/50 rounded-3xl shadow-2xl p-8 sm:p-12 overflow-hidden group transition-all duration-300 hover:shadow-purple-500/20">
                    
                    <!-- Efek Kilau Halus -->
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/40 to-transparent opacity-50 pointer-events-none"></div>

                    <!-- Wadah Ikon -->
                    <div class="mb-6 relative inline-block">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-white to-gray-100 rounded-2xl shadow-lg flex items-center justify-center relative z-10 transform group-hover:scale-110 transition-transform duration-300 border border-white">
                            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <!-- Glow di belakang ikon -->
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 bg-indigo-500 rounded-full blur-xl opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>
                    </div>

                    <!-- Kode Error Besar -->
                    <h1 class="text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 tracking-tighter mb-2 drop-shadow-sm">
                        @yield('code')
                    </h1>

                    <!-- Badge Judul Error -->
                    <div class="inline-block mb-6">
                        <span class="px-4 py-1.5 rounded-full text-sm font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm">
                            @yield('title')
                        </span>
                    </div>
                    
                    <!-- Detail Pesan -->
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        @yield('detail')
                    </p>

                    <!-- Tombol Kembali Keren -->
                    <a href="{{ url('/') }}" class="relative inline-flex items-center justify-center px-8 py-3 text-base font-bold text-white transition-all duration-200 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    
                    <!-- Footer Kecil -->
                    <div class="mt-10 text-xs text-gray-400 font-medium uppercase tracking-widest opacity-60">
                        Absensi Desa App
                    </div>
                </div>
                
                <!-- Bayangan Bawah untuk Kedalaman -->
                <div class="absolute -bottom-4 left-8 right-8 h-4 bg-black/20 blur-xl rounded-[100%] -z-10"></div>
            </div>
        </div>
    </body>
</html>