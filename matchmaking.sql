-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matchmaking`
--

-- --------------------------------------------------------

-- Drop dependent tables first
DROP TABLE IF EXISTS `job_details`;
DROP TABLE IF EXISTS `property_details`;
DROP TABLE IF EXISTS `family_information`;
DROP TABLE IF EXISTS `educational_details`;
DROP TABLE IF EXISTS `achievements`;
DROP TABLE IF EXISTS `profiles`;
DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `subscriptions`;

-- Drop the main tables
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `adminlogin`;

-- --------------------------------------------------------

-- Table structure for table `adminlogin`
CREATE TABLE `adminlogin` (
  `aid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `adminlogin`
INSERT INTO `adminlogin` (`aid`, `username`, `email`, `password`) VALUES
(1, 'MaidaButt', 'maidabutt2004@gmail.com', '1234'),
(2, 'NomanCheema', 'nomancheema22@gmail.com', '1122');

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
    `uid` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(200) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(500) NOT NULL,
    `profile_pic` VARCHAR(255) DEFAULT NULL,
    `profile_status` ENUM('active', 'inactive') DEFAULT 'inactive',
    `is_premium` BOOLEAN DEFAULT FALSE,
    `name` VARCHAR(255) NOT NULL,
    `age` INT NOT NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `height` VARCHAR(50),
    `caste` VARCHAR(100),
    `religion` VARCHAR(100),
    `dob` DATE NOT NULL,
    `address` VARCHAR(255),
    `image_url` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
INSERT INTO `users` (uid, username, email, password, profile_pic, profile_status, is_premium, name, age, gender, height, caste, religion, dob, address, image_url)
VALUES
(1, 'maida', 'maida@gmail.com', '1234', 'g2.jpg', 'active', TRUE, 'Maida Kosser', 25, 'female', '5\'6"', 'Butt', 'Muslim', '1998-01-01', 'Lahore, Pakistan', 'profile_pics/maidabutt.jpg'),
(2, 'noman', 'noman@gmail.com', '1122', 'p3.jpg', 'inactive', FALSE, 'Noman Cheema', 28, 'male', '5\'8"', 'Cheema', 'Muslim', '1996-05-10', 'Multan, Pakistan', 'profile_pics/nomanc.jpg');

-- --------------------------------------------------------

-- Table structure for table `profiles`
CREATE TABLE `profiles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `matrimony_id` VARCHAR(50) UNIQUE NOT NULL,
    `status` ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Inactive',
    `profile_picture` VARCHAR(255),
    `contact_views` INT DEFAULT 0,
    `photo_views` INT DEFAULT 0,
    `chat_limit` INT DEFAULT 0,
    `location` VARCHAR(255),
    `religion` VARCHAR(100),
    `profession` VARCHAR(100),
    `education` VARCHAR(100),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `profiles`
INSERT INTO `profiles` (user_id, name, matrimony_id, status, profile_picture, contact_views, photo_views, chat_limit, location, religion, profession, education) VALUES
(1, 'Noman', '2954835', 'Active', 'boy.webp', 2, 1, 5, 'Lahore, Pakistan', 'Muslim (Hanafi)', 'Software Engineer', 'Masters'),
(2, 'Sara', '2954838', 'Inactive', 'g2.jpg', 3, 2, 12, 'Multan, Pakistan', 'Muslim (Hanafi)', 'Engineer', 'Bachelors');

-- --------------------------------------------------------

-- Table structure for table `payments`
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `payments`
INSERT INTO `payments` (`payment_id`, `uid`, `plan`, `amount`, `payment_date`) VALUES
(1, 1, 'Premium', '19.99', '2024-08-01'),
(2, 2, 'Free', '0.00', '2024-08-01');

-- --------------------------------------------------------

-- Table structure for table `subscriptions`
CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `plan` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`subscription_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `subscriptions`
INSERT INTO `subscriptions` (`subscription_id`, `uid`, `plan`, `start_date`, `end_date`) VALUES
(1, 1, 'Premium', '2024-08-01', '2025-08-01'),
(2, 2, 'Free', '2024-08-01', '2025-08-01');

-- --------------------------------------------------------

-- Table structure for table `job_details`
CREATE TABLE `job_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `personal_id` INT,
    `income` DECIMAL(10, 2),
    `job_title` VARCHAR(255),
    `designation` VARCHAR(255),
    `earning` DECIMAL(10, 2),
    FOREIGN KEY (`personal_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `property_details`
CREATE TABLE `property_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `personal_id` INT,
    `property_name` VARCHAR(255),
    `price` DECIMAL(10, 2),
    `location` VARCHAR(255),
    `size` VARCHAR(100),
    FOREIGN KEY (`personal_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `family_information`
CREATE TABLE `family_information` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `personal_id` INT,
    `siblings` INT,
    `married_persons` INT,
    `father_occupation` VARCHAR(255),
    `mother_occupation` VARCHAR(255),
    FOREIGN KEY (`personal_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `educational_details`
CREATE TABLE `educational_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `personal_id` INT,
    `degree` VARCHAR(255),
    `institute` VARCHAR(255),
    `year` VARCHAR(10),
    FOREIGN KEY (`personal_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Table structure for table `achievements`
CREATE TABLE `achievements` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `personal_id` INT,
    `achievement` TEXT,
    FOREIGN KEY (`personal_id`) REFERENCES `users`(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
