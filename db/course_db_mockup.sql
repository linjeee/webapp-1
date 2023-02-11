-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for course_db
CREATE DATABASE IF NOT EXISTS `course_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `course_db`;

-- Dumping structure for table course_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
	(2, 'mathawee', 'admin', 'mathawee202@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '5n8qnMB9HslK8vstpl8e.png'),
	(3, 'mathaweee', 'admin', 'mathawee201@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', 'B4IJdUOPIm0DbykRy5Ag.png');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table course_db.bookmark
CREATE TABLE IF NOT EXISTS `bookmark` (
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.bookmark: ~1 rows (approximately)
/*!40000 ALTER TABLE `bookmark` DISABLE KEYS */;
REPLACE INTO `bookmark` (`user_id`, `playlist_id`) VALUES
	(0, 8);
/*!40000 ALTER TABLE `bookmark` ENABLE KEYS */;

-- Dumping structure for table course_db.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `content_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.comments: ~6 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
REPLACE INTO `comments` (`id`, `content_id`, `user_id`, `comment`, `date`) VALUES
	(3, 4, 108, 'COMMENT 1', '2023-01-25 01:54:03'),
	(4, 4, 108, 'COMMENT 2', '2023-01-25 01:54:31'),
	(5, 4, 108, 'COMMENT 3', '2023-01-25 01:55:11'),
	(6, 4, 94, 'COMMENT 4', '2023-01-25 01:56:35'),
	(7, 4, 95, 'COMMENT 5', '2023-01-25 01:56:57'),
	(8, 4, 94, 'COMMENT 8', '2023-01-25 01:56:57');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table course_db.commentss
CREATE TABLE IF NOT EXISTS `commentss` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `post_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.commentss: ~7 rows (approximately)
/*!40000 ALTER TABLE `commentss` DISABLE KEYS */;
REPLACE INTO `commentss` (`id`, `post_id`, `user_id`, `comment`, `date`) VALUES
	(5, 5, 108, 'COMMENT 3', '2023-01-25 01:55:16'),
	(8, 5, 108, 'COMMENT 1', '2023-01-25 01:54:17'),
	(9, 5, 108, 'COMMENT 2', '2023-01-25 01:54:23'),
	(10, 5, 94, 'COMMENT 4', '2023-01-25 01:56:41'),
	(11, 5, 95, 'COMMENT 5', '2023-01-25 01:57:05'),
	(12, 5, 95, 'COMMENT 12', '2023-01-25 01:57:05'),
	(13, 5, 95, 'COMMENT 12', '2023-01-25 01:57:05');
/*!40000 ALTER TABLE `commentss` ENABLE KEYS */;

-- Dumping structure for table course_db.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.contact: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- Dumping structure for table course_db.content
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.content: ~2 rows (approximately)
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
REPLACE INTO `content` (`id`, `user_id`, `playlist_id`, `title`, `description`, `video`, `thumb`, `date`, `status`) VALUES
	(4, 1, 13, 'HTML EP.1', 'HTML EP.1', 'uOiY528KuUOt5sThN07h.mp4', 'xn0busFer09k1InIYyoU.png', '2023-01-25 01:53:39', 'active'),
	(5, 2, 14, 'JS EP.1', 'JS EP.1', 'urMHYObAO4I8qQPeLqOR.mp4', 'Fzisq0JpvOLPTbMMzQ6j.png', '2023-01-25 01:55:52', 'active');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;

-- Dumping structure for table course_db.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `user_id` int(200) NOT NULL,
  `content_id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.likes: ~31 rows (approximately)
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
REPLACE INTO `likes` (`user_id`, `content_id`, `post_id`) VALUES
	(2, 4, 0),
	(2, 0, 5),
	(2, 0, 6),
	(2, 5, 0),
	(94, 4, 0),
	(94, 0, 5),
	(95, 4, 0),
	(95, 0, 5),
	(95, 4, 7),
	(1, 4, 8),
	(95, 4, 6),
	(95, 4, 8),
	(95, 4, 8),
	(95, 4, 11),
	(95, 4, 15),
	(95, 4, 14),
	(95, 4, 13),
	(95, 4, 12),
	(95, 4, 10),
	(95, 4, 9),
	(95, 4, 6),
	(95, 4, 7),
	(95, 4, 9),
	(95, 4, 16),
	(95, 4, 16),
	(1, 4, 16),
	(94, 4, 16),
	(93, 4, 16),
	(108, 5, 16),
	(108, 5, 16),
	(108, 5, 16);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;

-- Dumping structure for table course_db.playlist
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.playlist: ~2 rows (approximately)
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
REPLACE INTO `playlist` (`id`, `user_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
	(13, 1, 'HTML', 'HTML', 'C0S8PQ1RSEp1t2V3Lk1n.png', '2023-01-25 01:53:20', 'active'),
	(14, 2, 'JS', 'JS', 'wTnTM5aTcfylRIYBGWA2.png', '2023-01-25 01:55:31', 'active');
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;

-- Dumping structure for table course_db.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `playlist_id` int(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.post: ~12 rows (approximately)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
REPLACE INTO `post` (`id`, `user_id`, `playlist_id`, `title`, `description`, `thumb`, `date`, `status`) VALUES
	(5, 1, 13, 'HTML EP.1', 'HTML EP.1', 'SzGlKrjFC5ghRNwx5TwB.png', '2023-01-25 01:53:49', 'active'),
	(6, 108, 14, 'JS EP.1', 'JS EP.1', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(7, 108, 14, 'test7', 'test2', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(8, 108, 14, 'test8', 'test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(9, 108, 14, 'test9', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(10, 108, 14, 'test10', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(11, 96, 14, 'test11', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(12, 95, 14, 'test12', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(13, 97, 14, 'test13', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(14, 98, 14, 'test14', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(15, 2, 14, 'tese15', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active'),
	(16, 2, 14, 'end16', '5555test', 'SPm9VHZcSSOnyyycb3rd.png', '2023-01-25 01:56:02', 'active');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table course_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `verifiedEmail` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `image` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table course_db.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `email`, `first_name`, `last_name`, `verifiedEmail`, `token`, `name`, `password`, `image`) VALUES
	(92, 'mathawee201@gmail.com', '', '', 0, '', 'mathawee', '011c945f30ce2cbafc452f39840f025693339c42', _binary 0x6A6279654933765358526D3936444C59537A44672E6A7067),
	(93, 'mathawee202@gmail.com', '', '', 0, '', 'linjee', '011c945f30ce2cbafc452f39840f025693339c42', _binary 0x53414F325468385064336F303451316D4C4C75762E6A7067),
	(94, 'mathawee203@gmail.com', '', '', 0, '', 'mikasa', '011c945f30ce2cbafc452f39840f025693339c42', _binary 0x755953695A6E676B31624A5164334255734C76422E6A7067),
	(95, 'mathawee204@gmail.com', '', '', 0, '', 'ฟหกฟหก', '011c945f30ce2cbafc452f39840f025693339c42', _binary 0x3875666568364C515730385A54724D61376B38622E6A7067),
	(96, 'mathawee205@gmail.com', '', '', 0, '', 'dasdas', '011c945f30ce2cbafc452f39840f025693339c42', _binary 0x725156786647725439773337456A536C556C50312E6A7067),
	(108, 'dukediig@gmail.com', 'dukediig', 'pickaboo', 1, '113846662837243584339', 'dukediig pickaboo', '', _binary 0x68747470733A2F2F6C68332E676F6F676C6575736572636F6E74656E742E636F6D2F612F41456446547037303874496134544932636769645054625F696C796649716D7743546A6E4837682D484B56483D7339362D63);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
