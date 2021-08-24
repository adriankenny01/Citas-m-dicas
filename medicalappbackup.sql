-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2019 at 06:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `appoinment`
--

CREATE TABLE `appoinment` (
  `id` int(11) NOT NULL,
  `medic_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `title` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `symptoms` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicaments` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sick` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `url` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appoinment`
--

INSERT INTO `appoinment` (`id`, `medic_id`, `patient_id`, `start`, `end`, `title`, `symptoms`, `medicaments`, `sick`, `state`, `url`) VALUES
(15, 18, 2, '2019-08-08', '2019-08-05', 'Picazon', 'Dolor en los ojos', 'no ha tomado', 'no se sabe', 1, '/appointment/edit/'),
(16, 18, 22, '2019-08-07', '2019-08-07', 'Dolor de espalda', 'fuertes dolares', 'Complejo B', 'no se sabe', 1, '/appointment/edit/');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `area` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` smallint(6) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `area`, `state`, `icon`) VALUES
(5, 'Oftalmología', NULL, 'fas fa-eye'),
(7, 'Cardiología', NULL, 'far fa-heart');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `province` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_security` int(11) NOT NULL,
  `tipo_empleado` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `full_name`, `card_id`, `address`, `phone`, `date_start`, `province`, `social_security`, `tipo_empleado`, `state`, `image`) VALUES
(3, 'Adrian Kenny Acosta Ramirez', '40223883535', 'Respaldo Paseo Los Cocos', '8908080980', '2017-01-01', 'Santo domingo norte', 8098098, 'Administrativos', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `medic`
--

CREATE TABLE `medic` (
  `id` int(11) NOT NULL,
  `name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `province` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_security` int(11) NOT NULL,
  `number_of_collegiate` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `card_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medic`
--

INSERT INTO `medic` (`id`, `name`, `last_name`, `address`, `phone`, `province`, `social_security`, `number_of_collegiate`, `group_id`, `state`, `image`, `date_start`, `date_end`, `category_id`, `schedule_id`, `card_id`) VALUES
(18, 'Jason Luis', 'Gonzales', 'Ave. Independencia #200, S.D., Rep. Dom.', 2147483647, 'Santo Domingo', 1234567, 1, 8, 1, 'happydoctor-5d4729137d163.jpeg', '2017-07-16', NULL, 5, 4, '12223232');

-- --------------------------------------------------------

--
-- Table structure for table `medic_group`
--

CREATE TABLE `medic_group` (
  `id` int(11) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medic_group`
--

INSERT INTO `medic_group` (`id`, `name`, `state`) VALUES
(8, 'Fijo', NULL),
(10, 'Residente', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190211161353', '2019-02-11 16:15:14'),
('20190301020947', '2019-03-01 02:11:20'),
('20190301050814', '2019-03-01 05:09:17'),
('20190301060414', '2019-03-01 06:04:28'),
('20190301070236', '2019-03-01 07:02:45'),
('20190301080101', '2019-03-01 08:01:13'),
('20190301092950', '2019-03-01 09:29:58'),
('20190305044103', '2019-03-05 04:41:16'),
('20190305220441', '2019-03-08 01:32:17'),
('20190305220537', '2019-03-08 10:52:18'),
('20190308013500', '2019-03-08 01:36:03'),
('20190308105153', '2019-03-08 11:14:03'),
('20190308111457', '2019-03-08 11:15:14'),
('20190309185122', '2019-03-09 18:52:14'),
('20190309190101', '2019-03-09 19:01:34'),
('20190309231612', '2019-03-09 23:16:40'),
('20190310014613', '2019-03-10 01:46:41'),
('20190310215858', '2019-03-10 21:59:28'),
('20190310223508', '2019-03-10 22:35:36'),
('20190310223604', '2019-03-10 22:36:21'),
('20190310223712', '2019-03-10 22:37:50'),
('20190706183723', '2019-07-06 18:38:36'),
('20190708025033', '2019-07-08 02:52:44'),
('20190711024140', '2019-07-11 02:47:59'),
('20190711212743', '2019-07-11 21:28:35'),
('20190711213330', '2019-07-11 21:33:58'),
('20190711223434', '2019-07-11 22:35:32'),
('20190711231245', '2019-07-11 23:13:36'),
('20190715232951', '2019-07-15 23:32:05'),
('20190715234832', '2019-07-15 23:49:27'),
('20190715235436', '2019-07-15 23:56:37'),
('20190801224248', '2019-08-01 22:44:58'),
('20190803153227', '2019-08-03 15:33:13'),
('20190803180414', '2019-08-03 18:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `full_name` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `social_security` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `photo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `full_name`, `email`, `card_id`, `address`, `phone`, `social_security`, `state`, `photo`, `username`, `password`) VALUES
(2, 'Jhon Doe', 'jhondoe@gmail.com', '78970987890', 'Ave. Independencia #200, S.D., Rep. Dom.', 2147483647, 1234567, 1, 'clemonojeghuo1-5d47322c23343.jpeg', '', ''),
(22, 'Vladimir', 'vl@example.com', '657576567', 'Sabana Perdida', 2147483647, 1234545, 1, 'happydoctor-5d4c97b0293a6.jpeg', 'vladimir', '$2y$10$V.TT3k970TgX3MZ03nTCpO7HlxKCVk9q965frz1R5nFmVDNXq5yXm');

--
-- Triggers `patient`
--
DELIMITER $$
CREATE TRIGGER `insert_new_user` AFTER INSERT ON `patient` FOR EACH ROW INSERT INTO user 
    	SET username = NEW.username,
	 	password = NEW.password,
		type = 'patient',
		name = NEW.full_name,
		photo = NEW.photo,
		email = NEW.email,
		patient_id = NEW.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_new_user` AFTER UPDATE ON `patient` FOR EACH ROW UPDATE user 
    	SET username = NEW.username,
	 	password = NEW.password,
		type = 'patient',
		name = NEW.full_name,
		photo = NEW.photo,
		email = NEW.email,
		patient_id = NEW.id
		WHERE patient_id = NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day_one` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_two` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` smallint(6) DEFAULT NULL,
  `from_hour_day_one` time NOT NULL,
  `to_hour_day_one` time NOT NULL,
  `from_hour_day_two` time NOT NULL,
  `to_hour_day_two` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `day_one`, `day_two`, `state`, `from_hour_day_one`, `to_hour_day_one`, `from_hour_day_two`, `to_hour_day_two`) VALUES
(4, 'Lunes', 'Martes', NULL, '06:07:00', '07:10:00', '17:00:00', '18:00:00'),
(5, 'Jueves', 'Miercoles', NULL, '13:00:00', '14:00:00', '19:00:00', '20:00:00'),
(7, 'Lunes', 'Martes', NULL, '16:00:00', '16:30:00', '17:00:00', '17:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `state`, `username`, `email`, `type`, `photo`, `patient_id`, `role`) VALUES
(1, 'Administrador del sistema', '$2y$13$glGERv5Y75ZbQsj61MMdhOvWy0b7DoETyv3PdrPbiK2KDZe69o2S6', 1, 'admin', 'a@example.com', '', '', 0, 'ROLE_ADMIN'),
(5, 'Vladimir', '$2y$10$V.TT3k970TgX3MZ03nTCpO7HlxKCVk9q965frz1R5nFmVDNXq5yXm', 0, 'vladimir', 'vl@example.com', 'patient', 'happydoctor-5d4c97b0293a6.jpeg', 22, 'ROLE_PATIENT');

-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE `vacation` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days_taken` int(11) DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_init` date NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `medic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacation`
--

INSERT INTO `vacation` (`id`, `type`, `days_taken`, `reason`, `observations`, `date_init`, `employee_id`, `medic_id`) VALUES
(45, 'Permiso', 6, 'fads', 'fads', '2019-07-02', 0, 18),
(46, 'Permiso', 4, 'fasd', 'fasdf', '2019-07-19', 3, 0),
(47, 'Permiso', 2, 'descanso', 'prueba', '2019-08-13', 0, NULL),
(48, 'Permiso', 1, 'Diligencia', 'dia personal', '2019-08-15', 0, 18),
(49, 'Permiso', 1, 'Diligencia personal', 'descanso', '2019-08-16', 0, NULL),
(50, 'Permiso', 1, 'lkjlkafsj', 'fas', '2019-08-22', 0, NULL),
(51, 'Permiso', 2, 'fsfsa', 'gfgd', '2019-08-20', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DE1D2BD6409615FE` (`medic_id`),
  ADD KEY `IDX_DE1D2BD66B899279` (`patient_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medic`
--
ALTER TABLE `medic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8422C020FE54D947` (`group_id`),
  ADD KEY `IDX_8422C02012469DE2` (`category_id`),
  ADD KEY `FK_8422C020A40BC2D5` (`schedule_id`);

--
-- Indexes for table `medic_group`
--
ALTER TABLE `medic_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appoinment`
--
ALTER TABLE `appoinment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medic`
--
ALTER TABLE `medic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `medic_group`
--
ALTER TABLE `medic_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD CONSTRAINT `FK_DE1D2BD6409615FE` FOREIGN KEY (`medic_id`) REFERENCES `medic` (`id`),
  ADD CONSTRAINT `FK_DE1D2BD66B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Constraints for table `medic`
--
ALTER TABLE `medic`
  ADD CONSTRAINT `FK_8422C02012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_8422C020A40BC2D5` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`),
  ADD CONSTRAINT `FK_8422C020FE54D947` FOREIGN KEY (`group_id`) REFERENCES `medic_group` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
