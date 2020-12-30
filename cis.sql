-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 06:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cis3`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `a_assetID` varchar(10) NOT NULL,
  `a_nameBI` varchar(50) NOT NULL,
  `a_nameBM` varchar(50) NOT NULL,
  `a_category` varchar(2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` decimal(6,2) DEFAULT NULL,
  `amount` int(5) DEFAULT NULL,
  `conditions` varchar(2) DEFAULT NULL CHECK (`conditions` in ('1','2')),
  `date_purchased` datetime DEFAULT NULL,
  `a_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`a_assetID`, `a_nameBI`, `a_nameBM`, `a_category`, `description`, `cost`, `amount`, `conditions`, `date_puechased`, `a_img_path`) VALUES
('IAB0001', 'Table', 'Meja', '51', 'Jiushi meja lo', '100.00', 1000, '1', '2020-12-24 22:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `block_no` varchar(2) NOT NULL,
  `b_nameBI` varchar(50) DEFAULT NULL,
  `b_nameBM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`block_no`, `b_nameBI`, `b_nameBM`) VALUES
('A', 'Block A', 'Blok A');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catID` varchar(2) NOT NULL,
  `cat_nameBI` varchar(50) DEFAULT NULL,
  `cat_nameBM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `cat_nameBI`, `cat_nameBM`) VALUES
('51', 'Furniture', 'Perabot Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `compID` int(10) NOT NULL,
  `c_userIC` varchar(12) DEFAULT NULL,
  `c_assetID` varchar(10) DEFAULT NULL,
  `c_roomID` varchar(10) DEFAULT NULL,
  `c_status` varchar(2) DEFAULT NULL CHECK (`c_status` in ('1','2','3','4')),
  `proposedDate` datetime DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `setledDate` datetime DEFAULT NULL,
  `c_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`compID`, `c_userIC`, `c_assetID`, `c_roomID`, `c_status`, `proposedDate`, `detail`, `setledDate`, `c_img_path`) VALUES
(1, '001005101332', 'IAB0001', 'AL1000001', NULL, '2020-12-30 23:33:37', 'meja sudah rosak', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `r_roomID` varchar(10) NOT NULL,
  `r_assetID` varchar(10) DEFAULT NULL,
  `PIC` varchar(12) DEFAULT NULL,
  `r_nameBI` varchar(50) NOT NULL,
  `r_nameBM` varchar(50) NOT NULL,
  `blok` varchar(2) DEFAULT NULL,
  `location` varchar(1) DEFAULT NULL CHECK (`location` > 0 and `location` < 4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`r_roomID`, `r_assetID`, `PIC`, `r_nameBI`, `r_nameBM`, `blok`, `location`) VALUES
('AL1000001', NULL, '001005101333', 'Computer Lab 1', 'Makmal Komputer 1', 'A', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_userIC` varchar(12) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `postBI` varchar(50) NOT NULL,
  `postBM` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  `no_aduan` int(5) DEFAULT NULL,
  `u_img_path` varchar(50) DEFAULT NULL,
  `userType` varchar(2) DEFAULT NULL CHECK (`userType` in ('1','2','3','4'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_userIC`, `pwd`, `name`, `postBI`, `postBM`, `address`, `email`, `contact`, `dateRegistered`, `no_aduan`, `u_img_path`, `userType`) VALUES
('001005101332', '123456', 'huiyou', 'Admin', 'Admin', 'lalalal', 'huiyou@gmail.com', '601123861731', '2020-12-23 22:49:34', NULL, NULL, '1'),
('001005101333', '123456', 'Ahmad', 'PIC', 'PIC', 'lololol', 'Ahmad@gmail.com', '60123456789', '2020-12-31 22:49:34', NULL, NULL, '2'),
('001005101334', '123456', 'Ali', 'PIC', 'PIC', 'lals', 'Ali@gmail.com', '60123456789', '2020-12-23 22:49:34', NULL, NULL, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`a_assetID`),
  ADD KEY `a_cat_FK` (`a_category`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`block_no`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`compID`),
  ADD KEY `C_user_FK` (`c_userIC`),
  ADD KEY `C_asset_FK` (`c_assetID`),
  ADD KEY `C_room_FK` (`c_roomID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`r_roomID`),
  ADD KEY `r_asset_FK` (`r_assetID`),
  ADD KEY `r_blok_FK` (`blok`),
  ADD KEY `r_pic_FK` (`PIC`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_userIC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `compID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `a_cat_FK` FOREIGN KEY (`a_category`) REFERENCES `categories` (`catID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `C_asset_FK` FOREIGN KEY (`c_assetID`) REFERENCES `assets` (`a_assetID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_room_FK` FOREIGN KEY (`c_roomID`) REFERENCES `rooms` (`r_roomID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_user_FK` FOREIGN KEY (`c_userIC`) REFERENCES `users` (`u_userIC`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `r_asset_FK` FOREIGN KEY (`r_assetID`) REFERENCES `assets` (`a_assetID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `r_blok_FK` FOREIGN KEY (`blok`) REFERENCES `blocks` (`block_no`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `r_pic_FK` FOREIGN KEY (`PIC`) REFERENCES `users` (`u_userIC`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
