-- Membuat database (jika belum ada)
CREATE DATABASE IF NOT EXISTS db_gyms;
-- Gunakan database hanya jika sudah berhasil dibuat
DELIMITER ;;
USE db_crud;;
DELIMITER ;

CREATE TABLE member (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Kolom ID sebagai primary key dengan auto increment
    name VARCHAR(100) NOT NULL,               -- Nama anggota, tipe data VARCHAR dengan panjang maksimum 100 karakter
    dob DATE NOT NULL,                        -- Tanggal lahir anggota, tipe data DATE
    gender ENUM('Male', 'Female') NOT NULL,   -- Jenis kelamin, tipe ENUM hanya menerima 'Male' atau 'Female'
    package VARCHAR(50) NOT NULL,             -- Paket gym yang diambil, tipe data VARCHAR dengan panjang maksimum 50 karakter
    duration VARCHAR(50) NOT NULL,            -- Durasi paket, tipe data VARCHAR untuk fleksibilitas
    payment ENUM('Paid', 'Pending') NOT NULL, -- Status pembayaran, tipe ENUM hanya menerima 'Paid' atau 'Pending'
    file VARCHAR(255),                        -- Lokasi file, tipe data VARCHAR dengan panjang maksimum 255 karakter
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Tanggal pendaftaran, default nilai saat data dimasukkan
);


-- Menambahkan data contoh
INSERT INTO member (name, dob, gender, package, duration, payment, file)
VALUES ('John Doe', '1990-05-15', 'Male', 'Premium', '12 months', 'Cash', 'uploads/profile1.jpg');
