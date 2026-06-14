CREATE DATABASE IF NOT EXISTS db_klinik_kurnia;
USE db_klinik_kurnia;

CREATE TABLE poli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_poli VARCHAR(50) NOT NULL,
    deskripsi TEXT
);

CREATE TABLE dokter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_dokter VARCHAR(100) NOT NULL,
    id_poli INT,
    jadwal VARCHAR(100),
    foto_dokter VARCHAR(255) DEFAULT 'default.jpg', 
    FOREIGN KEY (id_poli) REFERENCES poli(id)
);

CREATE TABLE pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(16) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(15) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_booking VARCHAR(10) UNIQUE NOT NULL,
    id_pasien INT,
    id_dokter INT,
    tgl_daftar DATE NOT NULL,
    no_antrian INT NOT NULL,
    keluhan TEXT,
    metode_bayar ENUM('Umum', 'BPJS', 'Asuransi') NOT NULL,
    no_bpjs VARCHAR(20) DEFAULT NULL, 
    status ENUM('Menunggu', 'Diperiksa', 'Selesai', 'Batal') DEFAULT 'Menunggu',
    waktu_daftar DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id),
    FOREIGN KEY (id_dokter) REFERENCES dokter(id)
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_admin VARCHAR(100) NOT NULL
);

INSERT INTO admin (username, password, nama_admin) VALUES 
('admin', '$2y$10$S.hUpx0.Q.2R/yS/fP5e7.O/p5vJ7s0i.h4u.o/0Q/D0P.U/q.3/G', 'Super Admin Kurnia'); /* Password: admin123 */

INSERT INTO poli (nama_poli, deskripsi) VALUES
('Poli Umum', 'Melayani pemeriksaan kesehatan umum, konsultasi medis dasar, dan pembuatan surat keterangan sehat.'),
('Poli Gigi', 'Melayani pemeriksaan, pencabutan, penambalan, dan perawatan kesehatan gigi dan mulut.'),
('Poli KIA', 'Melayani Kesehatan Ibu dan Anak, termasuk imunisasi dasar dan pemeriksaan kehamilan.');

INSERT INTO dokter (id_poli, nama_dokter, jadwal, foto_dokter) VALUES
(1, 'dr. Andi Saputra', 'Senin & Rabu, 08:00 - 12:00', 'dr_andi.png'),
(2, 'drg. Budi Santoso', 'Selasa & Kamis, 16:00 - 20:00', 'dr_budi.png'),
(3, 'dr. Citra Lestari, Sp.A', 'Jumat, 08:00 - 11:00', 'dr_citra.jpg'),
(1, 'dr. Diana Putri', 'Senin, 16:00 - 20:00', 'dr_diana.jpg');

INSERT INTO pasien (nik, nama, no_hp, password, alamat) VALUES
('3301234567890001', 'Ahmad Faisal', '081234567890', '123456', 'Jl. Jenderal Soedirman No. 45, Purwokerto'),
('3301234567890002', 'Siti Aminah', '089876543210', '123456', 'Jl. Gatot Subroto, Cilacap'),
('3301234567890003', 'Bima Arya', '081122334455', '123456', 'Jl. Kaliurang Km 5, Yogyakarta');

INSERT INTO pendaftaran (kode_booking, id_pasien, id_dokter, tgl_daftar, no_antrian, keluhan, metode_bayar, no_bpjs, status) VALUES
('KLN-0001', 1, 1, '2026-06-15', 1, 'Demam tinggi dan batuk berdahak sejak 3 hari yang lalu', 'BPJS', '0001234567890', 'Menunggu'),
('KLN-0002', 2, 2, '2026-06-16', 1, 'Gigi geraham bawah kiri berlubang dan sering ngilu', 'Umum', NULL, 'Selesai'),
('KLN-0003', 3, 3, '2026-06-19', 1, 'Jadwal imunisasi campak anak', 'Umum', NULL, 'Menunggu');