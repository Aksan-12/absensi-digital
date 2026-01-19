<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Jabatan dengan Tom Select -->
        <div class="mt-4">
            <x-input-label for="jabatan-select" :value="__('Jabatan')" />
            
            <select 
                id="jabatan-select" 
                name="jabatan" 
                required
                @error('jabatan') class="border-red-500" @enderror
            >
                <option value="">-- Pilih Jabatan --</option>
                <option value="Ketua BPD" {{ old('jabatan') == 'Ketua BPD' ? 'selected' : '' }}>Ketua BPD</option>
                <option value="Wakil Ketua BPD" {{ old('jabatan') == 'Wakil Ketua BPD' ? 'selected' : '' }}>Wakil Ketua BPD</option>
                <option value="Sekretaris BPD" {{ old('jabatan') == 'Sekretaris BPD' ? 'selected' : '' }}>Sekretaris BPD</option>
                <option value="Anggota BPD 1" {{ old('jabatan') == 'Anggota BPD 1' ? 'selected' : '' }}>Anggota BPD 1</option>
                <option value="Anggota BPD 2" {{ old('jabatan') == 'Anggota BPD 2' ? 'selected' : '' }}>Anggota BPD 2</option>
                <option value="Kepala Desa" {{ old('jabatan') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                <option value="Sekretaris Desa" {{ old('jabatan') == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                <option value="Kaur Keuangan" {{ old('jabatan') == 'Kaur Keuangan' ? 'selected' : '' }}>Kaur Keuangan</option>
                <option value="Kaur Perencanaan" {{ old('jabatan') == 'Kaur Perencanaan' ? 'selected' : '' }}>Kaur Perencanaan</option>
                <option value="Kasi Pemerintahan" {{ old('jabatan') == 'Kasi Pemerintahan' ? 'selected' : '' }}>Kasi Pemerintahan</option>
                <option value="Kasi Kesejahteraan" {{ old('jabatan') == 'Kasi Kesejahteraan' ? 'selected' : '' }}>Kasi Kesejahteraan</option>
                <option value="Kasi Pelayanan" {{ old('jabatan') == 'Kasi Pelayanan' ? 'selected' : '' }}>Kasi Pelayanan</option>
                <option value="Kepala Dusun I" {{ old('jabatan') == 'Kepala Dusun I' ? 'selected' : '' }}>Kepala Dusun I</option>
                <option value="Kepala Dusun II" {{ old('jabatan') == 'Kepala Dusun II' ? 'selected' : '' }}>Kepala Dusun II</option>
                <option value="Kepala Dusun III" {{ old('jabatan') == 'Kepala Dusun III' ? 'selected' : '' }}>Kepala Dusun III</option>
                <option value="Kepala Dusun IV" {{ old('jabatan') == 'Kepala Dusun IV' ? 'selected' : '' }}>Kepala Dusun IV</option>
                <option value="Ketua Linmas" {{ old('jabatan') == 'Ketua Linmas' ? 'selected' : '' }}>Ketua Linmas</option>
                <option value="Wakil Linmas" {{ old('jabatan') == 'Wakil Linmas' ? 'selected' : '' }}>Wakil Linmas</option>
                <option value="Anggota Linmas 1" {{ old('jabatan') == 'Anggota Linmas 1' ? 'selected' : '' }}>Anggota Linmas 1</option>
                <option value="Anggota Linmas 2" {{ old('jabatan') == 'Anggota Linmas 2' ? 'selected' : '' }}>Anggota Linmas 2</option>
                <option value="Anggota Linmas 3" {{ old('jabatan') == 'Anggota Linmas 3' ? 'selected' : '' }}>Anggota Linmas 3
                <option value="Anggota Linmas 4" {{ old('jabatan') == 'Anggota Linmas 4' ? 'selected' : '' }}>Anggota Linmas 4</option>
                <option value="Anggota Linmas 5" {{ old('jabatan') == 'Anggota Linmas 5' ? 'selected' : '' }}>Anggota Linmas 5</option>
                <option value="Anggota Linmas 6" {{ old('jabatan') == 'Anggota Linmas 6' ? 'selected' : '' }}>Anggota Linmas 6</option>
                <option value="Anggota Linmas 7" {{ old('jabatan') == 'Anggota Linmas 7' ? 'selected' : '' }}>Anggota Linmas 7</option>
                <option value="Anggota Linmas 8" {{ old('jabatan') == 'Anggota Linmas 8' ? 'selected' : '' }}>Anggota Linmas 8</option>
                <option value="Lainnya" {{ old('jabatan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
            
            <p class="mt-1 text-sm text-gray-600">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Ketik untuk mencari jabatan
            </p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah daftar? Klik Disini.') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    {{-- Script untuk menambahkan class error jika ada validation error --}}
    @if($errors->has('jabatan'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.querySelector('.tom-select-jabatan');
            if (wrapper) {
                wrapper.classList.add('has-error');
            }
        });
    </script>
    @endif
</x-guest-layout>