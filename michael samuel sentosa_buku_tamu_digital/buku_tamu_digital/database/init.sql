-- Migration script for Buku Tamu Digital
-- Run: mysql -u root -p < init.sql  OR use a GUI to import

CREATE DATABASE IF NOT EXISTS `buku_tamu_digital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `buku_tamu_digital`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'staff',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed admin user (legacy MD5 password: 'admin123')
-- Note: the app supports both password_hash and legacy md5 for compatibility.
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', MD5('admin123'), 'admin');

-- Tamu table
CREATE TABLE IF NOT EXISTS `tamu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL,
  `instansi` VARCHAR(255) NULL,
  `keperluan` TEXT NULL,
  `tanggal_bertemu` DATE NULL,
  `no_telepon` VARCHAR(50) NULL,
  `email` VARCHAR(150) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional sample guest
INSERT INTO `tamu` (`nama`, `instansi`, `keperluan`, `tanggal_bertemu`, `no_telepon`, `email`) VALUES
('Budi Santoso', 'Orang Tua Siswa', 'Bertemu wali kelas', CURDATE(), '08123456789', 'budi@example.com');
