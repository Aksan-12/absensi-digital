<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $absensiData;

    /**
     * Menerima data yang sudah difilter dari controller
     */
    public function __construct(Collection $absensiData)
    {
        $this->absensiData = $absensiData;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->absensiData;
    }

    /**
     * Menyiapkan data baris per baris
     */
    public function map($absen): array
    {
        return [
            $absen->user->name ?? 'User Dihapus', // Mengambil nama dari relasi
            $absen->tanggal_absen,
            $absen->jam_masuk,
            $absen->jam_pulang ?? 'Belum Absen',
            ucfirst($absen->status_kehadiran),
        ];
    }

    /**
     * Menentukan header kolom
     */
    public function headings(): array
    {
        return [
            'Nama Aparat',
            'Tanggal Absen',
            'Jam Masuk',
            'Jam Pulang',
            'Status',
        ];
    }
}
