-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 12:28 PM
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
-- Database: `evproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BOOK_ID` int(11) NOT NULL,
  `EV_ID` int(11) NOT NULL,
  `EV_NAME` varchar(255) NOT NULL,
  `EV_MODEL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `COLOR` varchar(10) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_STATUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BOOK_ID`, `EV_ID`, `EV_NAME`, `EV_MODEL`, `BOOK_PLACE`, `BOOK_DATE`, `PHONE_NUMBER`, `DESTINATION`, `PRICE`, `COLOR`, `CREATED_AT`, `EMAIL`, `BOOK_STATUS`) VALUES
(1, 1, 'OLA', 'OLA', 'Ahmedabad', '2025-05-29', 6355631170, 'Gandhinaagr', 152000.00, '#000000', '2025-05-29 09:14:34', 'sachin.shiva635@gmail.com', 'APPROVED'),
(2, 1, 'OLA', 'S1 PRO', 'Ahmadabad (M Corp.) (Part)', '2025-05-29', 5896954213, 'Gandhinaagr', 152000.00, '#000000', '2025-05-29 09:16:53', 'sachin.shiva635@gmail.com', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'PANCHAL SACHIN HITESHBHAI', 'sachin.shiva635@gmail.com', 'HI', '2025-05-29 09:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `ev`
--

CREATE TABLE `ev` (
  `EV_ID` int(11) NOT NULL,
  `EV_NAME` varchar(100) NOT NULL,
  `EV_IMG` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(50) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `AVAILABLE` char(1) NOT NULL DEFAULT 'Y',
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ev`
--

INSERT INTO `ev` (`EV_ID`, `EV_NAME`, `EV_IMG`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `AVAILABLE`, `CREATED_AT`) VALUES
(1, 'OLA S1', 'ola.jpg', 'Electric', 1, 152000.00, 'Y', '2025-05-29 08:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL,
  `RATING` int(11) NOT NULL CHECK (`RATING` between 1 and 5),
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`, `RATING`, `submitted_at`) VALUES
(1, 'sachin.shiva635@gmail.com', 'Nice', 5, '2025-05-29 09:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAYMENT_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(19) NOT NULL,
  `EXP_DATE` varchar(5) NOT NULL,
  `CVV` varchar(4) NOT NULL,
  `CARD_TYPE` varchar(20) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `PAYMENT_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAYMENT_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `CARD_TYPE`, `PRICE`, `PAYMENT_DATE`) VALUES
(1, 1, '5611851918518948', '01/26', '526', 'Maestro', 152000, '2025-05-29 09:15:08'),
(2, 2, '4518848252651541', '11/26', '212', 'VISA', 152000, '2025-05-29 09:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `FNAME` varchar(100) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `PHONE_NUMBER` varchar(15) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` enum('Male','Female') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `FNAME`, `LNAME`, `EMAIL`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`, `created_at`) VALUES
(1, 'PANCHAL', 'HITESHBHAI', 'sachin.shiva635@gmail.com', '6355631170', 'Sachin@1170', 'Male', '2025-05-29 08:52:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BOOK_ID`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ev`
--
ALTER TABLE `ev`
  ADD PRIMARY KEY (`EV_ID`),
  ADD UNIQUE KEY `EV_ID` (`EV_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAYMENT_ID`),
  ADD KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ev`
--
ALTER TABLE `ev`
  MODIFY `EV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAYMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `bookings` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
