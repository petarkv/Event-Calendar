-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2020 at 08:19 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Concerts'),
(2, 'Cinemas'),
(3, 'Theatres'),
(4, 'Exhibitions'),
(5, 'Faires'),
(6, 'Conferences'),
(7, 'Party');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(10) NOT NULL,
  `place_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_event` datetime NOT NULL,
  `start_time` time NOT NULL,
  `end_event` datetime NOT NULL,
  `end_time` time NOT NULL,
  `ticket_price` double(10,2) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `created_at`, `title`, `description`, `location_id`, `place_name`, `place_address`, `start_event`, `start_time`, `end_event`, `end_time`, `ticket_price`, `url`, `user_id`, `category_id`, `is_active`) VALUES
(27, '2020-04-03 19:02:09', 'Agnostic Front', 'Godfathers of New York Hardcore', 1, 'SKC', 'Kralja Milana 48', '2020-04-18 00:00:00', '20:00:00', '2020-04-18 00:00:00', '23:30:00', 30.00, 'www.skc.org.rs', 30, 1, 0),
(28, '2020-04-03 19:32:46', 'The Exploited', 'Fuck the System', 4, 'SKC', 'Radoja Domanovica 28', '2020-04-24 20:00:00', '20:00:00', '2020-04-24 00:00:00', '23:30:00', 26.00, 'skckg.com', 30, 1, 0),
(29, '2020-04-03 19:42:10', 'VI festival amaterskih pozorista', 'Ovogodišnje izdanje pozorišnog festivala Kulisa, 6. po redu, održaće se pod sloganom UDAHNI SLOBODNO, i predstaviće najnovija teatarska ostvarenja amaterskih i akademskih pozorišta Srbije i regiona. Kao i prethodne godine, odluku o predstavama koje će se naći u takmičarskoj selekciji doneo je selektor festivala Dragan Jakovljević, pozorišni reditelj. Festival će otvoriti tribina Zakulisni razgovori, čiji će učesnici biti članovi oba žirija, a koja će se održati u Kontakt galeriji SKC-a. U takmičarskom delu festivala naći će se šest predstava, dok će, na samom zatvaranju festivala, u čast nagrađenih, Akademsko pozorište SKC-a izvesti predstavu Totovi.', 4, 'SKC', 'Radoja Domanovica 28', '2020-04-13 20:00:00', '20:00:00', '2020-04-16 22:30:00', '22:30:00', 65.00, 'skckg.com', 30, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_view`
--

CREATE TABLE `event_view` (
  `event_view_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `event_id` int(10) NOT NULL,
  `ip_address` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_view`
--

INSERT INTO `event_view` (`event_view_id`, `created_at`, `event_id`, `ip_address`, `user_agent`) VALUES
(115, '2020-04-03 19:52:01', 29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36'),
(116, '2020-04-03 19:53:30', 29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36'),
(117, '2020-04-04 18:25:17', 27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:74.0) Gecko/20100101 Firefox/74.0'),
(118, '2020-04-16 18:45:34', 27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `name`) VALUES
(1, 'Beograd'),
(2, 'Novi Sad'),
(3, 'Nis'),
(4, 'Kragujevac'),
(5, 'Kraljevo'),
(6, 'Cacak'),
(7, 'Vrnjacka Banja');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `created_at`, `username`, `password`, `email`, `forename`, `surname`, `user_category`, `is_active`) VALUES
(30, '2020-04-04 18:05:46', 'ps', '$2y$10$o6VBjt6Xk1ydq1t1dnABXe8KMcOpSUKLNxdsGwnniYHAV3Tx0yfwO', 'petar@event.com', 'Petar', 'Stankovic', 'admin', 0),
(31, '2020-04-04 18:02:13', 'dd', '$2y$10$q0Mc2ZvIxH50B6RpwWfQ7uBv922Zj2.mxl.VTTXW4Rcr3ekrI1XX6', 'dylan@event.com', 'Dylan', 'Dog', 'user', 0),
(32, '2020-04-04 18:10:23', 'gruco', '$2y$10$0ZBehhLYGV7FCuMj8KlT8OKEfo81b3xyT6GwuzPkbbIQE/G8qUlTK', 'gruco@proba.rs', 'Gruco', 'Marks', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `event_view`
--
ALTER TABLE `event_view`
  ADD PRIMARY KEY (`event_view_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `event_view`
--
ALTER TABLE `event_view`
  MODIFY `event_view_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event_view`
--
ALTER TABLE `event_view`
  ADD CONSTRAINT `event_view_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
