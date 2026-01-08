-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2026 pada 20.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_maut`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `keterangan`, `tahun`, `nik`, `nama`, `jenis_kelamin`, `departemen`, `email`, `no_telp`, `alamat`) VALUES
(65, 'Aktif', 2022, '7685566678888', 'Panji', 'Pria', 'Manajer', 'darkveeder80@gmail.com', '087267892736', 'Jl. Jati'),
(66, 'Aktif', 2025, '786328423492384823', 'Yusuf', 'Pria', 'Teknisi', 'ade@gmail.com3', '085252982733', 'jl. tanggasiang'),
(67, 'Aktif', 2025, '4243242432432', 'Melisa', 'Wanita', 'Sales', 'darkveeder80@gmail.com', '087266718263', 'jl. adonis'),
(68, 'Aktif', 2024, '78276372', 'Tegar', 'Wanita', 'Marketing', 'ppidkpukotapalangkaraya@gmail.com', '087265516283', 'Jl. Wortel'),
(69, 'Aktif', 2024, '6289281172402987', 'Robert', 'Pria', 'Teknisi', 'kagep80@gmail.com', '087261523321', 'Jl. Galaxy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float(10,4) NOT NULL,
  `NAN` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`, `NAN`, `bulan`, `tahun`) VALUES
(71, 65, 0.0000, 0, 5, 2026),
(72, 66, 0.0000, 0, 5, 2026),
(73, 67, 0.0000, 0, 5, 2026),
(74, 68, 0.0000, 0, 5, 2026),
(75, 69, 0.0000, 0, 5, 2026),
(81, 65, 0.0000, 0, 0, 2026),
(82, 66, 0.0000, 0, 0, 2026),
(83, 67, 0.0000, 0, 0, 2026),
(84, 68, 0.0000, 0, 0, 2026),
(85, 69, 0.0000, 0, 0, 2026),
(111, 65, 0.0000, 0, 4, 2026),
(112, 66, 0.0000, 0, 4, 2026),
(113, 67, 0.0000, 0, 4, 2026),
(114, 68, 0.0000, 0, 4, 2026),
(115, 69, 0.0000, 0, 4, 2026),
(176, 65, 0.0000, 0, 2, 2026),
(177, 66, 100.0000, 0, 2, 2026),
(178, 67, -25.0000, 0, 2, 2026),
(179, 68, -25.0000, 0, 2, 2026),
(180, 69, -25.0000, 0, 2, 2026),
(206, 65, 43.3340, 0, 1, 2026),
(207, 66, 30.0000, 0, 1, 2026),
(208, 67, 21.6660, 0, 1, 2026),
(209, 68, 93.3340, 0, 1, 2026),
(210, 69, 20.0000, 0, 1, 2026);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `bobot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `keterangan`, `kode_kriteria`, `bobot`) VALUES
(24, 'Kedisiplinan', 'C1', '15'),
(25, 'Produktivitas', 'C2', '35'),
(26, 'Kualitas Kerja', 'C3', '20'),
(27, 'Kerja Sama Tim', 'C4', '30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(100) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`, `bulan`, `tahun`) VALUES
(336, 65, 24, 173, 1, 2026),
(337, 65, 25, 167, 1, 2026),
(338, 65, 26, 171, 1, 2026),
(339, 65, 27, 174, 1, 2026),
(340, 66, 24, 173, 1, 2026),
(341, 66, 25, 167, 1, 2026),
(342, 66, 26, 180, 1, 2026),
(343, 66, 27, 174, 1, 2026),
(344, 67, 24, 178, 1, 2026),
(345, 67, 25, 167, 1, 2026),
(346, 67, 26, 176, 1, 2026),
(347, 67, 27, 182, 1, 2026),
(348, 68, 24, 178, 1, 2026),
(349, 68, 25, 177, 1, 2026),
(350, 68, 26, 171, 1, 2026),
(351, 68, 27, 174, 1, 2026),
(352, 69, 24, 173, 1, 2026),
(353, 69, 25, 167, 1, 2026),
(354, 69, 26, 184, 1, 2026),
(355, 69, 27, 182, 1, 2026),
(356, 65, 24, 156, 2, 2026),
(357, 65, 25, 179, 2, 2026),
(358, 65, 26, 181, 2, 2026),
(359, 65, 27, 183, 2, 2026),
(360, 66, 24, 178, 2, 2026),
(361, 66, 25, 177, 2, 2026),
(362, 66, 26, 184, 2, 2026),
(363, 66, 27, 174, 2, 2026),
(364, 65, 24, 168, 4, 2026),
(365, 65, 25, 167, 4, 2026),
(366, 65, 26, 171, 4, 2026),
(367, 65, 27, 174, 4, 2026);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `nilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `deskripsi`, `nilai`) VALUES
(156, 24, 'Sangat sering terlambat', '1'),
(162, 25, 'Hanya sebagian memenuhi target', '2'),
(163, 24, 'Sering terlambat', '2'),
(164, 27, 'Cukup kooperatif', '3'),
(167, 25, 'Menyelesaikan sesuai target', '3'),
(168, 24, 'Kadang terlambat', '3'),
(169, 27, 'Kooperatif', '4'),
(171, 26, 'Teliti, dengan sedikit kesalahan', '4'),
(172, 25, 'Menyelesaikan banyak tugas', '4'),
(173, 24, 'Sering hadir tepat waktu', '4'),
(174, 27, 'Sangat kooperatif', '5'),
(176, 26, 'Cukup teliti', '3'),
(177, 25, 'Menyelesaikan semua tugas', '5'),
(178, 24, 'Hadir tepat waktu setiap hari', '5'),
(179, 25, 'Tidak memenuhi target', '1'),
(180, 26, 'Kurang teliti', '2'),
(181, 26, 'Sangat kurang teliti', '1'),
(182, 27, 'Kurang kooperatif', '2'),
(183, 27, 'Sangat kurang kooperatif', '1'),
(184, 26, 'Sangat teliti, tanpa kesalahan', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_user_level`, `nama`, `email`, `username`, `password`) VALUES
(1, 1, 'Yesa', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(7, 2, 'User', 'user@gmail.com', 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(8, 2, 'hehe', 'hehe@gmail.com', 'hehe', '529ca8050a00180790cf88b63468826a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'Administrator'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `nilai` (`nilai`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`nilai`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
