<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="bg-white p-2 rounded-lg shadow-md group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                            <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                        </div>
                        <span class="text-white font-bold text-xl hidden lg:block group-hover:text-yellow-300 transition-colors duration-300">
                            Absensi App
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-600 shadow-lg scale-105' : 'text-white hover:bg-white/20 hover:scale-105' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- --- MENU PROFIL DESA (BARU) --- --}}
                    <a href="https://profil-desa-okumel.vercel.app/" target="_blank"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 text-white hover:bg-white/20 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Profil Desa
                    </a>
                    {{-- ------------------------------- --}}

                    {{-- --- TAMPILKAN LINK KHUSUS ADMIN --- --}}
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.laporan') }}" 
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('admin.laporan') ? 'bg-white text-indigo-600 shadow-lg scale-105' : 'text-white hover:bg-white/20 hover:scale-105' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Laporan
                        </a>
                        
                        <div class="relative">
                            <a href="{{ route('admin.izin.manajemen') }}" 
                               class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('admin.izin.manajemen') ? 'bg-white text-indigo-600 shadow-lg scale-105' : 'text-white hover:bg-white/20 hover:scale-105' }}">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                Manajemen Izin
                            </a>
                            @if($pendingIzinCount > 0)
                                <span class="absolute -top-2 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full border-2 border-white animate-pulse">
                                    {{ $pendingIzinCount }}
                                </span>
                            @endif
                        </div>
                    
                    {{-- --- TAMPILKAN LINK KHUSUS APARAT --- --}}
                    @elseif(auth()->user()->role == 'aparat')
                        <a href="{{ route('izin.create') }}" 
                           class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('izin.create') ? 'bg-white text-indigo-600 shadow-lg scale-105' : 'text-white hover:bg-white/20 hover:scale-105' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Pengajuan Izin
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Role Badge -->
                <div class="mr-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ auth()->user()->role == 'admin' ? 'bg-yellow-400 text-yellow-900' : 'bg-green-400 text-green-900' }} shadow-md">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        {{ strtoupper(auth()->user()->role) }}
                    </span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-2 border-white/30 text-sm leading-4 font-medium rounded-lg text-white bg-white/10 backdrop-blur-sm hover:bg-white/20 hover:border-white hover:scale-105 focus:outline-none transition-all duration-300 ease-in-out shadow-md hover:shadow-xl">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-white text-indigo-600 flex items-center justify-center font-bold mr-2 shadow-md">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left mr-2">
                                    <div class="font-semibold">{{ Auth::user()->name }}</div>
                                </div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 bg-gradient-to-r from-indigo-50 to-purple-50">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center hover:bg-indigo-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/20 focus:outline-none focus:bg-white/20 transition duration-300 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/10 backdrop-blur-md">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <!-- Role Badge Mobile -->
            <div class="px-3 py-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ auth()->user()->role == 'admin' ? 'bg-yellow-400 text-yellow-900' : 'bg-green-400 text-green-900' }} shadow-md">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>

            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-600 shadow-md' : 'text-white hover:bg-white/20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Dashboard') }}
            </a>

            {{-- --- MENU PROFIL DESA RESPONSIVE (BARU) --- --}}
            <a href="https://profil-desa-okumel.vercel.app/" target="_blank"
               class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 text-white hover:bg-white/20">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                {{ __('Profil Desa') }}
            </a>
            {{-- ------------------------------------------ --}}

            {{-- --- TAMPILKAN LINK KHUSUS ADMIN (RESPONSIVE) --- --}}
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.laporan') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('admin.laporan') ? 'bg-white text-indigo-600 shadow-md' : 'text-white hover:bg-white/20' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('Laporan') }}
                </a>
                
                <div class="relative">
                    <a href="{{ route('admin.izin.manajemen') }}" 
                       class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('admin.izin.manajemen') ? 'bg-white text-indigo-600 shadow-md' : 'text-white hover:bg-white/20' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        {{ __('Manajemen Izin') }}
                    </a>
                    @if($pendingIzinCount > 0)
                        <span class="absolute top-2 right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full border-2 border-white animate-pulse">
                            {{ $pendingIzinCount }}
                        </span>
                    @endif
                </div>
            
            {{-- --- TAMPILKAN LINK KHUSUS APARAT (RESPONSIVE) --- --}}
            @elseif(auth()->user()->role == 'aparat')
                <a href="{{ route('izin.create') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 {{ request()->routeIs('izin.create') ? 'bg-white text-indigo-600 shadow-md' : 'text-white hover:bg-white/20' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Pengajuan Izin') }}
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20">
            <div class="px-4 mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white text-indigo-600 flex items-center justify-center font-bold text-lg shadow-md mr-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-white/80">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white/20 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="flex items-center px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-red-500/30 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>