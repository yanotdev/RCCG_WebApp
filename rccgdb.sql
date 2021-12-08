-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 02:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rccgdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `responsibleperson`
--

CREATE TABLE `responsibleperson` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `regid` varchar(20) NOT NULL,
  `persontype` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `responsibleperson`
--

INSERT INTO `responsibleperson` (`id`, `fullname`, `regid`, `persontype`, `email`, `phonenumber`) VALUES
(6, 'ADEWALE ADISA', 'uqWYdT3w', 'parent', 'solixzsystem@gmail.com', '+2348135773940'),
(9, 'wkjeh8gy ftyfuyj', 'ClS0fgdF', 'parent', 'tyuy@tj.com', '7664654756'),
(22, '88999 455444', 'gCBLhiSJ', 'parent', 'kukoyi@gmail.com', '08078955654544'),
(30, 'olaide Balogun', 'TQH61sxy', 'relative', 'baloala@gmail.com', '08063281945'),
(31, 'Ajibola Olamide', 'RwK2dMmC', 'parent', 'jibmide@gmail.com', '978656567876'),
(32, 'Laolu Akande', 'C0X7nVhb', 'relative', 'lakande@gmail.com', '08067543213'),
(34, 'Abosede Ololade', 'zDWQIo53', 'relative', 'aololade@gmail.com', '08054731215'),
(36, 'Olamide Akinbowale', 'le9KaXkM', 'parent', 'oakin@gmail.com', '08078234561'),
(37, 'olaoluwa Akinbowale', 'lForTshq', 'parent', 'oakin@gmail.com', '08032178964'),
(38, 'hkjhjj jjhhjj', 'x2SDlA8E', 'parent', 'fghhh@gmail.com', '12345678109'),
(39, 'adewale Ojo', 'pSvRQtNy', 'parent', 'waleo@gmail.com', '12345678901'),
(40, 'Ajao Funmilayo', 'kwjc5dnx', 'parent', 'aj@gmail.com', '09087654321'),
(41, 'olakunle Oluomo', 'jS2OAHIp', 'parent', 'olaolu@gmail.com', '08056635122'),
(42, 'Adeoye Adisa', 'ex3ECG8z', 'parent', 'adeadi@gmail.com', '09099999999'),
(43, 'Ademola Adenubi', 'iGJeaAcZ', 'parent', 'demolanubi@gmail.com', '08074351237'),
(44, 'Adisa  Jingolo', 'gyjTmQKk', 'parent', 'jadisa@gmail.com', '09056783217'),
(45, 'dkdinnnn kiihmkkj', 'tmcHMZ4G', 'parent', 'dro@gmail.com', '09023456778');

-- --------------------------------------------------------

--
-- Table structure for table `ssattendance`
--

CREATE TABLE `ssattendance` (
  `id` int(11) NOT NULL,
  `regid` varchar(20) NOT NULL,
  `parentcode` varchar(500) NOT NULL,
  `childcode` varchar(500) NOT NULL,
  `childid` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `droppedoff` tinyint(1) NOT NULL,
  `pickedup` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ssattendance`
--

INSERT INTO `ssattendance` (`id`, `regid`, `parentcode`, `childcode`, `childid`, `parentid`, `droppedoff`, `pickedup`, `created_at`, `updated_at`) VALUES
(36, '', 'kl3cWs', '00eac98649579c9ab89fc39517767bda', 58, 0, 1, 0, '2021-07-17 08:58:17', '2021-07-17 08:58:17'),
(37, '', 'HChiwF', '17504bcf3c3908855bb1220adcd184bb', 71, 0, 1, 0, '2021-10-22 04:03:56', '2021-10-22 04:03:56'),
(38, '', '42SIJV', 'f8b47f667769c5afc45476ffe6cf8e1d', 72, 0, 1, 0, '2021-10-22 04:11:39', '2021-10-22 04:11:39'),
(39, '', 'bXwFU0', '6873ab68d5e4655d4163c3edfb730106', 80, 0, 1, 1, '2021-11-02 10:41:11', '2021-11-03 07:55:50'),
(40, '', 'cWZaQw', '2f101dd0652aa36b114f42c2f1d23a79', 75, 0, 0, 0, '2021-11-03 07:07:51', '2021-11-03 07:07:51'),
(41, '', 'cWZaQw', 'c264f4be86165b5304285989cc8de086', 75, 0, 1, 0, '2021-11-03 07:18:46', '2021-11-03 07:18:46'),
(42, '', 'bXwFU0', '4d5da27ec57c89cbcef74454643eda03', 80, 0, 1, 0, '2021-11-03 08:18:03', '2021-11-03 08:18:03'),
(43, '', 'KYRudf', '989df8a16f8a040228123346d4980d61', 89, 0, 1, 0, '2021-11-03 10:36:48', '2021-11-03 10:36:48'),
(44, '', 'KYRudf', 'dd150fb039afddda19caebe797042c1b', 91, 0, 1, 0, '2021-11-03 10:37:45', '2021-11-03 10:37:45'),
(45, '', 'KYRudf', '70c09d5dd5738d3676a2f8febfe6c4fd', 90, 0, 1, 0, '2021-11-03 10:38:33', '2021-11-03 10:38:33'),
(53, '', 'MRe2Jr', '66128143b7eac539e24a07f599537514', 111, 0, 1, 1, '2021-11-10 02:05:24', '2021-11-10 02:29:21'),
(54, '', 'MRe2Jr', '45975682f03991142e4465c0fec366bf', 112, 0, 1, 1, '2021-11-10 02:24:08', '2021-11-10 02:29:52'),
(55, '', 'MRe2Jr', 'ec77bc50ac148e342a13ea9506b4739e', 111, 0, 1, 0, '2021-11-10 02:35:36', '2021-11-10 02:35:36'),
(56, '', 'CV34u5', 'fbca3c94cf68dab82b0ddddb659230a7', 113, 0, 1, 1, '2021-11-10 03:35:35', '2021-11-10 03:39:01'),
(59, '', 'DFuwiC', '1a032b031d88d398bb760712a2f09cd4', 119, 0, 1, 0, '2021-11-10 09:54:56', '2021-11-10 09:54:56'),
(60, '', 'DFuwiC', '698dbd55f3fd1734041dfcbef5854774', 120, 0, 1, 0, '2021-11-10 10:08:01', '2021-11-10 10:08:01'),
(61, '', 'N2H0er', 'd8c64fe423da10876001da16430ebfe4', 131, 0, 1, 0, '2021-11-12 04:13:08', '2021-11-12 04:13:08'),
(62, '', 'N2H0er', 'ff6de476b498b58de078cf7338519e13', 132, 0, 1, 0, '2021-11-12 04:20:24', '2021-11-12 04:20:24'),
(63, '', 'BOW8He', 'b3be94c6f15b16495c64ca2d521de9a3', 133, 0, 1, 0, '2021-11-15 07:51:01', '2021-11-15 07:51:01'),
(64, '', 'QKZS5I', 'd932dad2c821189297c93dbbd94a9dc7', 125, 0, 1, 0, '2021-11-18 01:35:22', '2021-11-18 01:35:22'),
(65, '', 'QKZS5I', '5969029cfdb565952b6a76d22d7798fd', 126, 0, 1, 0, '2021-11-18 01:35:27', '2021-11-18 01:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `sschild`
--

CREATE TABLE `sschild` (
  `id` int(11) NOT NULL,
  `regid` varchar(20) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `child_class` varchar(100) NOT NULL,
  `parentid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sschild`
--

INSERT INTO `sschild` (`id`, `regid`, `firstname`, `lastname`, `Date_of_birth`, `child_class`, `parentid`, `created_at`, `updated_at`) VALUES
(58, 'uqWYdT3w', 'aaaa', 'bbbb', '2014-06-11', '9-12 years', 51, '2021-07-11 09:43:36', '2021-07-11 09:43:36'),
(61, 'ClS0fgdF', 'gjy', 'fjy', '2015-10-13', 'Toddler', 54, '2021-10-14 09:46:45', '2021-10-14 09:46:45'),
(89, 'RwK2dMmC', 'ope', 'mide', '2019-09-15', 'Toddler', 74, '2021-11-03 10:35:21', '2021-11-03 10:35:21'),
(90, 'RwK2dMmC', 'ffff', 'ayomikun', '2018-07-10', 'Toddler', 74, '2021-11-03 10:35:21', '2021-11-03 10:35:21'),
(91, 'RwK2dMmC', 'love', 'mide', '2018-01-28', 'Toddler', 74, '2021-11-03 10:35:21', '2021-11-03 10:35:21'),
(94, 'C0X7nVhb', 'shade', 'ayobola', '2018-06-12', 'Toddler', 76, '2021-11-08 06:45:21', '2021-11-08 06:45:21'),
(95, 'C0X7nVhb', 'tola', 'ayobola', '2016-02-08', '5-6 years', 76, '2021-11-08 06:45:21', '2021-11-08 06:45:21'),
(113, 'zDWQIo53', 'Irewole', 'Johnson', '2015-12-06', '5-6 years', 86, '2021-11-10 03:24:35', '2021-11-10 03:24:35'),
(114, 'zDWQIo53', 'Iremide', 'Johnson', '2019-05-06', 'Toddler', 86, '2021-11-10 03:24:35', '2021-11-10 03:24:35'),
(119, 'lForTshq', 'fola', 'Akinbowale', '2006-05-07', '9-12 years', 89, '2021-11-10 09:54:03', '2021-11-10 09:54:03'),
(120, 'lForTshq', 'jola', 'Akinbowale', '2018-03-08', 'Toddler', 89, '2021-11-10 09:54:03', '2021-11-10 09:54:03'),
(121, 'x2SDlA8E', 'aaaa', 'bbb', '2021-11-16', 'Toddler', 91, '2021-11-12 03:01:15', '2021-11-12 03:01:15'),
(122, 'x2SDlA8E', 'ccccc', 'bbb', '2021-02-12', 'Toddler', 91, '2021-11-12 03:01:15', '2021-11-12 03:01:15'),
(123, 'pSvRQtNy', 'as', 'Ojo', '2021-02-09', 'Toddler', 92, '2021-11-12 03:21:56', '2021-11-12 03:21:56'),
(124, 'pSvRQtNy', 'ab', 'Ojo', '0000-00-00', 'Toddler', 92, '2021-11-12 03:21:56', '2021-11-12 03:21:56'),
(125, 'kwjc5dnx', 'ola', 'Funmilayo', '2019-12-18', 'Toddler', 93, '2021-11-12 03:27:49', '2021-11-12 03:27:49'),
(126, 'kwjc5dnx', 'bolu', 'Funmilayo', '2020-02-04', 'Toddler', 93, '2021-11-12 03:27:49', '2021-11-12 03:27:49'),
(127, 'jS2OAHIp', 'oladele', 'Oluomo', '2021-11-24', 'Toddler', 94, '2021-11-12 03:32:51', '2021-11-12 03:32:51'),
(128, 'jS2OAHIp', 'olashile', 'Oluomo', '2020-06-09', 'Toddler', 94, '2021-11-12 03:32:51', '2021-11-12 03:32:51'),
(129, 'ex3ECG8z', 'bayo', 'Adisa', '2019-02-08', 'Toddler', 95, '2021-11-12 03:40:17', '2021-11-12 03:40:17'),
(130, 'ex3ECG8z', 'Kola', 'Adisa', '2018-03-11', 'Toddler', 95, '2021-11-12 03:40:17', '2021-11-12 03:40:17'),
(131, 'iGJeaAcZ', 'ola', 'Adenubi', '2021-11-03', 'Toddler', 96, '2021-11-12 04:12:28', '2021-11-12 04:12:28'),
(132, 'iGJeaAcZ', 'bolu', 'Adenubi', '2019-12-29', 'Toddler', 96, '2021-11-12 04:12:28', '2021-11-12 04:12:28'),
(133, 'gyjTmQKk', 'korede', 'Jingolo', '2020-11-15', 'Toddler', 97, '2021-11-15 06:50:34', '2021-11-15 06:50:34'),
(134, 'gyjTmQKk', 'bolaji', 'Jingolo', '2020-11-14', 'Toddler', 97, '2021-11-15 06:50:34', '2021-11-15 06:50:34'),
(135, 'tmcHMZ4G', 'abass', 'ola', '2021-02-04', 'Toddler', 98, '2021-11-16 02:39:11', '2021-11-16 02:39:11'),
(136, 'tmcHMZ4G', 'azeez', 'ola', '2019-04-07', 'Toddler', 98, '2021-11-16 02:39:11', '2021-11-16 02:39:11'),
(170, 'TQH61sxy', 'Ademola', 'Oseni', '2017-11-07', 'Toddler', 73, '2021-11-30 13:17:20', '2021-11-30 13:17:20'),
(171, 'TQH61sxy', 'jkklllll', 'kllkkjiuytg', '2021-12-06', 'Toddler', 73, '2021-12-01 09:21:54', '2021-12-01 09:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `ssparent`
--

CREATE TABLE `ssparent` (
  `id` int(11) NOT NULL,
  `regid` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `church_member` varchar(50) NOT NULL,
  `number_of_kids` int(11) NOT NULL,
  `code` varchar(500) NOT NULL,
  `code_sent` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `Approved` tinyint(1) NOT NULL,
  `Parent QRcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ssparent`
--

INSERT INTO `ssparent` (`id`, `regid`, `firstname`, `lastname`, `email`, `phonenumber`, `address`, `church_member`, `number_of_kids`, `code`, `code_sent`, `created_at`, `updated_at`, `Active`, `Approved`, `Parent QRcode`) VALUES
(51, 'uqWYdT3w', 'ADEWALE', 'ADISA', 'solixzsystem@gmail.com', '+2348135773940', '1,ci street\r\nshagari estate', 'Member', 1, 'kl3cWs', 0, '2021-07-11 09:43:36', '2021-11-17 03:44:41', 0, 0, ''),
(54, 'ClS0fgdF', 'wkjeh8gy', 'ftyfuyj', 'tyuy@tj.com', '7664654756', 'tyfyt', 'Member', 1, 'Si5rNI', 0, '2021-10-14 09:46:45', '2021-10-14 09:46:45', 1, 0, ''),
(73, 'TQH61sxy', 'Sulaiman', 'segun', 'adesegunsulaimanku99koyi@gmail.com', '86567890', '27, Ogunelegi Road, Odoramusegun, Oke Sopen', 'Member', 1, 'neuVQ1', 0, '2021-11-03 10:19:13', '2021-11-03 10:19:13', 1, 0, ''),
(74, 'RwK2dMmC', 'Ajibola', 'Olamide', 'jibmide@gmail.com', '978656567876', '23, olowo street', 'Member', 3, 'KYRudf', 0, '2021-11-03 10:35:21', '2021-11-17 08:04:49', 1, 0, ''),
(76, 'C0X7nVhb', 'oladele', 'ayobola', 'delebola@gmail.com', '908023456789', '7, Ogo Oluwa Stree', 'Member', 2, 'a7FJwP', 0, '2021-11-08 06:45:21', '2021-11-08 06:45:21', 1, 0, ''),
(86, 'zDWQIo53', 'Akorede', 'Johnson', 'ajohn@gmail.com', '08076986542', '5, johnson street, Lagos', 'Member', 2, 'CV34u5', 0, '2021-11-10 03:24:35', '2021-12-01 05:29:41', 0, 0, ''),
(89, 'lForTshq', 'olaoluwa', 'Akinbowale', 'oakin@gmail.com', '08032178964', 'jkjghfgjkljhg', 'Member', 2, 'DFuwiC', 0, '2021-11-10 09:54:03', '2021-11-10 09:54:03', 1, 0, ''),
(90, 'ud6qXAs9', 'Felix', 'Olaoluwa', 'fola@gmail.com', '08035678912', '5, Hospital Road', 'Member', 2, 'dDPjto', 0, '2021-11-12 02:06:02', '2021-11-12 02:06:02', 1, 0, ''),
(91, 'x2SDlA8E', 'hkjhjj', 'jjhhjj', 'fghhh@gmail.com', '12345678109', 'fhghg', 'Member', 2, 'm4z0R1', 0, '2021-11-12 03:01:15', '2021-11-12 03:01:15', 1, 0, ''),
(92, 'pSvRQtNy', 'adewale', 'Ojo', 'waleo@gmail.com', '12345678901', '6, ologo', 'Member', 2, 'bsB7Fe', 0, '2021-11-12 03:21:56', '2021-11-17 04:35:44', 0, 0, ''),
(93, 'kwjc5dnx', 'Ajao', 'Funmilayo', 'aj@gmail.com', '09087654321', '3,kkk', 'Member', 2, 'QKZS5I', 0, '2021-11-12 03:27:49', '2021-11-12 03:27:49', 1, 0, ''),
(94, 'jS2OAHIp', 'olakunle', 'Oluomo', 'olaolu@gmail.com', '08056635122', '2, sss ', 'Member', 2, 'h1bwOU', 0, '2021-11-12 03:32:51', '2021-11-12 03:32:51', 0, 0, ''),
(95, 'ex3ECG8z', 'Adeoye', 'Adisa', 'adeadi@gmail.com', '09099999999', 'adisa street', 'Member', 2, 'OAdVWl', 0, '2021-11-12 03:40:17', '2021-11-17 03:41:44', 0, 0, ''),
(96, 'iGJeaAcZ', 'Ademola', 'Adenubi', 'demolanubi@gmail.com', '08074351237', '23, demola street', 'Member', 2, 'N2H0er', 0, '2021-11-12 04:12:28', '2021-12-01 05:30:50', 0, 0, ''),
(97, 'gyjTmQKk', 'Adisa ', 'Jingolo', 'jadisa@gmail.com', '09056783217', '3, Adisa street, Lagos', 'Member', 2, 'BOW8He', 0, '2021-11-15 06:50:34', '2021-11-17 06:51:06', 0, 0, ''),
(98, 'tmcHMZ4G', 'dkdinnnn', 'kiihmkkj', 'dro@gmail.com', '09023456778', '23, ihndhj dhjej', 'Member', 2, 'jOVHzB', 0, '2021-11-16 02:39:11', '2021-11-16 02:39:11', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `responsibleperson`
--
ALTER TABLE `responsibleperson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssattendance`
--
ALTER TABLE `ssattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sschild`
--
ALTER TABLE `sschild`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssparent`
--
ALTER TABLE `ssparent`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `responsibleperson`
--
ALTER TABLE `responsibleperson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `ssattendance`
--
ALTER TABLE `ssattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `sschild`
--
ALTER TABLE `sschild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `ssparent`
--
ALTER TABLE `ssparent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
