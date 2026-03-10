Absensi Digital 🏢⏱️

Aplikasi Absensi Digital berbasis web yang dibangun menggunakan framework Laravel. Aplikasi ini mempermudah instansi atau perusahaan dalam mencatat kehadiran pegawai/aparat, mengelola pengajuan izin, serta mencetak laporan absensi secara efisien.

✨ Fitur Utama

Aplikasi ini memiliki sistem otorisasi multi-peran (Role-based) yang membedakan hak akses antara Admin dan Aparat/Pegawai.

👨‍💻 Fitur Admin

Dashboard Admin: Ringkasan statistik kehadiran dan status pegawai.

Manajemen Absensi: Melihat dan mengelola data kehadiran seluruh pegawai.

Manajemen Izin: Menyetujui atau menolak pengajuan izin/cuti pegawai.

Laporan: Menghasilkan laporan absensi periode tertentu.

Export Data: Mengekspor laporan kehadiran ke format PDF dan Excel.

👮‍♂️ Fitur Aparat/Pegawai

Dashboard Aparat: Melihat riwayat kehadiran dan status izin pribadi.

Pencatatan Kehadiran (Absensi): Melakukan absensi lengkap dengan pencatatan lokasi (koordinat).

Pengajuan Izin: Mengajukan izin tidak masuk (sakit, cuti, dll) kepada Admin.

Manajemen Profil: Mengubah informasi profil, jabatan, dan kata sandi.

🛠️ Teknologi yang Digunakan

Backend: Laravel (PHP)

Frontend: Blade Templating, Tailwind CSS

Asset Bundler: Vite

Database: MySQL / MariaDB

Package Tambahan: Laravel Excel (untuk export data), DomPDF (untuk export laporan PDF)

📋 Persyaratan Sistem (Prerequisites)

Sebelum menginstal aplikasi ini, pastikan sistem Anda sudah terinstal:

PHP >= 8.2

Composer

Node.js & npm

MySQL / MariaDB

🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

Kloning Repositori / Ekstrak Proyek
Jika menggunakan Git:

git clone <url-repositori-anda>
cd absensi-digital


Instal Dependensi PHP (Composer)

composer install


Instal Dependensi Node.js (NPM)

npm install
npm run build


Konfigurasi Environment
Salin file .env.example menjadi .env.

cp .env.example .env


Buka file .env di teks editor Anda dan sesuaikan kredensial database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=


Generate Application Key

php artisan key:generate


Migrasi Database & Seeding
Jalankan perintah ini untuk membuat struktur tabel dan mengisi data awal (seperti akun Admin default):

php artisan migrate --seed


Jalankan Aplikasi

php artisan serve


Aplikasi sekarang dapat diakses melalui browser di http://localhost:8000.

📂 Struktur Penting Proyek

app/Http/Controllers/: Logika utama aplikasi (Absensi, Izin, Laporan).

app/Models/: Model database (User, Absensi).

database/migrations/: Skema tabel database (termasuk kolom lokasi, izin, dan jabatan).

resources/views/: Antarmuka pengguna (UI) aplikasi yang terbagi menjadi folder admin/, aparat/, dan auth/.

📄 Lisensi

Proyek ini bersifat open-source dan tersedia di bawah Lisensi MIT.
