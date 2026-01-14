-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table webdailyjournal.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table webdailyjournal.article: ~2 rows (approximately)
INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
	(5, 'Pencipta One Piece', 'Eiichiro Oda, mangaka legendaris pencipta One Piece. Karya nya sangat legendaris hingga sekarang', 'uploads/profil_eiichiro_oda.jpg', '2025-12-21 20:07:29', 'admin'),
	(10, 'Elaina', 'Bukan kah ini my Bini??', 'uploads/20251231074857_598.jpg', '2025-12-31 07:48:57', 'admin');

-- Dumping structure for table webdailyjournal.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table webdailyjournal.gallery: ~4 rows (approximately)
INSERT INTO `gallery` (`id`, `gambar`, `tanggal`, `username`, `deskripsi`) VALUES
	(10, 'gallery/20260114114937_142.png', '2026-01-14 11:37:22', 'admin', 'Vintage Anime'),
	(11, 'gallery/20260114113756_453.jpg', '2026-01-14 11:37:56', 'admin', 'Colorful Anime'),
	(12, 'gallery/20260114120658_739.jpg', '2026-01-14 12:06:58', 'admin', 'Summer Pocket'),
	(13, 'gallery/20260114121341_821.jpg', '2026-01-14 12:13:41', 'admin', 'Seirei Gensouki');

-- Dumping structure for table webdailyjournal.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  `foto` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table webdailyjournal.user: ~1 rows (approximately)
INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
	(1, 'admin', '$2y$10$HNNSp..MIhb7v75rAlZh3e4Q5r7w067WxqK1gR2WlmV7r5xMBiLQG', 'profile/1768372262_877.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
