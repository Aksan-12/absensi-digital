<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAparatController;
use App\Http\Controllers\PengajuanIzinController;

use App\Http\Controllers\Auth\DirectResetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD LOGIC (Pemisah Admin & Aparat) ---
Route::get('/dashboard', function () {
    // 1. Cek jika rolenya admin
    if (auth()->user()->role == 'admin') {
        // 2. Jika ya, arahkan ke dashboard admin
        return redirect()->route('admin.dashboard');
    }

    // 3. Jika bukan, panggil controller dashboard aparat
    return app(DashboardAparatController::class)->index();
})->middleware(['auth', 'verified'])->name('dashboard');


// --- GRUP ROUTE UNTUK ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Halaman utama admin
    Route::get('/dashboard', [AdminAbsensiController::class, 'index'])->name('dashboard');

    // Halaman laporan & Ekspor
    Route::get('/laporan', [AdminAbsensiController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/excel', [AdminAbsensiController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/pdf', [AdminAbsensiController::class, 'exportPDF'])->name('laporan.pdf');

    // Manajemen Izin
    Route::get('/manajemen-izin', [AdminAbsensiController::class, 'manajemenIzin'])->name('izin.manajemen');
    Route::post('/manajemen-izin/{absensi}/approve', [AdminAbsensiController::class, 'approveIzin'])->name('izin.approve');
    Route::post('/manajemen-izin/{absensi}/reject', [AdminAbsensiController::class, 'rejectIzin'])->name('izin.reject');
});


// --- ROUTE PROFIL & APARAT ---
Route::middleware('auth')->group(function () {
    // Rute Profil Bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE FITUR IZIN (APARAT) ---
    Route::get('/pengajuan-izin', [PengajuanIzinController::class, 'create'])->name('izin.create');
    Route::post('/pengajuan-izin', [PengajuanIzinController::class, 'store'])->name('izin.store');
});

// --- ROUTE SCAN QR ---
Route::post('/absensi/scan', [AbsensiController::class, 'scan'])
    ->middleware('auth')
    ->name('absensi.scan');


// --- ROUTE RESET PASSWORD LANGSUNG (FIX ERROR ROUTE NOT FOUND) ---
// Pastikan controller DirectResetController sudah dibuat sebelumnya
Route::post('/forgot-password/direct', [DirectResetController::class, 'store'])
    ->middleware('guest')
    ->name('password.direct-reset');


require __DIR__ . '/auth.php';

// --- ROUTE DEBUG WAKTU (Opsional, bisa dihapus nanti) ---
Route::get('/debug-waktu', function () {
    $now = \Carbon\Carbon::now();

    $lastAbsen = \App\Models\Absensi::latest()->first();

    return response()->json([
        '1. Config Timezone' => config('app.timezone'),
        '2. Server/PHP Time' => date('Y-m-d H:i:s P'),
        '3. Carbon Now' => $now->format('Y-m-d H:i:s P'),
        '4. Carbon Now (Default TZ)' => $now->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s P'),
        '5. Database Time (NOW())' => \Illuminate\Support\Facades\DB::select('SELECT NOW() as db_time')[0]->db_time,
        '6. Sample Data di DB (Mentah)' => $lastAbsen ? $lastAbsen->created_at->format('Y-m-d H:i:s P') : 'Belum ada data',
        '7. Sample Data (dikonversi ke Makassar)' => $lastAbsen ? $lastAbsen->created_at->setTimezone('Asia/Makassar')->format('Y-m-d H:i:s P') : '-',
    ]);
});
