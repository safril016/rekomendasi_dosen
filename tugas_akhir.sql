-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 23 Feb 2020 pada 21.35
-- Versi Server: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-2+ubuntu18.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`id`, `nama`, `kategori`) VALUES
(6, 'Muh. Yamin, S.T., M.Eng.', 'KBJ'),
(8, 'Isnawaty, S.Si., M.T.', 'KBJ'),
(9, 'L. M. Fid Aksara, S.Kom., M. K', 'KBJ'),
(10, 'Subardin, S.T., M.T.', 'KBJ'),
(11, 'La Surimi, S.Si., M.Cs.', 'KBJ'),
(12, 'DR. La Ode Muh. Golok Jaya, S.', 'RPL'),
(13, 'Sutardi, S.Kom., M.T.', 'RPL'),
(14, 'Bambang Pramono, S.Si.,M.T.  ', 'RPL'),
(15, 'L.M. Tajidun, S.T., M.Eng.', 'RPL'),
(16, 'Natalis Ransi, S.Si., M.Cs.', 'RPL'),
(17, 'Jumadil Nangi, S.Kom., M.T.', 'RPL'),
(18, 'Ika Purwanti. Ningrum Purnama,', 'KCV'),
(20, 'Dr. Ir. H. Muhammad Ihsan Sari', 'KCV'),
(21, 'Rizal Adi Saputra, S.T., M.Kom', 'KCV'),
(22, 'La Ode Muhammad Bahtiar Aksara', 'KCV'),
(23, 'Adha Mashur Sajiah, S.T., M.En', 'KCV');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_katadasar`
--

CREATE TABLE `tb_katadasar` (
  `id` int(11) NOT NULL,
  `kata_dasar` text NOT NULL,
  `kategori` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_katadasar`
--

INSERT INTO `tb_katadasar` (`id`, `kata_dasar`, `kategori`) VALUES
(5, 'kriptografi keamanan robotik mikrokontroler jaringan wireless gateway arduino protokol prototipe konversi bandwith router transmisi paket klien service nirkabel cloud', 'KBJ'),
(6, 'geografis klasifikasi android game informasi keputusan knn ahp saw naive bayes klastering prediksi c45 vsm apriori cart cart web', 'RPL'),
(7, 'citra identifikasi fuzzy diagnosis deteksi logika ekstraksi pakar genetika visualisasi virtual temu bm25', 'KCV');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kumpulan`
--

CREATE TABLE `tb_kumpulan` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `tahun_lulus` int(5) NOT NULL,
  `judul_skripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kumpulan`
--

INSERT INTO `tb_kumpulan` (`id`, `nama`, `nim`, `tahun_lulus`, `judul_skripsi`) VALUES
(5, 'ade Ichsan Hasibuan', 'E1E116043', 0, 'Penerapan Algoritma Fuzzy Weighted Product untuk penentuan dosen terbaik'),
(6, 'Safril', 'E1E116031', 2020, 'Rancang Bangun Sistem Informasi Tugas Akhir Mahasiswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'admin', 'admin', '$2y$10$q7G9WyUWtItogXnbRroy2OuK9gU.sm5mtc9jv7T0r4bQWoUU7Zn76');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_katadasar`
--
ALTER TABLE `tb_katadasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kumpulan`
--
ALTER TABLE `tb_kumpulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tb_katadasar`
--
ALTER TABLE `tb_katadasar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_kumpulan`
--
ALTER TABLE `tb_kumpulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
