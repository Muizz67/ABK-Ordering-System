-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 04:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_fullname` varchar(100) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_phone` varchar(50) NOT NULL,
  `admin_status` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_username`, `admin_fullname`, `admin_email`, `admin_phone`, `admin_status`, `admin_password`) VALUES
(1, 'Muizz', 'Muhammad Muizz Bin Rusdi', 'muizz_rusdi@yahoo.com', '01111850771', 'Active', 'muizz'),
(2, 'Ishraqi', 'Muhammad Ishraqi bin Mohd Rizal', 'ishraqi@gmail.com', '0172915854', 'Active', '12345'),
(3, 'Syawal', 'Muhammad Syawal bin Muhammed Rozi', 'syawal@gmail.com', '0172155426', 'Active', '12345'),
(4, 'emang', 'Muhammad Aiman bin Md Elias', 'emang@gmail.com', '0133638525', 'Active', '12345'),
(5, 'apan', 'Arfan bin Ahmad Asari', 'apan@gmail.com', '0182303428', 'Active', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `alacarte`
--

CREATE TABLE `alacarte` (
  `food_ID` int(11) NOT NULL,
  `food_name` varchar(50) DEFAULT NULL,
  `food_price` decimal(10,2) DEFAULT NULL,
  `food_image` varchar(50) DEFAULT NULL,
  `food_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alacarte`
--

INSERT INTO `alacarte` (`food_ID`, `food_name`, `food_price`, `food_image`, `food_status`) VALUES
(1, 'Iced Milo', '2.00', 'Food-Name-4340.png', 'Active'),
(2, 'Syrup Bandung Ice', '2.00', 'Food-Name-1690.png', 'Active'),
(3, 'Orange Juice', '2.00', 'Food-Name-3194.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_ID` int(11) NOT NULL,
  `cust_username` varchar(50) NOT NULL,
  `cust_fullname` varchar(50) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_phone` varchar(50) NOT NULL,
  `cust_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_ID`, `cust_username`, `cust_fullname`, `cust_email`, `cust_address`, `cust_phone`, `cust_password`) VALUES
(8, 'roslan', 'roslan', 'roslan@gmail.com', 'uitm', '0123', '12345'),
(2, 'Mafiz', 'Muhammad Mafiz bin Ahmad', 'mafiz@gmail.com', 'bangi', '0123457689', '123'),
(1, 'Daniel', 'akmal daniel', 'daniel@gmail.com', 'jerantut', '0187346471', 'Dan123');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `order_detail_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `set_ID` int(11) DEFAULT NULL,
  `food_ID` int(11) DEFAULT NULL,
  `set_quantity` int(11) DEFAULT NULL,
  `food_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`order_detail_ID`, `order_ID`, `set_ID`, `food_ID`, `set_quantity`, `food_quantity`) VALUES
(1, 1, 6, NULL, 2, NULL),
(2, 2, 6, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `cust_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `date`, `time`, `cust_ID`) VALUES
(1, '2022-07-05', '2215', 1),
(2, '2022-07-17', '1600', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_ID`, `total_price`, `payment_status`, `order_ID`) VALUES
(1, '30.00', 'Cancelled', 1),
(2, '51.00', 'Completed', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

CREATE TABLE `sets` (
  `set_ID` int(11) NOT NULL,
  `set_name` varchar(50) DEFAULT NULL,
  `set_desc` varchar(100) DEFAULT NULL,
  `set_price` decimal(10,2) DEFAULT NULL,
  `set_image` varchar(50) DEFAULT NULL,
  `set_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`set_ID`, `set_name`, `set_desc`, `set_price`, `set_image`, `set_status`) VALUES
(6, 'Chicken Briyani', 'The chicken are made from a special spice that will make you fell hot', '20.00', 'Set-Name-8638.png', 'Not Active'),
(7, 'Beef Briyani', 'We being using the best beef that are in Malaysia', '17.00', 'Set-Name-252.png', 'Active'),
(8, 'Lamb Briyani', 'We marinated the lamb to make the lamb taste more spice', '17.00', 'Set-Name-8679.png', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `alacarte`
--
ALTER TABLE `alacarte`
  ADD PRIMARY KEY (`food_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_phone`),
  ADD KEY `cust_ID` (`cust_ID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`order_detail_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `set_ID` (`set_ID`),
  ADD KEY `food_ID` (`food_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `cust_ID` (`cust_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `sets`
--
ALTER TABLE `sets`
  ADD PRIMARY KEY (`set_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `alacarte`
--
ALTER TABLE `alacarte`
  MODIFY `food_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `order_detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sets`
--
ALTER TABLE `sets`
  MODIFY `set_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`set_ID`) REFERENCES `sets` (`set_ID`),
  ADD CONSTRAINT `orderdetail_ibfk_3` FOREIGN KEY (`food_ID`) REFERENCES `alacarte` (`food_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
