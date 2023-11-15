-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2022 at 01:12 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bae_workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additinal_image`
--

CREATE TABLE `tbl_additinal_image` (
  `image_additinal_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `img_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advance`
--

CREATE TABLE `tbl_advance` (
  `advance_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `advance_payment` varchar(50) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `advance_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_advance`
--

INSERT INTO `tbl_advance` (`advance_id`, `job_id`, `license_number`, `note`, `advance_payment`, `stat`, `advance_date`) VALUES
(1, '26', 'WP KO-4750', 'Advance payment for Estimate number BAE/ES/2022/10020\r\n', '40000', '1', '2022-01-08 21:50:11'),
(2, '', 'KJ-1086', 'new advance', '150', '0', '2022-01-09 01:40:24'),
(3, '', 'KJ-1086', 'yes payment', '120', '0', '2022-01-09 01:41:06'),
(4, '19', 'KJ-1086', 'yes car', '1520', '1', '2022-01-11 23:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `booking_date` varchar(255) DEFAULT NULL,
  `reg_customer` varchar(255) DEFAULT NULL,
  `reg_phone_no` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `reg_model` varchar(255) DEFAULT NULL,
  `reg_chassis_no` varchar(255) DEFAULT NULL,
  `reg_license_no` varchar(255) DEFAULT NULL,
  `reg_mileage` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_web`
--

CREATE TABLE `tbl_booking_web` (
  `booking_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_license_number` varchar(255) DEFAULT NULL,
  `book_date` varchar(255) DEFAULT NULL,
  `book_time` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `user_message` mediumtext,
  `stat` varchar(255) DEFAULT NULL,
  `booking_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `name` text,
  `email` text,
  `date` varchar(100) DEFAULT NULL,
  `idcard_number` varchar(50) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `how_to_know` varchar(50) DEFAULT NULL,
  `address` mediumtext,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`client_id`, `name`, `email`, `date`, `idcard_number`, `phone_no`, `how_to_know`, `address`, `reg_date`) VALUES
(1, 'Oshan', 'oshan.amazoft@gmail.com', '2021-11-09', 'April 10', '0774270018', 'Facebook', 'No 103 St. Anthonys lane, Colombo 00300', '2021-11-09 12:03:43'),
(2, 'Ministry of Foreign Affairs', 'info@bae.lk', '2021-11-25', ' ', '0112 325 372', 'Friend', 'Republic Building,\r\nSir Baron Jayathilake Mawatha, \r\nColombo 01', '2021-11-25 06:35:15'),
(3, 'Srinath Weerasinghe', 'tecsrinath@gmail.com', '2021-12-02', 'September 15', '0774716095', 'Friend', '56C, Narendrasinghe Mawatha, Kundasale', '2021-12-02 06:14:30'),
(4, 'Mr Saffan ', 'info5@gmail.com', '2021-12-30', ' ', '0777886216', 'Friend', '27 12 Park Lane, nawala Road,  Rajagiriya', '2021-12-30 07:20:01'),
(5, 'Mr. Suresh Edirisinghe', '', '2022-01-03', 'January 01', '0772450450', 'Friend', 'Gunasekara Gardens, Nawala Road, Rajagiriya', '2022-01-03 03:00:13'),
(6, 'Mr. Chandana Wickramassinghe', '', '2022-01-03', ' ', '0777311826', 'Friend', '8, C. P. De Silva Mawatha, Moratuwa,', '2022-01-03 04:42:12'),
(9, 'Noor Sons (Pvt) Ltd', 'saleemn3@gmail.com', '2022-01-03', 'January 02', '0777303453', 'Friend', '24-1/ Sir Henry De Mel Mawatha, Colombo 02', '2022-01-03 09:34:52'),
(10, 'Mr Charith Gallage', '', '2022-01-03', 'August 12', '0773733688', 'Other', '112, Vipulasena Mw, Colombo 10', '2022-01-03 06:40:57'),
(11, 'Mr. Peshala Manoj', 'peshtabla123@gmail.com', '2022-01-03', 'March 21', '0713288466', 'Friend', '112/5 I Thalangama South, Akuregoda', '2022-01-03 07:43:25'),
(12, 'Mr. Thishya Weregoda', '', '2022-01-03', 'January 12', '0714814217', 'Friend', '89 1/1 Dudley Senanayake Mawatha, Colombo 08', '2022-01-03 07:17:47'),
(15, 'Dr. T. A. C. V. Thambugala', '', '2022-01-03', 'August 18', '0777138950', 'Friend', '949/13, Udawatta Road, Thalangama North, Mabala', '2022-01-03 09:01:36'),
(16, 'Mr. Champika Karunaratne', '', '2022-01-03', ' ', '0777812588', 'Friend', 'Fairground Urban Oasis Apartments, 37, Peter Mawatha, Rajagiriya', '2022-01-03 10:59:24'),
(17, 'Mr. B. M. K. Lankathilaka', '', '2022-01-04', 'August 20', '0757397371', 'Friend', '253A, Galahitiyawa, Ganemulla.', '2022-01-04 05:41:48'),
(18, 'Mr. Thivanka Ranawaka', '', '2022-01-04', 'July 16', '0715500791', 'Friend', '46/1a, Fingate Apartment, Raththanapitiya, Boralasgamuwa', '2022-01-04 07:34:26'),
(19, 'Mr. T. N. Marso', 'niroy.marso@gmail.com', '2022-01-04', 'December 29', '0773867730', 'Friend', '506a1/1, Dharamapala Mawatha, Thalawathugoda', '2022-01-04 11:44:16'),
(20, 'BAE Workshop', '', '2022-01-04', ' ', '0766454545', 'Friend', '3/8, Gunasekara Gardens, Nawala, Rajagiriya', '2022-01-04 10:12:14'),
(23, 'Mrs. Chandi Thilakaratne', '', '2022-01-05', 'August 01', '0773670202', 'Friend', '24, Thalgahawatta Mawatha, Boralasgamuwa', '2022-01-05 06:04:21'),
(24, 'Viraj Gunathilake', 'lahiruviraj1994@yahoo.com', '2022-01-05', ' 22/04', '0766174491', 'Other', '47/1 Moonvalley Estate', '2022-01-05 16:41:38'),
(25, 'Mrs. Ammasi Vijayaletchumi', 'thiru012345@yahoo.com', '2022-01-06', 'April 13', '0777706755', 'Friend', '98, Quarry Road, Dehiwala', '2022-01-06 04:30:58'),
(26, 'Mr. Surendra Bandara', 'surendra.bandara@gmail.com', '2022-01-07', 'May 01', '0773524898', 'Friend', '111/3, Samadhi Lane, Malkaduwawa Kurunegala', '2022-01-07 05:36:35'),
(27, 'Mr. Oshadha Ratnaweera', 'oshadha_ratnaweera@outlook.com', '2022-01-07', ' ', '0777770492', 'Friend', '562/20, Welikada Terrace, Nawala Road, Rajagiriya', '2022-01-07 10:57:22'),
(28, 'Mr. C. D. N Gamage ', '', '2022-01-08', ' ', '0777460092', 'Friend', 'No 50, Diyawanna Gardens, Pagoda Road, Nugegoda', '2022-01-08 06:30:50'),
(29, 'Mr. Iroshana Mayadunna', 'iroshana@jiptech.com', '2022-01-10', 'January 18', '0777770766', 'Friend', '153/4, Vithana Mawatha, Ranala Road, Habarakada, Homagama.', '2022-01-10 04:04:33'),
(30, 'Dr. M K S I Kumara', '', '2022-01-10', ' ', '0777392848', 'Friend', 'No 146/1, Pahala Bomiriya, Kaduwela', '2022-01-10 05:19:30'),
(31, 'Mag City', 'info@magcitylk.com', '2022-01-10', ' ', '0112 199 799', 'Friend', '344 Old Kottawa Rd, Nugegoda 10250', '2022-01-10 05:56:44'),
(32, 'Mr. K. G. H. Meduwantha', 'hasi98medu@gmail.com', '2022-01-10', 'June 02', '0777206437', 'Friend', '81, Orchid House, Chandrika Kumaratunga Mawatha, Mabalabe.', '2022-01-10 06:02:02'),
(33, 'Mr. M. H. M. Shabeer', '', '2022-01-10', ' ', '0777844778', 'Friend', '140, Katugasthota, Kandy', '2022-01-10 09:47:24'),
(34, 'Mr. Sunil Gunawardhana', 'sga63.06@gmail.com', '2022-01-11', ' ', '0712750321', 'Friend', '142/12, Kirimandala Mawatha Colombo 05', '2022-01-11 06:52:27'),
(35, 'Mr. Shahilan Rajaratnam', 'shahilan.rajaratnam@gmail.com', '2022-01-12', ' ', '0777238539', 'Friend', 'p26, Cityciew, Gonahena Road, Ranmuthugala, Kadawatha', '2022-01-12 03:36:31'),
(36, 'Mr. Samitha Gunasekara', 'sl.cm@fpt-asia.com', '2022-01-12', ' ', '0778804125', 'Friend', '117/A, De Mazenod Road, Kandana, Sri Lanka', '2022-01-12 07:43:16'),
(37, 'Mr. Nuwan Mawella', '', '2022-01-12', ' ', '0773443420', 'Friend', ' Salamangewatta, Bandaramulla, Mirissa', '2022-01-12 09:06:30'),
(38, 'Miseru Enterprises (Pvt) Ltd', '', '2022-01-13', ' ', '0712959460 - Chanaka', 'Friend', '17/1, Avissawella Rd, Godagama', '2022-01-13 04:37:20'),
(39, 'Mr. L. Abeysuriya', 'lasanga.abeysuriya@pwc.com', '2022-01-13', 'December 13', '0773508080', 'Friend', '595/7, Wasana Mawatha, Nawala Road, Rajagiriya', '2022-01-13 04:38:41'),
(40, 'Mr. Gihan Thalgodapitiya', 'gihan@hrmi.lk', '2022-01-13', ' ', '0712724425', 'Friend', '312, Park Road, Colombo 05', '2022-01-13 05:12:49'),
(41, 'Mr. Gihan Sameera', 'gihanbsclass@gmail.com', '2022-01-13', ' ', '0719583218', 'Friend', 'D. R. S. Gunsekara Mawatha, Horana', '2022-01-13 05:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_item`
--

CREATE TABLE `tbl_estimate_item` (
  `estimate_item_id` int(11) NOT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_estimate_item`
--

INSERT INTO `tbl_estimate_item` (`estimate_item_id`, `estimate_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `stat`, `datetime`) VALUES
(1, '1', '9', '1', '1', '1', 'new', '0', '2021-12-20 17:06:58'),
(2, '2', '9', '2', '1', '1', 'BN', '0', '2021-12-20 17:17:53'),
(4, '2', '9', '2', '3', '1', 'gen', '0', '2021-12-20 17:17:53'),
(5, '2', '9', '2', '2', '6.5', 'g', '0', '2021-12-20 17:41:58'),
(6, '2', '9', '2', '4', '9', 'gen', '0', '2021-12-20 17:49:32'),
(7, '2', '9', '2', '5', '1', 'oem', '0', '2021-12-20 17:49:32'),
(8, '2', '9', '2', '6', '1', 'g', '0', '2021-12-20 17:49:32'),
(9, '2', '9', '2', '7', '6', 'g', '0', '2021-12-20 17:49:32'),
(10, '2', '9', '2', '8', '1', 'g', '0', '2021-12-20 17:49:32'),
(11, '3', '9', '3', '1', '1', 'g', '0', '2021-12-23 17:19:46'),
(12, '3', '9', '3', '2', '6.5', 'g', '0', '2021-12-23 17:19:46'),
(13, '3', '9', '3', '3', '1', 'g', '0', '2021-12-23 17:19:46'),
(14, '3', '9', '3', '4', '9', 'g', '0', '2021-12-23 17:19:46'),
(15, '3', '9', '3', '5', '1', 'o', '0', '2021-12-23 17:19:46'),
(16, '3', '9', '3', '6', '1', 'g', '0', '2021-12-23 17:19:46'),
(17, '3', '9', '3', '7', '6', 'g', '0', '2021-12-23 17:19:46'),
(18, '3', '9', '3', '8', '6', 'g', '0', '2021-12-23 17:19:46'),
(20, '5', '9', '5', '1', '1', 'g', '0', '2021-12-24 06:23:53'),
(21, '5', '9', '5', '2', '6.5', 'g', '0', '2021-12-24 06:23:53'),
(22, '5', '9', '5', '3', '1', 'g', '0', '2021-12-24 06:23:53'),
(23, '5', '9', '5', '4', '9', 'g', '0', '2021-12-24 06:23:53'),
(24, '5', '9', '5', '6', '1', 'g', '0', '2021-12-24 06:23:53'),
(25, '5', '9', '5', '5', '1', 'g', '0', '2021-12-24 06:23:53'),
(26, '5', '9', '5', '7', '6', 'g', '0', '2021-12-24 06:23:53'),
(27, '5', '9', '5', '8', '1', 'g', '0', '2021-12-24 06:23:53'),
(28, '7', '9', '8', '9', '1', 'o', '0', '2021-12-24 06:29:24'),
(29, '7', '9', '8', '2', '6.5', 'g', '0', '2021-12-24 06:29:24'),
(30, '7', '9', '8', '3', '1', 'g', '0', '2021-12-24 06:29:24'),
(31, '7', '9', '8', '4', '9', 'g', '0', '2021-12-24 06:29:24'),
(32, '7', '9', '8', '5', '1', 'g', '0', '2021-12-24 06:29:24'),
(33, '7', '9', '8', '6', '1', 'g', '0', '2021-12-24 06:29:24'),
(34, '7', '9', '8', '7', '6', 'g', '0', '2021-12-24 06:29:24'),
(35, '7', '9', '8', '8', '1', 'g', '0', '2021-12-24 06:29:24'),
(36, '6', '9', '9', '1', '1', '', '0', '2021-12-24 06:32:09'),
(37, '6', '9', '9', '2', '2', 'dgsdg', '0', '2021-12-24 06:32:09'),
(38, '8', '9', '13', '6', '1', '', '0', '2021-12-24 06:48:51'),
(39, '8', '9', '14', '2', '6.5', '', '0', '2021-12-24 06:50:11'),
(40, '8', '9', '14', '7', '6', '', '0', '2021-12-24 06:50:11'),
(41, '8', '9', '14', '8', '1', '', '0', '2021-12-24 06:50:11'),
(42, '8', '9', '14', '3', '1', '', '0', '2021-12-24 06:50:11'),
(43, '8', '9', '14', '10', '1', '', '0', '2021-12-24 06:56:47'),
(44, '8', '9', '14', '11', '1', '', '0', '2021-12-24 06:56:47'),
(45, '10', '9', '16', '221', '2', '', '0', '2021-12-29 18:29:23'),
(46, '10', '9', '17', '2', '2', '', '0', '2021-12-29 18:29:43'),
(47, '10', '9', '17', '9', '3.2', '', '0', '2021-12-29 18:30:13'),
(48, '10', '9', '16', '3', '1', '', '0', '2021-12-29 18:30:27'),
(49, '10', '9', '16', '16', '2', '', '0', '2021-12-29 18:30:27'),
(50, '13', '13', '22', '135', '1', 'g', '0', '2022-01-03 05:52:29'),
(51, '21', '11', '53', '394', '1', 'R', '0', '2022-01-06 05:47:38'),
(52, '21', '11', '57', '391', '2', 'GR', '0', '2022-01-06 05:50:52'),
(58, '21', '11', '55', '398', '2', '1', '0', '2022-01-06 06:19:15'),
(59, '21', '11', '53', '395', '1', 'VS', '0', '2022-01-06 06:29:24'),
(64, '21', '11', '54', '229', '2', 'F', '0', '2022-01-06 09:37:18'),
(65, '22', '11', '59', '400', '1', 'TB', '0', '2022-01-06 07:20:48'),
(67, '21', '11', '69', '392', '1', 'E', '0', '2022-01-06 09:05:08'),
(68, '21', '11', '69', '393', '1', 'E', '0', '2022-01-06 09:05:47'),
(69, '20', '11', '70', '406', '1', 'E', '0', '2022-01-06 10:10:21'),
(70, '20', '11', '70', '407', '1', 'E', '0', '2022-01-06 10:10:21'),
(71, '20', '11', '71', '408', '1', 'R', '0', '2022-01-06 10:10:58'),
(72, '20', '11', '72', '229', '2', 'C', '0', '2022-01-06 10:11:30'),
(73, '20', '11', '74', '405', '2', 'G', '0', '2022-01-06 10:12:01'),
(75, '20', '11', '71', '409', '1', 'V', '0', '2022-01-06 10:14:09'),
(76, '20', '11', '73', '399', '4', 'O', '0', '2022-01-06 10:38:32'),
(77, '20', '13', '73', '427', '1', '', '0', '2022-01-06 12:29:57'),
(78, '21', '13', '55', '427', '1', '', '0', '2022-01-06 12:33:44'),
(81, '23', '11', '76', '380', '1', 'CF', '0', '2022-01-07 12:14:17'),
(82, '23', '11', '77', '411', '1', 'O', '0', '2022-01-07 12:15:42'),
(83, '23', '11', '77', '382', '4', 'CS', '0', '2022-01-07 12:16:44'),
(84, '23', '11', '78', '383', '1', 'OL', '0', '2022-01-07 12:17:19'),
(85, '23', '11', '79', '384', '1', 'OP', '0', '2022-01-07 12:18:14'),
(86, '23', '11', '80', '239', '1', '5W', '0', '2022-01-07 12:19:29'),
(87, '23', '11', '82', '229', '6', 'O', '0', '2022-01-07 12:19:18'),
(88, '23', '11', '81', '112', '2', 'GO', '0', '2022-01-07 12:21:19'),
(89, '24', '11', '83', '240', '4.25', 'FS', '0', '2022-01-08 06:42:06'),
(90, '24', '11', '83', '12', '1', 'F', '0', '2022-01-08 06:42:06'),
(92, '31', '13', '89', '442', '1', '', '7', '2022-01-10 06:12:38'),
(93, '32', '12', '92', '36', '2', '1', '0', '2022-01-10 10:48:59'),
(94, '32', '12', '93', '34', '1', '1', '0', '2022-01-10 10:50:55'),
(100, '37', '12', '99', '80', '1', '1', '0', '2022-01-11 07:11:12'),
(101, '37', '12', '99', '21', '1', '1', '0', '2022-01-11 07:11:12'),
(102, '38', '12', '100', '2', '4.75', '1', '0', '2022-01-11 07:20:33'),
(103, '38', '12', '100', '84', '1', '1', '0', '2022-01-11 07:20:33'),
(104, '36', '13', '101', '212', '1', '', '0', '2022-01-11 18:52:48'),
(105, '36', '13', '101', '213', '1', '', '0', '2022-01-11 18:52:48'),
(106, '36', '13', '101', '214', '1', '', '0', '2022-01-11 18:52:48'),
(107, '36', '13', '101', '215', '1', '', '0', '2022-01-11 18:52:48'),
(108, '36', '13', '102', '499', '1', '', '0', '2022-01-11 18:53:22'),
(109, '36', '13', '102', '500', '1', '', '0', '2022-01-11 18:53:22'),
(110, '36', '13', '102', '501', '2', '', '0', '2022-01-11 18:53:38'),
(111, '36', '13', '103', '498', '2', '', '0', '2022-01-11 18:54:13'),
(112, '36', '13', '104', '503', '1', '', '0', '2022-01-11 18:54:47'),
(113, '36', '13', '104', '504', '1', '', '0', '2022-01-11 18:54:47'),
(114, '36', '13', '104', '502', '2', '', '0', '2022-01-11 18:54:47'),
(115, '36', '13', '106', '506', '1', '', '0', '2022-01-11 19:01:44'),
(116, '36', '13', '106', '505', '1', '', '0', '2022-01-11 19:01:44'),
(117, '36', '13', '106', '507', '1', '', '0', '2022-01-11 19:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_labour`
--

CREATE TABLE `tbl_estimate_labour` (
  `estimate_labour_id` int(11) NOT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `estimate_fru` varchar(255) DEFAULT NULL,
  `labour_name_1` mediumtext,
  `labour_name_2` mediumtext,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_estimate_labour`
--

INSERT INTO `tbl_estimate_labour` (`estimate_labour_id`, `estimate_id`, `labour_id`, `estimate_fru`, `labour_name_1`, `labour_name_2`, `datetime`) VALUES
(1, '1', '1', '157', 'Installing engine exchange', '', '2021-12-21 05:36:09'),
(2, '2', '1', '157', 'Installing engine exchange', '', '2021-12-21 05:47:14'),
(3, '3', '1', '157', 'Installing engine exchange', '', '2021-12-24 05:48:17'),
(5, '5', '1', '157', 'Installing engine exchange', '', '2021-12-24 18:51:24'),
(6, '5', '0', '4', 'Perform vehicle test', '', '2021-12-24 06:24:18'),
(7, '5', '0', '42', 'Marking engine number', '', '2021-12-24 06:24:32'),
(8, '7', '1', '157', 'Installing engine exchange', '', '2021-12-24 18:57:27'),
(9, '6', '0', '10', 'Perform vehicle test', '', '2021-12-24 06:29:08'),
(10, '7', '0', '4', 'Perform vehicle test', '', '2021-12-24 06:29:43'),
(11, '8', '1', '4', 'Diagnose engine noise', '', '2021-12-24 19:18:29'),
(12, '8', '2', '6', 'Remove and install/replace chain tensioner piston', '', '2021-12-24 19:18:29'),
(13, '8', '3', '23', 'Removing and installing/sealing cylinder head cover', '', '2021-12-24 19:18:29'),
(15, '9', '0', '5', 'Oil Service', '', '2021-12-24 08:19:13'),
(16, '10', '0', '10', 'Replace Tyres', '', '2021-12-29 18:28:50'),
(17, '10', '0', '4', 'Perform vehicle test', '', '2021-12-29 18:28:58'),
(18, '11', '1', '5', 'Replace power steering battery', '', '2021-12-31 23:50:36'),
(19, '11', '1', '', 'Cylinder damage diagnosis', '', '2021-12-31 23:51:57'),
(20, '11', '2', '', 'Rehoning all cylinders', '(engine dismantled)', '2021-12-31 23:51:57'),
(21, '11', '3', '23', 'Removing and installing/sealing cylinder head cover', '', '2021-12-31 23:51:57'),
(22, '13', '1', '8', 'Removing and installing/replacing vibration damper', '', '2022-01-03 18:22:02'),
(23, '15', '0', '5', 'Oil Service', '', '2022-01-03 08:17:06'),
(24, '16', '1', '5', 'Vehicle service - check before expiry of warranty', '', '2022-01-04 01:27:04'),
(25, '16', '2', '4', 'Vehicle service - check before expiry of warranty', '', '2022-01-04 01:27:04'),
(26, '16', '3', '16', 'BMW Premium Selection 360 degree vehicle check (only for German market)', '', '2022-01-04 01:27:04'),
(28, '17', '1', '4', 'troubleshoot engine noise', '', '2022-01-04 17:00:49'),
(29, '17', '2', '6', 'Remove and install/replace chain tensioner piston', '', '2022-01-04 17:00:49'),
(30, '17', '3', '21', 'Removing and installing/sealing cylinder head cover', '', '2022-01-04 17:00:49'),
(32, '17', '5', '180', 'Removing, disassembe and reinstall  engine', '', '2022-01-04 17:00:49'),
(33, '17', '1', '4', 'troubleshoot engine noise', '', '2022-01-04 17:01:26'),
(34, '17', '2', '6', 'Remove and install/replace chain tensioner piston', '', '2022-01-04 17:01:26'),
(35, '17', '3', '21', 'Removing and installing/sealing cylinder head cover', '', '2022-01-04 17:01:26'),
(37, '17', '5', '180', 'Removing, disassembe and reinstall  engine', '', '2022-01-04 17:01:26'),
(38, '17', '1', '4', 'troubleshoot engine noise', '', '2022-01-04 17:02:08'),
(39, '17', '2', '6', 'Remove and install/replace chain tensioner piston', '', '2022-01-04 17:02:08'),
(40, '17', '3', '21', 'Removing and installing/sealing cylinder head cover', '', '2022-01-04 17:02:08'),
(42, '17', '5', '180', 'Removing, disassembe and reinstall  engine', '', '2022-01-04 17:02:08'),
(43, '17', '1', '4', 'troubleshoot engine noise', '', '2022-01-04 17:04:04'),
(44, '17', '2', '6', 'Remove and install/replace chain tensioner piston', '', '2022-01-04 17:04:04'),
(45, '17', '3', '21', 'Removing and installing/sealing cylinder head cover', '', '2022-01-04 17:04:04'),
(47, '17', '5', '180', 'Removing, disassembe and reinstall  engine', '', '2022-01-04 17:04:04'),
(48, '19', '1', '18', 'Replace two injectors from the injection system.', '(after vehicle diagnosis)', '2022-01-04 17:17:30'),
(49, '19', '2', '5', 'Replace pressure line', '(between high pressure pump and pressure accumulator, left or right as applicable)', '2022-01-04 17:17:30'),
(50, '19', '3', '4', 'Remove and install intake silencer housing', '', '2022-01-04 17:17:30'),
(52, '19', '5', '1', 'Removing And installing/rep. resonator', '', '2022-01-04 17:17:30'),
(53, '21', '1', '13', 'Replacing coolant radiator', '', '2022-01-06 18:10:57'),
(54, '21', '2', '4', 'Check the cooling system for watertightness with the special tool', '', '2022-01-06 18:10:57'),
(55, '21', '3', '12', 'Replacing steering rack O rings', '', '2022-01-06 18:10:57'),
(57, '21', '5', '7', 'Replacing rubber mount for transmission mounting', '', '2022-01-06 18:10:57'),
(59, '22', '1', '50', 'Install the exchange transfer box', '(without programming/encoding, see 61 00 ...)', '2022-01-06 19:09:35'),
(60, '22', '2', '6', 'Initializing transfer box', '', '2022-01-06 19:09:35'),
(63, '4', '1', '18', 'Replace two injectors from the injection system.', '(after vehicle diagnosis)', '2022-01-06 19:25:17'),
(64, '4', '2', '5', 'Replace pressure line', '(between high pressure pump and pressure accumulator, left or right as applicable)', '2022-01-06 19:25:17'),
(65, '4', '3', '4', 'Remove and install intake silencer housing', '', '2022-01-06 19:25:17'),
(66, '4', '4', '3', 'Removing And installing/rep. resonator', '', '2022-01-06 19:25:17'),
(67, '4', '5', '1', 'Removing And installing/rep. resonator', '', '2022-01-06 19:25:17'),
(69, '21', '1', '12', 'Replacing both engine mounts', '', '2022-01-06 20:08:37'),
(70, '20', '1', '12', 'Replacing both engine mounts', '', '2022-01-06 22:36:34'),
(71, '20', '2', '13', 'Replacing coolant radiator', '', '2022-01-06 22:36:34'),
(72, '20', '3', '4', 'Check the cooling system for watertightness with the special tool', '', '2022-01-06 22:36:34'),
(73, '20', '4', '12', 'Replacing steering rack O rings', '', '2022-01-06 22:36:34'),
(74, '20', '5', '7', 'Replacing rubber mount for transmission mounting', '', '2022-01-06 22:36:34'),
(76, '23', '1', '12', 'sealing oil coolant heat exchanger', '', '2022-01-07 22:43:40'),
(77, '23', '2', '3', 'Replacing coolant connector', '', '2022-01-07 22:43:40'),
(78, '23', '3', '6', 'Replacing sensor gasket', '', '2022-01-07 22:43:40'),
(79, '23', '4', '6', 'Replacing oil cooling line', '', '2022-01-07 22:43:40'),
(80, '23', '5', '1', 'Topping up engine oil', '', '2022-01-07 22:43:40'),
(81, '23', '6', '6', 'Topping up Transmission fluid', '', '2022-01-07 22:43:40'),
(82, '23', '7', '4', 'Check the cooling system for watertightness with the special tool', '(with tester)', '2022-01-07 22:43:40'),
(83, '24', '1', '157', 'Installing engine exchange', '', '2022-01-08 19:02:19'),
(84, '24', '2', '25', 'Vehicle program', '', '2022-01-08 19:02:19'),
(85, '27', '1', '5', 'Remove and install/seal throttle body', '', '2022-01-09 21:22:49'),
(86, '27', '2', '3', 'Completely replacing the throttle body', '', '2022-01-09 21:22:49'),
(87, '27', '3', '4', 'Replacing air intake hose', '(between air mass meter and throttle body and connecting piece)', '2022-01-09 21:22:49'),
(88, '27', '4', '2', 'Removing and installing/replacing differential pressure sensor', '', '2022-01-09 21:22:49'),
(89, '31', '0', '0', 'PART SALE', '', '2022-01-10 05:59:17'),
(92, '32', '1', '12', 'Replacing balancing shaft oil seals', '', '2022-01-10 23:18:42'),
(93, '32', '2', '13', 'Removing and installing the intake plenum', '', '2022-01-10 23:18:42'),
(99, '37', '1', '10', 'Replacing both rear brake pads of disk brakes', '', '2022-01-11 19:39:52'),
(100, '38', '0', '15', 'Oil Service', '', '2022-01-11 07:19:10'),
(101, '36', '1', '12', 'removing and refitting front bumper', '', '2022-01-12 07:02:37'),
(102, '36', '2', '16', 'Removing and installing/replacing both wishbones at bottom', '(AW specification without wheel alignment)', '2022-01-12 07:02:37'),
(103, '36', '3', '16', 'Removing and installing/replacing both wishbones, top', '', '2022-01-12 07:02:37'),
(104, '36', '4', '9', 'Replacing both bellows for steering gear', '(AW specification without wheel alignment)', '2022-01-12 07:02:37'),
(105, '36', '5', '15', 'Wheel alignment', '', '2022-01-12 07:02:37'),
(106, '36', '6', '7', 'Remove and install rain-light-solar- condensation sensor', '', '2022-01-12 07:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_sublet`
--

CREATE TABLE `tbl_estimate_sublet` (
  `sublet_id` int(11) NOT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `sublet_description` mediumtext,
  `sublet_price` varchar(255) DEFAULT NULL,
  `sublet_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_estimate_sublet`
--

INSERT INTO `tbl_estimate_sublet` (`sublet_id`, `estimate_id`, `sublet_description`, `sublet_price`, `sublet_datetime`) VALUES
(1, '37', 'CONSUMABLES', '300', '2022-01-11 12:41:33'),
(2, '38', 'CONSUMABLES', '300', '2022-01-11 12:51:24'),
(3, '36', 'MISC', '1500', '2022-01-12 00:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_tax`
--

CREATE TABLE `tbl_estimate_tax` (
  `tax_id` int(11) NOT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_estimate_tax`
--

INSERT INTO `tbl_estimate_tax` (`tax_id`, `estimate_id`, `user_id`, `vat`, `discount`, `note`, `additional_price`, `datetime`) VALUES
(1, '3', '9', '0', '0', 'Estimate is for a brand new BMW 523i N52N short engine.\r\n\r\nWarranty period for the engine is 5 years, all engine related maintenance must be carried out at Bavarian Automobile Engineering (Pvt) Ltd during this period. Failing to do so will void the warranty of the engine.\r\n\r\nValve cover gasket, sleeves and other gaskets are only estimated to be replaced if necessary only. ', '12000', '2021-12-23 22:51:12'),
(2, '4', '9', '0', '0', 'df hyrdhyreh ', '100', '2021-12-24 11:24:59'),
(3, '5', '9', '0', '0', 'Estimate is for a brand new BMW 523i N52N short engine.\r\n\r\nWarranty period for the engine is 5 years, all engine related maintenance must be carried out at Bavarian Automobile Engineering (Pvt) Ltd during this period. Failing to do so will void the warranty of the engine.\r\n\r\nValve cover gasket, sleeves and other gaskets are only estimated to be replaced if necessary only. ', '1000', '2021-12-24 11:55:16'),
(4, '7', '9', '0', '0', 'Estimate is for a reconditioned BMW 523i N52N short engine.\r\n\r\nWarranty period for the engine is 6 months, all engine related maintenance must be carried out at Bavarian Automobile Engineering (Pvt) Ltd during this period. Failing to do so will void the warranty of the engine.\r\n\r\nValve cover gasket, sleeves and other gaskets are only estimated to be replaced if necessary only. \r\n\r\nNew engine numbers will be provided upon completion of the repair.', '2500', '2021-12-24 12:01:50'),
(5, '8', '9', '0', '0', 'Supplementary estimate will be forwarded after disassembling engine.\r\n\r\nQuotation is valid for 30 days.', '0', '2021-12-24 12:29:13'),
(6, '13', '13', '0', '0', '', '0', '2022-01-03 11:22:42'),
(7, '15', '9', '2', '0', 'dsgsdg', '1200', '2022-01-03 13:56:09'),
(8, '16', '9', '0', '0', '', '0', '2022-01-06 12:26:59'),
(9, '17', '9', '0', '0', '', '0', '2022-01-06 12:27:40'),
(10, '18', '13', '0', '0', '', '0', '2022-01-06 12:59:53'),
(11, '19', '9', '0', '0', '', '0', '2022-01-09 19:41:57'),
(12, '20', '13', '0', '0', 'PARTS NEED TO BE IMPORTED AND SUPPLIED DELIVERY TIME IS 7-10 WORKING DAYS\r\n\r\n30% ADVANCE REQUIRED TO CONFIRM ORDER. \r\n\r\nESTIMATE PROVIDED IS FOR BMW GENUINE PARTS.\r\n\r\n', '0', '2022-01-06 18:06:19'),
(13, '21', '13', '0', '0', 'DELIVERY TIME IS 2-3 WEEKS UPON CONFIRMATION. \r\n\r\n50% ADVANCE OF TOTAL ESTIMATE REQUIRED TO CONFIRM ORDER. \r\n\r\nESTIMATE PROVIDED FOR BMW GENUINE PARTS.', '0', '2022-01-06 18:07:39'),
(14, '22', '9', '0', '0', '', '0', '2022-01-06 14:13:11'),
(15, '23', '12', '0', '0', '', '0', '2022-01-08 10:26:05'),
(16, '24', NULL, '0', '0', NULL, '0', NULL),
(17, '25', NULL, '0', '0', NULL, '0', NULL),
(18, '26', '9', '0', '0', '', '0', '2022-01-09 23:44:32'),
(19, '27', '9', '0', '0', '', '0', '2022-01-09 15:13:23'),
(23, '31', '13', '0', '0', '', '0', '2022-01-10 11:44:12'),
(24, '32', '12', '0', '0', '', '0', '2022-01-10 16:21:04'),
(28, '36', '13', '0', '0', 'Suspension Repair', '0', NULL),
(29, '37', '12', '0', '0', 'Rear brake pads', '0', NULL),
(30, '38', '12', '0', '0', 'Oil Service', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_vehicle_number`
--

CREATE TABLE `tbl_estimate_vehicle_number` (
  `estimate_id` int(11) NOT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_estimate_vehicle_number`
--

INSERT INTO `tbl_estimate_vehicle_number` (`estimate_id`, `license_no`, `mileage`, `date`, `reg_date`) VALUES
(3, 'WP KR-2760', '104500', '2021-12-23 22:47:50', '2021-12-23 17:17:50'),
(4, 'KJ-1086', '1000', '2021-12-24 11:23:26', '2021-12-24 05:53:26'),
(5, 'WP KR-2760', '104500', '2021-12-24 11:46:21', '2021-12-24 06:16:21'),
(7, 'WP KR-2760', '104500', '2021-12-24 11:57:15', '2021-12-24 06:27:15'),
(8, 'WP KR-2760', '104500', '2021-12-24 12:18:19', '2021-12-24 06:48:19'),
(13, 'WP CAD4542', '500', '2022-01-03 11:21:52', '2022-01-03 05:51:52'),
(15, 'KJ-1086', '123', '2022-01-03 13:39:07', '2022-01-03 08:09:07'),
(16, 'KJ-1086', '1000', '2022-01-03 18:04:54', '2022-01-03 12:34:54'),
(17, 'WP CBF1070', '500', '2022-01-04 09:29:27', '2022-01-04 03:59:27'),
(18, 'WP CBF1070', '500', '2022-01-04 10:07:23', '2022-01-04 04:37:23'),
(19, 'KJ-1086', '1000', '2022-01-04 10:17:00', '2022-01-04 04:47:00'),
(20, 'WP KO-4750', '49373', '2022-01-05 14:12:44', '2022-01-05 08:42:44'),
(21, 'WP KO-4750', '500', '2022-01-06 11:01:14', '2022-01-06 05:31:14'),
(22, 'WP CBH 3238', '500', '2022-01-06 12:00:32', '2022-01-06 06:30:32'),
(23, 'WBAKM42090C232755', '500', '2022-01-07 15:27:23', '2022-01-07 09:57:23'),
(24, 'WP CBE9100', '500', '2022-01-08 11:59:22', '2022-01-08 06:29:22'),
(25, 'CP KR-8846', '500', '2022-01-08 13:03:29', '2022-01-08 07:33:29'),
(26, 'CP KR-8846', '5', '2022-01-08 13:05:36', '2022-01-08 07:35:36'),
(27, 'KJ-1086', '236', '2022-01-09 14:22:33', '2022-01-09 08:52:33'),
(31, 'NA', '0', '2022-01-10 11:28:30', '2022-01-10 05:58:30'),
(32, 'WP KV-0188', '85065', '2022-01-10 16:09:58', '2022-01-10 10:39:58'),
(34, 'KJ-1086', '1000', '2022-01-11 01:06:17', '2022-01-10 19:36:17'),
(35, 'KJ-1086', '1000', '2022-01-11 04:18:48', '2022-01-10 22:48:48'),
(36, 'CP KR-8846', '128510', '2022-01-11 11:47:00', '2022-01-11 06:17:00'),
(37, 'WP CAX8228', '68390', '2022-01-11 12:39:19', '2022-01-11 07:09:19'),
(38, 'WP CAX8228', '68390', '2022-01-11 12:48:58', '2022-01-11 07:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `image_id` int(11) NOT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `img5` varchar(255) DEFAULT NULL,
  `img6` varchar(255) DEFAULT NULL,
  `img7` varchar(255) DEFAULT NULL,
  `img8` varchar(255) DEFAULT NULL,
  `img9` varchar(255) DEFAULT NULL,
  `img10` varchar(255) DEFAULT NULL,
  `img11` varchar(255) DEFAULT NULL,
  `img12` varchar(255) DEFAULT NULL,
  `img13` varchar(255) DEFAULT NULL,
  `img14` varchar(255) DEFAULT NULL,
  `img15` varchar(255) DEFAULT NULL,
  `img16` varchar(255) DEFAULT NULL,
  `img17` varchar(255) DEFAULT NULL,
  `img18` varchar(255) DEFAULT NULL,
  `img19` varchar(255) DEFAULT NULL,
  `img20` varchar(255) DEFAULT NULL,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `img_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_new_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `client_address` mediumtext,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `licens_no` varchar(255) DEFAULT NULL,
  `chassis_no` varchar(255) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `labour_total` varchar(255) DEFAULT NULL,
  `parts_total` varchar(255) DEFAULT NULL,
  `sublet_price` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL,
  `advisor` varchar(255) DEFAULT NULL,
  `pay` varchar(3) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `advance_pay` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_new_id`, `invoice_id`, `customer`, `client_address`, `email`, `phone_number`, `licens_no`, `chassis_no`, `mileage`, `invoice_date`, `note`, `labour_total`, `parts_total`, `sublet_price`, `sub_total`, `vat`, `grand_total`, `advisor`, `pay`, `stat`, `advance_pay`, `datetime`) VALUES
(1, '1', 'Mr Saffan ', '27 12 Park Lane, nawala Road,  Rajagiriya', 'info5@gmail.com', '0777886216', 'WP CAW0220', 'WBA7J22010G497083', '29600', '2021-12-30 13:11:41', '', '1375', '39300', '0', '0', '0', '40675', 'Admin', '1', '1', '0', '2022-01-04 11:45:16'),
(4, '10', 'Srinath Weerasinghe', '56C, Narendrasinghe Mawatha, Kundasale', 'tecsrinath@gmail.com', '0774716095', 'CP KR-8846', 'WAUZZZ8KXCA072360', '128510', '2022-01-03 13:25:29', 'Checked suspension - Front bushing, rack ends and tie rod ends need to be replaced.\r\nWiper blades replaced', '1375', '8550', '0', '0', '0', '9925', 'Viraj Gunathilake', '1', '1', '0', '2022-01-04 11:45:43'),
(6, '7', 'Mr. Peshala Manoj', '112/5 I Thalangama South, Akuregoda', 'peshtabla123@gmail.com', '0713288466', 'WP KT-2898', 'WBAVN320X0V96666', '116895hkrn wea', '2022-01-03 14:48:21', 'OIL SERVICE CARRIED OUT \r\nINSPECTION REPORT ATTACHED WITH INVOICE\r\n\r\nBANK DETAILS:\r\nBAVARIAN AUTOMOBILE ENGINEERING PVT LTD\r\n0175 1001 0035\r\nSAMPATH BANK - COLOMBO SUPER BRANCH', '1375', '29140', '0', '0', '0', '30515', 'Viraj Gunathilake', '1', '1', '0', '2022-01-04 11:45:50'),
(7, '11', 'Mr. Chandana Wickramassinghe', '949/13, Udawatta Road, Thalangama North, Mabala', '', '0777311826', 'WP CAD4542', 'WBAFW12090D272998', '101459', '2022-01-03 16:05:27', 'CHECKED VEHICLE BREAKDOWN -\r\n\r\n- FOUND THE ENGINE VIBRATION DAMPER DAMAGED - REPLACED VIBRATION DAMPER.\r\n\r\n- CLEARED ALL FAULT MEMORY.\r\n\r\nROAD TESTED - OKAY AT THE TIME OF TEST', '11550', '73200', '0', '0', '0', '84750', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-04 11:45:59'),
(8, '6', 'Mr Charith Gallage', 'Fairground Urban Oasis Apartments, 37, Peter Mawatha, Rajagiriya', '', '0773733688', 'WP KY 6000', 'WBAFW12050C843246', '109886', '2022-01-03 16:39:15', 'CHECKED PDC FAULT - FOUND THE WIRING OF FRONT PDC SYSTEM DAMAGED.\r\n- REPAIRED DAMAGED WIRING.\r\n\r\nCHECKED DRIVETRAIN - FOUND THE EXHAUST BACK PRESSURE SENSOR FAULTY. RECOMMENDED TO REPLACE THE BACK PRESSURE SENSOR AS THE INITIAL STEP. FURTHER FAULT NEEDS TO BE CHECK AFTER BACK PRESSURE SENSOR REPLACEMENT.', '3300', '0', '0', '0', '0', '3300', 'Viraj Gunathilake', '1', '1', '0', '2022-01-04 11:46:08'),
(9, '12', 'Mr. Thishya Weregoda', '46/1a, Fingate Apartment, Raththanapitiya, Boralasgamuwa', '', '0714814217', 'WP CBF1070', 'WBAJG12070EE62366', '65073', '2022-01-04 14:01:30', 'CARRIED OUT FRONT BRAKE PAD SERVICE -\r\n- REPLACED FRONT BRAKES PADS.\r\n- REPLACED FRONT BRAKE PADS WEAR SENSOR.\r\n\r\nREAR BRAKE PADS ARE CLOSE THE MINIMUM REQUIRED THICKNESS - WILL NEED TO BE REPLACED IN APROXIMATELY 3000KM.\r\n\r\nCHECKED THE CONDITION OF THE BATTERY - FOUND THE BATTERY WEAK \r\n- RECOMMENDED TO REPLACE.\r\n\r\nROAD TESTED - ALL OKAY AT THE TIME OF TEST.', '2200', '34500', '3600', '0', '0', '36700', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-04 11:46:15'),
(10, '17', 'Mr. T. N. Marso', '506a1/1, Dharamapala Mawatha, Thalawathugoda', 'niroy.marso@gmail.com', '0773867730', 'WP CBF0705', 'WBAJG12080EG23503', '36582', '2022-01-04 17:05:49', 'CHECKED VEHICLE NOT STARTING -\r\n\r\nFOUND THE VEHICLE BATTERY WEAK.\r\n\r\nREPLACED AND REGISTERED BATTERY.\r\n\r\nCHECKED FUNCTIONS OF THE VEHICLE - OKAY AT THE TIME OF TEST.', '2750', '32800', '0', '0', '0', '35550', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-04 11:48:59'),
(11, '14', 'Mr. Champika Karunaratne', 'Fairground Urban Oasis Apartments, 37, Peter Mawatha, Rajagiriya', '', '0777812588', 'WP CBM0025', 'WBA8E36010NU32741', '12961', '2022-01-05 13:32:33', 'CARRIED OUT ENGINE OIL SERVICE -\r\n- REPLACED ENGINE OIL AND OIL FILTER\r\n- CLEANED ENGINE AIR FILTER AS IT WAS IN A GOOD CONDITION\r\n- CLEANED A/C MICRO FILTERS.\r\n\r\nCHECKED AND DELETED ALL FAULT MEMORY.\r\n\r\nREPLACED AND BALANCED BOTH REAR TYRES.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST\r\n', '5500', '113499', '600', '0', '0', '119599', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-05 16:20:50'),
(12, '20', 'Mrs. Chandi Thilakaratne', '24, Thalgahawatta Mawatha, Boralasgamuwa', '', '0773670202', 'WP KO-4750', 'WBAVL32020VP88680', '49373', '2022-01-05 13:58:06', 'CARRIED OUT VEHICLE INSPECTION -\r\n\r\n- FOUND THE COOLANT RADIATOR SEVERELY LEAKING - RECOMMENDED TO REPLACE COOLANT RADIATOR.\r\n\r\nFOUND STEERING RACK O RINGS LEAKING STEERIING HYDRAULICH FLUID - RECOMMENDED TO REPLACE O RINGS.\r\n\r\n- FOUND THE ENGINE MOUNTS WEAK - RECOMMENDED TO REPLACE BOTH ENGINE MOUNTS.\r\n\r\n- FOUND TRANSMISSION MOUNTS BROKEN - RECOMMENDED TO REPLACE BOTH TRANSMISSION MOUNTS.', '3300', '0', '0', '0', '0', '3300', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-05 10:01:16'),
(13, '5', 'Noor Sons (Pvt) Ltd', '24-1/ Sir Henry De Mel Mawatha, Colombo 02', 'saleemn3@gmail.com', '0777303453', 'WP CAD2001', 'WBAFW12020C840790', '85699', '2022-01-06 12:27:46', 'REPAINTED FRONT BUMPER, LH SIDE SKIRT, RH FENDER AND REAR BUMPER DIFFUSER.\r\n\r\nREAR BUMPER AND FULL WAX DONE FREE OF CHARGE', '24475', '7535.20292', '0', '0', '0', '32010.20292', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-06 07:21:09'),
(14, '21', 'Mrs. Ammasi Vijayaletchumi', '98, Quarry Road, Dehiwala', 'thiru012345@yahoo.com', '0777706755', 'WP CAX1441', 'WBAKT020100T68360', '50023', '2022-01-06 15:57:21', 'CARRIED OUT VEHICLE OIL SERVICE â€“\r\n- REPLACED ENGINE OIL AND OIL FILTER.\r\n- CLEANED ENGINE AIR FILTER AS IT WAS IN A GOOD CONDITION.\r\n- CLEANED A/C MICRO FILTER AS IT WAS IN A GOOD CONDITION.\r\n\r\nPERFOMED VEHICLE TEST â€“ FOUND HIGH VOLTAGE BATTERY CELL N0.03 TEMPERATURE FAULT IN THE FAULT MEMORY. FAULT CURRENTLY NOT PRESENT IN THE SYSTEM. NEEDS ATTENTION. \r\n\r\nCARRIED OUT VEHICLE INSPECTION-\r\nBRAKE PADS (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 5.60mm / RIGHT â€“ 5.60mm\r\nREAR â€“ LEFT â€“ 8.80mm / RIGHT â€“ 8.80mm\r\n\r\nFRONT BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 28.40mm)\r\nFRONT â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\nREAR BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 18.40mm)\r\nREAR â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\n\r\nFRONT TYRE PRESSURE MUST BE 2.20bar\r\nFRONT â€“ LEFT â€“ 2.20bar / RIGHT â€“ 2.20bar\r\nREAR TYRE PRESSURE MUST BE 2.20bar\r\nREAR â€“ LEFT â€“ 2.20bar / RIGHT â€“ 2.20bar\r\n\r\nTYRE THREAD DEPTH (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 6.00mm / RIGHT â€“ 6.00mm\r\nREAR â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\n\r\nINNER EDGE OF THE REAR TYRES WORN RELATIVE TO THE OUTER EDGE â€“ RECOMMENDED TO CARRY OUT WHEEL ALIGNMENT.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST.\r\n', '4125', '29025', '0', '0', '0', '33150', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-07 01:56:22'),
(15, '23', 'Mr. Surendra Bandara', '111/3, Samadhi Lane, Malkaduwawa Kurunegala', 'surendra.bandara@gmail.com', '0773524898', 'WP CBI9596', 'WBA8E32090A019625', '24374', '2022-01-07 14:20:10', 'CHECK MULTIPLE FAULTS INDICATING - FOUND FAULT IN THE FRONT RIGHT WHEEL SPEED SENSOR AND THE REAR LEFT WHEEL SPEED SENSOR.\r\n- REPLACED FRONT RIGHT AND REAR LEFT WHEEL SPEED SENSORS.\r\nREPLACED WITH OEM PARTS. REPLACED PARTS ARE ENTITLED FOR A WARRANTY PERIOD OF 6 MONTHS.\r\n\r\nCHECKED COMFORT ACCESS NOT WORKING - FOUND WIRING OF THE FRON RIGHT COMFORT ACCESS SIGNALL ANTENNA DAMAGED FROM 2 PLACES - REPAIRED.\r\n\r\nROAD TESTED - ALL OKAY AT THE TIME OF TEST.', '5775', '36840', '0', '0', '0', '42615', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-08 16:23:40'),
(16, '24', 'Mr Saffan ', '27 12 Park Lane, nawala Road,  Rajagiriya', 'info5@gmail.com', '0777886216', 'WP KM-0648', 'WBAFP32090C545498', '85895', '2022-01-07 14:41:27', 'TOPPED UP 1 LITER OF ENGINE OIL', '0', '4700', '0', '0', '0', '4700', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-08 16:21:20'),
(17, '25', 'Mr. Oshadha Ratnaweera', '562/20, Welikada Terrace, Nawala Road, Rajagiriya', 'oshadha_ratnaweera@outlook.com', '0777770492', 'WP CAD7373', 'WBAYA02060C993366', '79289', '2022-01-07 17:21:54', 'REPLACING OIL FILTER HOUSING GASKETS', '4950', '175', '0', '0', '0', '5125', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-08 16:21:28'),
(18, '13', 'Dr. T. A. C. V. Thambugala', '949/13, Udawatta Road, Thalangama North, Mabala', '', '0777138950', 'WP CBH 3238', 'WBA7J22000B219210', '32472', '2022-01-08 13:56:46', 'CHECKED VEHICLE JERK WHEN DRIVING - \r\n\r\nPERFORMED VEHICLE TEST - NO FAULT RELATED TO THE POWERTRAIN SYSTEM.\r\n\r\nRECOMMENDED TO CARRY OUT TRANSFER BOX CALIBRATION.\r\n\r\nTRANSFER BOX CALIBRATION NOT CARRIED OUT AS PER CUSTOMERS REQUEST.', '1100', '2670', '0', '0', '0', '3770', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-08 16:21:34'),
(21, '29', 'Mr. K. G. H. Meduwantha', '81, Orchid House, Chandrika Kumaratunga Mawatha, Mabalabe.', 'hasi98medu@gmail.com', '0777206437', 'NC CAG8118', 'WBAYA020X0D365613', '58710', '2022-01-10 12:56:28', 'FOUND BOTH FRONT CONTROL ARM BUSH BROKEN, NEED TO REPLACE EITHER BUSHES OR ARMS.\r\nESTIMATES WILL BE PROVIDED', '1100', '0', '0', '0', '0', '1100', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-10 10:09:35'),
(22, '28', 'Dr. T. A. C. V. Thambugala', '949/13, Udawatta Road, Thalangama North, Mabala', '', '0777138950', 'WP CBH 3238', 'WBA7J22000B219210', '32541', '2022-01-10 13:37:22', 'CARRIED OUT VEHICLE OIL SERVICE â€“\r\n- REPLACED ENGINE OIL AND OIL FILTER.\r\n- REPLACED ENGINE AIR FILTER AS IT WAS CLOGGED.\r\n- CLEANED A/C MICRO FILTER AS IT WAS IN A GOOD CONDITION.\r\n\r\nPERFOMED VEHICLE TEST â€“ FOUND FAULT IN THE SOS SYSTEM BATTERY.\r\nBATTERY LOW VOLTAGE - RECOMMENEDED REPLACED\r\n\r\nCARRIED OUT VEHICLE INSPECTION-\r\nBRAKE PADS (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 6.00mm / RIGHT â€“ 6.00mm\r\nREAR â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\n\r\nFRONT BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 28.40mm)\r\nFRONT â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\nREAR BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 18.40mm)\r\nREAR â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\n\r\nFRONT TYRE PRESSURE MUST BE 2.40bar\r\nFRONT â€“ LEFT â€“ 2.40bar / RIGHT â€“ 2.40bar\r\nREAR TYRE PRESSURE MUST BE 2.40bar\r\nREAR â€“ LEFT â€“ 2.40bar / RIGHT â€“ 2.40bar\r\n\r\nTYRE THREAD DEPTH (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\nREAR â€“ LEFT â€“ 4.50mm / RIGHT â€“ 4.50mm\r\n\r\nRECOMMENDED TO CARRY OUT WHEEL ALIGNMENT.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST.', '3712.5', '39127.5', '300', '0', '0', '43140', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-10 10:09:24'),
(31, '31', 'Mr. M. H. M. Shabeer', '140, Katugasthota, Kandy', '', '0777844778', 'CP KX-8786', 'WBAFW12020DY97338', '86863', '2022-01-12 09:19:22', 'CHECKED FUNCTION OF THE A/C SYSTEM -\r\n\r\nPERFORMED VEHICLE TEST - NO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nCHECKED TEMPERATURE SENSOR READING AT EVAPORATOR AND OTHER AREAS - ALL UPTO TARGET VALUE.\r\n\r\nNO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nREPLACED THE FRONT CENTER A/C GRILL.', '1650', '9477.5', '0', '0', '0', '11127.5', 'Prashan Yahathugoda', '2', '1', '0', '2022-01-12 04:44:59'),
(32, '37', 'Mr. Samitha Gunasekara', '117/A, De Mazenod Road, Kandana, Sri Lanka', 'sl.cm@fpt-asia.com', '0778804125', 'WP KX-8218', 'WBAVN92050VX48798', '200587', '2022-01-12 14:08:31', 'CHECKED FUNCTION OF THE A/C SYSTEM -\r\n\r\nPERFORMED VEHICLE TEST - NO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nALL A/C TEMPERATURE VALUES ARE OKAY.\r\n\r\nFUNCTION OF THE A/C SYSTEM - OKAY', '1100', '0', '0', '0', '0', '1100', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-12 08:40:07'),
(33, '39', 'Mr. Nuwan Mawella', ' Salamangewatta, Bandaramulla, Mirissa', '', '0773443420', 'WP CAR9777', 'WBAKT020700EPP201', '64428', '2022-01-12 15:26:00', 'CHECKED MULTIPLE FAULT -\r\n\r\nPERFORMED VEHICLE TEST - FOUND THE REAR LEFT WHEEL SPEED SENSOR.\r\n- REPLACED REAR LEFT WHEEL SPEED SENSOR.\r\n\r\nROAD TESTED - OKAY AT THE TIME OF TEST.', '1100', '14850', '0', '0', '0', '15950', 'Prashan Yahathugoda', '2', '1', '0', '2022-01-12 11:38:59'),
(34, '27', 'Mr. Iroshana Mayadunna', '153/4, Vithana Mawatha, Ranala Road, Habarakada, Homagama.', 'iroshana@jiptech.com', '0777770766', 'WP KV-5005', 'WBAFW12040C847997', '89283', '2022-01-12 16:38:55', 'REPLACED FRONT BOTH GRAB HANDLES.\r\n\r\nREPLACED REAR BOTH GRAB HANDLES.\r\n\r\nREPLACED FRONT LEFT AND REAR BOTH POWER WINDOW BUTTON TRIMS.\r\n\r\nREPLACED FRONT CENTER A/C VENT.\r\n\r\nREPLACE ASH TRAY LID MECHANISM.', '6050', '30350.538', '0', '0', '0', '36400.538', 'Viraj Gunathilake', '1', '1', '0', '2022-01-12 11:18:19'),
(36, '38', 'Mr. Iroshana Mayadunna', '153/4, Vithana Mawatha, Ranala Road, Habarakada, Homagama.', 'iroshana@jiptech.com', '0777770766', 'WP KV-5005', 'WBAFW12040C847997', '89283 ', '2022-01-12 16:39:41', 'REPAINTED ALL FOUR ALLOY WHEELS AND BALANCED ALL WHEELS. \r\n\r\nREPLACED ALL TYRE VALVES.\r\n\r\nREFER ATTACHED ESTIMATE FOR A DETAILED BREAKDOWN', '14575', '9720.5549', '4500', '0', '0', '28795.5549', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-12 11:18:01'),
(37, '40', 'Mr. Samitha Gunasekara', '117/A, De Mazenod Road, Kandana, Sri Lanka', 'sl.cm@fpt-asia.com', '0778804125', 'WP KX-8218', 'WBAVN92050VX48798', '200587', '2022-01-12 16:47:29', 'CHECKED LEFT HEADLIGHT - FOUND UNDERNEATH OF THE HEADLIGHT CRACKED - RECOMMENDED TO REPLACE THE HEADLIGHT AND THE DRL UNITS', '550', '0', '0', '0', '0', '550', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-12 11:19:06'),
(38, '36', 'Mr. Shahilan Rajaratnam', 'p26, Cityciew, Gonahena Road, Ranmuthugala, Kadawatha', 'shahilan.rajaratnam@gmail.com', '0777238539', 'SG KR-2312', 'WBAKB42060CY83881', '67859', '2022-01-13 11:21:50', 'CHECKED COOLANT LEVEL REDUCING - FOUND THE RADIATOR LEAKING.\r\n\r\nCUSTOMER REQUESTED TO REPAIR RADIAOTR THEREFORE RADIATOR WAS REMOVED AND HANDED OVER TO CUSTOMER. INSTALLED RADIATOR AFTER RADIATOR REPAIR WAS CARRIED OUT BY CUSTOMER.\r\n\r\nBLED THE COOLING SYSTEM', '5500', '2500', '0', '0', '0', '8000', 'Prashan Yahathugoda', '1', '1', '0', '2022-01-13 06:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_image`
--

CREATE TABLE `tbl_invoice_image` (
  `invoice_image_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `invoice_ss` varchar(100) DEFAULT NULL,
  `invoice_ss_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_image`
--

INSERT INTO `tbl_invoice_image` (`invoice_image_id`, `job_id`, `invoice_id`, `invoice_ss`, `invoice_ss_date`) VALUES
(1, '1', '1', '1640850109.jpg', '2021-12-30 07:41:49'),
(4, '6', '4', '1641196569.jpg', '2022-01-03 07:56:09'),
(5, '6', '5', '1641196575.jpg', '2022-01-03 07:56:15'),
(6, '11', '6', '1641201529.jpg', '2022-01-03 09:18:49'),
(7, '7', '7', '1641206144.jpg', '2022-01-03 10:35:44'),
(8, '10', '8', '1641208162.jpg', '2022-01-03 11:09:22'),
(9, '12', '9', '1641285303.jpg', '2022-01-04 08:35:03'),
(10, '17', '10', '1641296160.jpg', '2022-01-04 11:36:00'),
(11, '14', '11', '1641370434.jpg', '2022-01-05 08:13:54'),
(12, '20', '12', '1641371545.jpg', '2022-01-05 08:32:25'),
(13, '9', '13', '1641452285.jpg', '2022-01-06 06:58:05'),
(14, '21', '14', '1641464867.jpg', '2022-01-06 10:27:47'),
(15, '23', '15', '1641545742.jpg', '2022-01-07 08:55:42'),
(16, '24', '16', '1641546695.jpg', '2022-01-07 09:11:35'),
(17, '25', '17', '1641556320.jpg', '2022-01-07 11:52:00'),
(18, '13', '18', '1641630415.jpg', '2022-01-08 08:26:56'),
(21, '29', '21', '1641799705.jpg', '2022-01-10 07:28:25'),
(22, '28', '22', '1641804072.jpg', '2022-01-10 08:41:12'),
(31, '31', '31', '1641961564.jpg', '2022-01-12 04:26:04'),
(32, '37', '32', '1641976731.jpg', '2022-01-12 08:38:51'),
(33, '39', '33', '1641981447.jpg', '2022-01-12 09:57:28'),
(34, '27', '34', '1641985794.jpg', '2022-01-12 11:09:54'),
(36, '38', '36', '1641986078.jpg', '2022-01-12 11:14:38'),
(37, '40', '37', '1641986280.jpg', '2022-01-12 11:18:00'),
(38, '36', '38', '1642053952.jpg', '2022-01-13 06:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_labour`
--

CREATE TABLE `tbl_invoice_labour` (
  `tbl_invoice_labour_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `labour_details` mediumtext,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_labour`
--

INSERT INTO `tbl_invoice_labour` (`tbl_invoice_labour_id`, `invoice_id`, `labour_id`, `labour_details`, `datetime`) VALUES
(1, '1', '1', '1,Replace power steering battery ,275,5,0,1375', '2021-12-30 07:41:49'),
(4, '4', '4', '4,check suspension noise ,275,5,0,1375', '2022-01-03 07:56:09'),
(5, '4', '7', '7,Replace wiper blades ,275,0,0,0', '2022-01-03 07:56:09'),
(6, '5', '4', '4,check suspension noise ,275,5,0,1375', '2022-01-03 07:56:15'),
(7, '5', '7', '7,Replace wiper blades ,275,0,0,0', '2022-01-03 07:56:15'),
(8, '6', '10', '10,Oil Service ,275,5,0,1375', '2022-01-03 09:18:49'),
(9, '7', '16', '16,REPLACING VIBRATION DAMPER ,275,8,0,2200', '2022-01-03 10:35:44'),
(10, '7', '17', '17,CARRIER CHARGE ,275,34,0,9350', '2022-01-03 10:35:44'),
(11, '8', '9', '9,Check PDC fault and drive train fault ,275,4,0,1100', '2022-01-03 11:09:22'),
(12, '8', '18', '18,CHECKING AND REPAIRING PDC WIRING ,275,8,0,2200', '2022-01-03 11:09:22'),
(13, '9', '11', '11,Removing and installing/replacing brake pads on both front disc brakes ,275,8,0,2200', '2022-01-04 08:35:03'),
(14, '10', '22', '22,Replacing vehicle battery - including registering battery change - ,275,10,0,2750', '2022-01-04 11:36:00'),
(15, '11', '19', '19,Oil Service ,275,15,0,4125', '2022-01-05 08:13:54'),
(16, '11', '21', '21,REPLACING BOTH REAR TYRES ,275,5,0,1375', '2022-01-05 08:13:54'),
(17, '12', '36', '36,VEHICLE INSPECTION ,275,12,0,3300', '2022-01-05 08:32:25'),
(18, '13', '23', '23,Paint Work ,275,89,0,24475', '2022-01-06 06:58:05'),
(19, '14', '39', '39,Oil Service ,275,15,0,4125', '2022-01-06 10:27:47'),
(20, '15', '42', '42,CHECKING COMFORT ACCESS NOT WORKING ,275,4,0,1100', '2022-01-07 08:55:42'),
(21, '15', '45', '45,REPAIRING WIRING OF THE FRONT RIGHT COMFORT ACCESS SIGNAL ANTENNA ,275,12,0,3300', '2022-01-07 08:55:42'),
(22, '15', '48', '48,REPLACING FRONT RIGHT WHEEL SPEED SENSOR (with job item no. 34 50 003),275,2,0,550', '2022-01-07 08:55:42'),
(23, '15', '49', '49,REPLACING REAR LEFT WHEEL SPEED SENSOR (with job item no. 34 50 003),275,3,0,825', '2022-01-07 08:55:42'),
(24, '16', '50', '50,TOPPING UP ENGINE OIL ,275,0,0,0', '2022-01-07 09:11:35'),
(25, '17', '51', '51,Sealing oil coolant heat exchanger ,275,18,0,4950', '2022-01-07 11:52:00'),
(26, '18', '14', '14,CHECKING WOBBLES/JERK WHILE DRIVING ,275,4,0,1100', '2022-01-08 08:26:56'),
(31, '21', '58', '58,Checking front suspension noise ,275,4,0,1100', '2022-01-10 07:28:25'),
(32, '22', '52', '52,Oil Service ,275,15,10,3712.5', '2022-01-10 08:41:12'),
(47, '31', '63', '63,Checking function of the AC system ,275,4,0,1100', '2022-01-12 04:26:04'),
(48, '31', '64', '64,Removing and installing fresh air grille, center ,275,2,0,550', '2022-01-12 04:26:04'),
(49, '32', '68', '68,Checking function of the A/C system ,275,4,0,1100', '2022-01-12 08:38:51'),
(50, '33', '70', '70,Replacing a rear wheel speed sensor (with job item no. 34 50 003),275,4,0,1100', '2022-01-12 09:57:28'),
(51, '34', '54', '54,Removing and installing both front door trim panels ,275,8,0,2200', '2022-01-12 11:09:54'),
(52, '34', '55', '55,Replacing both grab handles at rear ,275,2,0,550', '2022-01-12 11:09:54'),
(53, '34', '56', '56,Removing and installing both rear door trim panels ,275,7,0,1925', '2022-01-12 11:09:54'),
(54, '34', '57', '57,Replacing both grab handles, front ,275,2,0,550', '2022-01-12 11:09:54'),
(55, '34', '72', '72,Replacing fresh air grille, center ,275,2,0,550', '2022-01-12 11:09:54'),
(56, '34', '73', '73,Replacing ashtray lid mechanism ,275,1,0,275', '2022-01-12 11:09:54'),
(58, '36', '69', '69,Paint Work ,275,53,0,14575', '2022-01-12 11:14:38'),
(59, '37', '71', '71,Checking condition of the headlights ,275,2,0,550', '2022-01-12 11:18:00'),
(60, '38', '67', '67,CHECKING ENGINE OVERHEAT ,275,4,0,1100', '2022-01-13 06:05:52'),
(61, '38', '80', '80,Removing and installing coolant radiator ,275,16,0,4400', '2022-01-13 06:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_parts`
--

CREATE TABLE `tbl_invoice_parts` (
  `tbl_invoice_labour_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `part_labour_id` varchar(255) DEFAULT NULL,
  `part_details` mediumtext,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_parts`
--

INSERT INTO `tbl_invoice_parts` (`tbl_invoice_labour_id`, `invoice_id`, `part_labour_id`, `part_details`, `datetime`) VALUES
(1, '1', '1', '1,Original BMW AGM-battery,39300,0,1,39300', '2021-12-30 07:41:49'),
(2, '4', '7', '7,Wiper Blade left,9500.00 ,10,1,8550', '2022-01-03 07:56:09'),
(3, '5', '7', '7,Wiper Blade left,9500.00 ,10,1,8550', '2022-01-03 07:56:15'),
(4, '6', '10', '10,Set oil-filter element,4700,0,1,4700', '2022-01-03 09:18:49'),
(5, '6', '10', '10,HELIX ULTRA 5W-40 209L,4700,0,5.20,24440', '2022-01-03 09:18:49'),
(6, '7', '16', '16,Vibration damper,73200,0,1,73200', '2022-01-03 10:35:44'),
(7, '9', '11', '11, Repair kit, brake pads asbestos-free,34500,0,1,34500', '2022-01-04 08:35:03'),
(8, '10', '22', '22,AMARON L3 BATTERY,32800,0,1,32800', '2022-01-04 11:36:00'),
(9, '11', '19', '19,BMW GR LL01 5W-30 209L,5100,0,4.25,21675', '2022-01-05 08:13:54'),
(10, '11', '19', '19,Oil Filter,5200,0,1,5200', '2022-01-05 08:13:54'),
(11, '11', '21', '21,PIRELLI TYRE 205/60 R16,43312,0,2,86624', '2022-01-05 08:13:54'),
(12, '13', '23', '23,T472/E2 ENVIROBASE BRIGHT MEDIUM ALUMINIUM,13.1666,0,125.1,1647.14166', '2022-01-06 06:58:05'),
(13, '13', '23', '23,T409/2L ENVIROBASE DEEP BLACK,6.7733,0,78.3,530.34939', '2022-01-06 06:58:05'),
(14, '13', '23', '23,T456/E1 ENVIROBASE PEARL BLUE MEDIUM,9.1657,0,26.1,239.22477', '2022-01-06 06:58:05'),
(15, '13', '23', '23,T440/E0.5 ENVIROBASE REDUCE RED OXIDE,6.8655,0,25.4,174.3837', '2022-01-06 06:58:05'),
(16, '13', '23', '23,T443/E1 ENVIROBASE DARL VIOLET,7.5862,0,18.9,143.37918', '2022-01-06 06:58:05'),
(17, '13', '23', '23,T412/E1 ENVIROBASE ROYAL BLUE,9.6223,0,21,202.0683', '2022-01-06 06:58:05'),
(18, '13', '23', '23,T491/E1 ENVIROBASE TONE CONTROLLER,9.0738,0,1.4,12.70332', '2022-01-06 06:58:05'),
(19, '13', '23', '23,T401/E0.5 ENVIROBASE ULTRA FINE WHITE,14.2157,0,6.3,89.55891', '2022-01-06 06:58:05'),
(20, '13', '23', '23,T407 ENVIROBASE JET BLACK,7.8092,0,25.8,201.47736', '2022-01-06 06:58:05'),
(21, '13', '23', '23,T453/E1 ENVIROBASE PEARL MEDIUM,8.3283,0,8.2,68.29206', '2022-01-06 06:58:05'),
(22, '13', '23', '23,T452/E0.5 ENVIROBASE PEARL WHITE FINE,9.1617,0,4.9,44.89233', '2022-01-06 06:58:05'),
(23, '13', '23', '23,T402/E0.5 ENVIROBASE REDUCE WHITE,7.6371,0,0.4,3.05484', '2022-01-06 06:58:05'),
(24, '13', '23', '23,MASKING TAPE 24*55MM GREEN,577.5,0,0.5,288.75', '2022-01-06 06:58:05'),
(25, '13', '23', '23,3M OVERSPRAY PROTECTIVE SHEET 12FT*400FT,42.9816,0,12,515.7792', '2022-01-06 06:58:05'),
(26, '13', '23', '23,236U HOOKIT GOLD DISC,147.6562,0,1,147.6562', '2022-01-06 06:58:05'),
(27, '13', '23', '23,236U HOOKIT GOLD DISC,142.1875,0,1,142.1875', '2022-01-06 06:58:05'),
(28, '13', '23', '23,216U HOOKIT GOLD DISC,115.9375,0,1,115.9375', '2022-01-06 06:58:05'),
(29, '13', '23', '23,D863/1 LTR HP ACCELERATED,6.4323,0,175,1125.6525', '2022-01-06 06:58:05'),
(30, '13', '23', '23,LIQUID WAX,7.8144,0,120,937.728', '2022-01-06 06:58:05'),
(31, '13', '23', '23,RUBBING COMPOUND ,4.293,0,75,321.975', '2022-01-06 06:58:05'),
(32, '13', '23', '23,3M PERFECT IT RUBBING COMPOUND 1L,7.6712,0,76,583.0112', '2022-01-06 06:58:05'),
(33, '14', '39', '39,BMW GR LL01 5W-30 ,5100,0,4.75,24225', '2022-01-06 10:27:47'),
(34, '14', '39', '39, Set oil-filter element,4800,0,1,4800', '2022-01-06 10:27:47'),
(35, '15', '48', '48,DSC pulse generator front ,18240,0,1,18240', '2022-01-07 08:55:42'),
(36, '15', '49', '49,Pulse generator DSC rear,18600,0,1,18600', '2022-01-07 08:55:42'),
(37, '16', '50', '50,HELIX ULTRA 5W-40 209L,4700,0,1,4700', '2022-01-07 09:11:35'),
(38, '17', '51', '51,COOLAN GREEN,875,0,0.2,175', '2022-01-07 11:52:00'),
(39, '17', '51', '51,BRAKE CLEANER,0,0,1,0', '2022-01-07 11:52:00'),
(40, '18', '14', '14,ZF Gearbox oil,8900,0,0.3,2670', '2022-01-08 08:26:56'),
(43, '22', '52', '52,Longlife-01 5W-30 ,5100,10,5.25,24097.5', '2022-01-10 08:41:12'),
(44, '22', '52', '52,Oil Filter,5200,10,1,4680', '2022-01-10 08:41:12'),
(45, '22', '52', '52,Air filter element,11500,10,1,10350', '2022-01-10 08:41:12'),
(53, '31', '64', '64,Fresh air grille center BLACK,11150,15,1,9477.5', '2022-01-12 04:26:04'),
(54, '33', '70', '70,DXC pulse generator/ rear,14850,0,1,14850', '2022-01-12 09:57:28'),
(55, '34', '55', '55,Door pull right-beige,3500,10,1,3150', '2022-01-12 11:09:54'),
(56, '34', '55', '55,Door pull left-beige,3500,10,1,3150', '2022-01-12 11:09:54'),
(57, '34', '55', '55,Trim power window left-beige,750,10,1,675', '2022-01-12 11:09:54'),
(58, '34', '55', '55,Trim power window right-beige	,750,10,1,675', '2022-01-12 11:09:54'),
(59, '34', '57', '57,Right recessed grip-beige,4322.82,10,1,3890.538', '2022-01-12 11:09:54'),
(60, '34', '57', '57,Door pull left-beige,3500,10,1,3150', '2022-01-12 11:09:54'),
(61, '34', '57', '57,TRIM POWER WINDOW LEFT-BEIGE,750,10,1,675', '2022-01-12 11:09:54'),
(62, '34', '72', '72,Fresh air grille center BLACK,11150,10,1,10035', '2022-01-12 11:09:54'),
(63, '34', '73', '73,Ashtray centre console, middle BLACK,5500,10,1,4950', '2022-01-12 11:09:54'),
(73, '36', '69', '69,T472/E2 ENVIROBASE BRIGHT MEDIUM ALUMINIUM,13.1666,0,300,3949.98', '2022-01-12 11:14:38'),
(74, '36', '69', '69,D8112/5 LTR HPCLEAR 5 LTRS,5.5885,0,300,1676.55', '2022-01-12 11:14:38'),
(75, '36', '69', '69,D863/1 LTR HP ACCELERATED,6.4323,0,250,1608.075', '2022-01-12 11:14:38'),
(76, '36', '69', '69,AP P350-1493-5LTR,2.0777,0,150,311.655', '2022-01-12 11:14:38'),
(77, '36', '69', '69,SANDING PAPER,150,0,1,150', '2022-01-12 11:14:38'),
(78, '36', '69', '69,D8046/3L HP PRIMER,4.3414,0,300,1302.42', '2022-01-12 11:14:38'),
(79, '36', '69', '69,236U HOOKIT GOLD DISC,147.6562,0,2,295.3124', '2022-01-12 11:14:38'),
(80, '36', '69', '69,236U HOOKIT GOLD DISC,142.1875,0,3,426.5625', '2022-01-12 11:14:38'),
(81, '38', '80', '80,COOLAN GREEN,875,0,2,1750', '2022-01-13 06:05:52'),
(82, '38', '80', '80,BATTERY WATER,150,0,5,750', '2022-01-13 06:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_location` varchar(255) DEFAULT NULL,
  `part_number` varchar(255) DEFAULT NULL,
  `part_cost` varchar(50) DEFAULT NULL,
  `selling_cost` varchar(50) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `item_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `part_name`, `part_location`, `part_number`, `part_cost`, `selling_cost`, `discount`, `quantity`, `remark`, `stat`, `item_date`) VALUES
(1, 'Short Engine', '', '11002296966', '3480000', '4350000', '0', '0', '', '1', '2021-12-31 05:59:33'),
(2, 'BMW Longlife-01 5W-30', 'A2', '5w30-1L BTL', '4760', '5950', '0', '16', 'CAN', '1', '2022-01-11 16:22:08'),
(3, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-06 09:44:37'),
(4, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:55:04'),
(5, 'ZF Gearbox oil', 'A3', 'OEM83222289720', '7120', '8900', '0', '19.7', '', '1', '2022-01-11 16:23:44'),
(6, 'Valve cover gasket', 'D4', '11127582245', '13044', '16305', '0', '1', '', '1', '2022-01-06 12:16:28'),
(7, 'Sleeve', '', '11127575422', '724', '905', '0', '0', '', '1', '2021-12-20 17:47:49'),
(8, 'Gasket', 'B3', '11127559699', '4348', '5435', '0', '1', '', '1', '2022-01-06 12:27:14'),
(9, 'Reconditioned short engine', '', 'OEM11002296966', '1680000', '2100000', '0', '0', '', '1', '2022-01-04 04:36:31'),
(10, 'Profile-gasket', 'D5', '11137600482 ', '11956', '14945', '0', '1', '', '1', '2022-01-06 12:24:03'),
(11, 'Liquid locktite', '', '83190404517 ', '3824', '4780', '0', '0', '', '1', '2022-01-12 03:42:23'),
(12, 'Oil Filter', 'D2', '11428575211', '4160', ' 5200', '0', '38', '', '1', '2022-01-13 06:12:34'),
(13, 'Engine mount left', 'C4', '22117935149', '25920', ' 32400', '0', '5', '', '1', '2021-12-30 10:47:59'),
(14, 'Engine mount right ', '', '22116785602', '25.6', '32400 ', '0', '0', '', '1', '2021-12-29 18:20:59'),
(15, 'Boot shock Right ', 'C2', '51247204367', '12960', '16200', '0', '5', '', '1', '2021-12-30 11:33:48'),
(16, 'Boot switch ', 'D4', '51247463161', '7040', '8800', '0', '6', '', '1', '2021-12-30 08:20:02'),
(17, 'Coolent connector ', 'B3', '11127810707', '4480', '5600', '0', '5', '', '1', '2022-01-05 10:37:38'),
(18, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:07:55'),
(19, 'Repair kit/ brake pads asbestos-free', 'B2', '34216862202', '20240', '25300', '0', '7', '', '1', '2022-01-03 18:14:54'),
(20, 'Brake pad sensor front', 'C3', '34356791958', '4160', '5200', '0', '5', '', '1', '2021-12-31 10:48:10'),
(21, 'Brake pad sensor rear', 'C3', '34356791962', '3520', '4400', '0', '5', '', '1', '2021-12-31 10:50:42'),
(22, 'Blower Motor', 'D5', '64119242608', '84800', '106000', '0', '1', '', '1', '2021-12-30 10:22:49'),
(23, 'Rubber Mounting rear', 'E1', '33316797238', '8160', '10200', '0', '7', '', '1', '2021-12-30 09:37:57'),
(24, 'Fresh air grille center', 'E1', '64229172167', '27600', '34500', '0', '3', '', '1', '2021-12-30 10:19:58'),
(25, 'System latch- left', 'B3', '51227202147', '44160', '55200', '0', '1', '', '1', '2022-01-11 16:58:18'),
(26, 'System latch- right', 'B3', '51227202148', '44160', '55200', '0', '1', '', '1', '2022-01-11 16:36:57'),
(27, 'Vibration damper', 'B3', '11237823191', '106400', '133000', '0', '3', '', '1', '2022-01-11 16:35:21'),
(28, 'Set oil-filter element', 'D2', '11428507683', '4480', '5600', '0', '16', '', '1', '2022-01-12 04:05:03'),
(29, 'Fuel filter cartridge', 'D4', '13327811227', '9760', '12200', '0', '5', '', '1', '2021-12-30 07:55:42'),
(30, ' Horn- high pitch', 'A3', '61337293825', '12800', '16000', '0', '1', '', '1', '2022-01-03 18:15:23'),
(31, 'Fuel strainer with heating', 'D4', '13328576972', '49760', '62200', '0', '2', '', '1', '2021-12-30 07:53:21'),
(32, 'Cover- steering column', 'D4', '51719151866', '5840', '7300', '0', '6', '', '1', '2022-01-03 18:15:29'),
(33, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:55:51'),
(34, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 06:08:10'),
(35, 'Horn- low pitch', 'A3', '61337293826', '13120', '16400', '0', '1', '', '1', '2022-01-03 18:15:35'),
(36, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 06:05:26'),
(37, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:56:40'),
(38, ' Actuator', 'C4', '64119319037', '13440', '16800', '0', '1', '64119242058 - Superceeded no. (in production no.)', '1', '2022-01-03 03:02:46'),
(39, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:57:15'),
(40, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:57:49'),
(41, ' Gasket set', 'C3', '11428580682', '7840', '9800', '0', '7', '', '1', '2021-12-31 12:19:55'),
(42, ' Universal joint', 'E1', '26117605629', '36640', '45800', '0', '3', '26117610061 - Superceeded/in production no.', '1', '2022-01-03 02:56:56'),
(43, 'Left tension strut with rubber mounting', 'B1', '31126775971', '45440', '56800', '0', '2', '', '1', '2021-12-31 04:02:47'),
(44, 'Right tension strut with rubber mounting', 'B1', '31126775972', '45440', '56800', '0', '2', '', '1', '2022-01-11 15:59:17'),
(45, ' ASA screw with washer', 'A4', 'OEM33316767586', '2440', '3050', '0', '2', '', '1', '2021-12-31 07:44:27'),
(46, ' Wishbone/ bottom/ with rubber mount left', 'B1', '31126794203', '62320', '77900', '0', '2', '', '1', '2022-01-05 08:16:25'),
(47, ' Wishbone/ bottom/ with rubber mount right', 'B1', '31126794204', '62320', '77900', '0', '2', '', '1', '2022-01-03 18:16:12'),
(48, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:15:28'),
(49, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:13:01'),
(50, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:58:33'),
(51, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 03:59:05'),
(52, 'ASA-Bolt', 'C3', '11238651643', '600', '750', '0', '1', '', '1', '2022-01-13 04:00:53'),
(53, 'Repair kit/ brake pads asbestos-free', 'C1', '34116780711', '24400', '30500.00 ', '0', '2', '', '1', '2022-01-03 18:16:21'),
(54, ' Brake pad wear sensor', 'C3', '34356792562', '4320', '5400.00 ', '0', '2', '', '1', '2021-12-31 10:51:20'),
(55, 'Brake disc/ ventilated', 'D1', '34116792219', '20720', '25900.00 ', '0', '2', '', '1', '2022-01-03 18:16:27'),
(56, 'Engine mount', 'B4', '22116768799', '26480', '33100.00 ', '0', '2', '', '1', '2021-12-31 05:14:36'),
(57, 'Engine mount', 'C4', '22116768800', '26480', '33100.00 ', '0', '2', '', '1', '2021-12-30 10:51:18'),
(58, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:02:24'),
(59, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 06:05:45'),
(60, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:36:30'),
(61, 'Brake disc- ventilated', 'D1', ' 34216792227', '17360', '21700.00 ', '0', '2', '', '1', '2022-01-03 18:16:45'),
(63, 'Repair kit/ brake pads asbestos-free', 'C1', '34216873093 ', '18560', '23200', '0', '4', '', '1', '2022-01-11 16:52:35'),
(64, ' Pulse generator/ DSC rear', 'B4', '34526884421', '28240', '35300.00 ', '0', '12', '', '1', '2022-01-03 18:16:57'),
(65, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:03:18'),
(66, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:08:48'),
(67, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:04:24'),
(68, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:14:03'),
(69, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:03:36'),
(70, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:09:07'),
(71, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:04:40'),
(72, 'o', '', 'o', '0', 'o', '0', '0', '', '1', '2022-01-07 06:55:42'),
(73, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 11:28:13'),
(74, 'Engine mount', 'C4', '22116864335', '30080', '37600.00 ', '0', '4', '', '1', '2021-12-30 10:30:45'),
(75, 'Engine mount', 'C4', '22116864336', '30080', '37600.00 ', '0', '4', '', '1', '2021-12-30 10:30:08'),
(76, 'Vacuum pump', 'E2', '34336860881', '113600', '142000.00 ', '0', '2', '', '1', '2021-12-30 09:54:45'),
(77, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:05:30'),
(78, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-07 06:59:12'),
(79, 'Tank function module', 'B3', '16149425925', '42000', '52500.00 ', '0', '2', '', '1', '2021-12-31 12:27:45'),
(80, 'Repair kit/ brake pads asbestos-free', 'C1', '34216776937', '19440', '24300.00 ', '0', '6', '', '1', '2022-01-03 18:18:05'),
(81, ' Tooth belt', 'E1', '11287633713', '14800', '18500.00 ', '0', '9', '', '1', '2021-12-31 12:08:30'),
(82, ' DXC pulse generator- front', 'C3', '34526771776', '28480', '35600.00 ', '0', '2', '', '1', '2022-01-03 18:29:17'),
(83, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:16:23'),
(84, ' Set oil-filter element', 'D2', '11427953129', '3840', '4800', '0', '15', '', '1', '2022-01-12 03:58:38'),
(85, ' RP air supply system', 'C5', '37206875177', '276000', '345000.00 ', '0', '1', '', '1', '2021-12-30 10:27:14'),
(86, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 17:00:29'),
(87, ' Brake pad wear sensor- front left', 'C3', '34356792567', '4560', '5700.00 ', '0', '5', '', '1', '2022-01-03 18:29:25'),
(88, ' Set oil-filter element', 'D2', '11428593186', '4880', '6100', '0', '8', '', '1', '2022-01-12 04:05:27'),
(89, ' Seal carrier', 'B4', '11617812938', '11120', '13900.00 ', '0', '6', '', '1', '2022-01-11 06:09:02'),
(90, 'Air filter element', 'D3', '13718513944', '10160', '12700.00 ', '0', '17', '', '1', '2021-12-30 06:38:21'),
(91, 'Gearbox mount', 'B5', '22316853453', '28240', '35300', '0', '3', '', '1', '2022-01-11 16:31:03'),
(92, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-12 09:57:39'),
(93, 'Stabilizer link', 'D4', '22116885788', '12560', '15700', '0', '3', '', '1', '2021-12-30 08:31:38'),
(94, ' Wishbone with rubber mount- right', 'B1', '31126879844', '30400', '38000', '0', '2', '', '1', '2022-01-03 18:18:34'),
(95, 'Wishbone with rubber mount- left', 'B1', '31126879843', '30400', '38000', '0', '2', '', '1', '2022-01-03 18:18:39'),
(96, 'Wishbone bracket with rubber mount left', '', '31126882843', '25920', '32400.00 ', '0', '0', '', '1', '2021-12-29 15:04:23'),
(97, ' Wishbone bracket with rubber mount right', '', '31126882844', '25920', '32400.00 ', '0', '0', '', '1', '2021-12-29 15:04:48'),
(98, ' Repair kit, brake pads asbestos-free', 'B2', '34106860019', '27600', '34500.00 ', '0', '3', '', '1', '2022-01-04 06:18:07'),
(99, ' Brake pad wear sensor- front left', 'C3', '34356888167', '6080', '7600.00 ', '0', '4', '', '1', '2022-01-03 18:18:47'),
(100, '  Set of wiper blades', 'A4', '61612407291', '10800', '13500.00 ', '0', '3', '61615A27D69 - number on package', '1', '2021-12-31 05:48:18'),
(101, 'Heat management module', 'D5', '11538631943', '62520', '78150', '0', '3', '11538843405', '1', '2022-01-12 06:11:18'),
(102, ' Electrical expansion valve', 'C4', '64119361709', '24400', '30500.00 ', '0', '3', '', '1', '2021-12-30 10:27:54'),
(103, 'Cell supervision circuit', 'A3', ' 61278482940', '36960', '46200.00 ', '0', '11', '', '1', '2021-12-31 04:12:50'),
(104, ' Pressure-temperature sensor', 'D4', '16117361966', '40080', '50100.00 ', '0', '3', '', '1', '2021-12-31 10:31:40'),
(105, 'Air flaps- bottom', 'B5', '51137497285', '39840', '49800.00 ', '0', '1', '', '1', '2022-01-03 18:19:10'),
(106, 'Set/ microfilter/carbon canister', 'B3', '64116996208', '28640', '35800.00 ', '0', '6', '', '1', '2022-01-03 18:19:21'),
(107, 'Spark plug- High Power', 'B3', '12120040551', '3760', '4700.00 ', '0', '12', '', '1', '2022-01-03 18:19:28'),
(109, 'Support lifting platform', 'B3', '51717065919', '5200', '6500.00 ', '0', '6', '', '1', '2022-01-11 11:01:20'),
(110, 'Brake fluid DOT4 LV- low viscosity', 'C2', '83132405977', '3120', '3900.00 ', '0', '6', '', '1', '2022-01-03 18:19:33'),
(111, 'Set of wiper blades', 'A4', ' 61612447934', '14800', '18500.00 ', '0', '3', '', '1', '2021-12-31 05:07:26'),
(112, 'Automatic transmission fluid 3+', 'A3', '83222289720', '12800', '16000.00 ', '0', '12', '', '1', '2021-12-31 05:04:04'),
(113, 'Set/ oil sump/ oil filter/ auto. transm', 'D5', '24118612901', '46400', '58000', '0', '1', '24115A13115  SUPERCEEDED', '1', '2022-01-12 04:14:18'),
(114, 'Brake pad wear sensor- front', '', '34356861807', '6160', '7700.00 ', '0', '0', '', '1', '2022-01-03 18:19:51'),
(115, 'Air flaps- bottom', 'B5', '51748091762', '52360', '65450.00 ', '0', '1', '', '1', '2022-01-03 18:19:55'),
(116, 'Air filter element', 'D3', '13718577171', '9200', '11500.00 ', '0', '7', '', '1', '2022-01-10 06:43:52'),
(117, 'Anti-freeze', 'D4', '83512355290', '2400', '3000', '0', '22', '83192211191', '1', '2022-01-12 04:10:38'),
(118, 'Repair kit- socket housing', 'B4', ' 61132359999', '3840', '4800.00 ', '0', '15', '', '1', '2022-01-03 18:20:14'),
(119, 'Brake pad wear sensor- front', 'C3', '34356890788', '6160', '7700.00 ', '0', '10', '', '1', '2022-01-03 18:20:24'),
(120, 'Repair kit, brake pads asbestos-free', 'B2', '34216867175', '25920', '32400.00 ', '0', '6', '', '1', '2021-12-30 14:07:17'),
(121, 'Brake-pad sensor- rear', 'C3', '34356890791', '5280', '6600.00 ', '0', '4', '', '1', '2022-01-03 18:30:34'),
(122, 'Set oil-filter element', 'D2', '11428570590', '4400', '5500', '0', '15', '', '1', '2022-01-12 04:05:47'),
(123, 'Repair kit/ brake pads asbestos-free', 'B2', '34216871299', '14240', '17800.00 ', '0', '2', '', '1', '2022-01-03 18:20:33'),
(124, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:07:20'),
(125, 'Repair kit/ brake pads asbestos-free', 'C1', '34106884263', '24920', '31150.00 ', '0', '4', '', '1', '2022-01-03 18:20:49'),
(126, 'Expanding rivet- black', 'D4', '07147293278', '376', '470.00 ', '0', '210', '', '1', '2022-01-11 10:17:54'),
(127, 'Expanding rivet', 'D4', '51118174185', '68', ' 85.00 ', '0', '200', '', '1', '2021-12-31 11:09:10'),
(128, 'Expanding rivet- black', 'D4', '51777171004', '176', '220.00 ', '0', '200', '', '1', '2022-01-11 10:19:28'),
(129, ' Actuator EMF', 'C5', 'OEM34216794618', '41600', '52000.00 ', '0', '1', '', '1', '2021-12-31 07:33:21'),
(130, ' ASA screw with washer', '', '33316767586', '5200', '6500.00 ', '0', '0', '', '1', '2021-12-31 07:43:14'),
(131, ' Wishbone/ bottom/ with rubber mount left', 'A4', 'OEM31126794203', '28400', '35500.00 ', '0', '2', '', '1', '2022-01-03 18:21:17'),
(132, 'Wishbone/ bottom with rubber mount right', 'A4', 'OEM31126794204', '28400', '35500.00 ', '0', '2', '', '1', '2022-01-03 18:21:26'),
(133, 'Repair kit/ brake pads asbestos-free', 'C1', 'OEM34216776937', '11200', '14000.00 ', '0', '2', '', '1', '2022-01-03 18:21:32'),
(134, 'Air filter element', 'A5', 'OEM13718513944', '6720', '8400.00 ', '0', '3', '', '1', '2021-12-30 06:50:00'),
(135, 'Vibration damper', 'A5', 'OEM11238512072', '58560', '73200', '0', '2', '80001698', '1', '2022-01-03 10:30:41'),
(136, 'DXC pulse generator/ rear', 'C5', 'OEM34526771777', '11880', '14850', '0', '3', '', '1', '2022-01-12 09:49:44'),
(137, ' Engine mount', 'A5', 'OEM22117935149', '19840', '24800', '0', '3', 'OEM-80004460', '1', '2022-01-11 16:03:30'),
(138, 'Engine mount/ right', 'A5', 'OEM22116785602', '21760', '27200', '0', '3', 'OEM-80004448', '1', '2022-01-11 16:05:01'),
(139, 'Brake pad wear sensor- front left', 'C3', 'OEM34356792289', '2960', '3700.00 ', '0', '3', '', '1', '2022-01-03 18:22:18'),
(140, 'Connector', 'A5', 'OEM11127810707', '4240', '5300.00 ', '0', '3', '', '1', '2021-12-31 04:07:48'),
(141, ' Brake pad wear sensor- front left', 'C3', 'OEM34356888167', '2960', '3700.00 ', '0', '3', '', '1', '2022-01-03 18:22:14'),
(142, 'Pneumatic spring- rear', 'A5', 'OEM37126795013', '68000', '85000.00 ', '0', '2', '', '1', '2022-01-03 18:22:08'),
(143, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-12 03:56:24'),
(144, ' Engine mount- right', '', '22116785602', '25740', '32175.00 ', '0', '0', '22117935142 - Superceeded/in production no', '1', '2022-01-03 18:22:34'),
(145, 'Repair kit/ brake pads asbestos-free', 'B2', '34116858047', '24840', '31050', '0', '7', '', '1', '2022-01-03 18:22:29'),
(146, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:12:12'),
(147, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-12 04:04:48'),
(148, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:12:54'),
(149, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:17:12'),
(150, 'Gasket', 'D4', '11428516396', '4400', '5500.00 ', '0', '7', '', '1', '2021-12-31 11:47:46'),
(151, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 06:08:31'),
(152, ' End cover with gasket', 'C4', '11117797932', '2208', '2760.00 ', '0', '18', '', '1', '2022-01-11 06:06:48'),
(153, 'Gasket set/ cylinder head cover', 'D4', '11128511814', '8160', '10200.00 ', '0', '6', '', '1', '2022-01-03 18:23:03'),
(154, ' Gasket set', 'C3', '11428580680', '8400', '10500.00 ', '0', '7', '', '1', '2021-12-31 12:20:31'),
(155, 'Gasket set', 'C3', '11428580681', '6240', '7800.00 ', '0', '7', '', '1', '2021-12-31 12:03:25'),
(156, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:17:53'),
(157, 'Self-locking collar nut', 'B4', '33306760349', '640', '800.00 ', '0', '8', '', '1', '2021-12-31 11:57:35'),
(158, 'O-ring', 'B3', '11127823944', '1840', '2300.00 ', '0', '8', '', '1', '2021-12-31 11:06:17'),
(159, 'Decoupling element', 'C3', '11127809138', '1760', '2200.00 ', '0', '8', '', '1', '2021-12-31 12:12:59'),
(160, ' Ribbed v-belt', 'E1', '11288519128', '8480', '10600.00 ', '0', '7', '', '1', '2021-12-30 09:39:44'),
(161, 'Gasket set/ cylinder head cover', 'C4', '11127807017', '8400', '10500.00 ', '0', '3', '', '1', '2022-01-03 18:23:11'),
(162, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 06:06:08'),
(164, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:09:27'),
(165, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:14:26'),
(166, 'Coolant pump', 'D4', '11518631692', '45080', '56350.00 ', '0', '2', '', '1', '2021-12-30 08:30:37'),
(167, 'Repair kit/ brake pads asbestos-free', 'B2', '34116874331', '19440', '24300.00 ', '0', '6', '', '1', '2022-01-03 18:23:26'),
(168, 'Brake pad wear sensor- front left', 'C3', '34356792289', '3440', '4300.00 ', '0', '6', '', '1', '2022-01-03 18:23:31'),
(169, 'DSC pulse generator- front', 'B4', '34526869320', '26600', '33250.00 ', '0', '8', '', '1', '2022-01-03 18:23:36'),
(170, 'Heat management module', 'C5', '11537644811', '46560', '58200.00 ', '0', '3', '', '1', '2021-12-30 10:26:08'),
(171, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:18:41'),
(172, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:19:14'),
(173, 'Insulation valve', 'D5', '16137303949', '49600', '62000.00 ', '0', '3', '', '1', '2021-12-30 10:25:08'),
(174, 'DXC pulse generator- rear', 'C3', '34526771777', '29680', '37100.00 ', '0', '7', '', '1', '2022-01-03 18:23:43'),
(175, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:11:18'),
(176, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:59:22'),
(177, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:19:54'),
(178, 'Pneumatic spring/ rear', 'B4', '37126795013', '105600', '132000.00 ', '0', '6', '', '1', '2022-01-03 18:24:17'),
(179, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-06 09:43:46'),
(180, 'Repair kit/ brake pads asbestos-free', 'C1', '34116852253', '35840', '44800.00 ', '0', '5', '', '1', '2022-01-03 18:24:28'),
(181, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:20:36'),
(182, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:30:23'),
(183, 'Engine mount', 'B4', '22116885934', '30880', '38600', '0', '4', '8835572', '1', '2022-01-12 09:59:32'),
(184, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:21:24'),
(185, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-11 16:07:05'),
(186, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 04:22:53'),
(187, 'Repair kit/ brake pads asbestos-free', 'C1', '34106888459', '67200', '84000.00 ', '0', '5', '', '1', '2022-01-11 08:39:14'),
(188, ' Floor mats/ all-weather', 'UPPER STORE', '51472414220', '34400', '43000', '0', '1', '', '1', '2022-01-13 04:23:33'),
(189, 'Set/ adhesive pads', '', '66212466975', '5940', '7425.00 ', '0', '0', '', '1', '2022-01-03 18:25:20'),
(190, 'Floor mats/ all-weather front', 'UPPER STORE', '51472339778', '14400', '18000', '0', '1', '', '1', '2022-01-13 04:24:13'),
(191, 'Floor mats/ all-weather rear', 'UPPER STORE', '51472219802', '11200', '14000', '0', '1', '', '1', '2022-01-13 04:24:48'),
(192, 'Floor mats/ all-weather', 'UPPER STORE', '51472406753', '25600', '32000', '0', '1', '', '1', '2022-01-13 04:25:15'),
(193, 'Silicone repl. plate driving light sensor', 'C3', '61359856157', '6960', '8700.00 ', '0', '1', '', '1', '2022-01-03 18:25:50'),
(194, 'Blue Suite No  1', 'D2', '64119382585', '6560', '8200.00 ', '0', '2', '', '1', '2021-12-31 12:32:32'),
(195, 'Blue suite NO 2', 'D2', '64119382591', '6560', '8200', '0', '2', '', '1', '2022-01-08 05:16:28'),
(196, 'Green suite NO 1', 'D2', '64119382597', '6560', '8200', '0', '2', '', '1', '2022-01-08 05:17:10'),
(197, 'Green suite NO 2', 'D2', '64119382603', '6560', '8200', '0', '2', '', '1', '2022-01-08 05:17:28'),
(198, 'Golden Suite No. 1', 'D2', '64119382609', '6560', '8200.00 ', '0', '2', '', '1', '2021-12-31 12:30:05'),
(199, 'Golden suite NO 2', 'D2', '64119382615', '6560', '8200', '0', '2', '', '1', '2022-01-08 05:17:45'),
(200, 'Authentic Suite No. 1', 'D2', '64119382621', '6560', '8200.00 ', '0', '2', '', '1', '2021-12-31 12:31:29'),
(201, ' Authentic Suite No. 2', 'D2', '64119382627', '6560', '8200.00 ', '0', '2', '', '1', '2021-12-31 12:36:28'),
(202, 'Floor mats/ all-weather/ RHD- front', 'UPPER STORE', '51472444035', '20320', '25400', '0', '2', '', '1', '2022-01-13 04:25:39'),
(203, 'Floor mats/ all-weather- rear', 'UPPER STORE', '51472444038', '16160', '20200', '0', '2', '', '1', '2022-01-13 04:26:04'),
(204, ' Hub cap with chrome edge', 'D4', '36136850834', '3600', '4500.00 ', '0', '2', '', '1', '2021-12-31 11:49:31'),
(205, 'Wheel electr. module RDCi w/ screw valve', 'D2', '36106881890', '22400', '28000.00 ', '0', '1', '', '1', '2021-12-31 12:38:42'),
(206, 'Left tension strut with rubber mounting', 'A4', 'OEM31126775971', '15840', '19800.00 ', '0', '2', '', '1', '2021-12-31 04:27:15'),
(207, 'Right tension strut with rubber mounting', 'A4', 'OEM31126775972', '15840', '19800', '0', '2', '', '1', '2022-01-11 16:01:38'),
(208, 'Gasket set/ cylinder head cover', 'C4', 'OEM11127807017', '6000', '7500.00 ', '0', '3', '', '1', '2022-01-03 18:26:58'),
(209, 'Actuator', 'D4', 'OEM64119321034', '19200', '24000.00 ', '0', '1', '', '1', '2021-12-31 12:44:39'),
(210, ' Universal joint', 'C5', 'OEM26117605629', '15520', '19400.00 ', '0', '2', '26117610061 - Superceeded/in production no', '1', '2021-12-31 07:32:21'),
(211, 'Wiper Blade left', 'C5', '8K2955425A', '7600', '9500.00 ', '0', '0', 'AUDI', '1', '2022-01-03 07:27:50'),
(212, 'Headlight washer cover', '', '8K0955275', '3920', '4900.00 ', '0', '0', '', '1', '2021-12-29 15:51:31'),
(213, 'Headlight washer cover', '', '8K0955276', '4640', '5800.00 ', '0', '0', '', '1', '2021-12-29 15:51:57'),
(214, 'Headlamp Washer', '', '8K0955101B', '9200', '11500.00 ', '0', '0', '', '1', '2021-12-29 15:52:32'),
(215, 'Headlamp Washer', '', '8K0955102B', '9200', '11500.00 ', '0', '0', '', '1', '2021-12-29 15:53:05'),
(216, ' Set of wiper blades', '', 'OEM61612241357', '7840', '9800.00 ', '0', '0', '', '1', '2021-12-29 15:53:57'),
(217, 'Set of wiper blades', 'C5', 'OEM61612158220', '5840', '7300', '0', '1', 'OEM61612241357', '1', '2022-01-12 04:00:23'),
(218, ' Hub cap with chrome edge', 'D4', '36136783536', '3760', '4700.00 ', '0', '4', '', '1', '2022-01-07 04:42:07'),
(219, 'Wheel bolt black', 'B3', '36136890324', '1040', '1300.00 ', '0', '10', '', '1', '2022-01-03 05:27:01'),
(220, 'Set of valve caps', 'D2', '36122447401', '4160', '5200.00 ', '0', '8', '', '1', '2022-01-03 05:22:27'),
(221, ' Tyre mobility set', 'C5', '71102333674', '30800', '38500', '0', '1', '', '1', '2022-01-06 19:26:56'),
(222, 'Original BMW AGM-battery', 'A1', '61219394648', '31440', '39300', '0', '3', '', '1', '2021-12-30 07:32:42'),
(223, 'Engine mount, right', 'C4', '22117935142', '25920', '32400.00 ', '0', '6', '', '1', '2021-12-30 10:50:20'),
(224, 'Repair kit/ brake pads asbestos-free', 'C1', '34116888457', '67200', '84000', '0', '4', '', '1', '2022-01-11 08:42:32'),
(225, 'TYRE SHINE', 'A1', 'T-SHINE', '680', '850', '0', '1', 'WORK SHOP ', '1', '2022-01-11 16:21:07'),
(226, 'GLASS CLEANER', 'A1', 'G-CLEANER', '136', '170', '0', '5', 'WORK SHOP USE', '1', '2022-01-13 04:28:03'),
(227, 'CAR WASH', 'A1', 'C-WASH', '136', '170', '0', '0', 'WORK SHOP', '1', '2022-01-12 10:40:18'),
(228, 'LIQUID WAX', 'C2', 'LX-39026', '6.25152', '7.8144', '0', '826', '', '1', '2022-01-13 04:30:21'),
(229, 'COOLAN GREEN', 'C2', 'WU-0302', '700', '875', '0', '1.7999999999999998', '', '1', '2022-01-13 05:50:38'),
(230, 'COOLANT RED', 'C2', 'WU-0306', '700', '875', '0', '6', '', '1', '2022-01-13 04:30:51'),
(231, 'COOLANT BLUE', 'C2', 'WU-0304', '700', '875', '0', '6', '', '1', '2022-01-13 04:31:19'),
(232, 'CAR WASH', 'A1', 'WU-0385', '0', '0', '0', '1', '', '1', '2022-01-13 04:31:43'),
(233, 'AD BLUE', 'STORE', 'WU-0002', '0', '0', '0', '30', '', '1', '2022-01-13 04:32:13'),
(234, 'BRAKE CLEANER', 'C2', 'WU-8700', '0', '0', '0', '3', '', '1', '2022-01-13 04:32:42'),
(235, 'SILICONE SPRAY', 'C2', 'WU-3221', '0', '0', '0', '3', '', '1', '2022-01-13 04:33:11'),
(236, 'MICRO-FIBRE CLOTH', 'C2', 'WU-0132', '0', '0', '0', '20', '', '1', '2022-01-13 05:37:31'),
(237, 'Brake pad wear sensor- front ', 'D5', 'OEM34356861807', '6160', '7700.00', '0', '8', 'OEM 6890788', '1', '2022-01-03 18:27:33'),
(238, '0', '0', '0', '0', '0', '0', '0', '', '1', '2022-01-11 11:02:04'),
(239, 'Longlife-01 5W-40 ', 'WORKSHOP', '5W-40-209L', '3760', '4700', '0', '202.8', '', '1', '2022-01-13 04:33:49'),
(240, 'Longlife-01 5W-30 ', 'WORKSHOP', '5W-30-209l', '4080', '5100', '0', '194.25', '', '1', '2022-01-13 06:12:34'),
(241, 'CAR CLEAN SET', '', 'WU-0004', '0', '0', '0', '0', '', '1', '2022-01-03 06:53:24'),
(242, 'Set oil-filter element', '', '11427807177', '3760', '4700', '0', '0', '', '1', '2022-01-03 08:15:37'),
(243, 'Set oil-filter element', 'A5', 'OEM11427807177', '3400', '4250', '0', '1', '', '1', '2022-01-11 16:19:04'),
(244, 'Gasket set/ cylinder head cover', 'D4', '11127588418', '11480', '14350', '0', '1', '', '1', '2022-01-05 05:08:18'),
(245, 'DIESEL PARTICULATE FILTER CLEANER', 'C2', 'WU-4500', '4212', '5265', '0', '2', '', '1', '2022-01-13 04:36:33'),
(246, 'T400/E2 ENVIROBASE BRILLIANT WHITE', 'PAINT ROOM', 'T400', '5.68552', '7.1069', '0', '2454', '', '1', '2022-01-13 04:40:14'),
(247, 'T401/E0.5 ENVIROBASE ULTRA FINE WHITE', 'PAINT ROOM', 'T401', '11.37256', '14.2157', '0', '515.7', '', '1', '2022-01-13 04:40:36'),
(248, 'T402/E0.5 ENVIROBASE REDUCE WHITE', 'PAINT ROOM', 'T402', '6.10968', '7.6371', '0', '544.6', '', '1', '2022-01-13 04:40:52'),
(249, 'T403/E0.5 ENVIROBASE ULTRA FINE WHITE', 'PAINT ROOM', 'T403', '17.9112', '22.389', '0', '536', '', '1', '2022-01-13 04:41:15'),
(250, 'T404/E0.5 ENVIROBASE REDUCE BLACK', 'PAINT ROOM', 'T404', '6.88216', '8.6027', '0', '495', '', '1', '2022-01-13 04:41:27'),
(251, 'T405/E0.5 ENVIROBASE GRAPHITE FLAKE', 'PAINT ROOM', 'T405', '7.82256', '9.7782', '0', '511', '', '1', '2022-01-13 04:41:39'),
(252, 'T406/E1 ENVIROBASE MIDNIHGT BLACK', 'PAINT ROOM', 'T406', '6.7708', '8.4635', '0', '977.6', '', '1', '2022-01-13 04:41:52'),
(253, 'T407 ENVIROBASE JET BLACK', 'PAINT ROOM', 'T407', '6.24736', '7.8092', '0', '1951.2', '', '1', '2022-01-13 04:42:04'),
(254, 'T409/2L ENVIROBASE DEEP BLACK', 'PAINT ROOM', 'T409', '5.41864', '6.7733', '0', '1794.5', '', '1', '2022-01-13 04:42:16'),
(255, 'T411/E1 ENVIROBASE BLUE', 'PAINT ROOM', 'T411', '6.676', '8.345', '0', '994', '', '1', '2022-01-13 04:42:41'),
(256, 'T412/E1 ENVIROBASE ROYAL BLUE', 'PAINT ROOM', 'T412', '7.69784', '9.6223', '0', '968.1', '', '1', '2022-01-13 04:42:53'),
(257, 'T413/E1 ENVIROBASE BRILLIANT BLUE', 'PAINT ROOM', 'T413', '6.71744', '8.3968', '0', '999', '', '1', '2022-01-13 04:43:09'),
(258, 'T414/E2 ENVIROBASE BLUE LAKE', 'PAINT ROOM', 'T414', '9.84336', '12.3042', '0', '1997', '', '1', '2022-01-13 04:43:23'),
(259, 'T415/E0.5 ENVIROBASE REDUCE BLUE', 'PAINT ROOM', 'T415', '6.026', '7.5325', '0', '484', '', '1', '2022-01-13 04:43:36'),
(260, 'T420/E1 ENVIROBASE BLUE', 'PAINT ROOM', 'T420', '10.8636', '13.5795', '0', '983', '', '1', '2022-01-13 04:43:55'),
(261, 'T422/0.5 ENVIROBASE MUSTARD', 'PAINT ROOM', 'T422', '6.78976', '8.4872', '0', '515', '', '1', '2022-01-13 04:44:10'),
(262, 'T423/E0.5 ENVIROBASE TRACE YELLOW OXIDE', 'PAINT ROOM', 'T423', '5.90592', '7.3824', '0', '503', '', '1', '2022-01-13 04:44:23'),
(263, 'T425/E0.5 ENVIROBASE SUN YELLOW', 'PAINT ROOM', 'T425', '9.10536', '11.3817', '0', '488', '', '1', '2022-01-13 04:44:37'),
(264, 'T426/E0.5 ENVIROBASE ORANGE YELLOW', 'PAINT ROOM', 'T426', '8.988', '11.235', '0', '490', '', '1', '2022-01-13 04:44:48'),
(265, 'T427/E1 ENVIROBASE YELLOW', 'PAINT ROOM', 'T427', '16.24016', '20.3002', '0', '1028', '', '1', '2022-01-13 04:45:01'),
(266, 'T429/0.5 ENVIROBASE GOLDEN YELLOW', 'PAINT ROOM', 'T429', '7.33984', '9.1748', '0', '502', '', '1', '2022-01-13 04:45:13'),
(267, 'T430/E1 ENVIROBASE T GREEN', 'PAINT ROOM', 'T430', '7.91016', '9.8877', '0', '1015', '', '1', '2022-01-13 04:45:38'),
(268, 'T431/E1 ENVIROBASE STRONG BLUE GREEN', 'PAINT ROOM', 'T431', '7.49688', '9.3711', '0', '1037', '', '1', '2022-01-13 04:45:51'),
(269, 'T432/E1 ENVIROBASE T RED', 'PAINT ROOM', 'T432', '7.11688', '8.8961', '0', '970', '', '1', '2022-01-13 04:46:02'),
(270, 'T433/E0.5 ENVIROBASE BRILLIANT ORANGE', 'PAINT ROOM', 'T433', '14.2264', '17.783', '0', '480', '', '1', '2022-01-13 04:46:15'),
(271, 'T435/E1 ENVIROBASE SALMOND RED', 'PAINT ROOM', 'T435', '10.63088', '13.2886', '0', '978.8', '', '1', '2022-01-13 04:46:28'),
(272, 'T436/E0.5 ENVIROBASE RED OXIDE', 'PAINT ROOM', 'T436', '6.84688', '8.5586', '0', '511', '', '1', '2022-01-13 04:46:39'),
(273, 'T438/E1 ENVIROBASE CLARED', 'PAINT ROOM', 'T438', '9.85336', '12.3167', '0', '970', '', '1', '2022-01-13 04:46:52'),
(274, 'T440/E0.5 ENVIROBASE REDUCE RED OXIDE', 'PAINT ROOM', 'T440', '5.4924', '6.8655', '0', '470.6', '', '1', '2022-01-13 04:49:01'),
(275, 'T441/E0.5 ENVIROBASE CARMINE', 'PAINT ROOM', 'T441', '10.75824', '13.4478', '0', '497', '', '1', '2022-01-13 04:49:13'),
(276, 'T442/E0.5 ENVIROBASE BASIC BROWN', 'PAINT ROOM', 'T442', '11.4952', '14.369', '0', '498', '', '1', '2022-01-13 04:49:24'),
(277, 'T443/E1 ENVIROBASE DARL VIOLET', 'PAINT ROOM', 'T443', '6.06896', '7.5862', '0', '958.1', '', '1', '2022-01-13 04:49:35'),
(278, 'T444/E1 ENVIROBASE MAGENTA', 'PAINT ROOM', 'T444', '9.94008', '12.4251', '0', '976.6', '', '1', '2022-01-13 04:49:47'),
(279, 'T447/E1 ENVIROBASE STRONG RED', 'PAINT ROOM', 'T447', '10.9576', '13.697', '0', '1002', '', '1', '2022-01-13 04:50:00'),
(280, 'T448/E1 ENVIROBASE STRONG MAROON', 'PAINT ROOM', 'T448', '9.07888', '11.3486', '0', '1009', '', '1', '2022-01-13 04:50:18'),
(281, 'T451/E0.5 ENVIROBASE PEARL WHITE ULTRA FINE', 'PAINT ROOM', 'T451', '7.67624', '9.5953', '0', '506', '', '1', '2022-01-13 04:50:35'),
(282, 'T452/E0.5 ENVIROBASE PEARL WHITE FINE', 'PAINT ROOM', 'T452', '7.26904', '9.0863', '0', '510.1', '', '1', '2022-01-13 04:50:50'),
(283, 'T453/E1 ENVIROBASE PEARL MEDIUM', 'PAINT ROOM', 'T453', '6.66264', '8.3283', '0', '1021.8', '', '1', '2022-01-13 04:51:05'),
(284, 'T454/E1 ENVIROBASE  RED PEARL MEDIUM', 'PAINT ROOM', 'T454', '10.7736', '13.467', '0', '1034', '', '1', '2022-01-13 04:51:40'),
(285, 'T455/E0.5 ENVIROBASE PEARL BLUE FINE', 'PAINT ROOM', 'T455', '7.7628', '9.7035', '0', '516', '', '1', '2022-01-13 04:51:54'),
(286, 'T456/E1 ENVIROBASE PEARL BLUE MEDIUM', 'PAINT ROOM', 'T456', '7.33256', '9.1657', '0', '974.9', '', '1', '2022-01-13 04:52:09'),
(287, 'T457/E0.5 ENVIROBASE MEDIUM PEARL GREEN', 'PAINT ROOM', 'T457', '8.01888', '10.0236', '0', '515', '', '1', '2022-01-13 04:52:25'),
(288, 'T458/E0.5 ENVIROBASE BLUE GREEN PEARL', 'PAINT ROOM', 'T458', '11.00088', '13.7511', '0', '502', '', '1', '2022-01-13 04:52:41'),
(289, 'T459/E1 ENVIROBASE MEDIUM PEARL COPPER', 'PAINT ROOM', 'T459', '12.836', '16.045', '0', '1025', '', '1', '2022-01-13 04:52:56'),
(290, 'T460/E0.5 ENVIROBASE MEDIUM PEARL GOLD', 'PAINT ROOM', 'T460', '7.44424', '9.3053', '0', '532', '', '1', '2022-01-13 04:53:26'),
(291, 'T461/E0.5 ENVIROBASE GOLDEN YELLOW PEARL ', 'PAINT ROOM', 'T461', '9.40808', '11.7601', '0', '505', '', '1', '2022-01-13 04:53:58'),
(292, 'T462/E1 ENVIROBASE FINE RED PEARL', 'PAINT ROOM', 'T462', '11.5664', '14.458', '0', '1038', '', '1', '2022-01-13 04:54:18'),
(293, 'T465/E0.5 ENVIROBASE MEDIUM PEARL RED', 'PAINT ROOM', 'T465', '8.4204', '10.5255', '0', '487', '', '1', '2022-01-13 04:54:34'),
(294, 'T466/E0.5 ENVIROBASE PEARL ORANGE', 'PAINT ROOM', 'T466', '8.10712', '10.1339', '0', '509', '', '1', '2022-01-13 04:55:05'),
(295, 'T468/E0.5 ENVIROBASE MEDIUM PEARL VIOLET', 'PAINT ROOM', 'T468', '7.60336', '9.5042', '0', '502', '', '1', '2022-01-13 04:57:35'),
(296, 'T472/E2 ENVIROBASE BRIGHT MEDIUM ALUMINIUM', 'PAINT ROOM', 'T472', '10.53328', '13.1666', '0', '1600.9', '', '1', '2022-01-13 04:58:11'),
(297, 'T473/E2 ENVIROBASE MEDIUM COARSE ALUMINIUM', 'PAINT ROOM', 'T473', '7.42416', '9.2802', '0', '2035', '', '1', '2022-01-13 04:59:15'),
(298, 'T474/E1 ENVIROBASE MEDIUM ALUMINIUM', 'PAINT ROOM', 'T474', '8.70936', '10.8867', '0', '950.6', '', '1', '2022-01-13 04:59:33'),
(299, 'T475/E2 ENVIROBASE COARSE ALUMINIUM', 'PAINT ROOM', 'T475', '9.34352', '11.6794', '0', '1997', '', '1', '2022-01-13 04:59:45'),
(300, 'T476/E2 ENVIROBASE SHINING COARSE ALUMINIUM', 'PAINT ROOM', 'T476', '8.32768', '10.4096', '0', '2028', '', '1', '2022-01-13 05:00:01'),
(301, 'T477/E1 ENVIROBASE VERY COARSE ALUMINIUM', 'PAINT ROOM', 'T477', '7.52312', '9.4039', '0', '1003', '', '1', '2022-01-13 05:00:13'),
(302, 'T479/E1 ENVIROBASE COARSE SILVER DOLLER ALUMINIUM', 'PAINT ROOM', 'T479', '9.33448', '11.6681', '0', '1003', '', '1', '2022-01-13 05:00:25'),
(303, 'T489/E0.5 ENVIROBASE GOLG FASH', 'PAINT ROOM', 'T489', '11.12832', '13.9104', '0', '491', '', '1', '2022-01-13 05:00:39'),
(304, 'T490/E1 ENVIROBASE CLEAR ADDITIVE', 'PAINT ROOM', 'T490', '6.234', '7.7925', '0', '981', '', '1', '2022-01-13 05:01:00'),
(305, 'T491/E1 ENVIROBASE TONE CONTROLLER', 'PAINT ROOM', 'T491', '7.25904', '9.0738', '0', '1050.8', '', '1', '2022-01-13 05:01:25'),
(306, 'T492/E1 ENVIROBASE  ADJUSTER', 'PAINT ROOM', 'T492', '8.12272', '10.1534', '0', '986', '', '1', '2022-01-13 05:01:38'),
(307, 'T4000/E0.5 ENVIROBASE CRYSTEL SILVER', 'PAINT ROOM', 'T4000', '32.31528', '40.3941', '0', '536', '', '1', '2022-01-13 04:58:56'),
(308, 'T4001/E0.5 ENVIROBASE SUNBEAM GOLD', 'PAINT ROOM', 'T4001', '31.87808', '39.8476', '0', '553', '', '1', '2022-01-13 05:02:27'),
(309, 'T4002/E0.5 ENVIROBASE REDIUM RED', 'PAINT ROOM', 'T4002', '32.7744', '40.968', '0', '516', '', '1', '2022-01-13 05:02:13'),
(310, 'T4003/E0.5 ENVIROBASE GALAXY BLUE', 'PAINT ROOM', 'T4003', '32.11848', '40.1481', '0', '551', '', '1', '2022-01-13 05:02:39'),
(311, 'T4004/E0.5 ENVIROBASE STEELER GREEN', 'PAINT ROOM', 'T4004', '16.6772', '20.8465', '0', '519', '', '1', '2022-01-13 05:02:53'),
(312, 'T4005/E0.5 ENVIROBASE SOLARIS RED', 'PAINT ROOM', 'T4005', '16.89504', '21.1188', '0', '507', '', '1', '2022-01-13 05:03:10'),
(313, 'T4006/E0.5 ENVIROBASE FIRE SIDE COPPER', 'PAINT ROOM', 'T4006', '16.78536', '20.9817', '0', '511', '', '1', '2022-01-13 05:03:24'),
(314, 'T4311/E0.5 ENVIROBASE HC GREEN BLUE', 'PAINT ROOM', 'T4311', '14.00712', '17.5089', '0', '488', '', '1', '2022-01-13 04:47:07'),
(315, 'T4040/E0.5ENVIROBASE ORANGE FLASH', 'PAINT ROOM', 'T4040', '14.0856', '17.607', '0', '503', '', '1', '2022-01-13 05:03:58'),
(316, 'T4281/E0.5 ENVIROBASE SOLID YELLOW', 'PAINT ROOM', 'T4281', '13.58232', '16.9779', '0', '565', '', '1', '2022-01-13 04:45:25'),
(317, 'T4321/E0.5 ENVIROBASE XC YELLOW', 'PAINT ROOM', 'T4321', '12.04296', '15.0537', '0', '504', '', '1', '2022-01-13 04:47:19'),
(318, 'T4341/E0.5 ENVIROBASE XC TRANCEPERANT RED', 'PAINT ROOM', 'T4341', '9.91104', '12.3888', '0', '486', '', '1', '2022-01-13 04:48:07'),
(319, 'T4342/E0.5 ENVIROBASE XC MEGANTA', 'PAINT ROOM', 'T4342', '18.16712', '22.7089', '0', '497', '', '1', '2022-01-13 04:48:24'),
(320, 'T4343/E0.5 ENVIROBASE  XC ORGANIC RED ', 'PAINT ROOM', 'T4343', '13.64512', '17.0564', '0', '491', '', '1', '2022-01-13 04:48:44'),
(321, 'BULB', '', '2651', '1000', '1250', '0', '0', '', '1', '2022-01-03 12:45:46'),
(322, 'PIRELLI TYRE 205/60 R16', '', 'P-205/60 R16', '34649.6', '43312', '0', '0', '', '1', '2022-01-05 07:54:28'),
(323, 'SOFTBACK SPONGE MEDIUM', 'PAINT ROOM', '3M-2606', '356.4', '445.5', '0', '5', '', '1', '2022-01-04 09:45:37'),
(324, 'BOOTH COATING', 'PAINT ROOM', '3M-6839', '8997.63', '11247.0375', '0', '1', '', '1', '2022-01-05 04:03:32'),
(325, 'SCOTCH BRITE BROWN GENERAL PURPOSE', 'PAINT ROOM', '3M-7447', '243', '303.75', '0', '40', '', '1', '2022-01-04 09:46:30'),
(326, '3M PERFECT IT RUBBING COMPOUND ', 'PAINT ROOM', '3M-36061', '5.79008', '7.2376', '0', '4059', '', '1', '2022-01-04 09:52:54'),
(327, '236U HOOKIT GOLD DISC', 'PAINT ROOM', '3M-P80C', '118.12496', '147.6562', '0', '16', '', '1', '2022-01-12 10:13:53'),
(328, '263U HOOKIT GOLD DISC ', 'PAINT ROOM', '3M-P120C', '105', '131.25', '0', '20', '', '1', '2022-01-04 09:36:59'),
(329, '236U HOOKIT GOLD DISC', 'PAINT ROOM', '3M-P180C', '113.75', '142.1875', '0', '15', '', '1', '2022-01-12 10:13:53'),
(330, '216U HOOKIT GOLD DISC', 'PAINT ROOM', '3M-P240A', '92.75', '115.9375', '0', '20', '', '1', '2022-01-04 09:37:26'),
(331, '216U HOOKIT GOLD DISC', 'PAINT ROOM ', '3M-P320A', '92.75', '115.9375', '0', '19', '', '1', '2022-01-05 06:21:29'),
(332, '216U HOOKIT GOLD DISC', 'PAINT ROOM', '3M-P400A', '104.12496', '130.1562', '0', '20', '', '1', '2022-01-04 09:37:48'),
(333, 'P500 HOOK GOLD DISC', 'PAINT ROOM', '3M-P500A', '128.62496', '160.7812', '0', '20', '', '1', '2022-01-04 09:38:01'),
(334, '1500A- 401Q MICROFINE APPRASIVE SHEET', 'PAINT ROOM', '3M-1500A', '133', '166.25', '0', '20', '', '1', '2022-01-04 09:38:13'),
(335, '2500A- 401Q MICROFINE APPRASIVE SHEET', 'PAINT ROOM', '3M-2500', '187.25', '234.0625', '0', '19', '', '1', '2022-01-12 10:13:53'),
(336, '2000A- 401Q MICROFINE APPRASIVE SHEET', 'PAINT ROOM', '3M-2000', '140', '175', '0', '19', '', '1', '2022-01-12 10:13:53'),
(337, 'SOFTBLACK SPONGE ULTRA FINE', 'PAINT ROOM', '3M-02601', '278.25', '347.8125', '0', '5', '', '1', '2022-01-04 09:39:10'),
(338, 'SOFTBLACK SPONGE SUPER FINE', 'PAINT ROOM', '3M-02602', '306.25', '382.8125', '0', '5', '', '1', '2022-01-04 09:39:34'),
(339, 'SOFTBLACK SPONGE FINE', 'PAINT ROOM', '3M-0604', '306.25', '382.8125', '0', '0', '', '1', '2022-01-04 09:32:26'),
(340, 'MASKING TAPE 24*55MM GREEN', 'PAINT ROOM', '3M-26336233', '462', '577.5', '0', '10.5', '', '1', '2022-01-12 10:34:14'),
(341, '3M AUTO MASKING TAPE 1*25', 'PAINT ROOM', '3M-228830330', '163.62496', '204.5312', '0', '12', '', '1', '2022-01-04 09:44:55'),
(342, 'SOFTBLACK SPONGE FINE', 'PAINT ROOM', '3M-02604', '306.25', '382.8125', '0', '5', '', '1', '2022-01-04 09:43:51'),
(343, 'W/D HAND PAD', 'PAINT ROOM', '3M-5526', '1113', '1391.25', '0', '1', '', '1', '2022-01-04 10:58:38'),
(344, 'FOAM COMPOUNDING PAD-SINGLE SIDE', 'PAINT ROOM', '3M-5737', '3762', '4702.5', '0', '1', '', '1', '2022-01-04 10:59:01'),
(345, 'WOOL COMPOUNDING PAD-SINGLE SIDE', 'PAINT ROOM', '3M-0571', '5243.88', '6554.85', '0', '1', '', '1', '2022-01-04 10:59:13'),
(346, 'FOAM POLISHING PAD-SINGLE SIDE', 'PAINT ROOM', '3M-5725', '3579.63', '4474.5375', '0', '1', '', '1', '2022-01-04 10:59:35'),
(347, 'HOOKIT SOFT INTERFACE PAD', 'PAINT ROOM', '3M-5777', '2666.13', '3332.6625', '0', '1', '', '1', '2022-01-04 10:59:52'),
(348, 'SOFT EDGE FOAM MASKING TAPE', 'PAINT ROOM', '3M-6293', '2.3016', '2.8770', '0', '4900', '', '1', '2022-01-05 04:26:06'),
(349, 'AMARON L3 BATTERY', 'A1', 'DIN70L', '26240', '32800', '0', '0', '', '1', '2022-01-13 05:05:46'),
(350, '220* 115MM ROLL 12M 3M737U HOOK CLN SND', 'PAINT ROOM', '3M-PN34467', '116.88744', '146.1093', '0', '104', '', '1', '2022-01-04 11:34:10'),
(351, '150* 3M 737U HOOK CLN ', 'PAINT ROOM', '3M-34465', '156.62592', '195.7824', '0', '104', '', '1', '2022-01-04 11:36:23'),
(352, '120* HOOK CLN', 'PAINT ROOM', '3M-PN34464', '144.93456', '181.1682', '0', '104', '', '1', '2022-01-04 11:36:35'),
(353, '229* 3M737U HOOK CLN', 'PAINT ROOM', '3M-34447', '52.55688', '65.6961', '0', '174', '', '1', '2022-01-04 11:36:50'),
(354, '180* 3M 737U HOOK CLN', 'PAINT ROOM', '3M-34446', '47.04304', '58.8038', '0', '174', '', '1', '2022-01-04 11:37:04'),
(355, '120* 3M 737U HOOK CLN', 'PAINT ROOM', '3M-PN34444', '51.56376', '64.4547', '0', '174', '', '1', '2022-01-04 11:37:19'),
(356, '150* 3M 737U HOOK CLN', 'PAINT ROOM', '3M-34445', '56.75688', '70.9461', '0', '174', '', '1', '2022-01-04 11:37:34'),
(357, '80* 3M 737U HOOK CLN ', 'PAINT ROOM', '3M-34442', '50.79304', '63.4913', '0', '174', '', '1', '2022-01-04 11:37:44'),
(358, '40* 3M737U HOOK CLN', 'PAINT ROOM', '3M-34440', '128.48272', '160.6034', '0', '116', '', '1', '2022-01-04 11:37:55'),
(359, '3M HOOKIT SANDING BLOCK D/F 70MM*127MM', 'PAINT ROOM', '3M-5207', '8746.2', '10932.75', '0', '1', '', '1', '2022-01-04 12:12:52'),
(360, '3M HOOKIT 5216 STANDING BLOCK DUST FREE ', 'PAINT ROOM', '3M-5216', '19839.6', '24799.5', '0', '1', '', '1', '2022-01-04 12:13:06'),
(361, 'HKT PURPLE * MULTI COVER ADS ', 'PAINT ROOM', '3M-50728', '7945.2', '9931.5', '0', '1', '', '1', '2022-01-04 12:13:16'),
(362, 'RUBBING COMPOUND ', 'PAINT ROOM', '3M-5973', '3.4344', '4.2930', '0', '771', '', '1', '2022-01-12 10:09:41'),
(363, '800 BLUE DISC 3M 321U HK BLUE DISC', 'PAINT ROOM', '3M-36184', '244.12496', '305.1562', '0', '20', '', '1', '2022-01-04 12:14:09'),
(364, '471 BLUE FINE LINE ', 'PAINT ROOM', '3M-471', '129.4948', '161.8685', '0', '33', '', '1', '2022-01-04 12:14:33'),
(365, 'TRIM MASKING TAPE', 'PAINT ROOM', '3M-06348', '13.468', '16.835', '0', '250', '', '1', '2022-01-04 12:14:46'),
(366, '3M PERFECT IT RUBBING COMPOUND 1L', 'PAINT ROOM', '3M-36060', '6.13696', '7.6712', '0', '795', '', '1', '2022-01-12 10:09:41'),
(367, '180+ 115 ROLL 3M737U HOOK', 'PAINT ROOM', '3M-34466', '0', '0', '0', '0', '', '1', '2022-01-05 04:56:01'),
(368, '3M OVERSPRAY PROTECTIVE SHEET 12FT*400FT', 'PAINT ROOM', '3M-6727', '34.38528', '42.9816', '0', '388', '', '1', '2022-01-05 06:21:29'),
(369, 'D863/1 LTR HP ACCELERATED', 'PAINT ROOM', 'D863', '5.14584', '6.4323', '0', '376', '', '1', '2022-01-12 10:13:53'),
(370, '3M HAND PAD ', 'PAINT ROOM', '3M-05526', '1144.70096', '1430.8762', '0', '1', '', '1', '2022-01-05 06:50:18'),
(371, '3M DOUBLE SIDE TAPE', 'PAINT ROOM', '3M-6384', '0.75176', '0.9397', '0', '13800', '', '1', '2022-01-05 11:53:15'),
(372, '3M OVERSPRAY PROTECTIVE SHEET 16FT*350FT', 'PAINT ROOM', '3M-6728', '35.84128', '44.8016', '0', '350', '', '1', '2022-01-05 06:56:59'),
(373, 'EASY PLUS BOOTH COATINGS 5L', 'PAINT ROOM', 'EASY PLUS BC', '1.76984', '2.2123', '0', '10000', '', '1', '2022-01-05 10:51:47'),
(374, 'TEST PLATE', 'PAINT ROOM', 'TP', '29.632', '37.04', '0', '50', '', '1', '2022-01-05 09:20:32'),
(375, 'PLASTIC TINS 1L', 'PAINT ROOM', 'PT', '56.296', '70.37', '0', '30', '', '1', '2022-01-05 09:21:44'),
(376, 'PLASTIC TINS 0.5L', 'PAINT ROOM', 'PT-0.5', '40.744', '50.93', '0', '30', '', '1', '2022-01-05 09:21:56'),
(377, 'GREEN FINE MASKING TAPE ', 'PAINT ROOM', 'GREEN FINE-1 NOS', '1383.48', '1729.35', '0', '5', '', '1', '2022-01-05 10:53:47'),
(378, 'GALVAPLAST- 1.5LTR', 'PAINT ROOM', 'A656', '2.70008', '3.3751', '0', '8900', '', '1', '2022-01-12 10:13:53'),
(379, 'test', '', '1', '8', '10', '0', '9', '', '1', '2022-01-08 21:06:53'),
(380, 'Oil Filter', '', '11427800066', '106563.6', ' 133204.50 ', '0', '0', '', '1', '2022-01-06 03:00:51'),
(381, 'Connector', '', 'OEM11117800048', '4914', ' 6142.50 ', '0', '0', 'FEBI', '1', '2022-01-06 03:32:41'),
(382, 'Preformed seal', '', '13718596850', '2527.2', ' 3159.00 ', '0', '0', '', '1', '2022-01-06 03:03:00'),
(383, 'Gasket ring', '', '12611744292', '1389.96', ' 1737.45 ', '0', '0', '', '1', '2022-01-06 03:03:37'),
(384, 'Oil cooling pipe', '', '17228509432', '25272', ' 31590.00 ', '0', '0', '', '1', '2022-01-06 03:04:09'),
(385, 'Cell supervision circuit', '', '61277648785', '37065.6', ' 46332.00 ', '0', '0', '', '1', '2022-01-06 03:04:42'),
(386, 'Supporting ring black, right', '', '51167327914', '19585.8', ' 24482.25 ', '0', '0', '', '1', '2022-01-06 03:06:23'),
(387, 'Set of wiper blades', '', '61612458016', '13899.6', ' 17374.50 ', '0', '0', '', '1', '2022-01-06 03:08:01'),
(388, 'Set oil-filter element', '', 'OEM11428507683', '4446', ' 5557.50 ', '0', '0', 'MAHLE', '1', '2022-01-06 03:32:00'),
(389, 'Air filter element', '', 'OEM13717797465', '9126', ' 11407.50 ', '0', '0', 'MAHLE', '1', '2022-01-06 03:33:36'),
(390, 'Fuel filter cartridge', '', 'OEM13328584874', '9126', '11407.5', '0', '0', 'MAHLE', '1', '2022-01-06 03:34:06'),
(391, 'Gearbox mount', '', 'OEM22316799330', '2527.2', ' 3159.00 ', '0', '0', 'FEBI', '1', '2022-01-06 03:11:47'),
(392, 'Engine mount', '', 'OEM22116768852', '13806', ' 17257.50 ', '0', '0', 'CORTECO', '1', '2022-01-06 03:12:51'),
(393, 'Engine mount', '', 'OEM22116768853', '13806', ' 17257.50 ', '0', '0', 'CORTECO', '1', '2022-01-06 03:14:03'),
(394, 'Radiator', '', 'OEM17117559273', '58500', '73125', '0', '0', 'MAHLE', '1', '2022-01-06 03:19:13'),
(395, 'Vent screw', '', 'OEM11537793373', '772.2', '965.25', '0', '0', 'FEBI', '1', '2022-01-06 03:18:56'),
(396, 'Exchange hydro steering gear', '', '32106777464', '591786', ' 739732.50 ', '0', '0', '', '1', '2022-01-06 03:20:33'),
(397, 'Gasket ring', '', '7119906463', '1411.024', ' 1763.78 ', '0', '0', '', '1', '2022-01-06 03:21:08'),
(398, 'Gasket ring', '', '7119906464', '210.6', ' 263.25 ', '0', '0', '', '1', '2022-01-06 03:21:51'),
(399, 'Gasket ring', '', '32411128333', '252.72', ' 315.90 ', '0', '0', '', '1', '2022-01-06 03:22:36'),
(400, 'Transfer box', '', '27109469019', '1737450', ' 2171812.50 ', '0', '0', '', '1', '2022-01-06 03:42:08'),
(401, 'Short Engine ', '', '11000003080', '2748330', ' 3435412.50 ', '0', '0', 'NEW', '1', '2022-01-06 03:40:51'),
(402, 'Condenser air conditioning with drier', '', 'OEM64509891030', '111618', ' 139522.50 ', '0', '0', 'MAHLE', '1', '2022-01-06 03:25:02'),
(403, 'Air filter element', '', '13717797465', '14742', ' 18427.50 ', '0', '0', '', '1', '2022-01-06 07:13:07'),
(404, 'Diesel filter', '', '13328584874', '14531.4', ' 18164.25', '0', '0', '', '1', '2022-01-06 07:13:38'),
(405, 'Gearbox mount', '', '22316799330', '6528.6', ' 8160.75 ', '0', '0', '', '1', '2022-01-06 07:14:08'),
(406, 'Engine mount', '', '22116768852', '32011.2', ' 40014.00 ', '0', '0', '', '1', '2022-01-06 07:14:36'),
(407, 'Engine mount', '', '22116768853', '32011.2', ' 40014.00 ', '0', '0', '', '1', '2022-01-06 07:15:02'),
(408, 'Radiator', '', '17117559273', '80028', ' 100035.00 ', '0', '0', '', '1', '2022-01-06 07:15:24'),
(409, 'Vent screw', '', '11537793373', '2106', ' 2632.50 ', '0', '0', '', '1', '2022-01-06 07:15:48'),
(410, 'Condenser air conditioning with drier', '', '64509891030', '122148', ' 152685.00 ', '0', '0', '', '1', '2022-01-06 07:16:09'),
(411, 'connector ', '', '11117800048', '9266.4', ' 11583.00 ', '0', '0', '', '1', '2022-01-06 07:17:32'),
(412, 'HEAVY DUTY DEGREASER', 'A1', 'PE-01 DEG', '850', '1062.5', '0', '1', '', '1', '2022-01-12 10:40:18'),
(413, 'HAND WASH', 'A1', 'PE-02 HW', '900', '1125', '0', '1', '', '1', '2022-01-11 16:21:48'),
(414, 'TOILET CLEANER', 'A1', 'PE-03 TC', '900', '1125', '0', '1', '', '1', '2022-01-11 16:20:15'),
(415, 'TYRE SHINE 5L', '', 'PE-04 TS', '3800', '4750', '0', '0', '', '1', '2022-01-06 08:45:05'),
(416, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:23:17'),
(417, 'Door pull right CARBON', 'E1', '51417225848-CF', '2800', '3500', '0', '2', '', '1', '2022-01-13 05:23:50'),
(418, 'Right recessed grip BLACK', 'E1', '51417225866-CH', '3458.256', '4322.82', '0', '4', '', '1', '2022-01-13 05:24:15'),
(419, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:24:39'),
(420, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:25:02'),
(421, 'Door pull left CARBON', 'E1', '51417225847-CF', '1200', '1500', '0', '4', '3500', '1', '2022-01-13 05:25:24'),
(422, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:25:50'),
(423, 'Trim power window, right BLACK', 'E1', '51417225890-CH', '400', '500', '0', '6', '750', '1', '2022-01-13 05:26:09'),
(424, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:26:55'),
(425, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:27:13'),
(426, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:27:40'),
(427, 'ATF', '', 'OEM-ATF MOBIL', '2000', '2500', '0', '0', '', '1', '2022-01-06 12:28:32'),
(428, 'RP air supply system', 'B5', 'OEM37206875177', '156976', '196220', '0', '2', 'WEBCO', '1', '2022-01-06 12:43:01'),
(429, 'Gasket', 'B3', '11127552280', '6844', '8555', '0', '1', '', '1', '2022-01-06 12:44:54'),
(430, 'Ornam.grille high-gloss, black,fr.right', 'E2', '51712165528-TW', '9240', '11550', '0', '2', '', '1', '2022-01-13 05:28:37'),
(431, 'Ornam.grille high-gloss, black, fr.left COLORED', 'E1', '51712165539-TW', '10000', '12500', '0', '2', '', '1', '2022-01-13 05:28:59'),
(432, 'Grille front, left', 'E2', '51137200727', '7120', '8900', '0', '1', '', '1', '2022-01-13 05:30:06'),
(433, 'Grille front, right', 'E2', '51137200728', '7120', '8900', '0', '1', '', '1', '2022-01-13 05:31:18'),
(434, 'Fresh air grille center rear BLACK', 'C5', '64229172167-CH', '6800', '8500', '0', '3', '', '1', '2022-01-06 20:08:41'),
(435, 'Switch parking brake/Auto-Hold cover BLACK', 'E1', '61316822518-ch', '3920', '4900', '0', '3', '', '1', '2022-01-13 05:33:57'),
(436, 'Hub cap with carbon trim black', 'D5', '36136783536-ch', '1440', '1800', '0', '5', '', '1', '2022-01-06 19:34:33'),
(437, 'BMW emblem carbon/black', 'D5', '51148132375-ch', '2240', '2800', '0', '6', '', '1', '2022-01-06 19:33:40'),
(438, 'BMW emblem carbon/black', 'D5', '51147057794-ch', '2240', '2800', '0', '7', '', '1', '2022-01-06 19:34:01'),
(439, 'phone holder', 'D5', 'PH-CH', '1280', '1600', '0', '4', '', '1', '2022-01-06 19:34:59'),
(440, 'Fresh air grille left', 'E1', '64229166893-ch', '4640', '5800', '0', '3', '', '1', '2022-01-13 05:38:19'),
(441, 'Fresh air grille right', 'E1', '64229166894-ch', '4640', '5800', '0', '3', '', '1', '2022-01-13 05:51:36'),
(442, 'Original BMW AGM-battery', 'A1', '61216806755', '113880', '142350', '0', '4', '', '1', '2022-01-06 18:19:19'),
(443, 'Trim power window, left BLACK', 'E1', '51417225889-ch', '600', '750', '0', '12', '', '1', '2022-01-13 05:53:06'),
(444, 'Trim power window, left-CF', 'E1', '51417225889-CF', '600', '750', '0', '4', '', '1', '2022-01-13 05:53:37'),
(445, 'Trim power window, right CF', 'E1', '51417225890-CF', '600', '750', '0', '2', '', '1', '2022-01-13 05:54:00'),
(446, 'Door pull left BLACK', 'E1', '51417225847-CH', '2800', '3500', '0', '12', '', '1', '2022-01-13 05:54:20');
INSERT INTO `tbl_item` (`item_id`, `part_name`, `part_location`, `part_number`, `part_cost`, `selling_cost`, `discount`, `quantity`, `remark`, `stat`, `item_date`) VALUES
(447, 'Door pull right BLACK', 'E1', '51417225848-CH', '2800', '3500', '0', '6', '', '1', '2022-01-13 05:54:34'),
(448, 'Right recessed grip CF', 'E1', '51417225874-CF', '3458.256', '4322.82', '0', '2', '', '1', '2022-01-13 05:55:25'),
(449, 'Right recessed grip BLACK', 'E1', '51417225874-CH', '3458.256', '4322.82', '0', '1', '', '1', '2022-01-13 05:56:43'),
(450, 'Headrest leather BLACK', 'E1', '52107255866-CH', '2800', '3500', '0', '0', '', '1', '2022-01-13 05:57:11'),
(451, 'Ashtray centre console, middle BLACK', 'E1', '51169206347-CH', '4400', '5500', '0', '0', '', '1', '2022-01-13 05:57:35'),
(452, 'Right recessed grip-beige', 'A4', '51417225876-CH', '3458.256', '4322.82', '0', '2', '', '1', '2022-01-13 05:57:52'),
(453, 'Right recessed grip-beige', 'A4', '51417225868-CH', '3458.256', '4322.82', '0', '2', '', '1', '2022-01-13 05:58:09'),
(454, 'Door pull right-beige', 'A4', '51417225850-CH', '2800', '3500', '0', '5', '', '1', '2022-01-13 05:58:28'),
(455, 'Door pull left-beige', 'A4', '51417225849-CH', '2800', '3500', '0', '8', '', '1', '2022-01-13 05:59:36'),
(456, 'Trim power window right-beige', 'A4', '51417225892-CH', '600', '750', '0', '5', '', '1', '2022-01-13 06:00:35'),
(457, 'Trim power window left-beige', 'A4', '51417225891-CH', '600', '750', '0', '9', '', '1', '2022-01-13 06:01:32'),
(458, 'DSC pulse generator front ', 'B5', 'OEM34526791223', '14592', '18240', '0', '2', '422', '1', '2022-01-10 05:18:57'),
(459, 'Pulse generator DSC rear', '', 'OEM34526791225', '14880', '18600', '0', '0', '', '1', '2022-01-07 08:54:36'),
(460, 'Connector', '', '11117803751', '0', '0', '0', '0', '', '1', '2022-01-07 11:57:11'),
(461, 'Heat exchanger', '', '11428512435', '0', '0', '0', '0', '', '1', '2022-01-07 12:01:08'),
(462, 'T4007/E0.25 ENVIROBASE COSMIC TORQUOI', 'PAINT ROOM', 'T4007', '32.41352', '40.5169', '0', '245', '', '1', '2022-01-13 05:03:36'),
(463, 'T494/5L ENVIROBASE THINNER', 'PAINT ROOM', 'T494', '2.57096', '3.2137', '0', '4991', '', '1', '2022-01-13 05:01:53'),
(464, 'D841/1L DELTRON HARDNER', 'PAINT ROOM', 'D841', '4.37152', '5.4644', '0', '989', '', '1', '2022-01-08 06:44:12'),
(465, 'D8426/400 ML AEROSAL SG07 DARK GRAY GREY', 'PAINT ROOM', 'D8426', '11.66712', '14.5839', '0', '302', '', '1', '2022-01-08 06:45:53'),
(466, 'D837/5L SPIRITE WHITE', 'PAINT ROOM', 'D837', '2.36544', '2.9568', '0', '3829', '', '1', '2022-01-08 06:47:11'),
(467, 'D8120/5L HS PERF CLEAR', 'PAINT ROOM', 'D8120', '3.88048', '4.8506', '0', '4841', '', '1', '2022-01-08 06:48:31'),
(468, 'D8238/1L FAST HARDNER', 'PAINT ROOM', 'D8238', '5.27744', '6.5968', '0', '994', '', '1', '2022-01-08 06:49:45'),
(469, 'D8046/3L HP PRIMER', 'PAINT ROOM', 'D8046', '3.47312', '4.3414', '0', '4403', '', '1', '2022-01-12 10:13:53'),
(470, 'D8507/1L SG07 SELF LEVELING DARK GREY PRIMER', 'PAINT ROOM', 'D8507', '4.77288', '5.9661', '0', '1325', '', '1', '2022-01-08 06:53:03'),
(471, 'D835/1L EPOXY HARDNER', 'PAINT ROOM', 'D835', '8.27608', '10.3451', '0', '836', '', '1', '2022-01-08 06:54:06'),
(472, 'D834/1 DELTRON EPOXY PRIMER GREY', 'PAINT ROOM', 'D834', '4.20464', '5.2558', '0', '1413', '', '1', '2022-01-08 06:57:09'),
(473, 'D8401/E5 ENVIROBASE LOE VOC CLEANER', 'PAINT ROOM', 'D8401', '2.59568', '3.2446', '0', '4895', '', '1', '2022-01-08 06:58:40'),
(474, 'D8427/0.5 HS THINNER', 'PAINT ROOM', 'D8427', '9.8424', '12.3030', '0', '524', '', '1', '2022-01-08 07:00:38'),
(475, 'T499/E2K FLOCCULANT AGENT', 'PAINT ROOM', 'T499', '7.41648', '9.2706', '0', '2015', '', '1', '2022-01-08 07:03:02'),
(476, 'D820/1L DELTRON PLASTIC PRIMER', 'PAINT ROOM', 'D820', '5.0708', '6.3385', '0', '811', '', '1', '2022-01-08 07:04:23'),
(477, 'T4008/E0.25 ENVIROBASE AUTUMN MYSTERY', 'PAINT ROOM', 'T4008', '32.2048', '40.2560', '0', '246', '', '1', '2022-01-08 07:09:56'),
(478, 'T4031/E.25 ENVIROBASE AUTUMN MYSTERY', 'PAINT ROOM', 'T4031', '39.6832', '49.6040', '0', '244', '', '1', '2022-01-08 07:11:30'),
(479, 'T4032/E0.25 ENVIROBASE VIOLA FANTACY', 'PAINT ROOM', 'T4032', '38.724', '48.4050', '0', '240', '', '1', '2022-01-08 07:12:56'),
(480, 'T4033/E0.25 ENVIROBASE ARCTIC FIRE', 'PAINT ROOM', 'T4033', '37.24616', '46.5577', '0', '248', '', '1', '2022-01-08 07:14:07'),
(481, 'T4034/E0.25 ENVIROBASE TROPIC SUNRISE', 'PAINT ROOM', 'T4034', '38.71704', '48.3963', '0', '247', '', '1', '2022-01-08 07:15:29'),
(482, 'Fresh air grille center BLACK', 'B5', '64229209137-CH', '8920', '11150', '0', '1', '', '1', '2022-01-12 09:54:30'),
(483, 'D8416/400ML AEROSAL SG-01 WHITE', 'PAINT ROOM', 'D8416', '8.81448', '11.0181', '0', '400', '', '1', '2022-01-10 10:38:05'),
(484, 'D8421/400ML AEROSAL SG-05 LIGHT GREY', 'PAINT ROOM', 'D8421', '8.81448', '11.0181', '0', '400', '', '1', '2022-01-10 10:40:21'),
(485, 'D8501/1 LTR SG01 SELF LEVELING WHITE PRIMER', 'PAINT ROOM', 'D8501', '7.27064', '9.0883', '0', '1000', '', '1', '2022-01-10 10:47:46'),
(486, 'D8112/5 LTR HPCLEAR 5 LTRS', 'PAINT ROOM', 'D8112', '4.4708', '5.5885', '0', '4000', '', '1', '2022-01-12 10:13:53'),
(487, 'D8115/1 LTR MATT CLEARCOAT', 'PAINT ROOM', 'D8115', '5.96712', '7.4589', '0', '950', '', '1', '2022-01-10 10:54:12'),
(488, 'AP P350-1493-5LTR', 'PAINT ROOM', 'P350-1493', '1.66216', '2.0777', '0', '13250', '', '1', '2022-01-12 10:13:53'),
(489, 'D868/1 LTR FADEOUT THINNER', 'PAINT ROOM', 'D868', '1.76248', '2.2031', '0', '870', '', '1', '2022-01-10 11:03:23'),
(490, 'T497/E5 GUN CLEANER', 'PAINT ROOM', 'T497', '2.29496', '2.8687', '0', '10000', '', '1', '2022-01-10 11:08:00'),
(491, 'T510/1 LTR EB CONVERTER', 'PAINT ROOM', 'T510', '6.06232', '7.5779', '0', '1000', '', '1', '2022-01-10 11:10:22'),
(492, 'D846/1 LTR ANTI STATIC AGENT', 'PAINT ROOM', 'D846', '3.34096', '4.1762', '0', '720', '', '1', '2022-01-10 11:13:40'),
(493, 'SANDING PAPER', 'PAINT ROOM', 'P400-SP', '120', '150', '0', '10', '', '1', '2022-01-11 06:38:08'),
(494, 'SANDING PAPER', 'PAINT ROOM', 'P600-SP', '120', '150', '0', '9', '', '1', '2022-01-12 09:31:53'),
(495, 'SANDING PAPER', 'PAINT ROOM', 'P800-SP', '120', '150', '0', '10', '', '1', '2022-01-11 06:39:36'),
(496, 'SANDING PAPER', 'PAINT ROOM', 'P1000-SP', '120', '150', '0', '9', '', '1', '2022-01-12 11:37:36'),
(497, 'SANDING PAPER', 'PAINT ROOM', 'P1200-SP', '150', '187.5', '0', '10', '', '1', '2022-01-11 06:41:26'),
(498, 'hydro-mounting', '', 'OEM8K0407183D', '3640', '4550', '0', '0', '', '1', '2022-01-11 18:39:55'),
(499, 'Bonded rubber bush', '', 'OEM8K0407182B', '3320', '4150', '0', '0', '', '1', '2022-01-11 18:41:03'),
(500, 'Bonded rubber bush outer', '', 'OEM4E0407181B', '3320', '4150', '0', '0', '', '1', '2022-01-11 18:41:47'),
(501, 'Swivel bearing', '', 'OEM4G0407689C', '9480', '11850', '0', '0', '', '1', '2022-01-11 18:43:23'),
(502, 'Track rod', '', 'OEM8J0423810', '10848', '13560', '0', '0', '', '1', '2022-01-11 18:45:19'),
(503, 'Tie rod right', '', 'OEM8K0422818A', '11280', '14100', '0', '0', '', '1', '2022-01-11 18:47:18'),
(504, 'Tie rod left', '', 'OEM8K0422817A', '11280', '14100', '0', '0', '', '1', '2022-01-11 18:47:53'),
(505, 'Cover cable guide', '', '8T0857593A', '2896', '3620', '0', '0', '', '1', '2022-01-11 18:57:19'),
(506, 'Gel for rain sensor', '', '4E0955609', '10368', '12960', '0', '0', '', '1', '2022-01-11 18:58:32'),
(507, 'Cover cable guide inner', '', '8T0857593A4PK', '2836', '3545', '0', '0', '', '1', '2022-01-11 18:59:54'),
(508, 'Partially open grid left', '', '51117396877', '17160', '21450', '0', '0', '', '1', '2022-01-12 05:50:46'),
(509, 'Expansion tank', '', '17139884859', '28960', '36200', '0', '0', '', '1', '2022-01-12 05:51:51'),
(510, 'Hose cylinder head-expansion tank', '', '17128602600', '14382.224', '17977.78', '0', '0', '', '1', '2022-01-12 06:14:09'),
(511, 'Pipe intake plenum-expansion tank', '', '17128632260', '10038.6', '12548.25', '0', '0', '', '1', '2022-01-12 06:16:04'),
(512, 'Pipe radiator-expansion tank', '', '17128602599', '11776.048', '14720.06', '0', '0', '', '1', '2022-01-12 06:17:10'),
(513, 'Tension strut with hydr. mount left', '', '31126775959', '77992.2', '97490.25', '0', '0', '', '1', '2022-01-12 06:18:24'),
(514, 'Tension strut with hydr. mount right', '', '31126775960', '77992.2', '97490.25', '0', '0', '', '1', '2022-01-12 06:19:14'),
(515, 'Hydrobearing', '', '31126775145', '20270.248', '25337.81', '0', '0', '', '1', '2022-01-12 06:20:04'),
(516, 'Line cylinder head-expansion tank', '', '11538592666', '11776.048', '14720.06', '0', '0', '17125A02485 (SUPERSEED NUMBER)', '1', '2022-01-12 06:29:28'),
(517, 'MACHINE POLISH', 'PAINT ROOM', '3M-5996', '4.9252', '6.1565', '0', '894', '', '1', '2022-01-12 10:26:06'),
(518, 'CARTRIDGE-3M', 'PAINT ROOM', '3311K-3M', '1800', '2250', '0', '1', '', '1', '2022-01-12 10:29:20'),
(519, 'FACE MASK-3M', 'PAINT ROOM', '3200-3M', '2070', '2587.5', '0', '1', '', '1', '2022-01-12 10:30:24'),
(520, 'CHAMISE LEATHER CLOTH', 'C2', 'LC-3M', '320', '400', '0', '0', '\r\n', '1', '2022-01-13 05:37:25'),
(521, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 05:59:22'),
(522, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 06:00:18'),
(523, '0', '', '0', '0', '0', '0', '0', '', '1', '2022-01-13 06:01:18'),
(524, 'BATTERY WATER', 'A1', 'BW', '120', '150', '0', '5', '', '1', '2022-01-13 06:25:54'),
(525, 'REMOTE KEY BATTERY', 'C2', 'CR-2032', '200', '250', '0', '5', '', '1', '2022-01-13 06:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_cost`
--

CREATE TABLE `tbl_item_cost` (
  `item_r_id` int(11) NOT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `item_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_cost`
--

INSERT INTO `tbl_item_cost` (`item_r_id`, `item_id`, `cost`, `item_datetime`) VALUES
(1, '1', '3480000', '2021-12-17 22:10:44'),
(2, '2', '4760', '2021-12-20 22:41:56'),
(3, '3', '0', '2021-12-20 22:44:20'),
(4, '4', '0', '2021-12-20 23:03:04'),
(5, '5', '7120', '2021-12-20 23:05:31'),
(6, '6', '11920', '2021-12-20 23:16:39'),
(7, '7', '620', '2021-12-20 23:17:49'),
(8, '8', '11956', '2021-12-20 23:18:27'),
(9, '9', '1680000', '2021-12-23 22:54:35'),
(10, '10', '11520', '2021-12-24 12:24:58'),
(11, '11', '3824', '2021-12-24 12:26:29'),
(12, '12', '4160', '2021-12-29 13:51:18'),
(13, '13', '23658.80 ', '2021-12-29 13:54:46'),
(14, '14', ' 23658.80 ', '2021-12-29 13:56:33'),
(15, '15', '12.8', '2021-12-29 13:57:09'),
(16, '16', '6.4', '2021-12-29 13:57:31'),
(17, '17', '4', '2021-12-29 14:01:46'),
(18, '18', '0', '2021-12-29 14:02:59'),
(19, '19', '20240', '2021-12-29 14:13:00'),
(20, '20', '4160', '2021-12-29 14:14:34'),
(21, '21', '3520', '2021-12-29 14:15:02'),
(22, '22', '84800', '2021-12-29 14:16:04'),
(23, '23', '8160', '2021-12-29 14:17:30'),
(24, '24', '27600', '2021-12-29 14:19:01'),
(25, '25', '44160', '2021-12-29 14:22:25'),
(26, '26', '44160', '2021-12-29 14:23:04'),
(27, '27', '106400', '2021-12-29 14:23:41'),
(28, '28', '4480', '2021-12-29 14:24:19'),
(29, '29', '9760', '2021-12-29 14:25:01'),
(30, '30', '12800', '2021-12-29 14:25:38'),
(31, '31', '49760', '2021-12-29 14:26:20'),
(32, '32', '5840', '2021-12-29 14:26:58'),
(33, '33', '0', '2021-12-29 14:28:02'),
(34, '34', '0', '2021-12-29 14:28:59'),
(35, '35', '13120', '2021-12-29 14:29:29'),
(36, '36', '0', '2021-12-29 14:30:20'),
(37, '37', '0', '2021-12-29 14:31:09'),
(38, '38', '13440', '2021-12-29 14:35:47'),
(39, '39', '0', '2021-12-29 14:36:30'),
(40, '40', '0', '2021-12-29 14:37:22'),
(41, '41', '7840', '2021-12-29 14:38:04'),
(42, '42', '36640', '2021-12-29 14:41:18'),
(43, '43', '45440', '2021-12-29 14:42:23'),
(44, '44', '45440', '2021-12-29 14:43:48'),
(45, '45', '2440', '2021-12-29 14:44:26'),
(46, '46', '62320', '2021-12-29 14:45:00'),
(47, '47', '62320', '2021-12-29 14:45:42'),
(48, '48', '0', '2021-12-29 14:46:14'),
(49, '49', '0', '2021-12-29 14:47:13'),
(50, '50', '0', '2021-12-29 14:48:57'),
(51, '51', '0', '2021-12-29 14:49:37'),
(52, '52', '600', '2021-12-29 14:51:53'),
(53, '53', '24400', '2021-12-29 14:52:35'),
(54, '54', '4320', '2021-12-29 14:53:26'),
(55, '55', '20720', '2021-12-29 14:54:47'),
(56, '56', '26480', '2021-12-29 14:56:05'),
(57, '57', '26480', '2021-12-29 14:57:38'),
(58, '58', '0', '2021-12-29 14:58:21'),
(59, '59', '0', '2021-12-29 14:59:22'),
(60, '60', '0', '2021-12-29 15:00:07'),
(61, '61', '17360', '2021-12-29 15:01:09'),
(62, '62', '4160', '2021-12-29 15:01:53'),
(63, '63', '18560', '2021-12-29 15:03:31'),
(64, '64', '28240', '2021-12-29 15:05:06'),
(65, '65', '0', '2021-12-29 15:06:04'),
(66, '66', '0', '2021-12-29 15:08:07'),
(67, '67', '0', '2021-12-29 15:08:52'),
(68, '68', '0', '2021-12-29 15:10:14'),
(69, '69', '0', '2021-12-29 15:11:13'),
(70, '70', '0', '2021-12-29 15:11:56'),
(71, '71', '0', '2021-12-29 15:13:02'),
(72, '72', 'o', '2021-12-29 15:13:35'),
(73, '73', '0', '2021-12-29 15:14:04'),
(74, '74', '30080', '2021-12-29 15:14:33'),
(75, '75', '30080', '2021-12-29 15:15:10'),
(76, '76', '113600', '2021-12-29 15:16:16'),
(77, '77', '0', '2021-12-29 15:17:13'),
(78, '78', '0', '2021-12-29 15:18:05'),
(79, '79', '42000', '2021-12-29 15:22:43'),
(80, '80', '19440', '2021-12-29 15:24:08'),
(81, '81', '14800', '2021-12-29 15:25:08'),
(82, '82', '28480', '2021-12-29 16:02:36'),
(83, '83', '0', '2021-12-29 16:04:13'),
(84, '84', '3840', '2021-12-29 16:06:39'),
(85, '85', '276000', '2021-12-29 16:07:13'),
(86, '86', '0', '2021-12-29 16:07:38'),
(87, '87', '4560', '2021-12-29 16:09:01'),
(88, '88', '4880', '2021-12-29 16:09:27'),
(89, '89', '11120', '2021-12-29 16:09:58'),
(90, '90', '10160', '2021-12-29 16:10:40'),
(91, '91', '28240', '2021-12-29 16:11:32'),
(92, '92', '0', '2021-12-29 16:12:14'),
(93, '93', '12560', '2021-12-29 16:12:59'),
(94, '94', '30400', '2021-12-29 16:14:19'),
(95, '95', '30400', '2021-12-29 16:14:57'),
(96, '96', '22440.00 ', '2021-12-29 16:15:42'),
(97, '97', '22440.00 ', '2021-12-29 16:16:42'),
(98, '98', '27600', '2021-12-29 16:18:36'),
(99, '99', '6080', '2021-12-29 17:08:19'),
(100, '100', '10800', '2021-12-29 17:14:48'),
(101, '101', '62520', '2021-12-29 17:18:15'),
(102, '102', '24400', '2021-12-29 17:18:51'),
(103, '103', '36960', '2021-12-29 17:19:39'),
(104, '104', '40080', '2021-12-29 17:22:00'),
(105, '105', '39840', '2021-12-29 17:22:38'),
(106, '106', '28640', '2021-12-29 17:23:11'),
(107, '107', '3760', '2021-12-29 17:25:32'),
(108, '108', '3579.95 ', '2021-12-29 17:26:25'),
(109, '109', '5200', '2021-12-29 17:27:13'),
(110, '110', '3120', '2021-12-29 17:28:08'),
(111, '111', '14800', '2021-12-29 17:29:03'),
(112, '112', '12800', '2021-12-29 17:40:38'),
(113, '113', '46400', '2021-12-29 17:41:49'),
(114, '114', '5759.05 ', '2021-12-29 17:42:24'),
(115, '115', '52360', '2021-12-29 17:42:49'),
(116, '116', '9200', '2021-12-29 17:43:46'),
(117, '117', '2400', '2021-12-29 17:44:32'),
(118, '118', '3840', '2021-12-29 17:45:02'),
(119, '119', '6160', '2021-12-29 17:45:43'),
(120, '120', '25920', '2021-12-29 18:02:29'),
(121, '121', '5280', '2021-12-29 18:03:54'),
(122, '122', '4400', '2021-12-29 18:04:52'),
(123, '123', '14240', '2021-12-29 18:06:23'),
(124, '124', '0', '2021-12-29 18:07:32'),
(125, '125', '24920', '2021-12-29 18:15:46'),
(126, '126', '376', '2021-12-29 18:26:14'),
(127, '127', '68', '2021-12-29 18:26:47'),
(128, '128', '176', '2021-12-29 18:28:08'),
(129, '129', '41600', '2021-12-29 18:28:51'),
(130, '130', '5200', '2021-12-29 18:30:46'),
(131, '131', '28400', '2021-12-29 18:31:30'),
(132, '132', '28400', '2021-12-29 18:32:12'),
(133, '133', '11200', '2021-12-29 18:32:45'),
(134, '134', '6720', '2021-12-29 18:33:29'),
(135, '135', '58800', '2021-12-29 18:34:27'),
(136, '136', '6000', '2021-12-29 18:35:22'),
(137, '137', '19840', '2021-12-29 18:36:20'),
(138, '138', '21760', '2021-12-29 18:36:54'),
(139, '139', '2960', '2021-12-29 18:37:28'),
(140, '140', '4240', '2021-12-29 18:38:09'),
(141, '141', '2960', '2021-12-29 18:38:56'),
(142, '142', '68000', '2021-12-29 18:39:54'),
(143, '143', '0', '2021-12-29 18:41:10'),
(144, '144', '25740', '2021-12-29 18:42:26'),
(145, '145', '23120', '2021-12-29 18:43:13'),
(146, '146', '0', '2021-12-29 18:43:51'),
(147, '147', '0', '2021-12-29 18:44:33'),
(148, '148', '0', '2021-12-29 18:45:40'),
(149, '149', '0', '2021-12-29 18:46:28'),
(150, '150', '4400', '2021-12-29 18:52:19'),
(151, '151', '0', '2021-12-29 18:56:19'),
(152, '152', '2208', '2021-12-29 18:57:18'),
(153, '153', '8160', '2021-12-29 18:58:09'),
(154, '154', '8400', '2021-12-29 19:05:32'),
(155, '155', '6240', '2021-12-29 19:07:16'),
(156, '156', '0', '2021-12-29 19:07:58'),
(157, '157', '640', '2021-12-29 19:09:12'),
(158, '158', '1840', '2021-12-29 19:14:28'),
(159, '159', '1760', '2021-12-29 19:20:31'),
(160, '160', '8480', '2021-12-29 19:22:40'),
(161, '161', '8400', '2021-12-29 19:24:25'),
(162, '162', '0', '2021-12-29 19:25:07'),
(163, '163', '3795.00 ', '2021-12-29 19:26:44'),
(164, '164', '0', '2021-12-29 19:27:35'),
(165, '165', '0', '2021-12-29 19:28:32'),
(166, '166', '45080', '2021-12-29 19:32:08'),
(167, '167', '19440', '2021-12-29 19:33:30'),
(168, '168', '3440', '2021-12-29 19:35:43'),
(169, '169', '26600', '2021-12-29 19:37:41'),
(170, '170', '46560', '2021-12-29 19:39:08'),
(171, '171', '0', '2021-12-29 19:40:06'),
(172, '172', '0', '2021-12-29 19:41:34'),
(173, '173', '49600', '2021-12-29 19:44:44'),
(174, '174', '29680', '2021-12-29 19:45:26'),
(175, '175', '0', '2021-12-29 19:46:15'),
(176, '176', '0', '2021-12-29 19:46:54'),
(177, '177', '0', '2021-12-29 19:47:39'),
(178, '178', '105600', '2021-12-29 19:49:32'),
(179, '179', '0', '2021-12-29 19:50:30'),
(180, '180', '35840', '2021-12-29 19:51:17'),
(181, '181', '0', '2021-12-29 19:52:04'),
(182, '182', '0', '2021-12-29 19:55:36'),
(183, '183', '30880', '2021-12-29 19:56:43'),
(184, '184', '0', '2021-12-29 19:59:47'),
(185, '185', '0', '2021-12-29 20:00:38'),
(186, '186', '0', '2021-12-29 20:02:08'),
(187, '187', '67200', '2021-12-29 20:47:33'),
(188, '188', '34400', '2021-12-29 20:58:35'),
(189, '189', '5940.00 ', '2021-12-29 21:00:35'),
(190, '190', '14400', '2021-12-29 21:01:22'),
(191, '191', '11200', '2021-12-29 21:02:23'),
(192, '192', '25600', '2021-12-29 21:03:09'),
(193, '193', '6960', '2021-12-29 21:03:49'),
(194, '194', '6560', '2021-12-29 21:04:45'),
(195, '195', '6560', '2021-12-29 21:05:09'),
(196, '196', '6560', '2021-12-29 21:05:56'),
(197, '197', '6560', '2021-12-29 21:07:06'),
(198, '198', '6560', '2021-12-29 21:08:13'),
(199, '199', '6560', '2021-12-29 21:08:39'),
(200, '200', '6560', '2021-12-29 21:09:35'),
(201, '201', '6560', '2021-12-29 21:10:12'),
(202, '202', '20320', '2021-12-29 21:10:51'),
(203, '203', '16160', '2021-12-29 21:11:38'),
(204, '204', '3600', '2021-12-29 21:12:19'),
(205, '205', '22400', '2021-12-29 21:13:14'),
(206, '206', '15840', '2021-12-29 21:15:10'),
(207, '207', '15840', '2021-12-29 21:16:13'),
(208, '208', '6000', '2021-12-29 21:16:58'),
(209, '209', '19200', '2021-12-29 21:18:22'),
(210, '210', '15520', '2021-12-29 21:20:34'),
(211, '211', '7600', '2021-12-29 21:21:02'),
(212, '212', '3110.00 ', '2021-12-29 21:21:31'),
(213, '213', '3576.50 ', '2021-12-29 21:21:57'),
(214, '214', '7153.00 ', '2021-12-29 21:22:32'),
(215, '215', '7153.00 ', '2021-12-29 21:23:05'),
(216, '216', '5909.00 ', '2021-12-29 21:23:57'),
(217, '217', '5840', '2021-12-29 21:24:33'),
(218, '218', '3760', '2021-12-29 21:25:19'),
(219, '219', '1040', '2021-12-29 21:26:03'),
(220, '220', '4160', '2021-12-29 21:28:08'),
(221, '221', '30800', '2021-12-29 21:29:07'),
(222, '222', '24000', '2021-12-30 12:58:24'),
(223, '223', '23658.80 ', '2021-12-30 16:19:41'),
(224, '224', '67200', '2021-12-30 18:52:51'),
(225, '225', '680', '2021-12-31 13:35:08'),
(226, '226', '136', '2021-12-31 13:35:45'),
(227, '227', '136', '2021-12-31 13:38:06'),
(228, '228', '6.25152', '2021-12-31 13:53:27'),
(229, '229', '700', '2021-12-31 13:59:28'),
(230, '230', '700', '2021-12-31 14:01:32'),
(231, '231', '700', '2021-12-31 14:02:02'),
(232, '232', '0', '2021-12-31 14:02:39'),
(233, '233', '0', '2021-12-31 14:04:48'),
(234, '234', '0', '2021-12-31 14:05:36'),
(235, '235', '0', '2021-12-31 14:06:19'),
(236, '236', '0', '2021-12-31 14:06:57'),
(237, '237', '6160', '2022-01-03 08:14:18'),
(238, '238', '0', '2022-01-03 10:55:12'),
(239, '239', '3760', '2022-01-03 11:54:28'),
(240, '240', '4080', '2022-01-03 11:56:48'),
(241, '241', '0', '2022-01-03 12:22:42'),
(242, '242', '2850', '2022-01-03 13:01:38'),
(243, '243', '3400', '2022-01-03 13:05:20'),
(244, '244', '11480', '2022-01-03 13:08:44'),
(245, '245', '4212', '2022-01-03 13:42:27'),
(246, '246', '5.68552', '2022-01-03 14:11:41'),
(247, '247', '11.37256', '2022-01-03 14:13:49'),
(248, '248', '6.10968', '2022-01-03 14:15:32'),
(249, '249', '17.9112', '2022-01-03 14:17:41'),
(250, '250', '6.88216', '2022-01-03 14:24:08'),
(251, '251', '7.82256', '2022-01-03 14:34:21'),
(252, '252', '6.7708', '2022-01-03 14:37:47'),
(253, '253', '6.24736', '2022-01-03 14:40:04'),
(254, '254', '5.41864', '2022-01-03 15:13:16'),
(255, '255', '6.676', '2022-01-03 15:16:15'),
(256, '256', '7.69784', '2022-01-03 15:22:21'),
(257, '257', '6.71744', '2022-01-03 15:24:21'),
(258, '258', '9.84336', '2022-01-03 15:33:19'),
(259, '259', '6.026', '2022-01-03 15:35:12'),
(260, '260', '10.8636', '2022-01-03 15:40:14'),
(261, '261', '6.78976', '2022-01-03 15:43:25'),
(262, '262', '5.90592', '2022-01-03 17:15:06'),
(263, '263', '9.10536', '2022-01-03 17:18:28'),
(264, '264', '8.988', '2022-01-03 17:21:32'),
(265, '265', '16.24016', '2022-01-03 17:22:56'),
(266, '266', '7.33984', '2022-01-03 17:23:53'),
(267, '267', '7.91016', '2022-01-03 17:24:42'),
(268, '268', '7.49688', '2022-01-03 17:25:39'),
(269, '269', '7.11688', '2022-01-03 17:26:34'),
(270, '270', '14.2264', '2022-01-03 17:27:31'),
(271, '271', '10.63088', '2022-01-03 17:28:20'),
(272, '272', '6.84688', '2022-01-03 17:29:18'),
(273, '273', '9.85336', '2022-01-03 17:30:10'),
(274, '274', '5.4924', '2022-01-03 17:31:08'),
(275, '275', '10.75824', '2022-01-03 17:32:01'),
(276, '276', '11.4952', '2022-01-03 17:33:13'),
(277, '277', '6.06896', '2022-01-03 17:34:03'),
(278, '278', '9.94008', '2022-01-03 17:34:56'),
(279, '279', '10.9576', '2022-01-03 17:35:48'),
(280, '280', '9.07888', '2022-01-03 17:36:38'),
(281, '281', '7.67624', '2022-01-03 17:37:36'),
(282, '282', '7.26904', '2022-01-03 17:38:29'),
(283, '283', '6.66264', '2022-01-03 17:39:29'),
(284, '284', '10.7736', '2022-01-03 17:40:16'),
(285, '285', '7.7628', '2022-01-03 17:40:59'),
(286, '286', '7.33256', '2022-01-03 17:41:45'),
(287, '287', '8.01888', '2022-01-03 17:42:38'),
(288, '288', '11.00088', '2022-01-03 17:43:33'),
(289, '289', '12.836', '2022-01-03 17:44:17'),
(290, '290', '7.44424', '2022-01-03 17:45:49'),
(291, '291', '9.40808', '2022-01-03 17:46:36'),
(292, '292', '11.5664', '2022-01-03 17:47:17'),
(293, '293', '8.4204', '2022-01-03 17:48:03'),
(294, '294', '8.10712', '2022-01-03 17:48:49'),
(295, '295', '7.60336', '2022-01-03 17:49:46'),
(296, '296', '10.53328', '2022-01-03 17:50:43'),
(297, '297', '7.42416', '2022-01-03 17:51:43'),
(298, '298', '8.70936', '2022-01-03 17:52:29'),
(299, '299', '9.34352', '2022-01-03 17:54:53'),
(300, '300', '8.32768', '2022-01-03 17:55:39'),
(301, '301', '7.52312', '2022-01-03 17:56:32'),
(302, '302', '9.33448', '2022-01-03 17:57:26'),
(303, '303', '11.12832', '2022-01-03 17:58:20'),
(304, '304', '6.234', '2022-01-03 17:59:02'),
(305, '305', '7.25904', '2022-01-03 17:59:59'),
(306, '306', '8.12272', '2022-01-03 18:00:49'),
(307, '307', '32.31528', '2022-01-03 18:01:43'),
(308, '308', '31.87808', '2022-01-03 18:02:29'),
(309, '309', '32.7744', '2022-01-03 18:03:18'),
(310, '310', '32.11848', '2022-01-03 18:03:57'),
(311, '311', '16.6772', '2022-01-03 18:04:41'),
(312, '312', '16.89504', '2022-01-03 18:05:34'),
(313, '313', '16.78536', '2022-01-03 18:06:23'),
(314, '314', '14.00712', '2022-01-03 18:08:50'),
(315, '315', '14.0856', '2022-01-03 18:09:35'),
(316, '316', '13.58232', '2022-01-03 18:10:29'),
(317, '317', '12.04296', '2022-01-03 18:11:17'),
(318, '318', '9.91104', '2022-01-03 18:12:19'),
(319, '319', '18.16712', '2022-01-03 18:13:12'),
(320, '320', '13.64512', '2022-01-03 18:13:57'),
(321, '321', '500', '2022-01-03 18:15:46'),
(322, '322', '35200', '2022-01-04 08:53:44'),
(323, '323', '356.4', '2022-01-04 12:41:01'),
(324, '324', '8997.63', '2022-01-04 12:43:24'),
(325, '325', '243', '2022-01-04 12:49:34'),
(326, '326', '5.7901', '2022-01-04 12:58:31'),
(327, '327', '118.125', '2022-01-04 13:04:30'),
(328, '328', '105', '2022-01-04 13:05:57'),
(329, '329', '113.75', '2022-01-04 13:07:53'),
(330, '330', '92.75', '2022-01-04 14:50:32'),
(331, '331', '92.75', '2022-01-04 14:51:33'),
(332, '332', '104.125', '2022-01-04 14:53:39'),
(333, '333', '128.625', '2022-01-04 14:54:53'),
(334, '334', '133', '2022-01-04 14:56:30'),
(335, '335', '187.25', '2022-01-04 14:58:04'),
(336, '336', '140', '2022-01-04 14:58:48'),
(337, '337', '278.25', '2022-01-04 15:00:24'),
(338, '338', '306.25', '2022-01-04 15:01:20'),
(339, '339', '306.25', '2022-01-04 15:02:26'),
(340, '340', '462', '2022-01-04 15:04:11'),
(341, '341', '163.625', '2022-01-04 15:05:38'),
(342, '342', '306.25', '2022-01-04 15:13:26'),
(343, '343', '1113', '2022-01-04 16:02:06'),
(344, '344', '3762', '2022-01-04 16:04:27'),
(345, '345', '5243.88', '2022-01-04 16:06:27'),
(346, '346', '3579.63', '2022-01-04 16:07:56'),
(347, '347', '2666.13', '2022-01-04 16:10:12'),
(348, '348', '2.3016', '2022-01-04 16:19:58'),
(349, '349', '26240', '2022-01-04 16:34:54'),
(350, '350', '116.88744', '2022-01-04 16:48:23'),
(351, '351', '156.62592', '2022-01-04 16:51:05'),
(352, '352', '144.9346', '2022-01-04 16:52:35'),
(353, '353', '52.5568', '2022-01-04 16:54:58'),
(354, '354', '47.0431', '2022-01-04 16:55:51'),
(355, '355', '51.5637', '2022-01-04 16:57:01'),
(356, '356', '56.7568', '2022-01-04 16:58:45'),
(357, '357', '50.7931', '2022-01-04 16:59:36'),
(358, '358', '128.4827', '2022-01-04 17:00:34'),
(359, '359', '8746.20', '2022-01-04 17:33:18'),
(360, '360', '19839.60', '2022-01-04 17:34:33'),
(361, '361', '7945.20', '2022-01-04 17:35:32'),
(362, '362', '3.4344', '2022-01-04 17:37:03'),
(363, '363', '244.125', '2022-01-04 17:38:21'),
(364, '364', '129.4948', '2022-01-04 17:39:51'),
(365, '365', '13.468', '2022-01-04 17:40:47'),
(366, '366', '6.1370', '2022-01-04 17:41:52'),
(367, '367', '0', '2022-01-05 10:26:01'),
(368, '368', '34.3853', '2022-01-05 10:30:17'),
(369, '369', '4.76472', '2022-01-05 12:06:08'),
(370, '370', '1144.701', '2022-01-05 12:20:01'),
(371, '371', '0.7048', '2022-01-05 12:22:40'),
(372, '372', '35.8413', '2022-01-05 12:26:46'),
(373, '373', '1.6388', '2022-01-05 14:44:24'),
(374, '374', '37.04', '2022-01-05 14:46:58'),
(375, '375', '70.37', '2022-01-05 14:48:15'),
(376, '376', '50.93', '2022-01-05 14:50:11'),
(377, '377', '1281', '2022-01-05 14:54:37'),
(378, '378', '2.7002', '2022-01-05 17:04:27'),
(379, '379', '10', '2022-01-05 22:33:06'),
(380, '380', ' 98670.00 ', '2022-01-06 08:30:51'),
(381, '381', ' 4095.00 ', '2022-01-06 08:32:13'),
(382, '382', ' 2340.00 ', '2022-01-06 08:33:00'),
(383, '383', ' 1287.00 ', '2022-01-06 08:33:37'),
(384, '384', ' 23400.00 ', '2022-01-06 08:34:09'),
(385, '385', ' 34320.00 ', '2022-01-06 08:34:42'),
(386, '386', ' 18135.00 ', '2022-01-06 08:36:23'),
(387, '387', ' 12870.00 ', '2022-01-06 08:38:01'),
(388, '388', ' 3705.00 ', '2022-01-06 08:39:03'),
(389, '389', ' 7605.00 ', '2022-01-06 08:40:05'),
(390, '390', '9126', '2022-01-06 08:40:51'),
(391, '391', ' 1755.00 ', '2022-01-06 08:41:47'),
(392, '392', ' 11505.00 ', '2022-01-06 08:42:51'),
(393, '393', ' 11505.00 ', '2022-01-06 08:44:03'),
(394, '394', '58500', '2022-01-06 08:47:45'),
(395, '395', '772.2', '2022-01-06 08:48:27'),
(396, '396', ' 547950.00 ', '2022-01-06 08:50:33'),
(397, '397', ' 1306.50 ', '2022-01-06 08:51:08'),
(398, '398', ' 195.00 ', '2022-01-06 08:51:51'),
(399, '399', ' 234.00 ', '2022-01-06 08:52:36'),
(400, '400', ' 1608750.00 ', '2022-01-06 08:53:12'),
(401, '401', ' 2544750.00 ', '2022-01-06 08:54:19'),
(402, '402', ' 103350.00 ', '2022-01-06 08:55:02'),
(403, '403', ' 13650.00 ', '2022-01-06 12:43:07'),
(404, '404', ' 13455.00 ', '2022-01-06 12:43:38'),
(405, '405', ' 6045.00 ', '2022-01-06 12:44:07'),
(406, '406', ' 29640.00 ', '2022-01-06 12:44:36'),
(407, '407', ' 29640.00 ', '2022-01-06 12:45:02'),
(408, '408', ' 74100.00 ', '2022-01-06 12:45:24'),
(409, '409', ' 1950.00 ', '2022-01-06 12:45:48'),
(410, '410', ' 113100.00 ', '2022-01-06 12:46:09'),
(411, '411', ' 8580.00 ', '2022-01-06 12:47:32'),
(412, '412', '850', '2022-01-06 14:09:15'),
(413, '413', '900', '2022-01-06 14:12:24'),
(414, '414', '900', '2022-01-06 14:13:48'),
(415, '415', '3800', '2022-01-06 14:15:05'),
(416, '416', '0', '2022-01-06 14:18:15'),
(417, '417', '2800', '2022-01-06 14:18:54'),
(418, '418', '3458.256', '2022-01-06 14:19:24'),
(419, '419', '0', '2022-01-06 14:20:09'),
(420, '420', '0', '2022-01-06 14:20:37'),
(421, '421', '1200', '2022-01-06 14:21:33'),
(422, '422', '0', '2022-01-06 14:22:07'),
(423, '423', '400', '2022-01-06 14:22:35'),
(424, '424', '0', '2022-01-06 14:23:01'),
(425, '425', '0', '2022-01-06 14:23:30'),
(426, '426', '0', '2022-01-06 14:24:29'),
(427, '427', '1850', '2022-01-06 17:58:32'),
(428, '428', '150937.5', '2022-01-06 18:12:24'),
(429, '429', '5031.25', '2022-01-06 18:14:44'),
(430, '430', '9240', '2022-01-06 18:47:11'),
(431, '431', '10000', '2022-01-06 18:48:24'),
(432, '432', '7120', '2022-01-06 18:53:38'),
(433, '433', '7120', '2022-01-06 18:54:16'),
(434, '434', '6800', '2022-01-06 19:00:39'),
(435, '435', '3920', '2022-01-06 19:03:37'),
(436, '436', '1440', '2022-01-06 19:13:02'),
(437, '437', '2240', '2022-01-06 19:19:57'),
(438, '438', '2240', '2022-01-06 19:21:09'),
(439, '439', '1280', '2022-01-06 19:25:10'),
(440, '440', '4640', '2022-01-06 23:45:49'),
(441, '441', '4640', '2022-01-06 23:46:45'),
(442, '442', '95219.42', '2022-01-06 23:48:37'),
(443, '443', '600', '2022-01-06 23:52:30'),
(444, '444', '600', '2022-01-06 23:55:16'),
(445, '445', '600', '2022-01-06 23:58:36'),
(446, '446', '2800', '2022-01-07 00:02:48'),
(447, '447', '2800', '2022-01-07 00:06:41'),
(448, '448', '3458.256', '2022-01-07 00:10:33'),
(449, '449', '3458.256', '2022-01-07 00:11:26'),
(450, '450', '2800', '2022-01-07 00:15:37'),
(451, '451', '4400', '2022-01-07 00:17:57'),
(452, '452', '3458.256', '2022-01-07 01:24:29'),
(453, '453', '3458.256', '2022-01-07 01:26:04'),
(454, '454', '2800', '2022-01-07 01:27:30'),
(455, '455', '2800', '2022-01-07 01:28:49'),
(456, '456', '600', '2022-01-07 01:34:00'),
(457, '457', '600', '2022-01-07 01:35:02'),
(458, '458', '14592', '2022-01-07 13:33:50'),
(459, '459', '14880', '2022-01-07 13:35:47'),
(460, '460', '0', '2022-01-07 17:27:11'),
(461, '461', '0', '2022-01-07 17:31:08'),
(462, '462', '32.41352', '2022-01-08 09:55:37'),
(463, '463', '2.57096', '2022-01-08 11:57:02'),
(464, '464', '4.3715', '2022-01-08 12:13:34'),
(465, '465', '11.6671', '2022-01-08 12:15:29'),
(466, '466', '2.3654', '2022-01-08 12:16:49'),
(467, '467', '3.8805', '2022-01-08 12:18:04'),
(468, '468', '5.2774', '2022-01-08 12:19:29'),
(469, '469', '3.4731', '2022-01-08 12:20:48'),
(470, '470', '4.7729', '2022-01-08 12:22:41'),
(471, '471', '8.2761', '2022-01-08 12:23:50'),
(472, '472', '4.1966', '2022-01-08 12:26:47'),
(473, '473', '2.5956', '2022-01-08 12:28:25'),
(474, '474', '9.8424', '2022-01-08 12:29:22'),
(475, '475', '7.4165', '2022-01-08 12:32:50'),
(476, '476', '5.0708', '2022-01-08 12:34:05'),
(477, '477', '32.2048', '2022-01-08 12:39:18'),
(478, '478', '39.6832', '2022-01-08 12:41:10'),
(479, '479', '38.7240', '2022-01-08 12:42:44'),
(480, '480', '37.2461', '2022-01-08 12:43:52'),
(481, '481', '38.7171', '2022-01-08 12:45:06'),
(482, '482', '8920', '2022-01-10 10:36:50'),
(483, '483', '8.8145', '2022-01-10 16:07:31'),
(484, '484', '0', '2022-01-10 16:10:07'),
(485, '485', '7.2706', '2022-01-10 16:14:53'),
(486, '486', '4.4708', '2022-01-10 16:20:17'),
(487, '487', '5.9671', '2022-01-10 16:23:47'),
(488, '488', '1.6622', '2022-01-10 16:28:41'),
(489, '489', '1.7625', '2022-01-10 16:31:22'),
(490, '490', '2.9496', '2022-01-10 16:35:14'),
(491, '491', '6.0623', '2022-01-10 16:40:02'),
(492, '492', '3.3410', '2022-01-10 16:43:17'),
(493, '493', '120', '2022-01-11 12:07:41'),
(494, '494', '120', '2022-01-11 12:08:38'),
(495, '495', '120', '2022-01-11 12:09:24'),
(496, '496', '120', '2022-01-11 12:10:05'),
(497, '497', '150', '2022-01-11 12:11:12'),
(498, '498', '3750', '2022-01-12 00:09:55'),
(499, '499', '3000', '2022-01-12 00:11:03'),
(500, '500', '3000', '2022-01-12 00:11:47'),
(501, '501', '9850', '2022-01-12 00:13:23'),
(502, '502', '11300', '2022-01-12 00:15:19'),
(503, '503', '11750', '2022-01-12 00:17:18'),
(504, '504', '11750', '2022-01-12 00:17:53'),
(505, '505', '2681.5', '2022-01-12 00:27:19'),
(506, '506', '9438', '2022-01-12 00:28:32'),
(507, '507', '2574', '2022-01-12 00:29:54'),
(508, '508', '10764', '2022-01-12 11:20:46'),
(509, '509', '26910', '2022-01-12 11:21:51'),
(510, '510', '13365.30', '2022-01-12 11:44:09'),
(511, '511', '9328.80', '2022-01-12 11:46:04'),
(512, '512', '10943.40', '2022-01-12 11:47:10'),
(513, '513', '72477.60', '2022-01-12 11:48:24'),
(514, '514', '72477.60', '2022-01-12 11:49:14'),
(515, '515', '18837', '2022-01-12 11:50:04'),
(516, '516', '11776.048', '2022-01-12 11:52:52'),
(517, '517', '4.9252', '2022-01-12 15:54:25'),
(518, '518', '1800', '2022-01-12 15:57:41'),
(519, '519', '2070', '2022-01-12 16:00:04'),
(520, '520', '400', '2022-01-12 16:01:55'),
(521, '521', '0', '2022-01-12 16:26:06'),
(522, '522', '0', '2022-01-12 16:31:42'),
(523, '523', '0', '2022-01-12 16:33:11'),
(524, '524', '120', '2022-01-13 10:09:12'),
(525, '525', '120', '2022-01-13 12:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE `tbl_item_history` (
  `item_history_id` int(11) NOT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `part_cost` varchar(255) DEFAULT NULL,
  `selling_cost` varchar(255) DEFAULT NULL,
  `item_history_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_history`
--

INSERT INTO `tbl_item_history` (`item_history_id`, `item_id`, `quantity`, `part_cost`, `selling_cost`, `item_history_datetime`) VALUES
(1, '12', '41', '4', ' 5200', '2021-12-30 11:34:16'),
(2, '28', '16', '4480', '5600', '2021-12-30 11:39:16'),
(3, '122', '15', '4400', '5500.00 ', '2021-12-30 11:41:47'),
(4, '88', '8', '4880', '6100.00 ', '2021-12-30 11:42:58'),
(5, '84', '16', '3840', '4800.00 ', '2021-12-30 11:47:37'),
(6, '90', '17', '10160', '12700.00 ', '2021-12-30 12:08:21'),
(7, '134', '3', '6720', '8400.00 ', '2021-12-30 12:18:59'),
(8, '116', '8', '9200', '11500.00 ', '2021-12-30 12:29:06'),
(9, '222', '4', '31440', '39300', '2021-12-30 13:01:11'),
(10, '31', '2', '49760', '62200', '2021-12-30 13:22:46'),
(11, '29', '5', '9760', '12200', '2021-12-30 13:25:16'),
(12, '126', '200', '376', '470.00 ', '2021-12-30 13:30:10'),
(13, '153', '6', '8160', '10200.00 ', '2021-12-30 13:47:51'),
(14, '16', '6', '6.4', '8800', '2021-12-30 13:49:31'),
(15, '104', '2', '40080', '50100.00 ', '2021-12-30 13:51:05'),
(16, '128', '160', '176', '220.00 ', '2021-12-30 13:52:20'),
(17, '166', '2', '45080', '56350.00 ', '2021-12-30 14:00:37'),
(18, '93', '3', '12560', '15700', '2021-12-30 14:01:30'),
(19, '23', '7', '8160', '10200', '2021-12-30 15:07:57'),
(20, '160', '7', '8480', '10600.00 ', '2021-12-30 15:09:13'),
(21, '81', '6', '14800', '18500.00 ', '2021-12-30 15:10:59'),
(22, '24', '2', '27600', '34500', '2021-12-30 15:23:35'),
(23, '76', '2', '113600', '142000.00 ', '2021-12-30 15:24:45'),
(24, '26', '1', '44160', '55200', '2021-12-30 15:26:19'),
(25, '24', '1', '27600', '34500', '2021-12-30 15:48:33'),
(26, '25', '1', '44160', '55200', '2021-12-30 15:52:05'),
(27, '22', '1', '84800', '106000', '2021-12-30 15:52:49'),
(28, '173', '3', '49600', '62000.00 ', '2021-12-30 15:55:08'),
(29, '170', '3', '46560', '58200.00 ', '2021-12-30 15:56:08'),
(30, '85', '1', '276000', '345000.00 ', '2021-12-30 15:57:14'),
(31, '102', '3', '24400', '30500.00 ', '2021-12-30 15:57:54'),
(32, '75', '4', '30080', '37600.00 ', '2021-12-30 16:00:08'),
(33, '74', '4', '30080', '37600.00 ', '2021-12-30 16:00:45'),
(34, '13', '5', '25920', ' 32400', '2021-12-30 16:17:59'),
(35, '223', '6', '25920', '32400.00 ', '2021-12-30 16:20:20'),
(36, '57', '2', '26480', '33100.00 ', '2021-12-30 16:21:18'),
(37, '27', '1', '106400', '133000', '2021-12-30 16:48:00'),
(38, '27', '2', '106400', '133000', '2021-12-30 16:49:48'),
(39, '110', '6', '3120', '3900.00 ', '2021-12-30 16:53:07'),
(40, '61', '2', '17360', '21700.00 ', '2021-12-30 16:56:00'),
(41, '55', '2', '20720', '25900.00 ', '2021-12-30 16:58:49'),
(42, '15', '5', '12960', '16200', '2021-12-30 17:03:48'),
(43, '180', '5', '35840', '44800.00 ', '2021-12-30 17:04:50'),
(44, '53', '2', '24400', '30500.00 ', '2021-12-30 18:43:10'),
(45, '187', '1', '67200', '84000.00 ', '2021-12-30 18:44:42'),
(46, '125', '4', '24920', '31150.00 ', '2021-12-30 18:45:21'),
(47, '187', '3', '67200', '84000.00 ', '2021-12-30 18:48:51'),
(48, '224', '4', '67200', '84000', '2021-12-30 18:53:19'),
(49, '80', '6', '19440', '24300.00 ', '2021-12-30 18:54:41'),
(50, '133', '2', '11200', '14000.00 ', '2021-12-30 19:01:17'),
(51, '123', '2', '14240', '17800.00 ', '2021-12-30 19:31:50'),
(52, '98', '4', '27600', '34500.00 ', '2021-12-30 19:32:40'),
(53, '120', '6', '25920', '32400.00 ', '2021-12-30 19:37:17'),
(54, '145', '7', '24840', '31050', '2021-12-30 19:39:21'),
(55, '19', '7', '20240', '25300', '2021-12-30 19:40:48'),
(56, '167', '6', '19440', '24300.00 ', '2021-12-30 19:46:02'),
(57, '95', '2', '30400', '38000', '2021-12-31 09:13:52'),
(58, '94', '2', '30400', '38000', '2021-12-31 09:14:21'),
(59, '46', '2', '62320', '77900', '2021-12-31 09:23:52'),
(60, '47', '2', '62320', '77900', '2021-12-31 09:24:35'),
(61, '44', '2', '45440', '56800', '2021-12-31 09:25:48'),
(62, '43', '2', '45440', '56800', '2021-12-31 09:26:20'),
(63, '106', '6', '28640', '35800.00 ', '2021-12-31 09:32:38'),
(64, '17', '5', '4480', '5600', '2021-12-31 09:37:16'),
(65, '140', '3', '4240', '5300.00 ', '2021-12-31 09:37:48'),
(66, '103', '11', '36960', '46200.00 ', '2021-12-31 09:42:50'),
(67, '206', '2', '15840', '19800.00 ', '2021-12-31 09:56:27'),
(69, '131', '2', '28400', '35500.00 ', '2021-12-31 10:31:08'),
(70, '132', '2', '28400', '35500.00 ', '2021-12-31 10:31:18'),
(71, '112', '12', '12800', '16000.00 ', '2021-12-31 10:34:04'),
(72, '111', '3', '14800', '18500.00 ', '2021-12-31 10:37:26'),
(73, '30', '1', '12800', '16000', '2021-12-31 10:38:21'),
(74, '35', '1', '13120', '16400', '2021-12-31 10:38:45'),
(75, '89', '7', '11120', '13900.00 ', '2021-12-31 10:42:01'),
(76, '178', '6', '105600', '132000.00 ', '2021-12-31 10:43:44'),
(77, '56', '2', '26480', '33100.00 ', '2021-12-31 10:44:36'),
(78, '100', '2', '10800', '13500.00 ', '2021-12-31 11:04:13'),
(79, '105', '1', '39840', '49800.00 ', '2021-12-31 11:14:38'),
(80, '115', '1', '52360', '65450.00 ', '2021-12-31 11:15:51'),
(81, '100', '1', '10800', '13500.00 ', '2021-12-31 11:18:18'),
(82, '142', '2', '68000', '85000.00 ', '2021-12-31 11:48:13'),
(83, '135', '3', '64000', '80000.00 ', '2021-12-31 11:50:46'),
(84, '137', '3', '19840', '24800.00 ', '2021-12-31 11:53:47'),
(85, '138', '3', '21760', '27200.00 ', '2021-12-31 11:54:33'),
(86, '211', '1', '7600', '9500.00 ', '2021-12-31 12:24:27'),
(87, '217', '1', '5840', '7300.00 ', '2021-12-31 12:43:29'),
(88, '210', '2', '15520', '19400.00 ', '2021-12-31 13:02:21'),
(89, '129', '1', '41600', '52000.00 ', '2021-12-31 13:02:56'),
(90, '136', '4', '6000', '7500.00 ', '2021-12-31 13:10:10'),
(91, '45', '2', '2440', '3050', '2021-12-31 13:13:52'),
(92, '225', '1', '680', '850', '2021-12-31 13:39:08'),
(93, '226', '5', '680', '850', '2021-12-31 13:39:24'),
(94, '227', '5', '680', '850', '2021-12-31 13:39:42'),
(100, '232', '1', '0', '0', '2021-12-31 14:04:10'),
(101, '233', '30', '0', '0', '2021-12-31 14:07:56'),
(102, '234', '5', '0', '0', '2021-12-31 14:08:20'),
(103, '235', '3', '0', '0', '2021-12-31 14:08:39'),
(104, '236', '30', '0', '0', '2021-12-31 14:09:33'),
(105, '104', '1', '40080', '50100.00 ', '2021-12-31 16:01:40'),
(106, '174', '6', '29680', '37100.00 ', '2021-12-31 16:07:45'),
(107, '82', '2', '28480', '35600.00 ', '2021-12-31 16:08:13'),
(108, '139', '3', '2960', '3700.00 ', '2021-12-31 16:08:49'),
(109, '168', '4', '3440', '4300.00 ', '2021-12-31 16:09:26'),
(110, '141', '3', '2960', '3700.00 ', '2021-12-31 16:09:45'),
(111, '99', '2', '6080', '7600.00 ', '2021-12-31 16:09:59'),
(112, '20', '5', '4160', '5200', '2021-12-31 16:17:47'),
(113, '87', '3', '4560', '5700.00 ', '2021-12-31 16:19:15'),
(114, '119', '6', '6160', '7700.00 ', '2021-12-31 16:19:58'),
(115, '21', '5', '3520', '4400', '2021-12-31 16:20:42'),
(116, '54', '2', '4320', '5400.00 ', '2021-12-31 16:21:20'),
(117, '121', '1', '5280', '6600.00 ', '2021-12-31 16:22:08'),
(118, '121', '1', '5280', '6600.00 ', '2021-12-31 16:22:27'),
(119, '154', '5', '8400', '10500.00 ', '2021-12-31 16:23:08'),
(120, '155', '5', '6240', '7800.00 ', '2021-12-31 16:24:02'),
(121, '41', '5', '7840', '9800', '2021-12-31 16:24:34'),
(122, '159', '6', '1760', '2200.00 ', '2021-12-31 16:25:34'),
(123, '107', '12', '3760', '4700.00 ', '2021-12-31 16:27:51'),
(124, '79', '1', '42000', '52500.00 ', '2021-12-31 16:28:42'),
(125, '109', '4', '5200', '6500.00 ', '2021-12-31 16:29:29'),
(126, '161', '1', '8400', '10500.00 ', '2021-12-31 16:30:18'),
(127, '150', '5', '4400', '5500.00 ', '2021-12-31 16:31:07'),
(128, '169', '6', '26600', '33250.00 ', '2021-12-31 16:32:40'),
(129, '64', '10', '28240', '35300.00 ', '2021-12-31 16:34:21'),
(130, '32', '4', '5840', '7300', '2021-12-31 16:35:25'),
(131, '158', '8', '1840', '2300.00 ', '2021-12-31 16:36:00'),
(132, '118', '10', '3840', '4800.00 ', '2021-12-31 16:36:40'),
(133, '127', '200', '68', ' 85.00 ', '2021-12-31 16:38:23'),
(134, '157', '6', '640', '800.00 ', '2021-12-31 17:08:14'),
(135, '121', '2', '5280', '6600.00 ', '2021-12-31 17:14:25'),
(136, '150', '2', '4400', '5500.00 ', '2021-12-31 17:17:46'),
(137, '204', '2', '3600', '4500.00 ', '2021-12-31 17:19:17'),
(138, '218', '3', '3760', '4700.00 ', '2021-12-31 17:21:53'),
(139, '152', '20', '2208', '2760.00 ', '2021-12-31 17:24:35'),
(140, '157', '2', '640', '800.00 ', '2021-12-31 17:27:35'),
(141, '174', '1', '29680', '37100.00 ', '2021-12-31 17:28:39'),
(142, '99', '2', '6080', '7600.00 ', '2021-12-31 17:29:12'),
(143, '87', '2', '4560', '5700.00 ', '2021-12-31 17:30:30'),
(144, '118', '5', '3840', '4800.00 ', '2021-12-31 17:31:38'),
(145, '32', '2', '5840', '7300', '2021-12-31 17:32:35'),
(146, '155', '2', '6240', '7800.00 ', '2021-12-31 17:33:25'),
(147, '64', '2', '28240', '35300.00 ', '2021-12-31 17:35:29'),
(148, '169', '2', '26600', '33250.00 ', '2021-12-31 17:36:32'),
(149, '109', '2', '5200', '6500.00 ', '2021-12-31 17:37:29'),
(150, '81', '3', '14800', '18500.00 ', '2021-12-31 17:38:30'),
(151, '119', '4', '6160', '7700.00 ', '2021-12-31 17:40:48'),
(152, '168', '2', '3440', '4300.00 ', '2021-12-31 17:41:58'),
(153, '159', '2', '1760', '2200.00 ', '2021-12-31 17:42:59'),
(154, '193', '1', '6960', '8700.00 ', '2021-12-31 17:44:10'),
(155, '161', '2', '8400', '10500.00 ', '2021-12-31 17:46:18'),
(156, '208', '3', '6000', '7500.00 ', '2021-12-31 17:47:05'),
(157, '41', '2', '7840', '9800', '2021-12-31 17:49:55'),
(158, '154', '2', '8400', '10500.00 ', '2021-12-31 17:50:31'),
(159, '79', '1', '42000', '52500.00 ', '2021-12-31 17:57:45'),
(160, '196', '2', '6560', '8200.00 ', '2021-12-31 17:58:45'),
(161, '197', '2', '6560', '8200.00 ', '2021-12-31 17:59:39'),
(162, '198', '2', '6560', '8200.00 ', '2021-12-31 18:00:05'),
(163, '200', '2', '6560', '8200.00 ', '2021-12-31 18:01:29'),
(164, '194', '2', '6560', '8200.00 ', '2021-12-31 18:02:21'),
(165, '201', '2', '6560', '8200.00 ', '2021-12-31 18:06:15'),
(166, '199', '2', '6560', '8200.00 ', '2021-12-31 18:06:52'),
(167, '195', '2', '6560', '8200.00 ', '2021-12-31 18:07:43'),
(168, '205', '1', '22400', '28000.00 ', '2021-12-31 18:08:18'),
(169, '220', '5', '4160', '5200.00 ', '2021-12-31 18:09:24'),
(170, '209', '1', '19200', '24000.00 ', '2021-12-31 18:13:35'),
(171, '237', '8', '6160', '7700.00', '2022-01-03 08:15:15'),
(172, '42', '3', '36640', '45800', '2022-01-03 08:26:39'),
(173, '38', '1', '13440', '16800', '2022-01-03 08:28:17'),
(174, '220', '3', '4160', '5200.00 ', '2022-01-03 10:52:27'),
(176, '219', '10', '1040', '1300.00 ', '2022-01-03 10:56:29'),
(177, '6', '1', '11920', '14900', '2022-01-03 10:58:06'),
(178, '239', '209', '3760', '4700', '2022-01-03 11:57:48'),
(179, '240', '209', '4080', '5100', '2022-01-03 11:57:58'),
(180, '244', '1', '11480', '14350', '2022-01-03 13:10:00'),
(181, '242', '1', '3760', '4700', '2022-01-03 13:10:28'),
(182, '243', '1', '3400', '4250', '2022-01-03 13:11:09'),
(183, '245', '2', '4212', '5265', '2022-01-03 13:42:57'),
(185, '246', '2454', '5.2644', '6.5805', '2022-01-04 09:10:05'),
(186, '247', '522', '10.53016', '13.1627', '2022-01-04 09:11:38'),
(187, '248', '545', '5.65712', '7.0714', '2022-01-04 09:11:53'),
(188, '249', '542', '16.58448', '20.7306', '2022-01-04 09:12:16'),
(189, '250', '495', '6.3724', '7.9655', '2022-01-04 09:12:42'),
(190, '251', '511', '7.24312', '9.0539', '2022-01-04 09:13:01'),
(191, '252', '998', '6.26928', '7.8366', '2022-01-04 09:13:23'),
(192, '253', '1977', '5.78464', '7.2308', '2022-01-04 09:13:48'),
(193, '254', '1979', '4.64568', '5.8071', '2022-01-04 09:14:10'),
(194, '255', '994', '6.18152', '7.7269', '2022-01-04 09:14:25'),
(195, '256', '990', '7.12768', '8.9096', '2022-01-04 09:14:41'),
(196, '257', '999', '6.21992', '7.7749', '2022-01-04 09:15:07'),
(197, '258', '1997', '9.11424', '11.3928', '2022-01-04 09:15:25'),
(198, '259', '484', '5.57968', '6.9746', '2022-01-04 09:15:50'),
(199, '260', '983', '10.8736', '13.592.', '2022-01-04 09:16:15'),
(200, '261', '515', '6.28688', '7.8586', '2022-01-04 09:16:29'),
(201, '262', '503', '5.4684', '6.8355', '2022-01-04 09:17:36'),
(202, '263', '488', '8.43088', '10.5386', '2022-01-04 09:17:49'),
(203, '264', '490', '8.32224', '10.4028', '2022-01-04 09:18:13'),
(204, '265', '1028', '15.0372', '18.7965', '2022-01-04 09:18:32'),
(205, '266', '502', '6.79616', '8.4952', '2022-01-04 09:18:52'),
(206, '267', '1015', '7.32424', '9.1553', '2022-01-04 09:19:09'),
(207, '5', '12', '7120', '8900', '2022-01-04 10:05:00'),
(208, '268', '1037', '6.9416', '8.6770', '2022-01-04 10:08:34'),
(209, '269', '970', '6.58976', '8.2372', '2022-01-04 10:08:57'),
(210, '270', '480', '13.17264', '16.4658', '2022-01-04 10:09:17'),
(211, '271', '980', '9.84344', '12.3043', '2022-01-04 10:09:47'),
(212, '272', '511', '6.33976', '7.9247', '2022-01-04 10:10:00'),
(213, '273', '970', '9.12352', '11.4044', '2022-01-04 10:10:47'),
(214, '274', '496', '5.0856', '6.3570', '2022-01-04 10:11:27'),
(215, '275', '497', '9.96136', '12.4517', '2022-01-04 10:12:00'),
(216, '276', '498', '10.64376', '13.3047', '2022-01-04 10:13:05'),
(217, '277', '980', '5.61944', '7.0243', '2022-01-04 10:13:17'),
(218, '278', '985', '9.20384', '11.5048', '2022-01-04 10:13:33'),
(219, '279', '1002', '10.11408', '12.6426', '2022-01-04 10:13:50'),
(220, '280', '1009', '8.4064', '10.5080', '2022-01-04 10:14:08'),
(221, '281', '506', '7.10768', '8.8846', '2022-01-04 10:14:30'),
(222, '282', '515', '6.78648', '8.4831', '2022-01-04 10:14:59'),
(223, '283', '1030', '6.16912', '7.7114', '2022-01-04 10:15:15'),
(224, '284', '1034', '9.9756', '12.4695', '2022-01-04 10:15:42'),
(225, '285', '516', '7.18784', '8.9848', '2022-01-04 10:15:58'),
(226, '286', '1001', '6.78944', '8.4868', '2022-01-04 10:16:15'),
(227, '287', '515', '7.42496', '9.2812', '2022-01-04 10:16:39'),
(228, '288', '502', '10.186', '12.7325', '2022-01-04 10:16:59'),
(229, '289', '1025', '11.8852', '14.8565', '2022-01-04 10:17:25'),
(230, '290', '532', '6.89288', '8.6161', '2022-01-04 10:17:45'),
(231, '291', '505', '8.7112', '10.8890', '2022-01-04 10:18:09'),
(232, '292', '1038', '10.70968', '13.3871', '2022-01-04 10:18:33'),
(233, '293', '487', '7.79672', '9.7459', '2022-01-04 10:18:50'),
(234, '294', '509', '7.50664', '9.3833', '2022-01-04 10:19:04'),
(235, '295', '502', '7.04016', '8.8002', '2022-01-04 10:19:23'),
(236, '296', '2026', '9.75304', '12.1913', '2022-01-04 10:19:42'),
(237, '297', '2035', '6.87424', '8.5928', '2022-01-04 10:20:05'),
(238, '298', '995', '8.06424', '10.0803', '2022-01-04 10:20:25'),
(239, '299', '1997', '8.65144', '10.8143', '2022-01-04 10:20:45'),
(240, '300', '2028', '7.71088', '9.6386', '2022-01-04 10:21:11'),
(241, '301', '1003', '6.4', '8,7078', '2022-01-04 10:21:27'),
(242, '302', '1003', '8.64304', '10.8038', '2022-01-04 10:21:48'),
(243, '303', '491', '10.304', '12.8800', '2022-01-04 10:22:08'),
(244, '304', '981', '5.77224', '7.2153', '2022-01-04 10:22:29'),
(245, '305', '1054', '6.72136', '8.4017', '2022-01-04 10:22:55'),
(246, '306', '986', '7.52104', '9.4013', '2022-01-04 10:23:34'),
(247, '307', '536', '29.9216', '37.4020', '2022-01-04 10:23:56'),
(248, '308', '553', '29.5168', '36.8960', '2022-01-04 10:24:19'),
(249, '309', '516', '30.34672', '37.9334', '2022-01-04 10:24:52'),
(250, '310', '551', '29.73936', '37.1742', '2022-01-04 10:25:15'),
(251, '311', '519', '15.44192', '19.3024', '2022-01-04 10:25:54'),
(252, '312', '507', '15.6436', '19.5545', '2022-01-04 10:26:21'),
(253, '313', '511', '15.542', '19.4275', '2022-01-04 10:26:38'),
(254, '315', '503', '13.04224', '16.3028', '2022-01-04 10:27:14'),
(255, '316', '565', '12.57624', '15.7203', '2022-01-04 10:27:36'),
(257, '318', '486', '9.17696', '11.4712', '2022-01-04 10:29:22'),
(258, '319', '497', '16.82144', '21.0268', '2022-01-04 10:29:44'),
(259, '320', '491', '12.6344', '15.7930', '2022-01-04 10:30:16'),
(260, '317', '504', '11.15096', '13.9387', '2022-01-04 10:35:45'),
(261, '314', '488', '12.9696', '16.2120', '2022-01-04 10:36:57'),
(262, '327', '20', '118.12496', '147.6562', '2022-01-04 15:06:35'),
(263, '328', '20', '105', '131.25', '2022-01-04 15:06:59'),
(264, '329', '20', '113.75', '142.1875', '2022-01-04 15:07:15'),
(265, '330', '20', '92.75', '115.9375', '2022-01-04 15:07:26'),
(266, '331', '20', '92.75', '115.9375', '2022-01-04 15:07:40'),
(267, '332', '20', '104.12496', '130.1562', '2022-01-04 15:07:48'),
(268, '333', '20', '128.62496', '160.7812', '2022-01-04 15:08:01'),
(269, '334', '20', '133', '166.25', '2022-01-04 15:08:13'),
(270, '335', '20', '187.25', '234.0625', '2022-01-04 15:08:29'),
(271, '336', '20', '140', '175', '2022-01-04 15:08:43'),
(272, '337', '5', '278.25', '347.8125', '2022-01-04 15:09:10'),
(273, '338', '5', '306.25', '382.8125', '2022-01-04 15:09:34'),
(274, '342', '5', '306.25', '382.8125', '2022-01-04 15:13:51'),
(275, '324', '1', '10283', '12853.75', '2022-01-04 15:14:24'),
(276, '340', '12', '462', '577.5', '2022-01-04 15:14:38'),
(277, '341', '12', '163.62496', '204.5312', '2022-01-04 15:14:55'),
(278, '323', '5', '356.4', '445.5', '2022-01-04 15:15:37'),
(279, '325', '40', '243', '303.75', '2022-01-04 15:16:30'),
(280, '326', '4059', '5.79008', '7.2376', '2022-01-04 15:22:54'),
(282, '343', '1', '1113', '1391.25', '2022-01-04 16:28:38'),
(283, '344', '1', '3762', '4702.5', '2022-01-04 16:29:01'),
(284, '345', '1', '5243.88', '6554.85', '2022-01-04 16:29:13'),
(285, '346', '1', '3579.63', '4474.5375', '2022-01-04 16:29:35'),
(286, '347', '1', '2666.13', '3332.6625', '2022-01-04 16:29:52'),
(287, '349', '1', '26240', '32800', '2022-01-04 16:35:15'),
(288, '350', '104', '116.88744', '146.1093', '2022-01-04 17:04:10'),
(289, '351', '104', '156.62592', '195.7824', '2022-01-04 17:06:23'),
(290, '352', '104', '144.93456', '181.1682', '2022-01-04 17:06:35'),
(291, '353', '174', '52.55688', '65.6961', '2022-01-04 17:06:50'),
(292, '354', '174', '47.04304', '58.8038', '2022-01-04 17:07:04'),
(293, '355', '174', '51.56376', '64.4547', '2022-01-04 17:07:19'),
(294, '356', '174', '56.75688', '70.9461', '2022-01-04 17:07:34'),
(295, '357', '174', '50.79304', '63.4913', '2022-01-04 17:07:44'),
(296, '358', '116', '128.48272', '160.6034', '2022-01-04 17:07:55'),
(297, '359', '1', '8746.2', '10932.75', '2022-01-04 17:42:52'),
(298, '360', '1', '19839.6', '24799.5', '2022-01-04 17:43:06'),
(299, '361', '1', '7945.2', '9931.5', '2022-01-04 17:43:16'),
(300, '362', '946', '3.4344', '4.2930', '2022-01-04 17:43:47'),
(301, '363', '20', '244.12496', '305.1562', '2022-01-04 17:44:09'),
(302, '364', '33', '129.4948', '161.8685', '2022-01-04 17:44:33'),
(303, '365', '250', '13.468', '16.835', '2022-01-04 17:44:46'),
(304, '366', '946', '6.93696', '8.6712', '2022-01-04 17:45:00'),
(307, '348', '4900', '2.3016', '2.8770', '2022-01-05 09:56:06'),
(308, '368', '400', '34.38528', '42.9816', '2022-01-05 10:31:54'),
(309, '369', '921', '4.76472', '5.9559', '2022-01-05 12:08:34'),
(310, '370', '1', '1144.70096', '1430.8762', '2022-01-05 12:20:18'),
(312, '372', '350', '35.84128', '44.8016', '2022-01-05 12:26:59'),
(313, '322', '2', '35200', '44000', '2022-01-05 12:54:34'),
(314, '373', '10000', '1.6388', '2.0485', '2022-01-05 14:45:09'),
(315, '374', '50', '29.632', '37.04', '2022-01-05 14:50:32'),
(316, '375', '30', '56.296', '70.37', '2022-01-05 14:51:44'),
(317, '376', '30', '40.744', '50.93', '2022-01-05 14:51:56'),
(318, '377', '5', '1281', '1601.25', '2022-01-05 14:57:33'),
(325, '378', '9000', '2.70008', '3.3751', '2022-01-05 17:20:13'),
(326, '371', '13800', '0.75176', '0.9397', '2022-01-05 17:23:15'),
(327, '379', '10', '8', '10', '2022-01-05 22:33:29'),
(328, '228', '946', '6.25152', '7.8144', '2022-01-06 09:59:40'),
(342, '412', '2', '850', '1062.5', '2022-01-06 14:10:24'),
(343, '413', '1', '900', '1125', '2022-01-06 14:12:58'),
(344, '414', '1', '900', '1125', '2022-01-06 14:14:02'),
(347, '10', '1', '11520', '14400', '2022-01-06 14:32:21'),
(348, '229', '4', '700', '875', '2022-01-06 15:17:40'),
(349, '230', '6', '700', '875', '2022-01-06 15:18:41'),
(350, '231', '6', '700', '875', '2022-01-06 15:18:50'),
(352, '8', '1', '4348', '5435', '2022-01-06 17:57:14'),
(354, '5', '8', '7120', '8900', '2022-01-06 18:10:05'),
(355, '428', '2', '156976', '196220', '2022-01-06 18:13:01'),
(356, '429', '1', '6844', '8555', '2022-01-06 18:14:54'),
(357, '440', '3', '4640', '5800', '2022-01-06 23:46:02'),
(358, '441', '3', '4640', '5800', '2022-01-06 23:46:59'),
(359, '442', '4', '113880', '142350', '2022-01-06 23:49:19'),
(360, '443', '12', '600', '750', '2022-01-06 23:54:12'),
(361, '444', '4', '600', '750', '2022-01-06 23:56:03'),
(362, '423', '6', '400', '500', '2022-01-06 23:57:58'),
(363, '445', '2', '600', '750', '2022-01-06 23:59:06'),
(364, '421', '4', '1200', '1500', '2022-01-07 00:01:33'),
(365, '446', '12', '2800', '3500', '2022-01-07 00:03:16'),
(366, '417', '2', '2800', '3500', '2022-01-07 00:05:28'),
(367, '447', '6', '2800', '3500', '2022-01-07 00:07:00'),
(371, '451', '1', '4400', '5500', '2022-01-07 00:18:04'),
(372, '436', '5', '1440', '1800', '2022-01-07 00:20:33'),
(373, '439', '4', '1280', '1600', '2022-01-07 00:21:19'),
(374, '430', '2', '9240', '11550', '2022-01-07 00:23:42'),
(375, '432', '1', '7120', '8900', '2022-01-07 00:25:23'),
(376, '433', '1', '7120', '8900', '2022-01-07 00:25:43'),
(377, '434', '3', '6800', '8500', '2022-01-07 00:26:56'),
(378, '448', '2', '3458.256', '4322.82', '2022-01-07 00:34:53'),
(379, '449', '2', '3458.256', '4322.82', '2022-01-07 00:35:03'),
(380, '418', '4', '3458.256', '4322.82', '2022-01-07 00:39:54'),
(381, '435', '3', '3920', '4900', '2022-01-07 00:40:59'),
(382, '437', '5', '2240', '2800', '2022-01-07 00:42:11'),
(383, '438', '7', '2240', '2800', '2022-01-07 00:47:18'),
(384, '437', '1', '2240', '2800', '2022-01-07 00:49:37'),
(385, '431', '2', '10000', '12500', '2022-01-07 00:53:46'),
(386, '221', '1', '30800', '38500.00 ', '2022-01-07 00:56:36'),
(387, '452', '2', '3458.256', '4322.82', '2022-01-07 01:24:48'),
(388, '453', '3', '3458.256', '4322.82', '2022-01-07 01:26:26'),
(391, '454', '6', '2800', '3500', '2022-01-07 01:32:20'),
(392, '455', '9', '2800', '3500', '2022-01-07 01:32:31'),
(393, '456', '5', '600', '750', '2022-01-07 01:36:37'),
(394, '457', '10', '600', '750', '2022-01-07 01:36:53'),
(396, '188', '1', '34400', '43000.00 ', '2022-01-07 09:37:31'),
(397, '2', '16', '4760', '5950', '2022-01-07 09:45:54'),
(398, '240', '4', '4080', '5100', '2022-01-07 09:53:01'),
(399, '190', '1', '14400', '18000.00 ', '2022-01-07 09:54:20'),
(400, '191', '1', '11200', '14000.00 ', '2022-01-07 09:54:31'),
(401, '192', '1', '25600', '32000.00 ', '2022-01-07 09:54:43'),
(402, '202', '2', '20320', '25400.00 ', '2022-01-07 09:54:58'),
(403, '203', '2', '16160', '20200.00 ', '2022-01-07 09:55:11'),
(404, '113', '1', '46400', '58000.00 ', '2022-01-07 09:56:00'),
(405, '218', '1', '3760', '4700.00 ', '2022-01-07 10:12:07'),
(406, '458', '1', '14592', '18240', '2022-01-07 13:34:35'),
(407, '459', '1', '14592', '18240', '2022-01-07 13:36:10'),
(408, '462', '245', '32.41352', '40.5169', '2022-01-08 10:03:29'),
(409, '463', '5031', '2.57096', '3.2137', '2022-01-08 11:58:27'),
(410, '464', '989', '4.37152', '5.4644', '2022-01-08 12:14:12'),
(411, '465', '302', '11.66712', '14.5839', '2022-01-08 12:15:53'),
(412, '466', '3829', '2.36544', '2.9568', '2022-01-08 12:17:11'),
(413, '467', '4841', '3.88048', '4.8506', '2022-01-08 12:18:31'),
(414, '468', '994', '5.27744', '6.5968', '2022-01-08 12:19:45'),
(415, '469', '4753', '3.47312', '4.3414', '2022-01-08 12:21:41'),
(416, '470', '1325', '4.77288', '5.9661', '2022-01-08 12:23:03'),
(417, '471', '836', '8.27608', '10.3451', '2022-01-08 12:24:06'),
(418, '472', '1413', '4.20464', '5.2558', '2022-01-08 12:27:09'),
(419, '473', '4895', '2.59568', '3.2446', '2022-01-08 12:28:40'),
(420, '474', '524', '9.8424', '12.3030', '2022-01-08 12:30:38'),
(421, '475', '2015', '7.41648', '9.2706', '2022-01-08 12:33:02'),
(422, '476', '811', '5.0708', '6.3385', '2022-01-08 12:34:23'),
(423, '477', '246', '32.2048', '40.2560', '2022-01-08 12:39:56'),
(424, '478', '244', '39.6832', '49.6040', '2022-01-08 12:41:30'),
(425, '479', '240', '38.724', '48.4050', '2022-01-08 12:42:56'),
(426, '480', '248', '37.24616', '46.5577', '2022-01-08 12:44:07'),
(427, '481', '247', '38.71704', '48.3963', '2022-01-08 12:45:29'),
(428, '458', '1', '14592', '18240', '2022-01-08 12:52:48'),
(429, '482', '3', '8920', '11150', '2022-01-10 10:40:51'),
(430, '458', '1', '14592', '18240', '2022-01-10 10:43:27'),
(431, '483', '400', '8.81448', '11.0181', '2022-01-10 16:08:05'),
(432, '484', '400', '8.81448', '11.0181', '2022-01-10 16:10:21'),
(433, '485', '1000', '7.27064', '9.0883', '2022-01-10 16:17:46'),
(434, '486', '4500', '4.4708', '5.5885', '2022-01-10 16:20:35'),
(435, '487', '950', '5.96712', '7.4589', '2022-01-10 16:24:12'),
(436, '488', '13500', '1.66216', '2.0777', '2022-01-10 16:28:59'),
(437, '489', '870', '1.76248', '2.2031', '2022-01-10 16:33:23'),
(439, '490', '10000', '2.29496', '2.8687', '2022-01-10 16:38:00'),
(440, '491', '1000', '6.06232', '7.5779', '2022-01-10 16:40:22'),
(441, '492', '720', '3.34096', '4.1762', '2022-01-10 16:43:40'),
(442, '493', '10', '120', '150', '2022-01-11 12:08:08'),
(443, '494', '10', '120', '150', '2022-01-11 12:08:57'),
(444, '495', '10', '120', '150', '2022-01-11 12:09:36'),
(445, '496', '10', '120', '150', '2022-01-11 12:10:28'),
(446, '497', '10', '150', '187.5', '2022-01-11 12:11:26'),
(447, '63', '4', '18560', '23200.00 ', '2022-01-11 13:38:54'),
(448, '187', '1', '67200', '84000.00 ', '2022-01-11 14:09:14'),
(450, '126', '10', '376', '470.00 ', '2022-01-11 15:47:54'),
(451, '128', '40', '176', '220.00 ', '2022-01-11 15:49:28'),
(452, '101', '1', '62520', '78150.00 ', '2022-01-11 16:57:08'),
(453, '207', '2', '15840', '19800.00 ', '2022-01-11 21:30:39'),
(454, '91', '3', '28240', '35300', '2022-01-11 22:01:03'),
(455, '117', '22', '2400', '3000', '2022-01-12 09:40:38'),
(456, '101', '2', '62520', '78150', '2022-01-12 11:41:18'),
(457, '183', '4', '30880', '38600', '2022-01-12 15:29:32'),
(458, '517', '946', '4.9252', '6.1565', '2022-01-12 15:54:40'),
(459, '518', '1', '1800', '2250', '2022-01-12 15:59:20'),
(460, '519', '1', '2070', '2587.5', '2022-01-12 16:00:24'),
(461, '520', '1', '320', '400', '2022-01-12 16:02:15'),
(462, '521', '1', '2800', '3500', '2022-01-12 16:26:46'),
(463, '522', '1', '600', '750', '2022-01-12 16:32:00'),
(464, '523', '1', '600', '750', '2022-01-12 16:33:26'),
(465, '52', '1', '600', '750.00 ', '2022-01-13 09:30:33'),
(466, '524', '5', '120', '150', '2022-01-13 10:09:30'),
(467, '524', '5', '120', '150', '2022-01-13 11:55:54'),
(468, '525', '5', '200', '250', '2022-01-13 12:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_details`
--

CREATE TABLE `tbl_job_details` (
  `job_id` int(11) NOT NULL,
  `reg_email` varchar(255) DEFAULT NULL,
  `reg_date` varchar(255) DEFAULT NULL,
  `reg_customer` varchar(255) DEFAULT NULL,
  `reg_phone_no` varchar(255) DEFAULT NULL,
  `f_reg_date` varchar(255) DEFAULT NULL,
  `reg_model` varchar(255) DEFAULT NULL,
  `reg_chassis_no` varchar(255) DEFAULT NULL,
  `reg_licens_no` varchar(255) DEFAULT NULL,
  `reg_mileage` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `comments` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `job_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_details`
--

INSERT INTO `tbl_job_details` (`job_id`, `reg_email`, `reg_date`, `reg_customer`, `reg_phone_no`, `f_reg_date`, `reg_model`, `reg_chassis_no`, `reg_licens_no`, `reg_mileage`, `user_name`, `comments`, `stat`, `job_datetime`) VALUES
(35, 'oshan.amazoft@gmail.com', '2022-01-11', 'Oshan', '0774270018', '2021-11-09 17:19:57', 'March K12', '151514515f15', 'KJ-1086', '1000', 'Admin', '', '1', '2022-01-11 20:14:53'),
(36, 'shahilan.rajaratnam@gmail.com', '2022-01-12', 'Mr. Shahilan Rajaratnam', '0777238539', '2022-01-12 09:09:45', '740Li F02', 'WBAKB42060CY83881', 'SG KR-2312', '67859', 'Prashan Yahathugoda', 'Check engine over heat', '2', '2022-01-13 06:05:52'),
(37, 'sl.cm@fpt-asia.com', '2022-01-12', 'Mr. Samitha Gunasekara', '0778804125', '2022-01-12 13:15:57', 'X1 20D E84', 'WBAVN92050VX48798', 'WP KX-8218', '200587', 'Prashan Yahathugoda', 'Check AC not cooling enough ', '2', '2022-01-12 08:38:51'),
(38, 'iroshana@jiptech.com', '2022-01-12', 'Mr. Iroshana Mayadunna', '0777770766', '2022-01-10 09:44:33', '520D', 'WBAFW12040C847997', 'WP KV-5005', '89283 ', 'Prashan Yahathugoda', 'Alloy wheel paint', '2', '2022-01-12 11:14:38'),
(39, '', '2022-01-12', 'Mr. Nuwan Mawella', '0773443420', '2022-01-12 14:40:11', 'X5 40e F15', 'WBAKT020700EPP201', 'WP CAR9777', '64428', 'Prashan Yahathugoda', 'Check multiple faults indicating.\r\n\r\nCheck suspension noises', '2', '2022-01-12 09:57:28'),
(40, 'sl.cm@fpt-asia.com', '2022-01-12', 'Mr. Samitha Gunasekara', '0778804125', '2022-01-12 13:15:57', 'X1 20D E84', 'WBAVN92050VX48798', 'WP KX-8218', '200587', 'Prashan Yahathugoda', 'Check headlights discolored', '2', '2022-01-12 11:18:00'),
(41, 'lasanga.abeysuriya@pwc.com', '2022-01-13', 'Mr. L. Abeysuriya', '0773508080', '2022-01-13 10:14:46', '520D', 'WBA5C32040D600411', 'WP CAC 0648', '39185', 'Viraj Gunathilake', 'Check cigarette lighter not working, install dash camera, estimate paintwork and estimate rear boot ', '1', '2022-01-13 04:58:54'),
(42, '', '2022-01-13', 'Miseru Enterprises (Pvt) Ltd', '0712959460 - Chanaka', '2022-01-13 10:09:49', '740Li F02 ', 'WBAKB42010CY83870', 'WP KR-8408', '55568', 'Prashan Yahathugoda', 'Check multiple faults related DSC ndicating on the system', '1', '2022-01-13 05:05:52'),
(43, 'gihanbsclass@gmail.com', '2022-01-13', 'Mr. Gihan Sameera', '0719583218', '2022-01-13 10:54:04', '318i F30', 'WBA8E36040NU33186', 'WP CBE8866', '39821', 'Prashan Yahathugoda', 'Oil Service \r\nCheck coolant', '1', '2022-01-13 05:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_item`
--

CREATE TABLE `tbl_job_item` (
  `job_item_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `part_discount` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_item`
--

INSERT INTO `tbl_job_item` (`job_item_id`, `job_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `part_discount`, `stat`, `datetime`) VALUES
(1, '1', '11', '1', '222', '1', 'G', '0', '0', '2021-12-30 07:32:42'),
(2, '6', '11', '7', '211', '1', 'F', '10', '0', '2022-01-03 07:53:59'),
(3, '11', '11', '10', '242', '1', 'FS', '0', '0', '2022-01-03 08:15:37'),
(4, '11', '11', '10', '239', '5.20', 'FS', '0', '0', '2022-01-03 08:19:08'),
(6, '7', '11', '16', '135', '1', 'VD', '0', '0', '2022-01-03 10:19:21'),
(7, '14', '11', '19', '240', '4.25', 'FS', '0', '0', '2022-01-03 11:24:51'),
(8, '14', '11', '19', '12', '1', 'FS', '0', '0', '2022-01-03 11:24:51'),
(9, '12', '11', '11', '98', '1', 'FB', '0', '0', '2022-01-04 06:18:07'),
(10, '17', '11', '22', '349', '1', 'B', '0', '0', '2022-01-04 11:27:29'),
(11, '13', '11', '14', '5', '0.3', 'TF', '0', '0', '2022-01-05 05:04:13'),
(12, '9', '11', '23', '296', '125.1', 'PW', '0', '0', '2022-01-05 06:06:49'),
(13, '9', '11', '23', '254', '78.3', 'P', '0', '0', '2022-01-05 06:06:49'),
(14, '9', '11', '23', '286', '26.1', 'P', '0', '0', '2022-01-05 06:06:49'),
(15, '9', '11', '23', '274', '25.4', 'P', '0', '0', '2022-01-05 06:12:33'),
(16, '9', '11', '23', '277', '18.9', 'P', '0', '0', '2022-01-05 06:13:13'),
(17, '9', '11', '23', '256', '21', 'P', '0', '0', '2022-01-05 06:14:03'),
(18, '9', '11', '23', '305', '1.4', 'P', '0', '0', '2022-01-05 06:14:51'),
(19, '9', '11', '23', '247', '6.3', 'P', '0', '0', '2022-01-05 06:06:49'),
(20, '9', '11', '23', '253', '25.8', 'P', '0', '0', '2022-01-05 06:06:49'),
(21, '9', '11', '23', '283', '8.2', 'P', '0', '0', '2022-01-05 06:06:49'),
(22, '9', '11', '23', '282', '4.9', 'P', '0', '0', '2022-01-05 06:06:49'),
(23, '9', '11', '23', '248', '0.4', 'P', '0', '0', '2022-01-05 06:06:49'),
(24, '9', '11', '23', '340', '0.5', 'PW', '0', '0', '2022-01-05 06:21:29'),
(25, '9', '11', '23', '368', '12', 'PW', '0', '0', '2022-01-05 06:21:29'),
(26, '9', '11', '23', '327', '1', 'PW', '0', '0', '2022-01-05 06:21:29'),
(27, '9', '11', '23', '329', '1', 'PW', '0', '0', '2022-01-05 06:21:29'),
(28, '9', '11', '23', '331', '1', 'PW', '0', '0', '2022-01-05 06:21:29'),
(29, '9', '11', '23', '369', '175', 'PW', '0', '0', '2022-01-05 06:43:57'),
(31, '14', '11', '21', '322', '2', 'TC', '0', '0', '2022-01-05 07:54:28'),
(36, '9', '11', '23', '228', '120', 'P', '0', '0', '2022-01-06 06:56:05'),
(37, '9', '11', '23', '362', '75', 'P', '0', '0', '2022-01-06 04:50:00'),
(38, '9', '11', '23', '366', '76', 'P', '0', '0', '2022-01-06 06:55:23'),
(39, '21', '11', '39', '240', '4.75', 'S', '0', '0', '2022-01-06 05:29:04'),
(40, '21', '11', '39', '84', '1', 'O', '0', '0', '2022-01-06 09:45:17'),
(42, '23', '11', '48', '458', '1', 'F', '0', '0', '2022-01-07 08:45:48'),
(43, '23', '11', '49', '459', '1', 'R', '0', '0', '2022-01-07 08:46:12'),
(44, '24', '11', '50', '239', '1', 'L', '0', '0', '2022-01-07 09:10:38'),
(45, '25', '11', '51', '229', '0.2', 'c', '0', '0', '2022-01-07 11:36:37'),
(46, '25', '11', '51', '234', '1', '', '0', '0', '2022-01-07 11:36:37'),
(47, '19', '9', '37', '379', '1', '', '0', '0', '2022-01-08 09:54:34'),
(49, '28', '11', '52', '240', '5.25', 'OS', '10', '0', '2022-01-10 08:09:34'),
(50, '28', '11', '52', '12', '1', 'OF', '10', '0', '2022-01-10 08:09:43'),
(51, '28', '11', '52', '116', '1', 'AF', '10', '0', '2022-01-10 08:09:50'),
(52, '31', '11', '64', '482', '1', 'FG', '15', '0', '2022-01-12 04:24:42'),
(53, '32', '11', '65', '152', '2', 'EC', '0', '0', '2022-01-11 06:06:48'),
(54, '32', '11', '66', '89', '1', 'SC', '0', '0', '2022-01-11 06:09:02'),
(63, '38', '11', '69', '296', '300', 'PW', '0', '0', '2022-01-12 09:31:53'),
(64, '38', '11', '69', '486', '300', 'PW', '0', '0', '2022-01-12 09:31:53'),
(65, '38', '11', '69', '369', '250', 'PW', '0', '0', '2022-01-12 09:31:53'),
(66, '38', '11', '69', '488', '150', 'PW', '0', '0', '2022-01-12 09:31:53'),
(67, '38', '11', '69', '494', '1', 'PW', '0', '0', '2022-01-12 09:31:53'),
(69, '38', '11', '69', '469', '300', 'PW', '0', '0', '2022-01-12 09:31:53'),
(70, '38', '11', '69', '327', '2', 'PW', '0', '0', '2022-01-12 09:31:53'),
(71, '38', '11', '69', '329', '3', 'PW', '0', '0', '2022-01-12 09:31:53'),
(72, '39', '11', '70', '136', '1', '1', '0', '0', '2022-01-12 09:49:44'),
(74, '27', '11', '73', '451', '1', '1', '10', '0', '2022-01-12 11:06:14'),
(75, '27', '11', '72', '482', '1', '1', '10', '0', '2022-01-12 11:06:06'),
(76, '30', '11', '61', '254', '106.2', '0', '0', '0', '2022-01-12 10:08:25'),
(77, '30', '11', '61', '298', '44.4', '0', '0', '0', '2022-01-12 10:08:25'),
(78, '30', '11', '61', '252', '20.4', '0', '0', '0', '2022-01-12 10:08:25'),
(79, '30', '11', '61', '278', '8.4', '0', '0', '0', '2022-01-12 10:08:25'),
(80, '30', '11', '61', '249', '6.0', '0', '0', '0', '2022-01-12 10:08:25'),
(81, '30', '11', '61', '305', '1.8', '0', '0', '0', '2022-01-12 10:08:25'),
(82, '30', '11', '61', '271', '1.2', '0', '0', '0', '2022-01-12 10:08:25'),
(83, '30', '11', '61', '463', '40', '0', '0', '0', '2022-01-12 10:08:25'),
(84, '30', '11', '62', '366', '75', '0', '0', '0', '2022-01-12 10:09:41'),
(85, '30', '11', '62', '362', '100', '0', '0', '0', '2022-01-12 10:09:41'),
(86, '30', '11', '62', '378', '100', '0', '0', '0', '2022-01-12 10:13:53'),
(87, '30', '11', '62', '327', '1', '0', '0', '0', '2022-01-12 10:13:53'),
(88, '30', '11', '62', '329', '1', '0', '0', '0', '2022-01-12 10:13:53'),
(89, '30', '11', '62', '336', '1', '0', '0', '0', '2022-01-12 10:13:53'),
(90, '30', '11', '62', '335', '1', '0', '0', '0', '2022-01-12 10:13:53'),
(91, '30', '11', '62', '486', '200', '0', '0', '0', '2022-01-12 10:13:53'),
(92, '30', '11', '62', '369', '120', '0', '0', '0', '2022-01-12 10:13:53'),
(93, '30', '11', '62', '469', '50', '0', '0', '0', '2022-01-12 10:13:53'),
(94, '30', '11', '62', '488', '100', '0', '0', '0', '2022-01-12 10:13:53'),
(95, '30', '11', '62', '517', '52', '0', '0', '0', '2022-01-12 11:18:16'),
(96, '30', '11', '59', '340', '1', '0', '0', '0', '2022-01-12 10:34:14'),
(97, '18', '11', '43', '412', '1', '0', '0', '0', '2022-01-12 10:40:18'),
(98, '18', '11', '43', '227', '5', '0', '0', '0', '2022-01-12 10:40:18'),
(99, '18', '11', '43', '234', '1', '0', '0', '0', '2022-01-12 10:40:18'),
(100, '18', '11', '43', '236', '10', '0', '0', '0', '2022-01-13 05:37:31'),
(101, '27', '11', '57', '453', '1', '0', '10', '0', '2022-01-12 11:07:08'),
(102, '27', '11', '55', '454', '1', '0', '10', '0', '2022-01-12 11:05:35'),
(103, '27', '11', '55', '455', '1', '0', '10', '0', '2022-01-12 11:05:43'),
(104, '27', '11', '55', '457', '1', '0', '10', '0', '2022-01-12 11:05:51'),
(105, '27', '13', '57', '521', '1', '', '10', '0', '2022-01-12 11:07:15'),
(106, '27', '13', '55', '522', '1', '', '10', '0', '2022-01-12 11:05:59'),
(107, '27', '13', '57', '523', '1', '', '10', '0', '2022-01-12 11:07:23'),
(108, '30', '11', '62', '496', '1', '', '0', '0', '2022-01-12 11:37:36'),
(111, '18', '11', '43', '520', '1', '', '0', '0', '2022-01-13 05:37:25'),
(112, '36', '11', '80', '229', '2', '', '0', '0', '2022-01-13 05:50:38'),
(113, '36', '11', '80', '524', '5', '', '0', '0', '2022-01-13 05:51:04'),
(114, '41', '11', '79', '449', '1', '', '0', '0', '2022-01-13 05:56:20'),
(115, '43', '11', '81', '12', '1', '', '0', '0', '2022-01-13 06:12:34'),
(116, '43', '11', '81', '240', '4.25', '', '0', '0', '2022-01-13 06:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_labour`
--

CREATE TABLE `tbl_job_labour` (
  `job_labour_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `job_fru` varchar(255) DEFAULT NULL,
  `labour_discount` varchar(255) DEFAULT NULL,
  `labour_name_1` mediumtext,
  `labour_name_2` mediumtext,
  `labour_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_labour`
--

INSERT INTO `tbl_job_labour` (`job_labour_id`, `job_id`, `labour_id`, `job_fru`, `labour_discount`, `labour_name_1`, `labour_name_2`, `labour_datetime`) VALUES
(1, '1', '1', '5', '0', 'Replace power steering battery', '', '2021-12-30 20:00:50'),
(4, '6', '1', '5', '0', 'check suspension noise', '', '2022-01-03 18:16:10'),
(7, '6', '1', '0', '0', 'Replace wiper blades', '', '2022-01-03 18:57:04'),
(8, '8', '0', '5', '0', 'Oil Service', '', '2022-01-03 06:28:47'),
(9, '10', '1', '4', '0', 'Check PDC fault and drive train fault', '', '2022-01-03 19:28:38'),
(10, '11', '0', '5', '0', 'Oil Service', '', '2022-01-03 07:29:10'),
(11, '12', '1', '8', '0', 'Removing and installing/replacing brake pads on both front disc brakes', '', '2022-01-03 20:10:46'),
(14, '13', '1', '4', '0', 'CHECKING WOBBLES/JERK WHILE DRIVING', '', '2022-01-03 21:43:28'),
(16, '7', '1', '8', '0', 'REPLACING VIBRATION DAMPER', '', '2022-01-03 22:45:19'),
(17, '7', '2', '34', '0', 'CARRIER CHARGE', '', '2022-01-03 22:45:19'),
(18, '10', '1', '8', '0', 'CHECKING AND REPAIRING PDC WIRING', '', '2022-01-03 23:30:40'),
(19, '14', '0', '15', '0', 'Oil Service', '', '2022-01-03 11:23:21'),
(20, '15', '1', '6', '0', 'CHECK ENGINE OVER HEAT', '', '2022-01-04 18:21:29'),
(21, '14', '1', '5', '0', 'REPLACING BOTH REAR TYRES', '', '2022-01-04 18:36:45'),
(22, '17', '1', '10', '0', 'Replacing vehicle battery - including registering battery change -', '', '2022-01-04 22:23:45'),
(23, '9', '0', '89', '0', 'Paint Work', '', '2022-01-04 13:12:52'),
(36, '20', '1', '12', '0', 'VEHICLE INSPECTION', '', '2022-01-05 18:56:23'),
(37, '19', '0', '4', '0', 'Oil Service', '', '2022-01-05 08:14:28'),
(38, '19', '0', '10', '0', 'Brake Service', '', '2022-01-06 04:34:53'),
(39, '21', '0', '15', '0', 'Oil Service', '', '2022-01-06 04:47:04'),
(40, '22', '1', '0', '0', 'Checking engine misfire', '', '2022-01-06 18:39:01'),
(42, '23', '2', '4', '0', 'CHECKING COMFORT ACCESS NOT WORKING', '', '2022-01-07 18:22:46'),
(43, '18', '1', '1', '0', 'WORKSHOP CONSUMABLES', '', '2022-01-07 19:00:55'),
(45, '23', '1', '12', '0', 'REPAIRING WIRING OF THE FRONT RIGHT COMFORT ACCESS SIGNAL ANTENNA', '', '2022-01-07 19:33:53'),
(48, '23', '1', '2', '0', 'REPLACING FRONT RIGHT WHEEL SPEED SENSOR', '(with job item no. 34 50 003)', '2022-01-07 20:47:07'),
(49, '23', '2', '3', '0', 'REPLACING REAR LEFT WHEEL SPEED SENSOR', '(with job item no. 34 50 003)', '2022-01-07 20:47:07'),
(50, '24', '1', '0', '0', 'TOPPING UP ENGINE OIL', '', '2022-01-07 21:11:39'),
(51, '25', '1', '18', '0', 'Sealing oil coolant heat exchanger', '', '2022-01-07 23:38:45'),
(52, '28', '0', '15', '10', 'Oil Service', '', '2022-01-10 04:26:56'),
(54, '27', '1', '8', '0', 'Removing and installing both front door trim panels', '', '2022-01-10 17:29:24'),
(55, '27', '2', '2', '0', 'Replacing both grab handles at rear', '', '2022-01-10 17:29:24'),
(56, '27', '3', '7', '0', 'Removing and installing both rear door trim panels', '', '2022-01-10 17:29:24'),
(57, '27', '4', '2', '0', 'Replacing both grab handles, front', '', '2022-01-10 17:29:24'),
(58, '29', '1', '4', '0', 'Checking front suspension noise', '', '2022-01-10 18:47:25'),
(59, '30', '0', '25', '0', 'Dent work', '', '2022-01-10 08:30:03'),
(61, '30', '0', '10', '0', 'Paint Work', '', '2022-01-10 08:31:40'),
(62, '30', '0', '10', '0', 'Polish work', '', '2022-01-10 08:31:54'),
(63, '31', '1', '4', '0', 'Checking function of the AC system', '', '2022-01-10 22:35:49'),
(64, '31', '1', '2', '0', 'Removing and installing fresh air grille, center', '', '2022-01-10 23:53:03'),
(65, '32', '1', '12', '0', 'Replacing balancing shaft oil seals', '', '2022-01-11 17:29:57'),
(66, '32', '2', '12', '0', 'Removing and installing the intake plenum', '', '2022-01-11 17:29:57'),
(67, '36', '1', '4', '0', 'CHECKING ENGINE OVERHEAT', '', '2022-01-12 16:48:50'),
(68, '37', '1', '4', '0', 'Checking function of the A/C system', '', '2022-01-12 20:19:44'),
(69, '38', '0', '53', '0', 'Paint Work', '', '2022-01-12 09:05:49'),
(70, '39', '1', '4', '0', 'Replacing a rear wheel speed sensor', '(with job item no. 34 50 003)', '2022-01-12 21:45:06'),
(71, '40', '1', '2', '0', 'Checking condition of the headlights', '', '2022-01-12 21:54:09'),
(72, '27', '1', '2', '0', 'Replacing fresh air grille, center', '', '2022-01-12 22:14:12'),
(73, '27', '1', '1', '0', 'Replacing ashtray lid mechanism', '', '2022-01-12 22:15:12'),
(74, '41', '1', '4', '0', 'check rear display not working', '', '2022-01-13 17:35:00'),
(75, '41', '2', '1', '0', 'top up washer fluid', '', '2022-01-13 17:35:00'),
(76, '41', '3', '25', '0', 'Install dashboard camera', '', '2022-01-13 17:35:00'),
(77, '42', '1', '6', '0', 'checking multiple faults indicating related to the DSC system', '', '2022-01-13 17:46:57'),
(78, '41', '1', '7', '0', 'Removing and installing right front door trim panel', '', '2022-01-13 18:07:18'),
(79, '41', '2', '3', '0', 'replacing front grab handle right', '', '2022-01-13 18:07:18'),
(80, '36', '1', '16', '0', 'Removing and installing coolant radiator', '', '2022-01-13 18:18:03'),
(81, '43', '0', '15', '0', 'Oil Service', '', '2022-01-13 05:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_sublet`
--

CREATE TABLE `tbl_job_sublet` (
  `sublet_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `sublet_description` mediumtext,
  `sublet_price` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `sublet_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_job_sublet`
--

INSERT INTO `tbl_job_sublet` (`sublet_id`, `job_id`, `sublet_description`, `sublet_price`, `user_id`, `sublet_datetime`) VALUES
(8, '12', 'REFACING FRONT BRAKE DISC', '3600', '11', '2022-01-04 13:51:07'),
(9, '14', 'WHEEL BALANCING', '600', '11', '2022-01-05 12:55:15'),
(10, '28', 'CONSUMABLES', '300', '12', '2022-01-10 13:39:21'),
(11, '38', 'WHEEL BALANCING CHARGE', '4500', '13', '2022-01-12 16:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour`
--

CREATE TABLE `tbl_labour` (
  `labour_id` int(11) NOT NULL,
  `labour_name` varchar(255) DEFAULT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_labour`
--

INSERT INTO `tbl_labour` (`labour_id`, `labour_name`, `fru`, `datetime`) VALUES
(1, 'Oil Service', '5', '2021-02-07 18:42:35'),
(2, 'Brake Service', '15', '2021-02-07 18:43:06'),
(3, 'Replace Tyres', '10', '2021-02-07 18:43:06'),
(6, 'Marking engine number', '43', '2021-12-24 18:45:37'),
(7, 'Perform vehicle test', '4', '2021-12-24 18:51:12'),
(8, 'Dent work', '10', '2022-01-05 01:41:21'),
(9, 'Paint Work', '10', '2022-01-05 01:41:34'),
(10, 'Polish work', '10', '2022-01-05 01:41:44'),
(11, 'PART SALE', '0', '2022-01-10 18:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour_paying`
--

CREATE TABLE `tbl_labour_paying` (
  `labour_paying_id` int(11) NOT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `pay_amount` varchar(255) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_labour_paying`
--

INSERT INTO `tbl_labour_paying` (`labour_paying_id`, `fru`, `pay_amount`, `datetime`) VALUES
(1, '1', '275', '2021-07-26 16:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `date_count` varchar(50) DEFAULT NULL,
  `note` mediumtext,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `invoice_id`, `price`, `payment_method`, `date_count`, `note`, `datetime`) VALUES
(1, '1', '40675', 'Cash', '', '', '2022-01-04 11:45:16'),
(2, '10', '9925', 'Cash', '', '', '2022-01-04 11:45:43'),
(3, '7', '30515', 'Cash', '', '', '2022-01-04 11:45:50'),
(4, '11', '84750', 'Cash', '', '', '2022-01-04 11:45:59'),
(5, '6', '3300', 'Cash', '', '', '2022-01-04 11:46:08'),
(6, '12', '36700', 'Cash', '', '', '2022-01-04 11:46:15'),
(7, '17', '35550', 'Cash', '', '', '2022-01-04 11:46:21'),
(8, '20', '3300', 'Cash', '', '', '2022-01-05 10:01:16'),
(9, '14', '119599', 'Cash', '', '', '2022-01-05 16:20:50'),
(10, '5', '32010.20292', 'Visa', '', '', '2022-01-06 07:21:09'),
(11, '21', '33150', 'Cash', '', '', '2022-01-07 01:56:22'),
(12, '24', '4700', 'Cash', '', '', '2022-01-08 16:21:20'),
(13, '25', '5125', 'Cash', '', '', '2022-01-08 16:21:28'),
(14, '13', '3770', 'Cash', '', '', '2022-01-08 16:21:34'),
(15, '23', '42615', 'Visa', '', '', '2022-01-08 16:23:40'),
(16, '28', '43140', 'Cash', '', '', '2022-01-10 10:09:24'),
(17, '29', '1100', 'Visa', '', '', '2022-01-10 10:09:35'),
(18, '31', '11127.5', 'Credit', '4', '', '2022-01-12 04:44:59'),
(19, '37', '1100', 'Cash', '', '', '2022-01-12 08:40:07'),
(20, '38', '28795.5549', 'Visa', '', '', '2022-01-12 11:18:01'),
(21, '27', '36400.538', 'Visa', '', '', '2022-01-12 11:18:19'),
(22, '40', '550', 'Cash', '', '', '2022-01-12 11:19:06'),
(23, '39', '15950', 'Credit', '1', '', '2022-01-12 11:38:59'),
(24, '36', '8000', 'Visa', '', '', '2022-01-13 06:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_type` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status_type`, `remark`, `vehicle_detail_id`, `status_date`) VALUES
(1, 'Vehicle received', 'null', '1', '2021-12-30 07:25:47'),
(2, 'Repair Complete', '', '1', '2021-12-30 10:22:19'),
(5, 'Vehicle received', 'null', '4', '2022-01-02 10:29:01'),
(6, 'Vehicle received', 'null', '5', '2022-01-03 03:24:43'),
(7, 'Vehicle received', 'null', '6', '2022-01-03 05:04:30'),
(8, 'Vehicle received', 'null', '7', '2022-01-03 05:18:12'),
(9, 'Vehicle received', 'null', '8', '2022-01-03 06:27:37'),
(10, 'Vehicle received', 'null', '9', '2022-01-03 06:49:28'),
(11, 'Vehicle received', 'null', '10', '2022-01-03 06:57:22'),
(12, 'Vehicle received', 'null', '11', '2022-01-03 07:21:34'),
(13, 'Vehicle received', 'null', '12', '2022-01-03 07:37:36'),
(14, 'Vehicle received', 'null', '13', '2022-01-03 09:12:00'),
(15, 'Vehicle received', 'null', '14', '2022-01-03 11:21:26'),
(16, 'Vehicle received', 'null', '15', '2022-01-04 05:49:03'),
(17, 'Vehicle received', 'null', '16', '2022-01-04 08:01:08'),
(18, 'Vehicle received', 'null', '17', '2022-01-04 09:41:01'),
(19, 'Vehicle received', 'null', '18', '2022-01-04 10:14:40'),
(20, 'Vehicle received', 'null', '19', '2022-01-04 12:27:55'),
(21, 'Vehicle received', 'null', '20', '2022-01-05 06:13:43'),
(22, 'Vehicle received', 'null', '21', '2022-01-06 04:39:32'),
(23, 'Vehicle received', 'null', '22', '2022-01-06 06:07:46'),
(24, 'Vehicle received', 'null', '23', '2022-01-07 05:52:24'),
(25, 'Vehicle received', 'null', '24', '2022-01-07 08:38:48'),
(26, 'Vehicle received', 'null', '25', '2022-01-07 11:04:32'),
(27, 'Vehicle received', 'null', '26', '2022-01-08 16:18:23'),
(28, 'Vehicle received', 'null', '27', '2022-01-10 04:22:05'),
(29, 'Vehicle received', 'null', '28', '2022-01-10 04:23:00'),
(30, 'Vehicle received', 'null', '29', '2022-01-10 06:16:25'),
(31, 'Vehicle received', 'null', '30', '2022-01-10 08:29:35'),
(32, 'Vehicle received', 'null', '31', '2022-01-10 10:03:57'),
(33, 'Vehicle received', 'null', '32', '2022-01-11 04:57:55'),
(34, 'Vehicle received', 'null', '33', '2022-01-11 07:04:40'),
(35, 'Vehicle received', 'null', '34', '2022-01-11 19:50:01'),
(36, 'Vehicle received', 'null', '35', '2022-01-11 19:52:30'),
(37, 'Vehicle received', 'null', '36', '2022-01-12 04:17:52'),
(38, 'Vehicle received', 'null', '37', '2022-01-12 07:48:30'),
(39, 'Vehicle received', 'null', '38', '2022-01-12 08:48:04'),
(40, 'Vehicle received', 'null', '39', '2022-01-12 09:12:25'),
(41, 'Vehicle received', 'null', '40', '2022-01-12 09:23:25'),
(42, 'Vehicle received', 'null', '41', '2022-01-13 04:58:57'),
(43, 'Vehicle received', 'null', '42', '2022-01-13 05:06:00'),
(44, 'Vehicle received', 'null', '43', '2022-01-13 05:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `tax_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `note` mediumtext,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`tax_id`, `job_id`, `user_id`, `vat`, `discount`, `note`, `additional_price`, `datetime`, `client_id`) VALUES
(1, '1', '9', '0', '0', '', '0', '2021-12-30 13:11:41', '4'),
(5, '9', '13', '0', '0', 'REPAINTED FRONT BUMPER, LH SIDE SKIRT, RH FENDER AND REAR BUMPER DIFFUSER.\r\n\r\nREAR BUMPER AND FULL WAX DONE FREE OF CHARGE', '0', '2022-01-06 12:27:46', '9'),
(6, '10', '13', '0', '0', 'CHECKED PDC FAULT - FOUND THE WIRING OF FRONT PDC SYSTEM DAMAGED.\r\n- REPAIRED DAMAGED WIRING.\r\n\r\nCHECKED DRIVETRAIN - FOUND THE EXHAUST BACK PRESSURE SENSOR FAULTY. RECOMMENDED TO REPLACE THE BACK PRESSURE SENSOR AS THE INITIAL STEP. FURTHER FAULT NEEDS TO BE CHECK AFTER BACK PRESSURE SENSOR REPLACEMENT.', '0', '2022-01-03 16:39:15', '10'),
(7, '11', '13', '0', '0', 'OIL SERVICE CARRIED OUT \r\nINSPECTION REPORT ATTACHED WITH INVOICE\r\n\r\nBANK DETAILS:\r\nBAVARIAN AUTOMOBILE ENGINEERING PVT LTD\r\n0175 1001 0035\r\nSAMPATH BANK - COLOMBO SUPER BRANCH', '0', '2022-01-03 14:48:21', '11'),
(9, '5', NULL, '0', '0', NULL, '0', NULL, '5'),
(10, '6', '13', '0', '0', 'Checked suspension - Front bushing, rack ends and tie rod ends need to be replaced.\r\nWiper blades replaced', '0', '2022-01-03 13:25:29', '3'),
(11, '7', '12', '0', '0', 'CHECKED VEHICLE BREAKDOWN -\r\n\r\n- FOUND THE ENGINE VIBRATION DAMPER DAMAGED - REPLACED VIBRATION DAMPER.\r\n\r\n- CLEARED ALL FAULT MEMORY.\r\n\r\nROAD TESTED - OKAY AT THE TIME OF TEST', '0', '2022-01-03 16:05:27', '6'),
(12, '12', '12', '0', '0', 'CARRIED OUT FRONT BRAKE PAD SERVICE -\r\n- REPLACED FRONT BRAKES PADS.\r\n- REPLACED FRONT BRAKE PADS WEAR SENSOR.\r\n\r\nREAR BRAKE PADS ARE CLOSE THE MINIMUM REQUIRED THICKNESS - WILL NEED TO BE REPLACED IN APROXIMATELY 3000KM.\r\n\r\nCHECKED THE CONDITION OF THE BATTERY - FOUND THE BATTERY WEAK \r\n- RECOMMENDED TO REPLACE.\r\n\r\nROAD TESTED - ALL OKAY AT THE TIME OF TEST.', '0', '2022-01-04 14:01:30', '12'),
(13, '13', '12', '0', '0', 'CHECKED VEHICLE JERK WHEN DRIVING - \r\n\r\nPERFORMED VEHICLE TEST - NO FAULT RELATED TO THE POWERTRAIN SYSTEM.\r\n\r\nRECOMMENDED TO CARRY OUT TRANSFER BOX CALIBRATION.\r\n\r\nTRANSFER BOX CALIBRATION NOT CARRIED OUT AS PER CUSTOMERS REQUEST.', '0', '2022-01-08 13:56:46', '15'),
(14, '14', '12', '0', '0', 'CARRIED OUT ENGINE OIL SERVICE -\r\n- REPLACED ENGINE OIL AND OIL FILTER\r\n- CLEANED ENGINE AIR FILTER AS IT WAS IN A GOOD CONDITION\r\n- CLEANED A/C MICRO FILTERS.\r\n\r\nCHECKED AND DELETED ALL FAULT MEMORY.\r\n\r\nREPLACED AND BALANCED BOTH REAR TYRES.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST\r\n', '0', '2022-01-05 13:32:33', '16'),
(15, '15', NULL, '0', '0', NULL, '0', NULL, '17'),
(16, '16', NULL, '0', '0', NULL, '0', NULL, '18'),
(17, '17', '12', '0', '0', 'CHECKED VEHICLE NOT STARTING -\r\n\r\nFOUND THE VEHICLE BATTERY WEAK.\r\n\r\nREPLACED AND REGISTERED BATTERY.\r\n\r\nCHECKED FUNCTIONS OF THE VEHICLE - OKAY AT THE TIME OF TEST.', '0', '2022-01-04 17:05:49', '19'),
(18, '18', '9', '0', '0', '', '0', '2022-01-09 02:37:02', '20'),
(19, '19', '9', '0', '0', 'good\r\nyes good\r\nnice nice\r\nlol\r\nyep', '', '2022-01-09 02:03:49', '1'),
(20, '20', '12', '0', '0', 'CARRIED OUT VEHICLE INSPECTION -\r\n\r\n- FOUND THE COOLANT RADIATOR SEVERELY LEAKING - RECOMMENDED TO REPLACE COOLANT RADIATOR.\r\n\r\nFOUND STEERING RACK O RINGS LEAKING STEERIING HYDRAULICH FLUID - RECOMMENDED TO REPLACE O RINGS.\r\n\r\n- FOUND THE ENGINE MOUNTS WEAK - RECOMMENDED TO REPLACE BOTH ENGINE MOUNTS.\r\n\r\n- FOUND TRANSMISSION MOUNTS BROKEN - RECOMMENDED TO REPLACE BOTH TRANSMISSION MOUNTS.', '0', '2022-01-05 13:58:06', '23'),
(21, '21', '12', '0', '0', 'CARRIED OUT VEHICLE OIL SERVICE â€“\r\n- REPLACED ENGINE OIL AND OIL FILTER.\r\n- CLEANED ENGINE AIR FILTER AS IT WAS IN A GOOD CONDITION.\r\n- CLEANED A/C MICRO FILTER AS IT WAS IN A GOOD CONDITION.\r\n\r\nPERFOMED VEHICLE TEST â€“ FOUND HIGH VOLTAGE BATTERY CELL N0.03 TEMPERATURE FAULT IN THE FAULT MEMORY. FAULT CURRENTLY NOT PRESENT IN THE SYSTEM. NEEDS ATTENTION. \r\n\r\nCARRIED OUT VEHICLE INSPECTION-\r\nBRAKE PADS (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 5.60mm / RIGHT â€“ 5.60mm\r\nREAR â€“ LEFT â€“ 8.80mm / RIGHT â€“ 8.80mm\r\n\r\nFRONT BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 28.40mm)\r\nFRONT â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\nREAR BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 18.40mm)\r\nREAR â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\n\r\nFRONT TYRE PRESSURE MUST BE 2.20bar\r\nFRONT â€“ LEFT â€“ 2.20bar / RIGHT â€“ 2.20bar\r\nREAR TYRE PRESSURE MUST BE 2.20bar\r\nREAR â€“ LEFT â€“ 2.20bar / RIGHT â€“ 2.20bar\r\n\r\nTYRE THREAD DEPTH (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 6.00mm / RIGHT â€“ 6.00mm\r\nREAR â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\n\r\nINNER EDGE OF THE REAR TYRES WORN RELATIVE TO THE OUTER EDGE â€“ RECOMMENDED TO CARRY OUT WHEEL ALIGNMENT.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST.\r\n', '0', '2022-01-06 15:57:21', '25'),
(22, '22', '12', '0', '0', 'CANNOT CHARGE CUSTOMER AS ENGINE MISFIRE OCCURED THE DAY AFTER THE OIL SERVICE.', '0', '2022-01-12 17:12:53', '16'),
(23, '23', '12', '0', '0', 'CHECK MULTIPLE FAULTS INDICATING - FOUND FAULT IN THE FRONT RIGHT WHEEL SPEED SENSOR AND THE REAR LEFT WHEEL SPEED SENSOR.\r\n- REPLACED FRONT RIGHT AND REAR LEFT WHEEL SPEED SENSORS.\r\nREPLACED WITH OEM PARTS. REPLACED PARTS ARE ENTITLED FOR A WARRANTY PERIOD OF 6 MONTHS.\r\n\r\nCHECKED COMFORT ACCESS NOT WORKING - FOUND WIRING OF THE FRON RIGHT COMFORT ACCESS SIGNALL ANTENNA DAMAGED FROM 2 PLACES - REPAIRED.\r\n\r\nROAD TESTED - ALL OKAY AT THE TIME OF TEST.', '0', '2022-01-07 14:20:10', '26'),
(24, '24', '12', '0', '0', 'TOPPED UP 1 LITER OF ENGINE OIL', '0', '2022-01-07 14:41:27', '4'),
(25, '25', '12', '0', '0', 'REPLACING OIL FILTER HOUSING GASKETS', '0', '2022-01-07 17:21:54', '27'),
(26, '26', NULL, '0', '0', NULL, '0', NULL, '23'),
(27, '27', '12', '0', '0', 'REPLACED FRONT BOTH GRAB HANDLES.\r\n\r\nREPLACED REAR BOTH GRAB HANDLES.\r\n\r\nREPLACED FRONT LEFT AND REAR BOTH POWER WINDOW BUTTON TRIMS.\r\n\r\nREPLACED FRONT CENTER A/C VENT.\r\n\r\nREPLACE ASH TRAY LID MECHANISM.', '0', '2022-01-12 16:38:55', '29'),
(28, '28', '12', '0', '0', 'CARRIED OUT VEHICLE OIL SERVICE â€“\r\n- REPLACED ENGINE OIL AND OIL FILTER.\r\n- REPLACED ENGINE AIR FILTER AS IT WAS CLOGGED.\r\n- CLEANED A/C MICRO FILTER AS IT WAS IN A GOOD CONDITION.\r\n\r\nPERFOMED VEHICLE TEST â€“ FOUND FAULT IN THE SOS SYSTEM BATTERY.\r\nBATTERY LOW VOLTAGE - RECOMMENEDED REPLACED\r\n\r\nCARRIED OUT VEHICLE INSPECTION-\r\nBRAKE PADS (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 6.00mm / RIGHT â€“ 6.00mm\r\nREAR â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\n\r\nFRONT BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 28.40mm)\r\nFRONT â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\nREAR BRAKE DISCS (MINIMUM REQUIRED LIMIT â€“ 18.40mm)\r\nREAR â€“ LEFT â€“ OKAY / RIGHT â€“ OKAY\r\n\r\nFRONT TYRE PRESSURE MUST BE 2.40bar\r\nFRONT â€“ LEFT â€“ 2.40bar / RIGHT â€“ 2.40bar\r\nREAR TYRE PRESSURE MUST BE 2.40bar\r\nREAR â€“ LEFT â€“ 2.40bar / RIGHT â€“ 2.40bar\r\n\r\nTYRE THREAD DEPTH (MINIMUM REQUIRED LIMIT â€“ 3mm)\r\nFRONT â€“ LEFT â€“ 5.00mm / RIGHT â€“ 5.00mm\r\nREAR â€“ LEFT â€“ 4.50mm / RIGHT â€“ 4.50mm\r\n\r\nRECOMMENDED TO CARRY OUT WHEEL ALIGNMENT.\r\n\r\nROAD TESTED â€“ OKAY AT THE TIME OF TEST.', '0', '2022-01-10 13:37:22', '15'),
(29, '29', '13', '0', '0', 'FOUND BOTH FRONT CONTROL ARM BUSH BROKEN, NEED TO REPLACE EITHER BUSHES OR ARMS.\r\nESTIMATES WILL BE PROVIDED', '0', '2022-01-10 12:56:28', '32'),
(30, '30', NULL, '0', '0', NULL, '0', NULL, '30'),
(31, '31', '12', '0', '0', 'CHECKED FUNCTION OF THE A/C SYSTEM -\r\n\r\nPERFORMED VEHICLE TEST - NO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nCHECKED TEMPERATURE SENSOR READING AT EVAPORATOR AND OTHER AREAS - ALL UPTO TARGET VALUE.\r\n\r\nNO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nREPLACED THE FRONT CENTER A/C GRILL.', '0', '2022-01-12 09:19:22', '33'),
(32, '32', NULL, '0', '0', NULL, '0', NULL, '30'),
(33, '33', NULL, '0', '0', NULL, '0', NULL, '34'),
(35, '35', NULL, '0', '0', NULL, '0', NULL, '1'),
(36, '36', '12', '0', '0', 'CHECKED COOLANT LEVEL REDUCING - FOUND THE RADIATOR LEAKING.\r\n\r\nCUSTOMER REQUESTED TO REPAIR RADIAOTR THEREFORE RADIATOR WAS REMOVED AND HANDED OVER TO CUSTOMER. INSTALLED RADIATOR AFTER RADIATOR REPAIR WAS CARRIED OUT BY CUSTOMER.\r\n\r\nBLED THE COOLING SYSTEM', '0', '2022-01-13 11:21:50', '35'),
(37, '37', '12', '0', '0', 'CHECKED FUNCTION OF THE A/C SYSTEM -\r\n\r\nPERFORMED VEHICLE TEST - NO FAULTS FOUND RELATED TO THE A/C SYSTEM.\r\n\r\nALL A/C TEMPERATURE VALUES ARE OKAY.\r\n\r\nFUNCTION OF THE A/C SYSTEM - OKAY', '0', '2022-01-12 14:08:31', '36'),
(38, '38', '13', '0', '0', 'REPAINTED ALL FOUR ALLOY WHEELS AND BALANCED ALL WHEELS. \r\n\r\nREPLACED ALL TYRE VALVES.\r\n\r\nREFER ATTACHED ESTIMATE FOR A DETAILED BREAKDOWN', '0', '2022-01-12 16:39:41', '29'),
(39, '39', '12', '0', '0', 'CHECKED MULTIPLE FAULT -\r\n\r\nPERFORMED VEHICLE TEST - FOUND THE REAR LEFT WHEEL SPEED SENSOR.\r\n- REPLACED REAR LEFT WHEEL SPEED SENSOR.\r\n\r\nROAD TESTED - OKAY AT THE TIME OF TEST.', '0', '2022-01-12 15:26:00', '37'),
(40, '40', '12', '0', '0', 'CHECKED LEFT HEADLIGHT - FOUND UNDERNEATH OF THE HEADLIGHT CRACKED - RECOMMENDED TO REPLACE THE HEADLIGHT AND THE DRL UNITS', '0', '2022-01-12 16:47:29', '36'),
(41, '41', NULL, '0', '0', NULL, '0', NULL, '39'),
(42, '42', NULL, '0', '0', NULL, '0', NULL, '38'),
(43, '43', NULL, '0', '0', NULL, '0', NULL, '41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `vehicle_modal` varchar(255) DEFAULT NULL,
  `chassis_no` varchar(100) DEFAULT NULL,
  `note` mediumtext,
  `stat` varchar(3) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`vehicle_id`, `client_id`, `license_no`, `vehicle_modal`, `chassis_no`, `note`, `stat`, `reg_date`) VALUES
(1, '1', 'KJ-1086', 'March K12', '151514515f15', '', '1', '2021-11-09 17:19:57'),
(2, '2', 'WP KR-2760', '523i', 'WBAFP32050C866051', 'F10', '1', '2021-11-25 12:06:34'),
(3, '3', 'CP KR-8846', 'A4', 'WAUZZZ8KXCA072360', 'Diesel 2011', '1', '2021-12-02 11:46:50'),
(4, '4', 'WP CAW0220', 'BMW 7 Series', 'WBA7J22010G497083', '', '1', '2021-12-30 12:52:25'),
(5, '5', 'WBAKM42090C232755', '730Ld', 'WBAKM42090C232755', '', '1', '2022-01-03 08:32:05'),
(6, '6', 'WP CAD4542', '520D F10', 'WBAFW12090D272998', '', '1', '2022-01-03 10:15:47'),
(7, '9', 'WP CAD2001', '520D F10', 'WBAFW12020C840790', '', '1', '2022-01-03 12:09:29'),
(8, '10', 'WP KY 6000', '520D', 'WBAFW12050C843246', '', '1', '2022-01-03 12:12:54'),
(9, '11', 'WP KT-2898', 'X1 E84', 'WBAVN320X0V96666', '', '1', '2022-01-03 12:43:48'),
(10, '12', 'WP CBF1070', 'X1 s18i F48', 'WBAJG12070EE62366', 'Replace front and rear brake pads\r\n\r\n*Battery discharged fault\r\n*SOS call system failure \r\n*Washer fluid low fault\r\n*Dipped beam right fault', '1', '2022-01-03 12:51:48'),
(11, '15', 'WP CBH 3238', '740LE G12', 'WBA7J22000B219210', '', '1', '2022-01-03 14:34:56'),
(12, '16', 'WP CBM0025', '318i F30', 'WBA8E36010NU32741', '', '1', '2022-01-03 16:43:19'),
(13, '17', 'WP CBE9100', '318i F30', 'WBA8E36050NU33231', '', '1', '2022-01-04 11:14:02'),
(14, '18', 'WP KQ-5741', '320D E90', 'WBAPP12080F029561', '', '1', '2022-01-04 13:10:14'),
(15, '19', 'WP CBF0705', 'X1 S18I F48', 'WBAJG12080EG23503', '', '1', '2022-01-04 15:02:16'),
(16, '20', 'Workshop', 'Workshop', 'Workshop', '', '1', '2022-01-04 15:43:16'),
(17, '23', 'WP KO-4750', 'X1 E84 S20D', 'WBAVL32020VP88680', '', '1', '2022-01-05 11:38:51'),
(18, '25', 'WP CAX1441', 'X5 40E F15', 'WBAKT020100T68360', '', '1', '2022-01-06 10:03:07'),
(19, '26', 'WP CBI9596', '318i F30', 'WBA8E32090A019625', '', '1', '2022-01-07 11:10:23'),
(20, '4', 'WP KM-0648', '523i F10', 'WBAFP32090C545498', '', '1', '2022-01-07 14:05:55'),
(21, '27', 'WP CAD7373', 'Active Hybrid', 'WBAYA02060C993366', '', '1', '2022-01-07 16:28:31'),
(22, '28', 'WP CAW 9930', '318i (F30)', 'WBA8E32040K783523', '', '1', '2022-01-08 12:02:11'),
(23, '29', 'WP KV-5005', '520D', 'WBAFW12040C847997', '', '1', '2022-01-10 09:44:33'),
(24, '30', 'WP KV-0188', '520D', 'WBAFW12020DY97792', '', '1', '2022-01-10 10:52:27'),
(25, '31', 'NA', 'NA', 'NA', '', '1', '2022-01-10 11:27:33'),
(26, '32', 'NC CAG8118', 'Active Hybrid 7 F01', 'WBAYA020X0D365613', '', '1', '2022-01-10 11:35:40'),
(27, '33', 'CP KX-8786', '520D F10', 'WBAFW12020DY97338', '', '1', '2022-01-10 15:19:47'),
(28, '34', 'WP CAX8228', 'X5 40e F15', 'WBAKT020700V63881', '', '1', '2022-01-11 12:24:54'),
(29, '35', 'SG KR-2312', '740Li F02', 'WBAKB42060CY83881', '', '1', '2022-01-12 09:09:45'),
(30, '36', 'WP KX-8218', 'X1 20D E84', 'WBAVN92050VX48798', '', '1', '2022-01-12 13:15:57'),
(31, '37', 'WP CAR9777', 'X5 40e F15', 'WBAKT020700EPP201', '', '1', '2022-01-12 14:40:11'),
(32, '38', 'WP KR-8408', '740Li F02 ', 'WBAKB42010CY83870', '', '1', '2022-01-13 10:09:49'),
(33, '39', 'WP CAC 0648', '520D', 'WBA5C32040D600411', '', '1', '2022-01-13 10:14:46'),
(34, '40', 'WP CAC4714', '520d F10', 'WBAFW12060C848407', '', '1', '2022-01-13 10:45:08'),
(35, '41', 'WP CBE8866', '318i F30', 'WBA8E36040NU33186', '', '1', '2022-01-13 10:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_details`
--

CREATE TABLE `tbl_vehicle_details` (
  `v_id` int(11) NOT NULL,
  `reg_email` mediumtext,
  `reg_date` varchar(255) DEFAULT NULL,
  `reg_customer` varchar(255) DEFAULT NULL,
  `reg_phone_no` varchar(255) DEFAULT NULL,
  `f_reg_date` varchar(255) DEFAULT NULL,
  `service_booklet` varchar(255) DEFAULT NULL,
  `soc_hv_battery` varchar(255) DEFAULT NULL,
  `reg_model` varchar(255) DEFAULT NULL,
  `reg_chassis_no` varchar(255) DEFAULT NULL,
  `reg_licens_no` varchar(255) DEFAULT NULL,
  `reg_mileage` varchar(255) DEFAULT NULL,
  `reg_fuel` varchar(255) DEFAULT NULL,
  `reg_customer_charging` varchar(255) DEFAULT NULL,
  `display` mediumtext,
  `display_remark` mediumtext,
  `interior_lights` mediumtext,
  `interior_lights_remark` mediumtext,
  `signals` mediumtext,
  `signals_remark` mediumtext,
  `steering` mediumtext,
  `steering_remark` mediumtext,
  `hand_brake` mediumtext,
  `hand_brake_remark` mediumtext,
  `aircon` mediumtext,
  `aircon_remark` mediumtext,
  `wiper_blades` mediumtext,
  `wiper_blades_remark` mediumtext,
  `windows_glass` mediumtext,
  `windows_glass_remark` mediumtext,
  `replace_microfilter` mediumtext,
  `replace_microfilter_remark` mediumtext,
  `coolant` mediumtext,
  `coolant_remark` mediumtext,
  `engine_oil` mediumtext,
  `engine_oil_remark` mediumtext,
  `v_belt` mediumtext,
  `v_belt_remark` mediumtext,
  `noticeble_leaks` mediumtext,
  `noticeble_leaks_remark` mediumtext,
  `damage_animals` mediumtext,
  `damage_animals_remark` mediumtext,
  `annual_check` mediumtext,
  `shock` mediumtext,
  `shock_remark` mediumtext,
  `tyre_tread` mediumtext,
  `tyre_tread_remark` mediumtext,
  `engine_gearbox` mediumtext,
  `engine_gearbox_remark` mediumtext,
  `front_axle` mediumtext,
  `front_axle_remark` mediumtext,
  `front_brake` mediumtext,
  `front_brake_remark` mediumtext,
  `rear_axle` mediumtext,
  `rear_axle_remark` mediumtext,
  `rear_brake` mediumtext,
  `rear_brake_remark` mediumtext,
  `brake_lines` mediumtext,
  `brake_lines_remark` mediumtext,
  `exhaust_system` mediumtext,
  `exhaust_system_remark` mediumtext,
  `fuel_tank` mediumtext,
  `fuel_tank_remark` mediumtext,
  `comments` mediumtext,
  `vehicle_screen` longblob,
  `r_f_tyre_tread` mediumtext,
  `r_b_tyre_tread` mediumtext,
  `l_f_tyre_tread` mediumtext,
  `l_b_tyre_tread` mediumtext,
  `body_work` mediumtext,
  `spare_wheel` mediumtext,
  `jack` mediumtext,
  `tools` mediumtext,
  `cd` mediumtext,
  `lighter` mediumtext,
  `sim` mediumtext,
  `extra` mediumtext,
  `amount` mediumtext,
  `pay` mediumtext,
  `stat` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `workshop_name` varchar(255) DEFAULT NULL,
  `power_window` varchar(255) DEFAULT NULL,
  `power_window_remark` varchar(255) DEFAULT NULL,
  `exterior_lights` varchar(255) DEFAULT NULL,
  `exterior_lights_remark` varchar(255) DEFAULT NULL,
  `horn` varchar(255) DEFAULT NULL,
  `horn_remark` varchar(255) DEFAULT NULL,
  `grab_handles` varchar(255) DEFAULT NULL,
  `grab_handles_remark` varchar(255) DEFAULT NULL,
  `sun_roof` varchar(255) DEFAULT NULL,
  `sun_roof_remark` varchar(255) DEFAULT NULL,
  `speaker_covers` varchar(255) DEFAULT NULL,
  `speaker_covers_remark` varchar(255) DEFAULT NULL,
  `carpets` varchar(255) DEFAULT NULL,
  `carpets_remark` varchar(255) DEFAULT NULL,
  `seat_covers` varchar(255) DEFAULT NULL,
  `seat_covers_remark` varchar(255) DEFAULT NULL,
  `rear_display` varchar(255) DEFAULT NULL,
  `rear_display_remark` varchar(255) DEFAULT NULL,
  `f_l_breakpad_t` varchar(255) DEFAULT NULL,
  `f_r_breakpad_t` varchar(255) DEFAULT NULL,
  `b_l_breakpad_t` varchar(255) DEFAULT NULL,
  `b_r_breakpad_t` varchar(255) DEFAULT NULL,
  `f_l_breakdisk_t` varchar(255) DEFAULT NULL,
  `f_r_breakdisk_t` varchar(255) DEFAULT NULL,
  `b_l_breakdisk_t` varchar(255) DEFAULT NULL,
  `b_r_breakdisk_t` varchar(255) DEFAULT NULL,
  `road_test_special_comment` mediumtext,
  `reg_vehicle_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_images`
--

CREATE TABLE `tbl_vehicle_images` (
  `image_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `vehicle_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_images`
--

INSERT INTO `tbl_vehicle_images` (`image_id`, `image`, `vehicle_detail_id`) VALUES
(1, '20220103_081040.jpg', 5),
(2, '20220103_081049.jpg', 5),
(3, '20220103_081058.jpg', 5),
(4, '20220103_081107.jpg', 5),
(5, '20220103_081116.jpg', 5),
(6, '20220103_081127.jpg', 5),
(7, '20220103_081132.jpg', 5),
(8, '20220103_081136.jpg', 5),
(9, '20220103_081149.jpg', 5),
(10, '20220103_081155.jpg', 5),
(11, '20220103_081215.jpg', 5),
(12, '20220103_081632.jpg', 5),
(13, '20220103_102036.jpg', 6),
(14, '20220103_102025.jpg', 6),
(15, '20220103_102018.jpg', 6),
(16, '20220103_102013.jpg', 6),
(17, '20220103_102009.jpg', 6),
(18, '20220103_102003.jpg', 6),
(19, '20220103_102511.jpg', 7),
(20, '20220103_102508.jpg', 7),
(21, '20220103_102454.jpg', 7),
(22, '20220103_102438.jpg', 7),
(23, '20220103_102448.jpg', 7),
(24, '20220103_102408.jpg', 7),
(25, '20220103_102401.jpg', 7),
(26, '20220103_102406.jpg', 7),
(27, '20220103_102525.jpg', 7),
(28, '20220103_102519.jpg', 7),
(49, '20220103_121652.jpg', 9),
(50, '20220103_121644.jpg', 9),
(51, '20220103_121641.jpg', 9),
(52, '20220103_121636.jpg', 9),
(53, '20220103_121630.jpg', 9),
(54, '20220103_121625.jpg', 9),
(55, '20220103_121621.jpg', 9),
(56, '20220103_121757.jpg', 10),
(57, '20220103_121739.jpg', 10),
(58, '20220103_121716.jpg', 10),
(59, '20220103_121708.jpg', 10),
(60, '20220103_121701.jpg', 10),
(61, '20220103_121655.jpg', 10),
(62, '20220103_121554.jpg', 10),
(63, '20220103_124009.jpg', 11),
(64, '20220103_124017.jpg', 11),
(65, '20220103_124027.jpg', 11),
(66, '20220103_124033.jpg', 11),
(67, '20220103_124131.jpg', 11),
(68, '20220103_124140.jpg', 11),
(69, '20220103_124134.jpg', 12),
(70, '20220103_124137.jpg', 12),
(71, '20220103_124144.jpg', 12),
(72, '20220103_124157.jpg', 12),
(73, '20220103_124201.jpg', 12),
(74, '20220103_124309.jpg', 12),
(75, '20220103_124317.jpg', 12),
(76, '20220103_124320.jpg', 12),
(77, '20220103_124342.jpg', 12),
(78, '20220103_161158.jpg', 14),
(79, '20220103_161207.jpg', 14),
(80, '20220103_161211.jpg', 14),
(81, '20220103_161217.jpg', 14),
(82, '20220103_161220.jpg', 14),
(83, '20220103_161225.jpg', 14),
(84, '20220103_161238.jpg', 14),
(85, '20220103_161230.jpg', 14),
(86, '20220104_130527.jpg', 16),
(87, '20220104_130530.jpg', 16),
(88, '20220104_130533.jpg', 16),
(89, '20220104_130536.jpg', 16),
(90, '20220104_130542.jpg', 16),
(91, '20220104_130545.jpg', 16),
(92, '20220104_130549.jpg', 16),
(93, '20220104_130554.jpg', 16),
(94, '20220104_130558.jpg', 16),
(95, '20220104_130604.jpg', 16),
(96, '20220104_130608.jpg', 16),
(97, '20220104_130703.jpg', 16),
(98, '20220104_130707.jpg', 16),
(99, '20220104_144440.jpg', 17),
(100, '20220104_144437.jpg', 17),
(101, '20220104_144420.jpg', 17),
(102, '20220104_144417.jpg', 17),
(103, '20220104_144329.jpg', 17),
(104, '20220104_144319.jpg', 17),
(105, '20220104_144314.jpg', 17),
(106, '20220104_144307.jpg', 17),
(107, '20220104_144305.jpg', 17),
(108, '20220104_144303.jpg', 17),
(109, '20220104_144301.jpg', 17),
(110, '20220104_144259.jpg', 17),
(111, '20220104_144257.jpg', 17),
(112, '266998820_467566954738829_3049432933285003378_n.jpg', 19),
(113, '20220105_113533.jpg', 20),
(114, '20220105_113528.jpg', 20),
(115, '20220105_113525.jpg', 20),
(116, '20220105_113517.jpg', 20),
(117, '20220105_113515.jpg', 20),
(118, '20220105_113508.jpg', 20),
(119, '20220105_113505.jpg', 20),
(120, '20220105_113503.jpg', 20),
(121, '20220105_113459.jpg', 20),
(122, '20220105_113531.jpg', 20),
(123, '20220105_113521.jpg', 20),
(124, '20220106_095659.jpg', 21),
(125, '20220106_095649.jpg', 21),
(126, '20220106_095624.jpg', 21),
(127, '20220106_095453.jpg', 21),
(128, '20220106_095450.jpg', 21),
(129, '20220106_095447.jpg', 21),
(130, '20220106_095444.jpg', 21),
(131, '20220106_095440.jpg', 21),
(132, '20220106_095436.jpg', 21),
(133, '20220106_095432.jpg', 21),
(134, '20220106_095428.jpg', 21),
(135, '20220106_095426.jpg', 21),
(136, '20220106_095421.jpg', 21),
(137, '20220106_095416.jpg', 21),
(138, '20220106_113224.jpg', 22),
(139, '20220107_110803.jpg', 23),
(140, '20220107_110735.jpg', 23),
(141, '20220107_110731.jpg', 23),
(142, '20220107_110728.jpg', 23),
(143, '20220107_110724.jpg', 23),
(144, '20220107_110719.jpg', 23),
(145, '20220107_110715.jpg', 23),
(146, '20220107_110711.jpg', 23),
(147, '20220107_110707.jpg', 23),
(148, '16415446921312690304833025682321.jpg', 24),
(149, '20220110_093138.jpg', 27),
(150, '20220110_093151.jpg', 27),
(151, '20220110_093159.jpg', 27),
(152, '20220110_093226.jpg', 27),
(153, '20220110_093253.jpg', 27),
(154, '20220110_093431.jpg', 27),
(155, '20220110_093448.jpg', 27),
(156, '20220110_093640.jpg', 27),
(157, '20220110_095030.jpg', 28),
(158, '20220110_095033.jpg', 28),
(159, '20220110_095035.jpg', 28),
(160, '20220110_095039.jpg', 28),
(161, '20220110_095122.jpg', 28),
(162, '20220110_095104.jpg', 28),
(163, '20220110_095101.jpg', 28),
(164, '20220110_095056.jpg', 28),
(165, '20220110_095052.jpg', 28),
(166, '20220110_095049.jpg', 28),
(167, '20220110_095041.jpg', 28),
(168, '20220110_113318.jpg', 29),
(169, '20220110_113315.jpg', 29),
(170, '20220110_113310.jpg', 29),
(171, '20220110_113308.jpg', 29),
(172, '20220110_113306.jpg', 29),
(173, '20220110_113302.jpg', 29),
(174, '20220110_113300.jpg', 29),
(175, '20220110_113256.jpg', 29),
(176, '20220110_113254.jpg', 29),
(177, '20220110_113248.jpg', 29),
(178, '20220110_113244.jpg', 29),
(179, '20220110_113242.jpg', 29),
(180, '20220110_113239.jpg', 29),
(181, '20220110_113236.jpg', 29),
(182, '20220110_135308.jpg', 30),
(183, '20220110_135315.jpg', 30),
(184, '20220110_135330.jpg', 30),
(185, '20220110_135337.jpg', 30),
(186, '20220110_135341.jpg', 30),
(187, '20220110_135350.jpg', 30),
(188, '20220110_135357.jpg', 30),
(189, '20220110_135401.jpg', 30),
(190, '20220110_151820.jpg', 31),
(191, '20220110_151817.jpg', 31),
(192, '20220110_151813.jpg', 31),
(193, '20220110_151812.jpg', 31),
(194, '20220110_151810.jpg', 31),
(195, '20220110_151806.jpg', 31),
(196, '20220110_151802.jpg', 31),
(197, '20220110_151758.jpg', 31),
(198, '20220110_151754.jpg', 31),
(199, '20220110_151752.jpg', 31),
(200, '20220110_151749.jpg', 31),
(201, '20220110_151745.jpg', 31),
(202, '20220111_122259.jpg', 33),
(203, '20220111_122302.jpg', 33),
(204, '20220111_122305.jpg', 33),
(205, '20220111_122309.jpg', 33),
(206, '20220111_122314.jpg', 33),
(207, '20220111_122319.jpg', 33),
(208, '20220111_122322.jpg', 33),
(209, '20220111_122326.jpg', 33),
(210, '20220111_122330.jpg', 33),
(211, '20220111_122333.jpg', 33),
(212, '20220111_122335.jpg', 33),
(213, '20220112_091023.jpg', 36),
(214, '20220112_091027.jpg', 36),
(215, '20220112_091032.jpg', 36),
(216, '20220112_091036.jpg', 36),
(217, '20220112_091045.jpg', 36),
(218, '20220112_091050.jpg', 36),
(219, '20220112_091003.jpg', 36),
(220, '20220112_091006.jpg', 36),
(221, '20220112_091009.jpg', 36),
(222, '20220112_091012.jpg', 36),
(223, '20220112_091016.jpg', 36),
(224, '20220112_091019.jpg', 36),
(225, '20220113_101050.jpg', 41),
(226, '20220113_101059.jpg', 41),
(227, '20220113_101102.jpg', 41),
(228, '20220113_101108.jpg', 41),
(229, '20220113_101113.jpg', 41),
(230, '20220113_101122.jpg', 41),
(231, '20220113_101131.jpg', 41),
(232, '20220113_101134.jpg', 41),
(233, '20220113_101142.jpg', 41),
(234, '20220113_101152.jpg', 41),
(235, '20220113_101007.jpg', 42),
(236, '20220113_101010.jpg', 42),
(237, '20220113_101013.jpg', 42),
(238, '20220113_101017.jpg', 42),
(239, '20220113_101020.jpg', 42),
(240, '20220113_101023.jpg', 42),
(241, '20220113_101025.jpg', 42),
(242, '20220113_101029.jpg', 42),
(243, '20220113_101033.jpg', 42),
(244, '20220113_101037.jpg', 42),
(245, '20220113_101040.jpg', 42),
(246, '20220113_101045.jpg', 42),
(247, '20220113_101054.jpg', 42),
(248, '20220113_101055.jpg', 42),
(249, '20220113_105501.jpg', 43),
(250, '20220113_105459.jpg', 43),
(251, '20220113_105456.jpg', 43),
(252, '20220113_105454.jpg', 43),
(253, '20220113_105452.jpg', 43),
(254, '20220113_105450.jpg', 43),
(255, '20220113_105422.jpg', 43),
(256, '20220113_105425.jpg', 43),
(257, '20220113_105428.jpg', 43),
(258, '20220113_105443.jpg', 43),
(259, '20220113_105448.jpg', 43),
(260, '20220113_105441.jpg', 43),
(261, '20220113_105436.jpg', 43);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `video_id` int(11) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `video_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `user_id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(3) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`user_id`, `name`, `email`, `password`, `role`, `tel`, `create_date`) VALUES
(9, 'Admin', 'admin@mail.com', '$2y$10$PcuSZ8AvNIvZ375rhM0P5e9sXZxTIQmNXmv3AMwm7RikMRSYm6wyC', '1', '0771188218', '2020-08-12 13:30:20'),
(11, 'Sellathurai Ramesh', 'ramesh@bae.lk', '$2y$10$7k8y.lBGilfxB9laSfxPaONv3kvHVAuhp339X1LXNYtj4fWGXzafK', '2', '	0775587850', '2021-12-29 08:07:11'),
(12, 'Prashan Yahathugoda', 'prashan@bae.lk', '$2y$10$rWvXU4g4md4ILly//Ceu6e3F2MuxQrsPcxadyntOwnIAORxxQdNyu', '0', '0766454545', '2021-12-30 15:37:31'),
(13, 'Viraj Gunathilake', 'viraj@bae.lk', '$2y$10$/7CLC/iOxrLus4uiSd.vHe/e9bInBW2dungOnh1Po6ntrRRPHVyNW', '1', '0766174491', '2022-01-01 04:06:14'),
(16, 'Service Advisor', 'sa@mail.com', '$2y$10$ny0uzQvPNrKmkJJe2ZChWuh9036YpA3AtESaVeyi4wdhILXPj48GC', '0', '2322', '2022-01-02 12:25:06'),
(17, 'Panduka Wanigarathne', 'panduka@bae.lk', '$2y$10$gS20tAFCFMVrjnAnkPgJRujVe/F1E46GTY1hxDpiOBb.FrhvH5RWW', '1', '07730900053', '2022-01-07 01:52:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_additinal_image`
--
ALTER TABLE `tbl_additinal_image`
  ADD PRIMARY KEY (`image_additinal_id`);

--
-- Indexes for table `tbl_advance`
--
ALTER TABLE `tbl_advance`
  ADD PRIMARY KEY (`advance_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_booking_web`
--
ALTER TABLE `tbl_booking_web`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_estimate_item`
--
ALTER TABLE `tbl_estimate_item`
  ADD PRIMARY KEY (`estimate_item_id`);

--
-- Indexes for table `tbl_estimate_labour`
--
ALTER TABLE `tbl_estimate_labour`
  ADD PRIMARY KEY (`estimate_labour_id`);

--
-- Indexes for table `tbl_estimate_sublet`
--
ALTER TABLE `tbl_estimate_sublet`
  ADD PRIMARY KEY (`sublet_id`);

--
-- Indexes for table `tbl_estimate_tax`
--
ALTER TABLE `tbl_estimate_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tbl_estimate_vehicle_number`
--
ALTER TABLE `tbl_estimate_vehicle_number`
  ADD PRIMARY KEY (`estimate_id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_new_id`);

--
-- Indexes for table `tbl_invoice_image`
--
ALTER TABLE `tbl_invoice_image`
  ADD PRIMARY KEY (`invoice_image_id`);

--
-- Indexes for table `tbl_invoice_labour`
--
ALTER TABLE `tbl_invoice_labour`
  ADD PRIMARY KEY (`tbl_invoice_labour_id`);

--
-- Indexes for table `tbl_invoice_parts`
--
ALTER TABLE `tbl_invoice_parts`
  ADD PRIMARY KEY (`tbl_invoice_labour_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_cost`
--
ALTER TABLE `tbl_item_cost`
  ADD PRIMARY KEY (`item_r_id`);

--
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`item_history_id`);

--
-- Indexes for table `tbl_job_details`
--
ALTER TABLE `tbl_job_details`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  ADD PRIMARY KEY (`job_item_id`);

--
-- Indexes for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  ADD PRIMARY KEY (`job_labour_id`);

--
-- Indexes for table `tbl_job_sublet`
--
ALTER TABLE `tbl_job_sublet`
  ADD PRIMARY KEY (`sublet_id`);

--
-- Indexes for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  ADD PRIMARY KEY (`labour_id`);

--
-- Indexes for table `tbl_labour_paying`
--
ALTER TABLE `tbl_labour_paying`
  ADD PRIMARY KEY (`labour_paying_id`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `tbl_vehicle_details`
--
ALTER TABLE `tbl_vehicle_details`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `tbl_vehicle_images`
--
ALTER TABLE `tbl_vehicle_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_additinal_image`
--
ALTER TABLE `tbl_additinal_image`
  MODIFY `image_additinal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_advance`
--
ALTER TABLE `tbl_advance`
  MODIFY `advance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking_web`
--
ALTER TABLE `tbl_booking_web`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_estimate_item`
--
ALTER TABLE `tbl_estimate_item`
  MODIFY `estimate_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tbl_estimate_labour`
--
ALTER TABLE `tbl_estimate_labour`
  MODIFY `estimate_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_estimate_sublet`
--
ALTER TABLE `tbl_estimate_sublet`
  MODIFY `sublet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_estimate_tax`
--
ALTER TABLE `tbl_estimate_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_estimate_vehicle_number`
--
ALTER TABLE `tbl_estimate_vehicle_number`
  MODIFY `estimate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_new_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_invoice_image`
--
ALTER TABLE `tbl_invoice_image`
  MODIFY `invoice_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_invoice_labour`
--
ALTER TABLE `tbl_invoice_labour`
  MODIFY `tbl_invoice_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_invoice_parts`
--
ALTER TABLE `tbl_invoice_parts`
  MODIFY `tbl_invoice_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `tbl_item_cost`
--
ALTER TABLE `tbl_item_cost`
  MODIFY `item_r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `item_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `tbl_job_details`
--
ALTER TABLE `tbl_job_details`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  MODIFY `job_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  MODIFY `job_labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_job_sublet`
--
ALTER TABLE `tbl_job_sublet`
  MODIFY `sublet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  MODIFY `labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_labour_paying`
--
ALTER TABLE `tbl_labour_paying`
  MODIFY `labour_paying_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_vehicle_details`
--
ALTER TABLE `tbl_vehicle_details`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_vehicle_images`
--
ALTER TABLE `tbl_vehicle_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
