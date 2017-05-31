-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_ta_perpus
DROP DATABASE IF EXISTS `db_ta_perpus`;
CREATE DATABASE IF NOT EXISTS `db_ta_perpus` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_ta_perpus`;

-- Dumping structure for table db_ta_perpus.data_poster
DROP TABLE IF EXISTS `data_poster`;
CREATE TABLE IF NOT EXISTS `data_poster` (
  `id_poster` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `nrp_penulis` varchar(50) DEFAULT NULL,
  `judul_publikasi` varchar(100) DEFAULT NULL,
  `tahun_publikasi` varchar(4) DEFAULT NULL,
  `id_rmk` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `abstrak` text,
  `kata_kunci` text,
  `dosbing_1` varchar(100) NOT NULL,
  `dosbing_2` varchar(100) DEFAULT NULL,
  `waktu_entri` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_cetak` datetime DEFAULT NULL,
  `perubahan_terakhir` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `path_image` varchar(1024) DEFAULT NULL,
  `sudah_publish` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_poster`),
  KEY `id_rmk` (`id_rmk`),
  KEY `nama_penulis` (`nama_penulis`),
  KEY `judul_publikasi` (`judul_publikasi`),
  KEY `tahun_publikasi` (`tahun_publikasi`),
  KEY `id_status` (`id_status`),
  KEY `nrp_penulis` (`nrp_penulis`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `data_poster_ibfk_1` FOREIGN KEY (`id_rmk`) REFERENCES `ref_rmk` (`id_rmk`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `data_poster_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `ref_status` (`id_status`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `data_poster_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_poster: ~0 rows (approximately)
/*!40000 ALTER TABLE `data_poster` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_poster` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_user
DROP TABLE IF EXISTS `data_user`;
CREATE TABLE IF NOT EXISTS `data_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_privilege` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_induk` varchar(30) DEFAULT NULL,
  `waktu_buat` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  KEY `id_privilege` (`id_privilege`),
  CONSTRAINT `data_user_ibfk_1` FOREIGN KEY (`id_privilege`) REFERENCES `ref_privilege` (`id_privilege`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_user: ~5 rows (approximately)
/*!40000 ALTER TABLE `data_user` DISABLE KEYS */;
REPLACE INTO `data_user` (`id_user`, `id_privilege`, `nama`, `pass`, `nama_lengkap`, `nomor_induk`, `waktu_buat`) VALUES
	(1, 1, 'admin', 'admin', NULL, NULL, '2017-05-17 03:44:33');
/*!40000 ALTER TABLE `data_user` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.ref_privilege
DROP TABLE IF EXISTS `ref_privilege`;
CREATE TABLE IF NOT EXISTS `ref_privilege` (
  `id_privilege` int(11) NOT NULL AUTO_INCREMENT,
  `nama_privilege` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.ref_privilege: ~2 rows (approximately)
/*!40000 ALTER TABLE `ref_privilege` DISABLE KEYS */;
REPLACE INTO `ref_privilege` (`id_privilege`, `nama_privilege`) VALUES
	(1, 'administrator'),
	(2, 'mahasiswa');
/*!40000 ALTER TABLE `ref_privilege` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.ref_rmk
DROP TABLE IF EXISTS `ref_rmk`;
CREATE TABLE IF NOT EXISTS `ref_rmk` (
  `id_rmk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rmk` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rmk`),
  KEY `nama_rmk` (`nama_rmk`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.ref_rmk: ~6 rows (approximately)
/*!40000 ALTER TABLE `ref_rmk` DISABLE KEYS */;
REPLACE INTO `ref_rmk` (`id_rmk`, `nama_rmk`, `alias`) VALUES
	(1, 'Algoritma dan Pemrograman', 'Alpro'),
	(2, 'Manajemen Informasi', 'MI'),
	(3, 'Dasar dan Terapan Komputasi', 'DTK'),
	(4, 'Rekayasa Perangkat Lunak', 'RPL'),
	(5, 'Komputasi Berbasis Jaringan', 'KBJ'),
	(6, 'Komputasi Cerdas dan Visi', 'KCV'),
	(7, 'Arsitektur dan Jaringan Komputer', 'AJK');
/*!40000 ALTER TABLE `ref_rmk` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.ref_status
DROP TABLE IF EXISTS `ref_status`;
CREATE TABLE IF NOT EXISTS `ref_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.ref_status: ~3 rows (approximately)
/*!40000 ALTER TABLE `ref_status` DISABLE KEYS */;
REPLACE INTO `ref_status` (`id_status`, `deskripsi`) VALUES
	(1, 'Diusulkan'),
	(2, 'Diterima'),
	(3, 'Ditolak');
/*!40000 ALTER TABLE `ref_status` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.transaksi_keyword_hit
DROP TABLE IF EXISTS `transaksi_keyword_hit`;
CREATE TABLE IF NOT EXISTS `transaksi_keyword_hit` (
  `id_keyword` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) DEFAULT NULL,
  `total_hit` int(11) DEFAULT '0',
  PRIMARY KEY (`id_keyword`),
  KEY `keyword` (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.transaksi_keyword_hit: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi_keyword_hit` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_keyword_hit` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.transaksi_search_hit
DROP TABLE IF EXISTS `transaksi_search_hit`;
CREATE TABLE IF NOT EXISTS `transaksi_search_hit` (
  `id_search_hit` int(11) NOT NULL AUTO_INCREMENT,
  `id_poster` int(11) DEFAULT NULL,
  `id_keyword` int(11) DEFAULT NULL,
  `waktu_hit` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_search_hit`),
  KEY `id_poster` (`id_poster`),
  KEY `id_keyword` (`id_keyword`),
  CONSTRAINT `transaksi_search_hit_ibfk_1` FOREIGN KEY (`id_poster`) REFERENCES `data_poster` (`id_poster`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_search_hit_ibfk_2` FOREIGN KEY (`id_keyword`) REFERENCES `transaksi_keyword_hit` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.transaksi_search_hit: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaksi_search_hit` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_search_hit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
