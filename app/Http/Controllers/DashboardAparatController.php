<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardAparatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::now()->format('Y-m-d');
        $statusAbsensi = [
            'masuk' => false,
            'pulang' => false,
            'message' => 'Anda belum melakukan absensi hari ini.',
            'jam_masuk' => null,
            'jam_pulang' => null,
            'terlambat' => false,
        ];

        $absenHariIni = Absensi::where('user_id', $userId)
            ->whereDate('tanggal_absen', $today)
            ->first();

        if ($absenHariIni) {
            $statusAbsensi['masuk'] = true;
            $statusAbsensi['jam_masuk'] = $absenHariIni->jam_masuk;

            if ($absenHariIni->jam_pulang) {
                $statusAbsensi['pulang'] = true;
                $statusAbsensi['jam_pulang'] = $absenHariIni->jam_pulang;
                $statusAbsensi['message'] = 'Anda sudah melakukan absensi masuk dan pulang hari ini.';
            } else {
                $statusAbsensi['message'] = 'Anda sudah absen masuk. Silakan scan lagi untuk absen pulang.';
            }

            if ($absenHariIni->status_kehadiran == 'terlambat') {
                $statusAbsensi['terlambat'] = true;
            }
        }

        return view('dashboard', compact('statusAbsensi'));
    }
}
