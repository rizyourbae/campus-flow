# KampusFlow - Sistem Penjadwalan Akademik Cerdas

![Mockup Aplikasi KampusFlow](https://raw.githubusercontent.com/rizyourbae/campus-flow/refs/heads/main/Campus%20Flow%20Logo.png)

KampusFlow adalah sebuah aplikasi web yang dirancang untuk menyederhanakan dan mengotomatisasi proses penjadwalan akademik di institusi pendidikan. Dibangun dengan tumpukan teknologi modern, aplikasi ini menyediakan antarmuka yang bersih dan intuitif bagi staf akademik untuk mengelola jadwal kuliah, dosen, ruangan, dan kelas secara efisien, sambil secara proaktif mencegah terjadinya konflik jadwal.

Proyek ini merupakan sebuah studi kasus dalam membangun aplikasi web kompleks dari nol menggunakan **Laravel 12** dan **Filament v3**, dengan fokus pada arsitektur yang solid, manajemen data yang robust, dan sistem hak akses yang aman.

---

## ✨ Fitur Utama

- **Manajemen Data Master:** Antarmuka CRUD (Create, Read, Update, Delete) yang lengkap dan menarik untuk semua data inti akademik, termasuk Tahun Ajaran, Program Studi, Dosen, Mata Kuliah, Ruangan, dan Kelas.
- **Deteksi Konflik Otomatis:** Sistem validasi cerdas yang mencegah pembuatan jadwal yang tumpang tindih berdasarkan ketersediaan Dosen, Ruangan, dan Kelas.
- **Ekspor Data ke Excel:** Fitur ekspor data jadwal ke dalam format `.xlsx` dengan satu klik untuk keperluan pelaporan dan analisis.
- **Manajemen Hak Akses (Roles & Permissions):** Sistem keamanan berlapis menggunakan `spatie/laravel-permission` yang membedakan hak akses antara Super Admin, Admin, dan Dosen.
- **Manajemen Konten Landing Page:** Super Admin dapat mengubah konten teks di halaman depan (landing page) langsung dari panel admin.
- **Pengaturan Aplikasi Dinamis:** Halaman pengaturan terpusat bagi Super Admin untuk mengelola variabel global seperti Tahun Ajaran yang sedang aktif.

---

## 🚀 Teknologi yang Digunakan

- **Backend:** Laravel 12
- **Admin Panel:** Filament v3
- **Hak Akses:** Spatie Laravel Permission
- **Styling:**
    - **Panel Admin:** Tailwind CSS (via Filament)
    - **Landing Page:** CSS Standar (HTML & CSS)
- **Database:** MySQL

---
