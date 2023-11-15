-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 11:10 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additinal_image`
--

CREATE TABLE `tbl_additinal_image` (
  `image_additinal_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `img_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advance`
--

CREATE TABLE `tbl_advance` (
  `advance_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `advance_payment` varchar(50) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `advance_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `client_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `idcard_number` varchar(50) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `how_to_know` varchar(50) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `remark` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_labour`
--

CREATE TABLE `tbl_estimate_labour` (
  `estimate_labour_id` int(11) NOT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `estimate_fru` varchar(255) DEFAULT NULL,
  `labour_name_1` mediumtext DEFAULT NULL,
  `labour_name_2` mediumtext DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `note` mediumtext DEFAULT NULL,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_vehicle_number`
--

CREATE TABLE `tbl_estimate_vehicle_number` (
  `estimate_id` int(11) NOT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `img_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_new_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `client_address` mediumtext DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `licens_no` varchar(255) DEFAULT NULL,
  `chassis_no` varchar(255) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
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
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_image`
--

CREATE TABLE `tbl_invoice_image` (
  `invoice_image_id` int(11) NOT NULL,
  `job_id` varchar(255) DEFAULT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `invoice_ss` varchar(100) DEFAULT NULL,
  `invoice_ss_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_labour`
--

CREATE TABLE `tbl_invoice_labour` (
  `tbl_invoice_labour_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `labour_id` varchar(255) DEFAULT NULL,
  `labour_details` mediumtext DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_parts`
--

CREATE TABLE `tbl_invoice_parts` (
  `tbl_invoice_labour_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `part_labour_id` varchar(255) DEFAULT NULL,
  `part_details` mediumtext DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `remark` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `item_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `part_name`, `part_location`, `part_number`, `part_cost`, `selling_cost`, `discount`, `quantity`, `remark`, `stat`, `item_date`) VALUES
(2, 'Engine mount left ', '', '22117935149', '23658.8', '29600', '0', '4', '', '1', '2021-07-11 18:49:04'),
(3, 'Engine mount right ', '', '22116785602', '23658.8', '29600', '0', '4', '22117935142', '1', '2021-07-11 18:49:33'),
(4, 'Boot shock Right ', '', '51247204367', '11206.8', '14200', '0', '5', '', '1', '0000-00-00 00:00:00'),
(5, 'Boot switch ', '', '51247463161', '6537.3', '8200', '0', '6', '', '1', '0000-00-00 00:00:00'),
(6, 'Coolent connector ', '', '11127810707', '3735.6', '4800', '0', '5', '', '1', '0000-00-00 00:00:00'),
(7, 'Fronr Brake pad set', '', '34116858047', '20857.1', '26500', '0', '4', '', '1', '2021-08-07 14:46:23'),
(8, 'Rear Brake pad set ', '', '34216862202', '17744.1', '22800', '0', '5', '', '1', '0000-00-00 00:00:00'),
(9, 'Brake pad sensor front', '', '34356791958', '3891.25', '4900', '0', '5', '', '1', '0000-00-00 00:00:00'),
(10, 'Brake pad sensor rear', '', '34356791962', '3268.65', '4200', '0', '5', '', '1', '0000-00-00 00:00:00'),
(11, 'Blower Moter', '', '64119242608', '77825', '97350', '0', '1', '', '1', '0000-00-00 00:00:00'),
(12, 'Diff mount', '', '33316797238', '7159.9', '9400', '0', '4', '', '1', '0000-00-00 00:00:00'),
(13, 'A\\C vent rear middle', '', '64229172167', '23658.8', '29600', '0', '3', '', '1', '0000-00-00 00:00:00'),
(14, 'door lock rear left', '', '51227202147', '37978.6', '48200', '0', '1', '', '1', '0000-00-00 00:00:00'),
(15, 'door lock rear right', '', '51227202148', '37978.6', '48200', '0', '1', '', '1', '0000-00-00 00:00:00'),
(16, 'Damper pully', '', '11237823191', '98059.5', '122000', '0', '1', '', '1', '0000-00-00 00:00:00'),
(17, 'Oil filter', '', '11428507683', '4046.9', '5200', '0', '9', '', '1', '2021-08-07 14:46:01'),
(18, 'Diesel filter', '', '13327811227', '9027.7', '11500', '0', '3', '', '1', '0000-00-00 00:00:00'),
(19, 'horn - high', '', '61337293825', '11829.4', '14800', '0', '1', '', '1', '0000-00-00 00:00:00'),
(20, 'diesel filter and heater', '', '13328576972', '46072.4', '58500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(21, 'Groommet', '', '51719151866', '4825.15', '7000', '0', '4', '', '1', '0000-00-00 00:00:00'),
(22, 'Oil filter housing gasket', '', '11428516396', '3268.65', '4400', '0', '5', '', '1', '0000-00-00 00:00:00'),
(23, 'Manifold gasket', '', '11617812938', '9805.95', '12300', '0', '4', '', '1', '0000-00-00 00:00:00'),
(24, 'horn [bmw] low', '', '61337293826', '12140.7', '15300', '0', '1', '', '1', '0000-00-00 00:00:00'),
(25, 'Balancng sharft seal', '', '11117797932', '1867.8', '2500', '0', '10', '', '1', '0000-00-00 00:00:00'),
(26, 'Valve cover gasket set ', '', '11128511814', '6848.6', '8700', '0', '4', '', '1', '0000-00-00 00:00:00'),
(27, 'A\\C flap moter', '', '64119242058', '12452', '16200', '0', '1', '64119319037', '1', '0000-00-00 00:00:00'),
(28, 'Gasket ', '', '11428580680', '7159.9', '9200', '0', '5', '', '1', '0000-00-00 00:00:00'),
(29, 'Gasket ', '', '11428580681', '5603.4', '7000', '0', '5', '', '1', '0000-00-00 00:00:00'),
(30, 'Gasket ', '', '11428580682', '7159.9', '9100', '0', '5', '', '1', '0000-00-00 00:00:00'),
(31, 'Prop Coupling', '', '26117605629', '33931.7', '44200', '0', '3', '26117610061', '1', '0000-00-00 00:00:00'),
(32, 'Lower arms', '', '31126775971', '42025.5', '56250', '0', '2', '', '1', '0000-00-00 00:00:00'),
(33, 'Lower arms', '', '31126775972', '42025.5', '56250', '0', '2', '', '1', '0000-00-00 00:00:00'),
(34, 'BOLT', '', '33316767586', '2256.925', '2900', '0', '1', '', '1', '0000-00-00 00:00:00'),
(35, 'Wishbone arm', '', '31126794203', '57590.5', '74350', '0', '2', '', '1', '0000-00-00 00:00:00'),
(36, 'Wishbone arm', '', '31126794204', '57590.5', '74350', '0', '2', '', '1', '0000-00-00 00:00:00'),
(37, 'HEX LOCKING NUT ', '', '33306760349', '544.775', '700', '0', '6', '', '1', '0000-00-00 00:00:00'),
(38, 'BMW O-RING (20X2.5)', '', '11127823944', '1556.5', '2100', '0', '8', '', '1', '0000-00-00 00:00:00'),
(39, 'Decoupling element', '', '11127809138', '1307.46', '1750', '0', '6', '', '1', '0000-00-00 00:00:00'),
(40, 'Drive belt', '', '11288519128', '7004.25', '8820', '0', '3', '', '1', '0000-00-00 00:00:00'),
(41, 'BOLT', '', '11238651643', '544.775', '720', '0', '3', '11238585220', '1', '0000-00-00 00:00:00'),
(42, 'Front brake pad', '', '34116780711', '22413.6', '28500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(43, 'Front brake pad sensor', '', '34356792562', '4046.9', '5200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(44, 'Front brake Disc', '', '34116792219', '18055.4', '24400', '0', '2', '', '1', '0000-00-00 00:00:00'),
(45, 'Engine mount left', '', '22116768799', '22413.6', '29200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(46, 'Engine mount right', '', '22116768800', '22413.6', '29200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(47, 'Valve cover Gasket', '', '11127807017', '6848.6', '8900', '0', '1', '', '1', '0000-00-00 00:00:00'),
(48, 'Balancing sharft seal', '', '11117797932', '1867.8', '2450', '0', '6', '', '1', '0000-00-00 00:00:00'),
(49, ' Damper Pully', '', '11237823191', '98059.5', '122000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(50, 'Rear Brake Disc', '', '34216792227', '14942.4', '18700', '0', '2', '', '1', '0000-00-00 00:00:00'),
(51, 'Oil Filter', '', '11428575211', '3579.95', '4700', '0', '20', '', '1', '0000-00-00 00:00:00'),
(52, 'rear Brake pad Set ', '', '34216873093', '15876.3', '21400', '0', '4', '', '1', '0000-00-00 00:00:00'),
(53, 'Wheel speed sensor Rear', '', '34526884421', '26149.2', '34300', '0', '10', '', '1', '0000-00-00 00:00:00'),
(54, 'Coolent pump ', '', '11518631692', '39846.4', '52500', '0', '1', '', '1', '0000-00-00 00:00:00'),
(55, 'Front brake pad', '', '34116874331', '16031.95', '23200', '0', '4', '', '1', '0000-00-00 00:00:00'),
(56, 'Front brake pad sensor', '', '34356792289', '3113', '4100', '0', '4', '', '1', '0000-00-00 00:00:00'),
(57, 'Wheel speed sensor front', '', '34526869320', '23970.1', '32500', '0', '6', '', '1', '0000-00-00 00:00:00'),
(58, 'heat management module', '', '11537644811', '41091.6', '52000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(59, ' Engine Mount Left', '', '22116864335', '27394.4', '36500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(60, 'Engine Mount Right', '', '22116864336', '27394.4', '36500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(61, 'Electrical Vacuum Pump', '', '34336860881', '101172.5', '128000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(62, 'vapor recorvory valve', '', '16137303949', '45138.5', '57200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(63, 'Wheel speed sensor Rear', '', '34526771777', '27394.4', '35200', '0', '6', '', '1', '0000-00-00 00:00:00'),
(64, 'Fuel tank control unit', '', '16149425925', '37356', '48200', '0', '1', '', '1', '0000-00-00 00:00:00'),
(65, 'Rear brake pad', '', '34216776937', '17432.8', '23500', '0', '4', '', '1', '0000-00-00 00:00:00'),
(66, 'Starter belt', '', '11287633713', '12763.3', '18500', '0', '6', '', '1', '0000-00-00 00:00:00'),
(67, 'Wheel speed sensor Front', '', '34526771776', '25526.6', '34750', '0', '2', '', '1', '0000-00-00 00:00:00'),
(68, 'Air shock Rear', '', '37126795013', '93390', '125000', '0', '4', '', '1', '0000-00-00 00:00:00'),
(69, 'Oil filter', '', '11427953129', '3113', '4500', '0', '10', '', '1', '0000-00-00 00:00:00'),
(70, 'Air supply pump [WABCO]', '', '37206875177', '255266', '295000', '0', '1', '', '1', '0000-00-00 00:00:00'),
(71, 'Front brake pads', '', '34116852253', '31752.6', '39700', '0', '3', '', '1', '0000-00-00 00:00:00'),
(72, 'Front brake pad sensor', '', '34356792567', '4202.55', '5400', '0', '3', '', '1', '0000-00-00 00:00:00'),
(73, 'Oil Filter', '', '11428593186', '4513.85', '5700', '0', '8', '', '1', '0000-00-00 00:00:00'),
(74, 'Intake Manifold Gasket', '', '11617812938', '9805.95', '12800', '0', '1', '', '1', '0000-00-00 00:00:00'),
(75, 'Air Filter', '', '13718513944', '9339', '11700', '0', '6', '', '1', '0000-00-00 00:00:00'),
(76, 'Engine mount left', '', '22316853453', '25526.6', '32000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(77, 'Engine mount right', '', '22116885934', '28017', '35000', '0', '2', '22118835572', '1', '0000-00-00 00:00:00'),
(78, 'Engine mount down', '', '22116885788', '10272.9', '14000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(79, 'Lower arm right', '', '31126879844', '26771.8', '34200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(80, 'Lower arm left', '', '31126879843', '26771.8', '34200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(81, 'lower arm bush  left', '', '31126882843', '21168.4', '26500', '0', '2', '31128831645', '1', '0000-00-00 00:00:00'),
(82, 'lower arm bush  right', '', '31126882844', '21168.4', '26500', '0', '2', '31128831646', '1', '0000-00-00 00:00:00'),
(83, 'Front Brake Pad', '', '34106860019', '24281.4', '30500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(84, 'Front Brake Pad sensor', '', '34356888167', '5603.4', '7000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(85, 'Wiper Blades', '', '61615A27D69', '9961.6', '14000', '0', '3', '', '1', '0000-00-00 00:00:00'),
(86, 'Heat management module', '', '11538631943', '56967.9', '75600', '0', '3', '11538843405', '1', '0000-00-00 00:00:00'),
(87, 'Electrical expanion Valve front - Hella', '', '64119361709', '20545.8', '27000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(88, 'cell supervision circuit', '', '61278482940', '33620.4', '42100', '0', '6', '', '1', '0000-00-00 00:00:00'),
(89, 'Pressure temperature sensor', '', '16117361966', '35799.5', '45500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(90, 'Air Flap bottom', '', '51137497285', '36733.4', '46000', '0', '1', '', '1', '0000-00-00 00:00:00'),
(91, 'Ac filter', '', '64116996208', '26460.5', '35200', '0', '4', '64115A1BDB6', '1', '0000-00-00 00:00:00'),
(92, 'Spark plug   ', '', '12120040551', '3268.65', '4100', '0', '12', '', '1', '0000-00-00 00:00:00'),
(93, 'Oil filters  ', '', '11428575211', '3579.95', '4650', '0', '10', '', '1', '0000-00-00 00:00:00'),
(94, 'Jack pad', '', '51717065919', '3891.25', '5000', '0', '4', '', '1', '0000-00-00 00:00:00'),
(95, 'Brake fluid DOT4 LV, low viscosity', '', '83132405977', '2801.7', '3700', '0', '6', '', '1', '0000-00-00 00:00:00'),
(96, 'Wiper blade  ', '', '61612447934', '12607.65', '16000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(97, 'Gear box oil  litres', '', '83222289720', '12452', '15800', '0', '12', '', '1', '2021-08-15 17:54:47'),
(98, 'gear box oil sump.', '', '24118612901', '42959.4', '55000', '0', '1', '24115A13115', '1', '0000-00-00 00:00:00'),
(99, 'Front Brake pad sensor', '', '34356861807', '5759.05', '7200', '0', '2', '34356890788', '1', '0000-00-00 00:00:00'),
(100, 'Air Flap Bottom', '', '51748091762', '46695', '61500', '0', '1', '', '1', '0000-00-00 00:00:00'),
(101, 'Air Filter', '', '13718577171', '8249.45', '10500', '0', '6', '', '1', '0000-00-00 00:00:00'),
(102, 'BMW Antifreeze', '', '83192211191', '2179.1', '2800', '0', '15', '83512355290', '1', '0000-00-00 00:00:00'),
(103, 'Pins', '', '61132359999', '3579.95', '5000', '0', '10', '', '1', '0000-00-00 00:00:00'),
(104, 'Brake pads sensor front', '', '34356890788', '5759.05', '7200', '0', '4', '', '1', '0000-00-00 00:00:00'),
(105, 'Rear Brake pads', '', '34216867175', '23347.5', '29500', '0', '2', '', '1', '0000-00-00 00:00:00'),
(106, 'Rear brake pad sensor', '', '34356890791', '4825.15', '6200', '0', '2', '', '1', '0000-00-00 00:00:00'),
(107, 'Oil filter', '', '11428570590', '3735.6', '4800', '0', '10', '', '1', '0000-00-00 00:00:00'),
(108, 'Rear Brake pad', '', '34216871299', '12452', '15800', '0', '2', '', '1', '0000-00-00 00:00:00'),
(109, 'Air Filter', '', '13718513944', '9339', '11700', '0', '5', '', '1', '0000-00-00 00:00:00'),
(110, 'Front brake pad', '', '34106884263', '4202.55', '18000', '0', '2', '', '1', '0000-00-00 00:00:00'),
(111, 'Expanding rivet, black', '', '07147293278', '342.43', '450', '0', '200', '', '1', '0000-00-00 00:00:00'),
(112, 'Expanding rivet, ', '', '51118174185', '59.147', '100', '0', '200', '', '1', '0000-00-00 00:00:00'),
(113, 'Expanding rivet, black', '', '51777171004', '155.65', '300', '0', '200', '', '1', '0000-00-00 00:00:00'),
(114, 'test1', 'new', 'sfasf', '10000', '20000', '0', '18', 'fsa fsa ', '1', '2021-08-16 05:28:32'),
(115, 'test2', 'fsafasf', '44', '1222', '12122', '0', '0', 'ng f ', '1', '2021-08-16 05:28:43');

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
  `remark` mediumtext DEFAULT NULL,
  `part_discount` varchar(255) DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `labour_name_1` mediumtext DEFAULT NULL,
  `labour_name_2` mediumtext DEFAULT NULL,
  `labour_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour`
--

CREATE TABLE `tbl_labour` (
  `labour_id` int(11) NOT NULL,
  `labour_name` varchar(255) DEFAULT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_labour`
--

INSERT INTO `tbl_labour` (`labour_id`, `labour_name`, `fru`, `datetime`) VALUES
(1, 'Oil Service', '5', '2021-02-07 18:42:35'),
(2, 'Brake Service', '15', '2021-02-07 18:43:06'),
(3, 'Replace Tyres', '10', '2021-02-07 18:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_labour_paying`
--

CREATE TABLE `tbl_labour_paying` (
  `labour_paying_id` int(11) NOT NULL,
  `fru` varchar(255) DEFAULT NULL,
  `pay_amount` varchar(255) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `note` mediumtext DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_type` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `status_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `note` mediumtext DEFAULT NULL,
  `additional_price` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `note` mediumtext DEFAULT NULL,
  `stat` varchar(3) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_details`
--

CREATE TABLE `tbl_vehicle_details` (
  `v_id` int(11) NOT NULL,
  `reg_email` mediumtext DEFAULT NULL,
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
  `display` mediumtext DEFAULT NULL,
  `display_remark` mediumtext DEFAULT NULL,
  `interior_lights` mediumtext DEFAULT NULL,
  `interior_lights_remark` mediumtext DEFAULT NULL,
  `signals` mediumtext DEFAULT NULL,
  `signals_remark` mediumtext DEFAULT NULL,
  `steering` mediumtext DEFAULT NULL,
  `steering_remark` mediumtext DEFAULT NULL,
  `hand_brake` mediumtext DEFAULT NULL,
  `hand_brake_remark` mediumtext DEFAULT NULL,
  `aircon` mediumtext DEFAULT NULL,
  `aircon_remark` mediumtext DEFAULT NULL,
  `wiper_blades` mediumtext DEFAULT NULL,
  `wiper_blades_remark` mediumtext DEFAULT NULL,
  `windows_glass` mediumtext DEFAULT NULL,
  `windows_glass_remark` mediumtext DEFAULT NULL,
  `replace_microfilter` mediumtext DEFAULT NULL,
  `replace_microfilter_remark` mediumtext DEFAULT NULL,
  `coolant` mediumtext DEFAULT NULL,
  `coolant_remark` mediumtext DEFAULT NULL,
  `engine_oil` mediumtext DEFAULT NULL,
  `engine_oil_remark` mediumtext DEFAULT NULL,
  `v_belt` mediumtext DEFAULT NULL,
  `v_belt_remark` mediumtext DEFAULT NULL,
  `noticeble_leaks` mediumtext DEFAULT NULL,
  `noticeble_leaks_remark` mediumtext DEFAULT NULL,
  `damage_animals` mediumtext DEFAULT NULL,
  `damage_animals_remark` mediumtext DEFAULT NULL,
  `annual_check` mediumtext DEFAULT NULL,
  `shock` mediumtext DEFAULT NULL,
  `shock_remark` mediumtext DEFAULT NULL,
  `tyre_tread` mediumtext DEFAULT NULL,
  `tyre_tread_remark` mediumtext DEFAULT NULL,
  `engine_gearbox` mediumtext DEFAULT NULL,
  `engine_gearbox_remark` mediumtext DEFAULT NULL,
  `front_axle` mediumtext DEFAULT NULL,
  `front_axle_remark` mediumtext DEFAULT NULL,
  `front_brake` mediumtext DEFAULT NULL,
  `front_brake_remark` mediumtext DEFAULT NULL,
  `rear_axle` mediumtext DEFAULT NULL,
  `rear_axle_remark` mediumtext DEFAULT NULL,
  `rear_brake` mediumtext DEFAULT NULL,
  `rear_brake_remark` mediumtext DEFAULT NULL,
  `brake_lines` mediumtext DEFAULT NULL,
  `brake_lines_remark` mediumtext DEFAULT NULL,
  `exhaust_system` mediumtext DEFAULT NULL,
  `exhaust_system_remark` mediumtext DEFAULT NULL,
  `fuel_tank` mediumtext DEFAULT NULL,
  `fuel_tank_remark` mediumtext DEFAULT NULL,
  `comments` mediumtext DEFAULT NULL,
  `vehicle_screen` longblob DEFAULT NULL,
  `r_f_tyre_tread` mediumtext DEFAULT NULL,
  `r_b_tyre_tread` mediumtext DEFAULT NULL,
  `l_f_tyre_tread` mediumtext DEFAULT NULL,
  `l_b_tyre_tread` mediumtext DEFAULT NULL,
  `body_work` mediumtext DEFAULT NULL,
  `spare_wheel` mediumtext DEFAULT NULL,
  `jack` mediumtext DEFAULT NULL,
  `tools` mediumtext DEFAULT NULL,
  `cd` mediumtext DEFAULT NULL,
  `lighter` mediumtext DEFAULT NULL,
  `sim` mediumtext DEFAULT NULL,
  `extra` mediumtext DEFAULT NULL,
  `amount` mediumtext DEFAULT NULL,
  `pay` mediumtext DEFAULT NULL,
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
  `road_test_special_comment` mediumtext DEFAULT NULL,
  `reg_vehicle_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_images`
--

CREATE TABLE `tbl_vehicle_images` (
  `image_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `vehicle_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `video_id` int(11) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `vehicle_detail_id` varchar(255) DEFAULT NULL,
  `video_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`user_id`, `name`, `email`, `password`, `role`, `tel`, `create_date`) VALUES
(9, 'Admin', 'admin@mail.com', '$2y$10$MMMKgwps5FkKP9erlJhyQOYzSC2IrULzLeiFi7sfQv20LkCAjL9Mq', '1', '0764415555', '2020-08-12 13:30:20');

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
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`item_history_id`);

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
  MODIFY `advance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_estimate_item`
--
ALTER TABLE `tbl_estimate_item`
  MODIFY `estimate_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_estimate_labour`
--
ALTER TABLE `tbl_estimate_labour`
  MODIFY `estimate_labour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_estimate_tax`
--
ALTER TABLE `tbl_estimate_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_estimate_vehicle_number`
--
ALTER TABLE `tbl_estimate_vehicle_number`
  MODIFY `estimate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_new_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_image`
--
ALTER TABLE `tbl_invoice_image`
  MODIFY `invoice_image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_labour`
--
ALTER TABLE `tbl_invoice_labour`
  MODIFY `tbl_invoice_labour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_parts`
--
ALTER TABLE `tbl_invoice_parts`
  MODIFY `tbl_invoice_labour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `item_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_item`
--
ALTER TABLE `tbl_job_item`
  MODIFY `job_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_labour`
--
ALTER TABLE `tbl_job_labour`
  MODIFY `job_labour_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_labour`
--
ALTER TABLE `tbl_labour`
  MODIFY `labour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_labour_paying`
--
ALTER TABLE `tbl_labour_paying`
  MODIFY `labour_paying_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicle_details`
--
ALTER TABLE `tbl_vehicle_details`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicle_images`
--
ALTER TABLE `tbl_vehicle_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
