-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2021 pada 13.52
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customer_service`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aduan`
--

CREATE TABLE `tb_aduan` (
  `id_aduan` int(11) NOT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `nama_unit` varchar(200) DEFAULT NULL,
  `nama_departemen` varchar(200) DEFAULT NULL,
  `nama_detail_lokasi` varchar(200) DEFAULT NULL,
  `nama_lokasi` varchar(200) DEFAULT NULL,
  `jenis` varchar(10) NOT NULL,
  `urgensi` tinyint(4) DEFAULT 0,
  `perihal` text NOT NULL,
  `pelapor` varchar(20) NOT NULL,
  `ket` text NOT NULL,
  `status` varchar(12) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `waktu_kirim` datetime NOT NULL,
  `waktu_kejadian` date DEFAULT NULL,
  `keterangan_kejadian` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_aduan`
--

INSERT INTO `tb_aduan` (`id_aduan`, `id_akun`, `id_customer`, `id_unit`, `nama_unit`, `nama_departemen`, `nama_detail_lokasi`, `nama_lokasi`, `jenis`, `urgensi`, `perihal`, `pelapor`, `ket`, `status`, `waktu`, `waktu_kirim`, `waktu_kejadian`, `keterangan_kejadian`, `foto`, `level`) VALUES
(1, 132, NULL, 9, 'Airport Facilities', 'Technical', 'Gedung parkir terminal', 'rusak', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'lampu di gate 7 berkedip ( mohon untuk dilakukan perbaikan guna optimaliasi pada proses survey ASQ ACI ) \r\n( Testing case untuk masa percobaan sistem OGFS,case diambil dari group WAG, mohon untuk dilakukan proses tindakan pada akun PIC, terimakasih )', 'Closed', '2021-05-20 23:14:13', '2021-06-01 12:34:26', NULL, NULL, NULL, 4),
(2, 132, NULL, 9, 'Airport Facilities', 'Technical', 'Gedung parkir terminal', 'lampu pojok', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Ini listriknya konslet', 'Closed', '2021-04-18 17:27:42', '2021-04-14 12:34:26', NULL, NULL, NULL, 4),
(3, 132, NULL, 9, 'Airport Facilities', 'Technical', 'Gedung parkir terminalGedung parkir terminalGedung parkir terminalGedung parkir terminal', 'Parkiran A3', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Ini sangat panjangIni sangat panjangIni sangat panjangIni sangat panjangngIni sangat panjangIni sangat panjangIni sangat panjangIni sangat panjangngIni sangat panjangIni sangat panjangIni sangat panjangIni sangat panjangngIni sangat panjangIni sangat panjangIni ', 'Closed', '2021-05-26 20:20:42', '2021-06-01 12:34:26', NULL, NULL, '3.jpg', 4),
(5, 136, NULL, 9, 'Airport Facilities', 'Technical', 'Gedung parkir terminal', 'lokasi', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Ini keterangannya', 'Closed', '2021-04-29 12:14:06', '2021-01-07 12:34:26', NULL, NULL, NULL, 1),
(6, 132, NULL, 9, 'Airport Facilities', 'Technical', 'ini detail lokasi', 'Perkantoran AP1', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini keternagan', 'Closed', '2021-06-07 13:14:53', '2021-06-07 12:34:26', NULL, NULL, NULL, 4),
(7, 132, NULL, 10, 'Airport Equipment (Mechanical)', 'Technical', 'ini detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini keterangan', 'Closed', '2021-06-14 12:37:15', '2021-06-09 12:34:26', NULL, NULL, '7.png', 4),
(8, 132, 116, 9, 'Airport Facilities', 'Technical', 'Kantor CSC keberangkatan', 'Ruang Tunggu Gate 7', 'Keluhan', 0, 'Lampu ruang csc perihalnya agak dipanjangin biar turun ke bawah buat mvp', 'Mitra', 'Selamat pagi , Ijin menginformasikan salahsatu lampu di ruangan CSC mati. Terimakasih Case ini diambil dari WAG Service Imrpovement sebagai trial                \r\n Selamat pagi , Ijin menginformasikan salahsatu lampu di ruangan CSC mati. Terimakasih Case ini diambil dari WAG Service Imrpovement sebagai trial                \r\n Selamat pagi , Ijin menginformasikan salahsatu lampu di ruangan CSC mati. Terimakasih Case ini diambil dari WAG Service Imrpovement sebagai trial                \r\n ', 'Progress', '2021-06-03 19:09:44', '2021-06-03 12:34:26', NULL, NULL, '8.jpeg', 4),
(14, 132, 116, 9, 'Airport Facilities', 'Technical', 'demat tangga', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Listrik di Dekat tanga mati', 'Open', '2021-07-01 09:45:45', '2021-06-11 16:55:28', NULL, NULL, NULL, 4),
(15, NULL, 116, NULL, NULL, NULL, 'Lebih 3 hari', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Ini yang lebih 3 hari', 'Request', '2021-06-13 13:09:03', '2021-06-10 16:55:28', NULL, NULL, NULL, 0),
(16, 132, 116, 9, 'Airport Facilities', 'Technical', 'kursi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Coba lagi', 'Open', '2021-06-13 16:32:56', '2021-06-15 16:57:00', NULL, NULL, NULL, 4),
(17, NULL, 116, NULL, NULL, NULL, 'dede', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'dede', 'Request', '2021-06-13 18:34:02', '2021-06-08 16:57:28', NULL, NULL, NULL, 0),
(18, 9, NULL, NULL, NULL, NULL, 'ini detail Lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Penumpang', 'Ini keterangan', 'Request', '2021-06-14 10:22:34', '2021-06-14 10:22:34', '2021-06-14', NULL, NULL, 0),
(19, 132, 116, 9, 'Airport Facilities', 'Technical', 'detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini pakai keterangan kejadian', 'Open', '2021-06-14 10:28:49', '2021-06-14 10:27:22', '2021-06-02', 'inni keterangan kejadian', NULL, 4),
(20, NULL, 116, NULL, NULL, NULL, 'ini detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'keterangan', 'Request', '2021-06-14 11:14:58', '2021-06-14 11:14:58', '2021-06-12', NULL, NULL, 0),
(21, NULL, 116, NULL, NULL, NULL, 'ini detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'keterangan', 'Request', '2021-06-14 11:15:20', '2021-06-14 11:15:20', '2021-06-12', NULL, NULL, 0),
(22, 132, 116, 61, 'TES 1', 'Service Test', 'Detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini keterangan', 'Closed', '2021-06-16 13:15:06', '2021-06-15 19:29:31', '0000-00-00', NULL, NULL, 1),
(23, 132, 116, 62, 'Percobaan', 'Technical', 'detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'keterangan', 'Closed', '2021-06-16 13:10:27', '2021-06-15 19:32:40', '2021-06-14', NULL, NULL, 1),
(24, 132, 116, 9, 'Airport Facilities', 'Technical', 'sebelah kanan pintu masuk', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'Kaca pecah', 'Closed', '2021-06-16 06:20:44', '2021-06-16 05:48:06', '2021-06-09', 'ini keterangan kejadian', NULL, 2),
(25, 9, NULL, NULL, NULL, NULL, 'detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Penumpang', 'keterangan ', 'Request', '2021-06-16 13:21:18', '2021-06-16 13:21:18', '2021-06-10', 'ini keterangan tanggal', NULL, 0),
(26, 9, NULL, NULL, NULL, NULL, 'detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Penumpang', 'keterangan ', 'Request', '2021-06-16 13:21:52', '2021-06-16 13:21:52', '2021-06-14', NULL, NULL, 0),
(27, NULL, 116, NULL, NULL, NULL, 'ini detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini keterangan', 'Request', '2021-06-30 09:07:29', '2021-06-30 09:07:29', '2021-06-28', NULL, NULL, 0),
(28, NULL, 116, NULL, NULL, NULL, 'ini detail lokasi', 'Gedung parkir terminal', 'Keluhan', 1, 'Konsleting Listrik', 'Mitra', 'ini keterangan', 'Request', '2021-06-30 09:07:45', '2021-06-30 09:07:45', '2021-06-28', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
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
  `hak_akses` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`Id_akun`, `id_departemen`, `id_unit`, `Nama`, `Email`, `Password`, `No_Telp`, `status`, `hak_akses`) VALUES
(9, NULL, NULL, 'bpn.ph@ap1.co.id', 'bpn.ph@ap1.co.id', 'a33b2b3700993864727b6087ed743d52', '0', '0', ''),
(55, 3, 9, 'Kus Hendratno', 'trialaoch@gmail.com', '15a02793380c61d048e610860c09266b', '-', 'Manager', 'Unit'),
(56, NULL, NULL, 'GM Bandara SAMS Sepinggan', 'trialgmcs@gmail.com', 'fe4def8f86bbb679fbba06c752b397fb', '-', 'General Manager', 'Unit'),
(57, NULL, 18, 'Dian Perdana', 'dnperdana18@gmail.com', '1cca6e7a2db2657e1db85e163beb9ae2', '085348593188', 'Unit', 'Super Admin'),
(59, NULL, NULL, 'Yohanes Sudjana', 'trialaoch2@gmail.com', 'a72b6d4cfa5a17d330f5f0b60178dc47', '-', 'AOC Head', 'Unit'),
(60, NULL, NULL, 'Mashudi', 'trialaoch3@gmail.com', 'bdf8cfe19df0006829bcd5e6107bd3db', '-', 'AOC Head', 'Unit'),
(61, 16, 52, 'Rijal', 'rijal.wicaksono@ap1.co.id', '17f864a0c6f0808a40e876e77981707a', '-', 'Unit', 'Unit'),
(62, 16, 52, 'Nano', 'made.krisano@ap1.co.id', '3435e0025a7da3f5515f37bc06ce7194', '-', 'Unit', 'Unit'),
(63, 16, 52, 'Annisaa', 'annisaa@ap1.co.id', '8fa6a9a7ab20b3caa218f9101a29965d', '-', 'Manager', 'Unit'),
(64, 16, NULL, 'Arief Siradjuddin', 'arief.siradjudin@ap1.co.id', '24e2b53d1dec7b13f6394a9ffb5101ba', '-', 'Senior Manager', 'Unit'),
(65, 16, 53, 'Siska', 'siska.yudayani@ap1.co.id', '9f8dc7652cd4b6682a6811377715d635', '-', 'Unit', 'Unit'),
(66, 16, 53, 'Adi', 'i.wirawan@ap1.co.id', '8ce00b4e5adf3d41bd82bba9727ae61c', '-', 'Unit', 'Unit'),
(67, 16, 53, 'Yudi', 'yudi.prasetyo@ap1.co.id', 'bd600bc97a65d04e1c3462e072e4a1ab', '-', 'Manager', 'Unit'),
(68, 16, 54, 'Fajar', 'fajar.setiawan@ap1.co.id', 'fef3fc238e37d629cfcb0a1b0428a14e', '-', 'Unit', 'Unit'),
(69, 16, 54, 'Sugiono', 'sugiono89@ap1.co.id', 'f7071a6d429c9cc0d4ac8d2a8db83a6a', '-', 'Manager', 'Unit'),
(70, 16, 55, 'Hasri', 'hasri@ap1.co.id', '6bac462ccdd54d54ea6237f59aca9c23', '-', 'Unit', 'Unit'),
(71, 16, 57, 'Novita Milana', 'novita.milana@ap1.co.id', '44c8ee56d21d3c9378bb368ace7c4269', '-', 'Manager', 'Unit'),
(72, 13, 41, 'Siwi', 'siwi.astuti@ap1.co.id', 'c63c5b091bdf4c22e1d905ddd1271de6', '-', 'Unit', 'Unit'),
(73, 13, 41, 'Retnowati', 'retnowati@ap1.co.id', '65f089ec20d71cb767b9d50db0c9f4b6', '-', 'Unit', 'Unit'),
(74, 13, 41, 'Aditya Warman', 'aditya.warman@ap1.co.id', 'f629fae884e6e761b3ae00b8bbeb2b7c', '-', 'Manager', 'Unit'),
(75, 13, 42, 'Philipus', 'philipus.igo@ap1.co.id', '5e091f1f672f49c2ef71660fed7c69a7', '-', 'Unit', 'Unit'),
(76, 13, 42, 'Siti', 'siti.ramadhani@ap1.co.id', '7db45c3f52aad95e935c343ae848916b', '-', 'Unit', 'Unit'),
(77, 13, 42, 'Dian Marthias', 'dian.marthias@ap1.co.id', '21f0fcaa6eb76fc9104a467524f8db3e', '-', 'Manager', 'Unit'),
(78, 13, 42, 'QM Manager', 'bpn.qm@ap1.co.id', 'b0b9954aab06cdac9a9e745add27993b', '-', 'Manager', 'Unit'),
(79, 13, 43, 'Tim Enviro', 'bpn.pe@ap1.co.id', 'b7edec99f66662a0b443d1be74388bb5', '-', 'Unit', 'Unit'),
(80, 13, 43, 'Rio Sitompul', 'rio.sitompul@ap1.co.id', 'bef922cf5f408c9337c91d40d585402f', '-', 'Unit', 'Unit'),
(81, 13, 43, 'Rita', 'rita.pamungkas@ap1.co.id', 'bc1909ca016d87d6b31f40089c16b81e', '-', 'Manager', 'Unit'),
(82, 3, NULL, 'Adi Hartoyo', 'adi.hartoyo@ap1.co.id', '9c1c31854c163e3f04af633f8ed014da', '-', 'Senior Manager', 'Unit'),
(85, 3, 10, 'Farhandhika', 'farhandhika.wijaya@ap1.co.id', '5eef8a49239a75200e179547d9fb50ae', '-', 'Unit', 'Unit'),
(86, 3, 10, 'Rahmat', 'rahmat.santoso@ap1.co.id', '048126de0f193c6e857a825661fb65bd', '-', 'Unit', 'Unit'),
(87, 3, 10, 'Widya ', 'widya.prahasto@ap1.co.id', '8478687705ccc892899d8446ed99c2ec', '-', 'Unit', 'Unit'),
(88, 3, 10, 'Zudan', 'zudan.azmi@ap1.co.id', '05a6e3966547ecb367691a9d30f8a18d', '-', 'Unit', 'Unit'),
(89, 3, 10, 'i putu yoga', 'i.swara@ap1.co.id', '3478d65553be09e6f74c400aea752f16', '-', 'Unit', 'Unit'),
(90, 3, 10, 'anam', 'anam.najibulloh@ap1.co.id', '7a5e2fe387ee14a4927ec36f186be4fd', '-', 'Unit', 'Unit'),
(91, 3, 10, 'abbraham', 'abbraham@ap1.co.id', 'b924ee1ed816b40def7c089715dc1fd4', '-', 'Unit', 'Unit'),
(92, 3, 10, 'indra', 'indra.nugraha@ap1.co.id', 'f0e72466084fc94b2b5202696e2a300a', '-', 'Unit', 'Unit'),
(93, 3, 10, 'Supriyanto', 'supriyanto@ap1.co.id', 'd2368069b268b6830bc79ebe0b0735d4', '-', 'Manager', 'Unit'),
(94, 3, 49, 'Zainal arif', 'zainal.arif@ap1.co.id', '414ac7c338ada8076331cf05289475c2', '-', 'Unit', 'Unit'),
(95, 3, 49, 'nasarudin', 'nasarudin@ap1.co.id', '57164269d31fe3ead0115a614d0728ee', '-', 'Unit', 'Unit'),
(96, 3, 49, 'bayu', 'bayu.yulianto@ap1.co.id', '6a1c16b67961c1b6ea3e024f80d79756', '-', 'Unit', 'Unit'),
(97, 3, 49, 'nurul', 'nurul.hidayat@ap1.co.id', 'a7e51ff09ae5fcca20b15fa6fd9e763a', '-', 'Unit', 'Unit'),
(98, 3, 49, 'dwi', 'dwi.megawaty@ap1.co.id', '021817e61da19a01c067b67749e0a3e3', '-', 'Unit', 'Unit'),
(99, 3, 49, 'akhmad', 'akhmad.abdillah@ap1.co.id', '79b143a71e3d5d3189ad51607c7c2d01', '-', 'Unit', 'Unit'),
(100, 3, 49, 'Deby', 'deby.tiarani@ap1.co.id', '9ac54698ada15f9eec5b55cdaaa96abd', '-', 'Unit', 'Unit'),
(101, 3, 49, 'hendra', 'hendra.kurniawan@ap1.co.id', 'c029bc82be6bb15e165ec719d5f43e18', '-', 'Unit', 'Unit'),
(102, 3, 49, 'novil', 'novil.yandes@ap1.co.id', 'f9505e4a72b42844264d56fc85249177', '-', 'Unit', 'Unit'),
(103, 3, 49, 'mukhammad sujiono', 'mukhammad.sujiono@ap1.co.id', '14ab416846886b9a3d3b9a65f1786572', '-', 'Unit', 'Unit'),
(104, 3, 49, 'dianah', 'dianah.tamimi@ap1.co.id', '4a31baa3d1127a9c4060f8bdf072cf6a', '-', 'Unit', 'Unit'),
(105, 3, 50, 'wira', 'wira.pranata@ap1.co.id', '2b2b680077e5f3441cbe126364cd7315', '-', 'Unit', 'Unit'),
(106, 3, 50, 'rio dharmawan', 'rio.dharmawan@ap1.co.id', 'd1f723a1bc9d9902167cc75b295b9614', '-', 'Unit', 'Unit'),
(107, 3, 50, 'herman', 'herman.prayitno@ap1.co.id', 'c4d89423cad4c7a1faf348bd069db456', '-', 'Manager', 'Unit'),
(108, 5, NULL, 'Muhammad Thamrin', 'muhammad.thamrin@ap1.co.id', 'cd9a0d409a06b9fa767a87adacd6a168', '-', 'Senior Manager', 'Unit'),
(109, 5, 13, 'Lufi', 'lufi.avianti@ap1.co.id', '1762b68f8c70d908f7e301705ab6eece', '-', 'Unit', 'Unit'),
(110, 5, 13, 'Agus A', 'agus.ariansjah@ap1.co.id', '1a15e9c7b4b2bf85148be570db775815', '-', 'Manager', 'Unit'),
(111, 5, 14, 'Isniah', 'isniah.mujiati@ap1.co.id', '73e6f85dfcac528cfaa7562797d902cf', '-', 'Unit', 'Unit'),
(112, 5, 14, 'Haikal', 'haikal.gumilang@ap1.co.id', '67300dc8de24000e3bdd8a6d2f5f8936', '-', 'Manager', 'Unit'),
(113, 7, 21, 'Farikh', 'farikh.zulhuda@ap1.co.id', 'd913d634f4b9243ef7da7371343606b1', '-', 'Unit', 'Unit'),
(114, 7, 21, 'Agung', 'agung.ardiansyah@ap1.co.id', 'f32886880513abf1345db21bed5711b1', '-', 'Manager', 'Unit'),
(115, 7, 22, 'nareswari', 'nareswari.nestiti@ap1.co.id', 'b1d0cbb9567a235722fecf50dab5b7e2', '-', 'Unit', 'Unit'),
(116, 7, 22, 'Cipto', 'cipto.murti@ap1.co.id', 'a2376c36f6742b523a076ff04117e96d', '-', 'Manager', 'Unit'),
(117, 7, 39, 'Yusti', 'yusti.kartika@ap1.co.id', '436399104e146fc550816e4068f28e66', '-', 'Unit', 'Unit'),
(118, 7, 39, 'Votia', 'votia.andra@ap1.co.id', '31cdb6efc194a28022ea93a65e5cba2e', '-', 'Manager', 'Unit'),
(119, 7, 51, 'Tim General Services', 'bpn.sg@ap1.co.id', 'da78265581e839c5c1299e4a42fbd5f7', '-', 'Unit', 'Unit'),
(120, 7, 51, 'mustajab', 'mustajab.murdiyanto@ap1.co.id', '48ce76d957f7187445723734054661bb', '-', 'Manager', 'Unit'),
(121, 7, 51, 'mustajab 2', 'mohammad.murdiyanto@ap1.co.id', '7f7a4ffb50f9588caa0769db8d073f70', '-', 'Manager', 'Unit'),
(122, 7, NULL, 'IB Ketut Juliadnyana', 'i.juliadnyana@ap1.co.id', '696a8e05320055add6f54d675639a53f', '-', 'Senior Manager', 'Unit'),
(123, 17, 58, 'Geraldy', 'geraldy.pranata@ap1.co.id', '79995fa71b695bdd216d3f1f767e0ef2', '-', 'Unit', 'Unit'),
(124, 17, 58, 'Retnowati', 'retnowati92@ap1.co.id', '41740e420014f38e69c6426c0613c2ad', '-', 'Manager', 'Unit'),
(125, 19, 60, 'Hilda Y.N', 'hilda.nikmah@ap1.co.id', 'bb0e1064c33a34094d1ab973a1b34446', '-', 'Unit', 'Unit'),
(126, 19, 60, 'Dian P', 'dian.sari@ap1.co.id', '84182fc5ac97954d463118c7b9e702ec', '-', 'Manager', 'Unit'),
(131, 16, 57, 'Super Admin Customer Service Operational', 'serviceimprovementbpn@gmail.com', '07767c3a314b55eb2734bb6b7903829b', '-', 'Unit', 'Super Admin'),
(132, 3, 9, 'CS Super Admin', '11181061@student.itk.ac.id', 'daa6b8d04ce72d953d5501adc53ddd82', '-', 'Unit', 'Super Admin'),
(133, 30, NULL, 'SM Service Test', 'servicetestsm@gmail.com', '29a1e014618b5c2b9492f175da62772d', '081249907496', 'Senior Manager', 'Unit'),
(135, NULL, NULL, 'GM Pengawas', 'gmbpn_pengawas@gmail.com', '05fd6f27e43d7facede68e940cc448de', '-', 'General Manager', 'Pengawas Internal'),
(136, 3, 9, 'Raihan', 'kukurokabuto@gmail.com', '2518b93f61ac5d96eb1944ea465ae3b6', '0808', 'Unit', 'Admin1'),
(137, 3, 61, 'Raihanr090', 'raihanr090@gmail.com', 'daa6b8d04ce72d953d5501adc53ddd82', '123', 'Manager', 'Pengawas Internal'),
(138, 30, NULL, 'Raihan', 'berkahberlimpahsmd@gmail.com', '4195d7770ef2b14a5dd1c5c2b5fbbe96', '123123', 'Senior Manager', 'Pengawas Internal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_perusahaan` varchar(200) DEFAULT NULL,
  `gerai` varchar(200) DEFAULT NULL,
  `nama` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `masa_berlaku` date NOT NULL,
  `kontrak` date DEFAULT NULL,
  `id_pass_bandara` varchar(30) NOT NULL,
  `pass_bandara` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `tanggal_pembuatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `nama_perusahaan`, `gerai`, `nama`, `email`, `no_telp`, `password`, `status`, `masa_berlaku`, `kontrak`, `id_pass_bandara`, `pass_bandara`, `foto`, `tanggal_pembuatan`) VALUES
(67, 're', 're', 're', 'rege@gmail.com', '63', '12eccbdd9b32918131341f38907cbbb5', 2, '2021-06-17', NULL, '32', '67.jpeg', '67.jpeg', NULL),
(100, 'de', 'de', 'de', 'dede@gmail.com', '858585', 'b4be1c568a6dc02dcaf2849852bdb13e', 1, '2022-09-29', NULL, '', '100.jpeg', NULL, NULL),
(104, 'Yosan', 'Balikpapan', 'Yosan', 'raihanrahman@re-beat.xyz', '555', '137bf89f73807f094fbba5ff97385077', 1, '2021-11-23', NULL, '2020', '104.jpeg', '104.jpeg', NULL),
(105, 'Perusahaan', 'Balikpapan', 'lolo', 'lolo@gmail.com', '082323232', 'd6581d542c7eaf801284f084478b5fcc', 1, '2022-09-09', NULL, '', '105.jpg', '105.jpg', NULL),
(106, 'nama Perusahaan', 'Nama gerai', 'perdana', 'dnperdana18@gmail.com', '882323232', '9ac807dbc2df694054e4bcab80405b3c', 1, '2021-09-29', NULL, '', '106.jpg', '106.jpg', NULL),
(116, 'hacker', 'hacker', 'riahan', 'hackerouroboros39@gmail.com', '0909', 'daa6b8d04ce72d953d5501adc53ddd82', 1, '9999-02-09', '9999-02-09', '1234', '116.png', '116.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id_departemen` int(11) NOT NULL,
  `Departemen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_departemen`
--

INSERT INTO `tb_departemen` (`id_departemen`, `Departemen`) VALUES
(3, 'Technical'),
(5, 'Commercial'),
(7, 'Administration'),
(13, 'Airport Planning, SHE, QM'),
(16, 'Airport Operation, Services & Security'),
(17, 'Stakeholder Relation'),
(18, 'Airport Operation Center Head'),
(19, 'Legal and Compliance'),
(30, 'Service Test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_forgot_password`
--

CREATE TABLE `tb_forgot_password` (
  `id` int(5) NOT NULL,
  `token` varchar(6) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status_akun` varchar(8) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keterangan_tambahan`
--

CREATE TABLE `tb_keterangan_tambahan` (
  `id_keterangan` int(12) NOT NULL,
  `id_aduan` int(12) DEFAULT NULL,
  `id_akun` int(11) NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `bukti` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keterangan_tambahan`
--

INSERT INTO `tb_keterangan_tambahan` (`id_keterangan`, `id_aduan`, `id_akun`, `pertanyaan`, `jawaban`, `link`, `bukti`) VALUES
(58, 5, 136, 'Isikan data waktunya', 'Pada hari senin yang lalu', '66f041e16a60928b05a7e228a89c3799', '58.png'),
(59, 8, 132, 'ini keterangan', 'ini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja dehini jawab aja deh', '093f65e080a295f8076b1c5722a46aa2', NULL),
(60, 8, 132, 'ini harus pakai gambar', 'ini kuisi pakai gambar', '072b030ba126b2f4b2374f342be9ed44', '60.png'),
(61, 15, 132, 'Mohon menambahkan foto yangkursi oleh Raihan', NULL, '7f39f8317fbdb1988ef4c628eba02591', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(3) NOT NULL,
  `nama_lokasi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(2, 'Gedung parkir terminal'),
(7, 'Terminal Keberangkatan'),
(8, 'Toll Gate'),
(9, 'Terminal Kedatangan'),
(10, 'Mezanine Lantai 2'),
(11, 'Area Transit '),
(12, 'Avio'),
(13, 'Gedung Terminal Lama'),
(14, 'Gedung Operasional'),
(15, 'Hanggar'),
(16, 'Ruang Tunggu Dept'),
(17, 'Drop & Pickup Zone'),
(18, 'Perkantoran AP1'),
(19, 'Gedung Parkir Terminal La'),
(20, 'Gedung Parkir Terminal La'),
(21, 'Gedung Parkir Terminal La'),
(22, 'Gedung Parkir Terminal La'),
(23, 'Gedung Parkir Terminal La'),
(24, 'Lobby Keberangkatan Timur'),
(25, 'Lobby Keberangkatan Barat'),
(26, 'Keberangkatan Lantai 4'),
(27, 'Public Area Tengah'),
(28, 'Counter Check in A '),
(29, 'Counter Check in B'),
(30, 'Counter Check in C'),
(31, 'Counter Check in D'),
(32, 'Public Area Timur'),
(33, 'Public Area Barat'),
(34, 'Toll Gate Masuk terminal'),
(35, 'Toll Gate Keluar terminal'),
(36, 'Toll Gate Masuk kantor'),
(37, 'Toll Gate Keluar kantor'),
(38, 'Lobby Luar KedatanganTimu'),
(39, 'Lobby Luar Kedatangan Bar'),
(40, 'Baggage Claim Timur'),
(41, 'Baggage Claim Barat'),
(42, 'Kedatangan sisi timur'),
(43, 'Kedatangan sisi barat'),
(44, 'Mall Kedatangan'),
(45, 'Mezanine Lantai 2 Timur'),
(46, 'Mezanine Lantai 2 Barat'),
(47, 'Transit timur'),
(48, 'Transit barat'),
(49, 'Selasar Avio'),
(50, 'Avio 1'),
(51, 'Avio 2'),
(52, 'Avio 3'),
(53, 'Avio 4'),
(54, 'Avio 5'),
(55, 'Avio 6'),
(56, 'Avio 7'),
(57, 'Avio 8'),
(58, 'Avio 9'),
(59, 'Avio 10'),
(60, 'Avio 11'),
(61, 'Terminal Lama Timur Bawah'),
(62, 'Terminal Lama Barat Bawah'),
(63, 'Terminal Lama Lantai atas'),
(64, 'Gedung Ops PK Lama'),
(65, 'Gedung Ops PK Baru'),
(66, 'Posko Perimeter'),
(67, 'Gedung ASB'),
(68, 'SUB AMC'),
(69, 'Gedung Empu'),
(70, 'EOC'),
(71, 'Terminal Kargo'),
(72, 'Hanggar C Lantai 1'),
(73, 'Hanggar C Lantai 2'),
(74, 'Hanggar D Lantai 1'),
(75, 'Hanggar D Lantai 2'),
(76, 'Ruang Tunggu Gate 1'),
(77, 'Ruang Tunggu Gate 2'),
(78, 'Ruang Tunggu Gate 3'),
(79, 'Ruang Tunggu Gate 4'),
(80, 'Ruang Tunggu Gate 5'),
(81, 'Ruang Tunggu Gate 6'),
(82, 'Ruang Tunggu Gate 7'),
(83, 'Ruang Tunggu Gate 8'),
(84, 'Ruang Tunggu Gate 9'),
(85, 'Ruang Tunggu Gate 10'),
(86, 'Ruang Tunggu Gate 11'),
(87, 'Are Drop zone'),
(88, 'Area Pick Up Zone'),
(89, 'Halaman Kantor AP1'),
(90, 'Kantor AP I Lantai 1'),
(91, 'Kantor AP I Lantai 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_notif`
--

CREATE TABLE `tb_notif` (
  `email` varchar(30) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_aduan` int(11) NOT NULL,
  `penilaian` int(1) NOT NULL,
  `ulasan` varchar(200) NOT NULL,
  `open` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_aduan`, `penilaian`, `ulasan`, `open`) VALUES
(4, 5, 'Bagus kok', 1),
(5, 5, 'Keren, cepat sekali', 1),
(22, 3, 'Lambat', 1),
(23, 5, 'ini selesai', 1),
(24, 4, 'Sangat keren', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`) VALUES
(123, '13'),
(11181060, 'Yoi Akuakultur'),
(11181061, 'Yoi Akuakultur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_progress`
--

CREATE TABLE `tb_progress` (
  `id_progress` int(12) NOT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `id_aduan` int(12) DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_progress`
--

INSERT INTO `tb_progress` (`id_progress`, `id_akun`, `id_aduan`, `tindakan`, `bukti`, `waktu`) VALUES
(279, 132, 2, 'Diteruskan ke unit', NULL, '2021-04-18 17:27:42'),
(281, 132, 2, 'Feedback direspons oleh unit dengan keterangan Ini progressnya', NULL, '2021-04-18 17:28:49'),
(282, 132, 2, 'Feedback direspons oleh unit dengan keterangan jadi progres', NULL, '2021-04-18 17:29:19'),
(283, 132, 2, 'Feedback direspons oleh unit dengan keterangan ini sudah diperbaiki', NULL, '2021-04-18 17:31:48'),
(284, 132, 2, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan Ini sudah seelsai', NULL, '2021-04-18 17:32:23'),
(285, 132, 2, 'Closed', NULL, '2021-04-18 17:32:37'),
(287, 132, 3, 'Diteruskan ke unit', NULL, '2021-04-27 12:42:16'),
(288, 137, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini perlu gambar', NULL, '2021-04-27 12:44:01'),
(289, 137, 3, 'Feedback direspons oleh unit dengan keterangan t', NULL, '2021-04-27 12:52:28'),
(290, 137, 3, 'Feedback direspons oleh unit dengan keterangan adafsd', NULL, '2021-04-27 12:52:41'),
(291, 137, 3, 'Feedback direspons oleh unit dengan keterangan adsfadfasf', NULL, '2021-04-27 12:53:01'),
(292, 137, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini tindkan', NULL, '2021-04-27 13:23:18'),
(293, 137, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan my venom', NULL, '2021-04-27 13:23:41'),
(294, 137, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan zombie apocalypse', '294.png', '2021-04-27 13:26:58'),
(295, 137, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan selesai', '295.jpeg', '2021-04-27 13:27:49'),
(310, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:17:10'),
(311, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:17:30'),
(312, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:17:45'),
(313, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:17:54'),
(314, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:18:05'),
(315, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:18:55'),
(316, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:19:12'),
(317, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:19:16'),
(318, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:19:36'),
(319, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:20:23'),
(320, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:20:26'),
(321, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:20:28'),
(322, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:21:37'),
(323, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:21:43'),
(324, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:22:28'),
(325, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:22:38'),
(326, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:27:21'),
(327, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:27:35'),
(328, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:01'),
(329, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:17'),
(330, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:28'),
(331, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:29'),
(332, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:40'),
(333, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:28:56'),
(334, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:29:19'),
(335, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:30:12'),
(336, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:30:22'),
(337, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:30:37'),
(338, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 10:31:40'),
(339, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, dede', NULL, '2021-04-28 10:36:11'),
(344, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, fdata', NULL, '2021-04-28 16:14:44'),
(345, 132, 3, 'Diteruskan ke unit', NULL, '2021-04-28 16:15:08'),
(346, 132, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini selesai', '346.jpg', '2021-04-28 16:17:36'),
(347, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan ini belum sesuai', NULL, '2021-04-28 16:17:57'),
(348, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, de', NULL, '2021-04-28 16:21:17'),
(349, 132, 3, 'Diteruskan ke unit', NULL, '2021-04-28 16:23:20'),
(350, 132, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan kita complete', '350.png', '2021-04-28 16:24:31'),
(351, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan dede', NULL, '2021-04-28 16:24:48'),
(352, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, de', NULL, '2021-04-28 16:25:41'),
(353, 132, 3, 'Diteruskan ke unit', NULL, '2021-04-28 16:25:53'),
(354, 132, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini selesai', '354.jpg', '2021-04-28 16:31:44'),
(355, 132, 3, 'Dikembalikan ke unit teknis dengan keterangan kembali', NULL, '2021-04-28 16:32:02'),
(358, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, deh', NULL, '2021-04-28 16:48:02'),
(359, 132, 3, 'Diteruskan ke unit', NULL, '2021-04-28 16:48:43'),
(360, 136, 5, 'Diteruskan ke unit', NULL, '2021-04-29 12:06:42'),
(361, 136, 5, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, Minta data waktu', NULL, '2021-04-29 12:07:33'),
(362, 136, 5, 'Diteruskan ke unit', NULL, '2021-04-29 12:10:31'),
(363, 136, 5, 'Feedback direspons oleh unit dengan keterangan ini baru progres', NULL, '2021-04-29 12:11:54'),
(364, 136, 5, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini tindakan selesai adfasfasdfasdfasdfasdfadafasdfadsfasdfasdfasfads', '364.png', '2021-04-29 12:12:53'),
(365, 137, 5, 'Dikembalikan ke unit teknis dengan keterangan ini belum selesai', NULL, '2021-04-29 12:14:06'),
(366, 137, 5, 'Closed', NULL, '2021-04-29 12:14:47'),
(367, 132, 3, 'Feedback direspons oleh unit dengan keterangan de', '367.jpg', '2021-05-10 13:03:44'),
(373, 132, 1, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, dede', NULL, '2021-05-20 23:06:11'),
(374, 132, 1, 'Diteruskan ke unit Airport Facilities', NULL, '2021-05-20 23:14:13'),
(375, 132, 3, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini selesai', '375.png', '2021-05-26 20:17:40'),
(376, 132, 3, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, deded', NULL, '2021-05-26 20:19:59'),
(377, 132, 3, 'Diteruskan ke unit Airport Facilities', NULL, '2021-05-26 20:20:42'),
(378, 132, 8, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-01 11:04:35'),
(379, 132, 8, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini progres baru', '379.jpg', '2021-06-03 15:31:48'),
(380, 132, 8, 'Feedback direspons oleh unit dengan keterangan ada tindakan baru lagi', NULL, '2021-06-03 15:36:28'),
(381, 132, 8, 'Feedback direspons oleh unit dengan keterangan ini progres', NULL, '2021-06-03 16:00:50'),
(382, 132, 8, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini selesai', '382.jpg', '2021-06-03 16:12:23'),
(383, 132, 8, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan pakai foto', '383.png', '2021-06-03 16:14:34'),
(384, 132, 8, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, de', NULL, '2021-06-03 18:58:22'),
(385, 132, 8, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, de', NULL, '2021-06-03 19:08:22'),
(386, 132, 8, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, de', NULL, '2021-06-03 19:09:02'),
(387, 132, 8, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-03 19:09:44'),
(388, 132, 6, '', NULL, '2021-06-07 13:14:53'),
(390, 132, 7, 'Dikembalikan ke cs dengan keterangan Bukan Tanggung Jawab Unit Saya, tanggung jawab unit sebelah', NULL, '2021-06-07 13:16:40'),
(391, 132, 7, 'Diteruskan ke unit , ', NULL, '2021-06-07 13:16:56'),
(392, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, 1', NULL, '2021-06-07 13:17:52'),
(393, 132, 7, 'Diteruskan ke unit , ', NULL, '2021-06-07 13:18:22'),
(394, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, 123', NULL, '2021-06-07 13:21:52'),
(395, 132, 7, 'Diteruskan ke unit Airport Facilities, ', NULL, '2021-06-07 13:22:28'),
(396, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, ll', NULL, '2021-06-07 13:22:46'),
(397, 132, 7, 'Diteruskan ke unit Airport Facilities, ', NULL, '2021-06-07 13:23:04'),
(398, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, 123', NULL, '2021-06-07 13:23:37'),
(399, 132, 7, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-07 13:23:51'),
(400, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, 123', NULL, '2021-06-07 13:24:25'),
(401, 132, 7, 'Diteruskan ke unit Airport Facilities, ini diperbaiki', NULL, '2021-06-07 13:24:47'),
(402, 132, 7, 'Feedback direspons oleh unit dengan keterangan ini progres', '402.png', '2021-06-07 13:25:12'),
(403, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, dede', NULL, '2021-06-07 13:28:11'),
(404, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:18'),
(405, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:25'),
(406, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:30'),
(407, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:35'),
(408, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:41'),
(409, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:46'),
(410, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:52'),
(411, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:16:58'),
(412, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:17:04'),
(413, 132, 8, 'Feedback direspons oleh unit dengan keterangan ce', NULL, '2021-06-12 01:17:35'),
(414, 132, 8, 'Feedback direspons oleh unit dengan keterangan de', NULL, '2021-06-12 01:21:32'),
(415, 132, 8, 'Feedback direspons oleh unit dengan keterangan dede', NULL, '2021-06-12 01:23:01'),
(416, 132, 8, 'Feedback direspons oleh unit dengan keterangan dede', NULL, '2021-06-12 01:23:58'),
(417, 132, 8, 'Feedback direspons oleh unit dengan keterangan Ini proses dengan loading', NULL, '2021-06-12 01:24:46'),
(418, 132, 8, 'Feedback direspons oleh unit dengan keterangan In dengan loading', NULL, '2021-06-12 01:25:32'),
(419, 132, 8, 'Feedback direspons oleh unit dengan keterangan dede', NULL, '2021-06-12 01:25:49'),
(420, 132, 16, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-13 16:32:56'),
(421, 132, 7, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-13 21:39:04'),
(422, 132, 7, 'Dikembalikan ke cs dengan keterangan Unit kekurangan data, Tambahkan data percobaan', NULL, '2021-06-13 21:39:28'),
(423, 132, 19, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-14 10:28:49'),
(424, 132, 7, 'Diteruskan ke unit Airport Equipment (Mechanical)', NULL, '2021-06-14 12:37:15'),
(425, 132, 14, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-15 16:40:38'),
(426, 132, 24, 'Diteruskan ke unit Airport Facilities', NULL, '2021-06-16 06:20:44'),
(427, 132, 24, 'Closed', NULL, '2021-06-16 13:08:26'),
(428, 132, 23, 'Diteruskan ke unit Percobaan', NULL, '2021-06-16 13:10:27'),
(429, 132, 23, 'Feedback direspons oleh unit dengan keterangan ini tindakan', NULL, '2021-06-16 13:10:41'),
(430, 132, 23, 'Closed', NULL, '2021-06-16 13:12:46'),
(431, 132, 22, 'Diteruskan ke unit TES 1', NULL, '2021-06-16 13:15:06'),
(432, 132, 22, 'Closed', NULL, '2021-06-16 13:15:24'),
(433, 132, 1, 'Closed', NULL, '2021-06-30 08:53:03'),
(434, 132, 3, 'Closed', NULL, '2021-06-30 08:53:13'),
(435, 132, 6, 'Closed oleh raihan', NULL, '2021-06-30 09:01:04'),
(436, 132, 7, 'Closed oleh Raihan', NULL, '2021-06-30 09:02:08'),
(437, NULL, 28, 'Feedback dikirim oleh Mitra', NULL, '2021-06-30 09:07:45'),
(438, 132, 14, 'Feedback telah selesai ditindaklanjuti oleh unit dengan keterangan ini complete', '438.png', '2021-07-01 09:43:07'),
(439, 132, 14, 'Dikembalikan ke unit teknis dengan keterangan Ini belum selesai, oleh Raihan', NULL, '2021-07-01 09:45:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token`
--

CREATE TABLE `tb_token` (
  `status` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `nama_unit` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `id_departemen`, `nama_unit`) VALUES
(1, NULL, 'Airside'),
(2, NULL, 'Lanside & Terminal'),
(3, NULL, 'Rescue & Fire Fighting'),
(4, NULL, 'Customer Service'),
(6, NULL, 'Airport Security Screening'),
(7, NULL, 'Airport Security Protection '),
(9, 3, 'Airport Facilities'),
(10, 3, 'Airport Equipment (Mechanical)'),
(11, NULL, 'Mechanical'),
(12, NULL, 'Electrical'),
(13, 5, 'Airport Aeronautical'),
(14, 5, 'Airport Non Aeronautical'),
(18, NULL, 'Application Operation & Support'),
(19, NULL, 'Network OPS & Support'),
(21, 7, 'Finance'),
(22, 7, 'Accounting'),
(23, NULL, 'Non Cluster'),
(24, NULL, 'Cluster'),
(25, NULL, 'Human Capital'),
(26, NULL, 'General Service'),
(27, NULL, 'Aset Management'),
(28, NULL, 'Corporate Social Responsibility'),
(29, NULL, 'SMS & Occupational Safety Health'),
(30, NULL, 'Quality Management'),
(31, NULL, 'Risk Management'),
(36, NULL, 'Properti'),
(37, NULL, 'properti'),
(39, 7, 'Human Capital Business Partner'),
(41, 13, 'Airport Planning,Quality & Risk Management'),
(42, 13, 'Safety Health'),
(43, 13, 'Airport Environment'),
(49, 3, 'Airport Equipment (Listrik)'),
(50, 3, 'Airport Technology'),
(51, 7, 'General Services'),
(52, 16, 'Airport Operation Landside & Terminal'),
(53, 16, 'Airport Operation Air Side'),
(54, 16, 'Airport Rescue & Fire Fighting'),
(55, 16, 'Airport Security Screening'),
(56, 16, 'Airport Security Protection'),
(57, 16, 'Airport Services Improvement'),
(58, 17, 'Stakeholder Relation'),
(59, 18, 'Airport Operation Center Head'),
(60, 19, 'Legal and Compliance'),
(61, 30, 'TES 1'),
(62, 3, 'Percobaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_urgensi`
--

CREATE TABLE `tb_urgensi` (
  `id_urgensi` int(5) NOT NULL,
  `perihal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_urgensi`
--

INSERT INTO `tb_urgensi` (`id_urgensi`, `perihal`) VALUES
(1, 'Konsleting Listrik'),
(2, 'Plafon runtuh'),
(5, 'Bau Bangkai Hewan'),
(7, 'Jaringan Internet/Telepon Mati'),
(8, 'Kebocoran Pipa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`id_aduan`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_departemen` (`id_unit`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`Id_akun`),
  ADD KEY `Id_Departemen` (`id_unit`),
  ADD KEY `id_departemen_2` (`id_departemen`);

--
-- Indeks untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id_departemen`),
  ADD UNIQUE KEY `Hak_Akses` (`id_departemen`);

--
-- Indeks untuk tabel `tb_forgot_password`
--
ALTER TABLE `tb_forgot_password`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indeks untuk tabel `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  ADD PRIMARY KEY (`id_keterangan`),
  ADD KEY `id_aduan` (`id_aduan`);

--
-- Indeks untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_aduan`);

--
-- Indeks untuk tabel `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `tb_progress`
--
ALTER TABLE `tb_progress`
  ADD PRIMARY KEY (`id_progress`),
  ADD KEY `id_aduan` (`id_aduan`);

--
-- Indeks untuk tabel `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`token`);

--
-- Indeks untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indeks untuk tabel `tb_urgensi`
--
ALTER TABLE `tb_urgensi`
  ADD PRIMARY KEY (`id_urgensi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_aduan`
--
ALTER TABLE `tb_aduan`
  MODIFY `id_aduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `Id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_forgot_password`
--
ALTER TABLE `tb_forgot_password`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  MODIFY `id_keterangan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11181062;

--
-- AUTO_INCREMENT untuk tabel `tb_progress`
--
ALTER TABLE `tb_progress`
  MODIFY `id_progress` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `tb_urgensi`
--
ALTER TABLE `tb_urgensi`
  MODIFY `id_urgensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD CONSTRAINT `tb_aduan_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`Id_akun`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD CONSTRAINT `tb_akun_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit` (`id_unit`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_akun_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `tb_departemen` (`id_departemen`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_keterangan_tambahan`
--
ALTER TABLE `tb_keterangan_tambahan`
  ADD CONSTRAINT `tb_keterangan_tambahan_ibfk_1` FOREIGN KEY (`id_aduan`) REFERENCES `tb_aduan` (`id_aduan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_progress`
--
ALTER TABLE `tb_progress`
  ADD CONSTRAINT `tb_progress_ibfk_1` FOREIGN KEY (`id_aduan`) REFERENCES `tb_aduan` (`id_aduan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD CONSTRAINT `tb_unit_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `tb_departemen` (`id_departemen`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
