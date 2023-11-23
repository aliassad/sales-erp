-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2017 at 05:35 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id450993_serp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `code` varchar(150) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `openingbalance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `code`, `type`, `currency`, `openingbalance`) VALUES
(1, 'Expence', 1, 1, 0),
(2, 'Mcb 1971', 2, 1, 25000),
(3, 'Faysal hassan 1550', 2, 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `accountcurrency`
--

CREATE TABLE `accountcurrency` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `accountcurrency`
--

INSERT INTO `accountcurrency` (`id`, `code`) VALUES
(1, 'PKR(Pakistan Rupee)'),
(2, 'AED(UAE  Dirham)'),
(3, 'CAD(Canadian Dollar)'),
(4, 'EUR(Euro)'),
(5, 'SAR(Saudi Riyal)'),
(6, 'USD(US Dollar)'),
(7, 'CAD(Canadian Dollar)'),
(8, 'EUR(Euro)'),
(9, 'SAR(Saudi Riyal)'),
(10, 'USD(US Dollar)');

-- --------------------------------------------------------

--
-- Table structure for table `accounttransaction`
--

CREATE TABLE `accounttransaction` (
  `id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `discription` text NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `accounttransaction`
--

INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES
(2, 3, '', 0, 0, '2017-05-02'),
(3, 3, 'Check', 0, 11000, '2017-05-17'),
(4, 1, 'online mcb 1797', 10000, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE `accounttypes` (
  `id` int(11) NOT NULL,
  `typename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `accounttypes`
--

INSERT INTO `accounttypes` (`id`, `typename`) VALUES
(1, 'CASH'),
(2, 'BANK');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `discount` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `ddate` date DEFAULT NULL,
  `notes` text,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `cid`, `discount`, `amount`, `date`, `ddate`, `notes`, `type`) VALUES
(5, 2, 200, 20701, '2017-04-08', '0000-00-00', 'this is a note to test', 'Invoice'),
(6, 3, 0, 520000, '2017-04-26', '0000-00-00', '', 'Invoice'),
(7, 4, 0, 10988, '2017-04-26', '0000-00-00', '', 'Invoice'),
(9, 3, 150, 960, '2017-04-26', '0000-00-00', '', 'Invoice'),
(10, 5, 0, 29531, '2017-04-26', '0000-00-00', '', 'Invoice'),
(11, 6, 0, 9746, '2017-04-26', '0000-00-00', '', 'Invoice'),
(12, 5, 0, 988875, '2017-04-26', '0000-00-00', '', 'Invoice'),
(13, 6, 0, 164813, '2017-04-26', '2017-04-25', '', 'Invoice'),
(16, 7, 0, 12088, '2017-04-29', '0000-00-00', '', 'Invoice'),
(17, 11, 0, 12088, '2017-04-29', '0000-00-00', '', 'Invoice'),
(18, 10, 0, 17581, '2017-04-29', '0000-00-00', '', 'Invoice'),
(20, 8, 0, 20304, '2017-04-29', '0000-00-00', '', 'Invoice'),
(21, 7, 30, 1099, '2017-05-02', '0000-00-00', '', 'Invoice'),
(22, 7, 30, 1099, '2017-05-02', '0000-00-00', '', 'Invoice'),
(23, 7, 0, 1099, '2017-05-02', '0000-00-00', '', 'Invoice'),
(24, 12, 0, 1450000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(25, 15, 0, 500000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(26, 15, 0, 500000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(27, 16, 0, 500000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(28, 16, 0, 500000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(29, 1, 0, 1000000, '2017-05-03', '0000-00-00', '', 'Invoice'),
(30, 1, 0, 13120, '2017-05-22', '2017-05-17', 'jhgjh', 'Invoice');

-- --------------------------------------------------------

--
-- Table structure for table `billamounts`
--

CREATE TABLE `billamounts` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Dumping data for table `billamounts`
--

INSERT INTO `billamounts` (`id`, `bid`, `amount`, `date`) VALUES
(1, 5, 501, '2017-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE `cheques` (
  `id` int(11) NOT NULL,
  `cheque_no` varchar(32) NOT NULL,
  `payment` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank` varchar(500) NOT NULL,
  `party` int(11) NOT NULL,
  `partytype` enum('C','V') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cheques_actions`
--

CREATE TABLE `cheques_actions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheques_actions`
--

INSERT INTO `cheques_actions` (`id`, `name`) VALUES
(1, 'Cleared'),
(2, 'Forward'),
(3, 'Failed'),
(4, 'Partial'),
(5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cheques_line_actions`
--

CREATE TABLE `cheques_line_actions` (
  `id` int(11) NOT NULL,
  `cheques_id` int(11) NOT NULL,
  `cheques_actions_id` int(11) NOT NULL,
  `party` int(11) DEFAULT NULL,
  `payment` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Gujranwala'),
(2, 'Karachi'),
(3, 'Ziauddin'),
(4, 'Okara'),
(5, 'Islamabad'),
(6, 'Rawalpindi'),
(7, 'Khanpur'),
(8, 'Jhelum'),
(9, 'Swabi'),
(10, 'Lahore'),
(11, 'Faisalabad'),
(12, 'Gujar Khan'),
(13, 'Attock'),
(14, 'Goth Abad Magsi'),
(15, 'Kasur'),
(16, 'Nangar'),
(17, 'Sheikhupura'),
(18, 'Sialkot'),
(19, 'Mandi Bahauddin'),
(20, 'Gujrat'),
(21, 'Wazirabad'),
(22, 'Narowal'),
(23, 'Sargodha'),
(24, 'Mianwali'),
(25, 'Daud Khel'),
(26, 'Bahawalpur'),
(27, 'Burewala'),
(28, 'Abbottabad'),
(29, 'Batgram'),
(30, 'Havelian'),
(31, 'Haripur'),
(32, 'Mansehra'),
(33, 'Hyderabad'),
(34, 'Miran Shah'),
(35, 'Peshawar'),
(37, 'Multan'),
(38, 'Quetta'),
(39, 'Kabirwala'),
(40, 'Fazal'),
(41, 'Clifton'),
(42, 'Sarwar'),
(43, 'New Mirpur'),
(44, 'Saddar'),
(45, 'Gulberg'),
(46, 'Gilgit'),
(47, 'Muzaffarabad'),
(48, 'Sarai Sidhu'),
(49, 'Dera Ghazi Khan'),
(50, 'Sahiwal'),
(51, 'Chakwal'),
(52, 'Bhimbar'),
(53, 'Sukkur'),
(54, 'Mandi'),
(55, 'Usman'),
(56, 'Charsadda'),
(57, 'Nowshera'),
(58, 'Mardan'),
(59, 'Mian Channu'),
(60, 'Khanewal'),
(61, 'Jhang Sadr'),
(62, 'Jhang City'),
(63, 'Toba Tek Singh'),
(64, 'Jhumra'),
(65, 'Daska'),
(66, 'Kohat'),
(67, 'Nankana Sahib'),
(68, 'Pindi'),
(69, 'Rawlakot'),
(70, 'Kamoki'),
(71, 'Shahdara'),
(72, 'Hafizabad'),
(73, 'Gulshan-e-Iqbal');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `lincenseType` int(11) DEFAULT NULL,
  `theme` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `city` varchar(500) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `openingbalance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `company`, `city`, `email`, `phone`, `address`, `openingbalance`) VALUES
(1, 'Walk In Customer', '', '', 'a@b.com', '0000-0000000', 'Walk In Customer', 0),
(5, 'Hussain', 'Hussain electric store', 'Jhelum', '', '0332-4958059 , 053-7603338', 'gulyana road kharia', 365),
(6, 'Chouhan', 'Chohan electric traders', 'New Mirpur', '', '', '\n', 34220),
(7, 'Riaz', '', '', '', '', '', 0),
(8, 'Main electric', '', '', '', '', '', 0),
(10, 'Al nafay electric', '', '', '', '', '', 0),
(11, 'German electric', '', '', '', '', '', 0),
(12, 'Ali usman', 'Perwaz', 'Gujrat', '', '0312401404', 'gt road gujrat', 2500000),
(17, 'Abdul-slam', 'Hi-class', 'Gujrat', '', '0553698745', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customerpayments`
--

CREATE TABLE `customerpayments` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `ptype` varchar(200) NOT NULL,
  `pdetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerpayments`
--

INSERT INTO `customerpayments` (`id`, `cid`, `amount`, `date`, `ptype`, `pdetail`) VALUES
(1, 2, 2000, '2017-04-08', 'Credit', 'dsdsad nmsa bdnsa '),
(2, 7, 2000, '2017-05-02', 'Credit', ''),
(3, 10, 30000, '2017-05-02', 'Credit', 'Standard chartered cheque'),
(4, 7, 5000, '2017-05-02', 'Credit', 'Standard chartered'),
(5, 12, 1000000, '2017-05-03', 'Credit', 'Online furrukh ijaz faysal'),
(6, 15, 200000, '2017-05-03', 'Credit', ''),
(7, 15, 800000, '2017-05-03', 'Credit', ''),
(8, 16, 700000, '2017-05-03', 'Credit', ''),
(9, 7, 6000, '2017-05-17', 'Credit', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `lineitem`
--

CREATE TABLE `lineitem` (
  `id` int(11) NOT NULL,
  `lid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `product` text,
  `rate` double DEFAULT NULL,
  `unit` double DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `amount` double DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `lineitem`
--

INSERT INTO `lineitem` (`id`, `lid`, `bid`, `product`, `rate`, `unit`, `discount`, `amount`, `status`) VALUES
(1, 1, 1, 'Test', 7667, 2, 10, 10350, 0),
(2, 1, 2, 'Test', 7667, 1.5, 10, 10350, 0),
(3, 1, 3, 'Test', 7667, 5, 10, 34502, 0),
(4, 1, 4, 'Test', 7667, 1, 10, 6900, 0),
(5, 2, 4, 'Test', 7667, 1, 10, 6900, 0),
(6, 1, 5, 'Test', 7667, 2, 10, 13801, 0),
(7, 2, 5, 'Test', 7667, 1, 10, 6900, 0),
(8, 1, 6, '3/29 (red)', 520, 1000, 0, 520000, 0),
(9, 1, 7, '3/29 (red)', 1465, 10, 25, 10988, 0),
(10, 1, 8, '', 1465, 10, 25, 10988, 0),
(11, 1, 9, '3/29 (red)', 1200, 1, 20, 960, 0),
(12, 1, 10, '3/29 (white)', 1465, 15, 25, 16481, 0),
(13, 2, 10, '7/36 (red)', 4350, 2, 25, 6525, 0),
(14, 3, 10, '7/36 (black)', 4350, 2, 25, 6525, 0),
(18, 1, 11, '3/29 (red)', 1465, 2, 22, 2796.818181818182, 0),
(19, 2, 11, '7/29 (red)', 2930, 1, 22, 2796.818181818182, 0),
(20, 3, 11, '7/36 (red)', 4350, 1, 22, 4152.272727272727, 0),
(21, 1, 12, '3/29 (red)', 1465, 900, 25, 988875, 0),
(22, 1, 13, '3/29 (black)', 1465, 150, 25, 164813, 0),
(23, 1, 14, '3/29 (red)', 1465, 5, 20, 5860, 0),
(24, 2, 14, '3/29 (black)', 1465, 2, 20, 2344, 0),
(25, 3, 14, '3/29 (white)', 1465, 1, 20, 1172, 0),
(26, 4, 14, '7/29 (red)', 2930, 2, 20, 4688, 0),
(27, 5, 14, '7/29 (black)', 2930, 2, 20, 4688, 0),
(28, 6, 14, '7/36 (red)', 1450, 0, 0, 1160, 0),
(35, 1, 15, '3/29 (red)', 1465, 5, 27, 7053.7037037037035, 0),
(36, 2, 15, '3/29 (black)', 1465, 2, 27, 2821.4814814814813, 0),
(37, 3, 15, '3/29 (white)', 1465, 1, 27, 1410.7407407407406, 0),
(38, 4, 15, '7/29 (red)', 2930, 2, 27, 5642.962962962963, 0),
(39, 5, 15, '7/29 (black)', 2930, 2, 27, 5642.962962962963, 0),
(40, 6, 15, '7/36 (red)', 1450, 0, 27, 1396.2962962962963, 0),
(41, 1, 16, '3/29 (yellow)', 1465, 2, 25, 2198, 0),
(42, 2, 16, '3/29 (white)', 1465, 6, 25, 6593, 0),
(43, 3, 16, '3/29 (blue)', 1465, 2, 25, 2198, 0),
(44, 4, 16, '3/29 (green)', 1465, 1, 25, 1099, 0),
(45, 1, 17, '3/29 (blue)', 1465, 2, 25, 2198, 0),
(46, 2, 17, '3/29 (white)', 1465, 6, 25, 6593, 0),
(47, 3, 17, '3/29 (yellow)', 1465, 2, 25, 2198, 0),
(48, 4, 17, '3/29 (green)', 1465, 1, 25, 1099, 0),
(49, 1, 18, '3/29 (red)', 1465, 8, 25, 8790, 0),
(50, 2, 18, '3/29 (black)', 1465, 6, 25, 6593, 0),
(51, 3, 18, '3/29 (white)', 1465, 2, 25, 2198, 0),
(57, 1, 19, '3/29 (red)', 1465, 3, 23, 4203.913043478261, 0),
(58, 2, 19, '3/29 (black)', 1465, 2, 23, 2802.608695652174, 0),
(59, 3, 19, '3/29 (white)', 1465, 5, 23, 7006.521739130435, 0),
(60, 4, 19, '7/29 (red)', 2930, 2, 23, 5605.217391304348, 0),
(61, 5, 19, '7/29 (black)', 2930, 2, 23, 5605.217391304348, 0),
(62, 1, 20, '3/29 (red)', 1465, 3, 23, 3384, 0),
(63, 2, 20, '3/29 (black)', 1465, 2, 23, 2256, 0),
(64, 3, 20, '3/29 (white)', 1465, 5, 23, 5640, 0),
(65, 4, 20, '7/29 (red)', 2930, 2, 23, 4512, 0),
(66, 5, 20, '7/29 (black)', 2930, 2, 23, 4512, 0),
(67, 1, 21, '3/29 (red)', 1465, 1, 25, 1099, 0),
(68, 1, 22, '3/29 (red)', 1465, 1, 25, 1099, 0),
(69, 1, 23, '3/29 (red)', 1465, 1, 25, 1099, 0),
(70, 1, 24, 'Copper', 580, 2500, 0, 1450000, 0),
(71, 1, 25, 'Copper', 500, 1000, 0, 500000, 0),
(72, 1, 26, 'Copper', 500, 1000, 0, 500000, 0),
(73, 1, 27, 'Copper', 500, 1000, 0, 500000, 0),
(74, 1, 28, 'Copper', 500, 1000, 0, 500000, 0),
(75, 1, 29, 'Copper', 500, 2000, 0, 1000000, 0),
(76, 1, 30, '3/29 (red)', 1465, 1, 25, 1099, 0),
(77, 2, 30, '7/36 (black)', 4350, 1, 25, 3263, 0),
(78, 3, 30, '7/36 (red)', 4350, 1, 25, 3263, 0),
(79, 4, 30, '7/29 (blue)', 2930, 1, 25, 2198, 0),
(80, 5, 30, '3/29 (green)', 1465, 1, 25, 1099, 0),
(81, 6, 30, '7/29 (yellow)', 2930, 1, 25, 2198, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `role` enum('Admin','Sale') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `pass`, `role`, `created_at`) VALUES
(1, 'ali@fastsoftwaresolutions.com', '5dd1a7f25b6cba5c0c56911572d978d4', 'Admin', '2017-02-02 17:45:35'),
(2, 'umar@serpadmin.com', '16f59172c43a2ee13072a05f91715b2e', 'Admin', '2017-02-02 17:45:35'),
(3, 'saleperson@nextcable.com', '0e8edc56e1a485cbcc3cf0df220de948', 'Sale', '2017-02-02 17:45:36'),
(4, 'hassan@serp.com', '92166cd0abd6ac12fb84fd9474e3df1d', 'Admin', '2017-04-08 17:32:53'),
(5, 'demo@serp.com', 'f1d42a73c25a0d75d73140e0c5744833', 'Admin', '2017-04-24 04:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `cardno` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mentry`
--

CREATE TABLE `mentry` (
  `id` int(11) NOT NULL,
  `mno` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `bid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodes`
--

CREATE TABLE `paymentmodes` (
  `id` int(11) NOT NULL,
  `name` enum('CASH','CHEQUE','BANK DEPOSIT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmodes`
--

INSERT INTO `paymentmodes` (`id`, `name`) VALUES
(1, 'CASH'),
(2, 'CHEQUE'),
(3, 'BANK DEPOSIT');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `des` text NOT NULL,
  `stock` double DEFAULT '0',
  `saleprice` double NOT NULL,
  `purchaseprice` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `minstock` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `des`, `stock`, `saleprice`, `purchaseprice`, `discount`, `minstock`) VALUES
(4, '3/29 (red)', 75, 1465, 900, 25, 200),
(5, '3/29 (black)', 838, 1465, 900, 25, 500),
(6, '3/29 (yellow)', 996, 1465, 900, 25, 200),
(7, '3/29 (green)', 997, 1465, 900, 25, 200),
(8, '3/29 (blue)', 996, 1465, 900, 25, 200),
(9, '3/29 (white)', 960, 1465, 900, 25, 200),
(10, '7/29 (red)', 993, 2930, 900, 25, 200),
(11, '7/29 (black)', 994, 2930, 900, 25, 200),
(12, '7/29 (yellow)', 999, 2930, 900, 25, 200),
(13, '3/29 (green)', 997, 2930, 900, 25, 200),
(14, '7/29 (blue)', 999, 2930, 900, 25, 200),
(15, '7/29 (blue)', 999, 2930, 900, 25, 200),
(16, '7/29 (white)', 1000, 2930, 900, 25, 200),
(17, '7/36 (red)', 996, 4350, 900, 25, 200),
(18, '7/36 (black)', 997, 4350, 900, 25, 200),
(19, '7/44 (black)', 1000, 7050, 900, 25, 200),
(20, '7/44 (red)', 1000, 7050, 900, 25, 200),
(21, '7/52 (red)', 1000, 9750, 900, 25, 200),
(22, '7/52 (black)', 1000, 9750, 900, 25, 200),
(23, '7/64 (red)', 1000, 15250, 900, 25, 200),
(24, '7/64 (black)', 1000, 15250, 900, 25, 200),
(25, 'PVC', 5000, 0, 0, 0, 1000),
(26, 'Copper ', 5000, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nic` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `companyname` text,
  `openingbalance` double DEFAULT '0',
  `city` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `nic`, `address`, `phone`, `email`, `img`, `companyname`, `openingbalance`, `city`, `created_at`) VALUES
(5, 'Hassan', '', '', '', '', '', 'mahboob steel inds', 8000, '', '2017-04-26 13:00:44'),
(10, 'Jawad', '', 'LAHORE', '', '', '', 'SILVER IMPEX', 0, 'Lahore', '2017-05-02 08:41:06'),
(11, 'Mehar azam', '', 'near cocacola factory', '023.001424', '', '', '', 1250000, 'Gujranwala', '2017-05-03 08:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `vendorpayments`
--

CREATE TABLE `vendorpayments` (
  `id` int(11) NOT NULL,
  `vid` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `ptype` varchar(200) NOT NULL,
  `pdetail` text NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `vendorpayments`
--

INSERT INTO `vendorpayments` (`id`, `vid`, `amount`, `date`, `ptype`, `pdetail`, `value`) VALUES
(1, 1, 1000, '2017-04-02', 'Debit', 'Dkjskdhkj', 0),
(2, 1, 100, '2017-04-08', 'Debit', 'Kjh skdfh kj', 0),
(3, 2, 575000, '2017-04-26', 'Debit', 'Payment tranfer from mcb umar to mcb silver inpex', 0),
(4, 4, 300000, '2017-04-26', 'Debit', 'Cash', 0),
(5, 4, 50000, '2017-04-26', 'Debit', 'Cash', 0),
(6, 4, 15000, '2017-04-26', 'Debit', 'To meezan silver impex ch#520', 0),
(7, 5, 6000, '2017-04-26', 'Debit', 'Cash', 0),
(8, 5, 1000, '2017-04-05', 'Debit', 'Cash', 0),
(9, 10, 75000, '2017-05-02', 'Debit', 'Cash', 0),
(10, 11, 1000000, '2017-05-03', 'Debit', 'Online furrukh ijaz faysal', 0),
(11, 11, 800000, '2017-05-03', 'Debit', '', 0),
(12, 15, 400000, '2017-05-03', 'Debit', '', 0),
(13, 5, 50000, '2017-05-18', 'Debit', '', 0),
(14, 10, 200000, '2017-05-18', 'Debit', 'Online ', 0),
(15, 5, 1000, '2017-05-18', 'Debit', 'Asd``', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendorpurchase`
--

CREATE TABLE `vendorpurchase` (
  `id` int(11) NOT NULL,
  `pid` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `vp` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `vno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `vendorpurchase`
--

INSERT INTO `vendorpurchase` (`id`, `pid`, `qty`, `rate`, `vp`, `date`, `vno`) VALUES
(1, '3/29 (red)', 1200, 1000, 2, '2017-04-26', 1),
(2, 'PVC', 2500, 150, 10, '2017-05-02', 2),
(3, 'Copper', 5000, 510, 11, '2017-05-03', 3),
(4, 'Copper', 1000, 500, 12, '2017-05-03', 4),
(5, 'Copper', 1000, 500, 13, '2017-05-03', 5),
(6, 'Copper', 1000, 500, 14, '2017-05-03', 6),
(7, 'Copper', 1000, 500, 14, '2017-05-03', 7),
(8, 'Copper', 1000, 500, 15, '2017-05-03', 8),
(9, 'Copper', 1000, 500, 15, '2017-05-03', 9);

-- --------------------------------------------------------

--
-- Table structure for table `wicustomer`
--

CREATE TABLE `wicustomer` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `cellno` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `wicustomer`
--

INSERT INTO `wicustomer` (`id`, `name`, `cellno`) VALUES
(1, 'Test ', ''),
(2, 'Shj', ''),
(3, '', ''),
(4, '', ''),
(5, 'Abid grafix zone', '0300-7462046'),
(6, 'Abid grafix zone', ''),
(7, '', ''),
(8, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `currency` (`currency`);

--
-- Indexes for table `accountcurrency`
--
ALTER TABLE `accountcurrency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounttransaction`
--
ALTER TABLE `accounttransaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `accounttypes`
--
ALTER TABLE `accounttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_ibfk_1` (`cid`);

--
-- Indexes for table `billamounts`
--
ALTER TABLE `billamounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billamounts_ibfk_1` (`bid`);

--
-- Indexes for table `cheques`
--
ALTER TABLE `cheques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheques_actions`
--
ALTER TABLE `cheques_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheques_line_actions`
--
ALTER TABLE `cheques_line_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_ibfk_1` (`theme`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerpayments`
--
ALTER TABLE `customerpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lineitem`
--
ALTER TABLE `lineitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lineitem_ibfk_1` (`bid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentry`
--
ALTER TABLE `mentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendorpayments`
--
ALTER TABLE `vendorpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vid` (`vid`);

--
-- Indexes for table `vendorpurchase`
--
ALTER TABLE `vendorpurchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vid` (`vp`),
  ADD KEY `pu` (`pid`);

--
-- Indexes for table `wicustomer`
--
ALTER TABLE `wicustomer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `accountcurrency`
--
ALTER TABLE `accountcurrency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `accounttransaction`
--
ALTER TABLE `accounttransaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `billamounts`
--
ALTER TABLE `billamounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cheques_actions`
--
ALTER TABLE `cheques_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cheques_line_actions`
--
ALTER TABLE `cheques_line_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `customerpayments`
--
ALTER TABLE `customerpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lineitem`
--
ALTER TABLE `lineitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mentry`
--
ALTER TABLE `mentry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vendorpayments`
--
ALTER TABLE `vendorpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `vendorpurchase`
--
ALTER TABLE `vendorpurchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `wicustomer`
--
ALTER TABLE `wicustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
