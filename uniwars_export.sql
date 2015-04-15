-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for uniwars
DROP DATABASE IF EXISTS `uniwars`;
CREATE DATABASE IF NOT EXISTS `uniwars` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `uniwars`;


-- Dumping structure for table uniwars.players
DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table uniwars.players: ~6 rows (approximately)
DELETE FROM `players`;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `username`, `password`) VALUES
	(1, 'minka', '48c3a1aa7a9fbc6568b644afb5577361'),
	(2, 'stamat', '48c3a1aa7a9fbc6568b644afb5577361'),
	(5, 'pesho', '48c3a1aa7a9fbc6568b644afb5577361'),
	(6, 'manol', '48c3a1aa7a9fbc6568b644afb5577361'),
	(7, 'gruio', '48c3a1aa7a9fbc6568b644afb5577361'),
	(13, 'me4o', '48c3a1aa7a9fbc6568b644afb5577361'),
	(14, 'dancho', '42009255f5b064bd7f097b670821852b');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;


-- Dumping structure for table uniwars.player_stages
DROP TABLE IF EXISTS `player_stages`;
CREATE TABLE IF NOT EXISTS `player_stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL DEFAULT '0',
  `university_id` int(11) DEFAULT NULL,
  `stage_id` int(11) NOT NULL DEFAULT '0',
  `level_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__players_id` (`player_id`),
  KEY `FK2___` (`stage_id`),
  KEY `FK3__` (`level_id`),
  KEY `FK_player_stages_universities` (`university_id`),
  CONSTRAINT `FK2___` FOREIGN KEY (`stage_id`) REFERENCES `stage_levels` (`stage_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK3__` FOREIGN KEY (`level_id`) REFERENCES `stage_levels` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_player_stages_universities` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__players_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table uniwars.player_stages: ~4 rows (approximately)
DELETE FROM `player_stages`;
/*!40000 ALTER TABLE `player_stages` DISABLE KEYS */;
INSERT INTO `player_stages` (`id`, `player_id`, `university_id`, `stage_id`, `level_id`) VALUES
	(1, 14, 2, 1, 1),
	(2, 14, 2, 2, 0),
	(3, 14, 1, 1, 1),
	(4, 14, 1, 2, 1);
/*!40000 ALTER TABLE `player_stages` ENABLE KEYS */;


-- Dumping structure for table uniwars.stages
DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table uniwars.stages: ~2 rows (approximately)
DELETE FROM `stages`;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` (`id`, `name`) VALUES
	(1, 'Contracts'),
	(2, 'Java Basics Course');
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;


-- Dumping structure for table uniwars.stage_levels
DROP TABLE IF EXISTS `stage_levels`;
CREATE TABLE IF NOT EXISTS `stage_levels` (
  `stage_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `money_consume` double NOT NULL,
  `lectures_consume` double NOT NULL,
  `money_income` double NOT NULL,
  `lectures_income` double NOT NULL,
  PRIMARY KEY (`stage_id`,`level_id`),
  KEY `level_id` (`level_id`),
  CONSTRAINT `FK__stages` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table uniwars.stage_levels: ~6 rows (approximately)
DELETE FROM `stage_levels`;
/*!40000 ALTER TABLE `stage_levels` DISABLE KEYS */;
INSERT INTO `stage_levels` (`stage_id`, `level_id`, `money_consume`, `lectures_consume`, `money_income`, `lectures_income`) VALUES
	(1, 0, 0, 0, 0, 0),
	(1, 1, 100, 1, 200, 0),
	(1, 2, 150, 1, 320, 0),
	(2, 0, 0, 0, 0, 0),
	(2, 1, 300, 5, 700, 1),
	(2, 2, 500, 10, 1200, 2);
/*!40000 ALTER TABLE `stage_levels` ENABLE KEYS */;


-- Dumping structure for table uniwars.universities
DROP TABLE IF EXISTS `universities`;
CREATE TABLE IF NOT EXISTS `universities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '0',
  `player_id` int(11) NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `lectures` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__users` (`player_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table uniwars.universities: ~2 rows (approximately)
DELETE FROM `universities`;
/*!40000 ALTER TABLE `universities` DISABLE KEYS */;
INSERT INTO `universities` (`id`, `name`, `player_id`, `money`, `lectures`) VALUES
	(1, 'UNWE', 14, 500, 24),
	(2, 'TU', 14, 100, 19);
/*!40000 ALTER TABLE `universities` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
