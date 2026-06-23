# KASKU Landing Page Specification

## Project Overview

Buat landing page modern dan minimalis untuk aplikasi **KASKU**, sebuah sistem manajemen kas kelas yang membantu mengelola iuran, transaksi keuangan, pembayaran, dan laporan secara digital.

Target pengguna:

* Anggota kelas
* Bendahara kelas
* Admin kelas

Landing page harus terlihat profesional, modern, mudah digunakan, dan berfokus pada kebutuhan pengelolaan kas kelas.

---

## Tech Stack

Gunakan:

* Node.js
* React
* Next.js (App Router)
* TypeScript
* Tailwind CSS
* Framer Motion untuk animasi
* Lucide React untuk ikon

Pastikan kode terstruktur dengan baik, reusable, dan responsive.

---

## Design Direction

Gaya desain:

* Modern SaaS Dashboard
* Minimalis
* Clean
* Dark mode first

Inspirasi:

* Stripe
* Linear
* Vercel
* Notion

### Color Palette

Gunakan identitas visual sesuai logo KASKU.

* Primary Blue: `#003291`
* Secondary Blue: `#1A2F8A`
* Accent Gold: `#DCC070`
* Background: `#020617`
* Surface: `#0B122B`
* Text: `#F8FAFC`
* Muted Text: `#94A3B8`

Hindari penggunaan warna ungu.

Gunakan kombinasi biru dan emas sebagai identitas utama aplikasi.

Terapkan warna emas untuk highlight, ikon, statistik, dan elemen penting.

Pertahankan dark mode sebagai tema utama.

Gunakan gradient:

```css
linear-gradient(
  135deg,
  #003291 0%,
  #1A2F8A 60%,
  #DCC070 100%
)
```

Jangan gunakan:

* Warna ungu
* FAQ section
* Role & Akses section
* Testimoni
* Pricing section
* Blog section

---

## Branding

Nama aplikasi: **KASKU**

Tagline:

"Kelola keuangan kas kelas dengan lebih mudah."

Deskripsi:

KASKU membantu mengelola iuran, transaksi, pembayaran, dan laporan keuangan secara terpusat, aman, dan efisien.

Gunakan logo KASKU yang telah disediakan.

Tampilkan logo pada:

* Navbar
* Footer
* Favicon

Gunakan versi transparan jika tersedia.

---

## Navbar

Navbar harus sticky dengan efek blur saat halaman di-scroll.

Menu:

* Home
* Fitur
* Monitoring Kas
* Laporan
* Kontak

Tambahkan smooth scrolling untuk setiap menu.

### Tombol Aksi

#### Jika belum login

* Login → `/login`
* Daftar → `/register`

#### Jika login sebagai Anggota

* Profil
* Logout

#### Jika login sebagai Admin

* Dashboard Admin → `/admin`
* Profil
* Logout

Tombol "Dashboard Admin" hanya ditampilkan untuk role Admin.

---

## Authentication Rules

Sistem memiliki dua area yang berbeda.

### Portal Anggota

Route: `/dashboard`

Dapat diakses oleh:

* Anggota

Fitur:

* Monitoring kas pribadi
* Bayar kas bulanan
* Bayar tabungan study tour
* Riwayat pembayaran
* Profil pengguna

### Dashboard Admin

Route: `/admin`

Dapat diakses oleh:

* Admin
* Bendahara

Hak akses:

* Admin: Create, Read, Update, Delete
* Bendahara: Create, Read, Update

Dashboard Admin menggunakan Filament.

Portal Anggota dan Dashboard Admin adalah dua antarmuka yang terpisah.

---

## User Flow

### 1. Pengunjung (Belum Login)

Pengguna dapat:

* Melihat landing page
* Melihat fitur utama
* Melihat statistik kas kelas
* Login
* Mendaftar akun

Pengguna tidak dapat melihat data pembayaran atau dashboard.

### 2. Anggota (Setelah Login)

Anggota masuk ke Portal Anggota (`/dashboard`).

Fitur yang tersedia:

#### Monitoring Kas Kelas

Menampilkan data yang terhubung langsung dengan database.

Kolom:

* Nama anggota
* Kas bulan berjalan
* Status pembayaran
* Tabungan study tour
* Total pembayaran
* Sisa tagihan

Anggota hanya dapat melihat data miliknya sendiri.

#### Pembayaran Kas

Anggota dapat:

* Memilih periode pembayaran
* Melihat nominal kas
* Melakukan pembayaran kas

Status pembayaran:

* Lunas
* Belum Lunas

#### Pembayaran Tabungan Study Tour

Anggota dapat:

* Melihat target tabungan
* Melihat total tabungan terkumpul
* Melakukan pembayaran study tour

#### Riwayat Pembayaran

Menampilkan:

* Tanggal pembayaran
* Jenis iuran
* Periode
* Nominal
* Status

### 3. Bendahara

Bendahara masuk ke Dashboard Admin (`/admin`).

Fitur:

* Mengelola pembayaran iuran
* Mengelola transaksi
* Melihat data anggota
* Melihat laporan
* Memverifikasi pembayaran

Hak akses:

* Create
* Read
* Update

Bendahara tidak dapat menghapus data.

### 4. Admin

Admin masuk ke Dashboard Admin (`/admin`).

Fitur:

* Mengelola akun pengguna
* Mengelola jenis iuran
* Mengelola periode
* Mengelola jabatan
* Mengelola kategori transaksi
* Mengelola transaksi
* Mengelola pembayaran
* Mengelola laporan

Hak akses:

* Create
* Read
* Update
* Delete

---

## Alur Pembayaran

```text
Anggota Login
      ↓
Membuka Halaman Monitoring Kas
      ↓
Memilih Jenis Iuran
(Kas Bulanan / Study Tour)
      ↓
Memilih Periode
      ↓
Melakukan Pembayaran
      ↓
Data Masuk ke Tabel Pembayaran
      ↓
Status Pembayaran Diperbarui
      ↓
Dashboard Admin dan Bendahara Terupdate
```

---

## Integrasi Data

Semua data menggunakan satu database terpusat.

```text
Pembayaran Anggota
        ↓
Tabel Pembayaran Iuran
        ↓
Dashboard Admin & Bendahara
        ↓
Laporan Keuangan
        ↓
Saldo Kas Terupdate
```

---

## Landing Page Sections

1. Hero Section
2. Statistik Kas Kelas
3. Fitur Utama
4. Monitoring Kas
5. Laporan Keuangan
6. Kontak

---

## Hero Section

Headline:

"Kelola Keuangan Kas Kelas dengan Lebih Mudah"

Subheadline:

Pantau pembayaran kas, kelola tabungan study tour, dan lihat laporan keuangan kelas secara real-time dalam satu platform.

Call to Action:

* Mulai Sekarang → `/register`
* Login → `/login`

Jika pengguna login sebagai Admin, tampilkan tombol:

* Dashboard Admin → `/admin`

---

## Statistik Kas Kelas

Tampilkan 4 kartu statistik.

* Total Anggota
* Total Pemasukan Kas
* Total Tabungan Study Tour
* Persentase Pembayaran Lunas

Gunakan animasi counter saat halaman dibuka.

---

## Fitur Utama

Landing page harus menampilkan fitur berikut:

* Monitoring kas kelas secara real-time
* Pembayaran kas bulanan
* Pembayaran tabungan study tour
* Riwayat pembayaran
* Laporan pemasukan dan pengeluaran
* Status pembayaran anggota

---

## Monitoring Kas

Tampilkan preview tabel monitoring kas.

Kolom:

* Nama Anggota
* Kas Bulanan
* Tabungan Study Tour
* Total Pembayaran
* Sisa Tagihan
* Status

Status menggunakan badge:

* Lunas
* Belum Lunas

Gunakan data contoh yang realistis.

Tambahkan fitur:

* Search
* Filter periode
* Filter jenis iuran

---

## Laporan Keuangan

Tampilkan:

* Total pemasukan
* Total pengeluaran
* Saldo kas saat ini
* Riwayat transaksi terbaru

Tambahkan visualisasi grafik sederhana untuk pemasukan dan pengeluaran.

---

## Kontak

Tampilkan:

"Jika ada keluhan atau pertanyaan, hubungi kami."

Informasi:

* Email Admin
* WhatsApp Admin

---

## Footer

Footer harus berisi:

* Logo KASKU
* Deskripsi singkat aplikasi
* Link navigasi
* Email Admin
* WhatsApp Admin

Tambahkan teks:

© 2026 KASKU. All rights reserved.

---

## Routing

* Landing Page: `/`
* Login: `/login`
* Register: `/register`
* Portal Anggota: `/dashboard`
* Dashboard Admin: `/admin`
* Logout: `/logout`

---

## Technical Requirements

* Fully responsive
* Mobile first
* Accessibility friendly
* Optimized performance
* Reusable components
* Clean folder structure
* Semantic HTML
* SEO friendly

Tambahkan metadata:

Title:

KASKU - Sistem Manajemen Kas Kelas

Description:

Aplikasi manajemen kas kelas untuk mengelola iuran, transaksi, pembayaran, dan laporan keuangan secara digital.

---

## Output Format

Buat seluruh source code Next.js lengkap.

Struktur folder:

* app/
* components/
* public/
* styles/

Pisahkan setiap section menjadi komponen terpisah.

Jangan gunakan data dummy yang berlebihan.

Gunakan placeholder image jika diperlukan.

Berikan kode yang siap dijalankan dengan:

```bash
npm install
npm run dev
```
