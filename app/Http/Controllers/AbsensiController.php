<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Memproses data scan QR Code atau input kode manual dari aparat.
     */
    public function scan(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'token' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $tokenDiterima = $request->token;

        // PERBAIKAN: Gunakan Asia/Jakarta untuk WIB (Surabaya)
        // Jika aplikasi untuk wilayah WITA, gunakan 'Asia/Makassar'
        $currentTime = Carbon::now('Asia/Jakarta');
        $today = $currentTime->format('Y-m-d');
        $userId = Auth::id();

        // Ambil data lokasi dari request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // 2. Validasi Token
        $secretKey = env('ABSENSI_SECRET_KEY', 'RAHASIA-DESA-ANDA-123');
        $tokenHarapan = hash('sha256', $secretKey . $today);

        // Generate kode numerik yang valid
        $numericCodeHarapan = substr(hexdec(substr($tokenHarapan, 0, 8)), 0, 6);
        $numericCodeHarapan = str_pad($numericCodeHarapan, 6, '0', STR_PAD_LEFT);

        // Cek apakah token adalah hash lengkap ATAU kode numerik 6 digit
        $isValidToken = false;

        if ($tokenDiterima === $tokenHarapan) {
            // Token hash lengkap dari QR Code
            $isValidToken = true;
        } elseif (strlen($tokenDiterima) === 6 && ctype_digit($tokenDiterima)) {
            // Kode numerik 6 digit dari input manual
            if ($tokenDiterima === $numericCodeHarapan) {
                $isValidToken = true;
            }
        }

        if (!$isValidToken) {
            return response()->json([
                'message' => 'Kode atau QR Code tidak valid atau sudah kadaluarsa.'
            ], 400);
        }

        // 3. Cek data absensi hari ini
        $absenHariIni = Absensi::where('user_id', $userId)
            ->whereDate('tanggal_absen', $today)
            ->first();

        // Definisi jam kerja (timezone WIB untuk Surabaya)
        $jamMasukBatas = Carbon::parse($today . ' 08:00:00', 'Asia/Jakarta');
        $jamMasukAkhir = Carbon::parse($today . ' 13:59:59', 'Asia/Jakarta');

        // Cek apakah hari Jumat
        $isJumat = $currentTime->isFriday();

        if ($isJumat) {
            // Jumat: absen pulang mulai jam 11:00 WIB
            $jamPulangMulai = Carbon::parse($today . ' 11:00:00', 'Asia/Jakarta');
            $jamPulangAkhir = Carbon::parse($today . ' 17:00:00', 'Asia/Jakarta');
        } else {
            // Senin-Kamis & Sabtu: absen pulang 14:00 - 17:00 WIB
            $jamPulangMulai = Carbon::parse($today . ' 14:00:00', 'Asia/Jakarta');
            $jamPulangAkhir = Carbon::parse($today . ' 17:00:00', 'Asia/Jakarta');
        }

        if ($absenHariIni) {
            // --- LOGIKA ABSENSI PULANG ---

            if ($absenHariIni->jam_pulang !== null) {
                return response()->json([
                    'message' => 'Anda sudah melakukan absensi MASUK dan PULANG hari ini.'
                ], 400);
            }

            // Validasi waktu pulang
            $hariIni = $isJumat ? 'Jumat' : 'hari ini';
            $jamMulaiText = $isJumat ? '11:00' : '14:00';

            if ($currentTime->lt($jamPulangMulai)) {
                $waktuTersisa = $currentTime->diffInMinutes($jamPulangMulai);
                return response()->json([
                    'message' => "Belum waktunya absen pulang. Waktu absen pulang {$hariIni} mulai pukul {$jamMulaiText} WIB (tersisa {$waktuTersisa} menit)."
                ], 400);
            }

            if ($currentTime->gt($jamPulangAkhir)) {
                return response()->json([
                    'message' => 'Waktu absen pulang sudah lewat. Batas absen pulang adalah pukul 17:00 WIB. Silakan hubungi admin.'
                ], 400);
            }

            // Update jam pulang dan lokasi pulang
            $absenHariIni->jam_pulang = $currentTime->format('H:i:s');
            $absenHariIni->latitude_pulang = $latitude;
            $absenHariIni->longitude_pulang = $longitude;
            $absenHariIni->save();

            return response()->json([
                'message' => 'Absensi PULANG berhasil dicatat pada ' . $currentTime->format('H:i:s') . ' WIB. Selamat beristirahat!'
            ], 200);
        } else {
            // --- LOGIKA ABSENSI MASUK ---

            // Validasi: Cek apakah masih dalam jam kerja masuk (08:00 - 13:59 WIB)
            if ($currentTime->gt($jamMasukAkhir)) {
                return response()->json([
                    'message' => 'Waktu absen masuk sudah lewat. Batas absen masuk adalah pukul 13:59 WIB. Silakan hubungi admin.'
                ], 400);
            }

            $jamMasuk = $currentTime->format('H:i:s');

            // Semua yang absen dalam rentang 08:00 - 13:59 statusnya "hadir"
            $status = 'hadir';
            $messageStatus = 'Terima kasih sudah absen.';

            // Buat data absensi baru dengan lokasi masuk
            Absensi::create([
                'user_id' => $userId,
                'tanggal_absen' => $today,
                'jam_masuk' => $jamMasuk,
                'status_kehadiran' => $status,
                'latitude_masuk' => $latitude,
                'longitude_masuk' => $longitude,
            ]);

            return response()->json([
                'message' => "Absensi MASUK berhasil dicatat pada {$jamMasuk} WIB. {$messageStatus}"
            ], 200);
        }
    }
}
