-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 03:15 AM
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
-- Database: `cis`
--
CREATE DATABASE IF NOT EXISTS `cis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cis`;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `a_assetID` varchar(10) NOT NULL,
  `a_nameBI` varchar(50) NOT NULL,
  `a_nameBM` varchar(50) NOT NULL,
  `a_category` varchar(2) DEFAULT NULL,
  `a_roomID` varchar(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` decimal(6,2) NOT NULL,
  `amount` int(5) NOT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `a_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`a_assetID`, `a_nameBI`, `a_nameBM`, `a_category`, `a_roomID`, `description`, `cost`, `amount`, `date_purchased`, `a_img_path`) VALUES
('ICT0001', 'Projector', 'Projektor', '1', 'AL1000002', 'Gt a lens', '100.00', 10, '2020-12-24 22:42:56', NULL),
('NICT0001', 'Table', 'Meja', '2', 'BL2000001', 'Jiushi meja lo', '100.00', 1000, '2020-12-24 22:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `block_no` varchar(2) NOT NULL,
  `b_nameBI` varchar(50) NOT NULL,
  `b_nameBM` varchar(50) NOT NULL,
  `location` varchar(1) DEFAULT NULL CHECK (`location` in ('1','2','3'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`block_no`, `b_nameBI`, `b_nameBM`, `location`) VALUES
('A', 'Block A', 'Blok A', '3'),
('B', 'Block B', 'Blok B', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catID` varchar(2) NOT NULL,
  `cat_nameBI` varchar(50) NOT NULL,
  `cat_nameBM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `cat_nameBI`, `cat_nameBM`) VALUES
('1', 'ICT', 'ICT'),
('2', 'Non-ICT', 'Non-ICT');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `compID` int(10) NOT NULL,
  `c_userIC` varchar(12) DEFAULT NULL,
  `c_assetID` varchar(10) DEFAULT NULL,
  `c_roomID` varchar(10) DEFAULT NULL,
  `c_status` varchar(2) DEFAULT '1',
  `proposedDate` datetime NOT NULL DEFAULT sysdate(),
  `detail` text DEFAULT NULL,
  `setledDate` datetime DEFAULT NULL,
  `action_desc` text DEFAULT NULL,
  `followedBy` varchar(12) DEFAULT NULL,
  `c_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`compID`, `c_userIC`, `c_assetID`, `c_roomID`, `c_status`, `proposedDate`, `detail`, `setledDate`, `action_desc`, `followedBy`, `c_img_path`) VALUES
(1, '001005101332', 'NICT0001', NULL, NULL, '2020-12-30 23:33:37', 'meja sudah rosak', NULL, NULL, NULL, NULL),
(2, '001005101332', 'ICT0001', NULL, NULL, '2020-12-30 23:33:37', 'lens missing', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `r_roomID` varchar(10) NOT NULL,
  `PIC` varchar(12) DEFAULT NULL,
  `r_nameBI` varchar(50) NOT NULL,
  `r_nameBM` varchar(50) NOT NULL,
  `blok` varchar(2) DEFAULT NULL,
  `r_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`r_roomID`, `PIC`, `r_nameBI`, `r_nameBM`, `blok`, `r_img_path`) VALUES
('AL1000002', '001005101333', 'Computer Lab 2', 'Makmal Komputer 2', 'A', NULL),
('BL1000001', '001005101334', 'Classroom 1', 'Kelas 1', 'B', NULL),
('BL2000001', '001005101337', 'Computer Lab 1', 'Makmal Komputer 1', 'B', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `s_statusID` varchar(2) NOT NULL CHECK (`s_statusID` in ('1','2','3','4')),
  `s_nameBI` varchar(50) NOT NULL,
  `s_nameBM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`s_statusID`, `s_nameBI`, `s_nameBM`) VALUES
('1', 'Pending', 'Belum Selesai'),
('2', 'In Progress', 'Dalam Proses'),
('3', 'Settled', 'Selesai'),
('4', 'Asset Disposed', 'Asset Dilupuskan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_userIC` varchar(12) NOT NULL,
  `pwd` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `postBI` varchar(50) DEFAULT NULL,
  `postBM` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  `no_aduan` int(5) DEFAULT NULL,
  `u_img_path` varchar(50) DEFAULT NULL,
  `userType` varchar(2) NOT NULL CHECK (`userType` in ('1','2','3','4'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_userIC`, `pwd`, `name`, `postBI`, `postBM`, `address`, `email`, `contact`, `dateRegistered`, `no_aduan`, `u_img_path`, `userType`) VALUES
('001005101332', '123456', 'huiyou', 'Admin', 'Admin', 'lalalal', 'huiyou@gmail.com', '601123861731', '2020-12-23 22:49:34', NULL, NULL, '1'),
('001005101333', '123456', 'Ahmad', 'PIC', 'PIC', 'lololol', 'Ahmad@gmail.com', '60123456789', '2020-12-31 22:49:34', NULL, NULL, '2'),
('001005101334', '123456', 'Ali', 'PIC', 'PIC', 'lals', 'Ali@gmail.com', '60123456789', '2020-12-23 22:49:34', NULL, NULL, '2'),
('001005101335', '123456', 'Mohamad', 'Assistant Computer Technician', 'Penolong Juruteknik Komputer', 'lalalalala', 'Mohamad@gmail.com', '60123456799', '2020-12-23 22:49:34', NULL, NULL, '3'),
('001005101336', '123456', 'ABU', 'Assistant Engineer', 'Penolong Jurutera', '16,jln nali.', 'Abu@gmail.com', '60123456788', '2020-12-23 22:49:34', NULL, NULL, '4'),
('001005101337', '123456', 'Muthu', 'PIC', 'PIC', 'lalsdsfsd', 'Muthu@gmail.com', '60123456889', '2020-12-23 22:49:34', NULL, NULL, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`a_assetID`),
  ADD KEY `a_cat_FK` (`a_category`),
  ADD KEY `a_room_FK` (`a_roomID`);

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
  ADD KEY `C_room_FK` (`c_roomID`),
  ADD KEY `C_status_FK` (`c_status`),
  ADD KEY `C_follow_FK` (`followedBy`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`r_roomID`),
  ADD KEY `r_blok_FK` (`blok`),
  ADD KEY `r_pic_FK` (`PIC`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`s_statusID`);

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
  MODIFY `compID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `a_cat_FK` FOREIGN KEY (`a_category`) REFERENCES `categories` (`catID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `a_room_FK` FOREIGN KEY (`a_roomID`) REFERENCES `rooms` (`r_roomID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `C_asset_FK` FOREIGN KEY (`c_assetID`) REFERENCES `assets` (`a_assetID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_follow_FK` FOREIGN KEY (`followedBy`) REFERENCES `users` (`u_userIC`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_room_FK` FOREIGN KEY (`c_roomID`) REFERENCES `rooms` (`r_roomID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_status_FK` FOREIGN KEY (`c_status`) REFERENCES `status` (`s_statusID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `C_user_FK` FOREIGN KEY (`c_userIC`) REFERENCES `users` (`u_userIC`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `r_blok_FK` FOREIGN KEY (`blok`) REFERENCES `blocks` (`block_no`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `r_pic_FK` FOREIGN KEY (`PIC`) REFERENCES `users` (`u_userIC`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
