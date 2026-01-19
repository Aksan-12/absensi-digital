<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'tanggal_absen',
        'jam_masuk',
        'status_kehadiran',
        'jam_pulang',

        // Kolom Lokasi
        'latitude_masuk',
        'longitude_masuk',
        'latitude_pulang',
        'longitude_pulang',

        // Kolom Baru untuk Fitur Izin/Sakit
        'keterangan_izin',
        'file_bukti_izin',
        'status_izin', // 0=Pending, 1=Disetujui, 2=Ditolak
        'catatan_admin_izin',
    ];

    /**
     * Definisikan relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Paksa semua kolom tanggal/waktu untuk ditampilkan dalam Asia/Makassar
    protected function serializeDate(\DateTimeInterface $date)
    {
        return \Carbon\Carbon::instance($date)->setTimezone('Asia/Makassar')->format('Y-m-d H:i:s');
    }

    // Accessor untuk jam_masuk agar selalu keluar sebagai WITA
    public function getJamMasukAttribute($value)
    {
        if (!$value) return null;
        return \Carbon\Carbon::parse($value)->timezone('Asia/Makassar')->format('H:i:s');
    }

    // Accessor untuk jam_pulang agar selalu keluar sebagai WITA
    public function getJamPulangAttribute($value)
    {
        if (!$value) return null;
        return \Carbon\Carbon::parse($value)->timezone('Asia/Makassar')->format('H:i:s');
    }
}
