<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// --- TAMBAHAN IMPORT UNTUK NOTIFIKASI ---
use Illuminate\Support\Facades\View; // Untuk membagikan variabel ke semua view
use Illuminate\Support\Facades\Schema; // Untuk memeriksa apakah tabel ada
use App\Models\Absensi; // Model yang digunakan untuk query notifikasi
// --- AKHIR TAMBAHAN IMPORT ---


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- KODE UNTUK MEMBAGIKAN HITUNGAN IZIN PENDING KE SEMUA VIEW ---

        // Kami menggunakan View::composer('*', ...) agar variabel ini
        // tersedia di *setiap* file Blade yang Anda render.
        View::composer('*', function ($view) {

            // Atur jumlah default ke 0
            $pendingIzinCount = 0;

            // Kita hanya menjalankan query jika:
            // 1. Schema::hasTable('absensis') -> Tabel 'absensis' ada (menghindari error saat migrasi)
            // 2. auth()->check() -> User sudah login (menghindari query untuk tamu)
            if (auth()->check() && Schema::hasTable('absensis')) {

                // Query ini berdasarkan AbsensiController Anda:
                // Menghitung absensi (izin/sakit) yang status_izin-nya masih 0 (pending)
                $pendingIzinCount = Absensi::whereIn('status_kehadiran', ['izin', 'sakit'])
                    ->where('status_izin', 0) // 0 = pending
                    ->count();
            }

            // Kirim variabel 'pendingIzinCount' ke semua view
            $view->with('pendingIzinCount', $pendingIzinCount);
        });

        // --- AKHIR DARI KODE NOTIFIKASI ---
    }
}
