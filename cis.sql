-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 03:08 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
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
('AL1000001', '001005101333', 'Computer Lab 1', 'Makmal Komputer 1', 'A', NULL),
('BL1000001', '001005101334', 'Classroom 1', 'Kelas 1', 'B', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`r_roomID`),
  ADD KEY `r_blok_FK` (`blok`),
  ADD KEY `r_pic_FK` (`PIC`);

--
-- Constraints for dumped tables
--

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
