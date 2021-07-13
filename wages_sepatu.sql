-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 06:24 AM
-- Server version: 10.3.16-MariaDB
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
-- Database: `wages_sepatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `kode_akun` int(11) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `c_d` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `kode_akun`, `nama_akun`, `c_d`) VALUES
(1, 1, 'Aktiva', 'd'),
(2, 2, 'Kewajiban', 'c'),
(3, 3, 'Modal', 'c'),
(4, 4, 'Pendapatan', 'c'),
(5, 5, 'Beban', 'd'),
(11, 11, 'Aktiva Lancar', 'd'),
(12, 12, 'Aktiva Tetap', 'd'),
(21, 21, 'Kewajiban Lancar', 'c'),
(22, 22, 'Kewajiban Jangka Panjang', 'c'),
(31, 31, 'Modal Pemilik', 'c'),
(41, 41, 'Pendapatan Operasional', 'c'),
(42, 42, 'Pendapatan Non Operasional', 'c'),
(51, 51, 'Beban Operasional', 'd'),
(52, 52, 'Beban Non Operasioanl', 'd'),
(111, 111, 'Kas', 'd'),
(112, 112, 'Persediaan Barang Dagang', 'd'),
(411, 411, 'Penjualan', 'c'),
(412, 412, 'Harga Pokok Penjualan', 'c'),
(511, 511, 'Beban Administrasi dan Umum', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `harga_jual` varchar(30) DEFAULT NULL,
  `harga_sales` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `barcode`, `nama_barang`, `id_kategori`, `id_satuan`, `harga_jual`, `harga_sales`, `stok`, `is_active`) VALUES
(75, 'BRG-00001', '5677885463715', 'Ajax Career Shoes', 14, 19, '309000', 300000, 99, 1),
(76, 'BRG-00002', '5677885463722', 'Pierro Career Shoes', 14, 19, '309000', 300000, 98, 1),
(77, 'BRG-00003', '5677885463739', 'Christophe Career Shoes', 14, 19, '309000', 300000, 100, 1),
(78, 'BRG-00004', '5677885463746', 'Two Tone Pumps', 15, 19, '219000', 210000, 96, 1),
(79, 'BRG-00005', '5677885463753', 'Eliza woman Oxford Heels', 15, 19, '219000', 210000, 100, 1),
(80, 'BRG-00006', '-', 'rrrr', 14, 19, '66666', 0, 0, 0),
(81, 'BRG-00007', '678893657893', 'Nike Jordan acural', 17, 19, '510000', 490000, 0, 0),
(82, 'BRG-00008', '8992761002015', 'coca cola', 14, 19, '6000', 5000, 0, 0),
(83, 'BRG-00009', '5677885463760', 'Pippi Suede Pumps', 15, 19, '219000', 210000, 100, 1),
(84, 'BRG-00010', '5677885463777', 'Vans', 16, 19, '299000', 290000, 108, 1),
(85, 'BRG-00011', '5677885463784', 'Vrona Slip On Shoes', 16, 19, '299000', 290000, 100, 1),
(86, 'BRG-00012', '5677885463791', 'Phillip Deck Shoes', 16, 19, '299000', 290000, 100, 1),
(87, 'BRG-00013', '-', 'Dark Brown Shoes', 16, 19, '299000', 290000, 100, 1),
(88, 'BRG-00014', '-', 'Zoom Stefan Sneaker Shoe', 17, 19, '579000', 570000, 110, 1),
(89, 'BRG-00015', '-', 'Odraslih Leather Shoes', 17, 19, '399000', 390000, 100, 1),
(90, 'BRG-00016', '-', 'Sleezy Shoes', 17, 19, '449000', 440000, 110, 1),
(91, 'BRG-00017', '-', 'Eastham Mens Sneaker Shoe', 17, 19, '599000', 590000, 100, 1),
(92, 'BRG-00018', '-', 'Holy Spike Wedges', 18, 19, '503100', 494100, 100, 1),
(93, 'BRG-00019', '-', 'Milou Women Wedges Shoes', 18, 19, '199000', 190000, 100, 1),
(94, 'BRG-00020', '-', 'Joseph Ballaci Wedges', 18, 19, '503100', 494100, 100, 1),
(95, 'BRG-00021', '-', 'apa aja', 13, 19, '100000', 90000, 0, 0),
(96, 'BRG-00022', '-', 'nike mercurial', 17, 19, '299000', 290000, 100, 0),
(97, 'BRG-00023', '-', 'nike jordan', 17, 19, '399000', 390000, 100, 0),
(98, 'BRG-00024', '-', 'nike bnb', 14, 19, '12.000', 13, 0, 0),
(99, 'BRG-00025', '-', 'aja', 14, 19, '', 0, 0, 0),
(100, 'BRG-00026', '-', 'Nike mercurial', 17, 19, '399000', 390000, 100, 0),
(101, 'BRG-00027', '5667879765611', 'nike mercurial', 17, 19, '399000', 390000, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cs` int(11) NOT NULL,
  `kode_cs` varchar(20) DEFAULT NULL,
  `nama_cs` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `jenis_cs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cs`, `kode_cs`, `nama_cs`, `jenis_kelamin`, `telp`, `email`, `alamat`, `jenis_cs`) VALUES
(17, 'CS-000001', 'Umum', 'Laki-Laki', 'umum', 'umum', 'umum', 'Umum'),
(18, 'CS-000002', 'Reseller', 'Laki-Laki', 'Reseller', 'Reseller', 'Reseller', 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `detil_penjualan`
--

CREATE TABLE `detil_penjualan` (
  `id_detil_jual` bigint(20) NOT NULL,
  `id_jual` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_detil_jual` varchar(20) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `harga_item` int(11) DEFAULT NULL,
  `qty_jual` int(11) DEFAULT NULL,
  `subtotal` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_penjualan`
--

INSERT INTO `detil_penjualan` (`id_detil_jual`, `id_jual`, `id_barang`, `kode_detil_jual`, `diskon`, `harga_item`, `qty_jual`, `subtotal`) VALUES
(99, 191, 79, 'DJ-0000001', 0, 219000, 1, '219000'),
(110, 192, 79, 'DJ-0000002', 0, 219000, 2, '438000'),
(111, 193, 79, 'DJ-0000003', 0, 219000, 1, '219000'),
(112, 194, 79, 'DJ-0000004', 0, 219000, 1, '219000'),
(113, 195, 77, 'DJ-0000005', 0, 309000, 1, '309000'),
(114, 195, 77, 'DJ-0000006', 0, 309000, 1, '309000'),
(115, 196, 79, 'DJ-0000007', 0, 219000, 1, '219000'),
(116, 197, 78, 'DJ-0000008', 0, 219000, 4, '876000'),
(119, 199, 78, 'DJ-0000009', 0, 219000, 2, '438000'),
(120, 200, 78, 'DJ-0000010', 0, 219000, 2, '438000'),
(128, 201, 76, 'DJ-0000011', 0, 309000, 1, '309000'),
(129, 202, 76, 'DJ-0000012', 0, 309000, 1, '309000'),
(130, 203, 84, 'DJ-0000013', 0, 299000, 2, '598000');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id` int(11) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nominal` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(13, 'Flat'),
(14, 'Formal'),
(15, 'Heels'),
(16, 'Slip On'),
(17, 'Sneakers'),
(18, 'Wedges');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_jual` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_cs` int(11) DEFAULT NULL,
  `kode_jual` varchar(20) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `method` varchar(30) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_jual`, `id_user`, `id_cs`, `kode_jual`, `invoice`, `method`, `bayar`, `kembali`, `tgl`) VALUES
(170, 1, 17, 'KJ-0000001', 'POS20201223192059', 'Cash', 700000, 82000, '2020-12-23 19:21:00'),
(171, 1, 17, 'KJ-0000002', 'POS20201223192105', 'Cash', 700000, 82000, '2020-12-23 19:21:05'),
(172, 1, 18, 'KJ-0000003', 'POS20201223192217', 'Cash', 20000000, 7740000, '2020-12-23 19:22:17'),
(173, 1, 18, 'KJ-0000004', 'POS20201223192243', 'Cash', 20000000, 7740000, '2020-12-23 19:22:43'),
(174, 1, 17, 'KJ-0000005', 'POS20201223192318', 'Cash', 300000, 81000, '2020-12-23 19:23:18'),
(175, 1, 17, 'KJ-0000006', 'POS20201223192323', 'Cash', 300000, 81000, '2020-12-23 19:23:23'),
(176, 3, 17, 'KJ-0000007', 'POS20201224223728', 'Cash', 500000, 191000, '2020-12-24 22:37:28'),
(177, 3, 17, 'KJ-0000008', 'POS20201224223740', 'Cash', 500000, 191000, '2020-12-24 22:37:40'),
(178, 3, 17, 'KJ-0000009', 'POS20201224224250', 'Cash', 1000000, 31600, '2020-12-24 22:42:50'),
(179, 3, 17, 'KJ-0000010', 'POS20201224224253', 'Cash', 1000000, 31600, '2020-12-24 22:42:53'),
(180, 3, 17, 'KJ-0000011', 'SPT20201224224428', 'Cash', 300000, 81000, '2020-12-24 22:44:28'),
(181, 3, 17, 'KJ-0000012', 'SPT20201224224440', 'Cash', 300000, 81000, '2020-12-24 22:44:40'),
(182, 3, 17, 'KJ-0000013', 'SPT20201224224727', 'Cash', 300000, 81000, '2020-12-24 22:47:27'),
(183, 3, 17, 'KJ-0000014', 'SPT20201224224742', 'Cash', 300000, 81000, '2020-12-24 22:47:42'),
(184, 3, 17, 'KJ-0000015', 'SPT20201224225546', 'Cash', 400000, 91000, '2020-12-24 22:55:46'),
(185, 3, 17, 'KJ-0000016', 'SPT20201224225552', 'Cash', 400000, 91000, '2020-12-24 22:55:52'),
(186, 3, 17, 'KJ-0000017', 'SPT20201224230419', 'Cash', 4000000, 2455000, '2020-12-24 23:04:19'),
(187, 3, 18, 'KJ-0000018', 'SPT20201224230621', 'Cash', 7000000, 730000, '2020-12-24 23:06:21'),
(188, 3, 17, 'KJ-0000019', 'SPT20201226142728', 'Cash', 300000, 81000, '2020-12-26 14:27:28'),
(189, 3, 17, 'KJ-0000020', 'SPT20201226173615', 'Cash', 400000, 91000, '2020-12-26 17:36:15'),
(190, 1, 17, 'KJ-0000021', 'SPT20201226213308', 'Cash', 220000, 1000, '2020-12-26 21:33:08'),
(191, 1, 17, 'KJ-0000022', 'SPT20201226213422', 'Cash', 230000, 11000, '2020-12-26 21:34:22'),
(192, 3, 17, 'KJ-0000023', 'SPT20201226215817', 'Cash', 500000, 62000, '2020-12-26 21:58:17'),
(193, 1, 17, 'KJ-0000024', 'SPT20201226233850', 'Cash', 300000, 81000, '2020-12-26 23:38:50'),
(194, 1, 17, 'KJ-0000025', 'SPT20201227092004', 'Cash', 300000, 81000, '2020-12-27 09:20:04'),
(195, 1, 17, 'KJ-0000026', 'SPT20201227105409', 'Cash', 700000, 82000, '2020-12-27 10:54:09'),
(196, 1, 17, 'KJ-0000027', 'SPT20201227202255', 'Cash', 220000, 1000, '2020-12-27 20:22:55'),
(197, 1, 17, 'KJ-0000028', 'SPT20201227220900', 'Cash', 1000000, 124000, '2020-12-27 22:09:00'),
(198, 1, 17, 'KJ-0000029', 'SPT20201227231348', 'Cash', 2200000, 10000, '0000-00-00 00:00:00'),
(199, 1, 17, 'KJ-0000030', 'SPT20201227232440', 'Cash', 500000, 62000, '2020-12-27 23:24:40'),
(200, 1, 17, 'KJ-0000031', 'SPT20201227232928', 'Cash', 500000, 62000, '2020-12-27 23:29:28'),
(201, 1, 17, 'KJ-0000032', 'SPT20201229080928', 'Cash', 400000, 91000, '2020-12-29 08:09:28'),
(202, 1, 17, 'KJ-0000033', 'SPT20201229101808', 'Cash', 400000, 91000, '2020-12-29 10:18:08'),
(203, 1, 17, 'KJ-0000034', 'SPT20210330075539', 'Cash', 600000, 2000, '2021-03-30 07:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `profil_perusahaan`
--

CREATE TABLE `profil_perusahaan` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat_toko` varchar(100) DEFAULT NULL,
  `telp_toko` varchar(15) DEFAULT NULL,
  `fax_toko` varchar(15) DEFAULT NULL,
  `email_toko` varchar(50) DEFAULT NULL,
  `website_toko` varchar(50) DEFAULT NULL,
  `logo_toko` varchar(50) DEFAULT NULL,
  `IG` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_perusahaan`
--

INSERT INTO `profil_perusahaan` (`id_toko`, `nama_toko`, `alamat_toko`, `telp_toko`, `fax_toko`, `email_toko`, `website_toko`, `logo_toko`, `IG`) VALUES
(1, 'Wages Production', 'JL. Purwandaru, Bukateja, Kabupaten Purbalingga', '081327349761', '(0281) 4853378', 'wagesproduction@gmail.com', '-', 'pngwing_com_(4).png', 'brusedbykarin');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`) VALUES
(19, 'pasang');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` bigint(20) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `jml`, `tanggal`, `jenis`, `keterangan`) VALUES
(12, 75, 100, '2020-12-23 06:12:29', 'Stok Masuk', ''),
(13, 76, 100, '2020-12-23 06:13:03', 'Stok Masuk', ''),
(14, 77, 100, '2020-12-23 06:13:58', 'Stok Masuk', ''),
(15, 78, 100, '2020-12-23 06:15:02', 'Stok Masuk', ''),
(16, 79, 100, '2020-12-23 06:16:27', 'Stok Masuk', ''),
(17, 75, 2, '2020-12-24 00:15:02', 'Stok Masuk', ''),
(19, 83, 100, '2020-12-26 04:08:15', 'Stok Masuk', ''),
(20, 84, 100, '2020-12-26 04:28:39', 'Stok Masuk', ''),
(21, 86, 100, '2020-12-26 04:28:58', 'Stok Masuk', ''),
(22, 87, 100, '2020-12-26 04:29:10', 'Stok Masuk', ''),
(23, 88, 100, '2020-12-26 04:29:30', 'Stok Masuk', ''),
(24, 89, 100, '2020-12-26 04:29:42', 'Stok Masuk', ''),
(26, 85, 100, '2020-12-26 04:30:29', 'Stok Masuk', ''),
(27, 91, 100, '2020-12-26 04:30:44', 'Stok Masuk', ''),
(28, 92, 100, '2020-12-26 04:31:03', 'Stok Masuk', ''),
(29, 93, 100, '2020-12-26 04:31:55', 'Stok Masuk', ''),
(30, 94, 100, '2020-12-26 04:32:07', 'Stok Masuk', ''),
(31, 90, 100, '2020-12-26 10:33:38', 'Stok Masuk', ''),
(32, 96, 100, '2020-12-26 21:47:11', 'Stok Masuk', ''),
(33, 76, 40, '2020-12-27 07:30:53', 'Stok Masuk', ''),
(34, 78, 37, '2020-12-27 07:32:48', 'Stok Masuk', ''),
(35, 77, 9, '2020-12-27 07:38:31', 'Stok Masuk', ''),
(37, 79, 10, '2020-12-27 07:46:44', 'Stok Masuk', ''),
(38, 83, 10, '2020-12-27 07:51:11', 'Stok Masuk', ''),
(39, 84, 10, '2020-12-26 19:57:03', 'Stok Masuk', ''),
(42, 88, 10, '2020-12-27 08:03:49', 'Stok Masuk', ''),
(44, 90, 10, '2020-12-28 02:56:03', 'Stok Masuk', ''),
(45, 100, 100, '2020-12-28 19:04:16', 'Stok Masuk', ''),
(46, 101, 100, '2020-12-28 21:16:14', 'Stok Masuk', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_coa`
--

CREATE TABLE `transaksi_coa` (
  `id` int(11) NOT NULL,
  `transaksi` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `posisi` varchar(1) NOT NULL,
  `kelompok` varchar(15) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `tipe` varchar(30) DEFAULT NULL,
  `alamat_user` varchar(100) DEFAULT NULL,
  `telp_user` varchar(15) DEFAULT NULL,
  `email_user` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama_lengkap`, `password`, `tipe`, `alamat_user`, `telp_user`, `email_user`, `is_active`) VALUES
(1, 'admin', 'Pemilik', '$2y$10$oagi0l6Q3v.bwPCCVgOQXOnWX1FPLAvIiIfMJwIrJjk4212ACLN7.', 'Administrator', 'Purbalingga', '085647382748', 'admin@gmail.com', 1),
(3, 'kasir', 'Pegawai', '$2y$10$nWBEdyFeReNQtbr4lGUWmuN9SXKRtpqdog2CtXPFcmqCzb6p5Bmp6', 'Kasir', 'Purbalingga', '082236578566', 'kasir@gmail.com', 0),
(13, 'Kasir', 'Pegawai', '$2y$10$gyFAc/nO2bQKqcdqdHnn2O5VjJdLbJsgQ0OLIDE0kSkPXFKCWNAWC', 'Kasir', 'Purbalingga', '08153901654', 'kasir@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `ID_KATEGORI` (`id_kategori`),
  ADD KEY `ID_SATUAN` (`id_satuan`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cs`);

--
-- Indexes for table `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  ADD PRIMARY KEY (`id_detil_jual`),
  ADD KEY `FK_BARANG_PENJUALAN_DETIL` (`id_barang`),
  ADD KEY `FK_PENJUALAN_DETIL` (`id_jual`);

--
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `FK_MELAYANI` (`id_user`),
  ADD KEY `FK_TRANSAKSI` (`id_cs`);

--
-- Indexes for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi_coa`
--
ALTER TABLE `transaksi_coa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=512;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  MODIFY `id_detil_jual` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `transaksi_coa`
--
ALTER TABLE `transaksi_coa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `KATEGORI_BARANG` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `SATUAN_BARANG` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  ADD CONSTRAINT `FK_BARANG_PENJUALAN_DETIL` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `FK_PENJUALAN_DETIL` FOREIGN KEY (`id_jual`) REFERENCES `penjualan` (`id_jual`);

--
-- Constraints for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_coa`
--
ALTER TABLE `transaksi_coa`
  ADD CONSTRAINT `transaksi_coa_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
