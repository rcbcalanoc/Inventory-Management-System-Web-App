-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 07:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `BatchID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ExpirationDate` date NOT NULL,
  `Price` int(11) NOT NULL,
  `StockQuantity` int(11) NOT NULL,
  `SoldStock` int(11) NOT NULL,
  `CurrentInventory` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`BatchID`, `ProductName`, `ExpirationDate`, `Price`, `StockQuantity`, `SoldStock`, `CurrentInventory`, `Status`) VALUES
(7, 'SparkleClean Dish Soap', '2024-02-12', 120, 400, 50, 350, ''),
(8, 'owerBoost Energy Drink', '2023-12-28', 200, 300, 140, 160, ''),
(9, 'CozyDreams Pillow', '2024-01-31', 50, 400, 200, 200, ''),
(10, 'TechGizmo Wireless Mouse', '2024-03-08', 3000, 40, 5, 35, ''),
(11, ' FreshHarvest Organic Apples', '2024-01-04', 40, 20, 10, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `batchID` int(11) NOT NULL,
  `itemno` int(11) NOT NULL,
  `itemname` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`batchID`, `itemno`, `itemname`, `Quantity`, `Price`, `description`) VALUES
(17, 0, 'Doritos', 0, 100, 'Chips'),
(18, 0, 'Bear brand', 0, 500, 'milk'),
(19, 0, 'Rexona', 0, 85, 'deodorant'),
(20, 0, 'Nike', 0, 5000, 'shoes'),
(21, 0, 'Safeguard', 0, 40, 'soap');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `ID` int(11) NOT NULL,
  `Item Name` varchar(20) NOT NULL,
  `Qty` varchar(20) NOT NULL,
  `Supplier Name` varchar(20) NOT NULL,
  `Supplier Contact` varchar(20) NOT NULL,
  `Supplier Address` varchar(50) NOT NULL,
  `Batch ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`ID`, `Item Name`, `Qty`, `Supplier Name`, `Supplier Contact`, `Supplier Address`, `Batch ID`) VALUES
(128, 'SparkleClean Dish So', '50', 'GreenSource Distribu', '639171234567', '123 Garden Way, Cityville, CA 98765', '572713'),
(129, 'owerBoost Energy Dri', '80', 'TechHub Electronics', '639267890123', '456 Circuit Street, Techland, TX 54321', '954119'),
(130, ' FreshHarvest Organi', '10', 'FreshHarvest Farms', '639982345678', '789 Orchard Lane, Harvestville, FL 12345', '679027'),
(131, 'TechGizmo Wireless M', '60', 'EcoWare Sustainable ', '639773456789', '567 Green Street, Ecotown, NY 67890', '945799'),
(132, 'CozyDreams Pillow', '90', 'PowerGadget Innovati', '639667891234', '890 Tech Avenue, Innovacity, AZ 34567', '663351');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Number` int(11) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `access_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `Number`, `Position`, `access_code`) VALUES
(290, 'admin', 'admin', 'admin', 'admin', 'admin', 10011, 'admin', '1782b8e3f7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`BatchID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`batchID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `BatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `batchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
