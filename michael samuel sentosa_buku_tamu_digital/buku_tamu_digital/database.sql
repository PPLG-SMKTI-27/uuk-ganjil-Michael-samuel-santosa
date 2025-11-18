-- Create database
CREATE DATABASE IF NOT EXISTS buku_tamu_digital;
USE buku_tamu_digital;

-- Users table for authentication
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') DEFAULT 'staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tamu table for guest records
CREATE TABLE tamu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    instansi VARCHAR(100) NOT NULL,
    keperluan TEXT NOT NULL,
    tanggal_bertemu DATE NOT NULL,
    no_telepon VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, password, role) VALUES 
('admin', MD5('admin123'), 'admin'),
('staff', MD5('staff123'), 'staff');

-- Sample data for tamu
INSERT INTO tamu (nama, instansi, keperluan, tanggal_bertemu, no_telepon, email) VALUES
('Budi Santoso', 'PT. Contoh Indonesia', 'Konsultasi pendaftaran siswa', CURDATE(), '081234567890', 'budi@example.com'),
('Sari Dewi', 'Universitas Airlangga', 'Penelitian untuk skripsi', CURDATE(), '081298765432', 'sari@unair.ac.id'),
('Ahmad Fauzi', 'SMP Negeri 1 Surabaya', 'Informasi pendaftaran PPDB', CURDATE(), '081345678901', 'ahmad@smpn1sby.sch.id');