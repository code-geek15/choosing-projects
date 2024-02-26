-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 11:34 AM
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
-- Database: `geekschat`
--

-- --------------------------------------------------------

--
-- Table structure for table `last_seen`
--

CREATE TABLE `last_seen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `last_seen`
--

INSERT INTO `last_seen` (`id`, `user_id`, `message_id`) VALUES
(1, 1, 18),
(2, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recvId` int(11) NOT NULL,
  `body` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `recvIsGroup` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `recvId`, `body`, `time`, `status`, `recvIsGroup`) VALUES
(3, 2, 1, 'Hi neo', '2023-09-26 08:07:23', 2, 0),
(4, 3, 2, 'Hi Kgaugelo', '2023-09-26 08:08:20', 2, 0),
(5, 1, 2, 'Hi Kgau', '2023-09-26 08:08:48', 2, 0),
(15, 2, 1, 'csdcsddcscsc', '2023-09-28 15:22:45', 2, 0),
(16, 2, 1, 'rgg', '2023-09-28 15:24:49', 2, 0),
(17, 2, 1, 'Hi Neo', '2023-09-28 15:42:25', 2, 0),
(18, 2, 1, 'E cheeseboy', '2023-09-29 08:04:41', 2, 0),
(19, 1, 2, 'E lepara', '2023-09-29 08:05:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `user_type` varchar(32) DEFAULT NULL,
  `number` varchar(32) NOT NULL DEFAULT '+12345678910',
  `pic` varchar(32) NOT NULL DEFAULT '-1.jpg',
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `number`, `pic`, `password`) VALUES
(1, 'Neo', 'wagner.fillio@gmail.com', 'chat_user', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Kgaugelo', 'anish@gmail.com', 'chat_user', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Thato', 'kgau@gmail.com', 'chat_user', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'abu', 'solly@gmail.com', 'chat_user', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(10, 'Admin', 'admin@1234', 'admin', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'Thembi', 'thembi@1234', 'chat_user', '+12345678910', '-1.jpg', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `last_seen`
--
ALTER TABLE `last_seen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `last_seen`
--
ALTER TABLE `last_seen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
