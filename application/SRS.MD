# SISTEM PERESAPAN OBAT - SIMRS

Version: 2.1
Framework: CodeIgniter 3
Architecture: MVC
Database: MySQL
UI Framework: Bootstrap 5

---

# VALIDASI IMPLEMENTASI (2026-05-21)

## Ringkasan Audit

- Status: **Partially aligned** dengan implementasi saat ini.
- Modul `Pasien` sudah bisa alur `list -> simpan -> hapus`.
- Beberapa poin dokumen perlu disesuaikan agar konsisten dengan codebase aktual.

## Stack Runtime Terdeteksi

- PHP `8.3.15`
- Ekstensi database aktif: `mysqli`, `pdo_mysql`
- Framework: CodeIgniter 3
- Server lokal yang dipakai saat ini: Laragon (`http://localhost/contoh-ci/`)

## Kesesuaian MVC Aktual

- Controller terdeteksi: `Auth, Dashboard, User, Pasien, Dokter, Obat, Resep, Laporan`
- Model terdeteksi: `User_model, Pasien_model, Dokter_model, Obat_model, Resep_model`
- View utama terdeteksi untuk semua modul di atas.

Catatan:

- `Auth_model.php` dan `Dashboard_model.php` belum terdeteksi pada folder `application/models`.
- Modul `Pasien` pada implementasi saat ini memakai endpoint `simpan` (bukan `tambah`).
- Field `pasien` pada implementasi saat ini: `nama, alamat, no_hp, tanggal_lahir`.

## Konfigurasi Inti

- `base_url`: `http://localhost/contoh-ci/` (sudah sesuai folder project aktif)
- `index_page`: `index.php` (routing masih menggunakan `index.php`)
- `autoload`:
  - libraries: `database`, `session`
  - helper: `url`, `form`
- default route: `auth`

## Perbaikan yang Diimplementasikan Saat Audit Ini

- View `pasien/index` sudah memakai `site_url()` untuk aksi controller:
  - `pasien/simpan`
  - `pasien/hapus/{id}`
- Tujuan: mencegah `Not Found` saat `index.php` masih aktif pada konfigurasi URL CI3.
- View modul lain juga disesuaikan ke `site_url()`:
  - `user/simpan`, `user/hapus/{id}`
  - `dokter/simpan`, `dokter/hapus/{id}`
  - `obat/simpan`, `obat/hapus/{id}`
  - `resep/simpan`

## Audit Lintas Modul (2026-05-21)

### Auth

- Alur tersedia: `login`, `register`, `logout`.
- Menggunakan session (`session->set_userdata`) dan redirect ke `dashboard`.
- Catatan teknis: hashing password masih `md5` (perlu upgrade ke `password_hash/password_verify`).

### Dashboard

- Menampilkan statistik jumlah `pasien`, `dokter`, `obat`, `resep`.
- Sudah sesuai flow dashboard pada dokumen.

### User / Dokter / Obat

- Alur CRUD minimum berjalan: `index`, `simpan`, `hapus`.
- Field input sudah sesuai desain tabel di dokumen.

### Pasien

- Alur CRUD minimum berjalan: `index`, `simpan`, `hapus`.
- Field sudah sesuai desain terbaru: `nama`, `alamat`, `no_hp`, `tanggal_lahir`.

### Resep

- Alur transaksi dasar tersedia: simpan header `resep` + detail `resep_detail`.
- Catatan teknis: belum ada transaksi DB (`trans_start/trans_complete`) untuk menjaga konsistensi saat salah satu insert gagal.

### Laporan

- Rekap total per tanggal dari tabel `resep` sudah tersedia.
- Sudah sesuai kebutuhan laporan harian dasar.

---

# 1. PENDAHULUAN

## 1.1 Tujuan Sistem

Sistem ini dibuat untuk membantu proses:

- manajemen pasien
- manajemen dokter
- manajemen obat
- transaksi peresepan obat
- laporan penjualan obat

berbasis web menggunakan CodeIgniter 3.

---

## 1.2 Tujuan Pengembangan

- Mempermudah pengelolaan data rumah sakit
- Membuat transaksi resep lebih cepat
- Menyediakan laporan penjualan harian
- Menjadi sistem dasar SIMRS sederhana

---

# 2. TEKNOLOGI YANG DIGUNAKAN

## Backend

- PHP 7/8
- CodeIgniter 3

## Frontend

- Bootstrap 5
- Custom CSS

## Database

- MySQL

## Tools

- XAMPP
- phpMyAdmin
- VSCode

---

# 3. STRUKTUR MVC

## Controllers

- Auth.php
- Dashboard.php
- User.php
- Pasien.php
- Dokter.php
- Obat.php
- Resep.php
- Laporan.php

---

## Models

- Auth_model.php
- Dashboard_model.php
- User_model.php
- Pasien_model.php
- Dokter_model.php
- Obat_model.php
- Resep_model.php

---

## Views

### Auth

- login.php
- register.php

### Dashboard

- index.php

### User

- index.php

### Pasien

- index.php

### Dokter

- index.php

### Obat

- index.php

### Resep

- index.php

### Laporan

- index.php

### Template

- header.php
- footer.php
- sidebar.php
- main.php

---

# 4. STRUKTUR FOLDER

application/
├── controllers/
├── models/
├── views/
├── core/

assets/
├── css/
│ └── style.css

---

# 5. DATABASE DESIGN

## users

| Field    | Type    |
| -------- | ------- |
| id       | INT     |
| nama     | VARCHAR |
| username | VARCHAR |
| password | VARCHAR |
| role     | VARCHAR |

---

## pasien

| Field         | Type    |
| ------------- | ------- |
| id            | INT     |
| nama          | VARCHAR |
| alamat        | TEXT    |
| no_hp         | VARCHAR |
| tanggal_lahir | DATE    |

---

## dokter

| Field     | Type    |
| --------- | ------- |
| id        | INT     |
| nama      | VARCHAR |
| spesialis | VARCHAR |
| no_hp     | VARCHAR |

---

## obat

| Field     | Type    |
| --------- | ------- |
| id        | INT     |
| nama_obat | VARCHAR |
| stok      | INT     |
| harga     | INT     |

---

## resep

| Field     | Type |
| --------- | ---- |
| id        | INT  |
| pasien_id | INT  |
| dokter_id | INT  |
| user_id   | INT  |
| tanggal   | DATE |
| total     | INT  |

---

## resep_detail

| Field    | Type |
| -------- | ---- |
| id       | INT  |
| resep_id | INT  |
| obat_id  | INT  |
| qty      | INT  |
| harga    | INT  |
| subtotal | INT  |

---

# 6. RELASI DATABASE

- resep.pasien_id → pasien.id
- resep.dokter_id → dokter.id
- resep.user_id → users.id
- resep_detail.resep_id → resep.id
- resep_detail.obat_id → obat.id

---

# 7. FITUR SISTEM

## Authentication

- Login
- Register
- Logout
- Session Login

---

## Dashboard

Menampilkan:

- jumlah pasien
- jumlah dokter
- jumlah obat
- jumlah transaksi

---

## User Management

CRUD data user.

---

## Pasien Management

CRUD data pasien.

---

## Dokter Management

CRUD data dokter.

---

## Obat Management

CRUD data obat.

---

## Peresepan Obat

Fitur:

- pilih pasien
- pilih dokter
- pilih obat
- qty obat
- subtotal
- total pembayaran

---

## Laporan

Menampilkan:

- laporan transaksi harian
- total pemasukan

---

# 8. FLOW SISTEM

Login
↓
Dashboard
↓
Master Data
↓
Peresepan
↓
Laporan

---

# 9. UI DESIGN

## Styling

- Bootstrap 5
- Responsive Layout
- Sidebar Navigation
- Dashboard Card
- Table CRUD
- Form Bootstrap

---

## Layout

### Sidebar

Berisi:

- Dashboard
- User
- Pasien
- Dokter
- Obat
- Resep
- Laporan
- Logout

---

## Dashboard

Menampilkan card statistik.

---

## CRUD Interface

Menampilkan:

- table data
- tombol tambah
- form input

---

## Resep Interface

### Bagian Atas

Informasi:

- pasien
- dokter
- tanggal

### Bagian Tengah

Input obat:

- nama obat
- qty
- harga

### Bagian Bawah

Perhitungan:

- subtotal
- grand total

---

# 10. CUSTOM CSS

File:
assets/css/style.css

Digunakan untuk:

- sidebar
- dashboard
- table
- form
- spacing
- responsive

---

# 11. AUTHENTICATION FLOW

Register
↓
Login
↓
Session dibuat
↓
Masuk Dashboard

---

# 12. STATUS DEVELOPMENT

## COMPLETED

- Setup project CI3
- Konfigurasi database
- Struktur MVC
- Bootstrap integration
- Sidebar template
- Custom CSS
- Authentication UI
- CRUD User
- CRUD Pasien
- CRUD Dokter
- CRUD Obat
- Dashboard structure

---

## IN PROGRESS

- Resep transaction
- Dashboard statistics
- Laporan transaksi
- Session middleware

---

## TODO

- Edit data
- Validation form
- Search data
- Pagination
- Print laporan
- Stock otomatis berkurang
- SweetAlert notification

---

# 13. IMPLEMENTASI STYLE

## Bootstrap CDN

Header menggunakan:

- Bootstrap CSS CDN
- Bootstrap JS CDN

---

## Custom Styling

File:
assets/css/style.css

Konsep:

- clean
- simple
- professional
- responsive

---

# 14. TESTING CHECKLIST

## Authentication

- login berhasil
- register berhasil
- logout berhasil

---

## CRUD

- tambah data
- tampil data
- hapus data

---

## Resep

- tambah resep
- hitung subtotal
- simpan transaksi

---

## Laporan

- total harian tampil
- data transaksi tampil

---

# 15. FINAL TARGET

Membangun aplikasi SIMRS sederhana berbasis web menggunakan CodeIgniter 3 dengan fitur:

- authentication
- master data
- transaksi resep
- laporan penjualan
- responsive UI
- clean MVC architecture

---

# 16. DEVELOPMENT NOTES

Project dibuat untuk:

- test coding programmer
- simulasi SIMRS sederhana
- implementasi MVC CodeIgniter 3
- implementasi relational database MySQL

---

# 17. UPDATE LOG

## Version 2.1

- Menambahkan MVC structure
- Menambahkan custom CSS architecture
- Menambahkan Bootstrap integration
- Menambahkan folder structure
- Menambahkan status development
- Menambahkan testing checklist
- Menambahkan relasi database
- Menambahkan detail UI layout
