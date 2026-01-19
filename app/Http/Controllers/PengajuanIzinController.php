<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengajuanIzinController extends Controller
{
    /**
     * Menampilkan halaman form pengajuan izin.
     */
    public function create()
    {
        // Kita juga kirim data absensi hari ini, siapa tahu user mau mengajukan izin untuk hari ini
        $absensiHariIni = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal_absen', Carbon::today())
            ->first();

        // Cek apakah hari ini sudah ada absensi (masuk/pulang)
        $sudahAbsenHariIni = $absensiHariIni && ($absensiHariIni->jam_masuk || $absensiHariIni->status_kehadiran != 'hadir');

        return view('aparat.pengajuan_izin', [
            'sudahAbsenHariIni' => $sudahAbsenHariIni
        ]);
    }

    /**
     * Menyimpan data pengajuan izin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_izin' => 'required|date|after_or_equal:today',
            'tipe_izin' => 'required|in:izin,sakit', // Tipe harus 'izin' atau 'sakit'
            'keterangan_izin' => 'required|string|min:10',
            'file_bukti_izin' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Opsional, maks 2MB
        ]);

        $userId = Auth::id();
        $tanggalIzin = Carbon::parse($request->tanggal_izin)->format('Y-m-d');

        // Cek apakah sudah ada pengajuan/absensi di tanggal tersebut
        $cekAbsensi = Absensi::where('user_id', $userId)
            ->whereDate('tanggal_absen', $tanggalIzin)
            ->first();

        if ($cekAbsensi) {
            // Jika sudah ada (misal: sudah terlanjur absen masuk, atau sudah pernah mengajukan)
            return redirect()->back()
                ->with('error', 'Anda sudah memiliki data absensi atau pengajuan di tanggal tersebut.');
        }

        // Handle file upload
        $pathFileBukti = null;
        if ($request->hasFile('file_bukti_izin')) {

            // --- INI PERBAIKANNYA ---
            // Kita tentukan disk 'public' secara eksplisit.
            // Ini akan menyimpan file di 'storage/app/public/bukti_izin'
            // DAN mengembalikan path 'bukti_izin/namafile.png' (tanpa 'public/')
            $pathFileBukti = $request->file('file_bukti_izin')->store('bukti_izin', 'public');
            // --- AKHIR PERBAIKAN ---
        }

        // Buat data absensi baru dengan status "pending"
        Absensi::create([
            'user_id' => $userId,
            'tanggal_absen' => $tanggalIzin,
            'status_kehadiran' => $request->tipe_izin, // 'izin' atau 'sakit'
            'keterangan_izin' => $request->keterangan_izin,
            'file_bukti_izin' => $pathFileBukti, // Simpan path yang sudah benar
            'status_izin' => 0, // 0 = Pending (menunggu persetujuan admin)

            // Kolom absensi QR code kita biarkan null
            'jam_masuk' => null,
            'jam_pulang' => null,
            'latitude_masuk' => null,
            'longitude_masuk' => null,
            'latitude_pulang' => null,
            'longitude_pulang' => null,
        ]);

        return redirect()->route('dashboard') // Arahkan kembali ke dashboard
            ->with('success', 'Pengajuan izin berhasil dikirim. Mohon tunggu persetujuan Admin.');
    }
}
