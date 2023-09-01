-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 08:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Honda'),
(2, 'Toyota'),
(3, 'Suzuki');

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `name`) VALUES
(1, 'Cars'),
(8, 'Bikes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `sale_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `sale_id`, `name`, `quantity`, `catagory`, `brand`, `price`) VALUES
(1, 2, 'TOYOTA LAND CRUISER - 2022', '2', 'Cars', 'Toyota', '75000'),
(2, 3, 'TOYOTA LAND CRUISER - 2022', '2', 'Cars', 'Toyota', '75000'),
(3, 4, 'Bike2', '3', 'Bikes', 'Suzuki', '550'),
(6, 7, 'Land Cruiser', '2', 'Cars', 'Toyota', '92000'),
(7, 7, 'Swift', '3', 'Cars', 'Suzuki', '9500'),
(8, 8, 'Land Cruiser 2022', '1', 'Cars', 'Toyota', '110000'),
(9, 9, 'Prius 2021', '4', 'Select Catagory', 'Select Brand', '43000'),
(10, 10, 'Land Cruiser 2022', '1', 'Cars', 'Toyota', '110000');

-- --------------------------------------------------------

--
-- Table structure for table `order_customer`
--

CREATE TABLE `order_customer` (
  `id` int(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_customer`
--

INSERT INTO `order_customer` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `date`, `type`) VALUES
(2, 'Aqil', 'Khan', 'aaqil@gmail.com', '03029077219', 'Landikotal district Khyber', '2022-07-14 20:09:47', 'Registered'),
(3, 'Abdul ', 'Wali', 'abdul@gmail.com', '030247788888', 'Landikotal district Khyber', '2022-07-20 12:52:50', 'Guest'),
(4, 'Aqil', 'Khan', 'Aaqil@gmail.com', '03029077219', 'Board Peshawar', '2022-07-20 15:35:10', 'Registered'),
(7, 'Aqil', 'Khan', 'Aaqil@gmail.com', '03029077219', 'Peshawar', '2022-07-20 16:33:37', 'Registered'),
(8, 'Aqil', 'Khan', 'Aaqil@gmail.com', '03029077219', 'Peshawar', '2022-07-20 16:57:38', 'Registered'),
(9, 'sdfdsd', 'Wali', 'aaqillkliuyfyfyf1@gmail.com', '030247788888', 'Landikotal district Khyber', '2022-07-20 17:00:16', 'Guest'),
(10, 'Aqil', 'Khan', 'Aaqil@gmail.com', '03029077219', 'Landikotal district Khyber', '2022-07-20 17:53:58', 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `cost_price` varchar(255) NOT NULL,
  `sale_price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `catagory`, `brand`, `quantity`, `cost_price`, `sale_price`, `image`) VALUES
(3, 'Toyota COROLLA 2022', 'Cars', 'Toyota', '10', '30000', '32000', 'corola.jpg'),
(4, 'TOYOTA LAND CRUISER - 2022', 'Cars', 'Toyota', '10', '70000', '75000', 'land cruiser.jpg'),
(5, 'CBR1000RR-R FIREBLADE', 'Bikes', 'Honda', '20', '10000', '12000', 'bike4.jpg'),
(8, 'Honda 70CC', 'Bikes', 'Honda', '10', '600', '6200', 'motohonda.jpg'),
(9, 'Honda Civic', 'Cars', 'Honda', '10', '10000', '12000', 'honda1.jpg'),
(10, 'Swift', 'Cars', 'Suzuki', '10', '9000', '9500', 'suzuki swift.jpg'),
(11, 'Bike2', 'Bikes', 'Suzuki', '10', '500', '550', 'bike2.jpg'),
(12, 'Land Cruiser', 'Cars', 'Toyota', '10', '90000', '92000', 'toyota3.jpg'),
(13, 'Prius 2021', 'Select Catagory', 'Select Brand', '10', '40000', '43000', 'suzuki swift2.jpg'),
(14, 'Land Cruiser 2022', 'Cars', 'Toyota', '10', '100000', '110000', 'land cruiser.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `status`) VALUES
(1, 'Aqil', 'Khan', 'Aaqil@gmail.com', '03029077219', '1234', '0'),
(2, 'Suliman', 'Khan', 'Sulimanbangash@gmail.com', '03334566724', '12345', '0'),
(3, 'Mr. Amir', 'Khan', 'admin.amir@gmail.com', '03125959459', '12345', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
