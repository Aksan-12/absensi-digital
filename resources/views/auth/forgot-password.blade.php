<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password? Masukkan email Anda, password baru, dan Kode Otorisasi yang didapat dari Admin untuk mereset password secara langsung.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <!-- Error Token -->
    @if ($errors->has('reset_token'))
        <div class="mb-4 text-sm text-red-600">
            {{ $errors->first('reset_token') }}
        </div>
    @endif

    {{-- UBAH ACTION KE ROUTE RESET LANGSUNG --}}
    <form method="POST" action="{{ route('password.direct-reset') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kode Otorisasi (KEAMANAN TAMBAHAN) -->
        <div class="mt-4">
            <x-input-label for="reset_token" :value="__('Kode Otorisasi (Minta ke Admin)')" />
            <x-text-input id="reset_token" class="block mt-1 w-full border-yellow-500 focus:border-yellow-600 focus:ring-yellow-500" 
                          type="text" 
                          name="reset_token" 
                          placeholder="Masukkan kode rahasia..."
                          required />
            <p class="text-xs text-gray-500 mt-1">Kode ini diperlukan untuk verifikasi keamanan.</p>
        </div>

        <!-- Password Baru -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password Baru')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-semibold rounded-lg transition ease-in-out duration-150">
                {{ __('← Kembali ke Beranda') }}
            </a>
            <x-primary-button>
                {{ __('Ganti Password Sekarang') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>