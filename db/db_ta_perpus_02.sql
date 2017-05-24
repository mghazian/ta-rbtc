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
CREATE DATABASE IF NOT EXISTS `db_ta_perpus` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_ta_perpus`;

-- Dumping structure for table db_ta_perpus.data_admin
CREATE TABLE IF NOT EXISTS `data_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `waktu_buat` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `data_admin` DISABLE KEYS */;
REPLACE INTO `data_admin` (`id_admin`, `nama`, `pass`, `waktu_buat`) VALUES
	(1, 'admin', 'admin', '2017-05-17 03:44:33');
/*!40000 ALTER TABLE `data_admin` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_dosbing
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
/*!40000 ALTER TABLE `data_dosbing` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_dosbing` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_poster
CREATE TABLE IF NOT EXISTS `data_poster` (
  `id_poster` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `judul_publikasi` varchar(100) DEFAULT NULL,
  `tahun_publikasi` varchar(4) DEFAULT NULL,
  `id_rmk` int(11) DEFAULT NULL,
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
  CONSTRAINT `data_poster_ibfk_1` FOREIGN KEY (`id_rmk`) REFERENCES `ref_rmk` (`id_rmk`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.data_poster: ~5 rows (approximately)
/*!40000 ALTER TABLE `data_poster` DISABLE KEYS */;
REPLACE INTO `data_poster` (`id_poster`, `nama_penulis`, `judul_publikasi`, `tahun_publikasi`, `id_rmk`, `waktu_entri`, `waktu_cetak`, `perubahan_terakhir`, `path_image`, `sudah_publish`) VALUES
	(12, 'Rage Comic', 'Fuu face', '2008', 5, '2017-05-25 00:57:15', '2017-05-24 20:33:32', '2017-05-25 01:33:32', 'upload\\fuu-face.jpg', b'1'),
	(13, 'Rage Comic', 'Troll', '2007', 1, '2017-05-21 16:35:10', '2017-05-24 20:35:10', '2017-05-25 01:35:10', 'upload/troll.jpg', b'1'),
	(18, 'Rage Comic', 'Afraid', '2010', 6, '2017-05-21 20:00:37', NULL, '2017-05-21 20:00:37', 'upload\\afraid.png', b'0'),
	(19, 'Rage Comic', 'LOL', '2007', 1, '2017-05-21 20:00:53', NULL, '2017-05-21 20:00:53', 'upload\\LOL.jpg', b'0'),
	(20, 'Rage Comic', 'Kya', '2007', 4, '2017-05-21 20:01:22', '2017-05-24 21:36:05', '2017-05-25 02:36:05', 'upload\\laribanci.gif', b'1');
/*!40000 ALTER TABLE `data_poster` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.data_tag
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
/*!40000 ALTER TABLE `data_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_tag` ENABLE KEYS */;

-- Dumping structure for table db_ta_perpus.ref_rmk
CREATE TABLE IF NOT EXISTS `ref_rmk` (
  `id_rmk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rmk` varchar(100) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rmk`),
  KEY `nama_rmk` (`nama_rmk`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ta_perpus.ref_rmk: ~7 rows (approximately)
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

-- Dumping structure for table db_ta_perpus.transaksi_keyword_hit
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
