-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2020 at 07:30 AM
-- Server version: 10.3.25-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rebeatne_customer_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_aduan`
--

CREATE TABLE `tb_aduan` (
  `id_aduan` int(11) NOT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_detail_lokasi` int(11) DEFAULT NULL,
  `jenis` varchar(10) NOT NULL,
  `perihal` text NOT NULL,
  `pelapor` varchar(20) NOT NULL,
  `ket` text NOT NULL,
  `status` varchar(12) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `waktu_kirim` datetime NOT NULL,
  `foto` text DEFAULT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_aduan`
--

INSERT INTO `tb_aduan` (`id_aduan`, `id_akun`, `id_customer`, `id_unit`, `id_detail_lokasi`, `jenis`, `perihal`, `pelapor`, `ket`, `status`, `waktu`, `waktu_kirim`, `foto`, `level`) VALUES
(76, NULL, NULL, 1, 2, 'Keluhan', 'Wifi', 'Mitra', 'toilet', 'Closed', '2020-04-26 15:45:41', '2020-04-26 14:17:13', NULL, 0),
(77, NULL, NULL, 1, NULL, 'Keluhan', 'Kursi tunggu', 'Mitra', 'Patah', 'Closed', '2020-06-11 12:39:29', '2020-05-03 11:29:24', '77.png', 0),
(78, 18, NULL, 5, NULL, 'Keluhan', 'perkara', 'Mitra', 'aap', 'Closed', '2020-06-11 12:45:14', '2020-05-03 13:27:58', '78.png', 0),
(79, 18, NULL, 1, NULL, 'Keluhan', 're', 'Mitra', 're', 'Closed', '2020-06-14 22:04:56', '2020-05-03 13:48:40', '79.jpeg', 0),
(80, 18, NULL, 5, NULL, 'Keluhan', 'de', 'Mitra', 'de', 'Closed', '2020-06-24 12:28:55', '2020-05-03 14:59:20', '80.jpeg', 0),
(81, 18, NULL, 1, NULL, 'Keluhan', 're', 'Mitra', 'e', 'Closed', '2020-05-03 16:04:41', '2020-05-03 16:04:41', '81.jpeg', 0),
(82, 18, NULL, 5, NULL, 'Keluhan', 'pekerjaan', 'Mitra', 'mengecewakan', 'Closed', '2020-06-24 19:47:46', '2020-05-04 03:21:26', '82.jpeg', 0),
(95, NULL, NULL, NULL, NULL, 'Informasi', 'dere', 'Mitra', 'dere', 'Closed', '2020-06-05 07:16:09', '2020-06-05 07:16:09', '.jpeg', 0),
(96, NULL, NULL, NULL, NULL, 'Informasi', 'Charger', 'Mitra', 'Colokan rusak', 'Closed', '2020-06-06 05:59:04', '2020-06-06 05:59:04', NULL, 0),
(97, 18, NULL, 5, 14, 'Keluhan', 'Kursi', 'Mitra', 'Kursi rusak', 'Closed', '2020-07-06 00:37:51', '2020-06-15 09:42:17', NULL, 1),
(98, 18, NULL, 5, 14, 'Keluhan', 'Kursi', 'Mitra', 'Kursi rusak', 'Closed', '2020-07-03 08:24:22', '2020-06-15 10:15:16', NULL, 0),
(99, 18, NULL, 5, 14, 'Keluhan', 'Kursi', 'Mitra', 'Kursi rusak', 'Closed', '2020-09-25 21:05:59', '2020-06-15 10:16:26', NULL, 1),
(100, 18, NULL, 13, NULL, 'Keluhan', 'Cek', 'Penumpang', 'Cek', 'Closed', '2020-06-15 10:31:52', '2020-06-15 10:31:52', '100.jpeg', 4),
(111, 18, NULL, 9, 10, 'Keluhan', 'Parkiran', 'Pengantar/Penjemput', 'Bolong', 'Closed', '2020-07-08 20:07:03', '2020-06-15 11:48:38', NULL, 4),
(112, 18, NULL, 5, 12, 'Keluhan', 're', 'Penumpang', 're', 'Closed', '2020-09-25 21:07:33', '2020-06-15 11:50:03', NULL, 1),
(113, 18, NULL, 1, 12, 'Keluhan', 're', 'Penumpang', 're', 'Closed', '2020-06-18 11:09:41', '2020-06-15 11:53:55', NULL, 0),
(114, 18, NULL, 5, 12, 'Keluhan', 're', 'Penumpang', 're', 'Closed', '2020-06-24 12:33:07', '2020-06-15 11:55:44', NULL, 0),
(115, 18, NULL, 5, 12, 'Keluhan', 're', 'Penumpang', 're', 'Closed', '2020-09-25 21:07:59', '2020-06-15 11:58:34', NULL, 1),
(116, 18, NULL, 9, 9, 'Keluhan', 'Kereta', 'Mitra', 'roda rusak', 'Closed', '2020-09-25 21:11:42', '2020-06-16 04:02:02', '116.jpeg', 4),
(117, 18, NULL, 5, NULL, 'Keluhan', 'Cek', 'Mitra', 'Cek', 'Complete', '2020-11-05 15:08:42', '2020-06-16 13:29:47', NULL, 1),
(118, 18, NULL, 9, 5, 'Keluhan', 'Lantai licin', 'Mitra', 'minyaj', 'Complete', '2020-11-21 14:58:09', '2020-06-17 13:07:57', '118.jpeg', 1),
(119, 18, NULL, 1, 5, 'Keluhan', 'Toiler', 'Mitra', 'Toilet pria mati air', 'Closed', '2020-06-17 20:49:41', '2020-06-17 20:49:41', '119.jpeg', 0),
(120, 18, NULL, 9, 10, 'Keluhan', 'Kebersihan', 'Mitra', 'Sampah berserakan', 'Complete', '2020-11-21 15:01:02', '2020-06-18 09:23:11', NULL, 1),
(121, NULL, NULL, 10, 10, 'Keluhan', 'Kebersihan', 'Mitra', 'Sampah berserakan', 'Closed', '2020-06-18 09:26:02', '2020-06-18 09:26:02', NULL, 0),
(122, 18, NULL, 9, NULL, 'Keluhan', 'AC da', 'Mitra', 'Ac tidak dingin lagi', 'Open', '2020-11-22 15:21:00', '2020-06-24 19:40:25', '122.jpeg', 1),
(123, 18, NULL, 5, NULL, 'Keluhan', 'Toilet', 'Mitra', 'Pintu toilet rusak', 'Closed', '2020-06-30 17:23:35', '2020-06-30 15:57:56', '123.jpeg', 0),
(124, 18, NULL, 9, 12, 'Keluhan', 'Toilet', 'Mitra', 'Air kran menyala terus', 'Complete', '2020-11-19 13:22:24', '2020-06-30 17:34:22', '124.jpeg', 1),
(125, 18, NULL, 5, 2, 'Keluhan', 'Cek', 'Mitra', 'Ac tidak dingin', 'Complete', '2020-11-22 19:10:35', '2020-07-03 15:27:47', '125.jpeg', 1),
(126, NULL, NULL, NULL, 10, 'Keluhan', 'AC da', 'Mitra', 'Ac tidak dingin', 'Request', '2020-07-03 15:35:50', '2020-07-03 15:35:50', NULL, 0),
(127, NULL, NULL, NULL, 10, 'Keluhan', 'Cek', 'Mitra', 'Cek', 'Request', '2020-07-03 15:52:58', '2020-07-03 15:52:58', '127.jpeg', 0),
(128, NULL, NULL, NULL, NULL, 'Keluhan', 'AC da', 'Mitra', 'Ac tidak dingin', 'Request', '2020-07-03 15:54:02', '2020-07-03 15:54:02', NULL, 0),
(129, NULL, NULL, NULL, 2, 'Keluhan', 'Keran Air', 'Mitra', 'Keran air mati', 'Request', '2020-07-06 00:33:19', '2020-07-06 00:33:19', NULL, 0),
(130, 18, NULL, 9, NULL, 'Keluhan', 'Toilet', 'Mitra', 'Toilet tersumbat', 'Closed', '2020-07-08 20:03:10', '2020-07-06 00:34:09', NULL, 4),
(131, NULL, NULL, NULL, NULL, 'Keluhan', 'Cek', 'Mitra', 'Cek', 'Request', '2020-07-06 01:25:16', '2020-07-06 01:25:16', NULL, 0),
(132, 18, NULL, 5, 10, 'Keluhan', 'kursi', 'Mitra', 'kursi depan rusak', 'Closed', '2020-07-09 08:41:13', '2020-07-08 21:58:21', '132.jpeg', 1),
(133, NULL, NULL, NULL, 12, 'Saran', 'Toilet', 'Mitra', 'Air kran diberi kaporit', 'Closed', '2020-07-13 13:30:44', '2020-07-13 13:30:44', NULL, 0),
(134, 18, 97, 9, 5, 'Keluhan', 'Kursi1', 'Mitra', 'kursi kotor', 'Closed', '2020-11-21 14:26:13', '2020-09-02 14:19:41', NULL, 1),
(135, 18, 98, 5, 13, 'Keluhan', 'kursi', 'Mitra', 'kursi depan rusak', 'Complete', '2020-11-05 14:56:29', '2020-11-05 14:43:08', '135.jpeg', 4),
(136, NULL, 99, NULL, 12, 'Keluhan', 'Tempat duduk', 'Mitra', 'Tempat duduk sudah tidak nyaman', 'Request', '2020-11-22 12:35:42', '2020-11-22 12:35:42', '136.jpeg', 0),
(137, 18, 99, 9, 10, 'Keluhan', 'tes', 'Mitra', 'tes', 'Complete', '2020-11-22 15:20:31', '2020-11-22 12:41:05', '137.jpeg', 1),
(138, 18, 99, 8, 12, 'Keluhan', 'Kursi', 'Mitra', 'Tidak nyaman', 'Complete', '2020-11-22 19:10:15', '2020-11-22 17:51:55', NULL, 1),
(139, NULL, 98, NULL, 13, 'Keluhan', 'kursi', 'Mitra', 'kursi depan rusak', 'Request', '2020-11-22 21:35:06', '2020-11-22 21:35:06', '139.jpeg', 0),
(140, NULL, 98, NULL, 13, 'Keluhan', 'kursi', 'Mitra', 'kursi depan rusak', 'Request', '2020-11-22 21:39:19', '2020-11-22 21:39:19', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `Id_akun` int(11) NOT NULL,
  `id_departemen` int(5) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `Nama` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` text NOT NULL,
  `No_Telp` varchar(15) NOT NULL,
  `status` varchar(15) DEFAULT NULL,
  `hak_akses` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`Id_akun`, `id_departemen`, `id_unit`, `Nama`, `Email`, `Password`, `No_Telp`, `status`, `hak_akses`) VALUES
(9, NULL, NULL, 'bpn.ph@ap1.co.id', 'bpn.ph@ap1.co.id', 'a33b2b3700993864727b6087ed743d52', '0', '0', ''),
(18, 3, 9, 'Raihan Raihan', '11181061@student.itk.ac.id', 'daa6b8d04ce72d953d5501adc53ddd82', '085822567649', 'Unit', 'Super Admin'),
(51, 2, 6, 'tes', 'deku@gmail.com', '9cc96879a834f2fd6db0ff84588b68e4', '09090', 'Unit', 'Unit'),
(52, 13, 41, 'Thea', 'theodoraed@gmail.com', '1f694d82c88a84f23347338e4864d5ec', '081350356730', 'Unit', 'Admin1'),
(54, 3, 8, 'Raihan', 'raihanr090@gmail.com', 'daa6b8d04ce72d953d5501adc53ddd82', '085822567649', 'Unit', 'Unit'),
(55, NULL, NULL, 'raihan', 'becaksuper2@gmail.com', '5623234d45d9205e9f30526484867986', '085155052774', 'AOC Head', 'Unit'),
(56, NULL, NULL, 'Raihan', 'hackerouroboros39@gmail.com', '75ac3fc54280d5f2d29f68568e8c1d13', '08080', 'General Manager', 'Unit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_perusahaan` varchar(30) DEFAULT NULL,
  `gerai` varchar(30) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `masa_berlaku` date NOT NULL,
  `id_pass_bandara` varchar(30) NOT NULL,
  `pass_bandara` text DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `nama_perusahaan`, `gerai`, `nama`, `email`, `no_telp`, `password`, `status`, `masa_berlaku`, `id_pass_bandara`, `pass_bandara`, `foto`) VALUES
(67, 're', 're', 're', 'rege@gmail.com', '63', '12eccbdd9b32918131341f38907cbbb5', 1, '2021-06-17', '32', '67.jpeg', '67.jpeg'),
(73, 'po', 'po', 'oi', 'lo@gmail.com', '36', '7ce8636c076f5f42316676f7ca5ccfbe', 1, '2021-06-17', 'p', '73.jpeg', '73.jpeg'),
(97, 'Tambakin', 'balikpapan', 'Raihan r', 'kukur@gmail.com', '9696', '3e16bb99dbc28ebab973a1c5238c712b', 1, '2021-09-02', '0909', '97.jpg', '97.jpg'),
(98, 'PT MAJU JAYA', 'retail', 'SUKMA', 'nawang.ayunanda@ap1.co.id', '000', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2020-12-20', '12345', '98.jpg', '98.jpg'),
(99, 'Tambak.in', 'Samarinda', 'kukuro kabuto', 'kukurokabuto@gmail.com', '085822567649', '4a5ea11b030ec1cfbc8b9947fdf2c872', 1, '2021-09-29', '', '99.jpg', '99.jpg'),
(100, 'de', 'de', 'de', 'dede@gmail.com', '858585', 'b4be1c568a6dc02dcaf2849852bdb13e', 2, '2020-11-22', 'null', '100.jpeg', NULL),
(101, 'yoi', 'balikapapn', 'Raihan', 'lele@gmail.com', '0090090', '69bfc4ef467b367e3515cdcf693e65db', 0, '2021-11-22', '', NULL, NULL),
(102, 'cek', 'cek', 'cek', 'cek', '123', 'effac931238fe1025325d5c106d631cf', 0, '2021-11-22', '123', NULL, '102.jpeg'),
(103, 'dek', 'dek', 'dede', 'bwareprojects@gmail.com', '085822', 'd1cabdbeb04256165afd1947682f22e3', 0, '2020-11-22', '123', NULL, '103.jpg'),
(104, 'Yosan', 'Balikpapan', 'Yosan', 'raihanrahman@re-beat.xyz', '555', '137bf89f73807f094fbba5ff97385077', 1, '2021-11-23', '2020', '104.jpeg', '104.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id_departemen` int(11) NOT NULL,
  `Departemen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_departemen`
--

INSERT INTO `tb_departemen` (`id_departemen`, `Departemen`) VALUES
(2, 'Security'),
(3, 'Facilities'),
(4, 'Equipment'),
(5, 'Sales & Business Development'),
(6, 'Information'),
(7, 'Finance'),
(8, 'Procurement'),
(10, 'Shared Services'),
(13, 'Safety & Quality');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_lokasi`
--

CREATE TABLE `tb_detail_lokasi` (
  `id_detail_lokasi` int(3) NOT NULL,
  `id_lokasi` int(3) DEFAULT NULL,
  `nama_detail_lokasi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_lokasi`
--

INSERT INTO `tb_detail_lokasi` (`id_detail_lokasi`, `id_lokasi`, `nama_detail_lokasi`) VALUES
(2, 1, 'Gerbang Utama'),
(5, 1, 'Selatan'),
(9, 1, 'Gerbang Utara'),
(10, 2, 'Lantai 1'),
(12, 2, 'Lantai 2'),
(13, 3, 'Baju'),
(14, 3, 'Celana'),
(16, NULL, 'Cek lagi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_forgot_password`
--

CREATE TABLE `tb_forgot_password` (
  `id` int(5) NOT NULL,
  `token` varchar(6) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status_akun` varchar(8) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_forgot_password`
--

INSERT INTO `tb_forgot_password` (`id`, `token`, `email`, `status_akun`, `start`, `end`) VALUES
(1, '', 'raihanr090@gmail.com', 'customer', '2020-03-14 13:41:43', '2020-03-14 14:41:43'),
(2, 's0cdWL', 'raihanr090@gmail.com', 'customer', '2020-03-14 13:55:40', '2020-03-14 14:55:40'),
(23, 'HgvQcB', 'raihanr090@gmail.com', 'customer', '2020-04-01 13:25:40', '2020-04-01 14:25:40'),
(22, 'fpnzi8', 'raihanr090@gmail.com', 'customer', '2020-04-01 13:13:53', '2020-04-01 14:13:53'),
(21, 'Om1MMA', 'raihanr090@gmail.com', 'customer', '2020-04-01 13:13:02', '2020-04-01 14:13:02'),
(8, 'N2tOx1', 'raihanr090@gmail.com', 'customer', '2020-03-15 07:03:07', '2020-03-15 08:03:07'),
(20, 'HMnPj9', 'raihanr090@gmail.com', 'customer', '2020-04-01 12:55:59', '2020-04-01 13:55:59'),
(19, 'Mz4cP2', 'raihanr090@gmail.com', 'customer', '2020-03-15 10:54:47', '2020-03-15 11:54:47'),
(18, 'HWPRVo', 'raihanr090@gmail.com', 'customer', '2020-03-15 09:39:54', '2020-03-15 10:39:54'),
(17, '2OFt6Y', 'raihanr090@gmail.com', 'customer', '2020-03-15 07:42:48', '2020-03-15 08:42:48'),
(24, 'xuNVD6', 'raihanr090@gmail.com', 'customer', '2020-04-01 13:31:24', '2020-04-01 14:31:24'),
(25, 'M4QCOk', 'raihanr090@gmail.com', 'customer', '2020-04-01 13:35:08', '2020-04-01 14:35:08'),
(26, 'kYa8jE', 'raihanr090@gmail.com', 'customer', '2020-04-10 14:19:03', '2020-04-10 15:19:03'),
(27, 'M', '11181061@student.itk.ac.id', 'admin', '2020-04-18 15:37:02', '2020-04-18 16:37:02'),
(28, '3', '11181061@student.itk.ac.id', 'admin', '2020-04-18 15:39:27', '2020-04-18 16:39:27'),
(29, 'y', '11181061@student.itk.ac.id', 'admin', '2020-04-18 15:40:27', '2020-04-18 16:40:27'),
(30, 'Vyla3c', 'raihanr090@gmail.com', 'customer', '2020-04-20 08:25:35', '2020-04-20 09:25:35'),
(31, 'N061xk', 'raihanr090@gmail.com', 'customer', '2020-04-23 20:19:59', '2020-04-23 21:19:59'),
(32, 'ezNgyQ', 'raihanr090@gmail.com', 'customer', '2020-04-23 20:20:08', '2020-04-23 21:20:08'),
(33, 'CrItDh', 'raihanr090@gmail.com', 'customer', '2020-04-23 20:20:52', '2020-04-23 21:20:52'),
(34, 'rif3do', 'raihanr090@gmail.com', 'customer', '2020-04-23 20:33:10', '2020-04-23 21:33:10'),
(35, 'XrkYff', 'raihanr090@gmail.com', 'customer', '2020-04-24 03:44:17', '2020-04-24 04:44:17'),
(36, 'zDnuMU', 'raihanr090@gmail.com', 'customer', '2020-04-24 03:50:24', '2020-04-24 04:50:24'),
(37, 'H8OhQZ', 'raihanr090@gmail.com', 'customer', '2020-06-16 06:00:00', '2020-06-16 07:00:00'),
(38, '4BRpYT', 'nawang.ayunanda@ap1.co.id', 'customer', '2020-07-12 22:01:05', '2020-07-12 23:01:05'),
(39, 'RnAtE1', 'nawang.ayunanda@ap1.co.id', 'customer', '2020-07-12 22:03:09', '2020-07-12 23:03:09'),
(40, 'PGvshM', 'nawang.ayunanda@ap1.co.id', 'customer', '2020-07-13 12:42:20', '2020-07-13 13:42:20'),
(41, 'w3axJi', 'kukurokabuto@gmail.com', 'customer', '2020-11-22 18:27:13', '2020-11-22 19:27:13'),
(42, 'Nzf7ys', 'kukurokabuto@gmail.com', 'customer', '2020-11-22 18:31:28', '2020-11-22 19:31:28'),
(43, 'dTZZXG', 'kukurokabuto@gmail.com', 'customer', '2020-11-22 19:36:19', '2020-11-22 20:36:19'),
(44, 'awt2PD', 'raihanr090@gmail.com', 'admin', '2020-11-22 19:37:25', '2020-11-22 20:37:25'),
(45, '6egCdx', 'raihanr090@gmail.com', 'admin', '2020-11-22 20:13:22', '2020-11-22 21:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterangan_tambahan`
--

CREATE TABLE `tb_keterangan_tambahan` (
  `id_keterangan` int(12) NOT NULL,
  `id_aduan` int(12) DEFAULT NULL,
  `id_akun` int(11) NOT NULL,
  `pertanyaan` varchar(50) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `bukti` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keterangan_tambahan`
--

INSERT INTO `tb_keterangan_tambahan` (`id_keterangan`, `id_aduan`, `id_akun`, `pertanyaan`, `jawaban`, `link`, `bukti`) VALUES
(15, 76, 0, 'waktu', NULL, '9bf31c7ff062936a96d3c8bd1f8f2ff3', ''),
(18, 96, 18, 'pada hari apa', 'senin', '6f4922f45568161a8cdf4ad2299f6d23', ''),
(19, 78, 18, 'Hari', NULL, '1f0e3dad99908345f7439f8ffabdffc4', ''),
(20, 117, 0, 'Kenapa bisa begitu', 'Tidak bisa dibuka', '98f13708210194c475687be6106a3b84', ''),
(21, 117, 0, 'hari apa', NULL, '3c59dc048e8850243be8079a5c74d079', ''),
(22, 119, 18, 'Mohon isikan data waktu', 'Hari senin 20 januari', 'b6d767d2f8ed5d21a44b0e5886680cb9', ''),
(23, 121, 0, 'Mohon isikan letak kolom parkiran', 'Jam Berapa', '37693cfc748049e45d87b8c7d8b9aacd', ''),
(24, 121, 18, 'Apakah tempat sampah', 'Ada', '1ff1de774005f8da13f42943881c655f', ''),
(25, 78, 0, 'Kenapa bisa begitu', NULL, '8e296a067a37563370ded05f5a3bf3ec', ''),
(26, 78, 0, 'Kenapa bisa begitu', NULL, '4e732ced3463d06de0ca9a15b6153677', ''),
(27, 120, 18, 'Keberadaan', 'Kerjaan dadah\r\nsebelah kursi', '02e74f10e0327ad868d138f2b4fdd6f0', '.jpg'),
(28, 120, 18, 'Jawab ini gan', 'Ini \r\nsaya jawab', '33e75ff09dd601bbe69f351039152189', NULL),
(29, 120, 18, 'Terima kasih atas feedback anda, mohon isikan kete', 'jawab', '6ea9ab1baa0efb9e19094440c317e21b', NULL),
(30, 97, 18, 'Jawab ini gan', NULL, '34173cb38f07f89ddbebc2ac9128303f', NULL),
(31, 97, 18, '', NULL, 'c16a5320fa475530d9583c34fd356ef5', NULL),
(32, 99, 53, 'mohon dilampirkan detail foto', NULL, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', NULL),
(33, 99, 18, 'berapa jumlah nya ?', NULL, '182be0c5cdcd5072bb1864cdee4d3d6e', NULL),
(34, 124, 18, 'mohon dilampirkan detail foto', '', 'e369853df766fa44e1ed0ff613f563bd', '124.jpg'),
(35, 124, 18, 'mohon dilampirkan detail foto', '', '1c383cd30b7c298ab50293adfecb7b18', '124.jpg'),
(36, 132, 18, 'dokumentasi detail belum dilampirkan', '', '19ca14e7ea6328a42e0eb13d585e4c22', '132.jpg'),
(37, 99, 18, 'inikenapa', NULL, 'a5bfc9e07964f8dddeb95fc584cd965d', NULL),
(38, 100, 18, 'cek mau gak', NULL, 'a5771bce93e200c36f7cd9dfd0e5deaa', NULL),
(39, 100, 18, 'cek mau gak', NULL, 'd67d8ab4f4c10bf22aa353e27879133c', NULL),
(40, 124, 18, 'Berapa lama', NULL, 'd645920e395fedad7bbbed0eca3fe2e0', NULL),
(41, 137, 18, 'Mohon tambahkan keterangan waktu', 'pada hari rabu 2020', '3416a75f4cea9109507cacd8e2f2aefc', '137.jpg'),
(42, 137, 18, 'Mohon isi data lokasi', 'Balikpapan', 'a1d0c6e83f027327d8461063f4ac58a6', NULL),
(43, 137, 18, 'notifikasi', NULL, '17e62166fc8586dfa4d1bc0e1742c08b', NULL),
(44, 137, 18, 'cek', 'mantap', 'f7177163c833dff4b38fc8d2872f1ec6', NULL),
(45, 137, 18, 'dede', 'cek', '6c8349cc7260ae62e3b1396831a8398f', NULL),
(46, 137, 18, 'ini pasti mau', 'Karena sudah kubaiki', 'd9d4f495e875a2e075a1a4a6e1b9770f', NULL),
(47, 137, 18, 'hayo kenapa yok', NULL, '67c6a1e7ce56d3d6fa748ab6d9af3fd7', NULL),
(48, 137, 18, 'Cek cek', NULL, '642e92efb79421734881b53e1e1b18b6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(3) NOT NULL,
  `nama_lokasi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Gerbang Kedatangan'),
(2, 'Parkiran'),
(3, 'Toko');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `email` varchar(30) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_notif`
--

INSERT INTO `tb_notif` (`email`, `waktu`) VALUES
('bwareprojects@gmail.com', '2020-11-23 22:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`) VALUES
(123, '13'),
(11181060, 'Yoi Akuakultur'),
(11181061, 'Yoi Akuakultur');

-- --------------------------------------------------------

--
-- Table structure for table `tb_progress`
--

CREATE TABLE `tb_progress` (
  `id_progress` int(12) NOT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `id_aduan` int(12) DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_progress`
--

INSERT INTO `tb_progress` (`id_progress`, `id_akun`, `id_aduan`, `tindakan`, `bukti`, `waktu`) VALUES
(39, NULL, 76, 'Kurang Data', NULL, '2020-04-26'),
(40, NULL, 76, 'Pesan Alat', '40.png', '2020-04-26'),
(41, NULL, 76, 'Closed', NULL, '2020-04-26'),
(47, NULL, 81, 'Closed', NULL, '2020-05-22'),
(48, NULL, 81, 'Closed', NULL, '2020-06-14'),
(49, NULL, 77, 'Closed', NULL, '2020-06-14'),
(50, NULL, 78, 'Kurang Data', NULL, '2020-06-14'),
(51, NULL, 79, '', NULL, '2020-06-14'),
(52, NULL, 78, '', NULL, '2020-06-14'),
(53, NULL, 79, 'Closed', NULL, '2020-06-14'),
(54, NULL, 82, '', NULL, '2020-06-14'),
(55, NULL, 80, 'pembersihan', '55.jpg', '2020-06-16'),
(56, NULL, 80, 'tes', '56.jpg', '2020-06-16'),
(57, NULL, 80, 'Kurang Data', NULL, '2020-06-16'),
(58, NULL, 113, 'Closed', NULL, '2020-06-18'),
(59, NULL, 121, 'Closed', NULL, '2020-06-18'),
(62, 18, 114, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-06-24'),
(63, 18, 114, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-06-24'),
(64, 18, 114, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-06-24'),
(65, 18, 114, 'Diterukan ke unit', NULL, '2020-06-24'),
(66, 18, 78, 'Diteruskan ke unit', NULL, '2020-06-24'),
(67, 18, 80, 'Diteruskan ke unit', NULL, '2020-06-24'),
(68, 18, 80, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-06-24'),
(69, 18, 80, 'Diteruskan ke unit', NULL, '2020-06-24'),
(70, 18, 78, 'sip', '70.png', '2020-06-24'),
(71, 18, 82, 'Diterukan ke unit', NULL, '2020-06-24'),
(72, 51, 78, 'Perbaikan', '72.vsdx', '2020-06-24'),
(74, 18, 82, 'Perbaikan', '74.png', '2020-06-25'),
(75, 18, 82, 'Perbaikan', '75.png', '2020-06-25'),
(77, 18, 80, 'Perbaikan', '77.png', '2020-06-25'),
(78, 18, 97, 'Diterukan ke unit', NULL, '2020-06-25'),
(79, 18, 98, 'Diterukan ke unit', NULL, '2020-06-25'),
(80, 18, 98, 'Perbaikan', '80.png', '2020-06-25'),
(81, 18, 97, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-06-25'),
(82, 18, 123, 'Diterukan ke unit', NULL, '2020-06-30'),
(84, 18, 124, 'Diterukan ke unit', NULL, '2020-07-02'),
(86, 18, 98, 'Dikembalikan ke cs dengan keterangan Bukan unit', NULL, '2020-07-03'),
(87, 18, 98, 'Diterukan ke unit', NULL, '2020-07-03'),
(88, 18, 97, 'Diterukan ke unit', NULL, '2020-07-03'),
(89, 18, 124, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-07-03'),
(90, 18, 124, 'Diterukan ke unit', NULL, '2020-07-03'),
(91, 51, 98, 'sudah dilakukan tindakan perbaikan ', '91.jpeg', '2020-07-03'),
(92, 18, 97, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-07-05'),
(93, 18, 124, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-07-06'),
(94, 18, 124, 'Diterukan ke unit', NULL, '2020-07-06'),
(95, 18, 124, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-07-06'),
(96, 49, 124, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-07-06'),
(97, 18, 97, 'Diterukan ke unit', NULL, '2020-07-06'),
(98, 18, 99, 'Diterukan ke unit', NULL, '2020-07-06'),
(100, 51, 97, 'Perbaikan', '100.png', '2020-07-06'),
(101, 18, 124, 'Diterukan ke unit', NULL, '2020-07-08'),
(103, 18, 130, 'Diterukan ke unit', NULL, '2020-07-08'),
(104, 18, 111, 'Diterukan ke unit', NULL, '2020-07-08'),
(105, 18, 132, 'Diterukan ke unit', NULL, '2020-07-09'),
(106, 51, 132, 'pencarian titik', '106.jpg', '2020-07-09'),
(107, 51, 132, 'sudah dilakukan tindakan perbaikan ', '107.jpg', '2020-07-09'),
(108, 18, 99, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-08-05'),
(109, 18, 111, 'Closed', NULL, '2020-08-05'),
(110, 18, 130, 'Closed', NULL, '2020-09-02'),
(111, 18, 124, 'ded3', '111.jpg', '2020-09-02'),
(112, 18, 124, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-02'),
(113, 18, 124, 'Diteruskan ke unit', NULL, '2020-09-02'),
(114, 18, 134, 'Diteruskan ke unit', NULL, '2020-09-03'),
(115, 18, 134, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-03'),
(116, 18, 100, 'Diteruskan ke unit', NULL, '2020-09-03'),
(117, 18, 100, 'Closed', NULL, '2020-09-12'),
(118, 18, 124, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-12'),
(119, 18, 132, 'Closed', NULL, '2020-09-14'),
(120, 18, 134, 'Diteruskan ke unit', NULL, '2020-09-14'),
(121, 18, 134, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-14'),
(122, 18, 134, 'Diteruskan ke unit', NULL, '2020-09-14'),
(123, 18, 134, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-14'),
(124, 18, 134, 'Diteruskan ke unit', NULL, '2020-09-14'),
(125, 18, 134, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-14'),
(126, 18, 134, 'Diteruskan ke unit', NULL, '2020-09-14'),
(127, 18, 134, 'Dikembalikan ke CS dengan keterangan ', NULL, '2020-09-14'),
(128, 18, 112, 'Diteruskan ke unit', NULL, '2020-09-14'),
(129, 18, 112, 'Dikembalikan ke CS dengan keterangan bukan tangguna jawab kami', NULL, '2020-09-14'),
(130, 18, 99, 'Diterukan ke unit', NULL, '2020-09-14'),
(131, 18, 99, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-09-14'),
(132, 18, 99, 'Diterukan ke unit', NULL, '2020-09-25'),
(133, 18, 112, 'Diterukan ke unit', NULL, '2020-09-25'),
(135, 18, 115, 'Diterukan ke unit', NULL, '2020-09-25'),
(136, 18, 112, 'cek', '136.jpg', '2020-09-25'),
(137, 18, 115, 'de', '137.png', '2020-09-25'),
(138, 18, 116, 'Diterukan ke unit', NULL, '2020-09-25'),
(142, 18, 135, 'Diterukan ke unit', NULL, '2020-11-05'),
(143, 18, 117, 'Diterukan ke unit', NULL, '2020-11-05'),
(144, 51, 117, '', '144.png', '2020-11-05'),
(145, 18, 124, 'Diterukan ke unit', NULL, '2020-11-19'),
(146, 18, 124, 'Perbaikan Selesai', '146.png', '2020-11-19'),
(147, 18, 134, 'Diterukan ke unit', NULL, '2020-11-21'),
(148, 18, 118, 'Diterukan ke unit', NULL, '2020-11-21'),
(149, 18, 120, 'Diterukan ke unit', NULL, '2020-11-21'),
(150, 18, 118, 'coba notifikasi', '150.png', '2020-11-21'),
(151, 18, 120, 'cek', '151.png', '2020-11-21'),
(152, 18, 124, 'selesai', '152.png', '2020-11-21'),
(155, 18, 137, 'Diterukan ke unit', NULL, '2020-11-22'),
(156, 18, 137, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-11-22'),
(157, 18, 135, 'Diganti', '157.png', '2020-11-22'),
(158, 18, 137, 'Diterukan ke unit', NULL, '2020-11-22'),
(159, 18, 122, 'Diterukan ke unit', NULL, '2020-11-22'),
(160, 18, 137, 'Dikembalikan ke cs dengan keterangan Kurang Data', NULL, '2020-11-22'),
(161, 18, 138, 'Diterukan ke unit', NULL, '2020-11-22'),
(162, 18, 125, 'Diterukan ke unit', NULL, '2020-11-22'),
(163, 18, 137, 'Diteruskan ke unit', NULL, '2020-11-22'),
(164, 54, 137, 'Dikembalikan ke CS dengan keterangan Kurang Data', NULL, '2020-11-22'),
(165, 18, 137, 'Diteruskan ke unit', NULL, '2020-11-22'),
(166, 18, 138, 'Dikembalikan ke CS dengan keterangan bukan tangguna jawab kami', NULL, '2020-11-22'),
(167, 18, 138, 'Diteruskan ke unit', NULL, '2020-11-22'),
(168, 54, 138, 'perbaikan', '168.jpg', '2020-11-22'),
(169, 54, 138, 'perbaikan', '169.jpg', '2020-11-22'),
(170, 18, 137, 'perbaikan', '170.jpg', '2020-11-23'),
(171, 18, 137, 'perbaikan', '171.jpg', '2020-11-23'),
(172, 18, 125, 'cekcek', '172.jpg', '2020-11-23'),
(173, 18, 137, 'perbaikan', '173.jpg', '2020-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `status` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_token`
--

INSERT INTO `tb_token` (`status`, `id`, `token`) VALUES
('akun', 18, 'cxxlJAhQQOeRiKUi3akxFM:APA91bGuh4Cl_ATrxPQDrREAp4bRCEju1_FXwNMWAUnnEMWZN_NoZYcjQnDXGzlFDIA4_Q4SlKd3JCpx4L9ONSfKp-pQg60WQG8Lbouns9cQDuBfby2tZubN09B4zGGMURatc1894W9h'),
('akun', 18, 'd-_-rtPHQi-oprRDR8gwDf:APA91bFR61RGMi5L5D5SkEK69nKdv1geXszp32ih36jVfOlsl3wBx739iREhrGQwMGZ4ba053pVJo-pBmie-U2VqERYQ4nmiCy6LGP8lsBpJQcNx_i11HM8Ih1uBCf8yFCWqJBHzHgCx'),
('customer', 100, 'fhjlSgiTTBa9jpsduAiMAU:APA91bEU0ngx60pCmUMHhWaZ4pONMJMRaFJY180pg3KNgTMjJkFm8S9ykvAR9lwj5-TF66eFFAtCbBeyI0OE_Nm11pnaFCnt0lFBXBHgMn8u7nOcOLrdruniMvS58ycxHl8ZMMokEQIY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `nama_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `id_departemen`, `nama_unit`) VALUES
(1, NULL, 'Airside'),
(2, NULL, 'Lanside & Terminal'),
(3, NULL, 'Rescue & Fire Fighting'),
(4, NULL, 'Customer Service'),
(5, 2, 'Screening Manager'),
(6, 2, 'Terminal Protection'),
(7, 2, 'Non Terminal Protection'),
(8, 3, 'Airside Manager'),
(9, 3, 'Landside Environment'),
(10, 3, 'Terminal Building'),
(11, 4, 'Mechanical'),
(12, 4, 'Electrical'),
(13, 5, 'Aeronautical and Cargo Sales'),
(14, 5, 'Property and Advertising'),
(17, 5, 'Retail, Food & Beverage'),
(18, 6, 'Application Operation & Support'),
(19, 6, 'Network OPS & Support'),
(21, 7, 'Treasury'),
(22, 7, 'Account Receiveble'),
(23, 8, 'Non Cluster'),
(24, 8, 'Cluster'),
(25, 10, 'Human Capital'),
(26, 10, 'General Service'),
(27, 10, 'Aset Management'),
(28, 10, 'Corporate Social Responsibility'),
(29, NULL, 'SMS & Occupational Safety Health'),
(30, NULL, 'Quality Management'),
(31, NULL, 'Risk Management'),
(36, NULL, 'Properti'),
(37, NULL, 'properti'),
(39, 7, 'Accounting'),
(40, NULL, 'Cek1'),
(41, 13, 'SMS & Occupation Safety Health'),
(42, 13, 'Quality management'),
(43, 13, 'Risk Management'),
(44, NULL, 'cek 3'),
(46, NULL, 'Palakah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`id_aduan`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_departemen` (`id_unit`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_detail_lokasi` (`id_detail_lokasi`);

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`Id_akun`),
  ADD KEY `Id_Departemen` (`id_unit`),
  ADD KEY `id_departemen_2` (`id_departemen`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id_departemen`),
  ADD UNIQUE KEY `Hak_Akses` (`id_departemen`);

--
-- Indexes for table `tb_detail_lokasi`
--
ALTER TABLE `tb_detail_lokasi`
  ADD PRIMARY KEY (`id_detail_lokasi`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `tb_forgot_password`
--
ALTER TABLE `tb_forgot_password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  ADD PRIMARY KEY (`id_keterangan`),
  ADD KEY `id_aduan` (`id_aduan`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_progress`
--
ALTER TABLE `tb_progress`
  ADD PRIMARY KEY (`id_progress`),
  ADD KEY `id_aduan` (`id_aduan`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  MODIFY `id_aduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `Id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_detail_lokasi`
--
ALTER TABLE `tb_detail_lokasi`
  MODIFY `id_detail_lokasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_forgot_password`
--
ALTER TABLE `tb_forgot_password`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  MODIFY `id_keterangan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11181062;

--
-- AUTO_INCREMENT for table `tb_progress`
--
ALTER TABLE `tb_progress`
  MODIFY `id_progress` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD CONSTRAINT `tb_aduan_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`Id_akun`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_4` FOREIGN KEY (`id_detail_lokasi`) REFERENCES `tb_detail_lokasi` (`id_detail_lokasi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD CONSTRAINT `tb_akun_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_akun_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `tb_departemen` (`id_departemen`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_lokasi`
--
ALTER TABLE `tb_detail_lokasi`
  ADD CONSTRAINT `tb_detail_lokasi_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `tb_lokasi` (`id_lokasi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  ADD CONSTRAINT `tb_keterangan_tambahan_ibfk_1` FOREIGN KEY (`id_aduan`) REFERENCES `tb_aduan` (`id_aduan`);

--
-- Constraints for table `tb_progress`
--
ALTER TABLE `tb_progress`
  ADD CONSTRAINT `tb_progress_ibfk_1` FOREIGN KEY (`id_aduan`) REFERENCES `tb_aduan` (`id_aduan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `tb_departemen` (`id_departemen`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
