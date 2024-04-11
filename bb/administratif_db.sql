-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 03:08 PM
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
-- Database: `administratif_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aldeia`
--

CREATE TABLE `aldeia` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `suku_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aldeia`
--

INSERT INTO `aldeia` (`id`, `nama`, `suku_id`) VALUES
(1, 'Aldeia 1', 1),
(2, 'Aldeia 2', 2),
(3, 'Aldeia 3', 3),
(4, 'fomento', 4),
(5, 'bibilalari', 5);

-- --------------------------------------------------------

--
-- Table structure for table `municipio`
--

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `municipio`
--

INSERT INTO `municipio` (`id`, `nama`) VALUES
(1, 'Municipio A'),
(2, 'Municipio B'),
(3, 'Municipio C'),
(4, 'baucau'),
(5, 'dili');

-- --------------------------------------------------------

--
-- Table structure for table `posto_administrativo`
--

CREATE TABLE `posto_administrativo` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `municipio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posto_administrativo`
--

INSERT INTO `posto_administrativo` (`id`, `nama`, `municipio_id`) VALUES
(1, 'Posto Administrativo 1', 1),
(2, 'Posto Administrativo 2', 2),
(3, 'Posto Administrativo 3', 3),
(4, 'dom aleixo', 5),
(5, 'bgauia', 4);

-- --------------------------------------------------------

--
-- Table structure for table `suku`
--

CREATE TABLE `suku` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `posto_administrativo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suku`
--

INSERT INTO `suku` (`id`, `nama`, `posto_administrativo_id`) VALUES
(1, 'Suku 1', 1),
(2, 'Suku 2', 2),
(3, 'Suku 3', 3),
(4, 'manleu', 4),
(5, 'alaua leten', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aldeia`
--
ALTER TABLE `aldeia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suku_id` (`suku_id`);

--
-- Indexes for table `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posto_administrativo`
--
ALTER TABLE `posto_administrativo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipio_id` (`municipio_id`);

--
-- Indexes for table `suku`
--
ALTER TABLE `suku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posto_administrativo_id` (`posto_administrativo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aldeia`
--
ALTER TABLE `aldeia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posto_administrativo`
--
ALTER TABLE `posto_administrativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suku`
--
ALTER TABLE `suku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aldeia`
--
ALTER TABLE `aldeia`
  ADD CONSTRAINT `aldeia_ibfk_1` FOREIGN KEY (`suku_id`) REFERENCES `suku` (`id`);

--
-- Constraints for table `posto_administrativo`
--
ALTER TABLE `posto_administrativo`
  ADD CONSTRAINT `posto_administrativo_ibfk_1` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`);

--
-- Constraints for table `suku`
--
ALTER TABLE `suku`
  ADD CONSTRAINT `suku_ibfk_1` FOREIGN KEY (`posto_administrativo_id`) REFERENCES `posto_administrativo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
