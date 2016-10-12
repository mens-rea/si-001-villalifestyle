-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2016 at 10:18 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_001_onlinepos`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE IF NOT EXISTS `aauth_groups` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Tenant', 'Supplier Team'),
(3, 'Cashier', 'Sales Team'),
(5, 'Default', 'Default Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE IF NOT EXISTS `aauth_perms` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(1, 'Admin_Perm', ''),
(2, 'Tenant_Perm', ''),
(3, 'Cashier_Perm', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perm_to_group`
--

INSERT INTO `aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE IF NOT EXISTS `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE IF NOT EXISTS `aauth_pms` (
  `id` int(11) unsigned NOT NULL,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_system_variables`
--

CREATE TABLE IF NOT EXISTS `aauth_system_variables` (
  `id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE IF NOT EXISTS `aauth_users` (
  `id` bigint(20) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `letter_code` varchar(3) NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=201601000000027 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `name`, `letter_code`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `login_attempts`) VALUES
(201601000000004, 'admin@qwerty.com', 'e2ac9ce1286167667ae2bbac774a8201d5e31029cf81ef4c3031d15997371e47', 'admin', 'ADM', 0, '2016-05-16 21:32:15', '2016-05-16 21:32:15', '2016-05-16 21:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000005, 'tenant@qwerty.com', '8bd93dc687a9f7c61b145a7b7cfd70248c71271cda94ae40e278b99de2df5415', 'tenant', 'TNT', 0, '2016-05-16 21:52:36', '2016-05-16 21:52:36', '2016-05-16 21:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000006, 'cashier@qwerty.com', '7db50360b75eb6f94b3865aa3d9e53bed7b1881ebe44b575f3d7e4244824fef1', 'cashier', '', 0, '2016-05-16 03:28:29', '2016-05-16 03:28:29', '2016-05-16 03:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000007, 'uniqlo@pos.com', 'b040661a03ddc7896373f6c9024f1be0d213dde79c84c1dc1782b2f9c5060d87', 'uniqlo', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000008, 'jonsnow@got.com', '98fea8f19adb56b46c8b9b8c7d6d21607efb42267a8ebaa88b943fce42f80135', 'jonsnow', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000009, 'cashier1@pos.com', '7155ca7ecb6c86007774ed3f4655658c7f04334761c89d6e82fab07afbd67bc5', 'cashier1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000010, 'penshoppe@pos.com', 'f429b2bc0f9eed9135430941292deb123bae2ae5743857f4a967e7f43c17cf7b', 'penshoppe', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000011, 'supplier1@pos.com', '90c48ad6618e0ba6961e1a95866f8ae0fca6a05edbeddb920dca7509af9ae3bb', 'supplier1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000012, 'vondutch@pos.com', '4798160b270cd0e35025c9521cfebfc5087141accea694a013fa7ab1605b2ed7', 'vondutch', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000013, 'oxygen@pos.com', '47fb9055a1734568ed4c482fa9f8b5ce7cf2a4958e2919e521c3ec1554922592', 'oxygen', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000014, 'forever12@pos.com', '6402bb5bcbd450576b0b267cc71c88ded1f253137cf2fb3623b835eec7c6f754', 'forever21', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000015, 'forever22@pos.com', '1321d52c19f367530da98d93334793ece8c99e285a58c97691d7b0fa0d08cdac', 'forever22', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000016, 'forever23@pos.com', '1750b69bc6ea919850e4f97328d7c5d5a0a3bcae93dacfaff54b4f1a940b35ba', 'forever23', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000017, 'forever24@pos.com', '2299974e4d0989ace397160e1594f8c843e08afc58f12e8769dcbd71a15f4bd0', 'forever24', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 0),
(201601000000018, 'arianaventi@pos.com', 'dc113dcf5f384bfb395338c7fd5186bb0e69b00464a53b6aaad64e63a9c3de4c', 'arianaventi', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000019, 'arianavti@pos.com', 'eb54b60de5f0110c74598942786b329d6cfb289020dc9e9a994778426d843696', 'arianatall', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000020, 'oldnavy@pos.com', '75c11b4cfd0648e5123726ac0f6da08348051690b7db7da3faf3cdff524d9694', 'oldnavy', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000021, 'ellie@pos.com', '67814d74004f4152eaac0646a00a5009c23fa8500a3b27d2ca2c084f3155e8c3', 'ellie', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000022, 'juan.miguel.g.alvarez@gmail.com', '790dc7c1c14280d31abbbd25e45214ae15c170e7e0c7da975e35cf346f404a78', 'sampletenant', '', 0, '2016-05-10 13:32:26', '2016-05-10 13:32:26', '2016-05-10 13:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000023, 'jmalvarez@potatocodes.com', '378287ef14876f4493ae99eccbf8f9c4a6806790eca7787eb41e698acbf037b8', 'tenant4', 'TE4', 0, '2016-05-13 03:24:59', '2016-05-13 03:24:59', '2016-05-13 03:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000024, 'villa@gmail.com', 'df56f1017244d51f18b0a0609a6f83d37488955b06f51a8f7997a86b2e6f2a8f', 'tenant5', 'TE5', 0, '2016-05-14 12:10:48', '2016-05-14 12:10:48', '2016-05-14 12:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL),
(201601000000025, 'sample@gmail.com', '3ee7b23365a8c6948d6473e10494e42e7ad8fe6ab9cec51906d97f4876bd9a46', 'tenant6', 'TE6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(201601000000026, 'vanillabreezeclothing@yahoo.com.ph', 'd04b30718f20793d61c45b909782580fc0c40c99b87a3374863dba08999fe91a', 'VANILLABREEZECLOTHING', 'VBC', 0, '2016-05-16 21:52:56', '2016-05-16 21:52:56', '2016-05-16 21:00:00', NULL, NULL, NULL, NULL, NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE IF NOT EXISTS `aauth_user_to_group` (
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(201601000000004, 1),
(201601000000005, 2),
(201601000000006, 3),
(201601000000010, 4),
(201601000000011, 4),
(201601000000012, 2),
(201601000000012, 4),
(201601000000013, 2),
(201601000000013, 4),
(201601000000014, 2),
(201601000000015, 2),
(201601000000016, 2),
(201601000000017, 2),
(201601000000018, 3),
(201601000000018, 5),
(201601000000019, 3),
(201601000000019, 5),
(201601000000020, 2),
(201601000000020, 5),
(201601000000021, 3),
(201601000000021, 5),
(201601000000022, 2),
(201601000000022, 5),
(201601000000023, 2),
(201601000000023, 5),
(201601000000024, 2),
(201601000000024, 5),
(201601000000025, 2),
(201601000000025, 5),
(201601000000026, 2),
(201601000000026, 5);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE IF NOT EXISTS `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `overwatch_expense`
--

CREATE TABLE IF NOT EXISTS `overwatch_expense` (
  `expense_id` bigint(20) NOT NULL,
  `expense_amount` float DEFAULT NULL,
  `expense_name` varchar(250) DEFAULT NULL,
  `expense_category` varchar(250) DEFAULT NULL,
  `expense_date_acquired` date DEFAULT NULL,
  `expense_date_input` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1202000000101 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overwatch_expense`
--

INSERT INTO `overwatch_expense` (`expense_id`, `expense_amount`, `expense_name`, `expense_category`, `expense_date_acquired`, `expense_date_input`) VALUES
(1202000000008, 1000, 'John Dave Villaluz', 'Salary', '2015-10-26', '2015-11-03'),
(1202000000009, 1000, 'Ems Mosqueriola', 'Salary', '2015-10-26', '2015-11-03'),
(1202000000010, 100, 'JM Alvarez', 'Transportation', '2015-10-26', '2015-11-03'),
(1202000000011, 4500, 'Ems Mosqueriola (JFFC Seminar)', 'JFFC Seminar', '2015-10-26', '2015-11-03'),
(1202000000012, 1500, 'Ems Mosqueriola', 'Forwarded Salary', '2015-10-26', '2015-11-03'),
(1202000000013, 2800, 'Hikari Umikawa', 'Salary', '2015-10-28', '2015-11-03'),
(1202000000014, 1000, 'Lyzh Agbayani', 'Salary', '2015-10-26', '2015-11-03'),
(1202000000015, 2000, 'RR Joson', 'Salary', '2015-10-29', '2015-11-03'),
(1202000000017, 500, 'John Dave Villaluz', 'Salary', '2015-10-29', '2015-11-03'),
(1202000000018, 100, 'JM Alvarez', 'Food Expense ', '2015-10-29', '2015-11-03'),
(1202000000019, 758, 'Zoning/Locational-Processing Fee', 'Permits', '2015-10-30', '2015-11-03'),
(1202000000020, 250, 'John Dave Villaluz', 'Salary', '2015-10-30', '2015-11-03'),
(1202000000021, 3100, 'SEAGATE 1TB External Drive ', 'Hardware', '2015-10-30', '2015-11-03'),
(1202000000023, 1875, 'BIR Registration Fee w/ Late Filing', 'Permits', '2015-11-04', '2015-11-05'),
(1202000000024, 50, 'Photocopy for BIR Documents', 'Permits', '2015-11-04', '2015-11-05'),
(1202000000025, 98, 'Snacks Jackos Burger for 2', 'Food', '2015-11-04', '2015-11-05'),
(1202000000026, 250, 'Dave Compensation', 'Salary', '2015-11-04', '2015-11-05'),
(1202000000027, 250, 'John Dave Villaluz', 'Salary', '2015-11-05', '2015-11-06'),
(1202000000028, 150, 'Snacks Burger', 'Food', '2015-11-05', '2015-11-06'),
(1202000000029, 100, 'Notary', 'Project Documents', '2015-11-05', '2015-11-06'),
(1202000000030, 5415, 'Mayors Business Permit', 'Permits', '2015-11-03', '2015-11-06'),
(1202000000031, 500, 'Cedula', 'Permits', '2015-11-03', '2015-11-06'),
(1202000000032, 50, 'Photocopy of SEC Files and Business Permit', 'Permits', '2015-11-04', '2015-11-06'),
(1202000000033, 2500, 'John Dave Villaluz KSoft Project Management Final Fee', 'Project Expense', '2015-11-05', '2015-11-06'),
(1202000000034, 200, 'NGOHS Trip Fund', 'Project Expense', '2015-11-06', '2015-11-07'),
(1202000000035, 200, 'JCFAP Snacks', 'Project Expense', '2015-11-05', '2015-11-07'),
(1202000000036, 6500, 'Ems Initial November Salary', 'Salary', '2015-11-01', '2015-11-08'),
(1202000000037, 7500, 'Ems Final October Salary', 'Salary', '2015-10-15', '2015-11-08'),
(1202000000038, 7500, 'Ems Initial October Salary', 'Salary', '2015-10-01', '2015-11-08'),
(1202000000039, 7500, 'Ems Final September Salary', 'Salary', '2015-09-15', '2015-11-08'),
(1202000000040, 7500, 'Ems Initial September Salary', 'Salary', '2015-09-01', '2015-11-08'),
(1202000000041, 7500, 'Ems Final August Salary', 'Salary', '2015-08-15', '2015-11-08'),
(1202000000042, 7500, 'Ems Initial August Salary', 'Salary', '2015-08-01', '2015-11-08'),
(1202000000043, 6000, 'JM Final October Salary', 'Salary', '2015-10-15', '2015-11-08'),
(1202000000044, 6000, 'JM Initial October Salary', 'Salary', '2015-10-01', '2015-11-08'),
(1202000000045, 17000, 'Sony VAIO Laptop', 'Hardware', '2015-09-04', '2015-11-08'),
(1202000000046, 13599, 'Refurbished Apple iPhone 5 16GB (White)', 'Hardware', '2015-08-30', '2015-11-08'),
(1202000000047, 829, 'ET-POP E-102 20000mAh Li-Polymer Power Bank (Multicolor)', 'Hardware', '2015-08-30', '2015-11-08'),
(1202000000048, 799, 'Case-Mate Faux Brushed Aluminium Case for Apple iPhone 5/5s (Silver)', 'Hardware', '2015-09-20', '2015-11-08'),
(1202000000049, 692.79, 'Ems', 'Monday Meeting - Wings and Things', '2015-11-09', '2015-11-10'),
(1202000000050, 240, 'Monday Meeting Banapple', 'Food', '2015-11-09', '2015-11-10'),
(1202000000051, 696.27, 'Sun Broadband', 'Internet', '2015-11-09', '2015-11-10'),
(1202000000052, 205, 'Pasta', 'Food', '2015-09-01', '2015-11-12'),
(1202000000053, 120, 'Lunch', 'Food', '2015-09-01', '2015-11-12'),
(1202000000054, 75, 'Coffee', 'Food', '2015-09-02', '2015-11-12'),
(1202000000055, 400, 'Lunch', 'Food', '2015-09-02', '2015-11-12'),
(1202000000056, 18, 'Transportation', 'Transportation', '2015-09-02', '2015-11-12'),
(1202000000057, 85, 'Tapa King', 'Food', '2015-09-04', '2015-11-12'),
(1202000000058, 110, 'Sansrival', 'Food', '2015-09-04', '2015-11-12'),
(1202000000059, 135, 'Oreo Cheesecake', 'Food', '2015-09-04', '2015-11-12'),
(1202000000060, 60, 'Hotdog', 'Food', '2015-09-06', '2015-11-12'),
(1202000000061, 273, 'Mercury Drug', 'Food', '2015-09-05', '2015-11-12'),
(1202000000062, 330, 'Food', 'Food', '2015-09-05', '2015-11-12'),
(1202000000063, 1000, 'Core Team Meeting-Maginhawa', 'Team Meeting Lunch', '2016-01-04', '2016-02-09'),
(1202000000064, 3598, '2 Chairs', 'Office Equipment', '2016-01-04', '2016-02-09'),
(1202000000065, 100, 'Lunch at Office', 'Lunch at Office', '2016-01-05', '2016-02-09'),
(1202000000066, 1089.2, 'Office Supplies', 'Office Supplies', '2016-01-05', '2016-02-09'),
(1202000000067, 1000, 'Electric Bill', 'Bill', '2016-01-06', '2016-02-09'),
(1202000000068, 1000, 'Facebook Boost Post', 'Bill', '2016-01-06', '2016-02-09'),
(1202000000069, 3200, 'Ideastalk Domain', 'Bill', '2016-01-06', '2016-02-09'),
(1202000000070, 100, 'Lunch at Office', 'Food', '2016-01-07', '2016-02-09'),
(1202000000071, 2200, 'White Board', 'Office Equipment', '2016-01-07', '2016-02-09'),
(1202000000072, 100, 'Transpo-White Board', 'Transpo', '2016-01-07', '2016-02-09'),
(1202000000073, 1950, 'White Board', 'Office Equipment', '2016-01-08', '2016-02-09'),
(1202000000074, 123.5, 'Office Supplies', 'Office Supplies', '2016-01-08', '2016-02-09'),
(1202000000075, 100, 'Transpo-White Board', 'Transpo', '2016-01-08', '2016-02-09'),
(1202000000076, 1064, 'Lunch-UST Team Meeting', 'Food', '2016-01-09', '2016-02-09'),
(1202000000077, 7950, 'Printer', 'Office Equipment', '2016-01-09', '2016-02-09'),
(1202000000078, 597, 'Flashdrive', 'Office Equipment', '2016-01-09', '2016-02-09'),
(1202000000079, 1330, 'Probox', 'Office Equipment', '2016-01-09', '2016-02-09'),
(1202000000080, 100, 'Lunch at Office', 'Food', '2016-01-11', '2016-02-09'),
(1202000000081, 100, 'Lunch at Office', 'Food', '2016-01-12', '2016-02-09'),
(1202000000082, 2449, 'SanDisk SSD Plus 120GB', 'Office Equipment', '2016-01-13', '2016-02-09'),
(1202000000083, 100, 'Lunch at Office', 'Food', '2016-01-14', '2016-02-09'),
(1202000000084, 100, 'Lunch at Office', 'Food', '2016-01-15', '2016-02-09'),
(1202000000085, 40, 'Transpo-Processing of Documents', 'Transpo', '2016-01-18', '2016-02-09'),
(1202000000086, 2380, 'Ems-Globe Bill', 'Bill', '2016-01-18', '2016-02-09'),
(1202000000087, 20, 'OYSI Meeting', 'Transpo', '2016-01-21', '2016-02-09'),
(1202000000088, 100, 'Transpo-PhilStar Meeting', 'Transpo', '2016-01-22', '2016-02-09'),
(1202000000089, 100, 'Lunch at Office', 'Food', '2016-01-25', '2016-02-09'),
(1202000000090, 36, 'Printing of Documents', 'Printing/Photocopy', '2016-01-14', '2016-02-09'),
(1202000000091, 16000, 'Security Tools (SSL,Site Doctor)', 'Office Equipment', '2016-01-29', '2016-02-09'),
(1202000000092, 1500, 'Lunch-Marketing Meeting', 'Food', '2016-01-30', '2016-02-09'),
(1202000000093, 3000, 'Salary-RR', 'Salary', '2016-01-30', '2016-02-09'),
(1202000000094, 3000, 'Salary-Lyzh', 'Salary', '2016-01-30', '2016-02-09'),
(1202000000095, 30, 'Coin Envelope', 'Office Supplies', '2015-11-11', '2016-02-09'),
(1202000000096, 10000, 'Salary-Ems', 'Salary', '2016-01-15', '2016-02-09'),
(1202000000097, 4000, 'Salary-Dave', 'Salary', '2016-01-15', '2016-02-09'),
(1202000000098, 8000, 'Salary-JM', 'Salary', '2016-01-15', '2016-02-09'),
(1202000000099, 100, 'Notary', 'Notary', '2016-02-05', '2016-02-09'),
(1202000000100, 1514, 'Dave-Globe Bill', 'Bill', '2015-12-15', '2016-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `overwatch_income`
--

CREATE TABLE IF NOT EXISTS `overwatch_income` (
  `income_id` bigint(20) NOT NULL,
  `income_amount` float DEFAULT NULL,
  `income_name` varchar(250) DEFAULT NULL,
  `income_date_acquired` date DEFAULT NULL,
  `income_date_input` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1201000000120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overwatch_income`
--

INSERT INTO `overwatch_income` (`income_id`, `income_amount`, `income_name`, `income_date_acquired`, `income_date_input`) VALUES
(1201000000050, 64000, 'EP15013 - Prime Listings Manila Intiial Payment', '2015-10-26', '2015-11-05'),
(1201000000051, 24000, 'EP15012 - Krisfin Software Initial Payment', '2015-10-20', '2015-11-05'),
(1201000000052, 30000, 'EP15014 - MPRCC Realty Initial Payment', '2015-10-30', '2015-11-05'),
(1201000000053, 40.78, 'BDO Interest', '2015-09-30', '2015-11-05'),
(1201000000054, 2500, 'JFFC Honorarium', '2015-10-19', '2015-11-05'),
(1201000000055, 196000, 'EP15010 - UST Museum Initial Payment and EP15005 - UST OAR Final Payment', '2015-08-14', '2015-11-05'),
(1201000000056, 1200, 'Capital', '2015-08-19', '2015-11-05'),
(1201000000057, 3000, 'Capital', '2015-08-14', '2015-11-05'),
(1201000000058, 28.75, 'BDO Interest', '2015-07-31', '2015-11-05'),
(1201000000059, 9000, 'EP15008 - MTCI', '2015-07-31', '2015-11-05'),
(1201000000061, 8250, 'PPP03 - Goldbull Final Payment', '2015-07-30', '2015-11-05'),
(1201000000062, 10360, 'EP15009 - JCFAP', '2015-07-29', '2015-11-05'),
(1201000000063, 2100, 'Capital', '2015-07-13', '2015-11-05'),
(1201000000064, 1500, 'Capital', '2015-07-13', '2015-11-05'),
(1201000000065, 3000, 'Capital', '2015-07-06', '2015-11-05'),
(1201000000066, 1000, 'Capital', '2015-07-06', '2015-11-05'),
(1201000000067, 10000, 'EP15008 - MTCI Initial Payment', '2015-07-03', '2015-11-05'),
(1201000000068, 9.44, 'BDO Interest', '2015-06-30', '2015-11-05'),
(1201000000069, 58800, 'UST OAR Initial Payment', '2015-06-26', '2015-11-05'),
(1201000000070, 30000, 'EP15006 - PAGE Initial Payment', '2015-06-26', '2015-11-05'),
(1201000000071, 30000, 'Capital', '2015-06-23', '2015-11-05'),
(1201000000072, 5000, 'Capital', '2015-06-17', '2015-11-05'),
(1201000000073, 1000, 'Capital', '2015-06-11', '2015-11-05'),
(1201000000074, 500, 'Capital', '2015-06-10', '2015-11-05'),
(1201000000075, 4.46, 'BDO Interest', '2015-05-31', '2015-11-05'),
(1201000000076, 10000, 'Capital', '2015-05-27', '2015-11-05'),
(1201000000077, 20000, 'EP15003 - NGOHS Initial Payment', '2015-05-27', '2015-11-05'),
(1201000000079, 25800, 'EP15001 - OYSI Final Payment', '2015-05-19', '2015-11-05'),
(1201000000080, 15000, 'PPP10 - Wilfoto Final Payment', '2015-05-08', '2015-11-05'),
(1201000000081, 2.05, 'BDO Interest', '2015-04-30', '2015-11-05'),
(1201000000082, 2.18, 'BDO Interest', '2015-03-31', '2015-11-05'),
(1201000000083, 9000, 'PPP10 - Wilfoto Initial Payment', '2015-03-30', '2015-11-05'),
(1201000000084, 4000, 'EP15007 - VGIB Payment', '2015-02-23', '2015-11-05'),
(1201000000085, 2.2, 'BDO Interest', '2015-01-31', '2015-11-05'),
(1201000000086, 1.96, 'BDO Interest', '2015-02-28', '2015-11-05'),
(1201000000087, 83.95, 'Capital', '2015-01-29', '2015-11-05'),
(1201000000088, 39200, 'PPP06 - UST Graduate School', '2015-01-23', '2015-11-05'),
(1201000000089, 2.41, 'BDO Interest', '2014-12-31', '2015-11-05'),
(1201000000090, 10000, 'PPP08 - Mikka Marcaida Final Payment', '2014-11-10', '2015-11-05'),
(1201000000091, 2.46, 'BDO Interest', '2014-11-30', '2015-11-05'),
(1201000000092, 2.7, 'BDO Interest', '2014-10-31', '2015-11-05'),
(1201000000093, 10000, 'PPP08 - Mikka Marcaida Initial Payment', '2014-10-20', '2015-11-05'),
(1201000000094, 20000, 'Capital', '2014-10-14', '2015-11-05'),
(1201000000095, 4.12, 'BDO Interest', '2014-09-30', '2015-11-05'),
(1201000000096, 34300, 'PPP02 - UST FPSC  Payment', '2014-09-05', '2015-11-05'),
(1201000000097, 39200, 'PPP06 - UST Graduate School Initial Payment', '2014-09-05', '2015-11-05'),
(1201000000098, 5000, 'PPP04 - Croque Final Payment', '2014-09-01', '2015-11-05'),
(1201000000099, 2.61, 'BDO Interest', '2014-08-31', '2015-11-05'),
(1201000000100, 17500, 'PPP02 - UST FPSC Initial Payment', '2014-08-26', '2015-11-05'),
(1201000000101, 3000, 'Capital', '2014-08-18', '2015-11-05'),
(1201000000102, 2.27, 'BDO Interest', '2014-07-31', '2015-11-05'),
(1201000000103, 8250, 'PPP03 - Goldbull Initial Payment', '2014-07-28', '2015-11-05'),
(1201000000104, 3500, 'Capital', '2014-07-14', '2015-11-05'),
(1201000000105, 3500, 'Capital', '2014-07-08', '2015-11-05'),
(1201000000106, 10000, 'Capital', '2014-07-08', '2015-11-05'),
(1201000000107, 30.4, 'BDO Interest', '2015-10-31', '2015-11-07'),
(1201000000108, 5000, 'EP15009 - JCFAP Final Payment', '2015-11-02', '2015-11-07'),
(1201000000109, 12500, 'Unknown', '2015-09-15', '2015-11-07'),
(1201000000110, 11000, 'Unknown', '2015-09-15', '2015-11-07'),
(1201000000111, 38.34, 'BDO Interest', '2015-08-31', '2015-11-07'),
(1201000000112, 10000, 'PPP07 - Dweller Final Payment', '2014-12-12', '2015-11-07'),
(1201000000113, 30000, 'PAGE website final payment', '2015-12-11', '2016-01-03'),
(1201000000114, 20000, 'MPRCC Realty Final Payment', '2015-12-02', '2016-01-03'),
(1201000000115, 92507, 'Initial Payment-PhilStar', '2016-01-22', '2016-02-09'),
(1201000000116, 8820, 'Final Payment-GradSchool Add-On', '2016-02-05', '2016-02-09'),
(1201000000117, 99715, 'Initial Payment-UTS Main Website', '2016-01-15', '2016-02-09'),
(1201000000118, 20000, 'KrisFin Software Final Payment', '2015-12-09', '2016-02-12'),
(1201000000119, 2500, 'Seminar Workshop Fee', '2015-10-19', '2016-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `overwatch_project`
--

CREATE TABLE IF NOT EXISTS `overwatch_project` (
  `project_id` bigint(20) NOT NULL,
  `project_name` varchar(250) NOT NULL,
  `project_personnel` varchar(250) NOT NULL,
  `project_deadline` date NOT NULL,
  `project_budget` float NOT NULL,
  `project_input` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1204000000014 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overwatch_project`
--

INSERT INTO `overwatch_project` (`project_id`, `project_name`, `project_personnel`, `project_deadline`, `project_budget`, `project_input`) VALUES
(1204000000010, 'Prime Listings Manila - EP15013', 'RR, Dave, Ems, JM', '2016-03-01', 20000, '2016-01-12'),
(1204000000011, 'UST Main Website - EP15016', 'JM, Nikko, Ems, Aaron, Dave, Renzo', '2016-05-31', 20000, '2016-01-12'),
(1204000000012, 'JCFAP - EP15009', 'JM', '2016-01-15', 0, '2016-01-12'),
(1204000000013, 'ASEACCU', 'Dave, Ems, Jm, Lyzh', '2016-03-21', 20, '2016-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `overwatch_withdrawal`
--

CREATE TABLE IF NOT EXISTS `overwatch_withdrawal` (
  `withdrawal_id` bigint(250) NOT NULL,
  `withdrawal_name` varchar(250) NOT NULL,
  `withdrawal_amount` float NOT NULL,
  `withdrawal_date_acquired` date NOT NULL,
  `withdrawal_date_input` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1203000000103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overwatch_withdrawal`
--

INSERT INTO `overwatch_withdrawal` (`withdrawal_id`, `withdrawal_name`, `withdrawal_amount`, `withdrawal_date_acquired`, `withdrawal_date_input`) VALUES
(1203000000007, 'JM Alvarez', 5000, '2015-10-30', '2015-11-03'),
(1203000000014, 'JM Alvarez', 5000, '2015-10-20', '2015-11-04'),
(1203000000017, 'Auxillary Funds and JCFFC Honorarium', 12500, '2015-10-20', '2015-11-04'),
(1203000000018, 'JM Alvarez', 1000, '2015-10-16', '2015-11-04'),
(1203000000019, 'JM Alvarez', 5000, '2015-10-13', '2015-11-04'),
(1203000000021, 'Funding October 2nd Half', 25000, '2015-10-12', '2015-11-05'),
(1203000000022, 'JM Alvarez', 5000, '2015-10-06', '2015-11-05'),
(1203000000023, 'BDO', 8.16, '2015-09-30', '2015-11-05'),
(1203000000024, 'JM Alvarez', 5000, '2015-09-30', '2015-11-05'),
(1203000000025, 'November Auxillary Funds', 10000, '2015-11-04', '2015-11-05'),
(1203000000026, 'Funding October 1st Half', 12000, '2015-09-30', '2015-11-05'),
(1203000000028, 'Funding October 1st Half', 17500, '2015-09-28', '2015-11-05'),
(1203000000030, 'JM Alvarez', 3000, '2015-09-17', '2015-11-05'),
(1203000000031, 'September Auxillary Funds', 12500, '2015-09-14', '2015-11-05'),
(1203000000032, 'Funding September', 87100, '2015-09-01', '2015-11-05'),
(1203000000033, 'BDO', 7.67, '2015-08-31', '2015-11-05'),
(1203000000034, 'Auxillary Funds', 20000, '2015-08-20', '2015-11-05'),
(1203000000035, 'Funding August 2nd Half', 10000, '2015-08-12', '2015-11-06'),
(1203000000036, 'Funding August 2nd Half', 10000, '2015-08-12', '2015-11-07'),
(1203000000037, 'JM Alvarez', 6000, '2015-08-11', '2015-11-07'),
(1203000000038, 'BDO', 5.75, '2015-07-31', '2015-11-07'),
(1203000000039, 'Funding August 1st Half', 25000, '2015-07-31', '2015-11-07'),
(1203000000040, 'JM Alvarez', 10000, '2015-07-20', '2015-11-07'),
(1203000000042, 'JM Alvarez', 1500, '2015-07-13', '2015-11-07'),
(1203000000043, 'Funding July 2nd Half', 15000, '2015-07-13', '2015-11-07'),
(1203000000044, 'Funding July 2nd Half', 20000, '2015-07-06', '2015-11-07'),
(1203000000045, 'BDO', 1.89, '2015-06-30', '2015-11-07'),
(1203000000046, 'JM Alvarez', 4000, '2015-06-15', '2015-11-07'),
(1203000000047, 'Funding June 2nd Half', 15000, '2015-06-11', '2015-11-07'),
(1203000000048, 'Funding July 1st Half', 15000, '2015-06-01', '2015-11-07'),
(1203000000049, 'BDO', 0.89, '2015-05-31', '2015-11-07'),
(1203000000050, 'JM Alvarez', 5000, '2015-05-29', '2015-11-07'),
(1203000000051, 'JM Alvarez', 10000, '2015-05-08', '2015-11-07'),
(1203000000052, 'JM Alvarez', 5000, '2015-05-08', '2015-11-07'),
(1203000000053, 'BDO', 0.41, '2015-04-30', '2015-11-07'),
(1203000000054, 'BDO', 0.44, '2015-03-31', '2015-11-07'),
(1203000000055, 'JM Alvarez', 9000, '2015-03-31', '2015-11-07'),
(1203000000056, 'BDO', 0.39, '2015-02-28', '2015-11-07'),
(1203000000057, 'JM Alvarez', 4090, '2015-02-24', '2015-11-07'),
(1203000000058, 'BDO', 0.44, '2015-01-31', '2015-11-07'),
(1203000000059, 'JM Alvarez', 39200, '2015-01-28', '2015-11-07'),
(1203000000060, 'JM Alvarez', 2000, '2015-01-06', '2015-11-07'),
(1203000000061, 'BDO', 0.48, '2014-12-31', '2015-11-07'),
(1203000000062, 'JM Alvarez', 4000, '2014-12-18', '2015-11-07'),
(1203000000063, 'JM Alvarez', 4000, '2014-12-17', '2015-11-07'),
(1203000000064, 'BDO', 0.49, '2014-11-30', '2015-11-07'),
(1203000000065, 'JM Alvarez', 16000, '2014-11-10', '2015-11-07'),
(1203000000066, 'BDO', 0.54, '2014-10-31', '2015-11-07'),
(1203000000067, 'JM Alvarez', 4100, '2014-10-23', '2015-11-07'),
(1203000000068, 'JM Alvarez', 4000, '2014-10-20', '2015-11-07'),
(1203000000069, 'JM Alvarez', 16000, '2014-10-14', '2015-11-07'),
(1203000000070, 'BDO', 0.82, '2014-09-30', '2015-11-07'),
(1203000000071, 'JM Alvarez', 8000, '2014-09-30', '2015-11-07'),
(1203000000072, 'JM Alvarez', 2750, '2014-09-29', '2015-11-07'),
(1203000000073, 'JM Alvarez', 3030, '2014-09-23', '2015-11-07'),
(1203000000074, 'JM Alvarez', 1864, '2014-09-10', '2015-11-07'),
(1203000000075, 'JM Alvarez', 11109, '2014-09-10', '2015-11-07'),
(1203000000076, 'JM Alvarez', 11109, '2014-09-10', '2015-11-07'),
(1203000000077, 'JM Alvarez', 11109, '2014-09-10', '2015-11-07'),
(1203000000078, 'JM Alvarez', 11109, '2014-09-10', '2015-11-07'),
(1203000000079, 'JM Alvarez', 17500, '2014-09-10', '2015-11-07'),
(1203000000080, 'JM Alvarez', 5000, '2014-09-02', '2015-11-07'),
(1203000000081, 'JM Alvarez', 2325, '2014-09-01', '2015-11-07'),
(1203000000082, 'BDO', 0.52, '2014-08-31', '2015-11-07'),
(1203000000083, 'JM Alvarez', 14000, '2014-08-26', '2015-11-07'),
(1203000000084, 'JM Alvarez', 3650, '2014-08-04', '2015-11-07'),
(1203000000085, 'BDO', 0.45, '2014-07-31', '2015-11-07'),
(1203000000086, 'JM Alvarez', 1600, '2014-07-30', '2015-11-07'),
(1203000000087, 'JM Alvarez', 5000, '2014-07-30', '2015-11-07'),
(1203000000088, 'JM Alvarez', 3000, '2014-07-21', '2015-11-07'),
(1203000000089, 'JM Alvarez', 2000, '2014-07-18', '2015-11-07'),
(1203000000090, 'Funding November 1st Half', 40000, '2015-10-26', '2015-11-07'),
(1203000000091, 'Funding November 2nd Half', 30000, '2015-11-13', '2016-01-03'),
(1203000000092, 'Funding December 1st Half', 40000, '2015-11-27', '2016-01-03'),
(1203000000093, 'Auxillary Fund', 5000, '2015-12-11', '2016-01-03'),
(1203000000094, 'Auxillary Fund', 5000, '2015-12-14', '2016-01-03'),
(1203000000095, 'Funding December 2nd Half', 9568, '2015-12-15', '2016-01-03'),
(1203000000096, 'Juan Miguel G. Alvarez', 15000, '2016-01-07', '2016-02-12'),
(1203000000097, 'Juan Miguel G. Alvarez', 30000, '2016-01-13', '2016-02-12'),
(1203000000098, 'Juan Miguel G. Alvarez', 50000, '2016-01-28', '2016-02-12'),
(1203000000099, 'BDO', 6.4, '2016-01-31', '2016-02-12'),
(1203000000100, 'Juan Miguel G. Alvarez', 20000, '2016-02-10', '2016-02-12'),
(1203000000101, 'Juan Miguel G. Alvarez', 50000, '2016-01-04', '2016-02-12'),
(1203000000102, 'Auxiliary Funds', 1000, '2015-10-16', '2016-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `pos_category`
--

CREATE TABLE IF NOT EXISTS `pos_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_category`
--

INSERT INTO `pos_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'T-Shirt', 1),
(2, 'Pants', 1),
(3, 'Shorts', 1),
(4, 'Skirt', 1),
(5, 'Jacket', 1),
(6, 'Socks', 1),
(7, 'foot socks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos_delivery`
--

CREATE TABLE IF NOT EXISTS `pos_delivery` (
  `delivery_id` bigint(20) NOT NULL,
  `delivery_item` bigint(20) NOT NULL,
  `delivery_quantity` double NOT NULL,
  `delivery_dt` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201606000000063 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_delivery`
--

INSERT INTO `pos_delivery` (`delivery_id`, `delivery_item`, `delivery_quantity`, `delivery_dt`) VALUES
(201606000000001, 201602000000007, 5, 201608000000001),
(201606000000002, 201602000000008, 5, 201608000000001),
(201606000000003, 0, 3, 201608000000004),
(201606000000004, 0, 0, 201608000000004),
(201606000000005, 201602000000020, 5, 201608000000005),
(201606000000006, 201602000000016, 5, 201608000000006),
(201606000000007, 201602000000017, 5, 201608000000006),
(201606000000008, 201602000000016, 5, 201608000000007),
(201606000000009, 201602000000017, 5, 201608000000007),
(201606000000010, 201602000000009, 1, 201608000000008),
(201606000000011, 201602000000001, 1, 201608000000008),
(201606000000012, 201602000000002, 1, 201608000000008),
(201606000000013, 201602000000002, 1, 201608000000009),
(201606000000014, 201602000000001, 1, 201608000000009),
(201606000000015, 201602000000002, 1, 201608000000010),
(201606000000016, 201602000000004, 1, 201608000000010),
(201606000000017, 201602000000001, 1, 201608000000011),
(201606000000018, 201602000000003, 1, 201608000000011),
(201606000000019, 201602000000002, 1, 201608000000011),
(201606000000020, 201602000000001, 1, 201608000000012),
(201606000000021, 201602000000001, 1, 201608000000012),
(201606000000022, 201602000000001, 1, 201608000000014),
(201606000000023, 201602000000004, 1, 201608000000014),
(201606000000024, 201602000000006, 1, 201608000000014),
(201606000000025, 201602000000002, 1, 201608000000014),
(201606000000026, 201602000000001, 1, 201608000000015),
(201606000000027, 201602000000002, 1, 201608000000015),
(201606000000028, 201602000000003, 1, 201608000000015),
(201606000000029, 201602000000001, 1, 201608000000016),
(201606000000030, 201602000000003, 1, 201608000000016),
(201606000000031, 201602000000001, 1, 201608000000017),
(201606000000032, 201602000000002, 1, 201608000000017),
(201606000000033, 201602000000001, 1, 201608000000018),
(201606000000034, 201602000000002, 1, 201608000000019),
(201606000000035, 201602000000001, 1, 201608000000020),
(201606000000036, 201602000000001, 1, 201608000000021),
(201606000000037, 201602000000002, 1, 201608000000022),
(201606000000038, 201602000000001, 1, 201608000000022),
(201606000000039, 201602000000001, 1, 201608000000023),
(201606000000040, 201602000000001, 1, 201608000000024),
(201606000000041, 201602000000002, 1, 201608000000024),
(201606000000042, 201602000000022, 1, 201608000000025),
(201606000000043, 201602000000022, 1, 201608000000026),
(201606000000044, 201602000000022, 1, 201608000000027),
(201606000000045, 201602000000022, 1, 201608000000028),
(201606000000046, 201602000000002, 1, 201608000000028),
(201606000000047, 201602000000002, 1, 201608000000029),
(201606000000048, 201602000000002, 1, 201608000000029),
(201606000000049, 201602000000002, 1, 201608000000030),
(201606000000050, 201602000000002, 3, 201608000000031),
(201606000000051, 201602000000001, 2, 201608000000032),
(201606000000052, 201602000000002, 5, 201608000000033),
(201606000000053, 201602000000001, 5, 201608000000034),
(201606000000054, 201602000000002, 5, 201608000000035),
(201606000000055, 201602000000001, 10, 201608000000035),
(201606000000056, 201602000000001, 2, 201608000000036),
(201606000000057, 201602000000003, 4, 201608000000036),
(201606000000058, 201602000000001, 1, 201608000000037),
(201606000000059, 201602000000002, 3, 201608000000037),
(201606000000060, 201602000000001, 3, 201608000000038),
(201606000000061, 201602000000002, 4, 201608000000038),
(201606000000062, 201602000000032, 30, 201608000000039);

-- --------------------------------------------------------

--
-- Table structure for table `pos_delivery_transaction`
--

CREATE TABLE IF NOT EXISTS `pos_delivery_transaction` (
  `dt_id` bigint(20) NOT NULL,
  `dt_supplier` varchar(30) NOT NULL,
  `dt_total_quantity` int(11) NOT NULL,
  `dt_date` date NOT NULL,
  `dt_approve_date` date NOT NULL,
  `dt_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201608000000040 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_delivery_transaction`
--

INSERT INTO `pos_delivery_transaction` (`dt_id`, `dt_supplier`, `dt_total_quantity`, `dt_date`, `dt_approve_date`, `dt_status`) VALUES
(201608000000001, '201605000000001', 10, '2016-04-29', '2016-05-07', 1),
(201608000000002, '201605000000002', 0, '2016-04-29', '2016-05-08', 1),
(201608000000003, '201605000000003', 0, '2016-05-04', '2016-05-08', 1),
(201608000000004, '201605000000003', 0, '2016-05-04', '0000-00-00', 0),
(201608000000005, '201605000000003', 5, '2016-05-07', '0000-00-00', 0),
(201608000000006, '201605000000003', 10, '2016-05-08', '0000-00-00', 0),
(201608000000007, '201605000000003', 10, '2016-05-08', '0000-00-00', 0),
(201608000000008, '201605000000001', 3, '2016-05-09', '0000-00-00', 0),
(201608000000009, '201605000000001', 2, '2016-05-09', '0000-00-00', 0),
(201608000000010, '201605000000001', 2, '2016-05-09', '0000-00-00', 0),
(201608000000011, '201605000000001', 3, '2016-05-09', '0000-00-00', 0),
(201608000000012, '201605000000001', 2, '2016-05-10', '2016-05-10', 1),
(201608000000013, '201605000000001', 0, '2016-05-11', '0000-00-00', 0),
(201608000000014, '201605000000001', 4, '2016-05-11', '0000-00-00', 0),
(201608000000015, '201605000000001', 3, '2016-05-11', '0000-00-00', 0),
(201608000000016, '201605000000001', 2, '2016-05-11', '0000-00-00', 0),
(201608000000017, 'tenant5', 2, '2016-05-11', '2016-05-11', 1),
(201608000000018, 'tenant5', 1, '2016-05-12', '0000-00-00', 2),
(201608000000019, 'tenant', 1, '2016-05-12', '0000-00-00', 2),
(201608000000020, 'tenant', 1, '2016-05-12', '2016-05-14', 1),
(201608000000021, 'tenant4', 1, '2016-05-12', '0000-00-00', 2),
(201608000000022, 'tenant', 2, '2016-05-13', '2016-05-14', 1),
(201608000000023, 'tenant', 1, '2016-05-14', '0000-00-00', 2),
(201608000000024, 'tenant', 2, '2016-05-14', '0000-00-00', 2),
(201608000000025, 'tenant', 2, '2016-05-14', '0000-00-00', 0),
(201608000000026, 'tenant', 2, '2016-05-14', '0000-00-00', 0),
(201608000000027, 'tenant', 1, '2016-05-14', '0000-00-00', 0),
(201608000000028, 'tenant', 3, '2016-05-14', '0000-00-00', 0),
(201608000000029, 'tenant', 2, '2016-05-14', '0000-00-00', 0),
(201608000000030, 'tenant', 1, '2016-05-14', '0000-00-00', 0),
(201608000000031, 'tenant', 12, '2016-05-14', '0000-00-00', 0),
(201608000000032, 'tenant', 2, '2016-05-14', '0000-00-00', 0),
(201608000000033, 'tenant', 995, '2016-05-14', '0000-00-00', 0),
(201608000000034, 'tenant', 5, '2016-05-14', '0000-00-00', 0),
(201608000000035, 'tenant', 1410, '2016-05-14', '0000-00-00', 0),
(201608000000036, 'tenant', 6, '2016-05-14', '0000-00-00', 0),
(201608000000037, 'tenant', 4, '2016-05-15', '0000-00-00', 0),
(201608000000038, 'tenant', 7, '2016-05-15', '0000-00-00', 0),
(201608000000039, 'VANILLABREEZECLOTHING', 30, '2016-05-16', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_item`
--

CREATE TABLE IF NOT EXISTS `pos_item` (
  `item_id` bigint(20) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_price` double NOT NULL,
  `item_stock` bigint(20) NOT NULL,
  `item_supplier` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201602000000033 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_item`
--

INSERT INTO `pos_item` (`item_id`, `item_name`, `item_category`, `item_price`, `item_stock`, `item_supplier`) VALUES
(201602000000001, 'Statement T-Shirt White - XS', 'T-Shirt', 359.95, 22, 'tenant'),
(201602000000002, 'Statement T-Shirt Black - XS', 'T-Shirt', 356.95, 26, 'tenant'),
(201602000000003, 'Classic Polo Tee Red - XS', 'T-Shirt', 429.75, 15, 'tenant'),
(201602000000004, 'Denim Pants Red - 28', 'Pants', 899, 13, '201605000000001'),
(201602000000005, 'Denim Pants Blue - 27', 'Pants', 899, 15, '201605000000001'),
(201602000000007, 'Hombre Twill Walking Shorts - M', 'Shorts', 599.75, 10, '201605000000001'),
(201602000000008, 'Twill Walking Shorts Green - S', 'Shorts', 499.75, 5, '201605000000001'),
(201602000000011, 'Stripped Polo Tees Blue - M', 'T-Shirt', 299.75, 3, '201605000000002'),
(201602000000012, 'Polka Dot Shorts White - XS', 'Shorts', 250, 3, '201605000000002'),
(201602000000013, 'Skater Skirt Black - M', 'Skirts', 220, 0, '201605000000002'),
(201602000000014, 'Avengers Shirt Black - L', 'T-Shirt', 300, 0, '201605000000002'),
(201602000000015, 'Pencil Skirt Blue - S', 'Skirt', 175, 0, '201605000000002'),
(201602000000016, 'Animo Jacket Green - XL', 'Jacket', 949.5, 0, '201605000000001'),
(201602000000017, 'CHT Leather Pants Black - M', 'Pants', 660, 0, '201605000000001'),
(201602000000018, 'Laced Cotton Shorts White - XS', 'Shorts', 320, 0, '201605000000001'),
(201602000000019, 'UST Schooled Jacket Gray - M', 'Jacket', 1100, 0, '201605000000001'),
(201602000000020, 'Muscle Tees White - M', 'T-Shirt', 100, 0, '201605000000001'),
(201602000000021, 'Sample Item 39', 'Tshirts', 39, 0, '0'),
(201602000000022, 'Sample Item 40', 'Tshirts', 41, 0, 'tenant'),
(201602000000023, 'Sample Item 41', 'Tshirts', 33, 0, 'tenant'),
(201602000000025, 'Sample Item 46', 'Tshirts', 46.75, 0, 'tenant4'),
(201602000000026, 'Sample Item 45', 'Tshirts', 45.75, 0, 'tenant4'),
(201602000000027, 'Sample Item 49', 'Shorts', 49.98, 0, 'tenant'),
(201602000000028, 'Sample Item 51', 'Skirt', 51.25, 0, 'tenant4'),
(201602000000029, 'sample item 56', 'Shorts', 56.8, 0, 'tenant5'),
(201602000000030, 'sample item 50', 'T-Shirt', 20, 0, 'VANILLABREEZECLOTHING'),
(201602000000031, 'sample item 50', 'T-Shirt', 21, 0, 'tenant'),
(201602000000032, 'samle item', 'T-Shirt', 21, 0, 'VANILLABREEZECLOTHING');

-- --------------------------------------------------------

--
-- Table structure for table `pos_pullout`
--

CREATE TABLE IF NOT EXISTS `pos_pullout` (
  `pullout_id` bigint(20) NOT NULL,
  `pullout_item` bigint(20) NOT NULL,
  `pullout_quantity` int(11) NOT NULL,
  `pullout_supplier` varchar(20) NOT NULL,
  `pullout_date` date NOT NULL,
  `pullout_approved_date` date NOT NULL,
  `pullout_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201607000000023 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_pullout`
--

INSERT INTO `pos_pullout` (`pullout_id`, `pullout_item`, `pullout_quantity`, `pullout_supplier`, `pullout_date`, `pullout_approved_date`, `pullout_status`) VALUES
(201607000000001, 201602000000012, 2, '201605000000002', '2016-04-29', '2016-05-13', 1),
(201607000000002, 201602000000011, 3, '201605000000002', '2016-04-28', '2016-05-13', 1),
(201607000000003, 201602000000002, 3, '201605000000001', '2016-05-04', '2016-05-07', 1),
(201607000000004, 201602000000011, 1, '201605000000002', '2016-05-05', '2016-05-11', 1),
(201607000000005, 201602000000011, 1, '201605000000002', '2016-05-05', '2016-05-05', 2),
(201607000000006, 201602000000002, 5, '201605000000001', '2016-05-07', '2016-05-07', 1),
(201607000000007, 201602000000004, 5, '201605000000001', '2016-05-07', '2016-05-07', 1),
(201607000000008, 201602000000005, 5, '201605000000001', '2016-05-07', '2016-05-07', 1),
(201607000000009, 201602000000001, 5, '201605000000001', '2016-05-07', '2016-05-07', 1),
(201607000000010, 201602000000003, 5, '201605000000001', '2016-05-07', '2016-05-07', 2),
(201607000000011, 0, 1, '201605000000001', '2016-05-12', '2016-05-12', 0),
(201607000000012, 0, 2, '0', '2016-05-12', '2016-05-12', 0),
(201607000000013, 201602000000017, 2, '0', '2016-05-12', '2016-05-12', 0),
(201607000000014, 201602000000017, 2, 'tenant5', '2016-05-12', '2016-05-12', 2),
(201607000000015, 201602000000018, 2, 'tenant5', '2016-05-12', '2016-05-12', 2),
(201607000000016, 201602000000002, 3, 'tenant', '2016-05-13', '2016-05-13', 2),
(201607000000017, 201602000000001, 3, 'tenant', '2016-05-14', '2016-05-14', 1),
(201607000000018, 201602000000002, 3, 'tenant', '2016-05-14', '2016-05-14', 1),
(201607000000019, 201602000000002, 0, 'tenant', '2016-05-14', '2016-05-14', 1),
(201607000000020, 201602000000003, 2, 'tenant', '2016-05-14', '2016-05-14', 2),
(201607000000021, 201602000000002, 4, 'tenant', '2016-05-14', '2016-05-14', 0),
(201607000000022, 201602000000001, 2, 'tenant', '2016-05-16', '2016-05-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_sales`
--

CREATE TABLE IF NOT EXISTS `pos_sales` (
  `sales_id` bigint(20) NOT NULL,
  `sales_item` bigint(20) NOT NULL,
  `sales_quantity` int(11) NOT NULL,
  `sales_total` double NOT NULL,
  `sales_discount` double NOT NULL,
  `sales_date` date NOT NULL,
  `sales_supplier` varchar(20) NOT NULL,
  `sales_st` bigint(20) NOT NULL,
  `sales_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201603000000140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_sales`
--

INSERT INTO `pos_sales` (`sales_id`, `sales_item`, `sales_quantity`, `sales_total`, `sales_discount`, `sales_date`, `sales_supplier`, `sales_st`, `sales_status`) VALUES
(201603000000001, 201602000000001, 2, 719.19, 0, '2016-04-27', '201605000000001', 201604000000001, 1),
(201603000000002, 201602000000005, 1, 899, 0, '2016-04-27', '201605000000001', 201604000000001, 1),
(201603000000003, 201602000000012, 2, 500, 0, '2016-04-27', '201605000000002', 201604000000001, 0),
(201603000000006, 201602000000012, 1, 250, 0, '2016-04-27', '201605000000002', 201604000000002, 0),
(201603000000007, 201602000000002, 1, 359.95, 0, '2016-04-27', '201605000000001', 201604000000002, 0),
(201603000000008, 201602000000004, 3, 2697, 0, '2016-04-27', '201605000000002', 0, 0),
(201603000000009, 201602000000002, 1, 359.95, 0, '2016-04-27', '201605000000002', 0, 0),
(201603000000010, 201602000000001, 4, 1439.8, 0, '2016-04-27', '201605000000002', 0, 0),
(201603000000011, 201602000000001, 2, 719.9, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000012, 201602000000008, 1, 499.75, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000013, 201602000000012, 1, 250, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000014, 201602000000012, 1, 250, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000015, 201602000000011, 1, 299.75, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000016, 201602000000014, 3, 900, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000017, 201602000000001, 1, 359.95, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000018, 201602000000002, 2, 719.9, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000019, 201602000000002, 1, 359.95, 0, '2016-05-04', '201605000000002', 0, 0),
(201603000000020, 201602000000004, 2, 1798, 0, '2016-05-04', '201605000000001', 0, 0),
(201603000000021, 201602000000011, 3, 899.25, 0, '2016-05-05', '201605000000002', 0, 0),
(201603000000022, 201602000000001, 1, 100, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000023, 201602000000003, 1, 100, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000024, 201602000000001, 1, 0, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000025, 201602000000002, 1, 0, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000026, 201602000000001, 1, 359.95, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000027, 201602000000002, 1, 359.95, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000028, 201602000000004, 1, 899, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000029, 201602000000008, 1, 499.75, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000030, 201602000000002, 1, 359.95, 0, '2016-05-09', '201605000000001', 0, 0),
(201603000000031, 201602000000001, 1, 359.95, 0, '2016-05-10', '201605000000001', 0, 0),
(201603000000032, 201602000000001, 1, 359.95, 0, '2016-05-10', '201605000000001', 0, 0),
(201603000000033, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000034, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000035, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000036, 201602000000005, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000037, 201602000000007, 1, 599.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000038, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000039, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000040, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000041, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 1),
(201603000000042, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000043, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000044, 201602000000008, 1, 499.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000045, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000046, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000047, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000048, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000049, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000050, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000051, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000052, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000053, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000054, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000055, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000056, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000057, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000058, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000059, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000060, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000061, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000062, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000063, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000064, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000065, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000066, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000067, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000068, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000069, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000070, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000071, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000072, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000073, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000074, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000075, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000076, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000077, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000078, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000079, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000080, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000081, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000082, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000083, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000084, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000085, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000086, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000087, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000088, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000089, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000090, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000091, 201602000000005, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000092, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000093, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000094, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000095, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000096, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000097, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000098, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000099, 201602000000001, 1, 359.95, 40, '2016-05-11', '201605000000001', 0, 0),
(201603000000100, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000101, 201602000000003, 1, 21.4875, 5, '2016-05-11', '201605000000001', 0, 0),
(201603000000102, 201602000000002, 1, 107.985, 30, '2016-05-11', '201605000000001', 0, 0),
(201603000000103, 201602000000002, 1, 323.955, 10, '2016-05-11', '201605000000001', 0, 0),
(201603000000104, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000105, 201602000000008, 1, 499.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000106, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000107, 201602000000002, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000108, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000109, 201602000000001, 1, 359.95, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000110, 201602000000003, 1, 429.75, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000111, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 0),
(201603000000112, 201602000000002, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000113, 201602000000002, 1, 359.95, 0, '2016-05-11', '0', 0, 0),
(201603000000114, 201602000000003, 1, 429.75, 0, '2016-05-11', '0', 0, 0),
(201603000000115, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 0),
(201603000000116, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 0),
(201603000000117, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 0),
(201603000000118, 201602000000002, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000119, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000120, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000121, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000122, 201602000000003, 1, 429.75, 0, '2016-05-11', '0', 0, 1),
(201603000000123, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 1),
(201603000000124, 201602000000002, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000125, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000126, 201602000000004, 1, 899, 0, '2016-05-11', '201605000000001', 0, 1),
(201603000000127, 201602000000001, 1, 359.95, 0, '2016-05-11', '0', 0, 1),
(201603000000128, 201602000000003, 1, 429.75, 0, '2016-05-11', 'tenant', 0, 1),
(201603000000129, 201602000000001, 1, 359.95, 0, '2016-05-12', 'tenant', 0, 1),
(201603000000130, 201602000000002, 1, 359.95, 0, '2016-05-12', 'tenant', 0, 1),
(201603000000131, 201602000000001, 1, 359.95, 0, '2016-05-12', 'tenant', 0, 1),
(201603000000132, 201602000000001, 1, 359.95, 0, '2016-05-12', 'tenant', 0, 1),
(201603000000133, 201602000000002, 1, 359.95, 0, '2016-05-12', 'tenant', 0, 1),
(201603000000134, 201602000000001, 1, 359.95, 0, '2016-05-14', 'tenant', 0, 1),
(201603000000135, 201602000000002, 1, 356.95, 0, '2016-05-14', 'tenant', 0, 1),
(201603000000136, 201602000000002, 1, 0, 100, '2016-05-14', 'tenant', 0, 1),
(201603000000137, 201602000000001, 1, 309.95, 50, '2016-05-14', 'tenant', 0, 0),
(201603000000138, 201602000000002, 1, 356.95, 0, '2016-05-14', 'tenant', 0, 0),
(201603000000139, 201602000000001, 1, 359.95, 0, '2016-05-14', 'tenant', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_supplier`
--

CREATE TABLE IF NOT EXISTS `pos_supplier` (
  `supplier_id` bigint(20) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_user` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=201605000000004 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_supplier`
--

INSERT INTO `pos_supplier` (`supplier_id`, `supplier_name`, `supplier_user`) VALUES
(201605000000001, 'Bench', 201601000000002),
(201605000000002, 'Tenant Sample', 201601000000001),
(201605000000003, 'SixSpenshoppe', 201601000000010);

-- --------------------------------------------------------

--
-- Table structure for table `pos_user`
--

CREATE TABLE IF NOT EXISTS `pos_user` (
  `user_id` bigint(20) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `upload_id` int(11) NOT NULL,
  `img_name` varchar(32) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `upload_date` varchar(20) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `fk_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`upload_id`, `img_name`, `ext`, `upload_date`, `path`, `type`, `fk_ID`) VALUES
(119, '55c443b7e71f2', 'jpg', '1438925751', 'C:\\xampp\\htdocs\\ep-002-marketplace/uploads/55c443b7e71f2.jpg', 0, 0),
(120, '55d3f24c2e143', 'jpg', '1439953484', '', 0, 0),
(121, '55d3f2ad140f1', 'jpg', '1439953581', '', 0, 0),
(122, '55d3f2e522b09', 'jpeg', '1439953637', '', 0, 0),
(123, '55d3f34968129', 'jpg', '1439953737', '', 0, 0),
(124, '55d3f3ac09871', 'jpg', '1439953836', '', 0, 0),
(125, '55d3f4819fe30', 'jpg', '1439954049', '', 0, 0),
(126, '55d3f4b06c144', 'jpg', '1439954096', '', 0, 0),
(127, '55d3f8fbc0b24', 'jpg', '1439955195', '', 0, 0),
(128, '55d3f986a2f3e', 'jpg', '1439955334', '', 0, 0),
(129, '55d3f9afed494', 'jpeg', '1439955375', '', 0, 2),
(130, '55ded1d538434', 'png', '1440666069', '', 0, 3),
(131, '55ded21cdf71c', 'png', '1440666140', '', 0, 3),
(132, '55df84e708a8c', 'jpeg', '1440711911', '', 1, 3),
(133, '55df8e3ce1dc7', 'jpeg', '1440714300', '', 1, 3),
(134, '55df8f1c56313', 'png', '1440714524', '', 1, 0),
(135, '55df8f7f74e01', 'png', '1440714623', '', 1, 0),
(136, '55df900dde178', 'png', '1440714765', '', 1, 0),
(137, '55df90357e43b', 'png', '1440714805', '', 1, 0),
(138, '55df929f549aa', 'png', '1440715423', '', 1, 0),
(139, '55df931dcf684', 'png', '1440715549', '', 1, 0),
(140, '55df934ec2585', 'png', '1440715598', '', 1, 0),
(141, '55df9388a24b4', 'png', '1440715656', '', 1, 0),
(142, '55df9b3b63689', 'png', '1440717627', '', 1, 40),
(143, '55df9bb579cea', 'png', '1440717749', '', 1, 41),
(144, '55df9e470be2c', 'png', '1440718407', '', 1, 42),
(145, '55dfa06bd534d', 'png', '1440718955', '', 1, 46),
(146, '55dfa8facbe15', 'png', '1440721146', '', 1, 48),
(147, '55e168d9075af', 'png', '1440835801', '', 1, 49),
(148, '55e53a5a1dfa7', 'png', '1441086042', '', 1, 50),
(149, '55e56e7811dca', 'jpg', '1441099384', '', 1, 52),
(150, '55ee7c700bb50', 'png', '1441692784', '', 1, 53);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `User_ID` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `fbid` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `email`, `password`, `fullname`, `signup_date`, `fbid`) VALUES
(3, 'jmalvarez@potatocodes.com', '21232f297a57a5a743894a0e4a801fc3', 'Juaning', '2015-08-27', ''),
(4, 'juanmiguelalvarez@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'Rosa En Fiore', '2015-08-28', ''),
(5, 'Admin@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'Admina', '2015-09-08', ''),
(6, 'octopi@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Octopi', '2015-09-08', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_system_variables`
--
ALTER TABLE `aauth_system_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `overwatch_expense`
--
ALTER TABLE `overwatch_expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `overwatch_income`
--
ALTER TABLE `overwatch_income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `overwatch_project`
--
ALTER TABLE `overwatch_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `overwatch_withdrawal`
--
ALTER TABLE `overwatch_withdrawal`
  ADD PRIMARY KEY (`withdrawal_id`);

--
-- Indexes for table `pos_category`
--
ALTER TABLE `pos_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `pos_delivery`
--
ALTER TABLE `pos_delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `pos_delivery_transaction`
--
ALTER TABLE `pos_delivery_transaction`
  ADD PRIMARY KEY (`dt_id`);

--
-- Indexes for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pos_pullout`
--
ALTER TABLE `pos_pullout`
  ADD PRIMARY KEY (`pullout_id`);

--
-- Indexes for table `pos_sales`
--
ALTER TABLE `pos_sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pos_user`
--
ALTER TABLE `pos_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `id` (`upload_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ID` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_system_variables`
--
ALTER TABLE `aauth_system_variables`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201601000000027;
--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `overwatch_expense`
--
ALTER TABLE `overwatch_expense`
  MODIFY `expense_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1202000000101;
--
-- AUTO_INCREMENT for table `overwatch_income`
--
ALTER TABLE `overwatch_income`
  MODIFY `income_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1201000000120;
--
-- AUTO_INCREMENT for table `overwatch_project`
--
ALTER TABLE `overwatch_project`
  MODIFY `project_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1204000000014;
--
-- AUTO_INCREMENT for table `overwatch_withdrawal`
--
ALTER TABLE `overwatch_withdrawal`
  MODIFY `withdrawal_id` bigint(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1203000000103;
--
-- AUTO_INCREMENT for table `pos_category`
--
ALTER TABLE `pos_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pos_delivery`
--
ALTER TABLE `pos_delivery`
  MODIFY `delivery_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201606000000063;
--
-- AUTO_INCREMENT for table `pos_delivery_transaction`
--
ALTER TABLE `pos_delivery_transaction`
  MODIFY `dt_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201608000000040;
--
-- AUTO_INCREMENT for table `pos_item`
--
ALTER TABLE `pos_item`
  MODIFY `item_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201602000000033;
--
-- AUTO_INCREMENT for table `pos_pullout`
--
ALTER TABLE `pos_pullout`
  MODIFY `pullout_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201607000000023;
--
-- AUTO_INCREMENT for table `pos_sales`
--
ALTER TABLE `pos_sales`
  MODIFY `sales_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201603000000140;
--
-- AUTO_INCREMENT for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  MODIFY `supplier_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201605000000004;
--
-- AUTO_INCREMENT for table `pos_user`
--
ALTER TABLE `pos_user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
