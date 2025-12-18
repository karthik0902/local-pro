-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2025 at 03:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `local_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_review` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `short_description` text DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `short_description`, `starting_price`, `duration`, `service_image`) VALUES
(16, 5, 'Switchboard Repair', 'hii helolo', 500.00, '80', 'uploads/services/1766063297_male-electrician-works-switchboard-with-electrical-connecting-cable.jpg'),
(19, 5, 'Deep AC Jet Cleaning', 'Comprehensive deep cleaning of indoor and outdoor AC units using a high-pressure jet pump.', 876.00, '75', 'uploads/services/1766063226_repairman-doing-air-conditioner-service.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `shop_name` varchar(150) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `full_address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `service_radius` int(11) DEFAULT NULL,
  `shop_logo` varchar(255) DEFAULT NULL,
  `social_link` varchar(255) DEFAULT NULL,
  `primary_phone` varchar(20) DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `business_email` varchar(100) DEFAULT NULL,
  `contact_methods` varchar(100) DEFAULT NULL,
  `years_experience` int(11) DEFAULT NULL,
  `is_licensed` tinyint(1) DEFAULT 0,
  `uses_organic` tinyint(1) DEFAULT 0,
  `working_days` varchar(255) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `owner_id`, `shop_name`, `category`, `full_address`, `city`, `service_radius`, `shop_logo`, `social_link`, `primary_phone`, `whatsapp_number`, `business_email`, `contact_methods`, `years_experience`, `is_licensed`, `uses_organic`, `working_days`, `open_time`, `close_time`) VALUES
(5, 3, 'karthik', 'Hair & Beauty Salon', 'hgiugbiuhnio', 'ffrfrfr', 3, 'uploads/logos/1766044281_flat-lay-natural-medicines.jpg', 'https://chatgpt.com/', '8179554909', '9000817853', 'chris@motiv8uk.com', 'call', 33, 1, 1, '10', '01:05:00', '13:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('user','shop_owner') DEFAULT 'user',
  `plan` enum('base','premium') DEFAULT 'base',
  `first_time` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `phone`, `role`, `plan`, `first_time`, `created_at`) VALUES
(1, 'karthik', 'karthik@gmail.com', '$2y$10$pPir9UnfVqcRi4Qnr4fvWORnXz2SBPbG8As0nlDvyM/xGUDni1sOi', '8179554909', 'shop_owner', 'premium', 1, '2025-12-18 07:11:18'),
(2, 'karthik1', 'karthik1@gmail.com', '$2y$10$6/BFf5AEQxYKrpOS4KB2aeAU3YjzJylXba/tJBUv/x918pjvojgL.', '8179554909', 'shop_owner', 'base', 1, '2025-12-18 07:12:31'),
(3, 'shop owner', 'sai.businesslabs@gmail.com', '$2y$10$aDmd49GjazjB4YseraSLYOgBe6xwDGJau2x6K2VKTRelNZ8acRmfW', '8179554909', 'shop_owner', 'base', 1, '2025-12-18 07:21:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
