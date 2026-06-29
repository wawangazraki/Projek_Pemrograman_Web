# Sistem Informasi Keuangan Koperasi Permata

**Aplikasi Manajemen Keuangan untuk Koperasi Permata, Kabupaten Kuningan**

![Laravel](https://img.shields.io/badge/Laravel-12.0-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)

---

## 📋 Daftar Isi

1. [Gambaran Umum](#gambaran-umum)
2. [Fitur Utama](#fitur-utama)
3. [Persyaratan Sistem](#persyaratan-sistem)
4. [Instalasi](#instalasi)
5. [Konfigurasi](#konfigurasi)
6. [Menjalankan Aplikasi](#menjalankan-aplikasi)
7. [Struktur Project](#struktur-project)
8. [Dokumentasi Lengkap](#dokumentasi-lengkap)
9. [Akun Demo](#akun-demo)
10. [Kontak & Support](#kontak--support)

---

## 📌 Gambaran Umum

**Sistem Informasi Keuangan Koperasi Permata** adalah aplikasi web yang dirancang untuk membantu proses pencatatan keuangan Koperasi Permata. Aplikasi ini mengotomatisasi:

- Pencatatan kas masuk dan kas keluar
- Pembuatan jurnal umum
- Pengelolaan buku besar
- Pembuatan laporan neraca
- Pembuatan laporan laba/rugi
- Manajemen autentikasi pengguna

**Target Pengguna:**
- Pengurus Koperasi (Senior)
- Bendahara
- Staff Administrasi
- Pengguna (read-only)

---

## ✨ Fitur Utama

### 1. Dashboard
- Ringkasan kas masuk dan kas keluar bulanan
- Saldo bersih real-time
- Daftar 10 transaksi terbaru
- Widget statistik akun

### 2. Kas Masuk
- **CRUD** lengkap untuk pencatatan kas masuk
- Auto-generate kode transaksi
- Validasi form yang ketat
- Pagination untuk data besar
- Pencarian dan filter

### 3. Kas Keluar
- **CRUD** lengkap untuk pencatatan kas keluar
- Sama seperti Kas Masuk
- Organized by account (akun beban & kewajiban)

### 4. Jurnal Umum
- Tampilan semua transaksi dengan sistem debit-kredit
- Filter berdasarkan tanggal/bulan
- Menampilkan total debit dan kredit
- Verifikasi keseimbangan

### 5. Buku Besar
- Pengelompokan transaksi per akun
- Saldo running (saldo terakumulasi)
- Filter per akun dan periode
- Laporan lengkap per akun

### 6. Neraca (Balance Sheet)
- Menampilkan struktur aset, kewajiban, dan modal
- Saldo otomatis dari transaksi
- Verifikasi total aset = pasiva

### 7. Laporan Laba/Rugi
- Menampilkan pendapatan vs beban
- Perhitungan laba/rugi otomatis
- Filter berdasarkan periode

### 8. Autentikasi
- Login dengan email & password
- 3 tipe user: Admin, Bendahara, Pengguna
- Session management
- Logout

### 9. Tentang Koperasi
- Informasi profil koperasi
- Data keanggotaan
- Kontak koperasi

---

## 📦 Persyaratan Sistem

Sebelum melakukan instalasi, pastikan sistem Anda memenuhi:

### Minimum Requirements
- **PHP**: 8.2 atau lebih tinggi
- **MySQL**: 5.7 atau lebih tinggi (recommended: 8.0+)
- **Composer**: Latest version
- **Node.js & npm**: Opsional (jika perlu asset compilation)

### Browser Support
- Chrome/Chromium (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

---

## 🚀 Instalasi

### Langkah 1: Download & Extract Project

```bash
# Jika menggunakan Laragon di C:\laragon\www
cd C:\laragon\www
# Extract Project_Koperasi.zip ke direktori ini
```

### Langkah 2: Pindah ke Direktori Project

```bash
cd Project_Koperasi
```

### Langkah 3: Install Dependencies Composer

```bash
composer install
```

Tunggu hingga selesai (mungkin butuh beberapa menit).

### Langkah 4: Copy File Environment

```bash
# Windows Command Prompt
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### Langkah 5: Generate Application Key

```bash
php artisan key:generate
```

---

## ⚙️ Konfigurasi

### Edit File .env

Buka file `.env` di text editor dan sesuaikan konfigurasi database:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=koperasi_permata    # Nama database
DB_USERNAME=root                # Username MySQL
DB_PASSWORD=                    # Password MySQL (kosongkan jika default)
```

### Buat Database

Buka **MySQL/phpMyAdmin** dan buat database baru:

```sql
CREATE DATABASE koperasi_permata CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 🎯 Menjalankan Aplikasi

### Langkah 1: Jalankan Migration

Migration adalah proses membuat struktur tabel database otomatis.

```bash
php artisan migrate
```

### Langkah 2: Seed Database (Opsional)

Seeding adalah proses mengisi database dengan data dummy/contoh.

```bash
php artisan db:seed
```

Ini akan membuat:
- 3 user demo (Admin, Bendahara, Pengguna)
- 20+ akun chart of accounts
- 13 transaksi sample

### Langkah 3: Jalankan Server

```bash
php artisan serve
```

Output akan menunjukkan:

```
   INFO  Server running on [http://127.0.0.1:8000].
```

### Langkah 4: Buka Browser

Navigasi ke: **http://localhost:8000**

---

## 📁 Struktur Project

```
Project_Koperasi/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Semua controller aplikasi
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── TransactionController.php
│   │   │   ├── ReportController.php
│   │   │   └── HomeController.php
│   │   └── Middleware/          # Middleware request
│   └── Models/                   # Model Eloquent ORM
│       ├── User.php
│       ├── Transaction.php       # Model untuk transaksi (Jurnal Umum)
│       └── Akun.php             # Model untuk Chart of Accounts
│
├── bootstrap/
│   └── app.php                  # Bootstrap file aplikasi
│
├── config/                       # Semua file konfigurasi
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── cache.php
│
├── database/
│   ├── migrations/              # Semua migration files
│   │   ├── create_users_table.php
│   │   ├── create_akuns_table.php
│   │   ├── create_transactions_table.php
│   │   └── create_password_reset_tokens_table.php
│   └── seeders/                 # Semua seeder files
│       ├── UserSeeder.php
│       ├── AkunSeeder.php
│       ├── TransactionSeeder.php
│       └── DatabaseSeeder.php
│
├── public/                       # File publik (CSS, JS, images)
│   ├── index.php                # Entry point aplikasi
│   ├── css/
│   └── js/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/                   # Semua template Blade
│       ├── layouts/
│       │   └── app.blade.php    # Layout master
│       ├── auth/
│       │   └── login.blade.php
│       ├── transactions/        # Views transaksi
│       │   ├── kas_masuk_index.blade.php
│       │   ├── kas_masuk_create.blade.php
│       │   ├── kas_keluar_index.blade.php
│       │   ├── kas_keluar_create.blade.php
│       │   └── edit.blade.php
│       ├── reports/             # Views laporan
│       │   ├── jurnal_umum.blade.php
│       │   ├── buku_besar.blade.php
│       │   ├── neraca.blade.php
│       │   └── laba_rugi.blade.php
│       ├── dashboard.blade.php
│       ├── index.blade.php
│       └── tentang.blade.php
│
├── routes/
│   ├── web.php                  # Semua route aplikasi
│   └── console.php
│
├── storage/                      # Storage untuk file
│   ├── app/
│   ├── logs/
│   └── framework/
│
├── vendor/                       # Dependencies (di-generate saat composer install)
│
├── .env                         # Environment file (JANGAN COMMIT)
├── .env.example                 # Template .env
├── .gitignore
├── artisan                      # Laravel CLI tool
├── composer.json                # Dependency configuration
├── composer.lock                # Lock file dependencies
├── package.json
├── README.md                    # File ini
└── Dokumentasi/                 # Folder dokumentasi lengkap
    ├── Cara Install.md
    ├── Cara Menjalankan.md
    ├── Cara Presentasi.md
    ├── Penjelasan OOP.md
    ├── Penjelasan CRUD.md
    ├── Penjelasan Inheritance.md
    ├── Penjelasan Blade.md
    ├── Penjelasan Controller.md
    ├── Penjelasan Routing.md
    ├── Penjelasan Database.md
    ├── Penjelasan Bootstrap.md
    ├── Penjelasan Migration.md
    └── Penjelasan Eloquent.md
```

---

## 📚 Dokumentasi Lengkap

Folder `Dokumentasi/` berisi penjelasan detail untuk setiap konsep:

### 1. **Cara Install.md**
   - Panduan instalasi step-by-step
   - Troubleshooting error umum

### 2. **Cara Menjalankan.md**
   - Langkah menjalankan aplikasi
   - Troubleshooting runtime

### 3. **Cara Presentasi.md**
   - Tips presentasi untuk demo
   - Skenario use case

### 4. **Penjelasan OOP.md**
   - Konsep OOP (Object-Oriented Programming)
   - Implementasi di project ini

### 5. **Penjelasan CRUD.md**
   - Konsep CRUD (Create, Read, Update, Delete)
   - Implementasi di project ini

### 6. **Penjelasan Inheritance.md**
   - Konsep Inheritance
   - Contoh: Controller → User/Transaction

### 7. **Penjelasan Blade.md**
   - Template engine Blade
   - Directives dan fitur

### 8. **Penjelasan Controller.md**
   - Fungsi Controller
   - Struktur Controller di project

### 9. **Penjelasan Routing.md**
   - Sistem routing Laravel
   - Routes di project ini

### 10. **Penjelasan Database.md**
    - Database design
    - Entity Relationship Diagram (ERD)

### 11. **Penjelasan Bootstrap.md**
    - Framework CSS Bootstrap
    - Implementasi di project

### 12. **Penjelasan Migration.md**
    - Database migration
    - Struktur migration di project

### 13. **Penjelasan Eloquent.md**
    - ORM Eloquent
    - Query builder

---

## 👤 Akun Demo

Setelah menjalankan `php artisan db:seed`, gunakan akun ini untuk login:

### Admin Account
- **Email**: `admin@koperasi.local`
- **Password**: `password`
- **Role**: Admin (akses penuh)

### Bendahara Account
- **Email**: `bendahara@koperasi.local`
- **Password**: `password`
- **Role**: Bendahara (akses transaksi & laporan)

### User Account
- **Email**: `pengguna@koperasi.local`
- **Password**: `password`
- **Role**: Pengguna (read-only laporan)

---

## 🎓 Teknologi yang Digunakan

### Backend
- **Laravel 12** - Web framework PHP modern
- **PHP 8.2+** - Server-side scripting language
- **MySQL 8.0+** - Database management system
- **Eloquent ORM** - Object Relational Mapping

### Frontend
- **Bootstrap 5.3** - Responsive CSS framework
- **Blade** - Template engine
- **Font Awesome** - Icon library

### Tools
- **Composer** - PHP dependency manager
- **npm** - JavaScript package manager (optional)
- **Artisan** - Laravel CLI tool

---

## 📊 Database Schema

### Tabel USERS
```
users
├── id (primary key)
├── name (varchar)
├── email (unique)
├── password (hashed)
├── role (admin/bendahara/pengguna)
└── timestamps
```

### Tabel AKUNS (Chart of Accounts)
```
akuns
├── id (primary key)
├── kode_akun (unique) - contoh: 1101, 2101
├── nama_akun (varchar)
├── tipe_akun (enum: aktiva, kewajiban, modal, pendapatan, beban)
├── kategori (varchar) - contoh: Kas, Piutang
├── saldo_normal (enum: debit, kredit)
├── parent_id (foreign key untuk hierarchical)
└── timestamps
```

### Tabel TRANSACTIONS (Jurnal Umum)
```
transactions
├── id (primary key)
├── kode_transaksi (unique) - contoh: KM20240115001
├── tanggal (date)
├── jenis (enum: masuk, keluar)
├── akun_id (foreign key)
├── deskripsi (varchar)
├── jumlah (decimal)
├── catatan (text)
└── timestamps
```

---

## 🔐 Keamanan

Aplikasi ini mengimplementasikan:

1. **Authentication** - Login dengan email & password
2. **Authorization** - Role-based access control
3. **CSRF Protection** - Token CSRF pada setiap form
4. **Password Hashing** - Bcrypt untuk hash password
5. **SQL Injection Prevention** - Parametrized queries via Eloquent
6. **XSS Protection** - Output escaping via Blade

---

## 🐛 Troubleshooting

### Error: "Class 'App\Models\User' not found"
```bash
composer dump-autoload
```

### Error: "SQLSTATE[HY000]: General error: 1030"
```bash
# Pastikan MySQL running
# Restart MySQL service
```

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Port 8000 sudah digunakan
```bash
php artisan serve --port=8001
```

---

## 📞 Kontak & Support

Untuk pertanyaan atau masalah:

- **Email**: support@koperasi-permata.local
- **Lokasi**: Kabupaten Kuningan
- **Hotline**: (hubungi pengurus koperasi)

---

## 📄 Lisensi

Project ini dilisensikan di bawah **MIT License**.

---

## 🙏 Terima Kasih

Terima kasih telah menggunakan Sistem Informasi Keuangan Koperasi Permata.

**Dibuat dengan ❤️ untuk Koperasi Permata**

---

**Last Updated**: Januari 2024
**Version**: 1.0.0
**Status**: Production Ready ✅
