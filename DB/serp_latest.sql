-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2023 at 11:33 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rehanahm_serp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account`
(
    `id`             int(11) NOT NULL,
    `code`           varchar(150)   NOT NULL,
    `type`           int(11) DEFAULT NULL,
    `currency`       int(11) NOT NULL,
    `openingbalance` decimal(10, 0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `code`, `type`, `currency`, `openingbalance`)
VALUES (1, 'Expense', 1, 4, 0),
       (2, 'Receiving', 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `accountcurrency`
--

CREATE TABLE `accountcurrency`
(
    `id`   int(11) NOT NULL,
    `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `accountcurrency`
--

INSERT INTO `accountcurrency` (`id`, `code`)
VALUES (1, 'PKR(Pakistan Rupee)'),
       (2, 'AED(UAE  Dirham)'),
       (3, 'CAD(Canadian Dollar)'),
       (4, 'EUR(Euro)'),
       (5, 'SAR(Saudi Riyal)'),
       (6, 'USD(US Dollar)');


-- --------------------------------------------------------

--
-- Table structure for table `accounttransaction`
--

CREATE TABLE `accounttransaction`
(
    `id`          int(11) NOT NULL,
    `aid`         int(11) NOT NULL,
    `discription` text   NOT NULL,
    `debit`       double NOT NULL,
    `credit`      double NOT NULL,
    `date`        date   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `accounttypes`
--

CREATE TABLE `accounttypes`
(
    `id`       int(11) NOT NULL,
    `typename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounttypes`
--

INSERT INTO `accounttypes` (`id`, `typename`)
VALUES (1, 'CASH'),
       (2, 'BANK'),
       (3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill`
(
    `id`       int(11) NOT NULL,
    `cid`      int(11) DEFAULT NULL,
    `discount` decimal(10, 0) NOT NULL,
    `amount`   decimal(10, 0) NOT NULL,
    `date`     date           NOT NULL,
    `ddate`    date DEFAULT NULL,
    `notes`    text,
    `type`     varchar(25)    NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `billamounts`
--

CREATE TABLE `billamounts`
(
    `id`     int(11) NOT NULL,
    `bid`    int(11) NOT NULL,
    `amount` double NOT NULL,
    `date`   date   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE `cheques`
(
    `id`        int(11) NOT NULL,
    `cheque_no` varchar(32)  NOT NULL,
    `payment`   double       NOT NULL,
    `date`      timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `due_date`  timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `bank`      varchar(500) NOT NULL,
    `party`     int(11) NOT NULL,
    `partytype` enum('C','V') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cheques_actions`
--

CREATE TABLE `cheques_actions`
(
    `id`   int(11) NOT NULL,
    `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cheques_actions`
--

INSERT INTO `cheques_actions` (`id`, `name`)
VALUES (1, 'Cleared'),
       (2, 'Forward'),
       (3, 'Failed'),
       (4, 'Partial'),
       (5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cheques_line_actions`
--

CREATE TABLE `cheques_line_actions`
(
    `id`                 int(11) NOT NULL,
    `cheques_id`         int(11) NOT NULL,
    `cheques_actions_id` int(11) NOT NULL,
    `party`              int(11) DEFAULT NULL,
    `payment`            double    NOT NULL,
    `date`               timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `note`               text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities`
(
    `id`   int(11) NOT NULL,
    `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company`
(
    `id`            int(11) NOT NULL,
    `name`          varchar(500)  NOT NULL,
    `lincenseType`  int(11) DEFAULT NULL,
    `theme`         int(11) DEFAULT NULL,
    `system_detail` varchar(1000) NOT NULL,
    `salt`          varchar(2000) NOT NULL,
    `days_limit`    varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `lincenseType`, `theme`, `system_detail`, `salt`, `days_limit`)
VALUES (1, 'SALES ERP', NULL, 1, '3f457c353c6aab6b30d2e1f462e97cf6', 'YWxpYXNzYWQxMTA=', 'NDM=');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer`
(
    `id`             int(11) NOT NULL,
    `name`           varchar(100)  NOT NULL,
    `company`        varchar(1000) NOT NULL,
    `city`           varchar(500)  NOT NULL,
    `email`          varchar(120)  NOT NULL,
    `phone`          varchar(50)   NOT NULL,
    `address`        text          NOT NULL,
    `openingbalance` double        NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`id`, `name`, `company`, `city`, `email`, `phone`, `address`, `openingbalance`)
VALUES (1, 'Walk In Customer', '', '', 'walkin@customer.com', '0000-0000000', 'Walk In Customer', 0);
-- --------------------------------------------------------

--
-- Table structure for table `customerpayments`
--

CREATE TABLE `customerpayments`
(
    `id`      int(11) NOT NULL,
    `cid`     int(11) DEFAULT NULL,
    `amount`  double       NOT NULL,
    `date`    date         NOT NULL,
    `ptype`   varchar(200) NOT NULL,
    `pdetail` text         NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lineitem`
--

CREATE TABLE `lineitem`
(
    `id`       int(11) NOT NULL,
    `lid`      int(11) DEFAULT NULL,
    `bid`      int(11) DEFAULT NULL,
    `product`  text,
    `rate`     double          DEFAULT NULL,
    `unit`     double          DEFAULT NULL,
    `discount` double NOT NULL DEFAULT '0',
    `amount`   double          DEFAULT NULL,
    `status`   int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login`
(
    `id`         int(11) NOT NULL,
    `email`      varchar(100) NOT NULL,
    `pass`       varchar(32)  NOT NULL,
    `role`       enum('Admin','Sale') NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `pass`, `role`, `created_at`)
VALUES (1, 'ali@serp.com', '25f9e794323b453885f5181f1b624d0b', 'Admin', '2017-02-02 17:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member`
(
    `id`      int(11) NOT NULL,
    `cardno`  int(11) NOT NULL,
    `name`    varchar(500) NOT NULL,
    `address` text         NOT NULL,
    `phone`   varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mentry`
--

CREATE TABLE `mentry`
(
    `id`     int(11) NOT NULL,
    `mno`    int(11) NOT NULL,
    `amount` double NOT NULL,
    `date`   date   NOT NULL,
    `bid`    int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmodes`
--

CREATE TABLE `paymentmodes`
(
    `id`   int(11) NOT NULL,
    `name` enum('CASH','CHEQUE','BANK DEPOSIT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

INSERT INTO `paymentmodes` (`id`, `name`)
VALUES (1, 'CASH'),
       (2, 'CHEQUE'),
       (3, 'BANK DEPOSIT');
--
-- Table structure for table `product`
--

CREATE TABLE `product`
(
    `id`            int(11) NOT NULL,
    `des`           text   NOT NULL,
    `stock`         double          DEFAULT '0',
    `saleprice`     double NOT NULL,
    `purchaseprice` double NOT NULL,
    `discount`      double NOT NULL DEFAULT '0',
    `minstock`      double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes`
(
    `id`    int(11) NOT NULL,
    `name`  varchar(500) NOT NULL,
    `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor`
(
    `id`             int(11) NOT NULL,
    `name`           varchar(100) NOT NULL,
    `nic`            varchar(20)           DEFAULT NULL,
    `address`        text         NOT NULL,
    `phone`          varchar(50)  NOT NULL,
    `email`          varchar(100)          DEFAULT NULL,
    `img`            varchar(200)          DEFAULT NULL,
    `companyname`    text,
    `openingbalance` double                DEFAULT '0',
    `city`           varchar(500) NOT NULL,
    `created_at`     timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


-- --------------------------------------------------------

--
-- Table structure for table `vendorpayments`
--

CREATE TABLE `vendorpayments`
(
    `id`      int(11) NOT NULL,
    `vid`     int(11) DEFAULT NULL,
    `amount`  double       NOT NULL,
    `date`    date         NOT NULL,
    `ptype`   varchar(200) NOT NULL,
    `pdetail` text         NOT NULL,
    `value`   double       NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `vendorpurchase`
--

CREATE TABLE `vendorpurchase`
(
    `id`   int(11) NOT NULL,
    `pid`  varchar(50)    NOT NULL,
    `qty`  int(11) NOT NULL,
    `rate` decimal(10, 0) NOT NULL,
    `vp`   int(11) DEFAULT NULL,
    `date` date           NOT NULL,
    `vno`  int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


-- --------------------------------------------------------

--
-- Table structure for table `wicustomer`
--

CREATE TABLE `wicustomer`
(
    `id`     int(11) NOT NULL,
    `name`   varchar(500) NOT NULL,
    `cellno` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

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
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accountcurrency`
--
ALTER TABLE `accountcurrency`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `accounttransaction`
--
ALTER TABLE `accounttransaction`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `accounttypes`
--
ALTER TABLE `accounttypes`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billamounts`
--
ALTER TABLE `billamounts`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cheques_actions`
--
ALTER TABLE `cheques_actions`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cheques_line_actions`
--
ALTER TABLE `cheques_line_actions`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerpayments`
--
ALTER TABLE `customerpayments`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lineitem`
--
ALTER TABLE `lineitem`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentry`
--
ALTER TABLE `mentry`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmodes`
--
ALTER TABLE `paymentmodes`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendorpayments`
--
ALTER TABLE `vendorpayments`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendorpurchase`
--
ALTER TABLE `vendorpurchase`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wicustomer`
--
ALTER TABLE `wicustomer`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
