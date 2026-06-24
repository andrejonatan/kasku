# Tugas Akhir Pemrograman Web
## KASKU
**Sistem Informasi Manajemen Kas Kelas**

* Nama aplikasi: `KASKU`
* Repository: `kasku`
* Database: `dbkasku_app`

---

## Deskripsi

KASKU (KasKu) merupakan sistem informasi berbasis web yang digunakan untuk membantu pengelolaan keuangan kelas secara digital. Sistem ini menyediakan fitur pengelolaan anggota, pembayaran iuran, tabungan study tour, transaksi keuangan, monitoring pembayaran, serta laporan keuangan yang dapat diakses sesuai hak akses pengguna.

Aplikasi dibangun menggunakan Laravel dan Filament Admin Panel dengan menerapkan Role Based Access Control (RBAC) menggunakan Spatie Permission.

---

## Struktur Folder

```text
dbkasku-app/
│
├── app/
│   │
│   ├── Console/
│   │   └── Commands/
│   │
│   ├── Filament/
│   │   │
│   │   ├── Pages/
│   │   ├── Widgets/
│   │   │
│   │   └── Resources/
│   │       │
│   │       ├── AkunUsers/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── Jabatans/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── JenisIurans/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── KategoriTransaksis/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── KegiatanKelas/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── LogAktivitas/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── PembayaranIurans/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       ├── Periodes/
│   │       │   ├── Pages/
│   │       │   └── Tables/
│   │       │
│   │       └── Transaksis/
│   │           ├── Pages/
│   │           └── Tables/
│   │
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── Controller.php
│   │       └── PaymentController.php
│   │
│   ├── Models/
│   │   ├── AkunUser.php
│   │   ├── Jabatan.php
│   │   ├── JenisIuran.php
│   │   ├── KategoriTransaksi.php
│   │   ├── KegiatanKelas.php
│   │   ├── LogAktivitas.php
│   │   ├── PembayaranIuran.php
│   │   ├── Periode.php
│   │   └── Transaksi.php
│   │
│   ├── Providers/
│   └── View/
│       └── Components/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── node_modules/
│
├── public/
│   ├── build/
│   │   └── assets/
│   ├── css/
│   ├── fonts/
│   ├── images/
│   ├── js/
│   ├── storage/
│   ├── favicon.ico
│   └── index.php
│
├── resources/
│   ├── css/
│   ├── js/
│   │
│   └── views/
│       ├── auth/
│       ├── filament/
│       ├── monitoring/
│       ├── payment/
│       ├── vendor/
│       └── welcome.blade.php
│
├── routes/
│   ├── web.php
│   └── console.php
│
├── storage/
├── tests/
├── vendor/
│
├── .env
├── .env.example
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── vite.config.js
└── README.md
```

## Keterangan Folder

| Folder | Fungsi |
|----------|----------|
| app/Filament | Menyimpan seluruh halaman dashboard admin berbasis Filament |
| app/Filament/Resources | Menyimpan CRUD Resource untuk setiap tabel database |
| app/Http/Controllers | Menyimpan controller autentikasi dan pembayaran |
| app/Models | Menyimpan model Eloquent yang terhubung dengan database |
| database/migrations | Menyimpan struktur tabel database |
| database/seeders | Menyimpan data awal sistem |
| public/ | Menyimpan aset yang dapat diakses browser |
| resources/views | Menyimpan tampilan frontend berbasis Blade |
| routes/web.php | Mendefinisikan routing aplikasi |
| storage/ | Menyimpan file upload dan cache aplikasi |
| vendor/ | Dependency Composer |
| node_modules/ | Dependency NPM |

## Fitur Utama

### Frontend

- Landing Page Modern & Responsive
- Monitoring Pembayaran Kas Anggota
- Monitoring Tabungan Study Tour
- Laporan Keuangan Kelas
- Login dan Logout Pengguna

### Backend (Admin Panel)

- Dashboard Admin
- Dashboard Bendahara
- Manajemen Akun Pengguna
- Manajemen Jabatan
- Manajemen Jenis Iuran
- Manajemen Periode
- Manajemen Kegiatan Kelas
- Manajemen Kategori Transaksi
- Manajemen Transaksi
- Manajemen Pembayaran Iuran
- Log Aktivitas
- RBAC (Role Based Access Control)

---

## Role Pengguna

### Admin

Memiliki hak akses penuh terhadap seluruh sistem:

- Create
- Read
- Update
- Delete

### Bendahara

Memiliki hak akses:

- Create
- Read
- Update

Tidak dapat menghapus data.

### Anggota

Memiliki hak akses terbatas untuk melihat informasi yang berkaitan dengan pembayaran dan monitoring kas.

---

## Teknologi yang Digunakan

### Backend

- PHP 8.3+
- Laravel 13
- Filament Admin Panel 5
- Spatie Permission

### Frontend

- Blade Template
- Tailwind CSS
- JavaScript

### Database

- MySQL / MariaDB

---

## Struktur Database

Tabel utama yang digunakan:

- akun_users
- jabatans
- jenis_iurans
- periodes
- pembayaran_iurans
- kategori_transaksis
- transaksis
- kegiatan_kelas
- log_aktivitas

Tabel RBAC:

- roles
- permissions
- model_has_roles
- model_has_permissions
- role_has_permissions

---

## Relasi Database

### One To Many

- Jabatan → Akun User
- Jenis Iuran → Pembayaran Iuran
- Periode → Pembayaran Iuran
- Kategori Transaksi → Transaksi
- Kegiatan Kelas → Transaksi

### Many To Many

- Akun User ↔ Role
- Role ↔ Permission

(Menggunakan package Spatie Permission)

---

# Setup Local

## Clone Repository

```bash
git clone https://github.com/andrejonatan/kasku.git

cd kasku
```

## Install Dependency PHP

```bash
composer install
```

## Konfigurasi Environment

```bash
copy .env.example .env

php artisan key:generate
```

Edit file `.env`

```env
APP_NAME=KASKU

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbkasku_app
DB_USERNAME=root
DB_PASSWORD=
```

## Install Dependency Frontend

```bash
npm install
```

## Migrasi Database

```bash
php artisan migrate:fresh --seed
```

## Storage Link

```bash
php artisan storage:link
```

## Build Asset

```bash
npm run build
```

atau selama development:

```bash
npm run dev
```

## Menjalankan Project

```bash
php artisan serve
```

Akses:

```text
Frontend
http://localhost:8000

Admin Panel
http://localhost:8000/admin
```

---

## Akun Default

### Admin

```text
Username : andre
Password : password
```

### Bendahara

```text
Username : nabilaputri32
Password : password
```

> Sesuaikan dengan data yang terdapat pada seeder project.

---

## Package yang Digunakan

### Filament

```bash
composer require filament/filament:"^5.0"
```

Digunakan untuk membangun Admin Panel dan seluruh fitur CRUD.

### Spatie Permission

```bash
composer require spatie/laravel-permission
```

Digunakan untuk implementasi Role Based Access Control (RBAC).

---

## Fitur RBAC

Sistem menggunakan Role Based Access Control (RBAC) dengan pembagian hak akses:

### Admin

- Kelola seluruh data
- Kelola role dan permission
- Kelola transaksi
- Kelola pembayaran
- Kelola laporan

### Bendahara

- Kelola pembayaran
- Kelola transaksi
- Kelola laporan

### Anggota

- Monitoring pembayaran
- Melihat laporan
- Melihat status iuran

---

## Pengembang

Project ini dibuat sebagai Tugas Akhir Mata Kuliah Pemrograman Web.

**KASKU**
Sistem Informasi Manajemen Kas Kelas
