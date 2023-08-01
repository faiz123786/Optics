-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 12:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optics`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `ID` int(11) NOT NULL,
  `Prod_ID` int(11) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`ID`, `Prod_ID`, `Cust_ID`, `Quantity`) VALUES
(4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Email` varchar(255) NOT NULL,
  `Pwd` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Email`, `Pwd`, `Role`, `ID`) VALUES
('WnNLaTdZbUZ2N1hCZXkySE5tdXJFZz09', 'N1R1aXFJd05obElqWlNuSXJFS1orQT09', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ads_banner`
--

CREATE TABLE `ads_banner` (
  `ID` int(11) NOT NULL,
  `Img_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ads_banner`
--

INSERT INTO `ads_banner` (`ID`, `Img_name`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Categories_name` varchar(255) NOT NULL,
  `totalSub_catg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Categories_name`, `totalSub_catg`) VALUES
(1, 'UTVhWDRPWTliL1Eyc2pRZlBNWVdkQT09', 4),
(2, 'V2k3R25EOWsyc0RUZy83RVhxUEhLdz09', 45),
(3, 'eFZsaG9LbXg2OHRzaGN5eWk3RzZPUT09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `ID` int(11) NOT NULL,
  `Img_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_banner`
--

INSERT INTO `home_banner` (`ID`, `Img_name`) VALUES
(1, 'SjN0U2dKQVJzWGpTZzFIdDhYN2NXRHcyeVByMExXMG9xSnZ5eDQ3RzVMQT0='),
(2, 'TGVTaFlQT1dtU3BXdjMrQlM0U3JIaHFmekJ2YzVYV25rSUozd0ZLMzdGRT0='),
(3, 'STJpSFl4MWdIMks3QjdXTFFHb0JxeGc2WjR2Vk5USFNYVWhTT0ZNcHV1TT0=');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `User_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `F_name` varchar(255) NOT NULL,
  `L_name` varchar(255) NOT NULL,
  `Pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `User_name`, `Email`, `F_name`, `L_name`, `Pwd`) VALUES
(1, 'MDBnYzh3d0l5ekdyellmVzRDMmN3UT09', 'NGlpQUgrRmY3Y2lVOVlGRlRiUVhBQT09', 'MDBnYzh3d0l5ekdyellmVzRDMmN3UT09', 'NVZHTlhVcFNZR1o2Z085RjloZGtkQT09', 'N1R1aXFJd05obElqWlNuSXJFS1orQT09'),
(2, 'clZlbXFFSEllMWJPZGJMZ0JnR0Fndz09', 'TEdsV0tzblJQbmFOeVhmRjBVSTVWekdubW5ZTkdoUnI4SmgycUhwQnBxdz0=', 'clZlbXFFSEllMWJPZGJMZ0JnR0Fndz09', 'ck5PcDZyQXhxS29UWW5ZTVBpbkMrQT09', 'N1R1aXFJd05obElqWlNuSXJFS1orQT09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `prod_ID` int(11) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `F_name` text NOT NULL,
  `L_name` text NOT NULL,
  `Address` text NOT NULL,
  `Contact_no` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `R_minus` varchar(255) NOT NULL,
  `L_minus` varchar(255) NOT NULL,
  `R_plus` varchar(255) NOT NULL,
  `L_plus` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Sub_catg_ID` int(11) NOT NULL,
  `P_Name` text NOT NULL,
  `P_Desc` text NOT NULL,
  `P_price` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `Img_name` text NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Sub_catg_ID`, `P_Name`, `P_Desc`, `P_price`, `color`, `Img_name`, `ID`) VALUES
(1, 'UExlNVE1SndEN2FCcmhCOENjdmlHRlk4cmVEaTR3SjRnM0JBVk1vZVpoTT0=', 'M3F0RzJSVTJqejVVUjhpS1MwZ0w5bWR1Zzh3QTkwV1h1dHBzQXoyMExWOFRXYzc1RXlCK1YwK2NvZE45ZG1kNHZZUzI3ZW80akIrU2cxMUM5V0tsV1gvTUZIUkFUNWFaLzI4cCtPMXRKNFlDa1RlWmtVOEJaL2FsQXljVHBzci8=', 'cnNETjlINStERldkbk1vNWF0dnlQZz09', 'aGpVcUV0dy91VlhiT0gxdm9CaDJTdz09', 'bDB3dFJzUFVRM0tvMUpNU0VoOXRkU2YrazNmckNoMUFKNFFTaGlhMWF1WT0=', 2),
(1, 'eFZsaG9LbXg2OHRzaGN5eWk3RzZPUT09', 'M3F0RzJSVTJqejVVUjhpS1MwZ0w5bWR1Zzh3QTkwV1h1dHBzQXoyMExWOFRXYzc1RXlCK1YwK2NvZE45ZG1kNHZZUzI3ZW80akIrU2cxMUM5V0tsV1gvTUZIUkFUNWFaLzI4cCtPMXRKNFlDa1RlWmtVOEJaL2FsQXljVHBzci8=', 'cnNETjlINStERldkbk1vNWF0dnlQZz09', 'aGpVcUV0dy91VlhiT0gxdm9CaDJTdz09', 'eWpGZ090MEVVWWErb1BxeGpoR01Wd0xBT3l3TEhKOWhXT2V2YWFNbjZpWT0=', 3),
(3, 'eFZsaG9LbXg2OHRzaGN5eWk3RzZPUT09', 'M3F0RzJSVTJqejVVUjhpS1MwZ0w5bWR1Zzh3QTkwV1h1dHBzQXoyMExWOFRXYzc1RXlCK1YwK2NvZE45ZG1kNHZZUzI3ZW80akIrU2cxMUM5V0tsV1gvTUZIUkFUNWFaLzI4cCtPMXRKNFlDa1RlWmtVOEJaL2FsQXljVHBzci8=', 'cnNETjlINStERldkbk1vNWF0dnlQZz09', 'aGpVcUV0dy91VlhiT0gxdm9CaDJTdz09', 'TU5UWnNzUUFEbGFkdzd1eUcyNGpmdDZqcEdVcmU2VDB5UCtrL3Z1ZlU1VT0=', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `ID` int(11) NOT NULL,
  `Catg_ID` int(255) NOT NULL,
  `totalProducts` int(11) NOT NULL,
  `Sub_catg_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`ID`, `Catg_ID`, `totalProducts`, `Sub_catg_name`) VALUES
(1, 2, 5, 'dFpwbGxYTzlzRkpZK0tuL0JJdmdMdz09'),
(3, 3, 1, 'eFZsaG9LbXg2OHRzaGN5eWk3RzZPUT09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ads_banner`
--
ALTER TABLE `ads_banner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `Cust_ID` (`Cust_ID`),
  ADD KEY `prod_ID` (`prod_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Sub_catg_ID` (`Sub_catg_ID`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Catg_ID` (`Catg_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_banner`
--
ALTER TABLE `ads_banner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD CONSTRAINT `addtocart_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `login` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `login` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`prod_ID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Sub_catg_ID`) REFERENCES `sub_categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `Catg_ID` FOREIGN KEY (`Catg_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
