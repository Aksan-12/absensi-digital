<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\User; // <-- Pastikan User model di-import
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin (QR Code + Kode Numerik + Statistik)
     */
    public function index()
    {
        // 1. Tentukan string rahasia
        $secretKey = env('ABSENSI_SECRET_KEY', 'RAHASIA-DESA-ANDA-123');

        // 2. Buat token unik untuk hari ini
        // (Pastikan timezone di config/app.php sudah Asia/Makassar)
        $today = Carbon::now()->format('Y-m-d');
        $token = hash('sha256', $secretKey . $today);

        // 3. Generate Kode Numerik 6 Digit
        $numericCode = substr(hexdec(substr($token, 0, 8)), 0, 6);
        $numericCode = str_pad($numericCode, 6, '0', STR_PAD_LEFT);

        // 4. Ambil Statistik
        $totalAparat = User::where('role', 'aparat')->count();

        $absenMasukHariIni = Absensi::whereDate('tanggal_absen', $today)
            ->whereNotNull('jam_masuk')
            ->count();

        $absenPulangHariIni = Absensi::whereDate('tanggal_absen', $today)
            ->whereNotNull('jam_pulang')
            ->count();

        $belumAbsenMasuk = $totalAparat - $absenMasukHariIni;

        // 5. Kirim token, kode numerik, dan statistik ke view
        return view('admin.dashboard', compact(
            'token',
            'numericCode',
            'totalAparat',
            'absenMasukHariIni',
            'absenPulangHariIni',
            'belumAbsenMasuk'
        ));
    }

    /**
     * Menampilkan halaman laporan absensi bulanan.
     */
    public function laporan(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $absensiBulanIni = $this->getDataAbsensi($bulan);

        return view('admin.laporan', [
            'absensiHariIni' => $absensiBulanIni, // <-- Ini variabel di web
            'bulan' => $bulan
        ]);
    }

    /**
     * Helper function untuk mengambil data absensi berdasarkan bulan.
     */
    private function getDataAbsensi($bulan)
    {
        $tanggal = Carbon::parse($bulan . '-01');

        // --- INI ADALAH QUERY YANG SUDAH DIPERBARUI ---
        return Absensi::with('user') // Pastikan relasi 'user' ada di model Absensi
            ->whereYear('tanggal_absen', $tanggal->year)
            ->whereMonth('tanggal_absen', $tanggal->month)

            // Tambahkan filter kondisi di sini:
            ->where(function ($query) {
                // 1. Ambil semua yang statusnya 'hadir'
                $query->where('status_kehadiran', 'hadir')
                    // 2. ATAU ambil yang statusnya 'izin'/'sakit' TAPI BUKAN yang ditolak (status 2)
                    ->orWhere(function ($subQuery) {
                        $subQuery->whereIn('status_kehadiran', ['izin', 'sakit'])
                            ->where('status_izin', '!=', 2); // 2 = Ditolak
                    });
            })

            ->orderBy('tanggal_absen', 'asc')
            ->orderBy('jam_masuk', 'asc')
            ->get();
        // --- AKHIR PERUBAHAN QUERY ---
    }

    /**
     * Menangani ekspor laporan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $dataAbsensi = $this->getDataAbsensi($bulan); // <-- Menggunakan query baru
        $namaFile = 'laporan_absensi_' . $bulan . '.xlsx';

        return Excel::download(new AbsensiExport($dataAbsensi), $namaFile);
    }

    /**
     * Menangani ekspor laporan ke PDF.
     */
    public function exportPDF(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $dataAbsensi = $this->getDataAbsensi($bulan); // <-- Menggunakan query baru

        // --- TAMBAHAN: Ambil data Kepala Desa untuk Tanda Tangan ---
        $kepalaDesa = User::where('jabatan', 'Kepala Desa')->first();
        // --------------------------------------------------------

        $namaFile = 'laporan_absensi_' . $bulan . '.pdf';

        $pdf = Pdf::loadView('admin.laporan_pdf', [
            'absensi' => $dataAbsensi, // <-- Ini variabel di PDF
            'bulan' => $bulan,
            'kepalaDesa' => $kepalaDesa // <-- Kirim data Kades ke PDF
        ]);

        return $pdf->download($namaFile);
    }

    /**
     * Menampilkan halaman manajemen izin (pending dan riwayat).
     */
    public function manajemenIzin()
    {
        $pengajuan_menunggu = Absensi::with('user')
            ->whereIn('status_kehadiran', ['izin', 'sakit'])
            ->where('status_izin', 0)
            ->orderBy('tanggal_absen', 'desc')
            ->get();

        $riwayat_pengajuan = Absensi::with('user')
            ->whereIn('status_kehadiran', ['izin', 'sakit'])
            ->whereIn('status_izin', [1, 2])
            ->orderBy('tanggal_absen', 'desc')
            ->limit(20)
            ->get();

        return view('admin.manajemen_izin', compact(
            'pengajuan_menunggu',
            'riwayat_pengajuan'
        ));
    }

    /**
     * Menyetujui pengajuan izin.
     */
    public function approveIzin($id)
    {
        $izin = Absensi::findOrFail($id);
        $izin->status_izin = 1;
        $izin->save();

        return redirect()->route('admin.izin.manajemen')->with('success', 'Pengajuan izin telah disetujui.');
    }

    /**
     * Menolak pengajuan izin.
     */
    public function rejectIzin($id)
    {
        $izin = Absensi::findOrFail($id);
        $izin->status_izin = 2;
        $izin->save();

        return redirect()->route('admin.izin.manajemen')->with('success', 'Pengajuan izin telah ditolak.');
    }
}
