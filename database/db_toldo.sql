-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_toldo
CREATE DATABASE IF NOT EXISTS `db_toldo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_toldo`;

-- Dumping structure for table db_toldo.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_akun` int(11) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `c_d` varchar(1) NOT NULL,
  `saldo_awal` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_toldo.akun: ~19 rows (approximately)
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
REPLACE INTO `akun` (`id`, `kode_akun`, `nama_akun`, `c_d`, `saldo_awal`) VALUES
	(1, 1, 'Aktiva', 'd', 0),
	(2, 2, 'Kewajiban', 'c', 0),
	(3, 3, 'Modal', 'c', 0),
	(4, 4, 'Pendapatan', 'c', 0),
	(5, 5, 'Beban', 'd', 0),
	(11, 11, 'Aktiva Lancar', 'd', 0),
	(12, 12, 'Aktiva Tetap', 'd', 0),
	(21, 21, 'Kewajiban Lancar', 'c', 0),
	(22, 22, 'Kewajiban Jangka Panjang', 'c', 0),
	(31, 31, 'Modal Pemilik', 'c', 0),
	(41, 41, 'Pendapatan Operasional', 'c', 0),
	(42, 42, 'Pendapatan Non Operasional', 'c', 0),
	(51, 51, 'Beban Operasional', 'd', 0),
	(52, 52, 'Beban Non Operasioanl', 'd', 0),
	(111, 111, 'Kas', 'd', 0),
	(112, 112, 'Persediaan Barang Dagang', 'd', 0),
	(411, 411, 'Penjualan', 'c', 0),
	(412, 412, 'Harga Pokok Penjualan', 'c', 0),
	(511, 511, 'Beban Administrasi dan Umum', 'd', 0);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;

-- Dumping structure for table db_toldo.akun2
CREATE TABLE IF NOT EXISTS `akun2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `header` int(11) NOT NULL,
  `dc` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.akun2: ~0 rows (approximately)
/*!40000 ALTER TABLE `akun2` DISABLE KEYS */;
REPLACE INTO `akun2` (`id`, `kode`, `nama`, `header`, `dc`) VALUES
	(3, 1, 'wwww', 2, 'Debit');
/*!40000 ALTER TABLE `akun2` ENABLE KEYS */;

-- Dumping structure for table db_toldo.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(20) DEFAULT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `harga_jual` varchar(30) DEFAULT NULL,
  `harga_sales` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `ID_KATEGORI` (`id_kategori`),
  KEY `ID_SATUAN` (`id_satuan`),
  CONSTRAINT `KATEGORI_BARANG` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `SATUAN_BARANG` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.barang: ~29 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
REPLACE INTO `barang` (`id_barang`, `kode_barang`, `barcode`, `nama_barang`, `id_kategori`, `id_satuan`, `harga_jual`, `harga_sales`, `stok`, `is_active`) VALUES
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
	(87, 'BRG-00013', '-', 'Dark Brown Shoes', 16, 19, '299000', 290000, 98, 1),
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
	(101, 'BRG-00027', '5667879765611', 'nike mercurial', 17, 19, '399000', 390000, 84, 1),
	(102, 'BRG-00028', '999999', 'Testing Data', 17, 19, '150000', 145000, 117, 1),
	(103, 'BRG-00029', '999998', 'Testing Barang Lagi', 17, 19, '149000', 145000, 58, 1);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table db_toldo.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_cs` int(11) NOT NULL AUTO_INCREMENT,
  `kode_cs` varchar(20) DEFAULT NULL,
  `nama_cs` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `jenis_cs` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cs`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.customer: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
REPLACE INTO `customer` (`id_cs`, `kode_cs`, `nama_cs`, `jenis_kelamin`, `telp`, `email`, `alamat`, `jenis_cs`) VALUES
	(17, 'CS-000001', 'Umum', 'Laki-Laki', 'umum', 'umum', 'umum', 'Umum'),
	(18, 'CS-000002', 'Reseller', 'Laki-Laki', 'Reseller', 'Reseller', 'Reseller', 'Sales');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table db_toldo.data_absen
CREATE TABLE IF NOT EXISTS `data_absen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `masuk` datetime NOT NULL,
  `pulang` datetime NOT NULL,
  `terlambat` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `time` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.data_absen: ~7 rows (approximately)
/*!40000 ALTER TABLE `data_absen` DISABLE KEYS */;
REPLACE INTO `data_absen` (`id`, `nik`, `masuk`, `pulang`, `terlambat`, `status`, `time`) VALUES
	(23, '201227234600', '2020-12-16 07:13:23', '2020-12-16 16:00:00', 0, 2, 0),
	(24, '201227234600', '2020-12-15 07:13:23', '2020-12-15 16:00:00', 0, 2, 0),
	(25, '201227234600', '2020-12-14 07:13:23', '2020-12-15 16:00:00', 0, 3, 0),
	(26, '201228064747', '2020-12-14 07:13:23', '2020-12-15 16:00:00', 0, 2, 0),
	(27, '210624133600', '2021-06-24 13:55:06', '2021-06-24 16:00:00', 355, 3, 1624467600),
	(28, '201228064747', '2021-06-24 08:03:38', '2021-06-24 14:08:21', 4, 2, 1624467600),
	(29, '201227234600', '2021-06-24 08:03:57', '2021-06-24 14:08:29', 4, 2, 1624467600);
/*!40000 ALTER TABLE `data_absen` ENABLE KEYS */;

-- Dumping structure for table db_toldo.data_absen_flash
CREATE TABLE IF NOT EXISTS `data_absen_flash` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `masuk` datetime NOT NULL,
  `pulang` datetime NOT NULL,
  `terlambat` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `time` int(15) NOT NULL,
  `time_del` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.data_absen_flash: ~0 rows (approximately)
/*!40000 ALTER TABLE `data_absen_flash` DISABLE KEYS */;
REPLACE INTO `data_absen_flash` (`id`, `nik`, `masuk`, `pulang`, `terlambat`, `status`, `time`, `time_del`) VALUES
	(1, '210624151911', '2021-07-13 11:43:05', '2021-07-13 13:00:00', '3', 1, 1626109200, 1626192000),
	(2, '210624151719', '2021-07-13 11:43:28', '2021-07-13 13:00:00', '3', 1, 1626109200, 1626192000);
/*!40000 ALTER TABLE `data_absen_flash` ENABLE KEYS */;

-- Dumping structure for table db_toldo.detil_penjualan
CREATE TABLE IF NOT EXISTS `detil_penjualan` (
  `id_detil_jual` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_jual` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `kode_detil_jual` varchar(20) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `harga_item` int(11) DEFAULT NULL,
  `qty_jual` int(11) DEFAULT NULL,
  `subtotal` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_detil_jual`),
  KEY `FK_BARANG_PENJUALAN_DETIL` (`id_barang`),
  KEY `FK_PENJUALAN_DETIL` (`id_jual`),
  CONSTRAINT `FK_BARANG_PENJUALAN_DETIL` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `FK_PENJUALAN_DETIL` FOREIGN KEY (`id_jual`) REFERENCES `penjualan` (`id_jual`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.detil_penjualan: ~32 rows (approximately)
/*!40000 ALTER TABLE `detil_penjualan` DISABLE KEYS */;
REPLACE INTO `detil_penjualan` (`id_detil_jual`, `id_jual`, `id_barang`, `kode_detil_jual`, `diskon`, `harga_item`, `qty_jual`, `subtotal`) VALUES
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
	(130, 203, 84, 'DJ-0000013', 0, 299000, 2, '598000'),
	(131, 204, 101, 'DJ-0000014', 0, 399000, 1, '399000'),
	(132, 206, 101, 'DJ-0000015', 0, 399000, 2, '798000'),
	(133, 208, 101, 'DJ-0000016', 0, 399000, 1, '399000'),
	(135, 209, 101, 'DJ-0000018', 0, 399000, 3, '1197000'),
	(136, 210, 101, 'DJ-0000019', 0, 399000, 1, '399000'),
	(137, 211, 101, 'DJ-0000020', 0, 399000, 1, '399000'),
	(138, 212, 101, 'DJ-0000021', 0, 399000, 2, '798000'),
	(139, 213, 101, 'DJ-0000022', 0, 399000, 1, '399000'),
	(140, 214, 101, 'DJ-0000023', 0, 399000, 1, '399000'),
	(142, 215, 101, 'DJ-0000025', 0, 399000, 1, '399000'),
	(143, 215, 101, 'DJ-0000026', 0, 399000, 1, '399000'),
	(144, 215, 101, 'DJ-0000027', 0, 399000, 1, '399000'),
	(145, 216, 102, 'DJ-0000028', 0, 150000, 1, '150000'),
	(146, 217, 103, 'DJ-0000029', 0, 149000, 1, '149000'),
	(147, 218, 103, 'DJ-0000030', 0, 149000, 1, '149000'),
	(148, 219, 102, 'DJ-0000031', 0, 150000, 1, '150000'),
	(149, NULL, 102, 'DJ-0000032', 0, 150000, 1, '150000'),
	(150, NULL, 87, 'DJ-0000033', 0, 299000, 1, '299000'),
	(151, NULL, 87, 'DJ-0000034', 0, 299000, 1, '299000');
/*!40000 ALTER TABLE `detil_penjualan` ENABLE KEYS */;

-- Dumping structure for table db_toldo.gaji
CREATE TABLE IF NOT EXISTS `gaji` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `jml_gaji` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.gaji: ~3 rows (approximately)
/*!40000 ALTER TABLE `gaji` DISABLE KEYS */;
REPLACE INTO `gaji` (`id`, `nik`, `durasi`, `jml_gaji`, `status`, `tgl`, `dari`, `sampai`) VALUES
	(2, '201228064747', 1, 30000, 0, '2020-12-29', '2020-12-01', '2020-12-28'),
	(4, '201227234600', 2, 500000, 0, '2020-12-29', '2020-12-01', '2020-12-28'),
	(5, '210624133600', 0, 0, 0, '2021-07-13', '2021-05-01', '2021-05-28');
/*!40000 ALTER TABLE `gaji` ENABLE KEYS */;

-- Dumping structure for table db_toldo.jadwal_absen
CREATE TABLE IF NOT EXISTS `jadwal_absen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` int(15) NOT NULL,
  `masuk` int(15) NOT NULL,
  `toleransi` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.jadwal_absen: ~7 rows (approximately)
/*!40000 ALTER TABLE `jadwal_absen` DISABLE KEYS */;
REPLACE INTO `jadwal_absen` (`id`, `tanggal`, `masuk`, `toleransi`) VALUES
	(6, 1609002000, 1609030800, 1609033200),
	(7, 1609088400, 1609117200, 1609119600),
	(8, 1609174800, 1609203600, 1609206000),
	(9, 1623949200, 1623978000, 1623980400),
	(10, 1624381200, 1624410000, 1624412400),
	(11, 1624467600, 1624496400, 1624498800),
	(12, 1624554000, 1624582800, 1624585200),
	(13, 1626109200, 1626151200, 1626153600);
/*!40000 ALTER TABLE `jadwal_absen` ENABLE KEYS */;

-- Dumping structure for table db_toldo.jurnal
CREATE TABLE IF NOT EXISTS `jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(255) DEFAULT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `no_coa` int(20) DEFAULT NULL,
  `posisi_dr_cr` varchar(255) DEFAULT NULL,
  `nominal` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.jurnal: ~24 rows (approximately)
/*!40000 ALTER TABLE `jurnal` DISABLE KEYS */;
REPLACE INTO `jurnal` (`id`, `id_transaksi`, `tgl_jurnal`, `no_coa`, `posisi_dr_cr`, `nominal`) VALUES
	(1, 'KJ-0000039', '2021-06-18', 111, 'd', 399000),
	(2, 'KJ-0000039', '2021-06-18', 411, 'k', 399000),
	(3, 'KJ-0000040', '2021-06-22', 111, 'd', 1197000),
	(4, 'KJ-0000040', '2021-06-22', 411, 'k', 1197000),
	(5, 'KJ-0000041', '2021-06-22', 111, 'd', 399000),
	(6, 'KJ-0000041', '2021-06-22', 411, 'k', 399000),
	(7, 'KJ-0000042', '2021-06-22', 111, 'd', 399000),
	(8, 'KJ-0000042', '2021-06-22', 411, 'k', 399000),
	(9, 'KJ-0000043', '2021-06-22', 111, 'd', 798000),
	(10, 'KJ-0000043', '2021-06-22', 411, 'k', 798000),
	(11, 'KJ-0000044', '2021-06-22', 111, 'd', 399000),
	(12, 'KJ-0000044', '2021-06-22', 411, 'k', 399000),
	(13, 'KJ-0000045', '2021-06-22', 111, 'd', 399000),
	(14, 'KJ-0000045', '2021-06-22', 411, 'k', 399000),
	(15, 'KJ-0000046', '2021-06-22', 111, 'd', 1197000),
	(16, 'KJ-0000046', '2021-06-22', 411, 'k', 1197000),
	(17, 'KJ-0000047', '2021-06-23', 111, 'd', 150000),
	(18, 'KJ-0000047', '2021-06-23', 411, 'k', 150000),
	(19, 'KJ-0000048', '2021-06-23', 111, 'd', 149000),
	(20, 'KJ-0000048', '2021-06-23', 411, 'k', 149000),
	(21, 'KJ-0000049', '2021-06-23', 111, 'd', 149000),
	(22, 'KJ-0000049', '2021-06-23', 411, 'k', 149000),
	(23, 'KJ-0000050', '2021-06-23', 111, 'd', 150000),
	(24, 'KJ-0000050', '2021-06-23', 411, 'k', 150000);
/*!40000 ALTER TABLE `jurnal` ENABLE KEYS */;

-- Dumping structure for table db_toldo.jurnal_umum
CREATE TABLE IF NOT EXISTS `jurnal_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nominal` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_akun` (`id_akun`),
  CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_toldo.jurnal_umum: ~0 rows (approximately)
/*!40000 ALTER TABLE `jurnal_umum` DISABLE KEYS */;
/*!40000 ALTER TABLE `jurnal_umum` ENABLE KEYS */;

-- Dumping structure for table db_toldo.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `kelamin` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `poto` varchar(200) NOT NULL,
  `qr` varchar(200) NOT NULL,
  `jabatan` varchar(50) NOT NULL DEFAULT 'Karyawan',
  `gaji` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.karyawan: ~7 rows (approximately)
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
REPLACE INTO `karyawan` (`id`, `nik`, `nama`, `email`, `telp`, `kelamin`, `alamat`, `time`, `poto`, `qr`, `jabatan`, `gaji`) VALUES
	(28, '201227234600', 'Ucup Suganda', 'rmarliusputra@gmail.com', '085-860-603-800', 'Pria', 'Jakarta Timur', '2020-12-27 23:47:09', 'default.png', '201227234600.png', 'Staf Utama', 250000),
	(29, '201228064747', 'Ridho Maulana', 'admin@email.com', '085-860-603-800', 'Pria', 'Bandung', '2020-12-28 06:48:11', 'default.png', '201228064747.png', 'Karyawan Depan', 30000),
	(30, '210624133600', 'asddsa', 'asd@gmail.com', '0812-121-718', 'Pria', 'asd', '2021-06-24 13:38:44', 'default.png', '210624133600.png', 'Programmer', 550000),
	(31, '210624143942', 'Tessss', 'zxc@gmail.com', '01-231-312-323', 'Wanita', 'dsa', '2021-06-24 14:39:57', 'default.png', '210624143942.png', 'Karyawan', 0),
	(32, '210624151047', 'asdasd', 'asdasd@gmail.com', '01-231-231-231', 'Wanita', 'asd', '2021-06-24 15:10:57', 'default.png', '210624151047.png', 'Karyawan', 0),
	(33, '210624151719', 'aaaaaaa', 'asdaa@gmail.com', '0123-212-312', 'Wanita', 'adsa', '2021-06-24 15:17:39', 'default.png', '210624151719.png', 'Karyawan', 0),
	(34, '210624151911', 'dsss', 'asdd@gmail.com', '01-232-222', 'Pria', '221s', '2021-06-24 15:19:22', 'default.png', '210624151911.png', 'Karyawan', 0);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table db_toldo.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.kategori: ~6 rows (approximately)
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
REPLACE INTO `kategori` (`id_kategori`, `kategori`) VALUES
	(13, 'Flat'),
	(14, 'Formal'),
	(15, 'Heels'),
	(16, 'Slip On'),
	(17, 'Sneakers'),
	(18, 'Wedges');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table db_toldo.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_jual` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_cs` int(11) DEFAULT NULL,
  `kode_jual` varchar(20) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `method` varchar(30) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jual`),
  KEY `FK_MELAYANI` (`id_user`),
  KEY `FK_TRANSAKSI` (`id_cs`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.penjualan: ~50 rows (approximately)
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
REPLACE INTO `penjualan` (`id_jual`, `id_user`, `id_cs`, `kode_jual`, `invoice`, `method`, `bayar`, `kembali`, `tgl`) VALUES
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
	(203, 1, 17, 'KJ-0000034', 'SPT20210330075539', 'Cash', 600000, 2000, '2021-03-30 07:55:39'),
	(204, 1, 17, 'KJ-0000035', 'SPT20210618180617', 'Cash', 399000, 0, '2021-06-18 18:06:17'),
	(205, 1, 17, 'KJ-0000036', 'SPT20210618180957', 'Cash', 399000, 0, '2021-06-18 18:09:57'),
	(206, 1, 17, 'KJ-0000037', 'SPT20210618181421', 'Cash', 798000, 0, '2021-06-18 18:14:21'),
	(207, 1, 17, 'KJ-0000038', 'SPT20210618181921', 'Cash', 798000, 0, '2021-06-18 18:19:21'),
	(208, 1, 17, 'KJ-0000039', 'SPT20210618182040', 'Cash', 399000, 0, '2021-06-18 18:20:40'),
	(209, 0, 17, 'KJ-0000040', 'SPT20210622162248', 'Cash', 1197000, 0, '2021-06-22 16:22:48'),
	(210, 0, 17, 'KJ-0000041', 'SPT20210622162522', 'Cash', 399000, 0, '2021-06-22 16:25:22'),
	(211, 0, 17, 'KJ-0000042', 'SPT20210622163551', 'Cash', 399000, 0, '2021-06-22 16:35:51'),
	(212, 0, 17, 'KJ-0000043', 'SPT20210622163654', 'Cash', 798000, 0, '2021-06-22 16:36:54'),
	(213, 0, 17, 'KJ-0000044', 'SPT20210622163841', 'Cash', 399000, 0, '2021-06-22 16:38:41'),
	(214, 0, 17, 'KJ-0000045', 'SPT20210622163922', 'Cash', 399000, 0, '2021-06-22 16:39:22'),
	(215, 0, 17, 'KJ-0000046', 'SPT20210622170106', 'Cash', 1197000, 0, '2021-06-22 17:01:06'),
	(216, 1, 17, 'KJ-0000047', 'SPT20210623170822', 'Cash', 150000, 0, '2021-06-23 17:08:22'),
	(217, 1, 17, 'KJ-0000048', 'SPT20210623173310', 'Cash', 149000, 0, '2021-06-23 17:33:10'),
	(218, 1, 17, 'KJ-0000049', 'SPT20210623173453', 'Cash', 149000, 0, '2021-06-23 17:34:53'),
	(219, 1, 17, 'KJ-0000050', 'SPT20210623183213', 'Cash', 150000, 0, '2021-06-23 18:32:13');
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;

-- Dumping structure for table db_toldo.profil_perusahaan
CREATE TABLE IF NOT EXISTS `profil_perusahaan` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat_toko` varchar(100) DEFAULT NULL,
  `telp_toko` varchar(15) DEFAULT NULL,
  `fax_toko` varchar(15) DEFAULT NULL,
  `email_toko` varchar(50) DEFAULT NULL,
  `website_toko` varchar(50) DEFAULT NULL,
  `logo_toko` varchar(50) DEFAULT NULL,
  `IG` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.profil_perusahaan: ~0 rows (approximately)
/*!40000 ALTER TABLE `profil_perusahaan` DISABLE KEYS */;
REPLACE INTO `profil_perusahaan` (`id_toko`, `nama_toko`, `alamat_toko`, `telp_toko`, `fax_toko`, `email_toko`, `website_toko`, `logo_toko`, `IG`) VALUES
	(1, 'Wages Production', 'JL. Purwandaru, Bukateja, Kabupaten Purbalingga', '081327349761', '(0281) 4853378', 'wagesproduction@gmail.com', '-', 'pngwing_com_(4).png', 'brusedbykarin');
/*!40000 ALTER TABLE `profil_perusahaan` ENABLE KEYS */;

-- Dumping structure for table db_toldo.satuan
CREATE TABLE IF NOT EXISTS `satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.satuan: ~0 rows (approximately)
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
REPLACE INTO `satuan` (`id_satuan`, `satuan`) VALUES
	(19, 'pasang');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;

-- Dumping structure for table db_toldo.stok
CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_stok`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.stok: ~33 rows (approximately)
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
REPLACE INTO `stok` (`id_stok`, `id_barang`, `jml`, `tanggal`, `jenis`, `keterangan`) VALUES
	(12, 75, 100, '2020-12-23 13:12:29', 'Stok Masuk', ''),
	(13, 76, 100, '2020-12-23 13:13:03', 'Stok Masuk', ''),
	(14, 77, 100, '2020-12-23 13:13:58', 'Stok Masuk', ''),
	(15, 78, 100, '2020-12-23 13:15:02', 'Stok Masuk', ''),
	(16, 79, 100, '2020-12-23 13:16:27', 'Stok Masuk', ''),
	(17, 75, 2, '2020-12-24 07:15:02', 'Stok Masuk', ''),
	(19, 83, 100, '2020-12-26 11:08:15', 'Stok Masuk', ''),
	(20, 84, 100, '2020-12-26 11:28:39', 'Stok Masuk', ''),
	(21, 86, 100, '2020-12-26 11:28:58', 'Stok Masuk', ''),
	(22, 87, 100, '2020-12-26 11:29:10', 'Stok Masuk', ''),
	(23, 88, 100, '2020-12-26 11:29:30', 'Stok Masuk', ''),
	(24, 89, 100, '2020-12-26 11:29:42', 'Stok Masuk', ''),
	(26, 85, 100, '2020-12-26 11:30:29', 'Stok Masuk', ''),
	(27, 91, 100, '2020-12-26 11:30:44', 'Stok Masuk', ''),
	(28, 92, 100, '2020-12-26 11:31:03', 'Stok Masuk', ''),
	(29, 93, 100, '2020-12-26 11:31:55', 'Stok Masuk', ''),
	(30, 94, 100, '2020-12-26 11:32:07', 'Stok Masuk', ''),
	(31, 90, 100, '2020-12-26 17:33:38', 'Stok Masuk', ''),
	(32, 96, 100, '2020-12-27 04:47:11', 'Stok Masuk', ''),
	(33, 76, 40, '2020-12-27 14:30:53', 'Stok Masuk', ''),
	(34, 78, 37, '2020-12-27 14:32:48', 'Stok Masuk', ''),
	(35, 77, 9, '2020-12-27 14:38:31', 'Stok Masuk', ''),
	(37, 79, 10, '2020-12-27 14:46:44', 'Stok Masuk', ''),
	(38, 83, 10, '2020-12-27 14:51:11', 'Stok Masuk', ''),
	(39, 84, 10, '2020-12-27 02:57:03', 'Stok Masuk', ''),
	(42, 88, 10, '2020-12-27 15:03:49', 'Stok Masuk', ''),
	(44, 90, 10, '2020-12-28 09:56:03', 'Stok Masuk', ''),
	(45, 100, 100, '2020-12-29 02:04:16', 'Stok Masuk', ''),
	(46, 101, 100, '2020-12-29 04:16:14', 'Stok Masuk', ''),
	(47, 102, 100, '2021-06-23 09:59:52', 'Stok Masuk', 'Beli stok masuk'),
	(48, 102, 20, '2021-06-23 10:00:40', 'Stok Masuk', 'tambah 20\r\n'),
	(49, 103, 50, '2021-06-23 10:26:04', 'Stok Masuk', 'Testing '),
	(50, 103, 10, '2021-06-23 10:26:47', 'Stok Masuk', 'asd');
/*!40000 ALTER TABLE `stok` ENABLE KEYS */;

-- Dumping structure for table db_toldo.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.transaksi: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
REPLACE INTO `transaksi` (`id`, `id_barang`, `jenis`, `jml`, `stok_akhir`, `tgl_input`) VALUES
	(1, 103, 'Stok Masuk', 50, 50, '2021-06-23 17:26:04'),
	(2, 103, 'Stok Masuk', 10, 60, '2021-06-23 17:26:47'),
	(3, 103, 'Stok Keluar', 1, 58, '2021-06-23 17:34:48'),
	(4, 102, 'Stok Keluar', 1, 118, '2021-06-23 18:32:05'),
	(5, 102, 'Stok Keluar', 1, 117, '2021-06-24 14:19:42'),
	(6, 87, 'Stok Keluar', 1, 99, '2021-06-24 14:43:22'),
	(7, 87, 'Stok Keluar', 1, 98, '2021-06-24 14:43:31');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table db_toldo.transaksi_coa
CREATE TABLE IF NOT EXISTS `transaksi_coa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `posisi` varchar(1) NOT NULL,
  `kelompok` varchar(15) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_akun` (`id_akun`),
  CONSTRAINT `transaksi_coa_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.transaksi_coa: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi_coa` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_coa` ENABLE KEYS */;

-- Dumping structure for table db_toldo.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `tipe` varchar(30) DEFAULT NULL,
  `alamat_user` varchar(100) DEFAULT NULL,
  `telp_user` varchar(15) DEFAULT NULL,
  `email_user` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id_user`, `username`, `nama_lengkap`, `password`, `tipe`, `alamat_user`, `telp_user`, `email_user`, `is_active`) VALUES
	(1, 'admin', 'Pemilik', '$2y$10$oagi0l6Q3v.bwPCCVgOQXOnWX1FPLAvIiIfMJwIrJjk4212ACLN7.', 'Administrator', 'Purbalingga', '085647382748', 'admin@gmail.com', 1),
	(3, 'kasir', 'Pegawai', '$2y$10$nWBEdyFeReNQtbr4lGUWmuN9SXKRtpqdog2CtXPFcmqCzb6p5Bmp6', 'Kasir', 'Purbalingga', '082236578566', 'kasir@gmail.com', 0),
	(13, 'Kasir', 'Pegawai', '$2y$10$gyFAc/nO2bQKqcdqdHnn2O5VjJdLbJsgQ0OLIDE0kSkPXFKCWNAWC', 'Kasir', 'Purbalingga', '08153901654', 'kasir@gmail.com', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table db_toldo.user2
CREATE TABLE IF NOT EXISTS `user2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `poto` varchar(100) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.user2: ~0 rows (approximately)
/*!40000 ALTER TABLE `user2` DISABLE KEYS */;
REPLACE INTO `user2` (`id`, `nama`, `email`, `password`, `poto`, `role_id`, `is_active`, `perusahaan`, `logo`) VALUES
	(1, 'Ridho Maulana', 'administrator@gmail.com', '$2y$10$9cv/KmcubyzaV8PPn1xVDe08v5iU18RcHvKUi6LoB/dryrtzyLFoO', 'uas_db.jpg', 1, 1, 'PT. ABSENSI DIGITA', 'vsc.png');
/*!40000 ALTER TABLE `user2` ENABLE KEYS */;

-- Dumping structure for table db_toldo.waktu_absen
CREATE TABLE IF NOT EXISTS `waktu_absen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masuk` varchar(11) NOT NULL,
  `m_masuk` varchar(11) NOT NULL,
  `pulang` varchar(11) NOT NULL,
  `m_pulang` varchar(11) NOT NULL,
  `toleransi` varchar(11) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.waktu_absen: ~0 rows (approximately)
/*!40000 ALTER TABLE `waktu_absen` DISABLE KEYS */;
REPLACE INTO `waktu_absen` (`id`, `masuk`, `m_masuk`, `pulang`, `m_pulang`, `toleransi`, `active`) VALUES
	(1, '11', '40', '13', '00', '40', 1);
/*!40000 ALTER TABLE `waktu_absen` ENABLE KEYS */;

-- Dumping structure for table db_toldo.waktu_absen_sekarang
CREATE TABLE IF NOT EXISTS `waktu_absen_sekarang` (
  `active` int(1) NOT NULL,
  `masuk` datetime NOT NULL,
  `pulang` datetime NOT NULL,
  `toleransi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_toldo.waktu_absen_sekarang: ~0 rows (approximately)
/*!40000 ALTER TABLE `waktu_absen_sekarang` DISABLE KEYS */;
REPLACE INTO `waktu_absen_sekarang` (`active`, `masuk`, `pulang`, `toleransi`) VALUES
	(1, '2021-07-13 11:40:00', '2021-07-13 13:00:00', '2021-07-13 12:20:00');
/*!40000 ALTER TABLE `waktu_absen_sekarang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
