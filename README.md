<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API untuk Praktikum CRUD

Dibuat di Upnormal 2 / 5 / 2026 21:00 Wita

## Fitur

### 1. RESTful API
- **Autentikasi**: Login/Logout dengan Laravel Sanctum
- **API Publik**: Posts dan Comments (tanpa autentikasi)
- **API Terproteksi**: Users, Pasien, Penyakit, dan Diagnosa (memerlukan Bearer token)

### 2. Dokumentasi API
Akses dokumentasi lengkap di `/docs` untuk melihat semua endpoint, request, dan response format.

### 3. Data Viewer
Fitur baru untuk melihat data database dalam format tabel yang mudah dibaca:
- **URL**: `/data`
- **Tabel yang tersedia**:
  - Posts - Artikel dan konten
  - Comments - Komentar pengguna
  - Users - Data pengguna
  - Pasien - Data pasien medis
  - Penyakit - Data penyakit dengan kode ICD

Desain Data Viewer konsisten dengan halaman dokumentasi menggunakan Bootstrap 5.

## Cara Menggunakan

1. Clone repository
2. Install dependencies: `composer install`
3. Setup environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Migrate database: `php artisan migrate`
6. Jalankan server: `php artisan serve`
7. Akses aplikasi:
   - Home: `http://localhost:8000`
   - Dokumentasi API: `http://localhost:8000/docs`
   - Data Viewer: `http://localhost:8000/data`
