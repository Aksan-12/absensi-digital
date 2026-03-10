<div align="center">

# 🏢 Absensi Digital

**Sistem Manajemen Kehadiran Pegawai Berbasis Web**

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

Aplikasi absensi digital berbasis web yang memudahkan instansi dan perusahaan dalam mencatat kehadiran pegawai, mengelola pengajuan izin, serta mencetak laporan absensi secara efisien.

[Fitur](#-fitur-utama) · [Instalasi](#-panduan-instalasi) · [Teknologi](#%EF%B8%8F-teknologi-yang-digunakan) · [Struktur Proyek](#-struktur-proyek)

</div>

---

## ✨ Fitur Utama

Aplikasi ini dilengkapi sistem otorisasi multi-peran **(Role-based Access Control)** yang membedakan hak akses antara **Admin** dan **Aparat/Pegawai**.

### 👨‍💻 Fitur Admin

| Fitur | Deskripsi |
|---|---|
| 📊 **Dashboard Admin** | Ringkasan statistik kehadiran dan status pegawai secara real-time |
| 📋 **Manajemen Absensi** | Melihat dan mengelola data kehadiran seluruh pegawai |
| 📝 **Manajemen Izin** | Menyetujui atau menolak pengajuan izin/cuti pegawai |
| 📈 **Laporan** | Menghasilkan laporan absensi berdasarkan periode tertentu |
| 📤 **Export Data** | Mengekspor laporan kehadiran ke format **PDF** dan **Excel** |

### 👮‍♂️ Fitur Aparat / Pegawai

| Fitur | Deskripsi |
|---|---|
| 🖥️ **Dashboard Aparat** | Melihat riwayat kehadiran dan status izin pribadi |
| 📍 **Pencatatan Kehadiran** | Absensi lengkap dengan pencatatan lokasi (koordinat GPS) |
| 🗓️ **Pengajuan Izin** | Mengajukan izin tidak masuk (sakit, cuti, dll.) kepada Admin |
| 👤 **Manajemen Profil** | Mengubah informasi profil, jabatan, dan kata sandi |

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel (PHP)
- **Frontend:** Blade Templating Engine, Tailwind CSS
- **Asset Bundler:** Vite
- **Database:** MySQL / MariaDB
- **Package Tambahan:**
  - [Laravel Excel](https://laravel-excel.com/) — Export data ke format Excel
  - [DomPDF](https://github.com/barryvdh/laravel-dompdf) — Export laporan ke format PDF

---

## 📋 Persyaratan Sistem

Pastikan sistem Anda telah terinstal perangkat berikut sebelum memulai:

- ✅ **PHP** >= 8.2
- ✅ **Composer**
- ✅ **Node.js** & **npm**
- ✅ **MySQL** / MariaDB

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1. Clone Repositori

```bash
git clone <url-repositori-anda>
cd absensi-digital
```

### 2. Instal Dependensi PHP

```bash
composer install
```

### 3. Instal Dependensi Node.js & Build Assets

```bash
npm install
npm run build
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Migrasi Database & Seeding

Perintah ini akan membuat struktur tabel dan mengisi data awal (termasuk akun Admin default):

```bash
php artisan migrate --seed
```

### 7. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses melalui browser di: **http://localhost:8000**

---

## 📂 Struktur Proyek

```
absensi-digital/
├── app/
│   ├── Http/
│   │   └── Controllers/        # Logika utama (Absensi, Izin, Laporan)
│   └── Models/                 # Model database (User, Absensi)
├── database/
│   └── migrations/             # Skema tabel (lokasi, izin, jabatan)
├── resources/
│   └── views/
│       ├── admin/              # Tampilan UI untuk Admin
│       ├── aparat/             # Tampilan UI untuk Aparat/Pegawai
│       └── auth/               # Tampilan autentikasi (login, dll.)
└── ...
```

---

## 📄 Lisensi

Proyek ini bersifat open-source dan tersedia di bawah [Lisensi MIT](LICENSE).
