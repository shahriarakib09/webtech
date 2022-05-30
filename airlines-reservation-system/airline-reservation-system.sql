-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 08:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airline-reservation-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(4) NOT NULL,
  `airline_name` varchar(20) NOT NULL,
  `contact_info` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_name`, `contact_info`) VALUES
(6, 'Emirates', 'emirates@agents.info'),
(12, 'Turkish Airlines', 'turkishair@contact.tk'),
(17, 'Etihad Airways', 'contact@etihad.info'),
(56, 'Qatar Airways', 'www.qatarairways.com'),
(57, 'Air New Zealand Grou', 'www.airnewzealand.co.nz'),
(58, 'Jet Airways', 'www.jet-airways.com'),
(59, 'Malaysia Airlines', 'www.maskargo.com'),
(60, 'Singapore Airlines', 'www.singaporeair.com'),
(61, 'Thai Airways Interna', ''),
(62, 'Air France KLM', 'www.airfrance.com'),
(63, 'British Airways', 'www.britishairways.com'),
(64, 'Lufthansa', 'www.lufthansa.com'),
(65, 'Swiss', 'www.swiss.com'),
(66, 'Turkish Airlines ', 'www.turkishairlines.com');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) NOT NULL,
  `airport_name` varchar(50) NOT NULL,
  `iata` varchar(12) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `airport_name`, `iata`, `location`) VALUES
(1, 'Hazrat Shahjalal International Airport', 'DAC', 'Dhaka, Bangladesh'),
(2, 'Barishal Airport', 'BZL', 'Barishal, Bangladesh'),
(3, 'Shah Makhdum Airport, Rajshahi', 'RJH', 'Rajshahi, Bangladesh'),
(4, 'Saidpur Airport', 'SPD', 'Saidpur, Bangladesh'),
(5, 'Cox\'s Bazar Airport', 'CXB', 'Cox\'s Bazar, Bangladesh'),
(6, 'Shah Amanat International Airport', 'CGP', 'Chittagong, Bangladesh'),
(7, 'Osmani International Airport', 'ZYL', 'Sylhet, Bangladesh'),
(8, 'Amsterdam Airport Schiphol', 'AMS', 'Amsterdam, Netherlands'),
(9, 'Dubai International Airport', 'DXB', 'Dubai, United Arab Emirates'),
(10, 'Birmingham International Airport', 'BHX', 'Birmingham, United kingdom'),
(11, 'Liverpool John Lennon Airport', 'LPL', 'Liverpool, United kingdom'),
(12, 'London City Airport', 'LCY', 'London, United kingdom'),
(13, 'Manchester Airport', 'MAN', 'Manchester, United kingdom'),
(14, 'Newcastle Airport', 'NCL', 'Newcastle upon Tyne, United kingdom'),
(15, 'Stockholm-Arlanda Airport', 'ARN', 'Stockholm, Sweden'),
(16, 'Brisbane Airport', 'BNE', 'Brisbane, Australia'),
(17, 'Melbourne Airport', 'MEL', 'Melbourne, Australia'),
(18, 'Auckland Airport', 'AKL', 'Auckland, New Zealand'),
(19, 'Oslo Airport-Gardermoen', 'OSL', 'Oslo, Norway'),
(20, 'Copenhagen Airport', 'CPH', 'Copenhagen, Denmark'),
(21, 'Istanbul Airport', 'IST', 'Istanbul, Turkey'),
(22, 'Domodedovo International Airport', 'DME', 'Moscow, Russia'),
(23, 'Malpensa Airport', 'MXP', 'Milan, Italy'),
(24, 'Capodichino Airport', 'NAP', 'Naples, italy'),
(25, 'Leonardo da Vinci-Fiumicino Airport', 'FCO', 'Rome, Italy'),
(26, 'Geneva International Airport', 'GVA', 'Geneva, Switzerland'),
(27, 'Budapest Ferenc Liszt International Airport', 'BUD', 'Budapest, Hungary'),
(28, 'Berlin Brandenburg Airport', 'BER', 'Berlin, Germany'),
(29, 'Munich Airport', 'MUC', 'Munich, Germany'),
(30, 'Vienna International Airport', 'VIE', 'Vienna, Austria'),
(31, 'Barcelona Airport', 'BCN', 'Barcelona, Spain'),
(32, 'Madrid-Barajas Airport', 'MAD', 'Madrid, Spain'),
(33, 'Charles de Gaulle Airport', 'CDG', 'Paris, France'),
(34, 'Baghdad International Airport', 'BGW', 'Baghdad, Iraq'),
(35, 'Singapore Changi Airport', 'SIN', 'Singapore, Singapore'),
(36, 'Penang International Airport', 'PEN', 'Penang, Malaysia'),
(37, 'Soekarno Hatta International Airport', 'CGK', 'Jakarta, Indonesia'),
(38, 'Bandaranaike International Airport', 'CMB', 'Colombo, Sri Lanka'),
(39, 'Islamabad International Airport', 'ISB', 'Islamabad, Pakistan'),
(40, 'Tribhuvan International Airport', 'KTM', 'Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(8) NOT NULL,
  `passenger_id` int(8) NOT NULL,
  `flight_id` varchar(8) NOT NULL,
  `airline_id` int(8) NOT NULL,
  `ticket_type` varchar(12) NOT NULL,
  `booking_date` varchar(22) NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `passenger_id`, `flight_id`, `airline_id`, `ticket_type`, `booking_date`, `price`) VALUES
(3, 32, 'TK-812', 12, 'Business', '2021-06-29', 350),
(5, 77, 'BS-321', 7, 'Business', '2021-06-29', 220),
(7, 17, 'EK-312', 6, 'Economy', '2021-06-29', 450),
(8, 22, 'EK-312', 6, 'Economy', '2021-06-29', 450);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` varchar(12) NOT NULL,
  `airline_id` int(4) NOT NULL,
  `departure` varchar(20) NOT NULL,
  `arrival` varchar(20) NOT NULL,
  `dtime` varchar(22) NOT NULL,
  `atime` varchar(22) NOT NULL,
  `total_capacity` int(11) NOT NULL,
  `available_capacity` int(4) NOT NULL,
  `eprice` int(11) NOT NULL,
  `bprice` int(11) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `airline_id`, `departure`, `arrival`, `dtime`, `atime`, `total_capacity`, `available_capacity`, `eprice`, `bprice`, `status`) VALUES
('AF-1631', 62, 'MPX', 'CDG', '2021-08-17T06:00', '2021-08-17T07:35', 80, 80, 350, 550, '1'),
('BA-652', 63, 'BHX', 'CPH', '2021-08-17T16:45', '2021-08-17T21:45', 95, 95, 255, 415, '1'),
('EK-312', 6, 'DXB', 'CGP', '2021-06-28T14:00', '2021-06-29T23:45', 70, 68, 450, 620, '1'),
('LC-707', 63, 'LCY', 'MEL', '2021-08-17T06:00', '2021-08-18T15:15', 120, 120, 518, 736, '1'),
('LX-1613', 65, 'MPX', 'CDG', '2021-08-17T09:50', '2021-08-17T13:30', 100, 100, 400, 700, '1'),
('ML-806', 59, 'DAC', 'PEN', '2021-08-17T19:55', '2021-08-17T23:10', 100, 100, 165, 225, '1'),
('TK-832', 12, 'DXB', 'AMS', '2021-06-29T02:10', '2021-06-30T16:30', 45, 45, 420, 620, '1');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(6) NOT NULL,
  `flight_id` varchar(12) NOT NULL,
  `passenger_id` int(5) NOT NULL,
  `amount` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `flight_id`, `passenger_id`, `amount`) VALUES
(1, 'EK-312', 22, 450);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_no` int(11) NOT NULL,
  `passport` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `date_of_birth`, `phone_no`, `passport`) VALUES
(1, 'akib', '123', 'shahriarakib09@gmail.com', '2021-06-15', 78747, 'dfa1200'),
(2, 'shahriar', '456', 'aezakmi_akib@yahoo.com', '2021-06-19', 17968957, '4757xqedd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_name` (`admin_name`),
  ADD KEY `admin_password` (`admin_password`),
  ADD KEY `admin_name_2` (`admin_name`),
  ADD KEY `admin_password_2` (`admin_password`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `password` (`password`),
  ADD KEY `email` (`email`),
  ADD KEY `date_of_birth` (`date_of_birth`),
  ADD KEY `phone_no` (`phone_no`),
  ADD KEY `passport` (`passport`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
