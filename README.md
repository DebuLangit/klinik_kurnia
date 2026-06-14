# Klinik Kurnia - Sistem Informasi Pendaftaran Pasien

## Identitas Mahasiswa
* **Nama:** Dedi Kurniawan
* **NIM:** H1H024022
* **Mata Kuliah:** Pemrograman Web
* **Nomor Paket:** Paket 3

---

## Deskripsi Singkat Aplikasi
**Klinik Kurnia** adalah aplikasi sistem informasi pendaftaran antrean fasilitas kesehatan berbasis *web*. Dibangun menggunakan pola arsitektur **MVC** (Model-View-Controller) dengan *framework* **CodeIgniter 3** dan antarmuka responsif dari **Bootstrap 5**. Aplikasi ini dirancang dengan gaya visual modern, bersih, dan terang.

Fitur utama dalam aplikasi ini dibagi menjadi dua hak akses:
1. **Sisi Pasien:** Memungkinkan pengguna untuk melakukan registrasi akun, *login*, memilih jadwal dan dokter spesialis secara dinamis (menggunakan fitur *dependent dropdown*), hingga mencetak e-tiket antrean kunjungan secara langsung.
2. **Sisi Admin:** Dilengkapi dengan *Control Panel* untuk mengelola data master menggunakan operasi CRUD (Poli dan Dokter) yang terintegrasi dalam *Bootstrap Tabs* & *Modals*, serta fitur konfirmasi penyelesaian antrean pasien.

---

## Langkah Instalasi
Berikut adalah panduan untuk menjalankan aplikasi ini di peladen lokal (XAMPP/Laragon):

1. **Persiapan Direktori:** Unduh atau *clone* repositori ini, lalu ekstrak folder proyek ke dalam direktori lokal Anda (misal: `C:\xampp\htdocs\klinik_kurnia`).
2. **Setup Database:**
   * Buka phpMyAdmin (biasanya di `http://localhost/phpmyadmin`).
   * Buat *database* baru dengan nama `db_klinik_kurnia`.
   * Lakukan *import* pada file `database.sql` yang sudah disediakan di dalam folder utama proyek ini.
3. **Konfigurasi Database:** Buka file `application/config/database.php` dan pastikan kredensialnya sesuai dengan server lokal Anda:
   ```php
   'hostname' => 'localhost',
   'username' => 'root', 
   'password' => '',     
   'database' => 'db_klinik_kurnia',
4. **Jalankan Aplikasi:** Buka browser dan akses URL http://localhost/klinik_kurnia

## Screenshot Tampilan
- Halaman Landing / Beranda:

- Dashboard Pasien & Form Pendaftaran:

- Dashboard Admin (Control Panel & CRUD):

## Link Video YouTube
