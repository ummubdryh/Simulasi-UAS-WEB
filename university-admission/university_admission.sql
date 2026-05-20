-- phpMyAdmin SQL Dump (FIXED)
-- Database: `university_admission`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(30) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `status_berkas` enum('Pending','Diterima','Ditolak') DEFAULT 'Pending',
  `status_ujian` enum('Belum','Lulus','Tidak Lulus') DEFAULT 'Belum',
  `status_pembayaran` enum('Belum Bayar','Menunggu','Lunas') DEFAULT 'Belum Bayar',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `no_pendaftaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Lunas','Ditolak') DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `status` enum('Lulus','Tidak Lulus') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample data
INSERT INTO `mahasiswa` (`id`, `nim`, `nama_lengkap`, `email`, `no_hp`, `asal_sekolah`, `status_berkas`, `status_ujian`, `status_pembayaran`, `password`, `no_pendaftaran`) VALUES
(2, '1001', 'safii', 'safii123@gmail.com', '0815 4521 3531', 'SMA 1 jatibarang', 'Pending', 'Lulus', 'Belum Bayar', 'b8c37e33defde51cf91e1e03e51657da', 'PMB2026001');

COMMIT;
