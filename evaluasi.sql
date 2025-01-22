-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2025 pada 05.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(1) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `password`) VALUES
(1, 'administrator', 'admin', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(1) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `jenis_kriteria` varchar(10) NOT NULL,
  `akar_kriteria` double NOT NULL,
  `solusi_ideal_positif` double NOT NULL,
  `solusi_ideal_negatif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `jenis_kriteria`, `akar_kriteria`, `solusi_ideal_positif`, `solusi_ideal_negatif`) VALUES
(1, 'Kepuasan Pengguna', 0.25, 'Benefit', 10.770329614269, 0.11605958636066, 0.069635751816395),
(2, 'Kemudahan Penggunaan', 0.2, 'Benefit', 11.180339887499, 0.089442719099991, 0.053665631459995),
(3, 'Kelengkapan Informasi', 0.1, 'Benefit', 10.535653752853, 0.047457899787624, 0.01898315991505),
(4, 'Downtime', 0.2, 'Cost', 7.3484692283495, 0.027216552697591, 0.13608276348795),
(5, 'Kecepatan Akses', 0.15, 'Benefit', 11.090536506409, 0.06762522260006, 0.040575133560036),
(6, 'Kompatibilitas Perangkat', 0.1, 'Benefit', 9.1104335791443, 0.043905703995876, 0.021952851997938);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(1) NOT NULL,
  `id_program` int(1) NOT NULL,
  `id_kriteria` int(1) NOT NULL,
  `id_subkriteria` int(1) NOT NULL,
  `nm_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_program`, `id_kriteria`, `id_subkriteria`, `nm_bobot`) VALUES
(1, 1, 1, 3, 0.069635751816395),
(2, 1, 2, 7, 0.071554175279993),
(3, 1, 3, 13, 0.028474739872574),
(4, 1, 4, 16, 0.13608276348795),
(5, 1, 5, 22, 0.054100178080048),
(6, 1, 6, 27, 0.043905703995876),
(7, 2, 1, 2, 0.092847669088526),
(8, 2, 2, 6, 0.089442719099991),
(9, 2, 3, 12, 0.037966319830099),
(10, 2, 4, 18, 0.081649658092773),
(11, 2, 5, 21, 0.06762522260006),
(12, 2, 6, 28, 0.032929277996907),
(13, 3, 1, 2, 0.092847669088526),
(14, 3, 2, 6, 0.089442719099991),
(15, 3, 3, 12, 0.037966319830099),
(16, 3, 4, 19, 0.054433105395182),
(17, 3, 5, 22, 0.054100178080048),
(18, 3, 6, 29, 0.021952851997938),
(19, 4, 1, 1, 0.11605958636066),
(20, 4, 2, 8, 0.053665631459995),
(21, 4, 3, 14, 0.01898315991505),
(22, 4, 4, 19, 0.054433105395182),
(23, 4, 5, 22, 0.054100178080048),
(24, 4, 6, 28, 0.032929277996907),
(25, 5, 1, 2, 0.092847669088526),
(26, 5, 2, 8, 0.053665631459995),
(27, 5, 3, 12, 0.037966319830099),
(28, 5, 4, 18, 0.081649658092773),
(29, 5, 5, 23, 0.040575133560036),
(30, 5, 6, 28, 0.032929277996907),
(31, 6, 1, 3, 0.069635751816395),
(32, 6, 2, 7, 0.071554175279993),
(33, 6, 3, 11, 0.047457899787624),
(34, 6, 4, 20, 0.027216552697591),
(35, 6, 5, 22, 0.054100178080048),
(36, 6, 6, 27, 0.043905703995876),
(37, 7, 1, 2, 0.092847669088526),
(38, 7, 2, 8, 0.053665631459995),
(39, 7, 3, 13, 0.028474739872574),
(40, 7, 4, 20, 0.027216552697591),
(41, 7, 5, 22, 0.054100178080048),
(42, 7, 6, 29, 0.021952851997938),
(43, 8, 1, 3, 0.069635751816395),
(44, 8, 2, 7, 0.071554175279993),
(45, 8, 3, 12, 0.037966319830099),
(46, 8, 4, 20, 0.027216552697591),
(47, 8, 5, 23, 0.040575133560036),
(48, 8, 6, 27, 0.043905703995876);

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id_program` int(1) NOT NULL,
  `nama_program` varchar(30) NOT NULL,
  `d_max` double NOT NULL,
  `d_min` double NOT NULL,
  `nilai_v` double NOT NULL,
  `rank` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id_program`, `nama_program`, `d_max`, `d_min`, `nilai_v`, `rank`) VALUES
(1, 'Open Data', 0.12194388650225, 0.032786348229129, 0.21189361139436, 8),
(2, 'SiKoJOn', 0.060928877260395, 0.077422901466911, 0.55960900668659, 6),
(3, 'PPID Solok Selatan', 0.045105193430368, 0.095019718794273, 0.67810724935151, 3),
(4, 'Solok Selatan Tourism', 0.055990716270919, 0.095526163104347, 0.63046548673798, 5),
(5, 'SIMPEG', 0.075657355235863, 0.063107831166044, 0.45478143907986, 7),
(6, 'SIMANJA', 0.051556757491735, 0.11682258858103, 0.69380592873039, 1),
(7, 'E-SPT', 0.053329241546457, 0.11253293684365, 0.67847256038669, 2),
(8, 'DUKCAPILSIGAP', 0.057419246084885, 0.11407953332239, 0.66519151749456, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(1) NOT NULL,
  `id_kriteria` int(1) NOT NULL,
  `nama_subkriteria` varchar(30) NOT NULL,
  `nilai_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai_subkriteria`) VALUES
(1, 1, 'Sangat Puas', 5),
(2, 1, 'Puas', 4),
(3, 1, 'Cukup Puas', 3),
(4, 1, 'Tidak Puas', 2),
(5, 1, 'Sangat Tidak Puas', 1),
(6, 2, 'Sangat Mudah', 5),
(7, 2, 'Mudah', 4),
(8, 2, 'Cukup Mudah', 3),
(9, 2, 'Sulit', 2),
(10, 2, 'Sangat Sulit', 1),
(11, 3, 'Sangat Lengkap', 5),
(12, 3, 'Lengkap', 4),
(13, 3, 'Cukup Lengkap', 3),
(14, 3, 'Tidak Lengkap', 2),
(15, 3, 'Sangat Tidak Lengkap', 1),
(16, 4, 'Sangat Sering', 5),
(17, 4, 'Sering', 4),
(18, 4, 'Kadang-Kadang', 3),
(19, 4, 'Jarang', 2),
(20, 4, 'Tidak Pernah', 1),
(21, 5, 'Sangat Cepat', 5),
(22, 5, 'Cepat', 4),
(23, 5, 'Cukup Cepat', 3),
(24, 5, 'Lambat', 2),
(25, 5, 'Sangat Lambat', 1),
(26, 6, 'Sangat Kompatibel', 5),
(27, 6, 'Kompatibel', 4),
(28, 6, 'Cukup Kompatibel', 3),
(29, 6, 'Tidak Kompatibel', 2),
(30, 6, 'Sangat Tidak Kompatibel', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
