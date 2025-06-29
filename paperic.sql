-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2025 at 05:37 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paperic`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `p_id` int DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `quantity` int DEFAULT '10',
  `order_id` int DEFAULT '-1',
  PRIMARY KEY (`cart_id`),
  KEY `p_id` (`p_id`),
  KEY `c_id` (`c_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `p_id`, `c_id`, `quantity`, `order_id`) VALUES
(218, 10, 7, 10, 54),
(219, 11, 7, 13, 54),
(220, 13, 7, 14, 54),
(221, 14, 7, 10, 55);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phoneno` bigint NOT NULL,
  `companyaddress` varchar(30) NOT NULL,
  `gstno` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `username`, `password`, `email`, `phoneno`, `companyaddress`, `gstno`, `role`, `profile_image`) VALUES
(1, 'Lathapapers', '$2a$12$QoIKDOFz1wfdM2Bkv3ftPeeg1dseB/Qi99CKpFX/pec3ByiHySssm', 'sripriyasmc@gmail.com', 9526638980, 'Kaloor', '2345678909', 'admin', 'womenglassess.jpg'),
(2, 'Sripriya', '$2y$10$wN8WElgwheZmoxHTXPUSvupgO/KBwg3ju5jEMTaNjNLF7hlZsSXFi', 'sri@gmail.com', 2345678909, 'Kaloor', '2345678909', 'user', 'womenprofilepic.jpg'),
(7, 'Neeraja', '$2y$10$ia5M/xMg4fEAdEpGyM/5J.iF2m9NqYm8RJZbVRpbz3xLROgqv7t6C', 'neerajahari02@gmail.com', 6789876544, 'Nil', '56478987654356', 'user', NULL),
(4, 'Nitha', '$2y$10$9CGsJjYYiMXMG5z0AIwI3e6p7nWGSPgQ3LhYm/OkvpsXktGOLBBpm', 'nitha@gmail', 2345678900, 'kjhgfhy', '123456789876', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `deliver_to` varchar(40) NOT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `d_email` varchar(40) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `deliver_to`, `delivery_address`, `d_email`, `status`) VALUES
(54, 'Neeraja K', 'Sreepadam', 'neerajahari02@gmail.com', 1),
(55, 'Sripriya', 'SMS Illam Kaloor', 'sripriyasmc@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `c_id` int DEFAULT NULL,
  `amount` float NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `method` varchar(40) DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `c_id` (`c_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `c_id`, `amount`, `date`, `method`, `order_id`) VALUES
(47, 7, 580, '2025-06-29 15:06:20', 'COD', 54),
(48, 7, 250, '2025-06-29 17:32:25', 'COD', 55);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) NOT NULL,
  `product_qty` int NOT NULL,
  `amount` float NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `min_qty` int NOT NULL,
  `added_to_home` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `product_name`, `product_qty`, `amount`, `image`, `description`, `min_qty`, `added_to_home`) VALUES
(12, 'Straws', 151, 10, 'paperstraws.jpg', 'Colorful straws', 200, 'No'),
(13, 'Carboards', 297, 20, 'carboardsandboxcollage.jpg', 'Strong , durable ', 200, 'No'),
(11, 'Paper Bags', 246, 20, 'shoppingbagscollage.jpg', 'Good and  affordable paper bags', 200, 'No'),
(10, 'Envelopes', 300, 4, 'envelopscollage.jpg', 'Small ,medium,large,printed are available', 300, 'Yes'),
(9, 'Paper Diary', 295, 50, 'paperdiarycollage.jpg', 'Good quality', 300, 'No'),
(14, 'Paper bags', 980, 25, 'paperbagcontactus.jpg', 'good', 10, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

DROP TABLE IF EXISTS `product_review`;
CREATE TABLE IF NOT EXISTS `product_review` (
  `pr_id` int NOT NULL AUTO_INCREMENT,
  `p_id` int DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `reviews` varchar(100) DEFAULT NULL,
  `ratings` int DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  KEY `p_id` (`p_id`),
  KEY `c_id` (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`pr_id`, `p_id`, `c_id`, `reviews`, `ratings`) VALUES
(8, 13, 7, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_ratings`
--

DROP TABLE IF EXISTS `reviews_ratings`;
CREATE TABLE IF NOT EXISTS `reviews_ratings` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `c_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `Review` varchar(200) DEFAULT NULL,
  `ratings` int DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  KEY `c_id` (`c_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
