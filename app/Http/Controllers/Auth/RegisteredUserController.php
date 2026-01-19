<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $jabatanList = [
            'Ketua BPD',
            'Wakil Ketua BPD',
            'Sekretaris BPD',
            'Anggota BPD 1',
            'Anggota BPD 2',
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun I',
            'Kepala Dusun II',
            'Kepala Dusun III',
            'Kepala Dusun IV',
            'Ketua Linmas',
            'Wakil Linmas',
            'Anggota Linmas 1',
            'Anggota Linmas 2',
            'Anggota Linmas 3',
            'Anggota Linmas 4',
            'Anggota Linmas 5',
            'Anggota Linmas 6',
            'Anggota Linmas 7',
            'Anggota Linmas 8',
            'Lainnya',
        ];

        // Jabatan yang harus unik (hanya boleh 1 orang per jabatan)
        $uniqueRoles = [
            'Ketua BPD',
            'Wakil Ketua BPD',
            'Sekretaris BPD',
            'Anggota BPD 1',
            'Anggota BPD 2',
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Keuangan',
            'Kaur Perencanaan',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun I',
            'Kepala Dusun II',
            'Kepala Dusun III',
            'Kepala Dusun IV',
            'Ketua Linmas',
            'Wakil Linmas',
            'Anggota Linmas 1',
            'Anggota Linmas 2',
            'Anggota Linmas 3',
            'Anggota Linmas 4',
            'Anggota Linmas 5',
            'Anggota Linmas 6',
            'Anggota Linmas 7',
            'Anggota Linmas 8',
        ];

        // Ambil jabatan yang diinput
        $jabatanInput = $request->input('jabatan');

        // Buat aturan validasi dasar
        $jabatanRules = ['required', 'string', Rule::in($jabatanList)];

        // JIKA jabatan termasuk yang unik, tambahkan rule unique
        if (in_array($jabatanInput, $uniqueRoles)) {
            // FIXED: Hapus whereNull('deleted_at')
            $jabatanRules[] = Rule::unique('users', 'jabatan');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'jabatan' => $jabatanRules,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom error messages
            'jabatan.unique' => 'Jabatan :input sudah diambil oleh pengguna lain. Silakan pilih jabatan lain atau hubungi admin.',
            'jabatan.required' => 'Jabatan wajib dipilih.',
            'jabatan.in' => 'Jabatan yang dipilih tidak valid.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
