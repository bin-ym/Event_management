-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 09:04 AM
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
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `package_id`, `booking_date`, `status`) VALUES
(1, 4, 9, '2024-05-25 08:02:47', 'confirmed'),
(2, 4, 13, '2024-05-25 08:03:20', 'confirmed'),
(3, 4, 15, '2024-05-25 08:13:20', 'confirmed'),
(4, 4, 15, '2024-05-25 08:14:21', 'confirmed'),
(5, 4, 9, '2024-05-26 21:15:25', 'confirmed'),
(6, 4, 9, '2024-05-26 22:33:44', 'confirmed'),
(7, 4, 9, '2024-05-27 07:40:39', 'confirmed'),
(8, 5, 12, '2024-05-27 08:36:51', 'confirmed'),
(9, 4, 15, '2024-05-27 08:38:40', 'confirmed'),
(10, 4, 15, '2024-05-27 08:39:40', 'confirmed'),
(11, 4, 15, '2024-05-27 08:39:43', 'confirmed'),
(12, 4, 15, '2024-05-27 08:39:46', 'confirmed'),
(13, 4, 15, '2024-05-27 08:40:28', 'confirmed'),
(14, 4, 15, '2024-05-27 08:41:10', 'confirmed'),
(15, 4, 15, '2024-05-27 08:43:38', 'confirmed'),
(16, 5, 15, '2024-05-27 08:46:53', 'confirmed'),
(17, 5, 15, '2024-05-27 08:47:28', 'confirmed'),
(18, 5, 15, '2024-05-27 08:52:13', 'confirmed'),
(19, 5, 11, '2024-05-27 08:59:31', 'confirmed'),
(20, 5, 15, '2024-05-27 09:00:00', 'confirmed'),
(21, 5, 15, '2024-05-27 09:00:01', 'confirmed'),
(22, 5, 15, '2024-05-27 09:00:01', 'confirmed'),
(23, 5, 15, '2024-05-27 09:00:17', 'confirmed'),
(24, 5, 11, '2024-05-27 09:04:01', 'confirmed'),
(25, 5, 11, '2024-05-27 09:04:25', 'confirmed'),
(26, 5, 11, '2024-05-27 09:04:27', 'confirmed'),
(27, 5, 11, '2024-05-27 09:04:36', 'confirmed'),
(28, 5, 11, '2024-05-27 09:05:38', 'confirmed'),
(29, 5, 11, '2024-05-27 09:05:43', 'confirmed'),
(30, 5, 11, '2024-05-27 09:06:53', 'confirmed'),
(31, 5, 11, '2024-05-27 09:07:08', 'confirmed'),
(32, 5, 11, '2024-05-27 09:07:30', 'confirmed'),
(33, 4, 11, '2024-05-27 10:15:52', 'confirmed'),
(34, 5, 11, '2024-05-27 10:36:55', 'confirmed'),
(35, 8, 11, '2024-05-30 09:02:46', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `package_details` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `package_details`, `image`) VALUES
(1, 'Conference', 'Details about conference packages', ''),
(2, 'Workshop', 'Details about workshop packages', ''),
(3, 'Seminar', 'Details about seminar packages', ''),
(4, 'Birthday', 'Details about BDpackages', ''),
(7, 'Sad', 'dfefs', 'Screenshot (74).png'),
(8, 'Graduation', 'Congra', 'Screenshot (165).png'),
(11, 'Melk', 'ghxf', 'Screenshot (44)_edited.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_reports`
--

CREATE TABLE `event_reports` (
  `report_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_reports`
--

INSERT INTO `event_reports` (`report_id`, `manager_id`, `package_id`, `report`, `date`) VALUES
(1, 2, 9, 'yoo', '2024-05-24 23:46:13'),
(2, 2, 12, 'ghfghfh', '2024-05-24 23:49:22'),
(3, 2, 12, 'ghfghfh', '2024-05-24 23:49:51'),
(4, 2, 12, 'seems good', '2024-05-24 23:53:24'),
(5, 2, 12, 'seems good', '2024-05-24 23:54:20'),
(6, 2, 9, 'hgfhf', '2024-05-24 23:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `message`) VALUES
(1, 4, 'Great conference!'),
(2, 5, 'Looking forward to more workshops.'),
(3, 4, 'hey\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `name`, `user_id`) VALUES
(1, 'Manager One', 2),
(2, 'Manager Two', 3);

-- --------------------------------------------------------

--
-- Table structure for table `manager_packages`
--

CREATE TABLE `manager_packages` (
  `manager_package_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `level` enum('silver','gold','platinum') NOT NULL,
  `manager_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `category_id`, `package_name`, `level`, `manager_id`, `start_date`, `end_date`, `description`, `price`) VALUES
(9, 1, 'mo', 'silver', 2, '2024-05-26', '2024-05-26', 'nooo', 150.00),
(11, 7, 'moq', 'gold', 2, '2024-05-31', '2024-06-07', 'sdd', 100.00),
(12, 3, 'Sem', 'platinum', 2, '2024-05-25', '2024-05-25', 'dgdg', 200.00),
(13, 8, 'Your', 'silver', 1, '2024-05-25', '2024-05-25', 'Your Graduation', 0.00),
(15, 7, 'lo', 'silver', 1, '2024-05-30', '2024-06-01', 'dvfdv', 100.00),
(16, 2, 'work', 'platinum', 2, '2024-05-31', '2024-06-07', 'Vdgdguavd', 200.00),
(17, 11, 'M p', 'platinum', 1, '2024-05-31', '2024-06-07', 'hgfhgf', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'z', '1234', 'admin'),
(2, 'b', '1234', 'manager'),
(3, 'yo', '1234', 'manager'),
(4, 'ym', '1221', 'user'),
(5, 'my', '1234', 'user'),
(7, 'c', '1111', 'user'),
(8, 'Melka', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_balance`
--

CREATE TABLE `user_balance` (
  `user_id` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_balance`
--

INSERT INTO `user_balance` (`user_id`, `balance`) VALUES
(4, 1100.00),
(5, 41100.00),
(8, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_package`
--

CREATE TABLE `user_package` (
  `user_package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_package`
--

INSERT INTO `user_package` (`user_package_id`, `user_id`, `package_name`, `level`, `description`, `status`) VALUES
(1, 4, 'Zola', 'silver', 'fsdfsdgfd', 'rejected'),
(2, 4, 'Zo', 'platinum', 'fdsfsdvgvbb', 'rejected'),
(3, 5, 'my', 'silver', 'dfgdfd', 'pending'),
(4, 5, 'fdsfsd', 'platinum', 'vdfbvdfb', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_packages`
--

CREATE TABLE `user_packages` (
  `user_package_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `level` enum('silver','gold','platinum') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_packages`
--

INSERT INTO `user_packages` (`user_package_id`, `user_id`, `package_name`, `level`, `start_date`, `end_date`, `description`, `price`, `status`) VALUES
(1, 4, 'User Conference Package', 'gold', '2024-06-01', '2024-06-03', 'User requested package for conference', 2000.00, 'pending'),
(2, 5, 'User Workshop Package', 'silver', '2024-07-01', '2024-07-02', 'User requested package for workshop', 800.00, 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `event_reports`
--
ALTER TABLE `event_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `manager_packages`
--
ALTER TABLE `manager_packages`
  ADD PRIMARY KEY (`manager_package_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_balance`
--
ALTER TABLE `user_balance`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_package`
--
ALTER TABLE `user_package`
  ADD PRIMARY KEY (`user_package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD PRIMARY KEY (`user_package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_reports`
--
ALTER TABLE `event_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager_packages`
--
ALTER TABLE `manager_packages`
  MODIFY `manager_package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_package`
--
ALTER TABLE `user_package`
  MODIFY `user_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_packages`
--
ALTER TABLE `user_packages`
  MODIFY `user_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`manager_id`) ON DELETE CASCADE;

--
-- Constraints for table `event_reports`
--
ALTER TABLE `event_reports`
  ADD CONSTRAINT `event_reports_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `event_reports_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `manager_packages`
--
ALTER TABLE `manager_packages`
  ADD CONSTRAINT `manager_packages_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `manager_packages_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `managers` (`manager_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_balance`
--
ALTER TABLE `user_balance`
  ADD CONSTRAINT `user_balance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_package`
--
ALTER TABLE `user_package`
  ADD CONSTRAINT `user_package_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD CONSTRAINT `user_packages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
