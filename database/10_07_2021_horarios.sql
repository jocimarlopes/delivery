-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2021 at 10:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardapio`
--

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(15) NOT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `horario_inicio` varchar(45) DEFAULT NULL,
  `horario_final` varchar(45) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `dia`, `horario_inicio`, `horario_final`, `status`) VALUES
(1, 'Segunda', '18:00', '03:00', 0),
(2, 'Terça', '18:00', '03:00', 1),
(3, 'Quarta', '18:00', '03:00', 1),
(4, 'Quinta', '18:00', '03:00', 1),
(5, 'Sexta', '18:00', '03:00', 1),
(6, 'Sábado', '18:00', '03:00', 1),
(7, 'Domingo', '18:00', '03:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
