-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2021 at 02:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
('NICT0001', 'Table', 'Meja', '2', 'BL2000001', 'Jiushi meja lo', '100.00', 1000, '2020-12-24 22:42:56', NULL),
('ttt666', 'table', 'meja', '2', NULL, ' Broken', '7.00', 70, '2021-01-16 00:00:00', NULL);

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
('B', 'Block B', 'Blok B', '1'),
('yy', 'tu', 'tu', '1');

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
(1, NULL, 'NICT0001', NULL, NULL, '2020-12-30 23:33:37', 'meja sudah rosak', NULL, NULL, NULL, NULL),
(2, NULL, 'ICT0001', NULL, NULL, '2020-12-30 23:33:37', 'lens missing', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `g_gradeID` varchar(5) NOT NULL,
  `g_postBI` varchar(50) NOT NULL,
  `g_postBM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`g_gradeID`, `g_postBI`, `g_postBM`) VALUES
('DG41', 'Lecturer', 'Pensyarah'),
('DG44', 'Lecturer', 'Pensyarah'),
('FT19', 'Assistant Computer Technician', 'Juruteknik Komputer'),
('JA30', 'Assistant Engineer', 'Penolong Jurutera'),
('JA90', 'Adminy', 'Pentadbir');

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
('AL1000002', NULL, 'Computer Lab 2', 'Makmal Komputer 2', 'A', NULL),
('BL1000001', NULL, 'Classroom 1', 'Kelas 1', 'B', NULL),
('BL2000001', NULL, 'Computer Lab 1', 'Makmal Komputer 1', 'B', NULL);

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
  `pwd` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `postBI` varchar(50) DEFAULT NULL,
  `postBM` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `dateRegistered` datetime DEFAULT NULL,
  `no_aduan` int(5) DEFAULT NULL,
  `u_img_path` varchar(50) DEFAULT NULL,
  `userType` varchar(2) NOT NULL CHECK (`userType` in ('1','2','3','4')),
  `u_grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_userIC`, `pwd`, `name`, `postBI`, `postBM`, `address`, `email`, `contact`, `dateRegistered`, `no_aduan`, `u_img_path`, `userType`, `u_grade`) VALUES
('000000000000', '1111', 'HAM JING YI', 'Admin', 'Pentadbir', ' 39, taman nakhoda, jalan kuala kedah,06600 alor setar, kedah.', 'jy@gmail.com', '0100000000', '2021-01-14 23:18:37', NULL, NULL, '1', 'DG41'),
('000909090000', '$2y$10$WfQltfuXIwgTtj0BCH4OduV2oJLJLUME46HopKRy7jZ6w40dN0faO', 'kang', 'Admin', 'Pentadbir', ' 39, TAMAN NAKHODA, JALAN KUALA KEDAH,', 'hamjingyi99@gmail.com', '0123335555', '2021-01-15 14:56:36', NULL, NULL, '1', 'DG44'),
('040217029998', '$2y$10$L/BiuL0Cxe7dVHl9/yj.seNOrYCDSJhI09AjF8GiDH3n7bNcqIOry', 'HAM zYI', 'PIC Of Room', 'PIC Makmal', ' 39, taman nakhoda, jalan kuala kedah,06600 alor setar, kedah.', 'lim@gmail.com', '0123335555', '2021-01-14 22:54:11', NULL, NULL, '2', 'DG41'),
('123456789898', '$2y$10$91ekRNrxALAEaQ7pdRIBLe/V5ADqCGfGlRH.e4YVIxpLFg01LyrXK', 'ooi', 'Admin', 'Pentadbir', ' 39, taman nakhoda, jalan kuala kedah,06600 alor setar, kedah.', 'jy@gmail.com', '0124773940', '2021-01-15 14:57:40', NULL, NULL, '1', 'DG41'),
('990105029068', '$2y$10$EiuAtCVBkeFzGdQkkgl8iu7.c.pV/njcdHTIa1.2VeTCh9RbpUZzy', 'Ham Jing Yi', 'Admin', 'Pentadbir', ' 39, taman nakhoda, jalan kuala kedah,06600 alor setar, kedah.', 'hamjingyi99@gmail.com', '0124773940', '2021-01-15 16:05:25', NULL, NULL, '1', 'DG41');

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
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`g_gradeID`);

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
  ADD PRIMARY KEY (`u_userIC`),
  ADD KEY `u_grade_fk` (`u_grade`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `compID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `u_grade_fk` FOREIGN KEY (`u_grade`) REFERENCES `grades` (`g_gradeID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
