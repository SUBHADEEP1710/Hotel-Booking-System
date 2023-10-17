-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 01:49 PM
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
-- Database: `hoteldatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotelrooms`
--

CREATE TABLE `hotelrooms` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_type` varchar(50) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotelrooms`
--

INSERT INTO `hotelrooms` (`room_id`, `hotel_id`, `room_type`, `capacity`, `price`, `available`) VALUES
(1, 1, 'Single', 1, 2000.00, 1),
(2, 1, 'Double', 3, 4500.00, 0),
(3, 1, 'Suite', 4, 7000.00, 1),
(4, 2, 'Single', 1, 4500.00, 1),
(5, 2, 'Double', 3, 5500.00, 1),
(6, 2, 'Suite', 5, 8500.00, 1),
(7, 3, 'Single', 1, 2300.00, 1),
(8, 3, 'Double', 3, 5500.00, 1),
(9, 3, 'Suite', 5, 7500.00, 1),
(10, 4, 'Single', 2, 5500.00, 1),
(11, 4, 'Double', 4, 9200.00, 1),
(12, 4, 'Suite', 8, 15000.00, 1),
(13, 5, 'Single', 1, 3550.00, 1),
(14, 5, 'Double', 3, 4500.00, 0),
(15, 5, 'Suite', 4, 6000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `total_rooms` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `location`, `check_in_time`, `check_out_time`, `total_rooms`, `phone_number`, `address`, `image_url`) VALUES
(1, 'OceanView Inn', 'Goa', '00:08:00', '00:10:00', 12, '9675463823', 'Main Candolim Road,India', 'https://symphony.cdn.tambourine.com/ocean-view-hotel/media/cache/OceanView-ReasonToStay-Scenic-Views-new-5a04bf9a2639d-470x332.jpg'),
(2, 'Mountain Haven Lodge', 'Mumbai', '00:08:00', '00:10:00', 12, '8088084232', 'Andheri, J.B.Nagar,Mumbai', 'https://assets.traveltriangle.com/blog/wp-content/uploads/2015/03/Khyber-Resort_5th-Mar.jpg\r\n '),
(3, 'Sunset Beach resort', 'Chennai', '00:08:00', '00:10:00', 12, '7747838374', 'Egg More, Chennai', 'https://symphony.cdn.tambourine.com/pueblo-bonito-resorts/media/cache/19-PBonito-SunsetB-Gallery-564df400b1582-480x300.jpg'),
(4, 'Mountain Retreat Inn', 'Ooty', '00:08:00', '00:10:00', 12, '9088345231', 'Serene Meadows Road, Ooty', 'https://assets.cntraveller.in/photos/63a53abe79d81704e445de32/master/w_320,c_limit/Skyview%20by%20Empyrean.jpg'),
(5, 'Royal Kolkata Suites', 'Kolkata', '00:08:00', '00:10:00', 15, '9654321830', 'Ballygunge, Kolkata', 'https://www.itchotels.com/content/dam/itchotels/in/umbrella/itc/hotels/itcroyalbengal-kolkata/images/overview-landing-page/accommodation/ITC%20One%20Sitting%20Room.png');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `reserved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `hotel_id`, `room_id`, `check_in_date`, `check_out_date`, `adults`, `children`, `total_price`, `first_name`, `last_name`, `reserved_at`) VALUES
(20, 5, 14, '2023-11-01', '2023-11-03', 2, 1, 9000.00, 'Flynn', 'Rider', '2023-10-16 07:01:40'),
(21, 4, 10, '2023-10-25', '2023-10-27', 2, 0, 11000.00, 'Gulu', 'Puchu', '2023-10-16 07:04:52'),
(23, 3, 9, '2023-11-03', '2023-11-05', 3, 2, 15000.00, 'Holy', 'Moly', '2023-10-16 07:35:30'),
(24, 3, 8, '2023-12-05', '2023-12-20', 1, 1, 82500.00, 'Holy', 'Moly', '2023-10-16 09:09:39'),
(25, 5, 13, '2023-10-24', '2023-10-26', 1, 0, 7100.00, 'Sammy', 'Roy', '2023-10-16 09:31:59'),
(26, 5, 14, '2023-10-24', '2023-10-26', 1, 0, 9000.00, 'Sammy', 'Roy', '2023-10-16 09:33:12'),
(27, 5, 15, '2023-10-24', '2023-10-26', 1, 0, 12000.00, 'Sammy', 'Roy', '2023-10-16 09:36:59'),
(28, 5, NULL, '2023-10-24', '2023-10-26', 1, 0, 0.00, 'Sammy', 'Roy', '2023-10-16 09:37:14'),
(29, 1, NULL, '2023-10-24', '2023-10-28', 3, 0, 0.00, 'Hannah', 'Montanah', '2023-10-16 09:39:26'),
(30, 1, NULL, '2023-10-24', '2023-10-28', 3, 0, 0.00, 'Hannah', 'Montanah', '2023-10-16 09:45:30'),
(31, 5, 14, '2023-10-17', '2023-10-19', 2, 0, 9000.00, 'goru', 'gadha', '2023-10-16 10:21:04'),
(32, 4, NULL, '2023-10-25', '2023-10-27', 2, 1, 0.00, 'goru', 'gadha', '2023-10-16 10:34:06'),
(33, 4, NULL, '2023-10-25', '2023-10-27', 2, 1, 0.00, 'goru', 'gadha', '2023-10-16 11:07:02'),
(34, 3, NULL, '2023-10-24', '2023-10-26', 2, 1, 0.00, 'goru', 'gadha', '2023-10-16 11:29:43'),
(35, 4, NULL, '2023-10-24', '2023-10-26', 2, 0, 0.00, 'Harry ', 'Styles', '2023-10-16 11:47:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotelrooms`
--
ALTER TABLE `hotelrooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `room_id` (`room_id`) USING BTREE,
  ADD KEY `room_id_2` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotelrooms`
--
ALTER TABLE `hotelrooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotelrooms`
--
ALTER TABLE `hotelrooms`
  ADD CONSTRAINT `hotelrooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hotelrooms` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
