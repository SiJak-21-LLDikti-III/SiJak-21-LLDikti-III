-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 07:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sijak`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(17, '2023-12-19-003954', 'App\\Database\\Migrations\\CreateTableSiJak', 'default', 'App', 1703131916, 1),
(18, '2023-12-20-040921', 'App\\Database\\Migrations\\IdentitasPajak', 'default', 'App', 1703131916, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_identitas`
--

CREATE TABLE `tb_identitas` (
  `id` int(5) UNSIGNED NOT NULL,
  `npwp` int(15) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `id_sub_unit` int(19) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sijak`
--

CREATE TABLE `tb_sijak` (
  `no` int(5) UNSIGNED NOT NULL,
  `tahun` date NOT NULL,
  `npwp` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `gaji` bigint(20) NOT NULL,
  `tj_istri` bigint(20) NOT NULL,
  `tj_anak` bigint(20) DEFAULT NULL,
  `jml_gaji` bigint(20) DEFAULT NULL,
  `tj_perbaikan` bigint(20) DEFAULT NULL,
  `tj_struktural` int(11) DEFAULT NULL,
  `tj_beras` int(11) NOT NULL,
  `jml_bruto_1` bigint(20) NOT NULL,
  `tj_lain` int(11) DEFAULT NULL,
  `ph_tetap` int(11) DEFAULT NULL,
  `jml_bruto_2` bigint(20) DEFAULT NULL,
  `biaya_jabatan` int(11) DEFAULT NULL,
  `iuran_pensiun` int(11) DEFAULT NULL,
  `jml_pengurangan` int(11) DEFAULT NULL,
  `jml_ph` bigint(20) DEFAULT NULL,
  `ph_neto` int(11) DEFAULT NULL,
  `jml_ph_neto` bigint(20) DEFAULT NULL,
  `ptktp` bigint(20) DEFAULT NULL,
  `ph_kena_pajak` bigint(20) DEFAULT NULL,
  `pph_ph` int(11) DEFAULT NULL,
  `pph_potong` int(11) DEFAULT NULL,
  `pph_utang` int(11) DEFAULT NULL,
  `pph_potong_lunas` int(11) DEFAULT NULL,
  `atas_gaji` int(11) DEFAULT NULL,
  `atas_ph` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_sijak`
--

INSERT INTO `tb_sijak` (`no`, `tahun`, `npwp`, `nip`, `nama`, `tgl_lahir`, `pangkat`, `nama_jabatan`, `nik`, `gaji`, `tj_istri`, `tj_anak`, `jml_gaji`, `tj_perbaikan`, `tj_struktural`, `tj_beras`, `jml_bruto_1`, `tj_lain`, `ph_tetap`, `jml_bruto_2`, `biaya_jabatan`, `iuran_pensiun`, `jml_pengurangan`, `jml_ph`, `ph_neto`, `jml_ph_neto`, `ptktp`, `ph_kena_pajak`, `pph_ph`, `pph_potong`, `pph_utang`, `pph_potong_lunas`, `atas_gaji`, `atas_ph`) VALUES
(1, '2023-01-01', 123123, '1230912', 'surya luqman', '2001-01-01', 'kepala suku', 'susunan organisasi desa', '3.17271727173e16', 1234561234, 30000000, 11500, 129381938, 2400000, 123132, 1000, 120031, 1312218, 0, 131230, 13913129, 109310391, 121320, 132412, 1023910, 123123, 12391, 1903, 12, 131321, NULL, 123132, 131, 1313);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sijak`
--
ALTER TABLE `tb_sijak`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_sijak`
--
ALTER TABLE `tb_sijak`
  MODIFY `no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
