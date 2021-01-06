-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 09:26 AM
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
-- Database: `kolej_vokasional_perdagangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `assetID` varchar(10) NOT NULL,
  `nameBI` varchar(100) NOT NULL,
  `nameBM` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `cost` float NOT NULL,
  `amount` int(5) NOT NULL,
  `asset_condition` varchar(100) NOT NULL,
  `date_purchased` date NOT NULL,
  `img_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`assetID`, `nameBI`, `nameBM`, `category`, `description`, `cost`, `amount`, `asset_condition`, `date_purchased`, `img_path`) VALUES
('0123', 'clock', 'jam', '2', 'black', 12, 200, '1', '2020-12-29', ''),
('11110', 'lamp', 'lampu', 'non-ict', 'white in color', 4, 10, 'good', '2020-11-02', 'https://cb2.scene7.com/is/image/CB2/AdaIIWhiteTableLampSHF16'),
('22220', 'projektor', 'projector', 'ict', 'black in color', 1200, 10, 'good', '2020-11-12', 'https://projector.my/pub/media/catalog/product/cache/9cd0cf9794cd7845d755e22d9d7dc1de/s/d/sd150-led-projector-0.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`assetID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
