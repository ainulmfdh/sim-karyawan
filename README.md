# Dokumentasi Pengembangan Aplikasi

Panduan lengkap arsitektur sistem, rancangan database, dan tata cara menjalankan aplikasi di lokal.

## 1. Ringkasan Proyek

Aplikasi ini dibangun menggunakan framework **Laravel** versi 12 dengan pendekatan arsitektur MVC (Model-View-Controller), antarmuka Tailwind CSS, serta Alpine.js untuk interaktivitas komponen dinamis. Sistem ini dirancang untuk mengelola data karyawan secara komprehensif, mencatat log histori perubahan aktivitas, memantau statistik dashboard secara *real-time*, serta menghasilkan laporan bulanan dalam format Excel.

## 2. Rancangan Database & Relasi Tabel

Sistem ini dirancang menggunakan beberapa tabel utama yang saling berelasi untuk memastikan integritas data:

| Nama Tabel | Kolom Tabel | Keterangan & Relasi |
| :--- | :--- | :--- |
| `users` | `id, name, email, email_verified_at, password, remember_token, timestamps` | Menyimpan data akun user/admin yang memiliki hak akses login ke dalam sistem. |
| `employees` | `employee_code, name, department, position, email, status, timestamps` | Menyimpan data utama profil karyawan perusahaan (status: Aktif/Non-Aktif). |
| `activity_log` | `log_name, description, subject_type, event, subject_id, causer_id, properties, batch_uuid, timestamps` | Tabel bawaan package Spatie Activity Log untuk merekam histori perubahan data karyawan. |
| `reports` | `id, period_month, timestamps` | Menyimpan riwayat data pembuatan laporan rekapitulasi bulanan berdasarkan periode (format `YYYY-MM`). |

> **Hubungan Relasi:** Tabel `employees` berdiri sendiri dan terhubung secara polimorfik dengan tabel `activity_log` guna melacak seluruh aktivitas penambahan, pembaruan, atau penghapusan data karyawan.

## 3. Tata Cara Menjalankan Aplikasi di Lokal

Ikuti langkah-langkah berikut untuk mengonfigurasi dan menjalankan proyek ini di komputer lokal Anda:

### Prasyarat Sistem:
* PHP versi 8.2 atau lebih baru
* Composer (PHP Package Manager)
* Node.js & NPM (untuk kompilasi asset Tailwind CSS/Vite)
* Database Server (MySQL / MariaDB via XAMPP, Laragon, atau Native)

### Langkah Instalasi:

1. **Clone atau Ekstrak Proyek:**
   Buka terminal atau command prompt pada direktori proyek Anda.

2. **Install Dependencies PHP (Composer):**
   Jalankan perintah berikut untuk mengunduh seluruh package yang dibutuhkan:
   ```bash
   composer install
