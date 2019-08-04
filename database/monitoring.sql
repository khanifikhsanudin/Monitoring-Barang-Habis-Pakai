-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2019 at 03:55 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_habis_pakai`
--

CREATE TABLE `barang_habis_pakai` (
  `barang_id` int(4) NOT NULL,
  `barang_nama` varchar(20) NOT NULL,
  `barang_satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_habis_pakai`
--

INSERT INTO `barang_habis_pakai` (`barang_id`, `barang_nama`, `barang_satuan`) VALUES
(1, 'Spidol', 'Buah'),
(2, 'Kertas HVS', 'Rim'),
(3, 'Rj 45', 'Buah'),
(4, 'Pengharum Ruangan', 'Buah'),
(5, 'Tisu', 'Pack'),
(6, 'Tinta', 'Botol'),
(7, 'Tang Crimpting', 'Buah');

-- --------------------------------------------------------

--
-- Table structure for table `jml_bhp`
--

CREATE TABLE `jml_bhp` (
  `barang_id` int(4) NOT NULL,
  `laboratorium_id` int(4) NOT NULL,
  `barang_jumlah` int(4) NOT NULL,
  `barang_limit` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jml_bhp`
--

INSERT INTO `jml_bhp` (`barang_id`, `laboratorium_id`, `barang_jumlah`, `barang_limit`) VALUES
(1, 1, 2, 5),
(2, 1, 3, 8),
(3, 1, 5, 0),
(4, 1, 2, NULL),
(5, 3, 2, NULL),
(6, 3, 4, NULL),
(1, 3, 6, NULL),
(7, 3, 5, NULL),
(7, 1, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `laboratorium_id` int(4) NOT NULL,
  `pengguna_npak` varchar(10) NOT NULL,
  `laboratorium_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`laboratorium_id`, `pengguna_npak`, `laboratorium_nama`) VALUES
(1, '8764', 'Jaringan'),
(2, '6273', 'Pemrograman'),
(3, '8276', 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian_bhp`
--

CREATE TABLE `pemakaian_bhp` (
  `pemakaian_id` int(4) NOT NULL,
  `barang_id` int(4) NOT NULL,
  `laboratorium_id` int(4) NOT NULL,
  `pemakaian_tgl` date NOT NULL,
  `pemakaian_jumlah` int(4) NOT NULL,
  `pemakaian_ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaian_bhp`
--

INSERT INTO `pemakaian_bhp` (`pemakaian_id`, `barang_id`, `laboratorium_id`, `pemakaian_tgl`, `pemakaian_jumlah`, `pemakaian_ket`) VALUES
(1, 1, 1, '2019-07-03', 2, 'Terpakai Untuk Praktikum MIS'),
(2, 3, 1, '2019-07-03', 12, 'Untuk Mahasiswa saat Praktikum Jarkom'),
(3, 3, 1, '2019-07-03', 7, 'Untuk Praktikum MIS');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_bhp_baru`
--

CREATE TABLE `pengajuan_bhp_baru` (
  `pengajuan_id` int(4) NOT NULL,
  `laboratorium_id` int(4) NOT NULL,
  `pengajuan_nama` varchar(50) NOT NULL,
  `barang_nama_baru` varchar(20) NOT NULL,
  `barang_satuan_baru` varchar(20) NOT NULL,
  `barang_jumlah_baru` int(4) NOT NULL,
  `pengajuan_tgl` date NOT NULL,
  `konfirmasi_kalab` varchar(8) NOT NULL,
  `tgl_konfirmasi_kalab` date DEFAULT NULL,
  `konfirmasi_kajur` varchar(8) NOT NULL,
  `tgl_konfirmasi_kajur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_bhp_baru`
--

INSERT INTO `pengajuan_bhp_baru` (`pengajuan_id`, `laboratorium_id`, `pengajuan_nama`, `barang_nama_baru`, `barang_satuan_baru`, `barang_jumlah_baru`, `pengajuan_tgl`, `konfirmasi_kalab`, `tgl_konfirmasi_kalab`, `konfirmasi_kajur`, `tgl_konfirmasi_kajur`) VALUES
(1, 1, 'Ipo Novianto', 'Spidol', 'Buah', 4, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(2, 1, 'Ipo Novianto', 'Kertas HVS', 'Rim', 3, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(3, 1, 'Ipo Novianto', 'Rj 45', 'Buah', 24, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(5, 1, 'Ipo Novianto', 'Pengharum Ruangan', 'Buah', 2, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(7, 3, 'Andi Setiawan', 'Kertas HVS', 'Rim', 7, '2019-07-03', 'waiting', NULL, 'diterima', '2019-07-03'),
(8, 3, 'Andi Setiawan', 'Tisu', 'Pack', 2, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(9, 3, 'Andi Setiawan', 'Tinta', 'Botol', 4, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(10, 3, 'Andi Setiawan', 'Pengharum Ruangan', 'Buah', 2, '2019-07-03', 'waiting', NULL, 'waiting', NULL),
(13, 1, 'Ipo Novianto', 'Tang Crimpting', 'Buah', 5, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03'),
(14, 1, 'Ipo Novianto', 'Apar', 'Tangki', 2, '2019-07-07', 'waiting', NULL, 'waiting', NULL),
(15, 1, 'Ipo Novianto', 'Paper Klip', 'Biji', 40, '2019-07-07', 'waiting', NULL, 'diterima', '2019-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_tmb_jml_bhp`
--

CREATE TABLE `pengajuan_tmb_jml_bhp` (
  `pengajuan_tmb_id` int(4) NOT NULL,
  `pengajuan_tmb_nama` varchar(50) NOT NULL,
  `laboratorium_id` int(4) NOT NULL,
  `barang_id` int(4) NOT NULL,
  `barang_jumlah` int(4) NOT NULL,
  `pengajuan_tmb_tgl` date NOT NULL,
  `konfirmasi_kalab` varchar(8) NOT NULL,
  `tgl_konfirmasi_kalab` date NOT NULL,
  `konfirmasi_kajur` varchar(8) NOT NULL,
  `tgl_konfirmasi_kajur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_tmb_jml_bhp`
--

INSERT INTO `pengajuan_tmb_jml_bhp` (`pengajuan_tmb_id`, `pengajuan_tmb_nama`, `laboratorium_id`, `barang_id`, `barang_jumlah`, `pengajuan_tmb_tgl`, `konfirmasi_kalab`, `tgl_konfirmasi_kalab`, `konfirmasi_kajur`, `tgl_konfirmasi_kajur`) VALUES
(1, 'Ipo Novianto', 1, 3, 10, '2019-07-03', 'waiting', '2019-07-09', 'waiting', '0000-00-00'),
(2, 'Ipo Novianto', 1, 7, 10, '2019-07-03', 'diterima', '2019-07-03', 'diterima', '2019-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `pengguna_npak` varchar(10) NOT NULL,
  `pengguna_nama` varchar(50) NOT NULL,
  `pengguna_username` varchar(30) NOT NULL,
  `pengguna_password` varchar(35) NOT NULL,
  `pengguna_level` varchar(20) NOT NULL,
  `pengguna_foto` varchar(100) DEFAULT NULL,
  `pengguna_jenkel` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pengguna_npak`, `pengguna_nama`, `pengguna_username`, `pengguna_password`, `pengguna_level`, `pengguna_foto`, `pengguna_jenkel`) VALUES
('5173', 'Dwi Noviana Prasetyanti', 'noviana', 'e46cb9cb0c5ceb20fcef48898423ddb0', 'kalab', '93aa8db7c18058424cd21fc211355d0d.png', 'P'),
('5243', 'Wiyono', 'wiyono', '227dffb48018dbdd662432b648ffa317', 'plp', '993c4cb69af71b3ecb066674cddd4fb1.png', 'L'),
('5876', 'Nur Wahyu Rahadi', 'wahyu', '32c9e71e866ecdbc93e497482aa6779f', 'kajur', '9c76d3059cbc51c17a8ad4029aa1742e.png', 'L'),
('6273', 'Grizenzio O', 'lando', '73b3452ae6c4aea73758856ea266bb6a', 'plp', '480850d139763e73b8a81f03538d4def.png', 'L'),
('7265', 'Iit Yuniarti', 'iit', '8fa985e47a9d6f1bd3bbb75427442f6b', 'plp', '311c77198326407f326422fb60972998.png', 'P'),
('8276', 'Andi Setiawan', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', 'plp', '90114d0265d299892dad9cddcae8ba49.png', 'L'),
('8763', 'Rostika Listyaningrum', 'rostika', '3af6afa44046114a17579a96c609679e', 'spi', '8a5f4ae1d5b80525956b1fe9a4b52ef0.png', 'P'),
('8764', 'Ipo Novianto', 'ipo', 'acfc5392bd62e166e9211a937ab53db0', 'plp', '0f7948590ae5adf980551951de0b96ce.png', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_habis_pakai`
--
ALTER TABLE `barang_habis_pakai`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `barang_nama` (`barang_nama`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`laboratorium_id`),
  ADD UNIQUE KEY `pengguna_npak` (`pengguna_npak`);

--
-- Indexes for table `pemakaian_bhp`
--
ALTER TABLE `pemakaian_bhp`
  ADD PRIMARY KEY (`pemakaian_id`);

--
-- Indexes for table `pengajuan_bhp_baru`
--
ALTER TABLE `pengajuan_bhp_baru`
  ADD PRIMARY KEY (`pengajuan_id`);

--
-- Indexes for table `pengajuan_tmb_jml_bhp`
--
ALTER TABLE `pengajuan_tmb_jml_bhp`
  ADD PRIMARY KEY (`pengajuan_tmb_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pengguna_npak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_habis_pakai`
--
ALTER TABLE `barang_habis_pakai`
  MODIFY `barang_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `laboratorium_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemakaian_bhp`
--
ALTER TABLE `pemakaian_bhp`
  MODIFY `pemakaian_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengajuan_bhp_baru`
--
ALTER TABLE `pengajuan_bhp_baru`
  MODIFY `pengajuan_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengajuan_tmb_jml_bhp`
--
ALTER TABLE `pengajuan_tmb_jml_bhp`
  MODIFY `pengajuan_tmb_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
