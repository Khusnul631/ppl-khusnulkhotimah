-- Database and table for PPL-KHOTIM project
CREATE DATABASE IF NOT EXISTS pengurus;
USE pengurus;

CREATE TABLE IF NOT EXISTS pengurus (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alamat TEXT,
  gender ENUM('P','L') NOT NULL,
  gaji INT DEFAULT 0
);

-- Sample data
INSERT INTO pengurus (nama, alamat, gender, gaji) VALUES
('Andi', 'Jl. Merdeka 1', 'L', 3000000),
('Siti', 'Jl. Mawar 2', 'P', 3500000);
