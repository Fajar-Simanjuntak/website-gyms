-- Membuat database (jika belum ada)
CREATE DATABASE IF NOT EXISTS db_gyms;
-- Gunakan database hanya jika sudah berhasil dibuat
DELIMITER ;;
USE db_crud;;
DELIMITER ;

-- Membuat tabel untuk menyimpan data pendaftaran
CREATE TABLE IF NOT EXISTS member (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(30) NOT NULL,
    phone VARCHAR(25) NOT NULL
);

-- Menambahkan data contoh
INSERT INTO member (id, name, email, phone)
VALUES
(1, 'Andi Wijaya', 'andi@gmail.com', '+6281234567890'),
(2, 'Joni Siregar', 'joni@gmail.com', '+6281234567890');
