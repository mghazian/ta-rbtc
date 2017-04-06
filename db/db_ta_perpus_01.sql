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

-- Dumping structure for table db_ta_perpus.data_admin
DROP TABLE IF EXISTS `data_admin`;
CREATE TABLE IF NOT EXISTS `data_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `waktu_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_admin: ~0 rows (approximately)
DELETE FROM `data_admin`;
/*!40000 ALTER TABLE `data_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_admin` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_dosbing
DROP TABLE IF EXISTS `data_dosbing`;
CREATE TABLE IF NOT EXISTS `data_dosbing` (
  `id_dosbing` int(11) NOT NULL AUTO_INCREMENT,
  `id_poster` int(11) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_dosbing`),
  KEY `id_poster` (`id_poster`),
  KEY `nama_dosen` (`nama_dosen`),
  CONSTRAINT `data_dosbing_ibfk_1` FOREIGN KEY (`id_poster`) REFERENCES `data_poster` (`id_poster`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_dosbing: ~0 rows (approximately)
DELETE FROM `data_dosbing`;
/*!40000 ALTER TABLE `data_dosbing` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_dosbing` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_poster
DROP TABLE IF EXISTS `data_poster`;
CREATE TABLE IF NOT EXISTS `data_poster` (
  `id_poster` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `judul_publikasi` varchar(100) DEFAULT NULL,
  `tahun_publikasi` varchar(4) DEFAULT NULL,
  `id_rmk` int(11) DEFAULT NULL,
  `waktu_entri` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `perubahan_terakhir` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `path_image` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id_poster`),
  KEY `id_rmk` (`id_rmk`),
  KEY `nama_penulis` (`nama_penulis`),
  KEY `judul_publikasi` (`judul_publikasi`),
  KEY `tahun_publikasi` (`tahun_publikasi`),
  CONSTRAINT `data_poster_ibfk_1` FOREIGN KEY (`id_rmk`) REFERENCES `ref_rmk` (`id_rmk`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_poster: ~0 rows (approximately)
DELETE FROM `data_poster`;
/*!40000 ALTER TABLE `data_poster` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_poster` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_tag
DROP TABLE IF EXISTS `data_tag`;
CREATE TABLE IF NOT EXISTS `data_tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `id_poster` int(11) DEFAULT NULL,
  `tag` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tag`),
  KEY `id_poster` (`id_poster`),
  KEY `tag` (`tag`),
  CONSTRAINT `data_tag_ibfk_1` FOREIGN KEY (`id_poster`) REFERENCES `data_poster` (`id_poster`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_tag: ~0 rows (approximately)
DELETE FROM `data_tag`;
/*!40000 ALTER TABLE `data_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_tag` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.ref_rmk
DROP TABLE IF EXISTS `ref_rmk`;
CREATE TABLE IF NOT EXISTS `ref_rmk` (
  `id_rmk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rmk` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rmk`),
  KEY `nama_rmk` (`nama_rmk`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.ref_rmk: ~0 rows (approximately)
DELETE FROM `ref_rmk`;
/*!40000 ALTER TABLE `ref_rmk` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_rmk` ENABLE KEYS */;

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
DELETE FROM `transaksi_keyword_hit`;
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
DELETE FROM `transaksi_search_hit`;
/*!40000 ALTER TABLE `transaksi_search_hit` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_search_hit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
