<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'Arial', 'Times New Roman', serif;
            padding: 20px;
            background-color: white;
            color: #000;
            line-height: 1.6;
            font-size: 11px; /* Ukuran font default lebih kecil untuk PDF */
        }
        
        .container {
            width: 100%;
            margin: 0 auto;
            background: white;
        }
        
        /* Kop Surat */
        .letterhead {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .letterhead-top {
            /* Menggunakan table untuk layout agar lebih kompatibel dengan PDF */
            width: 100%;
        }

        .letterhead-top td {
            vertical-align: middle;
        }
        
        .logo {
            width: 80px; /* Lebar sel logo kiri */
            height: 70px;
            text-align: left;
        }
        .logo img {
            width: 70px;
            height: 70px;
        }
        
        .letterhead-text {
            text-align: center;
        }

        /* --- STYLE BARU UNTUK LOGO KANAN --- */
        .logo-right {
            width: 80px; /* Lebar sel logo kanan */
            height: 70px;
            text-align: right;
        }
        .logo-right img {
            width: 70px;
            height: 70px;
        }
        /* --- AKHIR STYLE BARU --- */

        .letterhead h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        
        .letterhead h3 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        
        .letterhead p {
            font-size: 11px;
            margin: 2px 0;
            text-align: center; /* Memaksa rata tengah */
        }
        
        /* Judul Dokumen */
        .document-title {
            text-align: center;
            margin: 20px 0 15px 0;
        }
        
        .document-title h1 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .document-title .period {
            font-size: 14px;
            margin-top: 5px;
        }
        
        /* Info Dokumen */
        .document-info {
            margin: 15px 0 20px 0;
            font-size: 12px;
        }
        
        .document-info table {
            width: 100%;
            max-width: 400px;
        }
        
        .document-info td {
            padding: 3px 0;
            vertical-align: top;
        }
        
        .document-info .label {
            width: 150px;
            font-weight: normal;
        }
        
        .document-info .colon {
            width: 20px;
        }
        
        /* Tabel Utama */
        .table-wrapper {
            margin: 20px 0;
        }
        
        .table { 
            width: 100%; 
            border-collapse: collapse;
            font-size: 10px; /* Font di dalam tabel lebih kecil */
            border: 1px solid #000;
        }
        
        .table th {
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #000;
            background-color: #f0f0f0;
            text-transform: uppercase;
        }
        
        .table td {
            padding: 8px;
            border: 1px solid #000;
            vertical-align: middle;
        }
        
        .table tbody tr {
            page-break-inside: avoid;
        }
        
        .table .text-center {
            text-align: center;
        }
        
        .table .text-right {
            text-align: right;
        }
        
        /* Status */
        .status-text {
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .summary-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        
        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .summary-table {
            width: 100%;
            max-width: 500px;
            border-collapse: collapse;
            font-size: 11px;
        }
        
        .summary-table td {
            padding: 8px;
            border: 1px solid #000;
        }
        
        .summary-table .label-col {
            width: 70%;
            font-weight: normal;
        }
        
        .summary-table .value-col {
            width: 30%;
            text-align: center;
            font-weight: bold;
        }
        
        /* Tanda Tangan */
        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        
        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
            font-size: 11px;
        }
        
        .signature-box .location-date {
            text-align: right;
            margin-bottom: 5px;
        }
        
        .signature-box .title {
            margin-bottom: 70px; /* Jarak untuk TTD */
        }
        
        .signature-box .name {
            font-weight: bold;
            text-decoration: underline;
        }
        
        .signature-box .position {
            margin-top: 2px;
        }
        
        /* Footer */
        .footer {
            clear: both;
            margin-top: 80px;
            padding-top: 15px;
            border-top: 1px solid #000;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat -->
        <div class="letterhead">
            <table class="letterhead-top">
                <tr>
                    <td class="logo">
                        <!-- Logo Kiri (okumel.png) -->
                        <img src="{{ public_path('images/okumel.png') }}" alt="Logo" style="width: 70px; height: 70px;">
                    </td>
                    <td class="letterhead-text">
                        <h2>PEMERINTAH KABUPATEN BANGGAI KEPULAUAN</h2>
                        <h3>KANTOR DESA OKUMEL</h3>
                        <p>Alamat: Desa Okumel, Kecamatan Liang, Kabupaten Banggai Kepulauan, Sulawesi Tengah.</p>
                        <p>Telp: +62 81354545825 | Email: pemdesokumel@gmail.com</p>
                    </td>
                    <!-- --- LOGO BARU DITAMBAHKAN DI SINI --- -->
                    <td class="logo-right">
                        <img src="{{ public_path('images/sulteng.png') }}" alt="Logo" style="width: 70px; height: 70px;">
                    </td>
                    <!-- --- AKHIR LOGO BARU --- -->
                </tr>
            </table>
        </div>
        
        <!-- Judul Dokumen (Dinamis) -->
        <div class="document-title">
            <h1>Laporan Rekapitulasi Absensi Aparat Desa</h1>
            <div class="period">Periode: {{ \Carbon\Carbon::parse($bulan)->isoFormat('MMMM YYYY') }}</div>
        </div>
        
        <!-- Info Dokumen (Dinamis) -->
        <div class="document-info">
            <table>
                <tr>
                    <td class="label">Nomor Dokumen</td>
                    <td class="colon">:</td>
                    <td>LAP/ABS/{{ \Carbon\Carbon::parse($bulan)->format('m/Y') }}/{{ $absensi->count() }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Cetak</td>
                    <td class="colon">:</td>
                    <td>{{ \Carbon\Carbon::now('Asia/Makassar')->isoFormat('D MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td class="label">Jumlah Data</td>
                    <td class="colon">:</td>
                    <td>{{ $absensi->count() }} Record</td>
                </tr>
            </table>
        </div>
        
        <!-- Tabel Data (Dinamis) -->
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 20%;">Nama Aparat</th>
                        <th style="width: 15%;">Jabatan</th>
                        <th style="width: 12%;">Tanggal</th>
                        <th style="width: 10%;">Jam Masuk</th>
                        <th style="width: 10%;">Jam Keluar</th>
                        <th style="width: 8%;">Durasi</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensi as $index => $absen)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                {{ $absen->user->name ?? 'User Dihapus' }}
                            </td>
                            <td>
                                {{ $absen->user->jabatan ?? '-' }}
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i:s') : '-' }}</td>
                            <td class="text-center">{{ $absen->jam_pulang ? \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i:s') : '-' }}</td>
                            <td class="text-center">
                                @if ($absen->jam_masuk && $absen->jam_pulang)
                                    @php
                                        $masuk = \Carbon\Carbon::parse($absen->jam_masuk);
                                        $pulang = \Carbon\Carbon::parse($absen->jam_pulang);
                                        $durasi = $pulang->diff($masuk)->format('%Hj %Im');
                                    @endphp
                                    {{ $durasi }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center status-text">
                                @if($absen->status_kehadiran == 'hadir')
                                    HADIR
                                @elseif($absen->status_kehadiran == 'izin')
                                    IZIN
                                @elseif($absen->status_kehadiran == 'sakit')
                                    SAKIT
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $absen->keterangan_izin ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 30px;">
                                Tidak ada data absensi untuk periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Tanda Tangan (Dinamis) -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="location-date">
                    Okumel, {{ \Carbon\Carbon::now('Asia/Makassar')->isoFormat('D MMMM YYYY') }}
                </div>
                <div class="title">
                    Kepala Desa,
                </div>
                <div class="name">
                    <!-- Jika Kades ada di DB, namanya muncul, jika tidak, pakai placeholder -->
                    ( {{ $kepalaDesa ? $kepalaDesa->name : 'Surianto U.Abbas' }} )
                </div>
                <div class="position">
                    {{ $kepalaDesa ? $kepalaDesa->jabatan : '' }}
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak secara otomatis melalui Sistem Absensi Desa Okumel dan sah tanpa tanda tangan basah.</p>
        </div>
    </div>
</body>
</html>