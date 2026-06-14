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
5. **Login Admin:** Sebelum login admin, perlu memperbaiki hash password admin
   - ketik dan akses URL berikut: http://localhost/klinik_kurnia/admin/setup_admin
   - Tes Login Kembali
   - Setelah berhasil masuk dan melihat Dashboard Admin, hapus blok fungsi setup_admin() dari application/controllers/Admin.php agar celah tersebut tertutup dan sistem kembali aman!
     ```php
     public function setup_admin() {
    	// 1. Memerintahkan PHP membuat hash yang 100% valid untuk kata 'admin123'
    	$password_asli = password_hash('admin123', PASSWORD_DEFAULT);
    
   	 	// 2. Menimpa password dummy di database dengan hash yang baru menggunakan Query Builder
    	$this->db->where('username', 'admin');
    	$this->db->update('admin', ['password' => $password_asli]);
    
    	// 3. Menampilkan konfirmasi
    	echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    	echo "<h3>Setup Hash Berhasil!</h3>";
    	echo "<p>Password admin telah diperbarui secara otomatis.</p>";
    	echo "<a href='".base_url('admin/login')."' style='padding: 10px 20px; background: #0D6EFD; color: #fff; text-decoration: none; border-radius: 5px;'>Kembali Login</a>";
    	echo "</div>";
     ```

## Screenshot Tampilan
- Halaman Landing / Beranda:

- Dashboard Pasien & Form Pendaftaran:

- Dashboard Admin (Control Panel & CRUD):

## Link Video YouTube
