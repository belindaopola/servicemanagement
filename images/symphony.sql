-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 02:39 PM
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
-- Database: `symphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(13, 'Kiran Kumar', 'kiran', 'b1a5b64256e27fa5ae76d62b95209ab3'),
(14, 'Bethuel Ongesa', 'bongesa', '738f8991edfcedde8ca16de25065028a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `featured`, `active`) VALUES
(1, 'Kenya Wines Agencies Limited', '+254729851357', 'kenya@wines.com', 'Tatu City\r\nP.O Box 14\r\nThika', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `section_id`, `featured`, `active`) VALUES
(9, 'UPS Commissioning', 5, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_date` datetime NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `quotation` varchar(255) NOT NULL,
  `customer_po` varchar(255) NOT NULL,
  `costing_sheet` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vat` decimal(10,0) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sales_person` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_request`
--

-- INSERT INTO `tbl_request` (`id`, `request_date`, `customer_name`, `quotation`, `customer_po`, `costing_sheet`, `currency`, `price`, `vat`, `total`, `status`, `sales_person`, `description`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Critical Power Maintenance', 'product_section_561.png', 'Yes', 'Yes'),
(5, 'Critical Power Sales', 'product_section_64.jpg', 'Yes', 'Yes'),
(6, 'IT Maintenance', 'product_section_93.jpg', 'Yes', 'Yes'),
(8, 'IT  Sales', 'product_section_142.png', 'Yes', 'Yes'),
(9, 'Technical Presales', 'product_section_608.png', 'Yes', 'Yes'),
(10, 'Critical Power Warranty', 'product_section_744.jpg', 'Yes', 'Yes'),
(11, 'IT Warranty', 'product_section_106.png', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
