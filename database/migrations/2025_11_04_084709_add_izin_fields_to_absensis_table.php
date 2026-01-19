<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom-kolom untuk fitur pengajuan izin/sakit.
     */
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Kolom ini akan menyimpan keterangan/alasan izin atau sakit
            $table->text('keterangan_izin')->nullable()->after('status_kehadiran');

            // Kolom ini akan menyimpan path/link ke file bukti (misal: surat dokter)
            $table->string('file_bukti_izin')->nullable()->after('keterangan_izin');

            // Kolom ini untuk admin menyetujui/menolak pengajuan
            // 0 = Pending, 1 = Disetujui, 2 = Ditolak
            $table->tinyInteger('status_izin')->default(0)->after('file_bukti_izin');

            // Kolom ini opsional, untuk admin memberi catatan saat menolak/menyetujui
            $table->text('catatan_admin_izin')->nullable()->after('status_izin');

            // Kita juga perlu membuat status_kehadiran bisa diisi 'izin' atau 'sakit'
            // Kita ubah 'default('hadir')' menjadi 'nullable()' agar bisa diisi status lain
            // Perintah change() membutuhkan 'doctrine/dbal' -> composer require doctrine/dbal
            $table->string('status_kehadiran')->default('hadir')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus kolom-kolom jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn([
                'keterangan_izin',
                'file_bukti_izin',
                'status_izin',
                'catatan_admin_izin'
            ]);

            // Kembalikan kolom status_kehadiran ke kondisi semula
            $table->string('status_kehadiran')->default('hadir')->nullable(false)->change();
        });
    }
};
