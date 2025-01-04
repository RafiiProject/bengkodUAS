-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2025 pada 20.38
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_sks`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inputmhs`
--

CREATE TABLE `inputmhs` (
  `id` int(11) NOT NULL,
  `namaMhs` varchar(255) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `ipk` float NOT NULL,
  `sks` int(11) NOT NULL,
  `matakuliah` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inputmhs`
--

INSERT INTO `inputmhs` (`id`, `namaMhs`, `nim`, `ipk`, `sks`, `matakuliah`) VALUES
(3, 'rafi', 'a11202113281', 3.8, 24, 'Dasar Pemrograman, Pemrograman Berorientasi Objek, Dasar Pemrograman, Interaksi Manusia Dan Komputer, Jaringan Komputer, Matriks Vektor, Sistem Operasi'),
(5, 'rudy', 'a11.2022.135677', 2.7, 20, 'Interaksi Manusia Dan Komputer, Dasar Pemrograman, Jaringan Komputer, Dasar Pemrograman, Pemrograman Berorientasi Objek, Sistem Operasi'),
(9, 'zaidan', 'a11.2022.135643', 3, 24, 'Interaksi Manusia Dan Komputer, Dasar Pemrograman, Dasar Pemrograman, Jaringan Komputer, Matriks Vektor, Kriptografi, Dasar Pemrograman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jwl_matakuliah`
--

CREATE TABLE `jwl_matakuliah` (
  `id` int(11) NOT NULL,
  `matakuliah` varchar(250) NOT NULL,
  `sks` int(11) NOT NULL,
  `kelp` varchar(10) DEFAULT NULL,
  `ruangan` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jwl_matakuliah`
--

INSERT INTO `jwl_matakuliah` (`id`, `matakuliah`, `sks`, `kelp`, `ruangan`) VALUES
(1, 'Interaksi Manusia Dan Komputer', 3, 'A11.3982', 'H.4.5'),
(2, 'Dasar Pemrograman', 4, 'A11.4116', 'H.4.8'),
(3, 'Jaringan Komputer', 3, 'A11.3112', 'H.5.6'),
(4, 'Matriks Vektor', 3, 'A11.3123', 'H.7.1'),
(5, 'Sistem Operasi', 2, 'A11.5114', 'H.5.4'),
(6, 'Kriptografi', 2, 'A11.5224', 'H.3.2'),
(7, 'Dasar Pemrograman', 4, 'A11.2119', 'H.4.6'),
(8, 'Pemrograman Berorientasi Objek', 4, 'A11.4222', 'H.5.5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jwl_mhs`
--

CREATE TABLE `jwl_mhs` (
  `id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL,
  `matakuliah` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL,
  `kelp` varchar(50) DEFAULT NULL,
  `ruangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jwl_mhs`
--

INSERT INTO `jwl_mhs` (`id`, `mhs_id`, `matakuliah`, `sks`, `kelp`, `ruangan`) VALUES
(9, 3, 'Dasar Pemrograman', 4, 'A11.4116', 'H.4.8'),
(11, 5, 'Interaksi Manusia Dan Komputer', 3, 'A11.3982', 'H.4.5'),
(12, 5, 'Dasar Pemrograman', 4, 'A11.4116', 'H.4.8'),
(14, 5, 'Jaringan Komputer', 3, 'A11.3112', 'H.5.6'),
(15, 5, 'Dasar Pemrograman', 4, 'A11.2119', 'H.4.6'),
(16, 5, 'Pemrograman Berorientasi Objek', 4, 'A11.4222', 'H.5.5'),
(20, 5, 'Sistem Operasi', 2, 'A11.5114', 'H.5.4'),
(21, 3, 'Pemrograman Berorientasi Objek', 4, 'A11.4222', 'H.5.5'),
(22, 3, 'Dasar Pemrograman', 4, 'A11.4116', 'H.4.8'),
(23, 3, 'Interaksi Manusia Dan Komputer', 3, 'A11.3982', 'H.4.5'),
(24, 3, 'Jaringan Komputer', 3, 'A11.3112', 'H.5.6'),
(25, 3, 'Matriks Vektor', 3, 'A11.3123', 'H.7.1'),
(26, 3, 'Sistem Operasi', 2, 'A11.5114', 'H.5.4'),
(44, 9, 'Interaksi Manusia Dan Komputer', 3, 'A11.3982', 'H.4.5'),
(45, 9, 'Dasar Pemrograman', 4, 'A11.4116', 'H.4.8'),
(46, 9, 'Dasar Pemrograman', 4, 'A11.2119', 'H.4.6'),
(47, 9, 'Jaringan Komputer', 3, 'A11.3112', 'H.5.6'),
(48, 9, 'Matriks Vektor', 3, 'A11.3123', 'H.7.1'),
(50, 9, 'Kriptografi', 2, 'A11.5224', 'H.3.2'),
(51, 9, 'Dasar Pemrograman', 4, 'A11.2119', 'H.4.6');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inputmhs`
--
ALTER TABLE `inputmhs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `jwl_matakuliah`
--
ALTER TABLE `jwl_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mhs_id` (`mhs_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inputmhs`
--
ALTER TABLE `inputmhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jwl_matakuliah`
--
ALTER TABLE `jwl_matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  ADD CONSTRAINT `jwl_mhs_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `inputmhs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
