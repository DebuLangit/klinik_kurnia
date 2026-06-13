# Klinik Cat Friends - Sistem Informasi Pendaftaran Pasien (Paket 3)

##Nama : Dedi Kurniawan
##NIM : H1H024022
##Mata Kuliah : Pemrograman Web

Aplikasi web berbasis MVC menggunakan CodeIgniter 3 dan Bootstrap 5, dikhususkan untuk klinik hewan kucing. Desain antarmuka difokuskan pada fungsionalitas dengan tema warna hitam (*black solid theme*) yang *clean*, presisi, dan profesional.

## Fitur Utama
- **Autentikasi:** Login dan Register User (Pasien & Admin).
- **Dashboard Pasien:** Pendaftaran sesi klinik untuk kucing peliharaan.
- **Validasi Jam Operasional:** Pemilihan waktu sesi dikunci antara 09:00 WIB hingga 17:00 WIB.
- **Tiket Sesi:** Pencetakan/penampilan tiket digital (berisi detail jadwal dan dokter).
- **Dashboard Admin:** Monitoring seluruh jadwal pendaftaran dari pasien.

## Instalasi & Konfigurasi (XAMPP/Laragon)
1. Pindahkan folder proyek ke `htdocs` (XAMPP) atau `www` (Laragon).
2. Buat database baru di MySQL dengan nama `db_klinik_cat_friends`.
3. Import file `db_klinik_cat_friends.sql` ke dalam database tersebut.
4. Buka `application/config/database.php` dan sesuaikan kredensial:
   ```php
   'username' => 'root',
   'password' => '',
   'database' => 'db_klinik_cat_friends',