-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2017 at 06:59 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `serp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(11) NOT NULL,
  `code` varchar(150) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `openingbalance` decimal(10,0) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `code`, `type`, `currency`, `openingbalance`) VALUES
(1, 'Expence', 1, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `accountcurrency`
--

CREATE TABLE IF NOT EXISTS `accountcurrency` (
`id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=11 ;

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

CREATE TABLE IF NOT EXISTS `accounttransaction` (
`id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `discription` text NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accounttransaction`
--

INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES
(1, 1, 'Xyx bill n0 5', 0, 5000, '2017-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE IF NOT EXISTS `accounttypes` (
`id` int(11) NOT NULL,
  `typename` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `bill` (
`id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `discount` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `ddate` date DEFAULT NULL,
  `notes` text,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `cid`, `discount`, `amount`, `date`, `ddate`, `notes`, `type`) VALUES
(5, 2, '200', '20701', '2017-04-08', '0000-00-00', 'this is a note to test', 'Invoice');

-- --------------------------------------------------------

--
-- Table structure for table `billamounts`
--

CREATE TABLE IF NOT EXISTS `billamounts` (
`id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- Dumping data for table `billamounts`
--

INSERT INTO `billamounts` (`id`, `bid`, `amount`, `date`) VALUES
(1, 5, 501, '2017-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
`id` int(11) NOT NULL,
  `cheque_no` varchar(32) NOT NULL,
  `payment` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank` varchar(500) NOT NULL,
  `party` int(11) NOT NULL,
  `partytype` enum('C','V') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cheques_actions`
--

CREATE TABLE IF NOT EXISTS `cheques_actions` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `cheques_line_actions` (
`id` int(11) NOT NULL,
  `cheques_id` int(11) NOT NULL,
  `cheques_actions_id` int(11) NOT NULL,
  `party` int(11) DEFAULT NULL,
  `payment` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
`id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

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

CREATE TABLE IF NOT EXISTS `company` (
`id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `lincenseType` int(11) DEFAULT NULL,
  `theme` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `city` varchar(500) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `openingbalance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `company`, `city`, `email`, `phone`, `address`, `openingbalance`) VALUES
(1, 'Walk In Customer', '', '', 'a@b.com', '0000-0000000', 'Walk In Customer', 0),
(2, 'Testjhgjh n', '', 'Chakwal', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customerpayments`
--

CREATE TABLE IF NOT EXISTS `customerpayments` (
`id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `ptype` varchar(200) NOT NULL,
  `pdetail` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customerpayments`
--

INSERT INTO `customerpayments` (`id`, `cid`, `amount`, `date`, `ptype`, `pdetail`) VALUES
(1, 2, 2000, '2017-04-08', 'CASH', 'dsdsad nmsa bdnsa ');

-- --------------------------------------------------------

--
-- Table structure for table `lineitem`
--

CREATE TABLE IF NOT EXISTS `lineitem` (
`id` int(11) NOT NULL,
  `lid` int(11) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `product` text,
  `rate` double DEFAULT NULL,
  `unit` double DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `amount` double DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

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
(7, 2, 5, 'Test', 7667, 1, 10, 6900, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `role` enum('Admin','Sale') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `pass`, `role`, `created_at`) VALUES
(1, 'ali@fastsoftwaresolutions.com', '5dd1a7f25b6cba5c0c56911572d978d4', 'Admin', '2017-02-02 17:45:35'),
(2, 'umar@serpadmin.com', '16f59172c43a2ee13072a05f91715b2e', 'Admin', '2017-02-02 17:45:35'),
(3, 'saleperson@nextcable.com', '0e8edc56e1a485cbcc3cf0df220de948', 'Sale', '2017-02-02 17:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`id` int(11) NOT NULL,
  `cardno` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mentry`
--

CREATE TABLE IF NOT EXISTS `mentry` (
`id` int(11) NOT NULL,
  `mno` int(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `bid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodes`
--

CREATE TABLE IF NOT EXISTS `paymentmodes` (
`id` int(11) NOT NULL,
  `name` enum('CASH','CHEQUE','BANK DEPOSIT') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `des` text NOT NULL,
  `stock` double DEFAULT '0',
  `saleprice` double NOT NULL,
  `purchaseprice` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `minstock` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `des`, `stock`, `saleprice`, `purchaseprice`, `discount`, `minstock`) VALUES
(1, 'Test', -0.5, 7667, 65, 10, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
`id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `nic`, `address`, `phone`, `email`, `img`, `companyname`, `openingbalance`, `city`, `created_at`) VALUES
(1, 'Test', '', '', '', '', '', '', 500, 'Sialkot', '2017-02-08 18:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `vendorpayments`
--

CREATE TABLE IF NOT EXISTS `vendorpayments` (
`id` int(11) NOT NULL,
  `vid` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `ptype` varchar(200) NOT NULL,
  `pdetail` text NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendorpayments`
--

INSERT INTO `vendorpayments` (`id`, `vid`, `amount`, `date`, `ptype`, `pdetail`, `value`) VALUES
(1, 1, 1000, '2017-04-02', 'Debit', 'Dkjskdhkj', 0),
(2, 1, 100, '2017-04-08', 'Debit', 'Kjh skdfh kj', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendorpurchase`
--

CREATE TABLE IF NOT EXISTS `vendorpurchase` (
`id` int(11) NOT NULL,
  `pid` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` decimal(10,0) NOT NULL,
  `vp` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `vno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wicustomer`
--

CREATE TABLE IF NOT EXISTS `wicustomer` (
`id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `cellno` varchar(500) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wicustomer`
--

INSERT INTO `wicustomer` (`id`, `name`, `cellno`) VALUES
(1, 'Test ', ''),
(2, 'Shj', ''),
(3, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`), ADD KEY `type` (`type`), ADD KEY `currency` (`currency`);

--
-- Indexes for table `accountcurrency`
--
ALTER TABLE `accountcurrency`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounttransaction`
--
ALTER TABLE `accounttransaction`
 ADD PRIMARY KEY (`id`), ADD KEY `aid` (`aid`);

--
-- Indexes for table `accounttypes`
--
ALTER TABLE `accounttypes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
 ADD PRIMARY KEY (`id`), ADD KEY `bill_ibfk_1` (`cid`);

--
-- Indexes for table `billamounts`
--
ALTER TABLE `billamounts`
 ADD PRIMARY KEY (`id`), ADD KEY `billamounts_ibfk_1` (`bid`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `company_ibfk_1` (`theme`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `lineitem_ibfk_1` (`bid`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `vid` (`vid`);

--
-- Indexes for table `vendorpurchase`
--
ALTER TABLE `vendorpurchase`
 ADD PRIMARY KEY (`id`), ADD KEY `vid` (`vp`), ADD KEY `pu` (`pid`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `accountcurrency`
--
ALTER TABLE `accountcurrency`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `accounttransaction`
--
ALTER TABLE `accounttransaction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `billamounts`
--
ALTER TABLE `billamounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cheques_actions`
--
ALTER TABLE `cheques_actions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cheques_line_actions`
--
ALTER TABLE `cheques_line_actions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customerpayments`
--
ALTER TABLE `customerpayments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lineitem`
--
ALTER TABLE `lineitem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendorpayments`
--
ALTER TABLE `vendorpayments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vendorpurchase`
--
ALTER TABLE `vendorpurchase`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wicustomer`
--
ALTER TABLE `wicustomer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
