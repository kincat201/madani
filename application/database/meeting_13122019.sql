-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table meeting.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logoSecond` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.config: ~0 rows (approximately)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `title`, `logo`, `logoSecond`, `icon`, `email`, `phone`, `address`, `facebook`, `instagram`, `twitter`, `whatsapp`, `about`) VALUES
	(1, 'Reservasi Ruangan', 'config/logo.png', 'config/logo-back.png', 'config/favicon.ico', 'info@koperasi-astra.com', '089635594784', 'Jl. Mitra Sunter Boulevard Blok C2 Kav 90 Sunter Jaya, Jakarta 14350', 'http://www.facebook.com', 'http://www.instagram.com', 'http://www.twitter.com', '6289635594784', 'Koperasi Astra merupakan salah satu upaya PT. Astra International Tbk, untuk menambah kesejahteraan karyawan tetapnya di seluruh anak perusahaan  melalui manfaat ekonomi yang dikelola Koperasi. Sebagai koperasi konsumen, Koperasi Astra tidak hanya memfasilitasi berbagai produk layanan simpan pinjam namun juga mampu meningkatkan kinerja melalui anak perusahaan yang bergerak dalam berbagai bidang.');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Dumping structure for table meeting.division
CREATE TABLE IF NOT EXISTS `division` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.division: ~10 rows (approximately)
/*!40000 ALTER TABLE `division` DISABLE KEYS */;
INSERT INTO `division` (`id`, `name`, `status`, `deleted`) VALUES
	(1, 'DIVISI AKUNTING', 'ACTIVE', 0),
	(2, 'DIVISI AR PENAGIHAN', 'ACTIVE', 0),
	(3, 'DIVISI FINANCE', 'ACTIVE', 0),
	(4, 'DIVISI FINANCE PENCAIRAN', 'ACTIVE', 0),
	(5, 'DIVISI IT', 'ACTIVE', 0),
	(6, 'DIVISI KEANGGOTAAN', 'ACTIVE', 0),
	(7, 'DIVISI KESRA', 'ACTIVE', 0),
	(8, 'DIVISI MARKETING', 'ACTIVE', 0),
	(9, 'DIVISI PINJAMAN', 'ACTIVE', 0),
	(10, 'DIVISI SIMPAN', 'ACTIVE', 0);
/*!40000 ALTER TABLE `division` ENABLE KEYS */;

-- Dumping structure for table meeting.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_11_29_081902_create_config', 1),
	(4, '2019_08_20_100434_create_company', 1),
	(5, '2019_08_20_104636_create_notification', 1),
	(6, '2019_08_20_104827_create_contact', 1),
	(7, '2019_11_26_044857_create_division', 1),
	(8, '2019_11_26_045004_create_role', 1),
	(9, '2019_11_26_045029_create_pic', 1),
	(10, '2019_11_26_045135_create_religion', 1),
	(11, '2019_11_26_045205_create_pic_division', 1),
	(12, '2019_11_26_045218_create_kopnit', 1),
	(13, '2019_11_26_045228_create_kopnit_role', 1),
	(14, '2019_11_26_050946_create_form_validation', 1),
	(15, '2019_12_12_165350_create_table_reservation', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table meeting.notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.notification: ~4 rows (approximately)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` (`id`, `userId`, `subject`, `description`, `type`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, '2', 'Reservation Disetujui', 'Selamat', 'RESERVATION', 'UNREAD', 0, NULL, NULL),
	(2, '36', 'Reservasi dengan kode :  53 (Disetujui)', 'Reservasi dengan kode :  53 (Disetujui) pada 2019-12-13 10:12:07 info lebih lengkap silahkan hubungi admin', 'RESERVATION', 'UNREAD', 0, '2019-12-13 10:12:07', '2019-12-13 10:12:07'),
	(3, '36', 'Reservasi dengan kode :  35 (Ditolak)', 'Reservasi dengan kode :  35 (Ditolak) karena jelek. pada 2019-12-13 10:12:18 info lebih lengkap silahkan hubungi admin', 'RESERVATION', 'UNREAD', 0, '2019-12-13 10:12:18', '2019-12-13 10:12:18'),
	(4, '0', 'Reservasi : 2/54', 'Pengajuan baru oleh member kincat only untuk reservasi', 'RESERVATION', 'READ', 0, '2019-12-13 10:16:00', '2019-12-13 10:16:38');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- Dumping structure for table meeting.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table meeting.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservationDate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservationTimeFrom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservationTimeTo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.reservation: ~53 rows (approximately)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`id`, `userId`, `title`, `room`, `pic`, `reservationDate`, `reservationTimeFrom`, `reservationTimeTo`, `remark`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Labore quo et possimus est et iste.', 'laborum', 'Merl Stamm', '1999-09-15', '05:46:37', '23:22:56', 'Earum est esse dicta iusto sed.', 'NEW', 0, '1993-09-20 17:41:23', '1976-08-28 18:59:06'),
	(2, 3, 'Corrupti aut pariatur voluptas voluptatem.', 'rerum', 'Faustino Botsford', '1998-11-14', '07:03:35', '18:51:53', 'Dicta vel et quibusdam ducimus in voluptatem libero consequatur.', 'REJECTED', 0, '1970-09-17 05:53:26', '1991-07-29 02:19:13'),
	(3, 4, 'Quas eum ea labore aut.', 'exercitationem', 'Chloe Runolfsson', '1979-09-09', '17:26:47', '12:28:14', 'Et deserunt dignissimos aspernatur voluptate rem non est.', 'APPROVED', 0, '1989-12-07 04:29:31', '2002-04-17 21:42:27'),
	(4, 5, 'Quaerat consectetur possimus perferendis labore maxime dolorem unde illo.', 'eius', 'Isabell Bednar', '1970-11-04', '12:35:29', '03:05:33', 'Labore rem sit ut et earum.', 'NEW', 0, '2018-09-20 16:24:11', '1996-06-01 11:47:41'),
	(5, 6, 'Consequatur ex id cum iste.', 'quibusdam', 'Guiseppe Murphy', '2009-02-05', '04:43:59', '16:02:04', 'Quos sint harum est saepe.', 'REJECTED', 0, '1973-03-23 20:19:53', '2002-07-21 03:54:36'),
	(6, 7, 'Culpa assumenda recusandae dolorum sint.', 'ex', 'Korbin Rolfson', '2012-02-09', '10:39:55', '10:21:17', 'Et ipsa esse ea alias rerum debitis.', 'APPROVED', 0, '1974-08-18 05:43:47', '1993-01-11 14:19:12'),
	(7, 8, 'Modi est perferendis minima cum et.', 'ex', 'Prof. Boris Murray Sr.', '1992-02-21', '17:56:18', '21:45:21', 'Occaecati aut necessitatibus veniam accusantium et sit quia.', 'NEW', 0, '1978-08-10 23:18:05', '1997-12-05 02:56:39'),
	(8, 9, 'Maxime facilis optio omnis maiores nesciunt.', 'dolores', 'Lucious Price', '1993-10-27', '15:44:42', '05:08:23', 'Ea maxime eligendi tenetur voluptatem.', 'NEW', 0, '2014-03-12 11:24:15', '1984-08-26 13:23:56'),
	(9, 10, 'Qui dolorem eaque neque.', 'nihil', 'Maryse Heaney', '2011-08-11', '09:19:54', '03:29:40', 'Et eum fugiat ipsum rerum similique est quis.', 'REJECTED', 0, '1984-03-04 18:46:08', '1988-09-11 04:21:14'),
	(10, 11, 'Consectetur vitae sunt sit mollitia qui rem pariatur.', 'sapiente', 'Gus Abshire V', '1982-08-17', '18:55:58', '01:57:00', 'Molestiae repellat cum laboriosam fuga molestiae beatae corporis.', 'APPROVED', 0, '1972-02-17 17:25:02', '2009-02-16 13:27:12'),
	(11, 12, 'Consequatur et assumenda reprehenderit aut.', 'corrupti', 'Blanca Paucek', '2005-06-09', '09:32:25', '00:10:36', 'Sequi commodi ut voluptates ratione.', 'REJECTED', 0, '1983-11-12 09:07:17', '2017-05-30 22:28:05'),
	(12, 13, 'Assumenda sed est temporibus hic qui nulla ipsa.', 'ea', 'Dr. Verna Grady I', '2008-11-29', '08:49:26', '08:14:45', 'Totam nisi eaque quos nihil placeat sequi.', 'APPROVED', 0, '2007-07-02 06:57:38', '2007-12-20 19:41:26'),
	(13, 14, 'Et aperiam delectus consequatur deleniti quo.', 'sed', 'Mr. Brandon Waters V', '2000-05-29', '23:14:44', '19:45:13', 'Voluptatibus quidem eos architecto animi qui placeat.', 'REJECTED', 0, '1973-09-13 15:48:27', '2006-02-20 06:42:58'),
	(14, 15, 'Ea unde itaque culpa repudiandae omnis qui itaque.', 'ipsum', 'Dedric Effertz', '2004-08-23', '03:08:05', '02:45:27', 'Quos occaecati provident quidem non voluptatibus.', 'REJECTED', 0, '2014-03-30 00:03:21', '1988-05-18 23:23:00'),
	(15, 16, 'Magnam sint fuga sit dolores.', 'saepe', 'Elmira Upton Jr.', '1972-03-10', '03:38:51', '16:49:05', 'Natus laboriosam et in velit iure est omnis doloremque.', 'NEW', 0, '1982-03-21 12:15:39', '1990-07-23 20:50:20'),
	(16, 17, 'Sit culpa et unde ipsa.', 'blanditiis', 'Marvin Welch', '1988-05-10', '15:42:21', '07:21:18', 'Nam cum illum eaque a nisi sed.', 'NEW', 0, '2016-10-30 08:35:44', '1976-03-22 11:58:47'),
	(17, 18, 'Ut natus aut omnis et quo illum sint culpa.', 'quam', 'Ms. Marietta Spencer DDS', '1991-10-05', '01:21:14', '21:03:00', 'Et quaerat vero dolores asperiores unde tempora in.', 'REJECTED', 0, '1979-09-13 20:55:30', '1972-07-12 08:42:56'),
	(18, 19, 'Dolorum et vitae in sint.', 'itaque', 'Dr. Eulalia Ratke DDS', '2007-02-14', '17:54:31', '22:00:08', 'Quia iure sit quibusdam ipsam dolorem.', 'APPROVED', 0, '1992-07-21 02:15:16', '1990-08-22 01:45:01'),
	(19, 20, 'Quis molestiae rerum unde voluptatem debitis.', 'et', 'Rosalinda Powlowski', '1999-03-27', '23:12:10', '07:56:32', 'Omnis dolor consequatur et sed.', 'APPROVED', 0, '1982-11-22 21:32:46', '2019-04-06 05:20:17'),
	(20, 21, 'Quos eius eos ipsam et neque dolores.', 'ullam', 'Filiberto Kessler III', '1974-02-13', '01:04:17', '22:06:11', 'Error quo voluptatum facere accusantium similique iure.', 'NEW', 0, '1988-08-16 18:17:04', '1971-03-18 19:22:21'),
	(21, 22, 'Sequi voluptatem voluptatem dolorum aut.', 'incidunt', 'Romaine Zemlak', '1996-07-08', '13:16:42', '22:00:58', 'Provident eum fuga hic dolore dolor eius eveniet.', 'NEW', 0, '1980-12-15 03:52:33', '2012-12-03 08:43:49'),
	(22, 23, 'Esse natus consequatur nobis alias fugiat eum omnis aut.', 'et', 'Osbaldo Frami', '1985-04-30', '11:05:25', '13:36:35', 'Incidunt earum quaerat similique veniam qui quos.', 'APPROVED', 0, '2019-11-06 04:24:24', '2015-07-26 18:22:17'),
	(23, 24, 'Vero consequatur recusandae quia rem harum in nihil.', 'laudantium', 'Clarabelle Pagac', '1993-05-24', '03:45:40', '20:52:20', 'Quis voluptatem recusandae quis et.', 'REJECTED', 0, '1990-07-16 17:38:40', '2014-04-30 02:39:20'),
	(24, 25, 'Necessitatibus ipsam perspiciatis eum sed occaecati ea est in.', 'iure', 'Ray Kozey', '1992-10-16', '03:14:07', '15:11:42', 'Modi unde nihil doloremque nemo laudantium et.', 'NEW', 0, '1980-09-20 05:07:15', '2012-11-10 15:19:50'),
	(25, 26, 'Voluptatum quo et dolor qui repellat.', 'aliquid', 'Katarina Grimes', '1983-04-06', '14:18:01', '01:46:32', 'Quas omnis vel tempore.', 'NEW', 0, '2016-01-31 01:17:43', '1978-06-16 11:15:22'),
	(26, 27, 'Debitis consequatur praesentium veniam facilis maiores.', 'aliquam', 'Catalina Kuhn', '1986-09-17', '04:32:14', '04:06:18', 'Odit corporis aut laboriosam maiores.', 'REJECTED', 0, '2010-08-16 20:33:35', '2005-01-26 06:48:07'),
	(27, 28, 'Incidunt repellat rerum et.', 'et', 'Dalton Reynolds III', '1982-06-22', '00:20:30', '07:13:40', 'Ullam voluptas veritatis quo qui ut.', 'NEW', 0, '1973-07-24 14:04:52', '2012-10-05 06:41:34'),
	(28, 29, 'Aut suscipit vitae est eligendi.', 'ut', 'Mr. Shane Schroeder III', '2000-10-13', '06:23:06', '14:06:38', 'Ut vel ratione aut soluta nihil vel.', 'NEW', 0, '2009-02-18 02:54:11', '1982-03-08 05:53:38'),
	(29, 30, 'Consequatur nulla accusantium quis et quia deserunt.', 'modi', 'Betty Kihn Jr.', '2015-05-01', '00:28:52', '20:43:07', 'Ab ea illo omnis iste voluptatem vitae.', 'APPROVED', 0, '2015-08-10 18:17:52', '1978-03-24 22:11:49'),
	(30, 31, 'Aliquam vero facilis ullam.', 'voluptas', 'Osvaldo Hamill', '2001-07-04', '13:37:43', '10:06:07', 'Quod eum tenetur commodi enim iste.', 'REJECTED', 0, '1999-11-15 01:58:41', '1974-03-14 01:13:11'),
	(31, 32, 'Et blanditiis voluptatem animi voluptas.', 'accusamus', 'Ila Bosco', '2015-12-13', '20:32:18', '05:46:14', 'Eveniet autem delectus accusamus dolorum maiores.', 'APPROVED', 0, '2017-05-17 05:01:24', '1970-09-24 01:38:52'),
	(32, 33, 'Et qui fugiat nihil ut qui.', 'fuga', 'Reba Jaskolski Sr.', '1990-10-28', '21:23:17', '13:03:46', 'Adipisci dicta unde in dolorem qui.', 'REJECTED', 0, '2016-08-22 21:54:28', '2008-02-14 02:00:00'),
	(33, 34, 'In repellat ut deleniti et et non molestiae.', 'veniam', 'Harmony Schroeder Sr.', '1979-09-02', '10:24:41', '07:46:24', 'Cumque quasi eum deserunt.', 'NEW', 0, '2013-02-15 17:30:28', '2014-02-05 03:46:30'),
	(34, 35, 'Est omnis aperiam libero consequuntur corporis id.', 'ipsam', 'Daphne Ankunding MD', '1984-06-03', '18:48:28', '04:59:55', 'Ad eius quis voluptas consequatur fugit.', 'REJECTED', 0, '2007-11-29 17:11:37', '1973-04-22 13:26:52'),
	(35, 36, 'Voluptatem delectus saepe accusantium doloribus sit vel.', 'quam', 'Miss Aisha Wisozk', '2017-12-14', '19:57:26', '08:30:30', 'jelek', 'REJECTED', 0, '2006-06-07 12:48:02', '2019-12-13 10:12:18'),
	(36, 37, 'Cumque atque perspiciatis dolores saepe.', 'eum', 'Kacie Runolfsson', '2016-10-14', '03:38:21', '11:13:42', 'Qui perspiciatis natus ea placeat.', 'NEW', 0, '2005-06-22 22:29:22', '2015-08-19 07:29:32'),
	(37, 38, 'Libero esse illo aspernatur corporis nesciunt cum.', 'culpa', 'Prof. Gus McClure', '2004-07-24', '19:03:57', '17:39:50', 'Iusto voluptas dolorem numquam quibusdam ad nemo aut.', 'APPROVED', 0, '1993-07-07 07:00:38', '2015-01-25 06:45:34'),
	(38, 39, 'Distinctio vero delectus rem voluptate hic libero.', 'repudiandae', 'Joanne Hill I', '1978-02-02', '15:02:45', '03:06:41', 'Voluptas et sit rerum blanditiis ratione aliquid dolore ut.', 'APPROVED', 0, '2006-02-17 21:28:04', '1998-08-15 23:16:26'),
	(39, 40, 'Aperiam est occaecati consequatur quae labore.', 'unde', 'Carlee Ledner', '2014-10-11', '23:17:27', '17:48:12', 'Omnis voluptatum voluptas fugiat.', 'REJECTED', 0, '1983-05-08 01:13:17', '2002-06-30 06:22:32'),
	(40, 41, 'Quam fugiat reiciendis dolores beatae.', 'quibusdam', 'Otho Bode DVM', '2015-04-18', '22:47:48', '23:46:23', 'Quod quaerat maxime laudantium facere ea omnis.', 'NEW', 0, '1981-10-14 02:49:01', '2011-03-27 06:51:57'),
	(41, 42, 'Perferendis cupiditate eligendi rerum error autem qui aliquam.', 'est', 'Collin Daniel', '1997-07-26', '20:04:38', '09:15:14', 'Commodi in veritatis praesentium placeat mollitia ipsum sed.', 'APPROVED', 0, '1982-06-08 17:24:44', '2002-12-07 03:37:15'),
	(42, 43, 'Est dolores et ut odio aliquam officia.', 'accusamus', 'Kelsie Reynolds V', '1971-11-17', '06:24:53', '22:05:58', 'Est hic officia unde tempora dolores sint.', 'NEW', 0, '1972-08-02 11:18:39', '1991-05-05 16:49:11'),
	(43, 44, 'Nisi est fugiat adipisci molestiae error laboriosam et dolore.', 'aut', 'Alexa Lubowitz I', '2017-01-28', '19:46:16', '03:58:19', 'Aspernatur necessitatibus eos nobis totam consequuntur illum corporis occaecati.', 'APPROVED', 0, '2001-07-25 21:11:37', '1989-07-27 22:41:47'),
	(44, 45, 'Recusandae veritatis perferendis ut esse non.', 'quia', 'Syble Wolff', '2010-04-02', '11:36:39', '11:59:13', 'A veniam sequi sunt et.', 'REJECTED', 0, '2014-06-29 02:47:50', '1970-04-16 11:51:38'),
	(45, 46, 'Est cumque blanditiis et pariatur occaecati autem.', 'quo', 'Mr. Davin Deckow', '2000-12-13', '17:23:26', '16:07:14', 'Voluptate qui voluptates dolorem est voluptas est.', 'APPROVED', 0, '1981-10-22 06:01:26', '1988-10-05 03:49:59'),
	(46, 47, 'Vitae quisquam autem nisi esse ratione et voluptate.', 'et', 'Zion Kunde', '1998-07-20', '07:04:59', '19:51:55', 'Non corrupti eum qui repellat doloribus explicabo aut.', 'REJECTED', 0, '1981-03-19 07:41:30', '1997-12-10 10:59:22'),
	(47, 48, 'Soluta sunt ad similique in illo deserunt ab.', 'quo', 'Alberto Mosciski', '1978-02-24', '03:12:03', '22:51:41', 'Quo nesciunt doloribus et recusandae sed.', 'APPROVED', 0, '1988-11-08 06:35:21', '1977-10-05 23:54:37'),
	(48, 49, 'Ut voluptatum quas dolorem.', 'non', 'Dr. Desiree Pfeffer MD', '1991-07-11', '07:03:09', '08:42:16', 'Incidunt non est quo quisquam delectus ipsa quia.', 'NEW', 0, '1998-01-11 06:53:27', '1981-01-08 04:14:56'),
	(49, 50, 'Voluptatem aut saepe blanditiis.', 'voluptas', 'Dion Keeling', '1978-11-27', '16:37:46', '09:56:38', 'Ut beatae omnis atque praesentium nihil rerum.', 'REJECTED', 0, '1987-09-26 10:09:37', '1973-06-14 02:43:07'),
	(50, 51, 'Modi sit mollitia sunt praesentium.', 'aut', 'Darryl Quitzon DDS', '1976-10-19', '03:32:13', '12:15:22', 'Sapiente vero accusantium ab.', 'NEW', 0, '2014-03-14 13:23:19', '1984-10-05 23:44:56'),
	(52, 2, 'Koperasi Astra2', '303', 'kincat only1', '2019-12-13', '6:30 AM', '7:15 AM', '', 'NEW', 1, '2019-12-13 06:03:46', '2019-12-13 06:04:24'),
	(53, 36, 'Koperasi Astra', '303', 'kincat only1', '2019-12-13', '7:00 AM', '8:00 AM', '', 'APPROVED', 0, '2019-12-13 06:58:49', '2019-12-13 10:12:07'),
	(54, 2, 'Frequently Ask Question', '303', 'kincat only', '2019-12-13', '10:15 AM', '10:15 AM', '', 'NEW', 0, '2019-12-13 10:15:59', '2019-12-13 10:15:59');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Dumping structure for table meeting.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'USER',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'users/default.png',
  `deleted` int(11) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `id` (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table meeting.users: ~53 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `role`, `phone`, `birthDay`, `photo`, `deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'kincat only', 'kincat@gmail.com', '$2y$10$S9VZlQi2VUntc6NBAqvfHuT5fdU/MTUFXPSgchgpH/tIDggpz7xe6', 'kincat@gmail.com', 'ADMIN', '123456', NULL, 'users/default.png', 0, NULL, '2019-12-03 21:03:05', '2019-12-03 21:03:05'),
	(2, 'kincat only', 'kincat1@gmail.com', '$2y$10$gCqf1Re4.dKd9M6BjhpDKOR2r0Mol7VfctZ6U4Yn4smG6pR9F9PlK', 'kincat1@gmail.com', 'USER', '123456', NULL, 'users/default.png', 0, 'M5j5Wu4kfUDhPEevl1rgPez0M1eXXEArS0Z0r9zS2WAz1uv8szF2rRJCMjFM', '2019-12-03 21:03:06', '2019-12-03 21:03:06'),
	(3, 'Layla Doyle', 'jturner@spinka.net', '$2y$10$IhMum8ViiijDnUCyaPfqfOdQ0XavXcd/V17AZmbX/jLTWFyLaBQxe', 'brogahn@gmail.com', 'USER', '+6369392359657', NULL, 'users/default.png', 0, NULL, '2006-07-28 01:48:12', '2009-12-18 20:14:41'),
	(4, 'Dr. Madisyn Parisian', 'lera.skiles@hotmail.com', '$2y$10$matoCwuE22vzPjp56g95puKsFXrJRD.pyFhB.E6YCo7arQK2Txa8W', 'haag.emmet@hotmail.com', 'USER', '+9498320586725', NULL, 'users/default.png', 0, NULL, '1970-03-15 18:08:28', '1999-07-21 23:53:13'),
	(5, 'Ken Greenfelder', 'hettie97@hoppe.com', '$2y$10$IMGOsZpE17IryVVjlcz6X.4Jpkl4HW.Z9OAuE0589A/yeLGO2PnUi', 'lynn78@gmail.com', 'USER', '+2535812267727', NULL, 'users/default.png', 0, NULL, '1994-01-26 13:06:57', '2016-11-19 03:20:34'),
	(6, 'Prof. Ari Pfannerstill', 'alberto.shanahan@hotmail.com', '$2y$10$BHfjGtr58BvshsGsil0VR.HEb7Mn73zgkmWWZFH6OG.J7QuQh2.Yu', 'aparker@yahoo.com', 'USER', '+6529204517373', NULL, 'users/default.png', 0, NULL, '1974-09-19 11:55:22', '1973-04-06 01:25:46'),
	(7, 'Arnoldo Altenwerth', 'kaylee.gerlach@gmail.com', '$2y$10$8IPYdbQaHf65RuUoEPyvhuu4GMtd5iZSjXqrQMh5vEDqsK6zV.DfW', 'ferry.jarret@hotmail.com', 'USER', '+3083735603387', NULL, 'users/default.png', 0, NULL, '2000-06-30 20:55:01', '1971-03-14 10:38:30'),
	(8, 'Osbaldo Thiel', 'pasquale92@block.org', '$2y$10$Cq8oosFXCJRqLggOKhmxh.v8bUZhR0G1GLDxjHRaGt/zLIyVcTRFG', 'betsy36@wunsch.info', 'USER', '+1269337646803', NULL, 'users/default.png', 0, NULL, '1985-07-01 19:11:26', '2005-09-05 21:40:34'),
	(9, 'Mr. Leopoldo Trantow', 'schowalter.helen@hotmail.com', '$2y$10$XqmBCHScZtDePCNaYcXX6eojO5DWyLX0dTKpkARmfPHLzEzs8S3g6', 'kjerde@yahoo.com', 'USER', '+1310812108514', NULL, 'users/default.png', 0, NULL, '1975-09-07 12:13:59', '1995-05-11 10:05:49'),
	(10, 'Miss Francisca Larson II', 'pfannerstill.carmelo@hotmail.com', '$2y$10$lt1PuWArN3pRnK3kH506M.rrg5mpTfKTuAjVrenuTj1I0pWy6CaXS', 'adah61@gmail.com', 'USER', '+1494660106539', NULL, 'users/default.png', 0, NULL, '2016-10-16 13:08:33', '2001-02-17 14:12:46'),
	(11, 'Dr. Rodrick Adams', 'qdamore@gmail.com', '$2y$10$oO.CVtCYcpzKbxrVhAm6PecWnDYSakImNNhBzZxc6mOqVwjibvEOe', 'johnston.pat@gmail.com', 'USER', '+1768523196927', NULL, 'users/default.png', 0, NULL, '2015-05-06 23:50:43', '1994-07-07 14:45:52'),
	(12, 'Mrs. Alexane Vandervort', 'yundt.corrine@jast.com', '$2y$10$9u5J46ZXs8jS1BkOd9uh8uLvI1dv7JoV6uT2ibhdTqaD9GB2ZU5lO', 'coy62@frami.biz', 'USER', '+5929490482156', NULL, 'users/default.png', 0, NULL, '1999-05-21 10:55:54', '1990-11-17 15:46:40'),
	(13, 'Sandra Lind', 'ellsworth.hyatt@dickens.com', '$2y$10$W7dbywA.mP.1CLXJieMrtOl/5h4.BqJY5sypbvLyC8mfawVuxXjG6', 'lysanne.romaguera@leffler.com', 'USER', '+3623022309251', NULL, 'users/default.png', 0, NULL, '2017-03-21 06:01:32', '1979-11-08 23:24:18'),
	(14, 'Kiera Conn', 'hchristiansen@yahoo.com', '$2y$10$LxQsh5DRWt7/o.IUd1bWFeKqhpNdl3n9hi48g8V2Y6c6Xrjx2f34e', 'cwilkinson@williamson.info', 'USER', '+3359406088478', NULL, 'users/default.png', 0, NULL, '1991-11-09 22:26:07', '1982-11-20 13:14:57'),
	(15, 'Meghan Jones', 'moshe58@hotmail.com', '$2y$10$MabDIFVdru93GmFIaElgfuRiDS1EAsU2ePSuz8EbGGgx3kPSOYRxa', 'ucarroll@huels.com', 'USER', '+6316046646705', NULL, 'users/default.png', 0, NULL, '1975-04-10 10:22:38', '1989-03-28 02:34:00'),
	(16, 'Jacky Schaden', 'bwitting@howe.com', '$2y$10$vQ0aFXITbf7D8j/IG39kB.w6RqrwVr7ZH85kAsGsCs6871APx8x6q', 'lemke.myrna@moen.com', 'USER', '+8983053831659', NULL, 'users/default.png', 0, NULL, '1991-10-18 19:08:32', '2016-10-19 23:39:41'),
	(17, 'Marilou Schumm III', 'delores42@tillman.com', '$2y$10$/F2i6KLIQcTvb0pgTOmmSuaTF4kK7v9.A/zUMybCMDoxTbJ3FiAHO', 'asha.schimmel@yahoo.com', 'USER', '+3289602573974', NULL, 'users/default.png', 0, NULL, '1976-03-23 02:30:15', '1992-02-18 02:16:43'),
	(18, 'Alvah Stehr', 'gottlieb.marianna@oberbrunner.com', '$2y$10$QCxH780T4FCiNIBucORs8O64SNtluJGXytCJo0gUBOHzJmBPI1rG6', 'trantow.herman@muller.com', 'USER', '+4978285109102', NULL, 'users/default.png', 0, NULL, '1979-12-13 00:10:10', '1990-11-09 17:46:19'),
	(19, 'Mae Leffler', 'angie61@olson.org', '$2y$10$NfXvyAnhiTK7qBT3GHtiJ.i/9pTk88kGf2Y3P9AizbSqtBOETFWdW', 'cedrick20@corkery.com', 'USER', '+3422271022482', NULL, 'users/default.png', 0, NULL, '1990-09-19 03:02:39', '1999-04-27 00:51:53'),
	(20, 'Rosalind Gislason', 'kyra.connelly@hotmail.com', '$2y$10$EleMsEbxRtJ.cmesv7b3Uu7bVR0SJZA5/Ex35KXtBKHI4SXF3QBmy', 'frankie.russel@runolfsson.biz', 'USER', '+5637974347606', NULL, 'users/default.png', 0, NULL, '1994-10-04 16:30:32', '1978-02-24 08:17:46'),
	(21, 'Prof. Ricky Wiza V', 'roger.senger@yahoo.com', '$2y$10$6QG8A2EOCty42zANqxt.B.UR1TouaSxMB6TB4EDwW7YjM2Giw8kRq', 'clotilde22@hotmail.com', 'USER', '+2664491263086', NULL, 'users/default.png', 0, NULL, '2003-09-10 05:21:12', '1996-10-15 04:18:46'),
	(22, 'Kirstin Monahan IV', 'lily55@hettinger.com', '$2y$10$aVy1KLy9dymqSuJ3UAcVkumLncGJ5.XRzUK3QsihlcFoMvCobzT7S', 'effertz.leora@yahoo.com', 'USER', '+9149310418264', NULL, 'users/default.png', 0, NULL, '1991-06-02 21:12:35', '1982-09-13 16:01:38'),
	(23, 'Prof. Melyna Kemmer Jr.', 'bailey81@roob.com', '$2y$10$FwWbw3.glgQZnR8wpcu3Z.Edare1X3/fqBYzfVTeD7Tk1qZHxZBjW', 'krystel85@bogisich.com', 'USER', '+9990777991198', NULL, 'users/default.png', 0, NULL, '2015-12-08 18:12:28', '1987-06-21 04:05:59'),
	(24, 'Kyra Haley', 'hdickens@hotmail.com', '$2y$10$se486ObddUPjD1n1JETIju7ZBPPYqbzwVDBK2fe8VWuL0ExFqDFxS', 'jnikolaus@wehner.org', 'USER', '+1410272464762', NULL, 'users/default.png', 0, NULL, '2017-09-06 11:06:57', '1997-04-09 22:36:39'),
	(25, 'Marietta Von', 'ayana01@marks.biz', '$2y$10$THhuWBDBG0rwot6tBz9Mne3h8UBNAeH5sR2locqWNbxs1YunWS7cm', 'mcartwright@blanda.com', 'USER', '+2711922308323', NULL, 'users/default.png', 0, NULL, '2018-07-11 06:01:49', '2006-05-27 00:46:38'),
	(26, 'Trudie Ernser', 'dario.wisozk@gmail.com', '$2y$10$u0xwRKk05CiMEg.DuhRfr.SOsi7VzN.P1i8RmQGtWXzQJgrwHRdve', 'stehr.carolina@gmail.com', 'USER', '+2776903686653', NULL, 'users/default.png', 0, NULL, '2013-07-13 05:41:39', '2012-11-15 16:29:31'),
	(27, 'Danika Mayer', 'tmayer@yahoo.com', '$2y$10$s4tCQ4AhvTJlsPC6krF73uSHThORYDkloljj1CrLUkxFQdbAsgcqy', 'halie.schuppe@gmail.com', 'USER', '+9995119469019', NULL, 'users/default.png', 0, NULL, '1981-01-31 16:57:48', '1971-06-19 15:11:54'),
	(28, 'Monte Bogisich', 'bjacobson@nikolaus.net', '$2y$10$tJNHZVuq5GhMul./TkpHt.MHiVLrQeVhVbQYwv7miGjl7/lC6cRBq', 'olson.skye@stracke.net', 'USER', '+7244842492465', NULL, 'users/default.png', 0, NULL, '1986-01-28 13:07:23', '1973-10-10 17:07:58'),
	(29, 'Afton Walter III', 'stiedemann.wade@reinger.com', '$2y$10$TMJDTTAgV1EAU7oU7jyE7OV6ptAl/CMMAtc6W7RTLq9lXsfI6qdi2', 'erin44@bayer.com', 'USER', '+3775009642411', NULL, 'users/default.png', 0, NULL, '2015-03-05 06:10:19', '1974-08-06 05:33:07'),
	(30, 'Dr. Mya Pfeffer', 'dblanda@hotmail.com', '$2y$10$w9mgB.xGMP/uUYlNW9s/uOm6CPlasrtmyYU4MZIRdX1bmC44e05Tm', 'gmorar@mraz.com', 'USER', '+2732531887531', NULL, 'users/default.png', 0, NULL, '2017-11-12 19:44:44', '2019-05-27 00:17:36'),
	(31, 'Henri O\'Conner Jr.', 'ijacobi@fisher.com', '$2y$10$EOq96RYNK42kidoRZRymo.bI6tnnYmoMMlOqdtTJgjYBjCbMc5T4e', 'sherman@cruickshank.com', 'USER', '+1730061520204', NULL, 'users/default.png', 0, NULL, '1994-11-24 00:34:08', '2007-12-05 01:33:41'),
	(32, 'Dr. Jeffery Pfannerstill', 'denesik.domenick@yahoo.com', '$2y$10$nXYsAyueG/0g3sThrxfQCuPNh9opSZkQ6VrwDr/Z8IeEeSz2ot7uq', 'wkunde@homenick.com', 'USER', '+1111729926095', NULL, 'users/default.png', 0, NULL, '2008-10-15 15:27:01', '1995-03-29 13:06:24'),
	(33, 'Prof. Edd Jacobs V', 'hfadel@gmail.com', '$2y$10$aQwYmAQMKQzT28.C2fJNyOnOUURAC.2XNF75jC6QBzb1x1c1XfBtK', 'caitlyn32@yahoo.com', 'USER', '+9339040141088', NULL, 'users/default.png', 0, NULL, '1974-04-14 23:48:14', '2015-06-26 07:05:07'),
	(34, 'Durward O\'Conner Jr.', 'alexie.carter@crona.com', '$2y$10$mfhj40.hMKJbeXfQKamYTu7cEk9/uI.PPhDONaC.ElYbVH2H2GiiW', 'chyatt@gmail.com', 'USER', '+1714829591280', NULL, 'users/default.png', 0, NULL, '1979-02-28 21:23:02', '1997-03-04 20:55:42'),
	(35, 'Prof. Jerry Abernathy PhD', 'hrutherford@gmail.com', '$2y$10$4e.sYYv.70vodK5GWG.OzeaZ7tNU8vpPmnjsMiQH0AhW8hJda3PGO', 'mellie.ziemann@gmail.com', 'USER', '+4728432820220', NULL, 'users/default.png', 0, NULL, '1970-10-20 16:27:22', '2000-07-27 18:01:56'),
	(36, 'Dr. Kailee Walter MD', 'seth.oberbrunner@prohaska.com', '$2y$10$9YCFWdXLafBb5lW/jI2G.OTAJO2uO.20bIvDaBSi93sn8Fv4Gi0yy', 'jo.rath@gmail.com', 'USER', '+9123389188977', NULL, 'users/default.png', 0, NULL, '2002-12-30 20:30:12', '1972-09-29 13:37:11'),
	(37, 'Miss Keira Hudson Jr.', 'nico.simonis@borer.com', '$2y$10$MvF0VJ4cfLj7ncmfsm8/bOW5nVtZJGJc2b.O1Q3PQKQ5UKThI.Ai.', 'benny63@trantow.com', 'USER', '+5310246411497', NULL, 'users/default.png', 0, NULL, '1980-01-07 15:59:07', '1978-10-31 00:44:26'),
	(38, 'Mrs. Priscilla Hermiston Sr.', 'phermiston@mitchell.com', '$2y$10$.2lr/XA0jvspF0zy/oSZguZvnPX74UAOF5zEjhN8pgnb/KeU3vacW', 'rklein@yahoo.com', 'USER', '+8323123463610', NULL, 'users/default.png', 0, NULL, '2008-06-24 09:07:22', '1985-07-19 13:14:23'),
	(39, 'Ms. Wilma Terry', 'raltenwerth@gmail.com', '$2y$10$9pMbwnuQzTODchWL7yFstOaafH4OOK1zN1Wmr7zV43mOXJf.2Rcou', 'loyal26@west.info', 'USER', '+7615536329294', NULL, 'users/default.png', 0, NULL, '1980-05-30 04:14:29', '1989-04-16 16:46:29'),
	(40, 'Arne Grimes', 'carter84@gmail.com', '$2y$10$nmANHs.OIj.MloTJKkZvgOayk1oQHY8vE.9PaGNeAjka3VhC8O4Z2', 'gleason.clementine@hotmail.com', 'USER', '+6294621942438', NULL, 'users/default.png', 0, NULL, '1974-12-10 07:59:54', '1979-02-04 07:23:20'),
	(41, 'Isaac Mante', 'madilyn.klocko@hotmail.com', '$2y$10$q.ptd1HHtG9ULF3.I2XEBu.c9yHzyFYsfhMVVhdwyAD3wwsYMRccm', 'wmante@johnson.biz', 'USER', '+4747664048666', NULL, 'users/default.png', 0, NULL, '1993-03-12 04:54:47', '1982-12-23 13:07:09'),
	(42, 'Arely Dibbert', 'ima.schmidt@hotmail.com', '$2y$10$vzm1spGTiCAMXWmFcAQcleBZGnL6Vtudg5..net24MMEPYfTdVo7W', 'zyost@hackett.com', 'USER', '+6676490494770', NULL, 'users/default.png', 0, NULL, '2011-03-01 23:26:04', '1975-10-05 03:30:38'),
	(43, 'Jody Heaney III', 'jonathan69@yahoo.com', '$2y$10$ABgGs3XxW4LYMjTowAqPDuRfoNTyEzTn8sJl7lUADlSkUjYmWv0dK', 'sbaumbach@yahoo.com', 'USER', '+9857092618181', NULL, 'users/default.png', 0, NULL, '1983-06-09 16:19:25', '1976-01-12 01:14:18'),
	(44, 'Clifton Waelchi', 'jframi@rau.com', '$2y$10$C6a0c0E7G8kCkZhJA22sY.W1k6zQhVr9DLOneTxAGcCniVo44iTHO', 'lola.wisoky@sanford.com', 'USER', '+8311685910621', NULL, 'users/default.png', 0, NULL, '1980-03-15 08:14:59', '1987-07-14 23:05:01'),
	(45, 'Prof. Freda Leffler I', 'ngoodwin@turner.info', '$2y$10$grENaCka6AMJVu7TyZ.yvehFbxselv0lnr49RKb0mfiqo3omgR6nq', 'toy.johnson@gmail.com', 'USER', '+4881521989146', NULL, 'users/default.png', 0, NULL, '2011-08-12 16:51:05', '1988-08-20 11:43:03'),
	(46, 'Providenci Hamill', 'hdonnelly@kunze.info', '$2y$10$bOq2xQvIl2dDc.jWZzroyOdljGSrN5DUjdFDzxmPfIJTrP7dM.8AG', 'oquitzon@upton.org', 'USER', '+9449424085372', NULL, 'users/default.png', 0, NULL, '1980-04-28 02:34:29', '2008-12-27 05:43:52'),
	(47, 'Pat Jenkins', 'madelynn77@yahoo.com', '$2y$10$b41d7wyPi0qYDdJfUFOgLua3LKxS.qySiZQRxsryaskIBHQqu51Eq', 'shawna89@vonrueden.com', 'USER', '+6300907257369', NULL, 'users/default.png', 0, NULL, '1995-05-31 17:20:59', '2014-11-02 17:56:46'),
	(48, 'Zora Stokes III', 'schaden.verla@lesch.com', '$2y$10$Ov0e4tF7/GEk4N9.BP5ejO6VRn0vrQbQtB6sqQGYZml0DxSgOHzr.', 'jadyn95@hotmail.com', 'USER', '+9785427527527', NULL, 'users/default.png', 0, NULL, '2007-05-03 07:15:37', '2011-06-14 01:10:17'),
	(49, 'Pearline Nolan', 'crist.hollie@leuschke.net', '$2y$10$Uy9GHrLDU1kd2sVFhR538uvCFU6kf1tB0kQ58wsVecVuZDLf7HqWi', 'lmertz@quigley.biz', 'USER', '+3401905305666', NULL, 'users/default.png', 0, NULL, '1983-09-17 09:37:18', '2005-08-24 01:12:53'),
	(50, 'Elwin Auer', 'xyundt@gmail.com', '$2y$10$Ys3BEvWgqUI63XlImpC2He1LAnXd9iWmlGUWup8Q7Na6XaiH1kWS2', 'skiles.efren@moore.com', 'USER', '+5243666823240', NULL, 'users/default.png', 0, NULL, '2001-09-10 13:55:38', '1982-07-12 07:04:47'),
	(51, 'Prof. Damian Rodriguez', 'miller.hackett@stanton.com', '$2y$10$n0zS9lis/gcqSCSiwpr7H.QyxMgBjPl11Ol48vNft/.4JHdutsoNG', 'maximillia23@gmail.com', 'USER', '+8335909159441', NULL, 'users/default.png', 0, NULL, '1977-01-26 01:30:26', '2003-01-17 12:11:23'),
	(52, 'Kaycee Windler DDS', 'kiera92@konopelski.biz', '$2y$10$SbRbpZc9t1xpvG32be29auWORefyum9ZNeVYWw9dKREUgTUH7XxVm', 'king.evalyn@hotmail.com', 'USER', '+6011204423201', NULL, 'users/default.png', 0, NULL, '1976-07-20 22:04:26', '1986-02-25 13:36:32'),
	(56, 'kincat only', 'kincat1', '$2y$10$T76tLr6hiBJPuOpIGMrg/O9DI04CuSzNl8fxmDYQqKwAlvIYN5y3a', 'kincat1@gmail.com', 'USER', '123456', '2019-12-12', 'users/default.png', 0, NULL, '2019-12-12 16:51:36', '2019-12-12 16:51:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
