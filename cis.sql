-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 06:07 AM
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
  `description` text DEFAULT NULL,
  `cost` decimal(6,2) DEFAULT NULL,
  `amount` int(5) DEFAULT NULL,
  `conditions` varchar(2) DEFAULT NULL CHECK (`conditions` in ('1','2')),
  `date_puechased` datetime DEFAULT NULL,
  `a_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `assets`:
--   `a_category`
--       `categories` -> `catID`
--

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
-- RELATIONSHIPS FOR TABLE `blocks`:
--

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
-- RELATIONSHIPS FOR TABLE `categories`:
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `compID` varchar(10) NOT NULL,
  `c_userIC` varchar(12) NOT NULL,
  `c_assetID` varchar(10) DEFAULT NULL,
  `c_roomID` varchar(10) DEFAULT NULL,
  `c_status` varchar(2) DEFAULT NULL CHECK (`c_status` in ('1','2','3','4')),
  `proposedDate` datetime DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `setledDate` datetime DEFAULT NULL,
  `c_img_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `complaints`:
--   `c_assetID`
--       `assets` -> `a_assetID`
--   `c_roomID`
--       `rooms` -> `r_roomID`
--   `c_userIC`
--       `users` -> `u_userIC`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `r_roomID` varchar(10) NOT NULL,
  `r_assetID` varchar(10) DEFAULT NULL,
  `PIC` varchar(10) NOT NULL,
  `r_nameBI` varchar(50) NOT NULL,
  `r_nameBM` varchar(50) NOT NULL,
  `blok` varchar(2) DEFAULT NULL,
  `location` varchar(1) DEFAULT NULL CHECK (`location` > 0 and `location` < 4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `rooms`:
--   `r_assetID`
--       `assets` -> `a_assetID`
--   `blok`
--       `blocks` -> `block_no`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_userIC` varchar(12) NOT NULL,
  `registered_by` varchar(12) DEFAULT NULL,
  `room_managed` varchar(10) DEFAULT NULL,
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
-- RELATIONSHIPS FOR TABLE `users`:
--   `room_managed`
--       `rooms` -> `r_roomID`
--   `registered_by`
--       `users` -> `u_userIC`
--

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
  ADD KEY `r_blok_FK` (`blok`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_userIC`),
  ADD KEY `U_room_FK` (`room_managed`),
  ADD KEY `U_registeredby_FK` (`registered_by`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `a_cat_FK` FOREIGN KEY (`a_category`) REFERENCES `categories` (`catID`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `C_asset_FK` FOREIGN KEY (`c_assetID`) REFERENCES `assets` (`a_assetID`),
  ADD CONSTRAINT `C_room_FK` FOREIGN KEY (`c_roomID`) REFERENCES `rooms` (`r_roomID`),
  ADD CONSTRAINT `C_user_FK` FOREIGN KEY (`c_userIC`) REFERENCES `users` (`u_userIC`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `r_asset_FK` FOREIGN KEY (`r_assetID`) REFERENCES `assets` (`a_assetID`),
  ADD CONSTRAINT `r_blok_FK` FOREIGN KEY (`blok`) REFERENCES `blocks` (`block_no`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `U_room_FK` FOREIGN KEY (`room_managed`) REFERENCES `rooms` (`r_roomID`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`registered_by`) REFERENCES `users` (`u_userIC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
