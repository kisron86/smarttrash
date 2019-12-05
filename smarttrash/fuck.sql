-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.25 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table smarttrash.data_ketinggian
CREATE TABLE IF NOT EXISTS `data_ketinggian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sensor` tinyint(2) NOT NULL,
  `ketinggian` int(3) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table smarttrash.data_ketinggian: ~2 rows (approximately)
/*!40000 ALTER TABLE `data_ketinggian` DISABLE KEYS */;
INSERT INTO `data_ketinggian` (`id`, `id_sensor`, `ketinggian`, `log`) VALUES
	(1, 1, 20, '2019-08-15 19:45:03'),
	(2, 1, 51, '2019-08-15 19:45:03');
/*!40000 ALTER TABLE `data_ketinggian` ENABLE KEYS */;

-- Dumping structure for table smarttrash.tb_sensor
CREATE TABLE IF NOT EXISTS `tb_sensor` (
  `id_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(100) NOT NULL,
  `lt` varchar(30) NOT NULL,
  `lg` varchar(30) NOT NULL,
  PRIMARY KEY (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table smarttrash.tb_sensor: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_sensor` DISABLE KEYS */;
INSERT INTO `tb_sensor` (`id_sensor`, `lokasi`, `lt`, `lg`) VALUES
	(1, 'Rumah Sakit Umum Nirmala', '-7.4031607', '109.3428484'),
	(2, 'Depan SMK N 1 Purbalingga', '-7.4039112', '109.3471393');
/*!40000 ALTER TABLE `tb_sensor` ENABLE KEYS */;

-- Dumping structure for table smarttrash.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table smarttrash.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `log`) VALUES
	(1, 'arif', '$2y$10$BCNYM2A3nc/jjpXwEolHbuKkrX.wxxv0Gh8b5ASnsRtReRktL0/Ra', '2019-08-17 17:35:38');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
