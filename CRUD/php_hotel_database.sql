-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 12:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_hotel_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `servicePlanId` int(11) DEFAULT NULL,
  `roomId` int(11) DEFAULT NULL,
  `checkInDate` varchar(200) DEFAULT NULL,
  `checkOutDate` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`_id`, `userId`, `servicePlanId`, `roomId`, `checkInDate`, `checkOutDate`, `status`, `cost`) VALUES
(31, 47, 7, 7, '2024-01-11', '2024-01-13', NULL, 640),
(32, 47, 7, 9, '2024-01-06', '2024-01-13', 'Pending', 0),
(33, 47, 7, 9, '2024-01-06', '2024-01-13', 'Pending', 0),
(34, 47, 5, 7, '2024-01-06', '2024-01-08', 'Pending', 0),
(35, 47, 5, 7, '2024-02-02', '2024-02-10', 'Pending', 0),
(36, 47, 5, 7, '2024-01-25', '2024-01-27', 'Pending', 0),
(37, 48, 5, 7, '2024-01-18', '2024-01-28', 'Pending', 0),
(38, 82, 7, 10, '2024-01-20', '2024-01-30', NULL, 3040);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `_id` int(11) NOT NULL,
  `booked` tinyint(1) DEFAULT 0,
  `num_beds` int(11) DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`_id`, `booked`, `num_beds`, `image`, `cost`, `name`, `description`) VALUES
(7, 1, 3, 'room-3.jpg', 300, 'Family Room', 'qwertyuiopasdfghjklzxcvbnm'),
(8, 0, 1, 'room-1.jpg', 40, 'Standard Room', 'haha'),
(9, 0, 2, 'room-6.jpg', 300, 'Luxury Room', ''),
(10, 1, 3, 'room-3.jpg', 300, 'Family Room', ''),
(11, 0, 1, 'room-1.jpg', 40, 'Standard Room', '');

-- --------------------------------------------------------

--
-- Table structure for table `serviceplan`
--

CREATE TABLE `serviceplan` (
  `_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceplan`
--

INSERT INTO `serviceplan` (`_id`, `name`, `description`, `cost`) VALUES
(5, 'Plan X', 'hmmmX', 50),
(7, 'p1', 'Sweet Dreems', 40),
(9, 'Live It', '2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `_id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`_id`, `userName`, `firstName`, `lastName`, `phoneNumber`, `email`, `password`, `address`) VALUES
(47, 'xxx', NULL, NULL, '777', 'xxx@hotmail.com', 'xxx', NULL),
(48, 'yyy', NULL, NULL, '999999999', 'y@y.com', 'yyy', NULL),
(49, 'f', 'f', 'f', '0', 'f@f.com', 'f', 'f'),
(50, 'g', 'g', 'g', '1', 'g@g.com', 'g', 'g'),
(51, 'z', 'z', 'z', '0', 'z@z.z', 'z', 'z'),
(52, 'l', 'LALA', 'LULU', '8', 'l@l.l', 'l', 'l'),
(53, 'jjj', 'jjj', 'jjj', '222', 'jjj@hotmail.com', 'jjj', 'jjj'),
(54, 'lu', NULL, NULL, 'lu', 'lu@lu.lu', 'lu', NULL),
(55, 'm', 'm', 'm', '4444', 'm@gmail.com', 'm', 'm'),
(56, 'admin', NULL, NULL, NULL, '', 'admin', NULL),
(57, 'o', 'o', 'o', '111', 'o@o.o', 'o', 'o'),
(58, 'hsen', NULL, NULL, '777', 'hsen@gmail.com', 'hsen', NULL),
(82, 'c', 'c', 'c', '3', 'c@gmail.com', 'c', 'c'),
(83, 'x', 'x', 'x', '123456789', 'x@hotmail.com', 'x', 'x'),
(84, 'a', 'a', 'a', '1', 'a@a.a', 'a', 'a'),
(85, 'hasan', 'Hasan', 'Jaffal', '71237348', 'hasan@hotmail.com', 'hasan', 'Sour');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `servicePlanId` (`servicePlanId`),
  ADD KEY `fk_booking_user` (`userId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `serviceplan`
--
ALTER TABLE `serviceplan`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `serviceplan`
--
ALTER TABLE `serviceplan`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_room` FOREIGN KEY (`roomId`) REFERENCES `room` (`_id`),
  ADD CONSTRAINT `fk_booking_serviceplan` FOREIGN KEY (`servicePlanId`) REFERENCES `serviceplan` (`_id`),
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`userId`) REFERENCES `user` (`_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
