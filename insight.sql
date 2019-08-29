-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.3.16-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table insight.activity
CREATE TABLE IF NOT EXISTS `activity` (
  `a_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_ig` longtext DEFAULT NULL,
  `type_activity` varchar(50) DEFAULT NULL,
  `post_url` text DEFAULT NULL,
  `time_stamp` longtext DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.activity: ~0 rows (lebih kurang)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;

-- membuang struktur untuk table insight.analitic_history
CREATE TABLE IF NOT EXISTS `analitic_history` (
  `ah_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profile_ig` longtext DEFAULT NULL,
  `time_stamp` longtext DEFAULT NULL,
  `follower_count` int(11) DEFAULT NULL,
  `post_count` int(11) DEFAULT NULL,
  `daily_engagement_rate` float DEFAULT NULL,
  `following` int(11) DEFAULT NULL,
  PRIMARY KEY (`ah_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.analitic_history: ~0 rows (lebih kurang)
DELETE FROM `analitic_history`;
/*!40000 ALTER TABLE `analitic_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `analitic_history` ENABLE KEYS */;

-- membuang struktur untuk table insight.bank_account
CREATE TABLE IF NOT EXISTS `bank_account` (
  `ba_id` int(11) NOT NULL,
  `ba_no_rek` varchar(50) DEFAULT NULL,
  `ba_name` varchar(50) DEFAULT NULL,
  `ba_an` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ba_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.bank_account: ~2 rows (lebih kurang)
DELETE FROM `bank_account`;
/*!40000 ALTER TABLE `bank_account` DISABLE KEYS */;
INSERT INTO `bank_account` (`ba_id`, `ba_no_rek`, `ba_name`, `ba_an`) VALUES
	(1, '123-456', 'BCA', 'agus'),
	(2, '145-123', 'BNI', 'ali');
/*!40000 ALTER TABLE `bank_account` ENABLE KEYS */;

-- membuang struktur untuk table insight.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `i_id` int(11) DEFAULT NULL,
  `i_user_id` int(11) DEFAULT NULL,
  `i_invoice` varchar(50) DEFAULT NULL,
  `i_nominal` varchar(50) DEFAULT NULL,
  `i_type` int(11) DEFAULT NULL COMMENT 'type paket A,B',
  `i_tanggal` date DEFAULT NULL,
  `i_image` varchar(50) DEFAULT NULL,
  `i_status` enum('Y','N') DEFAULT NULL COMMENT 'status bayar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.invoice: ~0 rows (lebih kurang)
DELETE FROM `invoice`;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- membuang struktur untuk table insight.master_paket
CREATE TABLE IF NOT EXISTS `master_paket` (
  `mp_id` int(11) NOT NULL,
  `mp_paket` varchar(20) DEFAULT NULL,
  `mp_nominal` decimal(10,0) DEFAULT NULL,
  `mp_time` decimal(10,0) DEFAULT NULL COMMENT '6 bl;n 1 tahun',
  `mp_ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.master_paket: ~2 rows (lebih kurang)
DELETE FROM `master_paket`;
/*!40000 ALTER TABLE `master_paket` DISABLE KEYS */;
INSERT INTO `master_paket` (`mp_id`, `mp_paket`, `mp_nominal`, `mp_time`, `mp_ket`) VALUES
	(1, 'Premium', 20000, NULL, 'Aktif 30 Hari'),
	(2, 'Standart', 50000, NULL, 'Aktif 100 Hari');
/*!40000 ALTER TABLE `master_paket` ENABLE KEYS */;

-- membuang struktur untuk table insight.member
CREATE TABLE IF NOT EXISTS `member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_parrent_m_id` int(11) NOT NULL,
  `m_username` varchar(50) DEFAULT NULL,
  `m_email` varchar(50) DEFAULT NULL,
  `m_password` varchar(50) DEFAULT NULL,
  `m_hp` varchar(50) DEFAULT NULL,
  `m_status_verifikasi` enum('Y','N') DEFAULT 'N' COMMENT 'status verifikasi email',
  `m_status_trial` enum('Y','N') DEFAULT 'N' COMMENT 'status ketika isi form',
  `m_status_active` enum('Y','N') DEFAULT 'N',
  `m_status_expired` datetime DEFAULT NULL,
  `m_created` datetime DEFAULT NULL,
  `m_status_banned` enum('Y','N') DEFAULT 'N',
  `m_activation_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  UNIQUE KEY `m_email` (`m_email`),
  UNIQUE KEY `m_username` (`m_username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.member: ~3 rows (lebih kurang)
DELETE FROM `member`;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`m_id`, `m_parrent_m_id`, `m_username`, `m_email`, `m_password`, `m_hp`, `m_status_verifikasi`, `m_status_trial`, `m_status_active`, `m_status_expired`, `m_created`, `m_status_banned`, `m_activation_code`) VALUES
	(12, 0, 'aziz', 'taziz704@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09121212', 'Y', 'Y', 'N', '2019-11-04 21:37:14', '2019-08-28 21:37:14', 'N', 'dc53188cca8879caa0795116ecd2d0d135a2b539'),
	(16, 12, 'indu', 'ptindumanis@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09121212', 'Y', 'Y', 'N', '2019-09-05 07:45:33', '2019-08-29 07:45:33', 'N', '97d496afef841a1217093660c932bfeab5de6530'),
	(17, 16, 'yuni', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09121212', 'N', 'Y', 'N', '2019-09-05 07:48:53', '2019-08-29 07:48:53', 'N', '7416611b9168dd632a08b388c7c037cf9a16c07f');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- membuang struktur untuk table insight.member_ig_profile
CREATE TABLE IF NOT EXISTS `member_ig_profile` (
  `mi_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `ig_profile_id` longtext DEFAULT NULL,
  PRIMARY KEY (`mi_id`),
  KEY `FK_member_ig_profile_member` (`member_id`),
  CONSTRAINT `FK_member_ig_profile_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.member_ig_profile: ~0 rows (lebih kurang)
DELETE FROM `member_ig_profile`;
/*!40000 ALTER TABLE `member_ig_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_ig_profile` ENABLE KEYS */;

-- membuang struktur untuk table insight.notif
CREATE TABLE IF NOT EXISTS `notif` (
  `n_id` int(11) DEFAULT NULL,
  `n_type` int(11) DEFAULT NULL,
  `n_no` int(11) DEFAULT NULL,
  `n_userid` int(11) DEFAULT NULL,
  `n_read` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.notif: ~0 rows (lebih kurang)
DELETE FROM `notif`;
/*!40000 ALTER TABLE `notif` DISABLE KEYS */;
/*!40000 ALTER TABLE `notif` ENABLE KEYS */;

-- membuang struktur untuk table insight.session
CREATE TABLE IF NOT EXISTS `session` (
  `s_token` varchar(50) NOT NULL DEFAULT '',
  `s_user_id` int(11) DEFAULT NULL,
  `s_imei` varchar(50) DEFAULT NULL,
  `s_manufacture` varchar(50) DEFAULT NULL,
  `s_ip` varchar(50) DEFAULT NULL,
  `s_model_gadget` varchar(50) DEFAULT NULL,
  `s_os_version` varchar(50) DEFAULT NULL,
  `s_app_version` varchar(50) DEFAULT NULL,
  `s_time_stamp` longtext DEFAULT NULL,
  PRIMARY KEY (`s_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.session: ~4 rows (lebih kurang)
DELETE FROM `session`;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`s_token`, `s_user_id`, `s_imei`, `s_manufacture`, `s_ip`, `s_model_gadget`, `s_os_version`, `s_app_version`, `s_time_stamp`) VALUES
	('4EOaZp1fA99UcL5StUegCT9KLCw56o09', 18, '123', 'a', '123', NULL, NULL, NULL, NULL),
	('c3Kak4bb2nsKHKL0z4VtMjDLmqE2XBhs', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('NYdF3CkhrLQkIyZnyzBx1KOxYthp21L9', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('o2GtA1zsYG0Y00bhYdKvTOxkgDUu0RGv', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- membuang struktur untuk table insight.subscribe
CREATE TABLE IF NOT EXISTS `subscribe` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  KEY `FK_subscribe_member` (`id_member`),
  CONSTRAINT `FK_subscribe_member` FOREIGN KEY (`id_member`) REFERENCES `member` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.subscribe: ~0 rows (lebih kurang)
DELETE FROM `subscribe`;
/*!40000 ALTER TABLE `subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribe` ENABLE KEYS */;

-- membuang struktur untuk table insight.user
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_member` int(11) DEFAULT NULL,
  `u_username` varchar(50) DEFAULT NULL,
  `u_password` varchar(50) DEFAULT NULL,
  `u_status` enum('A','I') DEFAULT NULL,
  `u_role` varchar(10) DEFAULT NULL,
  `u_insert` datetime DEFAULT NULL,
  `u_update` datetime DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel insight.user: ~3 rows (lebih kurang)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`u_id`, `u_member`, `u_username`, `u_password`, `u_status`, `u_role`, `u_insert`, `u_update`) VALUES
	(10, NULL, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'ADMIN', '2019-08-27 10:28:11', '2019-08-27 10:28:45'),
	(18, 12, 'taziz704@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'member', '2019-08-28 21:37:29', '2019-08-28 21:37:29'),
	(19, 16, 'ptindumanis@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'member', '2019-08-29 07:47:17', '2019-08-29 07:47:17');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
