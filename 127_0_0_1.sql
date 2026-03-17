-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2026 at 10:46 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_db`
--
CREATE DATABASE IF NOT EXISTS `car_rental_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `car_rental_db`;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `car_id` int NOT NULL,
  `booking_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `car_id`, `booking_date`, `total_amount`) VALUES
(1, 2, 5, '2026-03-17 14:42:17', 9000.00),
(2, 2, 2, '2026-03-17 14:42:38', 9000.00),
(3, 2, 2, '2026-03-17 14:43:02', 9000.00);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `price`, `status`) VALUES
(1, 'Honda', 'Civic', 4000.00, 'Available'),
(2, 'Toyota ', 'Fortuner', 8000.00, 'Available'),
(3, 'Toyota ', 'Camry', 5000.00, 'Available'),
(4, 'Suzuki', 'SX4', 9000.00, 'Available'),
(5, 'Ford', 'Ecosport', 8000.00, 'Available'),
(6, 'Suzuki', 'K10', 6000.00, 'Available'),
(7, 'Tata', 'Sierra', 7000.00, 'Available'),
(8, 'Tata ', 'Tiago', 4000.00, 'Available'),
(9, 'Mahindra ', 'XUV 3X0', 6000.00, 'Available'),
(10, 'Mahindra', 'XUV 7X0', 6000.00, 'Available'),
(11, 'Kia', 'Seltos', 6000.00, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `user_type`) VALUES
(1, 'Medhansh Deol', 'medhanshdeol@gmail.com', '$2y$10$68ma/SKTUCkaNNQHcY.5rueRbyqm6PP.vTQW4osJ06Rf6LubNS376', 'customer'),
(2, 'Ansel Sharma', 'anseldsharma2006@gmail.com', '$2y$10$E.x9NxLVkc9QRt1qabb5ROweJexJNqwV/tvReynbMGOmuVKPfiWJa', 'customer');
--
-- Database: `payroll_mngmnt`
--
CREATE DATABASE IF NOT EXISTS `payroll_mngmnt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `payroll_mngmnt`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_days` int DEFAULT NULL,
  `leaves` int DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL,
  `department_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `location`) VALUES
(1, 'HR', 'Delhi'),
(2, 'IT', 'Bangalore'),
(3, 'Finance', 'Mumbai'),
(4, 'Marketing', 'Pune'),
(5, 'Human Resources', 'Jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id` int NOT NULL,
  `designation_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `designation_id` int DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `department_id` (`department_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `payroll_id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`payroll_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_allowance`
--

DROP TABLE IF EXISTS `payroll_allowance`;
CREATE TABLE IF NOT EXISTS `payroll_allowance` (
  `allowance_id` int NOT NULL,
  `allowance_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payroll_id` int DEFAULT NULL,
  PRIMARY KEY (`allowance_id`),
  KEY `payroll_id` (`payroll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction`
--

DROP TABLE IF EXISTS `payroll_deduction`;
CREATE TABLE IF NOT EXISTS `payroll_deduction` (
  `deduction_id` int NOT NULL,
  `deduction_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payroll_id` int DEFAULT NULL,
  PRIMARY KEY (`deduction_id`),
  KEY `payroll_id` (`payroll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
