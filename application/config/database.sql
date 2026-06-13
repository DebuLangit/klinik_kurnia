CREATE DATABASE IF NOT EXISTS db_klinik_cat_friends;
USE db_klinik_cat_friends;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pasien') NOT NULL DEFAULT 'pasien',
  PRIMARY KEY (`id`)
);

CREATE TABLE `dokters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `pendaftarans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_kucing` varchar(100) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_jadwal` date NOT NULL,
  `waktu_sesi` time NOT NULL,
  `status` enum('menunggu','selesai') DEFAULT 'menunggu',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
  FOREIGN KEY (`id_dokter`) REFERENCES `dokters`(`id`)
);

-- Insert Default Data
INSERT INTO `users` (`nama`, `email`, `password`, `role`) VALUES
('Administrator', 'admin@catfriends.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'); 
-- Password default: password

INSERT INTO `dokters` (`nama_dokter`) VALUES
('drh. Budi Santoso'),
('drh. Rina Melati'),
('drh. Andi Wijaya'),
('drh. Siti Aminah');