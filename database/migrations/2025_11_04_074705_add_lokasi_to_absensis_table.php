<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Tambahkan kolom setelah 'jam_masuk'
            $table->string('latitude_masuk')->nullable()->after('jam_masuk');
            $table->string('longitude_masuk')->nullable()->after('latitude_masuk');

            // Tambahkan kolom setelah 'jam_pulang'
            $table->string('latitude_pulang')->nullable()->after('jam_pulang');
            $table->string('longitude_pulang')->nullable()->after('latitude_pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn([
                'latitude_masuk',
                'longitude_masuk',
                'latitude_pulang',
                'longitude_pulang'
            ]);
        });
    }
};
