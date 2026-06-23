# KASKU - Aplikasi Pengelolaan Kas & Transaksi

KASKU adalah aplikasi manajemen keuangan berbasis web yang dibangun menggunakan **Laravel 11** dan **Filament Admin Panel**. Aplikasi ini dirancang untuk memudahkan pencatatan, pemantauan, dan pengelolaan transaksi keuangan seperti Uang Kas dan Iuran Kegiatan (contoh: Study Tour).

## 🚀 Fitur Utama

- **Multi-Role Authentication**: Mendukung sistem hak akses untuk **Admin** dan **Anggota**.
- **Dashboard Admin Premium**: Antarmuka admin yang estetik dan modern dengan desain *Glassmorphism* dan *Glow effect*, didukung oleh Filament Panel.
- **Manajemen Akun & Jabatan**: Mengelola data anggota beserta jabatannya.
- **Pencatatan Transaksi Kas**: Sistem pencatatan kas masuk dan kas keluar dengan pembukuan yang rapi.
- **Manajemen Iuran & Pembayaran**: Kemampuan melacak anggota yang sudah atau belum membayar iuran wajib maupun iuran kegiatan (misal: Study Tour).
- **Frontend Interaktif**: Halaman monitoring kas publik dan form pembayaran yang responsif.
- **Log Aktivitas**: Memantau jejak aktivitas penting di dalam sistem.

## 🛠️ Teknologi yang Digunakan

- [PHP 8.2+](https://www.php.net/)
- [Laravel 11.x](https://laravel.com/)
- [FilamentPHP v3](https://filamentphp.com/) (Admin Panel)
- [MySQL](https://www.mysql.com/) (Database)
- [Tailwind CSS](https://tailwindcss.com/) (Styling)

## 📦 Panduan Instalasi (Lokal)

Jika Anda melakukan *clone* repository ini dan ingin menjalankannya di perangkat lokal:

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/username-anda/dbkasku-app.git
   cd dbkasku-app
   ```

2. **Setup Database:**
   - Pastikan aplikasi XAMPP/Laragon Anda berjalan.
   - Buat database baru di MySQL dengan nama `dbkasku_app` (atau sesuaikan dengan file `.env`).

3. **Jalankan Migrasi Database:**
   Karena file `.env` dan dependensi sudah termasuk dalam repository, Anda bisa langsung menjalankan migrasi:
   ```bash
   php artisan migrate:fresh --seed
   ```
   *(Perintah di atas akan mereset database dan mengisinya dengan data awal/dummy)*

4. **Kompilasi Aset (Opsional):**
   ```bash
   npm run build
   ```

5. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui: `http://localhost:8000`

## 🔐 Akses Default
*(Jika Anda menjalankan seeder bawaan)*

- **Halaman Admin:** `http://localhost:8000/admin`
- **Frontend / Landing Page:** `http://localhost:8000`

---
*Dibuat untuk mempermudah transparansi dan manajemen keuangan komunitas/kelas Anda.*
